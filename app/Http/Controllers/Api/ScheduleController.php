<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BabySchedule;
use App\Models\Food;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    // method untuk menampilkan data schedule hari ini
    public function index()
    {
        // mengambil id user
        $userId = Auth::id();

        // mengambil data schedule
        $schedule = Schedule::select('id', 'food_id', 'date')
            ->with(['food' => function ($query) {
                $query->select('id', 'name', 'image');
            }])
            ->with(['baby_schedules.baby' => function ($query) {
                $query->select('id', 'name');
            }])
            ->where('user_id', $userId)
            ->get()
            ->map(function ($schedule) {
                return [
                    'id' => $schedule->id,
                    'date' => $schedule->date,
                    'food_id' => $schedule->food_id,
                    'food' => $schedule->food,
                    'babies' => $schedule->baby_schedules->pluck('baby'),
                ];
            });

        // return respon JSON
        return response()->json([
            'data' => $schedule,
            'message' => 'Berhasil mengambil data schedule',
        ]);
    }

    // method untuk memfilter data schedule
    public function filter(Request $request)
    {
        // validasi input
        $request->validate([
            'date' => ['required', 'date'],
        ]);

        // mengambil id user
        $userId = Auth::id();

        // mengambil data schedule
        $schedule = Schedule::select('id', 'food_id')
            ->with(['food' => function ($query) {
                $query->select('id', 'name', 'image');
            }])
            ->with(['baby_schedules.baby' => function ($query) {
                $query->select('id', 'name');
            }])
            ->where('user_id', $userId)
            ->where('date', $request->date)
            ->get()
            ->map(function ($schedule) {
                return [
                    'id' => $schedule->id,
                    'food_id' => $schedule->food_id,
                    'food' => $schedule->food,
                    'babies' => $schedule->baby_schedules->pluck('baby')
                ];
            });

        // return respon JSON
        return response()->json([
            'data' => $schedule,
            'message' => 'Berhasil memfilter data schedule',
        ]);
    }

    // method untuk memasukkan data makanan ke schedule
    public function store(Request $request, Food $food)
    {
        // validasi input
        $request->validate([
            'baby_id' => ['required', 'array'],
            'baby_id.*' => ['required', 'integer'],
            'date' => ['required', 'date'],
        ]);

        // mengambil id user
        $userId = Auth::id();

        // Simpan data ke tabel schedule
        $schedule = Schedule::create([
            'user_id' => $userId,
            'food_id' => $food->id,
            'date' => $request->date,
        ]);

        // Simpan data ke tabel baby_schedule untuk setiap baby_id
        foreach ($request->baby_id as $babyId) {
            BabySchedule::create([
                'schedule_id' => $schedule->id,
                'baby_id' => $babyId,
            ]);
        }

        // return response JSON
        return response()->json([
            'data' => $schedule,
            'message' => 'Berhasil menambahkan jadwal masakan',
        ]);
    }

    // method untuk mengambil data schedule untuk edit
    public function edit(Schedule $schedule)
    {
        // mengambil data schedule
        $schedule = Schedule::select('id', 'date')
            ->with(['baby_schedules.baby' => function ($query) {
                $query->select('id', 'name');
            }])
            ->where('id', $schedule->id)
            ->get()
            ->map(function ($schedule) {
                return [
                    'id' => $schedule->id,
                    'date' => $schedule->date,
                    'babies' => $schedule->baby_schedules->pluck('baby')
                ];
            })
            ->first();

        // return response JSON
        return response()->json([
            'data' => $schedule,
            'message' => 'Berhasil mengambil data edit schedule',
        ]);
    }

    // method untuk mengedit data schedule
    public function update(Request $request, Schedule $schedule)
    {
        // validasi input
        $request->validate([
            'baby_id' => ['required', 'array'],
            'baby_id.*' => ['required', 'integer'],
            'date' => ['required', 'date'],
        ]);

        // update data schedule
        $schedule->update([
            'date' => $request->date,
        ]);

        // hapus data di tabel baby_schedule
        $schedule->baby_schedules()->delete();

        // Simpan data ke tabel baby_schedule untuk setiap baby_id
        foreach ($request->baby_id as $babyId) {
            BabySchedule::create([
                'schedule_id' => $schedule->id,
                'baby_id' => $babyId,
            ]);
        }

        // return response JSON
        return response()->json([
            'data' => $schedule,
            'message' => 'Berhasil mengubah data schedule',
        ]);
    }

    // method untuk menghapus data schedule
    public function destroy(Schedule $schedule)
    {
        // menghapus data
        $schedule->delete();

        // return response JSON
        return response()->json([
            'message' => 'Berhasil menghapus data schedule',
        ]);
    }
}