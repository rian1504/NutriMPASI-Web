<?php

namespace App\Http\Controllers\Api;

use App\Models\Report;
use App\Models\Thread;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ThreadUserController extends Controller
{
    // method untuk mengambil data thread berdasarkan user
    public function index()
    {
        // ambil user id
        $userId = Auth::id();

        // ambil data thread
        $thread = Thread::where('user_id', $userId)->get();

        // return response JSON
        return response()->json([
            'data' => $thread,
            'message' => 'Berhasil mengambil data thread user',
        ]);
    }

    // method untuk menambah data thread
    public function store(Request $request)
    {
        // validasi request
        $request->validate([
            'title' => ['required', 'string', 'min:4', 'max:50'],
            'content' => ['required', 'string', 'min:10'],
        ]);

        // Mengambil id user
        $userId = Auth::user()->id;

        // membuat data thread
        $thread = Thread::create([
            'user_id' => $userId,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // return response JSON
        return response()->json([
            'data' => $thread,
            'message' => 'Berhasil menambah data thread',
        ]);
    }

    // method untuk update data thread
    public function update(Request $request, Thread $thread_user)
    {
        // validasi request
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'min:4', 'max:50'],
            'content' => ['required', 'string', 'min:10'],
        ]);

        // Update data thread
        $thread_user->update($validatedData);

        // return response JSON
        return response()->json([
            'data' => $thread_user,
            'message' => 'Berhasil mengubah data thread',
        ]);
    }

    // method untuk menghapus data thread
    public function destroy(Thread $thread_user)
    {
        // Hapus report terkait thread ini
        Report::where('category', 'thread')
            ->where('refers_id', $thread_user->id)
            ->delete();

        // Hapus notification terkait thread ini
        Notification::where('category', 'thread')
            ->where('thread_id', $thread_user->id)
            ->delete();

        // Hapus data thread
        $thread_user->delete();

        return response()->json([
            'message' => 'Data thread berhasil dihapus',
        ]);
    }
}
