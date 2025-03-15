<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
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
            'content' => ['required', 'string', 'min:4'],
        ]);

        // Mengambil id user
        $userId = Auth::user()->id;

        // membuat data comment
        $comment = Comment::create([
            'user_id' => $userId,
            'thread_id' => $request->thread_id,
            'content' => $request->content,
        ]);

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
            'content' => ['required', 'string', 'min:4'],
        ]);

        // Update data comment
        $comment->update($validatedData);

        // return response JSON
        return response()->json([
            'data' => $comment,
            'message' => 'Berhasil mengubah komentar',
        ]);
    }

    // method untuk menghapus data comment
    public function destroy(Comment $comment)
    {
        // Hapus data comment
        $comment->delete();

        return response()->json([
            'message' => 'Komentar berhasil dihapus',
        ]);
    }
}