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
        return view('Auth.login'); // Pastikan path ini sesuai dengan letak file login.blade.php Anda
    }

    public function showRegister()
    {
        return view('Auth.register'); // Pastikan path ini sesuai
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();

            // Redirect berdasarkan role yang ada di Database
            if (Str::lower((string) $user->role) === 'teacher' || Str::lower((string) $user->role) === 'super_admin') {
                return redirect()->route('teachers_dashboard');
            }

            return redirect()->route('students_course');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput();
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'], // Ini mencocokkan input dari form HTML
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:teacher,student'],
        ]);

        $user = User::create([
            'nama' => $validated['name'], // <-- PASTIKAN KEY-NYA 'nama' (sesuai DB), BUKAN 'name'
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        Auth::login($user);

        if (Str::lower((string) $user->role) === 'teacher') {
            return redirect()->route('teachers_dashboard');
        }

        return redirect()->route('students_course');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}