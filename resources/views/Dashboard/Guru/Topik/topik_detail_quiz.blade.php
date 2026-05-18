@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
<div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <a href="kelas_detail_siswa.html" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                <h5 class="mb-0 fw-bold">Browser dan CMS</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill"><i class="fa-solid fa-spinner"></i> Sedang Dipelajari</span>
            </div>
        </div>

        <div class="content-area">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Quiz Info -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-light border-0">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-warning text-white rounded p-2">
                                    <i class="fa-solid fa-circle-question fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Quiz: Browser dan CMS untuk Digitalisasi Budaya Indonesia</h6>
                                    <small class="text-muted">8 soal • Durasi: 25 menit • Skor minimum: 65</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info mb-4">
                                <strong><i class="fa-solid fa-info-circle"></i> Instruksi:</strong> Bacalah setiap pertanyaan dengan cermat dan pilih jawaban yang paling tepat. Quiz ini terdiri dari pertanyaan pilihan ganda tentang browser dan sistem manajemen konten (CMS).
                            </div>

                            <!-- Quiz Status -->
                            <div class="text-center mb-4">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="border rounded p-3">
                                            <div class="h4 mb-0 text-warning">8</div>
                                            <small class="text-muted">Total Soal</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="border rounded p-3">
                                            <div class="h4 mb-0 text-info">25</div>
                                            <small class="text-muted">Menit</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="border rounded p-3">
                                            <div class="h4 mb-0 text-success">65</div>
                                            <small class="text-muted">Skor Min</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quiz Actions -->
                            <div class="text-center">
                                <button class="btn btn-warning btn-lg px-5" onclick="startQuiz()">
                                    <i class="fa-solid fa-play me-2"></i>Mulai Quiz
                                </button>
                                <p class="text-muted mt-2 mb-0">Pastikan koneksi internet stabil sebelum memulai</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quiz Rules -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light border-0">
                            <h6 class="mb-0 fw-bold"><i class="fa-solid fa-clipboard-list text-primary"></i> Aturan Quiz</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="fa-solid fa-clock text-warning mt-1"></i>
                                        <div>
                                            <strong>Waktu Terbatas</strong>
                                            <p class="small text-muted mb-0">Quiz harus diselesaikan dalam waktu 25 menit</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="fa-solid fa-shuffle text-info mt-1"></i>
                                        <div>
                                            <strong>Tidak Bisa Mundur</strong>
                                            <p class="small text-muted mb-0">Setelah menjawab, tidak bisa kembali ke soal sebelumnya</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="fa-solid fa-wifi text-success mt-1"></i>
                                        <div>
                                            <strong>Koneksi Stabil</strong>
                                            <p class="small text-muted mb-0">Pastikan koneksi internet stabil selama quiz</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="fa-solid fa-save text-danger mt-1"></i>
                                        <div>
                                            <strong>Otomatis Tersimpan</strong>
                                            <p class="small text-muted mb-0">Jawaban otomatis tersimpan setiap pergantian soal</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Quiz History -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-light border-0">
                            <h6 class="mb-0 fw-bold"><i class="fa-solid fa-history text-info"></i> Riwayat Quiz</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center py-4">
                                <i class="fa-solid fa-circle-question fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum pernah mengerjakan quiz ini</p>
                                <small class="text-muted">Quiz akan tersedia setelah Anda menyelesaikannya</small>
                            </div>
                        </div>
                    </div>

                    <!-- Study Materials -->
                    
                </div>
            </div>
        </div>
@endsection