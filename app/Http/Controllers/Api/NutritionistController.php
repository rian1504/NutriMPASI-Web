<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nutritionist;
use Illuminate\Http\Request;

class NutritionistController extends Controller
{
    // method untuk mengambil data nutritionist
    public function index()
    {
        $nutritionist = Nutritionist::get();

        // hidden field
        $nutritionist->makeHidden(['created_at', 'updated_at']);

        // return respon JSON
        return response()->json([
            'data' => $nutritionist,
            'message' => 'Berhasil mengambil data nutritionist',
        ]);
    }
}