@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarSiswa')
@endsection
@section('content')
<div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <a href="kelas_detail_siswa.html" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                <h5 class="mb-0 fw-bold">Algoritma dan Pemrograman Dasar</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill"><i class="fa-solid fa-lock"></i> Belum Dibuka</span>
            </div>
        </div>

        <div class="content-area">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Tugas Info -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-light border-0">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-secondary text-white rounded p-2">
                                    <i class="fa-solid fa-clipboard-check fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Tugas: Memahami Sistem Komputer: Input, Proses, dan Output</h6>
                                    <small class="text-muted">Nilai maksimal: 100 • Deadline: 15 Agustus 2025, 17:00</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-warning mb-4">
                                <strong><i class="fa-solid fa-lock"></i> Tugas Belum Dapat Dikerjakan</strong>
                                <p class="mb-0">Tugas ini akan terbuka setelah Anda menyelesaikan topik sebelumnya.</p>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold mb-3">Instruksi Tugas</h6>
                                <div class="border rounded p-3 bg-light">
                                    <p class="mb-2">Pembahasan fungsi tiap komponen komputer untuk menerima, menyimpan, memproses, dan menampilkan data.</p>
                                    <p class="mb-0">Buatlah laporan lengkap dengan penjelasan masing-masing komponen dan berikan contoh penggunaannya dalam kehidupan sehari-hari.</p>
                                </div>
                            </div>

                            <!-- Requirements -->
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3">Persyaratan Pengumpulan</h6>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap-2 p-2 border rounded">
                                            <i class="fa-solid fa-file-upload text-success"></i>
                                            <small>Laporan tertulis (DOC/PDF)</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap-2 p-2 border rounded">
                                            <i class="fa-solid fa-images text-info"></i>
                                            <small>Gambar/diagram komponen</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap-2 p-2 border rounded">
                                            <i class="fa-solid fa-font text-warning"></i>
                                            <small>Jawaban teks (minimal 500 kata)</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap-2 p-2 border rounded">
                                            <i class="fa-solid fa-link text-primary"></i>
                                            <small>Link referensi (opsional)</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Submission Status -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-light border-0">
                            <h6 class="mb-0 fw-bold"><i class="fa-solid fa-upload text-info"></i> Status Pengumpulan</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center py-3">
                                <i class="fa-solid fa-lock fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-1">Tugas terkunci</p>
                                <small class="text-muted">Selesaikan topik sebelumnya untuk membuka tugas ini</small>
                            </div>
                        </div>
                    </div>

                    <!-- Deadline Info -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-light border-0">
                            <h6 class="mb-0 fw-bold"><i class="fa-solid fa-calendar-days text-danger"></i> Tenggat Waktu</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <div class="h3 mb-1 text-danger">15</div>
                                <div class="text-muted small mb-2">Agustus 2025</div>
                                <div class="badge bg-danger">17:00 WIB</div>
                            </div>
                            <hr>
                            <div class="small text-muted text-center">
                                <div><i class="fa-solid fa-clock me-1"></i> 7 hari lagi</div>
                                <div><i class="fa-solid fa-calendar me-1"></i> Jumat, 15 Agustus 2025</div>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
@endsection