<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    // method untuk mengambil semua data thread
    public function index()
    {
        // mengambil id user
        $userId = Auth::id();

        // ambil semua data thread
        $data = Thread::withCount('likes')
            ->withCount('comments')
            ->withExists([
                'likes as is_like' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                }
            ])
            ->with('user:id,name,avatar')
            ->inRandomOrder()->get();

        // return response JSON
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil mengambil semua data thread',
        ]);
    }

    // method untuk menampilkan detail data thread
    public function show(Thread $thread)
    {
        // mengambil id user
        $userId = Auth::id();

        // Ambil data thread beserta relasi user dan comments
        $thread->load([
            'user' => function ($query) {
                $query->select('id', 'name', 'avatar');
            },
            'comments' => function ($query) {
                $query->with(['user' => function ($query) {
                    $query->select('id', 'name', 'avatar');
                }])->orderBy('created_at', 'desc');
            }
        ])->loadCount('comments')->loadCount('likes')
            ->loadExists([
                'likes as is_like' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
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
