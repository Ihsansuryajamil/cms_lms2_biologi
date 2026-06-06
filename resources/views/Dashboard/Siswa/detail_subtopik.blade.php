@extends('Layouts.appSiswa')
@section('content')

    <header class="course-header">
        <div class="container">
            @if(Auth::user()->status === 'active')
            <div class="row">
                <div class="col-lg-8 pe-lg-5">
                    
                    <div class="breadcrumb-custom">
                        <a href="{{ route('students_course') }}">Qourse</a> &nbsp;<i class="fa-solid fa-chevron-right fa-xs"></i>&nbsp; 
                        <a href="{{ route('students_detail_course', $subTopic->topic->course_id) }}">{{ $subTopic->topic->course->nama_course }}</a> &nbsp;<i class="fa-solid fa-chevron-right fa-xs"></i>&nbsp; 
                        <span class="text-white">{{ $subTopic->judul }}</span>
                    </div> 

                        <div class="d-flex align-items-center gap-3 pb-3">
                            <div class="p-3 rounded-3 text-white
                                @if($subTopic->jenis == 'materi')
                                    bg-primary
                                @elseif($subTopic->jenis == 'tugas')
                                    bg-warning text-dark
                                @else
                                    bg-danger
                                @endif
                            ">
                                @if($subTopic->jenis == 'materi')
                                    <i class="fa-solid fa-book-open-reader fa-xl"></i>
                                @elseif($subTopic->jenis == 'tugas')
                                    <i class="fa-solid fa-clipboard-list fa-xl"></i>
                                @else
                                    <i class="fa-solid fa-circle-question fa-xl"></i>
                                @endif
                            </div>
                            <div>
                                <span class="badge bg-light text-primary text-uppercase mb-1 fw-bold">{{ $subTopic->jenis }}</span>
                                <h4 class="mb-0 fw-bold  text-white">{{ $subTopic->judul }}</h4>
                            </div>
                        </div>

                    <div class="card border-0 shadow-sm rounded-4 bg-white">
                        <div class="card-body p-4">
                            <h6 class="fw-bold text-dark mb-3">
                                <i class="fa-solid fa-align-left me-2 text-muted"></i> 
                                Deskripsi / Instruksi Pembelajaran:
                            </h6>
                            <div class="p-3 bg-light rounded-3 text-secondary" style="line-height: 1.8; min-height: 100px; white-space: pre-line; font-size: 0.85rem;">
                                {!! $subTopic->deskripsi ? e($subTopic->deskripsi) : '<em>Tidak ada catatan atau deskripsi tambahan untuk aktivitas ini.</em>' !!}
                            </div>
                        </div>
                    </div>

                    

                </div>
            </div>
            @else
                <div class="d-flex align-items-center gap-2 text-muted">
                    <span class="small text-white fw-semibold"><i class="fa-solid fa-lock me-2"></i> Portal Pembelajaran Terkunci sementara</span>
                </div>
            @endif
        </div>
    </header>

    <section class="content-section">
        <div class="container">
            
            @if(Auth::user()->status === 'inactive')
                
                <div class="row justify-content-center py-4">
                    <div class="col-md-8 text-center">
                        <div class="card border-0 shadow-sm p-5 rounded-4 bg-white">
                            <div class="card-body">
                                <div class="text-danger mb-4">
                                    <i class="fa-solid fa-user-lock" style="font-size: 4.5rem; opacity: 0.8;"></i>
                                </div>
                                <h4 class="fw-bold text-dark mb-2">Akses Detail Kurikulum Terkunci!</h4>
                                <p class="text-muted small mb-4 mx-auto" style="max-width: 500px; line-height: 1.6;">
                                    Status akun Anda saat ini masih <strong class="text-danger">Nonaktif (Inactive)</strong>. Anda tidak diperbolehkan melihat isi bab materi, sub-topik, tugas, kuis, maupun video penunjang di dalam kelas ini.
                                </p>
                                <div class="alert alert-warning border-0 rounded-3 small p-3 mb-0 text-start d-flex gap-3 align-items-center" style="background-color: #fff3cd; color: #664d03;">
                                    <i class="fa-solid fa-circle-info fs-5 text-warning flex-shrink-0"></i>
                                    <span><strong>Petunjuk:</strong> Silakan hubungi Guru Pengajar atau pihak Administrator untuk mengaktifkan status kepesertaan Anda agar kunci materi ini terbuka otomatis.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @else

                <div class="row">
                    <div class="col-lg-8 pe-lg-5">
                        
                        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                            <h6 class="fw-bold text-dark mb-2"><i class="fa-solid fa-paperclip me-2 text-primary"></i> Berkas Lampiran</h6>
                            <div class="d-flex flex-column">
                                @php $hasFiles = false; @endphp
                                @for($i = 1; $i <= 3; $i++)
                                    @php $fileKey = 'file_' . $i; @endphp
                                    @if($subTopic->$fileKey)
                                        @php 
                                            $hasFiles = true; 
                                            $fileName = $subTopic->$fileKey;
                                            
                                            // 1. Ambil ekstensi file (pdf, docx, xlsx, dll)
                                            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                                            
                                            // 2. Tentukan Icon dan Aksi Default
                                            $iconClass = 'fa-solid fa-file text-secondary';
                                            $btnText = 'Buka';
                                            $btnIcon = 'fa-solid fa-eye';
                                            $fileUrl = asset('uploads/sub_topics/' . $fileName);
                                            $isDownload = false;

                                            // 3. Logika Pengecekan Ekstensi
                                            if($ext == 'pdf') {
                                                $iconClass = 'fa-solid fa-file-pdf text-danger';
                                                $btnText = 'Buka';
                                                $btnIcon = 'fa-solid fa-eye';
                                                // Jika PDF, arahkan ke halaman pdf.blade.php
                                                $fileUrl = route('students_pdf', ['filename' => $fileName]);
                                            } elseif(in_array($ext, ['doc', 'docx'])) {
                                                $iconClass = 'fa-solid fa-file-word text-primary';
                                                $btnText = 'Download';
                                                $btnIcon = 'fa-solid fa-download';
                                                $isDownload = true;
                                            } elseif(in_array($ext, ['xls', 'xlsx', 'csv'])) {
                                                $iconClass = 'fa-solid fa-file-excel text-success';
                                                $btnText = 'Download';
                                                $btnIcon = 'fa-solid fa-download';
                                                $isDownload = true;
                                            } elseif(in_array($ext, ['ppt', 'pptx'])) {
                                                $iconClass = 'fa-solid fa-file-powerpoint text-warning';
                                                $btnText = 'Download';
                                                $btnIcon = 'fa-solid fa-download';
                                                $isDownload = true;
                                            }
                                        @endphp

                                        <div class="d-flex align-items-center justify-content-between py-3 border-bottom border-light">
                                            <div class="d-flex align-items-center gap-3">
                                                <span class="text-muted small fw-bold" style="min-width: 20px;">{{ $i }}</span>
                                                
                                                <i class="{{ $iconClass }} fs-5"></i>
                                                
                                                <span class="text-dark small fw-medium">
                                                    <b class="text-uppercase" style="letter-spacing: 0.5px; color: #212529;">FILE LAMPIRAN {{ $i }}</b> 
                                                    <br><span class="text-muted d-block text-truncate" style="font-size: 0.75rem; max-width: 300px;" title="{{ $fileName }}">{{ $fileName }}</span>
                                                </span>
                                            </div>
                                            <div>
                                                <a href="{{ $fileUrl }}" class="btn btn-light border btn-sm" title="{{ $btnText }} Berkas" {{ $isDownload ? 'download' : '' }}>
                                                    <i class="{{ $btnIcon }}"></i> {{ $btnText }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endfor

                                @if(!$hasFiles)
                                    <div class="text-center py-4 text-muted small bg-light rounded-3 border border-dashed mt-2" style="font-size: 0.75rem;">
                                        Tidak ada file lampiran berkas materi.
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                            <h6 class="fw-bold text-dark mb-2"><i class="fa-solid fa-globe me-2 text-success"></i> Tautan Pendukung</h6>
                            <div class="d-flex flex-column">
                                @php $hasLinks = false; @endphp
                                @for($i = 1; $i <= 3; $i++)
                                    @php $linkKey = 'link_' . $i; @endphp
                                    @if($subTopic->$linkKey)
                                        @php $hasLinks = true; @endphp
                                        <div class="d-flex align-items-center justify-content-between py-3 border-bottom border-light">
                                            <div class="d-flex align-items-center gap-3 overflow-hidden">
                                                <span class="text-muted small fw-bold" style="min-width: 20px;">{{ $i }}</span>
                                                
                                                <i class="fa-solid fa-link text-success fs-5"></i>
                                                
                                                <span class="text-dark small fw-medium">
                                                    <b class="text-uppercase" style="letter-spacing: 0.5px; color: #212529;">TAUTAN REFERENSI {{ $i }}</b> 
                                                    <br><span class="text-muted d-block text-truncate" style="font-size: 0.75rem; max-width: 300px;" title="{{ $subTopic->$linkKey }}">{{ $subTopic->$linkKey }}</span>
                                                </span>
                                            </div>
                                            <div>
                                                <a href="{{ $subTopic->$linkKey }}" target="_blank" class="btn btn-light border btn-sm" title="Hubungkan Link">
                                                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Tautan
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endfor

                                @if(!$hasLinks)
                                    <div class="text-center py-4 text-muted small bg-light rounded-3 border border-dashed mt-2" style="font-size: 0.75rem;">
                                        Tidak ada link referensi eksternal tambahan.
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-lg-4 course-sidebar-wrapper">
                        <div class="sidebar-card">
                            <div class="sidebar-content position-relative" style="border-radius: 12px 12px 0 0;">
                                @if($subTopic->jenis == 'quiz')
                                    <div class="card-body p-2 text-center">
                                        
                                        {{-- KONDISI 1: JIKA BELUM PERNAH MENGERJAKAN ATAU MASIH PROSES MENGERJAKAN --}}
                                        @if(!$quizAttempt || $quizAttempt->status === 'mengerjakan')
                                            <div class="text-danger mb-3">
                                                <i class="fa-solid fa-clipboard-question" style="font-size: 4rem; opacity: 0.9;"></i>
                                            </div>
                                            <h4 class="fw-bold text-dark mb-2">
                                                {{ !$quizAttempt ? 'Lembar Kerja Kuis Online' : 'Sesi Ujian Aktif' }}
                                            </h4>
                                            <p class="text-muted small mb-4 mx-auto" style="max-width: 500px; line-height: 1.6; font-size: 0.8rem;">
                                                {{ !$quizAttempt 
                                                    ? 'Silakan baca instruksi pengerjaan yang diberikan oleh Guru di bawah ini dengan cermat sebelum menekan tombol mulai ujian.' 
                                                    : 'Anda memiliki sesi ujian berjalan yang belum diselesaikan. Tekan tombol di bawah untuk kembali melanjutkan pengerjaan.' }}
                                            </p>
                                            
                                            <div class="row g-3 justify-content-center mb-4">
                                                <div class="col-6 col-sm-5">
                                                    <div class="p-2 bg-light rounded-3 border">
                                                        <small class="text-muted d-block mb-1" style="font-size: 0.75rem;">Pilihan Ganda</small>
                                                        <h6 class="fw-bold text-dark mb-0">{{ $subTopic->quizQuestions->where('tipe', 'pg')->count() }} Soal</h6>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-sm-5">
                                                    <div class="p-2 bg-light rounded-3 border">
                                                        <small class="text-muted d-block mb-1" style="font-size: 0.75rem;">Essay / Uraian</small>
                                                        <h6 class="fw-bold text-dark mb-0">{{ $subTopic->quizQuestions->where('tipe', 'essay')->count() }} Soal</h6>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('students_quiz_start', $subTopic->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn {{ !$quizAttempt ? 'btn-danger' : 'btn-warning text-dark' }} rounded-pill px-5 py-2.5 fw-bold shadow-sm" style="font-size: 0.85rem;">
                                                    <i class="fa-solid {{ !$quizAttempt ? 'fa-play' : 'fa-forward' }} me-2"></i> 
                                                    {{ !$quizAttempt ? 'Mulai Kerjakan Ujian' : 'Lanjutkan Ujian' }}
                                                </button>
                                            </form>

                                        {{-- KONDISI 2: JIKA SUDAH SUBMIT NAMUN MENUNGGU EVALUASI ESSAY DARI GURU --}}
                                        @elseif($quizAttempt->status === 'menunggu_dinilai_manual')
                                            <div class="text-warning mb-3">
                                                <i class="fa-solid fa-user-clock" style="font-size: 4rem; opacity: 0.9;"></i>
                                            </div>
                                            <h4 class="fw-bold text-dark mb-2">Kuis Dikumpulkan</h4>
                                            <p class="text-muted small mb-4 mx-auto" style="max-width: 500px; line-height: 1.6; font-size: 0.8rem;">
                                                Jawaban Anda telah tersimpan. Sistem sedang menunggu Guru memeriksa dan memberikan penilaian pada bobot jawaban Essay Anda.
                                            </p>

                                            <div class="p-3 bg-light rounded-4 border mb-2 mx-auto" style="max-width: 280px;">
                                                <span class="badge bg-warning text-dark px-3 py-1.5 rounded-pill fw-bold mb-2" style="font-size: 0.7rem;">STATUS SKOR</span>
                                                <h6 class="fw-bold text-secondary mb-0" style="font-size: 0.9rem;">Belum dinilai oleh guru</h6>
                                            </div>

                                        {{-- KONDISI 3: JIKA KUIS SUDAH SELESAI DINILAI (PG MURNI ATAU HYBRID YANG SUDAH DIREVIEW GURU) --}}
                                        @elseif($quizAttempt->status === 'selesai_auto' || $quizAttempt->status === 'dinilai_lengkap')
                                            <div class="text-success mb-3">
                                                <i class="fa-solid fa-circle-check" style="font-size: 4rem; opacity: 0.9;"></i>
                                            </div>
                                            <h4 class="fw-bold text-dark mb-2">Evaluasi Selesai</h4>
                                            <p class="text-muted small mb-4 mx-auto" style="max-width: 500px; line-height: 1.6; font-size: 0.8rem;">
                                                Seluruh pengerjaan lembar ujian Anda telah selesai dikalkulasi secara akurat oleh sistem.
                                            </p>

                                            <div class="p-3 rounded-4 border mb-2 mx-auto" style="max-width: 260px; background-color: #f1fbf7; border-color: #a3cfbb !important;">
                                                <small class="text-success fw-bold d-block mb-1 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.7rem;">Nilai Yang Diperoleh</small>
                                                <h1 class="fw-black text-success mb-0" style="font-size: 3rem; font-weight: 800;">
                                                    {{ number_format($quizAttempt->total_nilai, 0) }}
                                                </h1>
                                            </div>
                                        @endif

                                    </div>
                                @elseif($subTopic->jenis == 'materi')
                                    <div class="card-body p-3 text-center">
                                        
                                        {{-- KONDISI A: JIKA SISWA SUDAH PERNAH MENGIRIMKAN FEEDBACK --}}
                                        @if($materiSubmission)
                                            <div class="mb-3 text-primary">
                                                <i class="fa-solid fa-circle-check" style="font-size: 3.5rem; opacity: 0.9;"></i>
                                            </div>
                                            <h5 class="fw-bold text-dark mb-1">Materi Telah Dibaca</h5>
                                            <p class="text-muted small mb-3">Anda telah mengirimkan laporan tingkat pemahaman untuk aktivitas pembelajaran ini.</p>

                                            <div class="p-3 rounded-4 border text-start bg-light mb-2">
                                                <small class="text-muted d-block mb-1 small text-uppercase fw-bold" style="font-size: 0.65rem;">Respon Pemahaman Anda:</small>
                                                
                                                @if($materiSubmission->status === 'sangat_mengerti')
                                                    <span class="badge bg-success px-2.5 py-1.5 rounded-3 mb-2"><i class="fa-solid fa-face-laugh-beam me-1"></i> Sangat Mengerti</span>
                                                @elseif($materiSubmission->status === 'sudah_mengerti')
                                                    <span class="badge bg-primary px-2.5 py-1.5 rounded-3 mb-2"><i class="fa-solid fa-face-smile me-1"></i> Sudah Mengerti</span>
                                                @else
                                                    <span class="badge bg-danger px-2.5 py-1.5 rounded-3 mb-2"><i class="fa-solid fa-face-frown me-1"></i> Belum Mengerti</span>
                                                @endif

                                                <p class="mb-0 text-dark small font-monospace bg-white p-2 rounded-3 border" style="font-size: 0.8rem; max-height: 100px; overflow-y: auto;">
                                                    "{{ $materiSubmission->catatan_siswa }}"
                                                </p>
                                            </div>
                                            <small class="text-muted d-block" style="font-size: 0.7rem;">Dikirim pada: {{ $materiSubmission->updated_at->translatedFormat('d M Y, H:i') }} WIB</small>

                                        {{-- KONDISI B: JIKA SISWA BELUM MENGISI FORM EVALUASI MATERI --}}
                                        @else
                                            <div class="text-primary mb-2">
                                                <i class="fa-solid fa-book-reader" style="font-size: 3.5rem; opacity: 0.9;"></i>
                                            </div>
                                            <h5 class="fw-bold text-dark mb-1">Konfirmasi Membaca</h5>
                                            <p class="text-muted small mb-3" style="font-size: 0.8rem;">Selesai mempelajari materi? Berikan tanggapan Anda untuk membantu Guru memantau perkembangan belajar Anda.</p>

                                            <form action="{{ route('students_materi_submit', $subTopic->id) }}" method="POST" class="text-start">
                                                @csrf
                                                
                                                <div class="form-group mb-3">
                                                    <label class="fw-bold small text-dark mb-2">Tingkat Pemahaman Uraian:</label>
                                                    <select name="status" class="form-select form-select-sm rounded-3 fw-medium text-dark" required>
                                                        <option value="" disabled selected>-- Pilih Tingkat Pemahaman --</option>
                                                        <option value="sangat_mengerti">🟢 Sangat Mengerti Materi Ini</option>
                                                        <option value="sudah_mengerti">🟡 Sudah Mengerti Cukup Baik</option>
                                                        <option value="belum_mengerti">🔴 Belum Mengerti (Butuh Bimbingan)</option>
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label class="fw-bold small text-dark mb-2">Pertanyaan / Poin Penting Materi:</label>
                                                    <textarea name="catatan_siswa" class="form-control rounded-3 p-2 text-dark" rows="3" 
                                                            style="font-size: 0.8rem;" placeholder="Tuliskan poin penting yang kamu dapatkan atau bagian yang belum kamu pahami dari materi ini..." required></textarea>
                                                </div>

                                                <button type="submit" class="btn btn-primary rounded-pill w-100 py-2 fw-bold shadow-sm" style="font-size: 0.8rem;">
                                                    <i class="fa-solid fa-paper-plane me-1.5"></i> Kirim Tanggapan Materi
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                @endif
                            </div>

                            <!-- <div class="sidebar-content p-4 bg-white" style="border-radius: 0 0 12px 12px;">
                                {{-- Tempat untuk konten tambahan bawah seperti tombol share atau log waktu pengerjaan --}}
                            </div> -->
                        </div>
                    </div>
                </div>

            @endif

        </div>
    </section>

@endsection