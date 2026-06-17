<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Central\Soal;

class SoalController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Soal::with('konten.subBab.bab.mataPelajaran')->get()
        ]);
    }
}
