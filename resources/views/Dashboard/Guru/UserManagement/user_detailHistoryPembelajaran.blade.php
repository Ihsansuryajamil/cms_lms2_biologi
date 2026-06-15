@extends('Layouts.app')

@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection

@section('content')
    <div class="topbar d-flex justify-content-between align-items-center w-100">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('guru_user_history', $student->id) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
            <h5 class="mb-0 fw-bold">Detail Pembelajaran <span class="badge bg-dark text-warning small ms-2" style="font-size: 0.75rem;">Mode Evaluasi</span></h5>
        </div>
        <div>
            <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold">
                <i class="fa-solid fa-user me-1"></i> Siswa: {{ $student->nama }}
            </span>
        </div>
    </div>

    <div class="content-area mt-4">
        <div class="row g-4"> 
            <div class="col-lg-12">
                
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                        <div class="d-flex align-items-center justify-content-between pb-3 border-bottom flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-3 rounded-3 text-white 
                                    @if($type === 'materi') bg-primary 
                                    @elseif($type === 'tugas') bg-warning text-dark 
                                    @else bg-danger @endif">
                                    @if($type === 'materi') <i class="fa-solid fa-book-open-reader fa-xl"></i>
                                    @elseif($type === 'tugas') <i class="fa-solid fa-clipboard-list fa-xl"></i>
                                    @else <i class="fa-solid fa-circle-question fa-xl"></i> @endif
                                </div>
                                <div>
                                <span class="badge bg-light text-secondary text-uppercase mb-1 fw-bold">{{ str_replace('_', ' ', $type) }}</span>
                                <h4 class="mb-0 fw-bold text-dark">{{ $subTopic->judul }}</h4>
                                <small class="text-muted">Mata Pelajaran: <b>{{ $subTopic->topic->course->nama_course }}</b> | Bab: {{ $subTopic->topic->nama_topic }}</small>
                            </div>
                            </div>
                            
                            <div class="text-end bg-light px-3 py-2.5 rounded-3 border shadow-sm">
                                <small class="text-muted d-block fw-bold mb-1.5" style="font-size: 0.72rem; letter-spacing: 0.5px;">
                                    <i class="fa-regular fa-calendar-check me-1 text-primary"></i> WAKTU PENGERJAAN SISWA:
                                </small>
                                <span class="fw-bold text-dark font-monospace" style="font-size: 0.88rem;">
                                    @if($type === 'materi') 
                                        {{ $materiSubmission->created_at->translatedFormat('d M Y, H:i') }} WIB
                                    @elseif($type === 'tugas') 
                                        {{ $taskSubmission->created_at->translatedFormat('d M Y, H:i') }} WIB
                                    @else 
                                        {{ \Carbon\Carbon::parse($quizAttempt->finished_at ?? $quizAttempt->updated_at)->translatedFormat('d M Y, H:i') }} WIB 
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4 pt-3">
                        <h6 class="fw-bold text-dark mb-2 small"><i class="fa-solid fa-align-left me-1 text-muted"></i> Catatan Deskripsi / Instruksi Awal:</h6>
                        <div class="p-3 bg-light rounded-3 text-secondary small" style="line-height: 1.6; white-space: pre-line;">
                            {!! $subTopic->deskripsi ? e($subTopic->deskripsi) : '<em>Tidak ada instruksi tambahan.</em>' !!}
                        </div>
                    </div>
                </div>

                {{-- ==================== KONDISI 1: DETAIL KUIS PILIHAN GANDA (FITUR 4) ==================== --}}
                @if($type === 'quiz_pg')
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                                <h6 class="fw-bold text-dark mb-0"><i class="fa-solid fa-list-ul me-1 text-primary"></i> Analisis Butir Soal PG Terjawab</h6>
                                <span class="fs-4 fw-bold text-primary font-monospace">Skor Akumulasi: {{ number_format($quizAttempt->total_nilai, 0) }}/100</span>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle mb-0" style="font-size: 0.85rem;">
                                    <thead class="table-light">
                                        <tr class="text-secondary text-uppercase" style="font-size: 0.75rem;">
                                            <th width="50" class="text-center">No</th>
                                            <th>Isi Soal & Struktur Seluruh Opsi Pilihan</th>
                                            <th width="80" class="text-center">Kunci</th>
                                            <th width="120" class="text-center">Pilihan Siswa</th>
                                            <th width="100" class="text-center">Status</th>
                                            <th width="90" class="text-center">Poin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($quizAnswers as $index => $ans)
                                            <tr>
                                                <td class="text-center fw-bold bg-light">{{ $index + 1 }}</td>
                                                <td>
                                                    <span class="text-dark fw-bold d-block mb-2">{!! e($ans->question->pertanyaan) !!}</span>
                                                    
                                                    <div class="p-2 rounded-3 bg-light d-flex flex-column gap-2 border" style="font-size: 0.8rem;">
                                                        <div class="{{ $ans->question->kunci_jawaban_pg === 'a' ? 'text-success fw-bold' : '' }} {{ $ans->jawaban_siswa === 'a' ? 'bg-warning-subtle px-1 rounded' : '' }}">
                                                            <span class="badge bg-white text-dark border me-1">A</span> {{ $ans->question->opsi_a }}
                                                        </div>
                                                        <div class="{{ $ans->question->kunci_jawaban_pg === 'b' ? 'text-success fw-bold' : '' }} {{ $ans->jawaban_siswa === 'b' ? 'bg-warning-subtle px-1 rounded' : '' }}">
                                                            <span class="badge bg-white text-dark border me-1">B</span> {{ $ans->question->opsi_b }}
                                                        </div>
                                                        <div class="{{ $ans->question->kunci_jawaban_pg === 'c' ? 'text-success fw-bold' : '' }} {{ $ans->jawaban_siswa === 'c' ? 'bg-warning-subtle px-1 rounded' : '' }}">
                                                            <span class="badge bg-white text-dark border me-1">C</span> {{ $ans->question->opsi_c }}
                                                        </div>
                                                        <div class="{{ $ans->question->kunci_jawaban_pg === 'd' ? 'text-success fw-bold' : '' }} {{ $ans->jawaban_siswa === 'd' ? 'bg-warning-subtle px-1 rounded' : '' }}">
                                                            <span class="badge bg-white text-dark border me-1">D</span> {{ $ans->question->opsi_d }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center"><span class="badge bg-success px-2 py-1.5 text-uppercase">Opsi {{ $ans->question->kunci_jawaban_pg }}</span></td>
                                                <td class="text-center">
                                                    <span class="badge {{ $ans->is_correct ? 'bg-success' : 'bg-danger' }} text-uppercase px-2.5 py-1.5">
                                                        Opsi {{ $ans->jawaban_siswa ?? '-' }}
                                                    </span>
                                                </td>
                                                <td class="text-center fw-bold {{ $ans->is_correct ? 'text-success' : 'text-danger' }}">
                                                    {!! $ans->is_correct ? '<i class="fa-solid fa-check"></i> Benar' : '<i class="fa-solid fa-xmark"></i> Salah' !!}
                                                </td>
                                                <td class="text-center font-monospace fw-bold text-primary">+{{ $ans->nilai_didapat }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                {{-- ==================== KONDISI 2: FORM INPUT PENILAIAN ESSAY (FITUR 2) ==================== --}}
                @elseif($type === 'quiz_essay')
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
                        <div class="card-body p-4">
                            <h6 class="fw-bold text-dark mb-3 pb-2 border-bottom"><i class="fa-solid fa-pen-nib me-1 text-danger"></i> Koreksi Lembar Esai Uraian Siswa</h6>

                            <form action="{{ route('guru_user_history_grade_quiz', $quizAttempt->id) }}" method="POST">
                                @csrf
                                @foreach($quizAnswers as $index => $ans)
                                    <div class="p-3 bg-white border rounded-4 mb-4 shadow-sm">
                                        <div class="d-flex justify-content-between align-items-center bg-light p-2 rounded-3 mb-3 border flex-wrap gap-2">
                                            <span class="badge bg-dark px-3 py-1.5 rounded-pill fw-bold">Nomor Soal Uraian {{ $index + 1 }}</span>
                                            <span class="text-muted small fw-bold">Batas Bobot Maksimal Soal: <span class="text-danger">{{ $ans->question->bobot_nilai }} Poin</span></span>
                                        </div>
                                        <p class="text-dark fw-bold mb-3 px-1" style="font-size: 0.95rem;">{!! e($ans->question->pertanyaan) !!}</p>
                                        
                                        <label class="small text-muted d-block mb-1.5 fw-bold"><i class="fa-regular fa-message me-1"></i> Input Jawaban Ketikan Siswa:</label>
                                        <div class="bg-light p-3 rounded-3 border text-danger font-monospace small mb-3" style="min-height: 60px; white-space: pre-line;">{!! $ans->jawaban_siswa ? e($ans->jawaban_siswa) : '<em>Siswa mengosongkan jawaban ini.</em>' !!}</div>
                                        
                                        <div class="row align-items-center justify-content-end g-2">
                                            <div class="col-auto"><label class="small fw-bold text-dark">Berikan Nilai Skor:</label></div>
                                            <div class="col-3 col-sm-2">
                                                <input type="number" 
                                                    name="essay_scores[{{ $ans->id }}]" 
                                                    class="form-control form-control-sm text-center fw-bold text-danger font-monospace border-primary essay-score-input" 
                                                    value="{{ $ans->nilai_didapat }}" 
                                                    min="0" 
                                                    max="{{ $ans->question->bobot_nilai }}" 
                                                    data-num="{{ $index + 1 }}" {{-- Mengambil nomor urut soal --}}
                                                    required>
                                             </div>
                                        </div>
                                    </div>
                                @endforeach

                                <button type="submit" class="btn btn-danger w-100 rounded-pill py-2.5 fw-bold shadow-sm" onclick="return confirm('Apakah Anda yakin semua poin essay sudah sesuai dan ingin menyimpan perubahan skor kuis ini?')">
                                    <i class="fa-solid fa-floppy-disk me-1.5"></i> Simpan Hasil Koreksi Esai
                                </button>
                            </form>
                        </div>
                    </div>

                {{-- ==================== KONDISI 3: FORM INPUT PENILAIAN TUGAS (FITUR 1) ==================== --}}
                @elseif($type === 'tugas')
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
                        <div class="card-body p-4">
                            <h6 class="fw-bold text-dark mb-3 pb-2 border-bottom"><i class="fa-solid fa-tasks me-1 text-warning"></i> Lembar Penilaian Berkas / Link Tugas</h6>

                            <div class="mb-4">
                                <label class="fw-bold small text-dark mb-1.5 d-block"><i class="fa-solid fa-file-text me-1 text-muted"></i> Hasil Ketikan Teks Uraian Siswa:</label>
                                <div class="p-3 bg-light rounded-3 text-secondary small font-monospace border" style="min-height: 80px; white-space: pre-line;">
                                    {!! $taskSubmission->jawaban_teks ? e($taskSubmission->jawaban_teks) : '<em>Siswa tidak menyertakan jawaban berupa teks uraian.</em>' !!}
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="fw-bold small text-dark mb-1.5 d-block"><i class="fa-solid fa-paperclip me-1 text-muted"></i> File Dokumen Diunggah:</label>
                                    @if($taskSubmission->file_jawaban)
                                        <div class="p-3 border rounded-3 bg-light d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center gap-2 overflow-hidden">
                                                <i class="fa-solid fa-file-arrow-up text-danger fs-4"></i>
                                                <span class="small text-dark text-truncate fw-medium" style="max-width: 220px;" title="{{ $taskSubmission->file_jawaban }}">{{ $taskSubmission->file_jawaban }}</span>
                                            </div>
                                            <a href="{{ asset('uploads/tugas_submissions/' . $taskSubmission->file_jawaban) }}" target="_blank" class="btn btn-sm btn-outline-primary px-3 rounded-pill fw-bold" style="font-size: 0.75rem;">
                                                <i class="fa-solid fa-eye me-1"></i> Buka
                                            </a>
                                        </div>
                                    @else
                                        <div class="p-3 text-center text-muted small bg-light rounded-3 border border-dashed">Tidak ada lampiran file dokumen.</div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-bold small text-dark mb-1.5 d-block"><i class="fa-solid fa-link me-1 text-muted"></i> Tautan / URL Jawaban Luar:</label>
                                    @if($taskSubmission->link_jawaban)
                                        <div class="p-3 border rounded-3 bg-light d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center gap-2 overflow-hidden">
                                                <i class="fa-solid fa-arrow-up-right-from-square text-success fs-5"></i>
                                                <span class="small text-primary text-truncate fw-medium" style="max-width: 250px;" title="{{ $taskSubmission->link_jawaban }}">{{ $taskSubmission->link_jawaban }}</span>
                                            </div>
                                            <a href="{{ $taskSubmission->link_jawaban }}" target="_blank" class="btn btn-sm btn-outline-success px-3 rounded-pill fw-bold" style="font-size: 0.75rem;">
                                                <i class="fa-solid fa-external-link me-1"></i> Buka
                                            </a>
                                        </div>
                                    @else
                                        <div class="p-3 text-center text-muted small bg-light rounded-3 border border-dashed">Tidak ada lampiran link tautan.</div>
                                    @endif
                                </div>
                            </div>

                            <hr class="my-4">

                            <form action="{{ route('guru_user_history_grade_task', $taskSubmission->id) }}" method="POST" class="p-3 rounded-4 border bg-light">
                                @csrf
                                <div class="row g-3 mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label small fw-bold text-dark">Masukkan Nilai Tugas:</label>
                                        <input type="number" name="nilai" class="form-control fw-bold font-monospace border-primary text-center" 
                                               style="font-size: 1.1rem; color: #198754;" value="{{ $taskSubmission->nilai ?? 0 }}" min="0" max="100" required>
                                        <small class="text-muted d-block mt-1 text-center" style="font-size: 0.7rem;">Skala Nilai 0 - 100</small>
                                    </div>
                                    <div class="col-sm-9">
                                        <label class="form-label small fw-bold text-dark">Catatan Evaluasi / Komentar Guru:</label>
                                        <textarea name="catatan_guru" class="form-control text-dark rounded-3" rows="3" style="font-size: 0.85rem;" 
                                                  placeholder="Ketik umpan balik bimbingan atau koreksi kesalahan pengerjaan siswa di sini...">{{ $taskSubmission->catatan_guru }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-warning btn-sm rounded-pill w-100 py-2 fw-bold text-dark shadow-sm">
                                    <i class="fa-solid fa-circle-check me-1.5"></i> Simpan Catatan & Nilai Tugas Siswa
                                </button>
                            </form>
                        </div>
                    </div>

                {{-- ==================== KONDISI 4: PREVIEW FEEDBACK MEMBACA MATERI ==================== --}}
                @elseif($type === 'materi')
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
                        <div class="card-body p-4">
                            <h6 class="fw-bold text-dark mb-3 pb-2 border-bottom"><i class="fa-solid fa-book-reader me-1 text-primary"></i> Laporan Aktivitas Membaca Berkas Materi</h6>
                            
                            <div class="row align-items-center bg-light p-3 rounded-4 border g-3 mb-0">
                                <div class="col-sm-4 text-center border-end border-white-50">
                                    <small class="text-muted d-block mb-1.5 small text-uppercase fw-bold" style="font-size: 0.7rem;">Tingkat Pemahaman Siswa:</small>
                                    @if($materiSubmission->status === 'sangat_mengerti')
                                        <span class="badge bg-success px-3 py-2 rounded-pill fw-bold"><i class="fa-solid fa-face-laugh-beam me-1"></i> Sangat Mengerti</span>
                                    @elseif($materiSubmission->status === 'sudah_mengerti')
                                        <span class="badge bg-primary px-3 py-2 rounded-pill fw-bold"><i class="fa-solid fa-face-smile me-1"></i> Sudah Mengerti</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2 rounded-pill fw-bold"><i class="fa-solid fa-face-frown me-1"></i> Belum Mengerti</span>
                                    @endif
                                </div>
                                <div class="col-sm-8 ps-sm-4">
                                    <label class="small text-muted fw-bold mb-1 d-block"><i class="fa-solid fa-pencil me-1"></i> Catatan Pertanyaan / Poin Esensial Siswa:</label>
                                    <div class="bg-white p-3 rounded-3 border text-secondary font-monospace small" style="line-height: 1.6; max-height: 150px; overflow-y: auto;">
                                        "{!! e($materiSubmission->catatan_siswa) !!}"
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    {{-- SKRIP DETEKSI DAN VALIDASI BATAS MAKSIMAL NILAI --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // 1. Validasi Kuis Esai Dinamis
            document.querySelectorAll('.essay-score-input').forEach(function(input) {
                input.addEventListener('input', function() {
                    const maxAllowed = parseInt(this.getAttribute('max'));
                    const currentVal = parseInt(this.value);
                    const questionNum = this.getAttribute('data-num');

                    if (currentVal > maxAllowed) {
                        alert(`⚠️ Peringatan Batas Nilai:\nNilai yang Anda masukkan untuk Soal Nomor ${questionNum} melebihi bobot maksimal (${maxAllowed} Poin).\n\nSistem otomatis mengembalikan nilai ke batas tertinggi.`);
                        this.value = maxAllowed; // Paksa nilai kembali ke angka maksimal soal
                    }
                });
            });

            // 2. Validasi Nilai Tugas (Skala Maksimal 100)
            const taskInput = document.querySelector('.task-score-input');
            if (taskInput) {
                taskInput.addEventListener('input', function() {
                    const currentVal = parseInt(this.value);

                    if (currentVal > 100) {
                        alert(`⚠️ Peringatan Batas Nilai:\nNilai pengumpulan tugas tidak boleh melebihi batas maksimal skala 100 Poin.\n\nSistem otomatis mengembalikan nilai ke batas tertinggi.`);
                        this.value = 100; // Paksa nilai kembali ke angka 100
                    }
                });
            }

        });
    </script>
@endsection