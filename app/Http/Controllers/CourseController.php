<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
use App\Models\SubTopic;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    // 1. Menampilkan Semua Materi milik Guru tersebut
    public function index()
    {
        // Ambil kelas yang HANYA dibuat oleh guru yang sedang login
        $courses = Course::where('user_id', Auth::id())->latest()->get();
        
        return view('Dashboard.Guru.Course.course_all', compact('courses'));
    }

    // 2. Menampilkan Form Tambah Materi
    public function create()
    {
        return view('Dashboard.Guru.Course.course_tambah');
    }

    // 3. Menyimpan Materi ke Database
    public function store(Request $request)
    {
        // 1. Validasi Input (termasuk avatar)
        $request->validate([
            'nama_course' => 'required|string|max:150',
            'link_video'  => 'nullable|url|max:255',
            'deskripsi'   => 'required|string',
            'persyaratan' => 'nullable|string',
            'avatar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10120', // Maks 10MB sebelum di-compress
        ]);

        $data = [
            'nama_course' => $request->nama_course,
            'user_id'     => Auth::id(),
            'kode_course' => strtoupper(Str::random(8)),
            'link_video'  => $request->link_video,
            'deskripsi'   => $request->deskripsi,
            'persyaratan' => $request->persyaratan ?? '-',
        ];

        // 2. Handle Upload & Compress Avatar
        if ($request->hasFile('avatar')) {
            // Path menggunakan public_path() standar Laravel
            $destinationPath = public_path('image/course/avatar');
            $file = $request->file('avatar');
            
            // Panggil helper kompresi
            $filename = $this->processImage($file, $destinationPath);
            $data['avatar'] = $filename; // Hanya simpan nama filenya di DB
        }

        // 3. Simpan ke Database
        Course::create($data);

        return redirect()->route('guru_course_all')->with('success', 'Materi berhasil ditambahkan!');
    }

    // 4. Menampilkan Detail 1 Materi (Beserta list Topic-nya nanti)
    public function show($id)
    {
        // Gunakan fungsi closure di dalam 'with' untuk memaksa pengurutan dari terkecil ke terbesar
        $course = Course::with([
            'topics' => function ($query) {
                $query->orderBy('urutan', 'asc');
            },
            'topics.subTopics' => function ($query) {
                $query->orderBy('urutan', 'asc');
            }
        ])->findOrFail($id); 

        return view('Dashboard.Guru.Course.course_detail', compact('course'));
    }
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        
        // Validasi pengaman: Pastikan hanya guru pembuat yang bisa mengeditnya
        if ($course->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengubah course ini.');
        }

        return view('Dashboard.Guru.Course.course_edit', compact('course'));
    }

    // 2. Memproses Update Data Course ke Database
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        
        if ($course->user_id !== Auth::id()) {
            abort(403);
        }

        // Validasi Input
        $request->validate([
            'nama_course' => 'required|string|max:150',
            'link_video'  => 'nullable|url|max:255',
            'deskripsi'   => 'required|string',
            'persyaratan' => 'nullable|string',
            'avatar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10120',
        ]);

        $data = [
            'nama_course' => $request->nama_course,
            'link_video'  => $request->link_video,
            'deskripsi'   => $request->deskripsi,
            'persyaratan' => $request->persyaratan ?? '-',
        ];

        // Jika user mengunggah file gambar baru
        if ($request->hasFile('avatar')) {
            $destinationPath = public_path('image/course/avatar');
            
            // Hapus file gambar lama dari direktori lokal jika ada
            if ($course->avatar && File::exists($destinationPath . '/' . $course->avatar)) {
                File::delete($destinationPath . '/' . $course->avatar);
            }

            // Kompresi dan simpan gambar baru menggunakan helper processImage bawaan Anda
            $filename = $this->processImage($request->file('avatar'), $destinationPath);
            $data['avatar'] = $filename;
        }

        // Perbarui data di database
        $course->update($data);

        return redirect()->route('guru_course_all')->with('success', 'Materi/Course berhasil diperbarui!');
    }

    // 3. Memproses Penghapusan Course
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        
        if ($course->user_id !== Auth::id()) {
            abort(403);
        }

        // Hapus file fisik gambar cover dari server
        if ($course->avatar) {
            $avatarPath = public_path('image/course/avatar/' . $course->avatar);
            if (File::exists($avatarPath)) {
                File::delete($avatarPath);
            }
        }

        // Hapus data course dari database
        $course->delete();

        return redirect()->route('guru_course_all')->with('success', 'Course berhasil dihapus secara permanen!');
    }
    public function storeTopic(Request $request, $course_id)
    {
        $course = Course::findOrFail($course_id);
        
        // Pastikan hanya pemilik course yang bisa menambah topik
        if ($course->user_id !== Auth::id()) abort(403);

        $request->validate([
            'nama_topik' => 'required|string|max:150',
            'durasi_pembelajaran' => 'required|integer|min:1',
        ]);

        // Cari urutan terakhir, lalu tambah 1
        $urutanTerakhir = Topic::where('course_id', $course_id)->max('urutan');
        $urutanBaru = $urutanTerakhir ? $urutanTerakhir + 1 : 1;

        Topic::create([
            'course_id' => $course_id,
            'nama_topic' => $request->nama_topik,
            'durasi_pembelajaran' => $request->durasi_pembelajaran,
            'urutan' => $urutanBaru,
        ]);

        return redirect()->back()->with('success', 'Topik baru berhasil ditambahkan!');
    }
    public function editTopic($id)
    {
        $topic = Topic::findOrFail($id);
        
        // Amankan agar hanya pemilik course yang bisa mengedit
        if ($topic->course->user_id !== Auth::id()) abort(403);

        $course = $topic->course;

        return view('Dashboard.Guru.Course.course_updateTopik', compact('topic', 'course'));
    }

    // 3. Memproses Update Data Topik
    public function updateTopic(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);
        if ($topic->course->user_id !== Auth::id()) abort(403);

        $request->validate([
            'nama_topik' => 'required|string|max:150',
            'durasi_pembelajaran' => 'required|integer|min:1',
        ]);

        $topic->update([
            'nama_topik' => $request->nama_topik,
            'durasi_pembelajaran' => $request->durasi_pembelajaran,
        ]);

        return redirect()->route('guru_course_detail', $topic->course_id)->with('success', 'Topik berhasil diperbarui!');
    }
    // =========================================================================
    // KELOLA SUB-TOPIK (MATERI, KUIS, TUGAS)
    // =========================================================================

    // 1. Menampilkan Halaman Tambah Sub-Topik
    public function createSubTopic($topic_id)
    {
        $topic = Topic::findOrFail($topic_id);
        
        // Proteksi: Hanya guru pembuat course yang bisa menambah
        if ($topic->course->user_id !== Auth::id()) abort(403);

        return view('Dashboard.Guru.Topik.sub_topik_tambah', compact('topic'));
    }

    // 2. Memproses Penyimpanan Sub-Topik
    public function storeSubTopic(Request $request, $topic_id)
    {
        $topic = Topic::findOrFail($topic_id);
        if ($topic->course->user_id !== Auth::id()) abort(403);

        $request->validate([
            'judul'     => 'required|string|max:150',
            'jenis'     => 'required|in:materi,quiz,tugas',
            'status'    => 'required|in:publish,un-publish',
            'deskripsi' => 'nullable|string',
            'link_1'    => 'nullable|url|max:255',
            'link_2'    => 'nullable|url|max:255',
            'link_3'    => 'nullable|url|max:255',
            'file_1'    => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,png,jpg,jpeg|max:10240',
            'file_2'    => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,png,jpg,jpeg|max:10240',
            'file_3'    => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,png,jpg,jpeg|max:10240',
        ]);

        $data = [
            'topic_id'  => $topic_id,
            'judul'     => $request->judul,
            'jenis'     => $request->jenis,
            'status'    => $request->status,
            'deskripsi' => $request->deskripsi,
            'link_1'    => $request->link_1,
            'link_2'    => $request->link_2,
            'link_3'    => $request->link_3,
        ];

        $urutanTerakhir = SubTopic::where('topic_id', $topic_id)->max('urutan');
        $data['urutan'] = $urutanTerakhir ? $urutanTerakhir + 1 : 1;

        // Proses Upload File Dokumen
        for ($i = 1; $i <= 3; $i++) {
            $fileKey = 'file_' . $i;
            
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $filename = time() . '_' . $i . '_' . Str::slug($request->judul) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/sub_topics'), $filename);
                $data[$fileKey] = $filename;
            }
        }

        // Simpan Data Utama
        $subTopic = SubTopic::create($data); // PENTING: Disimpan ke variabel $subTopic untuk memanggil ID

        // ====================================================================
        // LOGIKA PENYIMPANAN DATA KUIS BERDASARKAN ARRAY
        // ====================================================================
        if ($request->jenis === 'quiz') {
            
            // 1. Simpan Soal Pilihan Ganda (Jika ada form pg yang diisi)
            if ($request->has('pg_pertanyaan')) {
                // A. Hitung dulu berapa soal PG yang diisi (tidak kosong)
                $validPgCount = 0;
                foreach ($request->pg_pertanyaan as $q) {
                    if (!empty(trim($q))) $validPgCount++;
                }

                // B. Kalkulasi pembagian 100 poin (dibulatkan 2 angka di belakang koma)
                $bobotOtomatis = $validPgCount > 0 ? round(100 / $validPgCount, 2) : 0;

                // C. Simpan ke database dengan bobot dinamis
                foreach ($request->pg_pertanyaan as $key => $pertanyaan) {
                    if (!empty(trim($pertanyaan))) { 
                        \App\Models\QuizQuestion::create([
                            'sub_topic_id'     => $subTopic->id,
                            'tipe'             => 'pg',
                            'pertanyaan'       => $pertanyaan,
                            'opsi_a'           => $request->pg_opsi_a[$key] ?? '-',
                            'opsi_b'           => $request->pg_opsi_b[$key] ?? '-',
                            'opsi_c'           => $request->pg_opsi_c[$key] ?? '-',
                            'opsi_d'           => $request->pg_opsi_d[$key] ?? '-',
                            'kunci_jawaban_pg' => strtolower($request->pg_kunci[$key] ?? 'a'),
                            'bobot_nilai'      => $bobotOtomatis, // <-- Masukkan hasil kalkulasi
                        ]);
                    }
                }
            }

            // 2. Simpan Soal Essay (Jika ada form essay yang diisi)
            if ($request->has('essay_pertanyaan')) {
                foreach ($request->essay_pertanyaan as $key => $pertanyaan) {
                    if (!empty($pertanyaan)) {
                        \App\Models\QuizQuestion::create([
                            'sub_topic_id' => $subTopic->id,
                            'tipe'         => 'essay',
                            'pertanyaan'   => $pertanyaan,
                            'bobot_nilai'  => $request->essay_bobot[$key] ?? 10,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('guru_course_detail', $topic->course_id)
                         ->with('success', 'Sub-Topik (' . ucfirst($request->jenis) . ') berhasil ditambahkan!');
    }
    // 3. Menampilkan Halaman Edit Sub-Topik
    public function editSubTopic($id)
    {
        // UBAH BARIS INI: Tambahkan pemanggilan relasi kuis
        $subTopic = SubTopic::with('quizQuestions')->findOrFail($id);
        
        if ($subTopic->topic->course->user_id !== Auth::id()) abort(403);

        $topics = Topic::where('course_id', $subTopic->topic->course_id)
                       ->orderBy('urutan', 'asc')
                       ->get();

        return view('Dashboard.Guru.Topik.sub_topik_update', compact('subTopic', 'topics'));
    }

    // 4. Memproses Update Sub-Topik
    public function updateSubTopic(Request $request, $id)
    {
        $subTopic = SubTopic::findOrFail($id);
        if ($subTopic->topic->course->user_id !== Auth::id()) abort(403);

        $request->validate([
            'judul'     => 'required|string|max:150',
            'jenis'     => 'required|in:materi,quiz,tugas',
            'status'    => 'required|in:publish,un-publish',
            'deskripsi' => 'nullable|string',
            'topic_id'  => 'required|exists:topics,id',  // Validasi ID Topik baru
            'urutan'    => 'required|integer|min:1',     // Validasi Urutan
            'link_1'    => 'nullable|url|max:255',
            'link_2'    => 'nullable|url|max:255',
            'link_3'    => 'nullable|url|max:255',
            'file_1'    => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,png,jpg,jpeg|max:10240',
            'file_2'    => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,png,jpg,jpeg|max:10240',
            'file_3'    => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,png,jpg,jpeg|max:10240',
        ]);

        // Proteksi Keamanan: Pastikan topik tujuan pindah masih berada di dalam course yang sama
        $newTopic = Topic::findOrFail($request->topic_id);
        if ($newTopic->course_id !== $subTopic->topic->course_id) {
            abort(403, 'Topik tujuan tidak valid.');
        }

        $data = [
            'topic_id'  => $request->topic_id,
            'urutan'    => $request->urutan,
            'judul'     => $request->judul,
            'jenis'     => $request->jenis,
            'status'    => $request->status,
            'deskripsi' => $request->deskripsi,
            'link_1'    => $request->link_1,
            'link_2'    => $request->link_2,
            'link_3'    => $request->link_3,
        ];

        // Proses Update File (Jika ada file baru, hapus file lama)
        for ($i = 1; $i <= 3; $i++) {
            $fileKey = 'file_' . $i;
            
            if ($request->hasFile($fileKey)) {
                if ($subTopic->$fileKey && File::exists(public_path('uploads/sub_topics/' . $subTopic->$fileKey))) {
                    File::delete(public_path('uploads/sub_topics/' . $subTopic->$fileKey));
                }

                $file = $request->file($fileKey);
                $filename = time() . '_' . $i . '_' . Str::slug($request->judul) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/sub_topics'), $filename);
                $data[$fileKey] = $filename;
            }
        }

        $subTopic->update($data);

        // ====================================================================
        // TAMBAHAN: LOGIKA UPDATE BUILDER KUIS
        // ====================================================================
        if ($request->jenis === 'quiz') {
            // Kumpulkan ID soal yang dikirim dari form (untuk mendeteksi soal yang dihapus oleh guru)
            $submittedPgIds = $request->pg_id ?? [];
            $submittedEssayIds = $request->essay_id ?? [];
            $allSubmittedIds = array_filter(array_merge($submittedPgIds, $submittedEssayIds));

            // Hapus pertanyaan lama di DB yang ID-nya TIDAK ADA di form (karena dihapus guru via tombol tong sampah)
            \App\Models\QuizQuestion::where('sub_topic_id', $subTopic->id)
                ->whereNotIn('id', $allSubmittedIds)
                ->delete();
            
            // 1. Update atau Buat Soal Pilihan Ganda
            if ($request->has('pg_pertanyaan')) {
                $validPgCount = 0;
                foreach ($request->pg_pertanyaan as $q) {
                    if (!empty(trim($q))) $validPgCount++;
                }
                $bobotOtomatis = $validPgCount > 0 ? round(100 / $validPgCount, 2) : 0;

                foreach ($request->pg_pertanyaan as $key => $pertanyaan) {
                    if (!empty(trim($pertanyaan))) {
                        $qId = $request->pg_id[$key] ?? null;
                        \App\Models\QuizQuestion::updateOrCreate(
                            ['id' => $qId, 'sub_topic_id' => $subTopic->id], // Cari berdasarkan ID (jika ada)
                            [
                                'tipe'             => 'pg',
                                'pertanyaan'       => $pertanyaan,
                                'opsi_a'           => $request->pg_opsi_a[$key] ?? '-',
                                'opsi_b'           => $request->pg_opsi_b[$key] ?? '-',
                                'opsi_c'           => $request->pg_opsi_c[$key] ?? '-',
                                'opsi_d'           => $request->pg_opsi_d[$key] ?? '-',
                                'kunci_jawaban_pg' => strtolower($request->pg_kunci[$key] ?? 'a'),
                                'bobot_nilai'      => $bobotOtomatis,
                            ]
                        );
                    }
                }
            }

            // 2. Update atau Buat Soal Essay
            if ($request->has('essay_pertanyaan')) {
                foreach ($request->essay_pertanyaan as $key => $pertanyaan) {
                    if (!empty(trim($pertanyaan))) {
                        $qId = $request->essay_id[$key] ?? null;
                        \App\Models\QuizQuestion::updateOrCreate(
                            ['id' => $qId, 'sub_topic_id' => $subTopic->id],
                            [
                                'tipe'         => 'essay',
                                'pertanyaan'   => $pertanyaan,
                                'bobot_nilai'  => $request->essay_bobot[$key] ?? 10,
                            ]
                        );
                    }
                }
            }
        }
        // (Catatan: Jika jenis dirubah menjadi materi/tugas, blok if di atas dilewati, sehingga kuis lama tetap aman di database)

        return redirect()->route('guru_course_detail', $newTopic->course_id)
                         ->with('success', 'Sub-Topik berhasil diperbarui!');
    }

    // 5. Menghapus Sub-Topik
    public function destroySubTopic($id)
    {
        $subTopic = SubTopic::findOrFail($id);
        if ($subTopic->topic->course->user_id !== Auth::id()) abort(403);

        // Hapus ke-3 file jika ada
        for ($i = 1; $i <= 3; $i++) {
            // ... (biarkan kode hapus file ini) ...
        }

        $courseId = $subTopic->topic->course_id;

        // TAMBAHKAN BARIS INI: Hapus semua kuis yang terhubung
        \App\Models\QuizQuestion::where('sub_topic_id', $subTopic->id)->delete();

        $subTopic->delete();

        return redirect()->route('guru_course_detail', $courseId)
                         ->with('success', 'Sub-Topik berhasil dihapus!');
    }
    public function showSubTopic($id)
    {
        // Tambahkan 'quizQuestions' ke dalam array with() agar data soal ikut ditarik
        $subTopic = SubTopic::with(['topic.course', 'quizQuestions'])->findOrFail($id);

        // Keamanan: Pastikan hanya guru pemilik kelas yang bisa melihat pratinjau ini
        if ($subTopic->topic->course->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('Dashboard.Guru.Topik.sub_topik_detail', compact('subTopic'));
    }
    // =========================================================================
    // HELPER: Image Compression to WebP (Maks resolusi 854px)
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

        // Patokan 480p wide (16:9) -> Lebar 854px
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