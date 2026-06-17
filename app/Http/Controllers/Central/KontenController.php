<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Central\Konten;

class KontenController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Konten::with('subBab.bab.mataPelajaran')->get()
        ]);
    }
}
