<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\Auth\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.get');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register.get');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
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
Route::get('/Students/Kelas/Materi', function () {
    return view('Dashboard.Siswa.Topik.detailsMateri');
})->name('students_details_materi');
Route::get('/Students/Kelas/Quiz', function () {
    return view('Dashboard.Siswa.Topik.detailsQuiz');
})->name('students_details_quiz');
Route::get('/Students/Kelas/Tugas', function () {
    return view('Dashboard.Siswa.Topik.detailsTugas');
})->name('students_details_tugas');
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




Route::get('/Teachers/Dashboard', function () {
    return view('Dashboard.Guru.dashboard');
})->name('teachers_dashboard');
Route::get('/Teachers/Dashboard', function () {
    return view('Dashboard.Guru.dashboard');
})->name('guru_dashboard');
Route::get('/Teachers/Kelas', function () {
    return view('Dashboard.Guru.Kelas.kelas_all');
})->name('guru_class_all');
Route::get('/Teachers/Kelas/Tambah', function () {
    return view('Dashboard.Guru.Kelas.kelas_tambah');
})->name('guru_kelas_tambah');
Route::get('/Teachers/Kelas/Details', function () {
    return view('Dashboard.Guru.Kelas.kelas_detail');
})->name('guru_class_detail');
Route::get('/Teachers/Kelas/Details/users', function () {
    return view('Dashboard.Guru.Kelas.kelas_detail_user');
})->name('guru_class_users');
Route::get('/Teachers/Kelas/Details/users/requests', function () {
    return view('Dashboard.Guru.Kelas.kelas_detail_user_request');
})->name('guru_class_user_request');
Route::get('/Teachers/Kelas/Details/discuss', function () {
    return view('Dashboard.Guru.Kelas.kelas_detail_discuss');
})->name('guru_class_discuss');
Route::get('/Teachers/Kelas/Details/edit', function () {
    return view('Dashboard.Guru.Kelas.kelas_edit');
})->name('guru_class_edit');

Route::get('/Teachers/Topik/Materi', function () {
    return view('Dashboard.Guru.Topik.topik_edit_materi');
})->name('guru_topik_edit_materi');
Route::get('/Teachers/Topik/Quiz', function () {
    return view('Dashboard.Guru.Topik.topik_edit_quiz');
})->name('guru_topik_edit_quiz');
Route::get('/Teachers/Topik/Tugas', function () {
    return view('Dashboard.Guru.Topik.topik_edit_tugas');
})->name('guru_topik_edit_tugas');

Route::get('/Teachers/Topik/Materi/Detail', function () {
    return view('Dashboard.Guru.Topik.topik_detail_materi');
})->name('guru_topik_detail_materi');
Route::get('/Teachers/Topik/Quiz/Detail', function () {
    return view('Dashboard.Guru.Topik.topik_detail_quiz');
})->name('guru_topik_detail_quiz');
Route::get('/Teachers/Topik/Tugas/Detail', function () {
    return view('Dashboard.Guru.Topik.topik_detail_tugas');
})->name('guru_topik_detail_tugas');

Route::get('/Teachers/Topik/Tambah/Materi', function () {
    return view('Dashboard.Guru.Topik.topik_tambah_materi');
})->name('guru_topik_tambah_materi');
Route::get('/Teachers/Topik/Tambah/Quiz', function () {
    return view('Dashboard.Guru.Topik.topik_tambah_quiz');
})->name('guru_topik_tambah_quiz');
Route::get('/Teachers/Topik/Tambah/Tugas', function () {
    return view('Dashboard.Guru.Topik.topik_tambah_tugas');
})->name('guru_topik_tambah_tugas');

Route::get('/Teachers/Users', function () {
    return view('Dashboard.Guru.UserManagement.user_management');
})->name('guru_user_management');


Route::get('/Teachers/Notifikasi', function () {
    return view('Dashboard.Guru.notifikasi');
})->name('guru_notifikasi');
Route::get('/Teachers/Profil', function () {
    return view('Dashboard.Guru.profile');
})->name('guru_profil');
Route::get('/Teachers/Profil/Settings', function () {
    return view('Dashboard.Guru.profile_setting');
})->name('guru_profile_setting');
Route::get('/Teachers/Users/Details', function () {
    return view('Dashboard.Guru.UserManagement.user_detail');
})->name('guru_user_detail');
Route::get('/Teachers/Pengaturan', function () {
    return view('Dashboard.Guru.pengaturan_website');
})->name('guru_pengaturan_website');