<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Central\SuperAdmin;
use App\Models\Tenant\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Login untuk SuperAdmin (Central — sekolahpintar-admin)
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = SuperAdmin::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        $token = $user->createToken('admin-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => 'superadmin',
            ],
        ]);
    }

    /**
     * Login untuk user Tenant (Admin Sekolah, Guru, Siswa — sekolahpintar-sekolah)
     */
    public function loginTenant(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        // Ambil role dari Spatie Permission
        $role = $user->getRoleNames()->first() ?? 'siswa';

        $token = $user->createToken('tenant-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => [
                'id'     => $user->id,
                'name'   => $user->name,
                'email'  => $user->email,
                'role'   => $role,
                'kelas'  => $user->kelas_id ?? null,
            ],
        ]);
    }

    /**
     * Logout (hapus token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Berhasil logout.']);
    }

    /**
     * Ambil data user yang sedang login
     */
    public function me(Request $request)
    {
        $user = $request->user();
        $role = method_exists($user, 'getRoleNames')
            ? ($user->getRoleNames()->first() ?? 'superadmin')
            : 'superadmin';

        return response()->json([
            'user' => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $role,
            ],
        ]);
    }
}
