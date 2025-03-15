<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    // method untuk mengambil semua data thread
    public function index()
    {
        // ambil data thread dengan pagination 10 data
        $data = Thread::withCount('likes')->paginate(10);

        // mengambil id user
        $userId = Auth::id();

        // looping data
        $data->each(function ($thread) use ($userId) {
            // Cek apakah user sudah menyukai thread ini
            $thread['is_like'] = $thread->likes()->where('user_id', $userId)->exists();
        });

        // return response JSON
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil mengambil semua data thread',
        ]);
    }

    // method untuk menampilkan detail data thread
    public function show(Thread $thread)
    {
        // Ambil data thread beserta relasi user dan comments
        $thread->load([
            'user' => function ($query) {
                $query->select('id', 'name');
            },
            'comments' => function ($query) {
                $query->with(['user' => function ($query) {
                    $query->select('id', 'name');
                }]);
            }
        ]);

        // hidden field
        $thread->makeHidden(['user_id']);

        // return response JSON
        return response()->json([
            'data' => $thread,
            'message' => 'Berhasil mengambil detail data thread',
        ]);
    }
}