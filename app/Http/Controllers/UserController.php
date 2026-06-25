<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KelasUser;
use App\Models\SubTopic;
use App\Models\MateriSubmission;
use App\Models\TaskSubmission;
use App\Models\QuizAttempt;
use App\Models\QuizStudentAnswer;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class UserController extends Controller
{
    // Menampilkan halaman manajemen user
    // Menampilkan halaman manajemen user
    // ✨ FUNGSI BARU 1: Menampilkan halaman settings profil dengan data user yang sedang login
    public function profileSettings()
    {
        $user = Auth::user(); // Mengambil data akun yang sedang login saat ini
        return view('Dashboard.Guru.profile_setting', compact('user'));
    }

    // ✨ FUNGSI BARU 2: Memproses update profil mandiri milik guru/admin
    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id()); // Proteksi ID pencarian murni dari token login session
        $id = $user->id;

        $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $id,
            'no_telp' => 'nullable|string|max:20',
            'alamat'  => 'nullable|string',
            'xyz'     => 'required|string|min:6', 
            'nis'     => 'nullable|string|max:50|unique:users,nis,' . $id,
            'nip'     => 'nullable|string|max:50|unique:users,nip,' . $id,
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.unique'  => 'Alamat email tersebut sudah terdaftar di sistem. Silakan gunakan email lain!',
            'nis.unique'    => 'NIS / NIM tersebut sudah terdaftar di sistem.',
            'nip.unique'    => 'NIP tersebut sudah terdaftar di sistem.',
            'xyz.required'  => 'Password wajib diisi.',
            'xyz.min'       => 'Password minimal terdiri dari 6 karakter.',
        ]);

        $data = [
            'nama'    => $request->nama,
            'email'   => $request->email,
            'no_telp' => $request->no_telp,
            'alamat'  => $request->alamat,
            'xyz'     => $request->xyz, 
        ];

        // Simpan nomor induk dinamis sesuai field role yang diisi
        if ($user->role === 'student') {
            $data['nis'] = $request->nis;
        } else {
            $data['nip'] = $request->nip;
        }

        // Koreksi enkripsi password otomatis jika password diubah dari sebelumnya
        if ($request->xyz !== $user->xyz) {
            $data['password'] = bcrypt($request->xyz);
        }

        $user->update($data);

        return back()->with('success', 'Profil pribadi Anda berhasil diperbarui!');
    }
    public function index(Request $request)
    {
        // Proteksi: Hanya role 'super_admin' yang diizinkan mengakses halaman ini
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Akses Ditolak. Halaman ini hanya diperuntukkan bagi Super Admin.');
        }

        // Menangkap parameter pencarian dan filter dari view
        $search = $request->input('search');
        $role = $request->input('role');
        $status = $request->input('status');
        $kelas_id = $request->input('kelas_id'); // <-- TAMBAHKAN PENANGKAP FILTER KELAS

        // Membangun query secara dinamis dengan Eager Loading relation kelasJoined agar efisien
        $query = User::with('kelasJoined');

        // 1. Filter Pencarian (Berdasarkan nama atau email)
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // 2. Filter Role (Guru/Siswa/Super Admin)
        if (!empty($role)) {
            $query->where('role', $role);
        }

        // 3. Filter Status (Active/Inactive)
        if (!empty($status)) {
            $query->where('status', $status);
        }

        // 4. JAWABAN ANDA: Filter Berdasarkan Pilihan Dropdown Kelas
        if (!empty($kelas_id)) {
            $query->where('kelas_id', $kelas_id);
        }

        // PRIORITAS URUTAN: Akun baru + status 'inactive' nangkring di paling atas
        $users = $query->orderByRaw("CASE WHEN status = 'inactive' THEN 1 ELSE 2 END")
                       ->latest()
                       ->paginate(10);

        // Ambil data seluruh kelas dari database untuk disuplai ke dropdown filter halaman depan
        $classes = KelasUser::orderBy('nama_kelas', 'asc')->get();

        return view('Dashboard.Guru.UserManagement.user_management', compact('users', 'classes'));
    }
    public function edit($id)
    {
        if (Auth::user()->role !== 'super_admin') abort(403, 'Akses Ditolak.');
        
        $user = User::findOrFail($id);
        
        // JAWABAN ANDA: Tarik seluruh data kelas untuk disuplai ke dropdown view detail
        $classes = KelasUser::orderBy('nama_kelas', 'asc')->get();
        
        return view('Dashboard.Guru.UserManagement.user_detail', compact('user', 'classes'));
    }

    // 3. Memproses Update Data User
    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'super_admin') abort(403, 'Akses Ditolak.');
        
        $user = User::findOrFail($id);

        $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $id,
            'role'    => 'required|in:teacher,student,super_admin',
            'status'  => 'required|in:active,inactive',
            'nis'     => 'nullable|string|max:50|unique:users,nis,' . $id,
            'nip'     => 'nullable|string|max:50|unique:users,nip,' . $id,
            'no_telp' => 'nullable|string|max:20',
            'alamat'  => 'nullable|string',
            'xyz'     => 'required|string|min:6', 
            'kelas_id'=> 'nullable|exists:kelas_user,id', // <-- TAMBAHKAN VALIDASI KELAS ID
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.unique'  => 'Alamat email tersebut sudah terdaftar di sistem. Silakan gunakan email lain!',
            'nis.unique'    => 'NIS / NIM tersebut sudah terdaftar di sistem. Silakan gunakan nomor induk Anda yang benar!',
            'nip.unique'    => 'NIP tersebut sudah terdaftar di sistem. Silakan gunakan nomor induk pegawai yang benar!',
            'xyz.required'  => 'Password wajib diisi.',
            'xyz.min'       => 'Password minimal terdiri dari 6 karakter.',
        ]);

        $data = [
            'nama'    => $request->nama,
            'email'   => $request->email,
            'role'    => $request->role,
            'status'  => $request->status,
            'nis'     => $request->nis,
            'nip'     => $request->nip,
            'no_telp' => $request->no_telp,
            'alamat'  => $request->alamat,
            'xyz'     => $request->xyz, 
            'kelas_id'=> $request->kelas_id, // <-- MASUKKAN DATA KELAS ID BARU KE ARRAY SAVE
        ];

        if ($request->xyz !== $user->xyz) {
            $data['password'] = bcrypt($request->xyz);
        }

        $user->update($data);

        return redirect()->route('guru_user_management')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    // 4. Menghapus Akun User Secara Permanen
    public function destroy($id)
    {
        if (Auth::user()->role !== 'super_admin') abort(403, 'Akses Ditolak.');

        $user = User::findOrFail($id);

        // Keamanan tambahan: Mencegah Super Admin menghapus akunnya sendiri secara tidak sengaja
        if ($user->id === Auth::id()) {
            return back()->withErrors(['error' => 'Anda tidak diperbolehkan menghapus akun Anda sendiri yang sedang digunakan aktif!']);
        }

        $user->delete();

        return redirect()->route('guru_user_management')->with('success', 'Akun pengguna berhasil dihapus permanen!');
    }
    public function create()
    {
        if (Auth::user()->role !== 'super_admin') abort(403, 'Akses Ditolak.');
        
        return view('Dashboard.Guru.UserManagement.user_tambah');
    }

    // 5. Memproses Simpan User Baru ke Database
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'super_admin') abort(403, 'Akses Ditolak.');

        // 1. Validasi Input + Tambahan Aturan 'unique' untuk NIS dan NIP agar tidak crash
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:teacher,student,super_admin',
            'status'   => 'required|in:active,inactive',
            'nis'      => 'nullable|string|max:50|unique:users,nis', // Tambah filter unik NIS
            'nip'      => 'nullable|string|max:50|unique:users,nip', // Tambah filter unik NIP
        ], [
            // JAWABAN ANDA: Pesan kustom penanganan duplikasi data & field required
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.unique'  => 'Alamat email otomatis ini sudah pernah tergenerasi sebelumnya. Silakan coba generate ulang atau ubah variasi nama Anda!',
            'nis.unique'    => 'NIS / NIM tersebut sudah terdaftar di sistem. Silakan gunakan nomor induk Anda yang benar!',
            'nip.unique'    => 'NIP tersebut sudah terdaftar di sistem. Silakan gunakan nomor induk pegawai yang benar!',
        ]);

        // 2. Simpan User Baru ke Database
        User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => bcrypt($request['password']), // Tetap di-enkripsi menggunakan bcrypt untuk keamanan login
            'role'     => $request->role,
            'status'   => $request->status,
            'nis'      => $request->nis,
            'nip'      => $request->nip,
            'xyz'      => $request['password'], // <-- TAMBAHAN ANDA: Menyimpan password asli (raw) tanpa enkripsi ke kolom xyz
        ]);

        return redirect()->route('guru_user_management')->with('success', 'Akun pengguna baru berhasil ditambahkan!');
    }
    // Menampilkan halaman manajemen kelas
    public function indexKelas(Request $request)
    {
        // Proteksi: Hanya role 'super_admin' yang diizinkan mengakses halaman ini
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Akses Ditolak. Halaman ini hanya diperuntukkan bagi Super Admin.');
        }

        // Menangkap parameter pencarian dan filter tahun ajar dari view
        $search = $request->input('search');
        $tahun_ajar = $request->input('tahun_ajar');

        // Membangun query dengan Eager Loading agar kueri database efisien (anti N+1 Bug)
        $query = KelasUser::with(['guru', 'murid']);

        // 1. Filter Pencarian (Berdasarkan nama kelas atau deskripsi kelas)
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nama_kelas', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi_kelas', 'like', '%' . $search . '%');
            });
        }

        // 2. Filter Berdasarkan Tahun Ajar
        if (!empty($tahun_ajar)) {
            $query->where('tahun_ajar', $tahun_ajar);
        }

        // Eksekusi data dengan Pagination (10 baris per halaman)
        $classes = $query->latest()->paginate(10);

        // Mengambil daftar tahun ajar yang unik langsung dari DB untuk mengisi dropdown otomatis
        $list_tahun_ajar = KelasUser::select('tahun_ajar')->distinct()->pluck('tahun_ajar');

        return view('Dashboard.Guru.Kelas.kelas_management', compact('classes', 'list_tahun_ajar'));
    }
    public function createKelas()
    {
        if (Auth::user()->role !== 'super_admin') abort(403, 'Akses Ditolak.');

        // Mengambil data user yang memiliki peran sebagai guru atau super_admin untuk dipilih menjadi wali kelas
        $teachers = User::whereIn('role', ['teacher', 'super_admin'])->orderBy('nama', 'asc')->get();
        
        return view('Dashboard.Guru.Kelas.kelas_tambah', compact('teachers'));
    }

    // 7. Memproses Simpan Kelas Baru ke Database
    public function storeKelas(Request $request)
    {
        if (Auth::user()->role !== 'super_admin') abort(403, 'Akses Ditolak.');

        // Validasi data inputan kelas sesuai struktur tabel kelas_user Anda
        $request->validate([
            'nama_kelas'      => 'required|string|max:150',
            'teacher_id'      => 'required|exists:users,id', // Memastikan ID guru pembuat ada di tabel users
            'tahun_ajar'      => 'required|string|max:50',
            'deskripsi_kelas' => 'nullable|string',
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'teacher_id.required' => 'Guru pengajar / wali kelas wajib dipilih.',
            'teacher_id.exists'   => 'Guru yang dipilih tidak valid atau tidak terdaftar.',
            'tahun_ajar.required' => 'Tahun ajar wajib diisi (Contoh: 2025/2026).',
        ]);

        // Menyimpan data ke tabel kelas_user
        KelasUser::create([
            'nama_kelas'      => $request->nama_kelas,
            'teacher_id'      => $request->teacher_id,
            'tahun_ajar'      => $request->tahun_ajar,
            'deskripsi_kelas' => $request->deskripsi_kelas,
        ]);

        // Alihkan kembali ke halaman manajemen kelas dengan pesan sukses
        return redirect()->route('guru_class_all')->with('success', 'Kelas baru berhasil dibuat dan ditambahkan ke dalam sistem!');
    }
    // 8. Menampilkan Seluruh Anggota Pengguna di Kelas Tertentu
    public function showKelas(Request $request, $id)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Akses Ditolak. Halaman ini hanya diperuntukkan bagi Super Admin.');
        }

        // Cari detail informasi kelas berdasarkan ID
        $class = KelasUser::with('guru')->findOrFail($id);

        $search = $request->input('search');
        $role = $request->input('role');
        $status = $request->input('status');

        // Mengunci query: Hanya menarik user yang terdaftar di kelas_id ini
        $query = User::where('kelas_id', $id);

        // 1. Filter Pencarian Anggota Kelas (Berdasarkan nama atau email)
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // 2. Filter Peran Anggota Kelas
        if (!empty($role)) {
            $query->where('role', $role);
        }

        // 3. Filter Status Akun Anggota Kelas
        if (!empty($status)) {
            $query->where('status', $status);
        }

        // Paginate hasil pencarian anggota kelas (10 per halaman)
        $users = $query->latest()->paginate(10);

        return view('Dashboard.Guru.Kelas.kelas_detail', compact('class', 'users'));
    }
    // 9. Menampilkan Form Edit/Update Data Kelas
    public function editKelas($id)
    {
        if (Auth::user()->role !== 'super_admin') abort(403, 'Akses Ditolak.');

        $class = KelasUser::findOrFail($id);
        
        // Mengambil daftar guru untuk dropdown penugasan wali kelas
        $teachers = User::whereIn('role', ['teacher', 'super_admin'])->orderBy('nama', 'asc')->get();

        return view('Dashboard.Guru.Kelas.kelas_update', compact('class', 'teachers'));
    }

    // 10. Memproses Pembaruan Data Kelas di Database
    public function updateKelas(Request $request, $id)
    {
        if (Auth::user()->role !== 'super_admin') abort(403, 'Akses Ditolak.');

        $class = KelasUser::findOrFail($id);

        $request->validate([
            'nama_kelas'      => 'required|string|max:150',
            'teacher_id'      => 'required|exists:users,id',
            'tahun_ajar'      => 'required|string|max:50',
            'deskripsi_kelas' => 'nullable|string',
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'teacher_id.required' => 'Guru pengajar / wali kelas wajib dipilih.',
            'tahun_ajar.required' => 'Tahun ajaran wajib dipilih.',
        ]);

        $class->update([
            'nama_kelas'      => $request->nama_kelas,
            'teacher_id'      => $request->teacher_id,
            'tahun_ajar'      => $request->tahun_ajar,
            'deskripsi_kelas' => $request->deskripsi_kelas,
        ]);

        return redirect()->route('guru_class_all')->with('success', 'Informasi data kelas berhasil diperbarui!');
    }

    // 11. Menghapus Kelas Secara Permanen (Akun Murid Aman & Otomatis Ter-set NULL)
    public function destroyKelas($id)
    {
        if (Auth::user()->role !== 'super_admin') abort(403, 'Akses Ditolak.');

        $class = KelasUser::findOrFail($id);
        
        // Eksekusi hapus kelas. Murid di dalamnya aman berkat foreign key constraint 'ON DELETE SET NULL'
        $class->delete();

        return redirect()->route('guru_class_all')->with('success', 'Kelas berhasil dihapus permanen! Semua murid di dalam kelas tersebut kini berstatus Tanpa Kelas.');
    }

    public function userHistoryPembelajaran(Request $request, $id)
    {
        // ✨ PERBAIKAN SINTAKS ROLE: Izinkan super_admin dan teacher mengakses halaman ini
        if (!in_array(Auth::user()->role, ['super_admin', 'teacher'])) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin melihat halaman ini.');
        }

        // ✨ AMBIL DATA SISWA YANG AKAN DIPERIKSA (Bukan ID Guru yang sedang login)
        $student = User::findOrFail($id);
        $studentId = $student->id;

        // 1. Tangkap Data Input Filter dari View
        $courseFilter = $request->input('course');
        $dateFilter   = $request->input('sort_date', 'newest');
        $typeFilter   = $request->input('activity_type');

        // 2. Query Riwayat Feedback Materi
        $materiQuery = \App\Models\MateriSubmission::with('subTopic.topic.course')->where('student_id', $studentId);
        if (!empty($courseFilter)) {
            $materiQuery->whereHas('subTopic.topic.course', function($q) use ($courseFilter) {
                $q->where('nama_course', $courseFilter);
            });
        }
        $materiData = collect();
        if (empty($typeFilter) || $typeFilter === 'materi') {
            $materiData = $materiQuery->get()->map(function ($item) {
                $item->activity_type = 'materi';
                $item->history_date  = $item->created_at;
                return $item;
            });
        }

        // 3. Query Riwayat Pengumpulan Tugas
        $tugasQuery = \App\Models\TaskSubmission::with('subTopic.topic.course')->where('student_id', $studentId);
        if (!empty($courseFilter)) {
            $tugasQuery->whereHas('subTopic.topic.course', function($q) use ($courseFilter) {
                $q->where('nama_course', $courseFilter);
            });
        }
        $tugasData = collect();
        if (empty($typeFilter) || $typeFilter === 'tugas') {
            $tugasData = $tugasQuery->get()->map(function ($item) {
                $item->activity_type = 'tugas';
                $item->history_date  = $item->created_at;
                return $item;
            });
        }

        // 4. Query Riwayat Penyelesaian Kuis
        $quizQuery = \App\Models\QuizAttempt::with(['subTopic.topic.course', 'subTopic.quizQuestions'])
            ->where('student_id', $studentId)
            ->where('status', '!=', 'mengerjakan');
        if (!empty($courseFilter)) {
            $quizQuery->whereHas('subTopic.topic.course', function($q) use ($courseFilter) {
                $q->where('nama_course', $courseFilter);
            });
        }
        $quizData = collect();
        if (empty($typeFilter) || $typeFilter === 'quiz' || $typeFilter === 'ujian') {
            $quizData = $quizQuery->get()->map(function ($item) {
                $hasEssay = $item->subTopic->quizQuestions->where('tipe', 'essay')->count() > 0;
                $item->activity_type = $hasEssay ? 'quiz_essay' : 'quiz_pg';
                $item->history_date  = $item->finished_at ?? $item->updated_at;
                return $item;
            });
        }

        // 5. Gabungkan Seluruh Koleksi Data
        $mergedCollection = collect()
            ->concat($materiData)
            ->concat($tugasData)
            ->concat($quizData);

        // 6. Jalankan Logika Sorting Tanggal
        if ($dateFilter === 'oldest') {
            $mergedCollection = $mergedCollection->sortBy('history_date');
        } else {
            $mergedCollection = $mergedCollection->sortByDesc('history_date');
        }

        // 7. IMPLEMENTASI PAGINASI MANUAL UNTUK LARAVEL COLLECTION
        $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1;
        $perPage     = 10;
        $currentPageItems = $mergedCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $historyCollection = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageItems,
            $mergedCollection->count(),
            $perPage,
            $currentPage,
            [
                'path'  => \Illuminate\Pagination\Paginator::resolveCurrentPath(),
                'query' => $request->query()
            ]
        );

        // Ambil semua daftar mata pelajaran asli untuk mengisi menu dropdown filter secara otomatis
        $coursesList = \App\Models\Course::orderBy('nama_course', 'asc')->get();

        // Sertakan variabel $student agar nama siswa bisa dimunculkan di judul halaman guru
        return view('Dashboard.Guru.UserManagement.user_historyPembelajaran', compact('historyCollection', 'coursesList', 'student'));
    }
    public function userHistoryPembelajaranDetail($id, $sub_topic_id, $type)
    {
        // 1. Proteksi Akses Hak Jabatan
        if (!in_array(Auth::user()->role, ['super_admin', 'teacher'])) {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin melihat halaman ini.');
        }

        // 2. Ambil data inti siswa dan sub-topik pembelajaran
        $student = User::findOrFail($id);
        $subTopic = SubTopic::with(['topic.course'])->findOrFail($sub_topic_id);

        // 3. Inisialisasi variabel penampung data respons pengerjaan
        $materiSubmission = null;
        $taskSubmission   = null;
        $quizAttempt      = null;
        $quizAnswers      = collect();

        // 4. Tarik data secara spesifik sesuai jenis aktivitas yang dipilih
        if ($type === 'materi') {
            $materiSubmission = MateriSubmission::where('student_id', $id)
                                                ->where('sub_topic_id', $sub_topic_id)
                                                ->firstOrFail();
        } 
        elseif ($type === 'tugas') {
            $taskSubmission = TaskSubmission::where('student_id', $id)
                                            ->where('sub_topic_id', $sub_topic_id)
                                            ->firstOrFail();
        } 
        elseif (in_array($type, ['quiz_pg', 'quiz_essay'])) {
            $quizAttempt = QuizAttempt::where('student_id', $id)
                                    ->where('sub_topic_id', $sub_topic_id)
                                    ->where('status', '!=', 'mengerjakan')
                                    ->firstOrFail();

            // Ambal seluruh butir soal kuis beserta detail rekam jawaban milik siswa tersebut
            $quizAnswers = QuizStudentAnswer::with('question')
                                            ->where('quiz_attempt_id', $quizAttempt->id)
                                            ->get();
        }

        // 5. Kirim seluruh paket data ke view detail
        return view('Dashboard.Guru.UserManagement.user_detailHistoryPembelajaran', compact(
            'student', 'subTopic', 'type', 'materiSubmission', 'taskSubmission', 'quizAttempt', 'quizAnswers'
        ));
    }
    // ✨ FUNGSI ACTION 1: Memproses Inputan Nilai & Catatan Tugas Siswa
    public function updateTaskScore(Request $request, $id)
    {
        if (!in_array(Auth::user()->role, ['super_admin', 'teacher'])) abort(403);

        $request->validate([
            'nilai'        => 'required|integer|min:0|max:100',
            'catatan_guru' => 'nullable|string',
        ]);

        $task = \App\Models\TaskSubmission::findOrFail($id);
        $task->update([
            'nilai'        => $request->nilai,
            'catatan_guru' => $request->catatan_guru,
            'status'       => 'dinilai', // Ubah status enum dari 'terkirim' ke 'dinilai'
        ]);

        return redirect()->route('guru_user_history', $task->student_id)
                        ->with('success', 'Berhasil memberikan penilaian dan umpan balik tugas siswa!');
    }

    // ✨ FUNGSI ACTION 2: Memproses Inputan Nilai Lembar Essay Kuis Siswa
    public function updateQuizEssayScore(Request $request, $id)
    {
        if (!in_array(Auth::user()->role, ['super_admin', 'teacher'])) abort(403);

        $attempt = \App\Models\QuizAttempt::findOrFail($id);
        $inputScores = $request->input('essay_scores', []); // Menangkap array [answer_id => nilai]

        foreach ($inputScores as $answerId => $score) {
            $answer = \App\Models\QuizStudentAnswer::where('quiz_attempt_id', $attempt->id)
                                                ->findOrFail($answerId);
            
            // Update skor per butir soal essay
            $answer->update([
                'nilai_didapat' => $score,
                'is_correct'    => $score > 0 ? 1 : 0, // Jika mendapat poin, otomatis set benar
            ]);
        }

        // Hitung ulang akumulasi total_nilai seluruh soal (PG + Essay yang baru dinilai)
        $totalNilaiSemuaSoal = \App\Models\QuizStudentAnswer::where('quiz_attempt_id', $attempt->id)->sum('nilai_didapat');

        $attempt->update([
            'total_nilai' => $totalNilaiSemuaSoal,
            'status'      => 'dinilai_lengkap', // Ubah status ujian sesi ini menjadi dinilai lengkap
        ]);

        return redirect()->route('guru_user_history', $attempt->student_id)
                        ->with('success', 'Berhasil memperbarui akumulasi nilai kuis essay siswa!');
    }
    public function editWebsiteSettings()
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Akses Ditolak. Halaman ini hanya diperuntukkan bagi Super Admin.');
        }

        // Ambil data ID 1, jika tidak ada otomatis buat baru berdasarkan default
        $settings = WebsiteSetting::firstOrCreate(['id' => 1]);

        return view('Dashboard.Guru.pengaturan_website', compact('settings'));
    }

    // =========================================================================
    // 2. Memproses Update Tampilan & Kompresi File Gambar ke WebP
    // =========================================================================
    public function updateWebsiteSettings(Request $request)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Akses Ditolak.');
        }

        $settings = WebsiteSetting::firstOrCreate(['id' => 1]);

        $request->validate([
            'nama_website'   => 'required|string|max:150',
            'nama_institusi' => 'required|string|max:150',
            'tagline'        => 'nullable|string|max:255',
            'logo'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'favicon'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'nama_website'   => $request->nama_website,
            'nama_institusi' => $request->nama_institusi,
            'tagline'        => $request->tagline,
        ];

        // Folder penyimpanan aset tampilan website
        $destinationPath = public_path('image/website');

        // Handling Upload & Kompresi LOGO WEBSITE
        if ($request->hasFile('logo')) {
            // Hapus logo WebP lama di server jika ada berkasnya
            if ($settings->logo && File::exists($destinationPath . '/' . $settings->logo)) {
                @unlink($destinationPath . '/' . $settings->logo);
            }
            $data['logo'] = $this->processImage($request->file('logo'), $destinationPath);
        }

        // Handling Upload & Kompresi FAVICON WEBSITE
        if ($request->hasFile('favicon')) {
            // Hapus favicon WebP lama di server jika ada berkasnya
            if ($settings->favicon && File::exists($destinationPath . '/' . $settings->favicon)) {
                @unlink($destinationPath . '/' . $settings->favicon);
            }
            $data['favicon'] = $this->processImage($request->file('favicon'), $destinationPath);
        }

        $settings->update($data);

        return back()->with('success', 'Konfigurasi identitas visual website berhasil diperbarui!');
    }

    // =========================================================================
    // HELPER: Image Compression to WebP (Maks resolusi lebar 854px)
    // =========================================================================
    private function processImage($file, $destinationPath)
    {
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $filename = uniqid() . '_' . Str::random(8) . '.webp';
        $extension = strtolower($file->getClientOriginalExtension());
        $img = null;

        try {
            switch ($extension) {
                case 'jpeg':
                case 'jpg':
                    $img = @imagecreatefromjpeg($file->getRealPath());
                    break;
                case 'png':
                    $img = @imagecreatefrompng($file->getRealPath());
                    if ($img) {
                        imagepalettetotruecolor($img);
                        imagealphablending($img, true);
                        imagesavealpha($img, false);
                    }
                    break;
                case 'webp':
                    $img = @imagecreatefromwebp($file->getRealPath());
                    break;
                default:
                    $string = file_get_contents($file->getRealPath());
                    $img = @imagecreatefromstring($string);
                    break;
            }
        } catch (\Exception $e) {
            return time() . '.webp'; 
        }

        if (!$img) {
            return time() . '.webp';
        }

        $maxWidth = 854; 
        $widthOrig = imagesx($img);
        $heightOrig = imagesy($img);

        if ($widthOrig > $maxWidth) {
            $ratio = $maxWidth / $widthOrig;
            $newWidth = $maxWidth;
            $newHeight = $heightOrig * $ratio;

            $newImg = imagecreatetruecolor($newWidth, $newHeight);
            imagealphablending($newImg, false);
            imagesavealpha($newImg, true);
            
            imagecopyresampled($newImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $widthOrig, $heightOrig);
            imagedestroy($img);
            $img = $newImg;     
        }

        imagewebp($img, $destinationPath . '/' . $filename, 75);
        imagedestroy($img);

        return $filename;
    }
}