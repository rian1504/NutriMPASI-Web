<?php

namespace App\Filament\Resources\ReportCommentResource\Pages;

use Filament\Actions;
use App\Models\Report;
use App\Models\Notification;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\ReportCommentResource;
use Filament\Notifications\Notification as FilamentNotification;

class ViewReportComment extends ViewRecord
{
    protected static string $resource = ReportCommentResource::class;

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
        // Ambil record yang sedang dilihat (comment)
        $comment = $this->getRecord();

        // Ambil semua laporan yang terkait dengan comment ini
        $reports = Report::where('refers_id', $comment->id)
            ->where('category', 'comment')
            ->get();

        // Ambil judul thread
        $thread = $comment->thread->title;

        // Kirim notifikasi ke pemilik comment
        Notification::create([
            'user_id' => $comment->user_id,
            'title' => 'Laporan Komentar Dihapus',
            'content' => 'Komentar anda pada thread dengan judul: "' . $thread . '" telah dihapus karena melanggar beberapa peraturan',
        ]);

        // Kirim notifikasi ke masing-masing user yang melaporkan
        foreach ($reports as $report) {
            Notification::create([
                'user_id' => $report->user_id,
                'title' => 'Laporan Komentar Diterima',
                'content' =>
                <<<EOD
                Laporan Anda mengenai komentar pada thread dengan judul "$thread" telah diterima dan komentar telah dihapus.
                Terima kasih sudah melaporkan
                EOD,
            ]);
        }

        // Hapus data comment
        $comment->delete();

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
        // Ambil record yang sedang dilihat (comment)
        $comment = $this->getRecord();

        // Ambil semua laporan yang terkait dengan comment ini
        $reports = Report::where('refers_id', $comment->id)
            ->where('category', 'comment')
            ->get();

        // Ambil judul thread
        $thread = $comment->thread->title;

        // Kirim notifikasi ke masing-masing user yang melaporkan
        foreach ($reports as $report) {
            Notification::create([
                'user_id' => $report->user_id,
                'title' => 'Laporan Komentar Ditolak',
                'content' =>
                <<<EOD
                Laporan Anda mengenai komentar pada thread dengan judul "$thread" telah ditolak.
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
