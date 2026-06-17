<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Central\Materi;

class MateriController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Materi::with('kurikulum')->get()
        ]);
    }
}
