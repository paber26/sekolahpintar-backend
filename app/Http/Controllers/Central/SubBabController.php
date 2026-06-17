<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Central\SubBab;

class SubBabController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => SubBab::with('bab.mataPelajaran')->get()
        ]);
    }
}
