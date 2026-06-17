<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Central\MataPelajaran;

class MataPelajaranController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => MataPelajaran::all()
        ]);
    }
}
