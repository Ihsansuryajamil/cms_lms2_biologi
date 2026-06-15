<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Models\Course;
use App\Models\Topic;
use App\Models\SubTopic;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use App\Models\QuizStudentAnswer;
use App\Models\MateriSubmission;
use App\Models\TaskSubmission;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class SiswaController extends Controller
{
    public function index(Request $request)
    {
        // 1. Proteksi Role: Hanya pengguna dengan role 'student' yang bisa mengakses halaman ini
        if (Auth::user()->role !== 'student') {
            abort(403, 'Akses Ditolak. Halaman kursus pembelajaran ini hanya diperuntukkan bagi Siswa.');
        }

        // 2. Proteksi Status: Jika akun inactive, langsung kunci kueri (tidak mengambil data course demi efisiensi)
        if (Auth::user()->status === 'inactive') {
            $courses = collect(); // Mengirim koleksi kosong ke view
            return view('Dashboard.Siswa.course', compact('courses'));
        }

        // 3. Ambil parameter pencarian dari search bar form
        $search = $request->input('search');

        // Membangun query pencarian materi secara dinamis
        $query = Course::with(['pembuat', 'topics']);

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nama_course', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // Ambil data berdasarkan materi yang paling baru dirilis
        $courses = $query->latest()->get();

        return view('Dashboard.Siswa.course', compact('courses'));
    }

    public function show($id)
    {
        // Proteksi Lapis Kedua: Mencegah siswa inactive menembak URL detail materi secara langsung via address bar
        if (Auth::user()->role !== 'student') {
            abort(403, 'Akses Ditolak. Halaman kursus pembelajaran ini hanya diperuntukkan bagi Siswa.');
        }

        // 2. Proteksi Status: Jika akun inactive, langsung kunci kueri (tidak mengambil data course demi efisiensi)
        if (Auth::user()->status === 'inactive') {
            $courses = collect(); // Mengirim koleksi kosong ke view
            return view('Dashboard.Siswa.course', compact('courses'));
        }

        // Tarik data course, relasi pembuat, beserta topik dan sub-topik yang sudah diurutkan
        $course = Course::with([
            'pembuat',
            'topics' => function ($query) {
                $query->orderBy('urutan', 'asc');
            },
            'topics.subTopics' => function ($query) {
                // Menyaring sub-topik yang hanya berstatus 'publish' dan diurutkan secara asc
                $query->where('status', 'publish')
                      ->orderBy('urutan', 'asc');
            }
        ])->findOrFail($id); 

        return view('Dashboard.Siswa.detail_course', compact('course'));
    }
    public function showSubTopic($id)
    {
        // 1. Proteksi Role: Hanya pengguna dengan role 'student' yang boleh mengakses halaman ini
        if (Auth::user()->role !== 'student') {
            abort(403, 'Akses Ditolak. Halaman ini hanya diperuntukkan bagi Siswa.');
        }

        // 2. Tarik data sub-topik beserta seluruh relasi bab, materi, dan soal kuis terkait
        $subTopic = SubTopic::with(['topic.course', 'quizQuestions'])->findOrFail($id);
        if ($subTopic->status === 'un-publish') {
            abort(403, 'Akses Ditolak. Materi atau aktivitas pembelajaran ini belum diterbitkan oleh Guru Pengajar.');
        }

        // Tarik data pengerjaan kuis siswa yang sedang login (jika ada)
        $quizAttempt = QuizAttempt::where('sub_topic_id', $id)
                                    ->where('student_id', Auth::id())
                                    ->first();

        // ✨ TAMBAHAN BARU: Tarik rekam jejak pengisian materi siswa ini (jika ada)
        $materiSubmission = MateriSubmission::where('sub_topic_id', $id)
                                            ->where('student_id', Auth::id())
                                            ->first();
        $taskSubmission = TaskSubmission::where('sub_topic_id', $id)
                                            ->where('student_id', Auth::id())
                                            ->first();

        // Kirim variabel $materiSubmission ke dalam view
        return view('Dashboard.Siswa.detail_subtopik', compact('subTopic', 'quizAttempt', 'materiSubmission', 'taskSubmission'));
    }

    // ✨ FUNGSI BARU: Untuk menyimpan kiriman feedback pemahaman materi siswa
    public function storeMateriSubmission(Request $request, $sub_topic_id)
    {
        $request->validate([
            'catatan_siswa' => 'required|string|min:5',
            'status'        => 'required|in:belum_mengerti,sudah_mengerti,sangat_mengerti',
        ]);

        // Menggunakan updateOrCreate agar jika siswa ingin memperbarui statusnya, data tidak duplikat
        MateriSubmission::updateOrCreate(
            [
                'sub_topic_id' => $sub_topic_id,
                'student_id'   => Auth::id(),
            ],
            [
                'catatan_siswa' => $request->catatan_siswa,
                'status'        => $request->status,
            ]
        );

        return back()->with('success', 'Refleksi pemahaman materi berhasil dikirim ke Guru!');
    }
    public function submitTugas(Request $request,  $sub_topic_id)
    {
        if (Auth::user()->role !== 'student') abort(403);

        $request->validate([
            'jawaban_teks' => 'nullable|string',
            'link_jawaban' => 'nullable|url|max:255',
            'file_jawaban' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,png,jpg,jpeg|max:10240',
        ]);

        // Proteksi: Siswa minimal harus mengisi salah satu (teks, link, atau file)
        if (!$request->filled('jawaban_teks') && !$request->filled('link_jawaban') && !$request->hasFile('file_jawaban')) {
            return back()->withErrors(['error' => 'Gagal mengirim. Harap isi minimal salah satu jawaban (Teks, Link, atau lampirkan File).']);
        }

        $data = [
            'sub_topic_id' => $sub_topic_id,
            'student_id'   => Auth::id(),
            'jawaban_teks' => $request->jawaban_teks,
            'link_jawaban' => $request->link_jawaban,
            'status'       => 'terkirim', // Status default saat baru dikirim
        ];

        // Proses Upload File (jika siswa melampirkan file)
        if ($request->hasFile('file_jawaban')) {
            $file = $request->file('file_jawaban');
            // Format penamaan: waktu_idSiswa_namaAsliFile
            $filename = time() . '_' . Auth::id() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/tugas_submissions'), $filename);
            $data['file_jawaban'] = $filename;
        }

        // Simpan ke database (tugas_submissions)
        TaskSubmission::create($data);

        return back()->with('success', 'Berhasil! Jawaban tugas Anda telah terkirim dan menunggu penilaian Guru.');
    }
    public function startQuiz($sub_topic_id)
    {
        $studentId = Auth::id();

        // Cek apakah sudah pernah membuat sesi pengerjaan
        $existingAttempt = QuizAttempt::where('sub_topic_id', $sub_topic_id)
                                    ->where('student_id', $studentId)
                                    ->first();

        if ($existingAttempt) {
            if ($existingAttempt->status !== 'mengerjakan') {
                return back()->withErrors(['error' => 'Anda sudah mengumpulkan kuis ini sebelumnya!']);
            }
            return redirect()->route('students_quiz_play', $existingAttempt->id);
        }

        // Buat sesi baru jika belum pernah
        $newAttempt = QuizAttempt::create([
            'sub_topic_id' => $sub_topic_id,
            'student_id'   => $studentId,
            'total_nilai'  => 0,
            'status'       => 'mengerjakan',
            'started_at'   => now(),
        ]);

        return redirect()->route('students_quiz_play', $newAttempt->id);
    }

    public function playQuiz($attempt_id)
    {
        $attempt = QuizAttempt::with(['subTopic.quizQuestions'])->findOrFail($attempt_id);

        if ($attempt->student_id !== Auth::id() || $attempt->status !== 'mengerjakan') {
            return redirect()->route('students_detail_subtopik', $attempt->sub_topic_id);
        }

        // Ambal soal kuis (Bisa ditambah ->inRandomOrder() jika ingin diacak)
        $questions = QuizQuestion::where('sub_topic_id', $attempt->sub_topic_id)->get();

        return view('Dashboard.Siswa.quiz_input', compact('attempt', 'questions'));
    }

    public function submitQuiz(Request $request, $attempt_id)
    {
        $attempt = QuizAttempt::with('subTopic.quizQuestions')->findOrFail($attempt_id);
        if ($attempt->status !== 'mengerjakan') abort(403);

        $inputJawaban = $request->input('answers', []); // Menangkap array ['soal_id' => 'jawaban']
        $totalNilai = 0;
        $hasEssay = false;

        foreach ($attempt->subTopic->quizQuestions as $question) {
            $jawabanSiswa = $inputJawaban[$question->id] ?? null;
            $isCorrect = null;
            $nilaiDidapat = 0;

            if ($question->tipe === 'pg') {
                // Evaluasi otomatis jawaban PG
                if (!empty($jawabanSiswa) && strtolower($jawabanSiswa) === strtolower($question->kunci_jawaban_pg)) {
                    $isCorrect = true;
                    $nilaiDidapat = $question->bobot_nilai;
                    $totalNilai += $nilaiDidapat;
                } else {
                    $isCorrect = false;
                }
            } else {
                // Jika ada jenis soal essay, beri penanda
                $hasEssay = true;
            }

            // Simpan setiap rekam jawaban detail ke database
            QuizStudentAnswer::create([
                'quiz_attempt_id'  => $attempt->id,
                'quiz_question_id' => $question->id,
                'jawaban_siswa'    => $jawabanSiswa,
                'is_correct'       => $isCorrect,
                'nilai_didapat'    => $nilaiDidapat,
            ]);
        }

        // Tentukan status akhir berdasarkan isi tipe kuis (Hybrid/PG murni)
        $statusAkhir = $hasEssay ? 'menunggu_dinilai_manual' : 'selesai_auto';

        $attempt->update([
            'total_nilai' => $totalNilai,
            'status'      => $statusAkhir,
            'finished_at' => now(),
        ]);

        return redirect()->route('students_detail_subtopik', $attempt->sub_topic_id)
                        ->with('success', 'Kuis Anda berhasil dikumpulkan dan tercatat!');
    }
    public function history(Request $request)
    {
        if (Auth::user()->role !== 'student') {
            abort(403, 'Akses ilegal.');
        }

        $studentId = Auth::id();

        // 1. Tangkap Data Input Filter dari View
        $courseFilter = $request->input('course');
        $dateFilter   = $request->input('sort_date', 'newest'); // default terbaru
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
        $currentPage = Paginator::resolveCurrentPage() ?: 1;
        $perPage     = 10; // Menampilkan 10 baris data per halaman
        $currentPageItems = $mergedCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $historyCollection = new LengthAwarePaginator(
            $currentPageItems,
            $mergedCollection->count(),
            $perPage,
            $currentPage,
            [
                'path'  => Paginator::resolveCurrentPath(),
                'query' => $request->query() // Memastikan string filter tidak hilang saat klik next page
            ]
        );

        // Ambil semua daftar mata pelajaran asli untuk mengisi menu dropdown filter secara otomatis
        $coursesList = Course::orderBy('nama_course', 'asc')->get();

        return view('Dashboard.Siswa.history', compact('historyCollection', 'coursesList'));
    }
    
}