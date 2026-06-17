<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes — TENANT (*.esekolahpintar.id / sekolah domain)
|--------------------------------------------------------------------------
| Routes ini hanya bisa diakses dari domain tenant (sekolah).
| Digunakan oleh nls-sekolah (panel admin sekolah + guru + siswa).
| stancl/tenancy otomatis menginisialisasi tenant berdasarkan domain.
*/

// ─── Auth (Public) ───────────────────────────────────────────────────────────
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'loginTenant']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('me', [AuthController::class, 'me'])->middleware('auth:sanctum');
});

// ─── Admin Sekolah ────────────────────────────────────────────────────────────
Route::middleware(['auth:sanctum', 'role:admin_sekolah'])->prefix('admin')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Tenant\Admin\DashboardController::class, 'index']);
    Route::apiResource('guru', \App\Http\Controllers\Tenant\Admin\GuruController::class);
    Route::apiResource('siswa', \App\Http\Controllers\Tenant\Admin\SiswaController::class);
    Route::apiResource('kelas', \App\Http\Controllers\Tenant\Admin\KelasController::class);
    Route::get('laporan', [\App\Http\Controllers\Tenant\Admin\LaporanController::class, 'index']);
});

// ─── Guru ─────────────────────────────────────────────────────────────────────
Route::middleware(['auth:sanctum', 'role:guru'])->prefix('guru')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Tenant\Guru\DashboardController::class, 'index']);
    Route::get('kelas', [\App\Http\Controllers\Tenant\Guru\KelasController::class, 'index']);
    Route::get('kelas/{kelas}/siswa', [\App\Http\Controllers\Tenant\Guru\KelasController::class, 'siswa']);

    // Materi per kelas (diambil dari central DB)
    Route::get('materi', [\App\Http\Controllers\Tenant\Guru\MateriController::class, 'index']);
    Route::post('materi/assign', [\App\Http\Controllers\Tenant\Guru\MateriController::class, 'assign']);

    // Kuis
    Route::apiResource('kuis', \App\Http\Controllers\Tenant\Guru\KuisController::class);

    // Nilai
    Route::get('nilai/{kelas}', [\App\Http\Controllers\Tenant\Guru\NilaiController::class, 'index']);
    Route::post('nilai', [\App\Http\Controllers\Tenant\Guru\NilaiController::class, 'store']);
    Route::put('nilai/{nilai}', [\App\Http\Controllers\Tenant\Guru\NilaiController::class, 'update']);
});

// ─── Siswa ────────────────────────────────────────────────────────────────────
Route::middleware(['auth:sanctum', 'role:siswa'])->prefix('siswa')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Tenant\Siswa\DashboardController::class, 'index']);

    // Materi (read only, ambil dari central DB)
    Route::get('materi', [\App\Http\Controllers\Tenant\Siswa\MateriController::class, 'index']);
    Route::get('materi/{id}', [\App\Http\Controllers\Tenant\Siswa\MateriController::class, 'show']);
    Route::post('materi/{id}/selesai', [\App\Http\Controllers\Tenant\Siswa\MateriController::class, 'selesai']);

    // Kuis
    Route::get('kuis', [\App\Http\Controllers\Tenant\Siswa\KuisController::class, 'index']);
    Route::get('kuis/{kuis}', [\App\Http\Controllers\Tenant\Siswa\KuisController::class, 'show']);
    Route::post('kuis/{kuis}/kerjakan', [\App\Http\Controllers\Tenant\Siswa\KuisController::class, 'kerjakan']);

    // Nilai & Progress
    Route::get('nilai', [\App\Http\Controllers\Tenant\Siswa\NilaiController::class, 'index']);
    Route::get('progress', [\App\Http\Controllers\Tenant\Siswa\ProgressController::class, 'index']);
});
