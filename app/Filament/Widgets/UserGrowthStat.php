<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class UserGrowthStat extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();

        // Hitung total pengguna bulan ini
        $currentMonthUsers = User::whereBetween('created_at', [$startDate, $endDate])
            ->where('is_admin', 0)
            ->count();

        // Hitung total pengguna bulan sebelumnya
        $previousMonthStartDate = $startDate->copy()->subMonth();
        $previousMonthEndDate = $endDate->copy()->subMonth();
        $previousMonthUsers = User::whereBetween('created_at', [$previousMonthStartDate, $previousMonthEndDate])
            ->where('is_admin', 0)
            ->count();

        // Hitung kenaikan pengguna
        $growth = $currentMonthUsers - $previousMonthUsers;
        $growthPercentage = $previousMonthUsers > 0 ? ($growth / $previousMonthUsers) * 100 : 0;

        // Hitung total pengguna
        $totalUsers = User::where('is_admin', 0)->count();

        return [
            Stat::make('Total Pengguna Bulan Ini', $currentMonthUsers)
                ->description('Jumlah pengguna yang terdaftar bulan ini')
                ->descriptionIcon('heroicon-s-users')
                ->color('success'),

            Stat::make('Kenaikan Pengguna', $growth)
                ->description($previousMonthUsers == 0 && $currentMonthUsers > 0
                    ? '100% (pertumbuhan dari 0 pengguna)'
                    : sprintf('%s%% dari bulan sebelumnya', number_format($growthPercentage)))
                ->descriptionIcon($growth >= 0 ? 'heroicon-s-arrow-trending-up' : 'heroicon-s-arrow-trending-down')
                ->color($growth >= 0 ? 'success' : 'danger'),

            Stat::make('Total Pengguna', $totalUsers)
                ->description('Jumlah total pengguna yang terdaftar')
                ->descriptionIcon('heroicon-s-users')
                ->color('success'),
        ];
    }
}
