<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Central\Tenant;

class SekolahController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('domains')->get()->map(function($tenant) {
            return [
                'id' => $tenant->id,
                'nama_sekolah' => $tenant->name ?? 'Tenant ' . $tenant->id,
                'domain_tenant' => $tenant->domains->first()->domain ?? '',
                'status_langganan' => 'aktif',
                'batas_langganan' => now()->addYear()->toDateTimeString()
            ];
        });
        
        return response()->json([
            'data' => $tenants
        ]);
    }
}
