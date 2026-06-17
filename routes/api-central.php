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

    // Master Data
    Route::apiResource('kurikulum', \App\Http\Controllers\Central\KurikulumController::class);
    Route::apiResource('mata-pelajaran', \App\Http\Controllers\Central\MataPelajaranController::class);
    Route::apiResource('bab', \App\Http\Controllers\Central\BabController::class);
    Route::apiResource('sub-bab', \App\Http\Controllers\Central\SubBabController::class);
    Route::apiResource('konten', \App\Http\Controllers\Central\KontenController::class);
    Route::apiResource('soal', \App\Http\Controllers\Central\SoalController::class);

    // Dashboard statistik
    Route::get('dashboard', [\App\Http\Controllers\Central\DashboardController::class, 'index']);
});
