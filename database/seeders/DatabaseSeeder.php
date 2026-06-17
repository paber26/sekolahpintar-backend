<?php

namespace Database\Seeders;

use App\Models\Central\SuperAdmin;
use App\Models\Central\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's Central database.
     */
    public function run(): void
    {
        // 1. Create Super Admin (Pusat)
        SuperAdmin::updateOrCreate(
            ['email' => 'admin@esekolahpintar.id'],
            [
                'name'     => 'Super Admin Pusat',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Create 5 Pilot Schools (Tenants)
        $pilotSchools = [
            'sekolah1' => 'SMAN 1 Pilot',
            'sekolah2' => 'SMAN 2 Pilot',
            'sekolah3' => 'SMA Harapan Pilot',
            'sekolah4' => 'SMPN 1 Pilot',
            'sekolah5' => 'SMPN 2 Pilot',
        ];

        foreach ($pilotSchools as $id => $name) {
            $tenant = Tenant::firstOrCreate(['id' => $id], [
                'name'  => $name,
                'email' => "info@{$id}.esekolahpintar.id",
                'is_active' => true,
            ]);

            // Create domain for the tenant
            $tenant->domains()->firstOrCreate([
                'domain' => "{$id}.esekolahpintar.id"
            ]);
        }
    }
}
