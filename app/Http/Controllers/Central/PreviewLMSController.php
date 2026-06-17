<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Central\MataPelajaran;

class PreviewLMSController extends Controller
{
    public function index()
    {
        // Menarik seluruh data hierarki: MataPelajaran -> Bab -> SubBab -> Konten -> Soal
        $data = MataPelajaran::with(['babs.subBabs.kontens.soals'])
            ->where('is_active', true)
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }
}
