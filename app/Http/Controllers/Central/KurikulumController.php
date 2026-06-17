<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Central\Kurikulum;

class KurikulumController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Kurikulum::all()
        ]);
    }
}
