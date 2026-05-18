@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
<div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <a href="kelas_detail_siswa.html" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                <h5 class="mb-0 fw-bold">Pengenalan Komputer dan Sistem Operasi</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-success bg-opacity-10 text-success rounded-pill"><i class="fa-solid fa-circle-check"></i> Topik Selesai</span>
            </div>
        </div>

        <div class="content-area">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Materi Content -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-light border-0">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary text-white rounded p-2">
                                    <i class="fa-solid fa-book-open-reader fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Materi Pembelajaran</h6>
                                    <small class="text-muted">Estimasi waktu: 15 menit</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">Apa itu Komputer?</h5>
                                <p class="text-muted">Komputer adalah alat elektronik yang dapat menerima data, memproses data, dan menghasilkan informasi. Komputer terdiri dari beberapa komponen utama yang saling bekerja sama.</p>

                                <div class="row g-3 mt-3">
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 text-center">
                                            <i class="fa-solid fa-keyboard text-primary fa-2x mb-2"></i>
                                            <h6 class="fw-bold">Input</h6>
                                            <p class="small text-muted">Perangkat untuk memasukkan data ke komputer</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 text-center">
                                            <i class="fa-solid fa-microchip text-warning fa-2x mb-2"></i>
                                            <h6 class="fw-bold">Process</h6>
                                            <p class="small text-muted">CPU memproses data menjadi informasi</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 text-center">
                                            <i class="fa-solid fa-memory text-success fa-2x mb-2"></i>
                                            <h6 class="fw-bold">Memory</h6>
                                            <p class="small text-muted">Penyimpanan sementara dan permanen</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 text-center">
                                            <i class="fa-solid fa-monitor text-info fa-2x mb-2"></i>
                                            <h6 class="fw-bold">Output</h6>
                                            <p class="small text-muted">Menampilkan hasil proses ke pengguna</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">Sistem Operasi</h5>
                                <p class="text-muted">Sistem operasi adalah perangkat lunak yang mengelola sumber daya komputer dan menyediakan antarmuka antara pengguna dengan perangkat keras.</p>

                                <div class="alert alert-info">
                                    <strong><i class="fa-solid fa-lightbulb"></i> Penting!</strong> Sistem operasi bertindak sebagai "jembatan" antara pengguna dan komponen perangkat keras komputer.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lampiran Files -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light border-0">
                            <h6 class="mb-0 fw-bold"><i class="fa-solid fa-paperclip text-primary"></i> Lampiran & Referensi</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between p-3 border rounded mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-file-pdf text-danger" style="font-size: 20px;"></i>
                                    <div>
                                        <div class="fw-bold">Panduan Lengkap Sistem Komputer.pdf</div>
                                        <small class="text-muted">PDF • 2.5 MB</small>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-download"></i> Unduh</button>
                            </div>

                            <div class="d-flex align-items-center justify-content-between p-3 border rounded mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-video text-danger" style="font-size: 20px;"></i>
                                    <div>
                                        <div class="fw-bold">Video Tutorial: Anatomi Komputer</div>
                                        <small class="text-muted">Video • 12 menit</small>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-play"></i> Tonton</button>
                            </div>

                            <div class="d-flex align-items-center justify-content-between p-3 border rounded">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-link text-primary" style="font-size: 20px;"></i>
                                    <div>
                                        <div class="fw-bold">Referensi Online: Komponen Komputer</div>
                                        <small class="text-muted">Link eksternal</small>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-external-link"></i> Buka</button>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
@endsection