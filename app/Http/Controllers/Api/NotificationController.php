<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // method untuk menampilkan data notification
    public function index()
    {
        // mengambil id user
        $userId = Auth::id();

        // mengambil data notifications berdasarkan user
        $notifications = Notification::where('user_id', $userId)->latest()->get();

        // hidden field yang tidak ingin ditampilkan
        $notifications->makeHidden(['user_id', 'actor_user_id']);

        // return respon JSON
        return response()->json([
            'data' => $notifications,
            'message' => 'Berhasil mengambil data notifications',
        ]);
    }

    // method untuk read data notification
    public function read(Notification $notification)
    {
        // Update data notification
        $notification->update([
            'is_read' => true
        ]);

        // return response JSON
        return response()->json([
            'message' => 'Berhasil membaca data notification',
        ]);
    }

    // method untuk read all data notification
    public function readAll()
    {
        // mengambil id user
        $userId = Auth::id();

        // mengambil data notifications berdasarkan user
        $notifications = Notification::where('user_id', $userId)->get();

        // check if notification is empty
        if ($notifications->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada data notification',
            ]);
        }

        // Update data notification
        foreach ($notifications as $notification) {
            $notification->update([
                'is_read' => true
            ]);
        }

        // return response JSON
        return response()->json([
            'message' => 'Berhasil membaca semua data notification',
        ]);
    }
}
