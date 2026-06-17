<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes — CENTRAL (esekolahpintar.id, admin.esekolahpintar.id)
|--------------------------------------------------------------------------
| Routes ini hanya bisa diakses dari domain central.
| Digunakan oleh nls-admin (panel superadmin pusat).
*/

// ─── Auth (Public) ───────────────────────────────────────────────────────────
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('me', [AuthController::class, 'me'])->middleware('auth:sanctum');
});

// ─── Protected (SuperAdmin) ───────────────────────────────────────────────────
Route::middleware(['auth:sanctum'])->group(function () {

    // Kelola Sekolah (Tenant)
    Route::apiResource('sekolah', \App\Http\Controllers\Central\SekolahController::class);

    // Master Materi
    Route::apiResource('materi', \App\Http\Controllers\Central\MateriController::class);
    Route::post('materi/{materi}/upload', [\App\Http\Controllers\Central\MateriController::class, 'upload']);

    // Bank Soal
    Route::apiResource('soal', \App\Http\Controllers\Central\SoalController::class);

    // Kurikulum
    Route::apiResource('kurikulum', \App\Http\Controllers\Central\KurikulumController::class);

    // Dashboard statistik
    Route::get('dashboard', [\App\Http\Controllers\Central\DashboardController::class, 'index']);
});
