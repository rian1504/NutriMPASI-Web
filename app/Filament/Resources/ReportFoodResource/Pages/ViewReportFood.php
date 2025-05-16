<?php

namespace App\Filament\Resources\ReportFoodResource\Pages;

use App\Models\Report;
use App\Models\Notification;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Storage;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\ReportFoodResource;
use Filament\Notifications\Notification as FilamentNotification;
use App\Filament\Resources\ReportFoodResource\RelationManagers\ReportFoodRelationManager;

class ViewReportFood extends ViewRecord
{
    protected static string $resource = ReportFoodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Button untuk menolak laporan
            Action::make('reject')
                ->label('Tolak Laporan')
                ->color('danger')
                ->icon('heroicon-o-x-mark')
                ->requiresConfirmation()
                ->action(fn($record) => self::rejectReports($record)),

            // Button untuk menerima laporan
            Action::make('accept')
                ->label('Terima Laporan')
                ->color('success')
                ->icon('heroicon-o-check')
                ->requiresConfirmation()
                ->action(fn($record) => self::acceptReports($record)),
        ];
    }

    protected function acceptReports(): void
    {
        // Ambil record yang sedang dilihat (food)
        $food = $this->getRecord();

        // Ambil semua laporan yang terkait dengan food ini
        $reports = Report::where('refers_id', $food->id)
            ->where('category', 'food')
            ->get();

        // Kirim notifikasi ke pemilik food
        Notification::create([
            'user_id' => $food->user_id,
            'title' => 'Laporan Makanan Dihapus',
            'content' => 'Makanan anda dengan nama makanan: "' . $food->name . '" telah dihapus karena melanggar beberapa peraturan',
        ]);

        // Kirim notifikasi ke masing-masing user yang melaporkan
        foreach ($reports as $report) {
            Notification::create([
                'user_id' => $report->user_id,
                'title' => 'Laporan Makanan Diterima',
                'content' =>
                <<<EOD
                Laporan Anda tentang makanan dengan nama "$food->name" telah diterima dan makanan telah dihapus.
                Terima kasih sudah melaporkan😻😻
                EOD,
            ]);
        }

        // jika ada image
        if ($food->image && Storage::exists($food->image)) {
            // delete image
            Storage::delete($food->image);
        }

        // Hapus data food
        $food->delete();

        // Hapus data laporan yang terkait
        $reports->each->delete();

        // Notifikasi sukses di Filament
        FilamentNotification::make()
            ->title('Berhasil Menerima Laporan')
            ->success()
            ->send();

        // Redirect ke halaman index
        $this->redirect($this->getResource()::getUrl('index'));
    }

    protected function rejectReports(): void
    {
        // Ambil record yang sedang dilihat (food)
        $food = $this->getRecord();

        // Ambil semua laporan yang terkait dengan food ini
        $reports = Report::where('refers_id', $food->id)
            ->where('category', 'food')
            ->get();

        // Kirim notifikasi ke masing-masing user yang melaporkan
        foreach ($reports as $report) {
            Notification::create([
                'user_id' => $report->user_id,
                'title' => 'Laporan Makanan Ditolak',
                'content' =>
                <<<EOD
                Laporan Anda tentang makanan dengan nama "$food->name" telah ditolak.
                Terima kasih sudah melaporkan😻😻
                EOD,
            ]);
        }

        // Hapus data laporan yang terkait
        $reports->each->delete();

        // Notifikasi sukses di Filament
        FilamentNotification::make()
            ->title('Berhasil Menolak Laporan')
            ->danger()
            ->send();

        // Redirect ke halaman index
        $this->redirect($this->getResource()::getUrl('index'));
    }
}
