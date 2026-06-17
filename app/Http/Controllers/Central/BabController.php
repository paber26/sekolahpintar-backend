<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Central\Bab;

class BabController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Bab::with('mataPelajaran')->get()
        ]);
    }
}
