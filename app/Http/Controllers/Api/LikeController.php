<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // method untuk menampilkan data like
    public function index()
    {
        // mengambil id user
        $userId = Auth::id();

        // mengambil data likes berdasarkan user
        $likes = Like::select('thread_id')
            ->with([
                'thread' => function ($query) {
                    $query->with(['user' => function ($query) {
                        $query->select('id', 'name', 'avatar');
                    }])
                        ->withCount('likes')
                        ->withCount('comments');
                }
            ])
            ->where('user_id', $userId)
            ->get();

        // return respon JSON
        return response()->json([
            'data' => $likes,
            'message' => 'Berhasil mengambil data likes',
        ]);
    }

    // method untuk menambahkan/menghapus thread ke like
    public function store(Thread $thread)
    {
        // mengambil id user
        $userId = Auth::id();

        // Toggle like status
        $thread->likes()->toggle($userId);

        // cek apakah user sudah menyukai thread ini
        $isLike = $thread->likes()->where('user_id', $userId)->exists();

        if ($isLike) {
            if ($thread->user_id != $userId) {
                // Buat notifikasi untuk pemilik thread
                Notification::create([
                    'user_id' => $thread->user_id,
                    'actor_user_id' => $userId,
                    'category' => 'thread',
                    'thread_id' => $thread->id,
                    'title' => Auth::user()->name . ' menyukai postingan Anda',
                ]);
            }
        } else {
            // Hapus notifikasi jika like dihapus
            $thread->user->notifications()
                ->where('category', 'thread')
                ->where('actor_user_id', $userId)
                ->where('thread_id', $thread->id)
                ->delete();
        }

        $message = $isLike
            ? 'Berhasil menyukai thread'
            : 'Berhasil menghapus thread dari like';

        return response()->json([
            'message' => $message,
        ]);
    }
}
