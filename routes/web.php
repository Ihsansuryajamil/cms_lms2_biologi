<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForumController;

// Route::get('/', function () {
//     return view('homepage');
// })->name('homepage');
Route::get('/', [DepanController::class, 'index'])->name('homepage');
Route::get('/history', function () {
    return view('history');
})->name('history');
Route::get('/Course/{id}', [DepanController::class, 'show'])->name('detail_course');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.get');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // Route::get('/Students/Course', function () {
    //     return view('Dashboard.Siswa.course');
    // })->name('students_course');
    Route::get('/Students/Course', [SiswaController::class, 'index'])->name('students_course');
    Route::get('/Students/Profil', [SiswaController::class, 'profileSettings'])->name('students_profile');
    Route::put('/Students/Profil/Update', [SiswaController::class, 'updateProfile'])->name('students_profile_update');
    Route::get('/Students/History', [SiswaController::class, 'history'])->name('students_history');
    
    Route::get('/Students/Course/{id}', [SiswaController::class, 'show'])->name('students_detail_course');
    Route::get('/Students/Course/{id}/Detail', [SiswaController::class, 'showSubTopic'])->name('students_detail_subtopik');
    Route::post('/Students/Course/Materi/{id}/Submit', [SiswaController::class, 'storeMateriSubmission'])->name('students_materi_submit');
    Route::post('/Students/Course/Tugas/{id}/Submit', [SiswaController::class, 'submitTugas'])->name('students_tugas_submit');
    // Route::get('/Students/Course/Quiz/Details', function () {
    //     return view('Dashboard.Siswa.quiz_input');
    // })->name('students_quiz_input');
    // Rute Ujian Sederhana (Tanpa AJAX)
    Route::post('/Students/Course/Quiz/{sub_topic_id}/Start', [SiswaController::class, 'startQuiz'])->name('students_quiz_start');
    Route::get('/Students/Course/Quiz/{attempt_id}/Play', [SiswaController::class, 'playQuiz'])->name('students_quiz_play');
    Route::post('/Students/Course/Quiz/{attempt_id}/Submit', [SiswaController::class, 'submitQuiz'])->name('students_quiz_submit');
    // Route::get('/Students/Print/Nama_File', function () {
    //     return view('Dashboard.Siswa.pdf');
    // })->name('students_pdf');
    Route::get('/Students/Print/{filename}', function ($filename) {
        return view('Dashboard.Siswa.pdf', compact('filename'));
    })->name('students_pdf');
    Route::get('/Students/Print-PDF/{filename}', function ($filename) {
        return view('Dashboard.Siswa.pdf_siswa', compact('filename'));
    })->name('students_uploud_pdf');
});

// Tambahkan Route Dummy untuk Guru jika belum ada, agar redirect tidak error
Route::middleware('auth')->group(function () {
    Route::get('/Teachers/Dashboard', function () {
        return view('Dashboard.Guru.dashboard'); // Sesuaikan dengan view Anda
    })->name('teachers_dashboard');
    // === ROUTES UNTUK USER MANAGEMENT (KHUSUS SUPER ADMIN) ===
    Route::prefix('Teachers/Users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('guru_user_management');

        Route::get('/Tambah', [UserController::class, 'create'])->name('guru_user_tambah');
        Route::post('/Store', [UserController::class, 'store'])->name('guru_user_store');

        Route::get('/{id}/Details', [UserController::class, 'edit'])->name('guru_user_detail');
        Route::put('/{id}', [UserController::class, 'update'])->name('guru_user_update');

        Route::delete('/{id}', [UserController::class, 'destroy'])->name('guru_user_destroy');
        Route::get('/{id}/History/Pembelajaran', [UserController::class, 'userHistoryPembelajaran'])->name('guru_user_history');
        // Route::get('/{id}/History/Pembelajaran/Details', function () {
        //     return view('Dashboard.Guru.UserManagement.user_detailHistoryPembelajaran');
        // })->name('guru_user_history_detail');
        Route::get('/{id}/History/Pembelajaran/{sub_topic_id}/{type}', [UserController::class, 'userHistoryPembelajaranDetail'])->name('guru_user_history_detail');
        Route::post('/History/Pembelajaran/Task/{id}/Grade', [UserController::class, 'updateTaskScore'])->name('guru_user_history_grade_task');
        Route::post('/History/Pembelajaran/Quiz/{id}/Grade', [UserController::class, 'updateQuizEssayScore'])->name('guru_user_history_grade_quiz');
    });
    Route::prefix('Teachers/Forum')->group(function () {
        Route::get('/', [ForumController::class, 'index'])->name('guru_forum_index');
    });
    Route::prefix('Teachers/Kelas')->group(function () {
        Route::get('/', [UserController::class, 'indexKelas'])->name('guru_class_all');
        
        Route::get('/Tambah', [UserController::class, 'createKelas'])->name('guru_kelas_tambah');
        Route::post('/Store', [UserController::class, 'storeKelas'])->name('guru_kelas_store');

        Route::get('/{id}/Details', [UserController::class, 'showKelas'])->name('guru_class_detail');
        
        Route::get('/{id}/Update', [UserController::class, 'editKelas'])->name('guru_class_update');
        Route::put('/{id}', [UserController::class, 'updateKelas'])->name('guru_class_update_put');
        Route::delete('/{id}', [UserController::class, 'destroyKelas'])->name('guru_class_destroy');
    });
    // === ROUTES UNTUK COURSE (MATERI) ===
    Route::prefix('Teachers/Materi')->group(function () {
        // Tampilkan semua materi
        Route::get('/', [CourseController::class, 'index'])->name('guru_course_all');
        
        // Form tambah materi
        Route::get('/Tambah', [CourseController::class, 'create'])->name('guru_course_tambah');
        
        // Proses simpan materi ke database
        Route::post('/Store', [CourseController::class, 'store'])->name('guru_course_store');
        
        // Detail materi (Wajib menggunakan parameter {id})
        Route::get('/Details/{id}', [CourseController::class, 'show'])->name('guru_course_detail');
        Route::get('/Details/{id}/Edit', [CourseController::class, 'edit'])->name('guru_course_edit');
        Route::put('/Update/{id}', [CourseController::class, 'update'])->name('guru_course_update');
        Route::delete('/Delete/{id}', [CourseController::class, 'destroy'])->name('guru_course_destroy');
        Route::post('/Details/{course_id}/Topik', [CourseController::class, 'storeTopic'])->name('guru_course_store_topik');
        Route::get('/Topik/{id}/Edit', [CourseController::class, 'editTopic'])->name('guru_course_edit_topik');
        Route::put('/Topik/{id}', [CourseController::class, 'updateTopic'])->name('guru_course_update_topik');
        Route::get('/Topik/{topic_id}/Sub-Topik/Tambah', [CourseController::class, 'createSubTopic'])->name('guru_subtopik_tambah');
        Route::post('/Topik/{topic_id}/Sub-Topik/Store', [CourseController::class, 'storeSubTopic'])->name('guru_subtopik_store');
        
        Route::get('/Sub-Topik/{id}/Edit', [CourseController::class, 'editSubTopic'])->name('guru_subtopik_edit');
        Route::put('/Sub-Topik/{id}', [CourseController::class, 'updateSubTopic'])->name('guru_subtopik_update');
        Route::delete('/Sub-Topik/{id}', [CourseController::class, 'destroySubTopic'])->name('guru_subtopik_destroy');

        Route::get('/Sub-Topik/{id}/Detail', [CourseController::class, 'showSubTopic'])->name('guru_topik_detail_materi');
    });
    
    Route::get('/Teachers/Pengaturan', [UserController::class, 'editWebsiteSettings'])->name('guru_pengaturan_website');
    Route::put('/Teachers/Pengaturan/Update', [UserController::class, 'updateWebsiteSettings'])->name('guru_pengaturan_website_update');
    Route::get('/Teachers/Profil/Settings', [UserController::class, 'profileSettings'])->name('guru_profile_setting');
    Route::put('/Teachers/Profil/Settings/Update', [UserController::class, 'updateProfile'])->name('guru_profile_update');
});
// Route::get('/Teachers/Materi/Sub-Topik/Detail', function () {
//     return view('Dashboard.Guru.Topik.sub_topik_detail');
// })->name('guru_topik_detail_materi');
// Route::get('/Teachers/Sub-Topik/Update', function () {
//     return view('Dashboard.Guru.Topik.sub_topik_update');
// })->name('guru_subtopik_update');
// Route::get('/Teachers/Materi/Details/Topik/Edit', function () {
//     return view('Dashboard.Guru.Course.course_updateTopik');
// })->name('guru_course_detail_update_topik');
// Route::get('/Teachers/Materi/Details/Edit', function () {
//     return view('Dashboard.Guru.Course.course_edit');
// })->name('guru_course_detail_edit');

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




// Route::get('/Teachers/Dashboard', function () {
//     return view('Dashboard.Guru.dashboard');
// })->name('teachers_dashboard');
// Route::get('/Teachers/Dashboard', function () {
//     return view('Dashboard.Guru.dashboard');
// })->name('teachers_dashboard');
// -----------------------------------------------------------
// Route::get('/Teachers/Materi', function () {
//     return view('Dashboard.Guru.Course.course_all');
// })->name('guru_course_all');
// Route::get('/Teachers/Materi/Tambah', function () {
//     return view('Dashboard.Guru.Course.course_tambah');
// })->name('guru_course_tambah');
// Route::get('/Teachers/Materi/Details', function () {
//     return view('Dashboard.Guru.Course.course_detail');
// })->name('guru_course_detail'); 
// Route::get('/Teachers/Materi/Details/Edit', function () {
//     return view('Dashboard.Guru.Course.course_edit');
// })->name('guru_course_detail_edit');
// Route::get('/Teachers/Materi/Details/Topik/Edit', function () {
//     return view('Dashboard.Guru.Course.course_updateTopik');
// })->name('guru_course_detail_update_topik');



Route::get('/Teachers/Topik/Materi', function () {
    return view('Dashboard.Guru.Topik.topik_edit_materi');
})->name('guru_topik_edit_materi');
Route::get('/Teachers/Topik/Quiz', function () {
    return view('Dashboard.Guru.Topik.topik_edit_quiz');
})->name('guru_topik_edit_quiz');
Route::get('/Teachers/Topik/Tugas', function () {
    return view('Dashboard.Guru.Topik.topik_edit_tugas');
})->name('guru_topik_edit_tugas');

// Route::get('/Teachers/Topik/Materi/Detail', function () {
//     return view('Dashboard.Guru.Topik.sub_topik_detail');
// })->name('guru_topik_detail_materi');
Route::get('/Teachers/Topik/Quiz/Detail', function () {
    return view('Dashboard.Guru.Topik.topik_detail_quiz');
})->name('guru_topik_detail_quiz');
Route::get('/Teachers/Topik/Tugas/Detail', function () {
    return view('Dashboard.Guru.Topik.topik_detail_tugas');
})->name('guru_topik_detail_tugas');

// Route::get('/Teachers/Topik/Tambah/Materi', function () {
//     return view('Dashboard.Guru.Topik.sub_topik_tambah');
// })->name('guru_subtopik_tambah');
Route::get('/Teachers/Topik/Tambah/Quiz', function () {
    return view('Dashboard.Guru.Topik.topik_tambah_quiz');
})->name('guru_topik_tambah_quiz');
Route::get('/Teachers/Topik/Tambah/Tugas', function () {
    return view('Dashboard.Guru.Topik.topik_tambah_tugas');
})->name('guru_topik_tambah_tugas');


Route::get('/Teachers/Notifikasi', function () {
    return view('Dashboard.Guru.notifikasi');
})->name('guru_notifikasi');

// Route::get('/Teachers/Users/Details', function () {
//     return view('Dashboard.Guru.UserManagement.user_detail');
// })->name('guru_user_detail');