<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Central\MataPelajaran;
use App\Models\Central\Bab;
use App\Models\Central\SubBab;
use Illuminate\Support\Facades\DB;

class LMSController extends Controller
{
    // Mengambil katalog pelajaran dari pusat
    public function getKatalogPelajaran()
    {
        // Menggunakan model dari central
        $mataPelajaran = MataPelajaran::with(['babs.subBabs.kontens'])->where('is_active', true)->get();
        return response()->json(['data' => $mataPelajaran]);
    }

    // Guru mengadopsi (mengambil) sebuah sub bab untuk kelasnya
    public function adopsiSubBab(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'sub_bab_id' => 'required',
        ]);

        // Verifikasi SubBab ada di central
        $subBab = SubBab::find($request->sub_bab_id);
        if (!$subBab) {
            return response()->json(['message' => 'Sub Bab tidak ditemukan di Master Data'], 404);
        }

        // Masukkan ke tenant db (menggunakan DB facade atau model pivot)
        DB::table('kelas_sub_bab')->updateOrInsert(
            [
                'kelas_id' => $request->kelas_id,
                'sub_bab_id' => $request->sub_bab_id,
            ],
            [
                'instruksi_guru' => $request->instruksi_guru,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return response()->json(['message' => 'Sub Bab berhasil diadopsi untuk kelas ini.']);
    }

    // Mengambil daftar sub bab yang sudah diadopsi oleh sebuah kelas
    public function getMateriKelas($kelasId)
    {
        // Ambil ID sub bab yang diadopsi
        $adoptedIds = DB::table('kelas_sub_bab')->where('kelas_id', $kelasId)->pluck('sub_bab_id');

        // Ambil data sub bab berserta kontennya dari central
        $subBabs = SubBab::with('kontens')->whereIn('id', $adoptedIds)->get();

        return response()->json(['data' => $subBabs]);
    }
}
