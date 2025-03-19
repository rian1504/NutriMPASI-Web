<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\User;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class UserGrowthChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected static ?string $heading = 'Kenaikan Pengguna';

    protected static ?string $description = 'Data kenaikan pengguna per bulan';

    protected int | string | array $columnSpan = 'full';

    protected function getType(): string
    {
        return 'line'; // Tipe chart: line, bar, pie, dll.
    }

    protected function getData(): array
    {
        // Gunakan Eloquent Query Builder untuk memfilter data
        $query = User::where('is_admin', 0); // Filter user dengan is_admin = 0

        // Teruskan query ke package laravel-trend
        $data = Trend::query($query) // Gunakan query yang sudah difilter
            ->between(
                start: now()->startOfYear(), // Mulai dari awal tahun
                end: now()->endOfYear(), // Sampai akhir tahun
            )
            ->perMonth() // Kelompokkan per bulan
            ->count(); // Hitung jumlah user

        return [
            'datasets' => [
                [
                    'label' => 'Pengguna Baru',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                    'borderColor' => '#3b82f6', // Warna garis
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)', // Warna fill
                ],
            ],
            'labels' => $data->map(function (TrendValue $value) {
                // Ubah format tanggal menjadi "Nama Bulan Tahun" (misalnya, "Januari 2023")
                return Carbon::parse($value->date)->translatedFormat('F Y'); // 'F' untuk nama bulan, 'Y' untuk tahun
            }),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => false, // Mulai sumbu Y dari 0
                    'ticks' => [
                        'precision' => 0, // Pastikan nilai pada sumbu Y adalah integer
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false, // Tampilkan legend
                ],
            ],
        ];
    }
}