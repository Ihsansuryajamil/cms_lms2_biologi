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
class ForumController extends Controller
{
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

        return view('Dashboard.Guru.Forum.index', compact('users', 'classes'));
    }
}