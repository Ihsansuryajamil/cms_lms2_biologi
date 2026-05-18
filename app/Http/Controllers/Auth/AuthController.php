<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'role' => ['required', 'in:teacher,student'],
        ]);

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->withInput();
        }

        $user = Auth::user();

        // Pastikan role yang dicoba sesuai dengan role user di database
        if (Str::lower((string) $user->role) !== $validated['role']) {
            Auth::logout();

            return back()->withErrors([
                'role' => 'Akun ini tidak terdaftar sebagai role yang dipilih.',
            ])->withInput();
        }

        if (Str::lower((string) $user->role) === 'teacher') {
            return redirect()->route('teachers_dashboard');
        }

        return redirect()->route('students_dashboard');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:teacher,student'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        Auth::login($user);

        if (Str::lower((string) $user->role) === 'teacher') {
            return redirect()->route('teachers_dashboard');
        }

        return redirect()->route('students_dashboard');
    }
}

