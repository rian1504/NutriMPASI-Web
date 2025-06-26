<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\AndroidConfig;

class NotificationObserver
{
    protected $messaging;

    // Constructor untuk menginjeksikan service Firebase Messaging
    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    /**
     * Handle the Notification "created" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function created(Notification $notification)
    {
        // Ambil user yang harus menerima notifikasi
        $user = User::find($notification->user_id);

        if (!$user || !$user->fcm_token) {
            Log::warning('User or FCM token not found for notification: ' . $notification->id);
            return;
        }

        $title = $notification->title;
        $body = $notification->content ?? 'Anda memiliki notifikasi baru.';
        $channelId = ''; // Sesuaikan logika penentuan channelId Anda

        switch ($notification->category) {
            case 'report':
                $channelId = 'notification'; // Sesuaikan dengan channel_id di Flutter
                break;
            case 'thread':
                $channelId = 'notification'; // Sesuaikan dengan channel_id di Flutter
                break;
            case 'comment':
                $channelId = 'notification'; // Sesuaikan dengan channel_id di Flutter
                break;
            case 'schedule':
                $channelId = 'notification'; // Sesuaikan dengan channel_id di Flutter
                break;
            default:
                $channelId = 'notification'; // Default ke channel 'notification'
                break;
        }

        $data = [
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
            'category' => $notification->category,
            'thread_id' => (string) $notification->thread_id,
            'comment_id' => (string) $notification->comment_id,
            'android_channel_id' => $channelId,
            'notification_title' => $title,
            'notification_body' => $body,
        ];

        // Buat pesan tanpa bagian 'notification'
        $message = CloudMessage::withTarget('token', $user->fcm_token)
            ->withNotification([
                'title' => $title,
                'body' => $body,
            ])
            ->withData($data); // Hanya kirim bagian data

        // Konfigurasi Android-specific
        $message = $message->withAndroidConfig(AndroidConfig::fromArray([
            'priority' => 'high',
            'notification' => [
                'channel_id' => $channelId, // Tetap set channel_id di sini
                'sound' => 'default',
            ],
        ]));

        try {
            $this->messaging->send($message);
            Log::info('Notification sent successfully to user ' . $user->id . ' via channel: ' . $channelId);
        } catch (\Exception $e) {
            Log::error('Failed to send FCM notification to user ' . $user->id . ': ' . $e->getMessage());
        }
    }
}
