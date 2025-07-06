<?php

namespace App\Filament\Resources\ReportThreadResource\Pages;

use App\Models\Report;
use App\Models\Notification;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\ReportThreadResource;
use Filament\Notifications\Notification as FilamentNotification;

class ViewReportThread extends ViewRecord
{
    protected static string $resource = ReportThreadResource::class;

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
        // Ambil record yang sedang dilihat (thread)
        $thread = $this->getRecord();

        // Ambil semua laporan yang terkait dengan thread ini
        $reports = Report::where('refers_id', $thread->id)
            ->where('category', 'thread')
            ->get();

        // Kirim notifikasi ke pemilik thread
        Notification::create([
            'user_id' => $thread->user_id,
            'title' => 'Laporan Postingan Dihapus',
            'content' => 'Postingan anda dengan judul: "' . $thread->title . '" telah dihapus karena melanggar beberapa peraturan',
        ]);

        // Kirim notifikasi ke masing-masing user yang melaporkan
        foreach ($reports as $report) {
            Notification::create([
                'user_id' => $report->user_id,
                'title' => 'Laporan Postingan Diterima',
                'content' =>
                <<<EOD
                Laporan Anda mengenai postingan dengan judul "$thread->title" telah diterima dan postingan telah dihapus.
                Terima kasih sudah melaporkan
                EOD,
            ]);
        }

        // Hapus data thread
        $thread->delete();

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
        // Ambil record yang sedang dilihat (thread)
        $thread = $this->getRecord();

        // Ambil semua laporan yang terkait dengan thread ini
        $reports = Report::where('refers_id', $thread->id)
            ->where('category', 'thread')
            ->get();

        // Kirim notifikasi ke masing-masing user yang melaporkan
        foreach ($reports as $report) {
            Notification::create([
                'user_id' => $report->user_id,
                'title' => 'Laporan Postingan Ditolak',
                'content' =>
                <<<EOD
                Laporan Anda mengenai postingan dengan judul "$thread->title" telah ditolak.
                Terima kasih sudah melaporkan
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
