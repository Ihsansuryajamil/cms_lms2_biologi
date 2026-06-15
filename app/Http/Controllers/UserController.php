<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KelasUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class UserController extends Controller
{
    // Menampilkan halaman manajemen user
    // Menampilkan halaman manajemen user
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
}