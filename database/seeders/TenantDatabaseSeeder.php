<?php

namespace Database\Seeders;

use App\Models\Tenant\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds for Tenant.
     */
    public function run(): void
    {
        // 1. Create Roles & Permissions
        // Important: Tenancy + Spatie requires explicit guard or setup
        $roles = [
            'admin_sekolah',
            'guru',
            'siswa',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'sanctum']);
        }

        // 2. Create Default Admin Sekolah for this Tenant
        // We assume the tenant domain will be available globally or we use a generic email
        $admin = User::firstOrCreate(
            ['email' => 'admin@' . tenant('id') . '.sch.id'],
            [
                'name'     => 'Admin ' . tenant('name'),
                'password' => Hash::make('password123'),
            ]
        );

        $admin->assignRole('admin_sekolah');
    }
}
