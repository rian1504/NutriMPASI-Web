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

        // return respon JSON
        return response()->json([
            'data' => $notifications,
            'message' => 'Berhasil mengambil data notifications',
        ]);
    }

    // method untuk update data notification
    public function update(Notification $notification)
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
}