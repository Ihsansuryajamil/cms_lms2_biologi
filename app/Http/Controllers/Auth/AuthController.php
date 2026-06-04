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
        // 1. Validasi field dengan menambahkan aturan 'unique:users,nis'
        $validated = $request->validate([
            'nama'     => ['required', 'string', 'max:255'],
            'nis'      => ['required', 'string', 'max:50', 'unique:users,nis'], // <-- Tambahkan unique:nama_tabel,nama_kolom
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'], 
        ], [
            // JAWABAN ANDA: Pesan kustom agar tampil cantik di view saat data kembar
            'nis.unique'   => 'NIS / NIM tersebut sudah terdaftar di sistem. Silakan gunakan nomor induk Anda yang benar!',
            'email.unique' => 'Alamat email otomatis ini sudah pernah tergenerasi sebelumnya. Silakan coba generate ulang atau ubah variasi nama Anda!',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nis.required'  => 'NIS / NIM wajib diisi.',
        ]);

        // 2. Simpan ke database (Sistem hanya berjalan ke sini jika lolos validasi di atas)
        User::create([
            'nama'     => $validated['nama'], 
            'nis'      => $validated['nis'],
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']), 
            'role'     => 'student',  
            'status'   => 'inactive', 
            'xyz'      => $validated['password'], 
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Akun Anda dinonaktifkan sementara. Silakan hubungi Administrator untuk proses aktivasi.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}