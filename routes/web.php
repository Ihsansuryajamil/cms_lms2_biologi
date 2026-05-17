<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('Auth.login');
})->name('login');
Route::get('/register', function () {
    return view('Auth.register');
})->name('register');
Route::get('/Students/Dashboard', function () {
    return view('Dashboard.Siswa.dashboard');
})->name('students_dashboard');
Route::get('/Students/Kelas', function () {
    return view('Dashboard.Siswa.Kelas.kelasAll');
})->name('students_kelas');
Route::get('/Students/Kelas/BelumDisetujui', function () {
    return view('Dashboard.Siswa.Kelas.kelasAll_belumSetuju');
})->name('students_kelas_belum_disetujui');
Route::get('/Students/Kelas/Details', function () {
    return view('Dashboard.Siswa.Kelas.kelasDetails');
})->name('students_kelas_details');
Route::get('/Students/Materi', function () {
    return view('Dashboard.Siswa.Topik.detailsMateri');
})->name('students_details_materi');
Route::get('/Students/Tugas', function () {
    return view('Dashboard.Siswa.tugas');
})->name('students_tugas');
Route::get('/Students/Nilai', function () {
    return view('Dashboard.Siswa.nilai');
})->name('students_nilai');
Route::get('/Students/Jadwal', function () {
    return view('Dashboard.Siswa.jadwal');
})->name('students_jadwal');
Route::get('/Students/Notifikasi', function () {
    return view('Dashboard.Siswa.notifikasi');
})->name('students_notifikasi');
Route::get('/Students/Profil', function () {
    return view('Dashboard.Siswa.profil');
})->name('students_profil');
Route::get('/Students/Profil/Settings', function () {
    return view('Dashboard.Siswa.profile_setting');
})->name('students_profile_setting');
