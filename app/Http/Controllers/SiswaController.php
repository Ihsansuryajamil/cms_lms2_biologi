<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Topic;
use App\Models\SubTopic;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use App\Models\QuizStudentAnswer;
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
                $query->orderBy('urutan', 'asc');
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

        // ✨ TAMBAHAN: Tarik data pengerjaan kuis siswa yang sedang login (jika ada)
        $quizAttempt = QuizAttempt::where('sub_topic_id', $id)
                                ->where('student_id', Auth::id())
                                ->first();

        // Kirim variabel $quizAttempt ke dalam view
        return view('Dashboard.Siswa.detail_subtopik', compact('subTopic', 'quizAttempt'));
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
    
}