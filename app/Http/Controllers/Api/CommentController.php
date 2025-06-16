<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Report;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // method untuk menambah data comment
    public function store(Request $request)
    {
        // validasi request
        $request->validate([
            'thread_id' => ['required', 'integer'],
            'content' => ['required', 'string'],
        ]);

        // Mengambil id user
        $userId = Auth::user()->id;

        // Cari thread terkait (untuk notifikasi)
        $thread = Thread::findOrFail($request->thread_id);

        // membuat data comment
        $comment = Comment::create([
            'user_id' => $userId,
            'thread_id' => $thread->id,
            'content' => $request->content,
        ]);

        if ($thread->user_id != $userId) {
            // Buat notifikasi untuk pemilik thread
            Notification::create([
                'user_id' => $thread->user_id,
                'actor_user_id' => $userId,
                'category' => 'comment',
                'thread_id' => $thread->id,
                'comment_id' => $comment->id,
                'title' => Auth::user()->name . ' mengomentari postingan Anda',
            ]);
        }

        // Mengambil data user yang membuat komentar
        $comment->load(['user' => function ($query) {
            $query->select('id', 'name', 'avatar');
        }]);

        // return response JSON
        return response()->json([
            'data' => $comment,
            'message' => 'Berhasil melakukan komentar',
        ]);
    }

    // method untuk update data comment
    public function update(Request $request, Comment $comment)
    {
        // validasi request
        $validatedData = $request->validate([
            'content' => ['required', 'string'],
        ]);

        // Update data comment
        $comment->update($validatedData);

        // get user data
        $comment->load([
            'user' => function ($query) {
                $query->select('id', 'name', 'avatar');
            }
        ]);

        // return response JSON
        return response()->json([
            'data' => $comment,
            'message' => 'Berhasil mengubah komentar',
        ]);
    }

    // method untuk menghapus data comment
    public function destroy(Comment $comment)
    {
        // Hapus report terkait komentar ini
        Report::where('category', 'comment')
            ->where('refers_id', $comment->id)
            ->delete();

        // Hapus Notification terkait komentar ini
        Notification::where('category', 'comment')
            ->where('comment_id', $comment->id)
            ->delete();

        // Hapus data comment
        $comment->delete();

        return response()->json([
            'message' => 'Komentar berhasil dihapus',
        ]);
    }
}
