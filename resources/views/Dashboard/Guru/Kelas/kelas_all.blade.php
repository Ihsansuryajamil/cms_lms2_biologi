@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
    
        <div class="topbar d-flex align-items-center w-100">
            <div class="d-flex align-items-center gap-3 w-100">
                <span class="fw-bold"><i class="fa-solid fa-chalkboard"></i> Kelas Saya</span>
                <select class="form-select w-auto"><option>Tahun Pelajaran 2025/2026 - (Aktif)</option></select>
                <select class="form-select w-auto"><option>Pilih Mata Pelajaran</option></select>
            </div>
        </div>

        <div class="content-area">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <div>
                    <a href="#" class="text-decoration-none fw-bold border-bottom border-primary border-3 pb-2 text-dark">Daftar Kelas</a>
                </div>
                <a href="{{ route('guru_kelas_tambah') }}" class="btn btn-sm border-3 rounded-pill text-white" style="background: #0d6efd;"><i class="fa-solid fa-plus"></i> Buat Kelas</a>
            </div>

            <div class="row row-cols-2 row-cols-md-2 row-cols-xl-4 g-4">
                <div class="col">
                    <div class="class-card">
                        <div class="card-cover" style="background: linear-gradient(135deg,#4f46e5,#818cf8);">
                            <span class="text-white small opacity-75"><i class="fa-regular fa-file-lines"></i> IX-B • Semester Ganjil</span>
                        </div>
                        <div style="background:#4f46e5; color:white; padding:8px 15px; font-size:0.8rem; display:flex; align-items:center; gap:10px;">
                            <i class="fa-solid fa-laptop-code"></i>
                            <span>Materi:<br><strong>Informatika</strong></span>
                        </div>
                        <div class="p-3">
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <span><i class="fa-solid fa-users"></i> 30 Peserta</span>
                                <span><i class="fa-regular fa-calendar"></i> 14/07/25</span>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-muted">Progress</span>
                                    <span class="text-primary fw-bold">60%</span>
                                </div>
                                <div class="progress" style="height:6px; border-radius:10px;">
                                    <div class="progress-bar bg-primary" style="width:60%;"></div>
                                </div>
                            </div>
                            <a href="{{ route('guru_class_detail') }}" class="btn btn-light w-100 text-primary border border-primary-subtle rounded-pill">Masuk Kelas</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="class-card">
                        <div class="card-cover" style="background: linear-gradient(135deg,#16a34a,#4ade80);">
                            <span class="text-white small opacity-75"><i class="fa-regular fa-file-lines"></i> IX-B • Semester Ganjil</span>
                        </div>
                        <div style="background:#16a34a; color:white; padding:8px 15px; font-size:0.8rem; display:flex; align-items:center; gap:10px;">
                            <i class="fa-solid fa-square-root-variable"></i>
                            <span>Materi:<br><strong>Matematika</strong></span>
                        </div>
                        <div class="p-3">
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <span><i class="fa-solid fa-users"></i> 30 Peserta</span>
                                <span><i class="fa-regular fa-calendar"></i> 14/07/25</span>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-muted">Progress</span>
                                    <span class="fw-bold" style="color:#16a34a;">45%</span>
                                </div>
                                <div class="progress" style="height:6px; border-radius:10px;">
                                    <div class="progress-bar" style="width:45%; background:#16a34a;"></div>
                                </div>
                            </div>
                            <a href="{{ route('guru_class_detail') }}" class="btn btn-light w-100 text-success border border-success-subtle rounded-pill">Masuk Kelas</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="class-card">
                        <div class="card-cover" style="background: linear-gradient(135deg,#ea580c,#fb923c);">
                            <span class="text-white small opacity-75"><i class="fa-regular fa-file-lines"></i> IX-B • Semester Ganjil</span>
                        </div>
                        <div style="background:#ea580c; color:white; padding:8px 15px; font-size:0.8rem; display:flex; align-items:center; gap:10px;">
                            <i class="fa-solid fa-book-open"></i>
                            <span>Materi:<br><strong>Bahasa Indonesia</strong></span>
                        </div>
                        <div class="p-3">
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <span><i class="fa-solid fa-users"></i> 30 Peserta</span>
                                <span><i class="fa-regular fa-calendar"></i> 14/07/25</span>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-muted">Progress</span>
                                    <span class="fw-bold" style="color:#ea580c;">80%</span>
                                </div>
                                <div class="progress" style="height:6px; border-radius:10px;">
                                    <div class="progress-bar" style="width:80%; background:#ea580c;"></div>
                                </div>
                            </div>
                            <a href="{{ route('guru_class_detail') }}" class="btn btn-light w-100 text-warning border border-warning-subtle rounded-pill">Masuk Kelas</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="class-card">
                        <div class="card-cover" style="background: linear-gradient(135deg,#dc2626,#f87171);">
                            <span class="text-white small opacity-75"><i class="fa-regular fa-file-lines"></i> IX-B • Semester Ganjil</span>
                        </div>
                        <div style="background:#dc2626; color:white; padding:8px 15px; font-size:0.8rem; display:flex; align-items:center; gap:10px;">
                            <i class="fa-solid fa-flask"></i>
                            <span>Materi:<br><strong>IPA</strong></span>
                        </div>
                        <div class="p-3">
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <span><i class="fa-solid fa-users"></i> 30 Peserta</span>
                                <span><i class="fa-regular fa-calendar"></i> 14/07/25</span>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-muted">Progress</span>
                                    <span class="fw-bold text-danger">30%</span>
                                </div>
                                <div class="progress" style="height:6px; border-radius:10px;">
                                    <div class="progress-bar bg-danger" style="width:30%;"></div>
                                </div>
                            </div>
                            <a href="{{ route('guru_class_detail') }}" class="btn btn-light w-100 text-danger border border-danger-subtle rounded-pill">Masuk Kelas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection