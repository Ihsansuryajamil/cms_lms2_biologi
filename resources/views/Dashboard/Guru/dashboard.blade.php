@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
<div class="dashboard-banner p-4 p-lg-5 text-white">
            <img src="https://cdn-icons-png.flaticon.com/512/3143/3143282.png" class="banner-bg-icon" alt="bg">
            
            <div class="position-relative z-1">
                <div class="row align-items-center mb-5">
                    <div class="col-lg-5">
                        <h2 class="fw-bold mb-3">Hi, Staff Komputer</h2>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-circle-user"></i>
                            <span class="fw-medium">Selamat datang di aplikasi pintar LMS!</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-7 mt-4 mt-lg-0">
                        <div class="d-flex flex-wrap gap-3 justify-content-lg-end">
                            <div class="stat-box d-flex align-items-center justify-content-between p-2 px-3 rounded-pill" style="min-width: 250px;">
                                <span class="fw-bold me-3">kelas</span>
                                <span class="fw-bold fs-5 me-3">9</span>
                                <button class="btn btn-light btn-sm rounded-pill fw-bold text-dark px-3 py-1">Lihat Kelas</button>
                            </div>
                            
                            <div class="stat-box d-flex align-items-center justify-content-between p-2 px-3 rounded-pill" style="min-width: 250px;">
                                <span class="fw-bold me-3">Siswa</span>
                                <span class="fw-bold fs-5 me-3">100</span>
                                <button class="btn btn-light btn-sm rounded-pill fw-bold text-dark px-3 py-1">Lihat Kelas</button>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-white opacity-25 mb-4">

                <div class="row g-4 pb-3">
                    <div class="col-md-6">
                        <div class="card border-0 rounded-4 shadow-sm p-4 text-center h-100">
                            <h6 class="fw-bold text-dark mb-4 mt-2">Pemberian Nilai Tugas</h6>
                            
                            <div class="px-2">
                                <div class="progress-label-container w-100">
                                    <div class="progress-line"></div>
                                    <div class="progress-label left">Belum Mengikuti</div>
                                    <div class="progress-label right">Selesai</div>
                                </div>
                                <div class="progress custom-progress mt-3 w-100 shadow-sm">
                                    <div class="progress-bar progress-danger-custom d-flex justify-content-end pe-3 text-white fw-bold" style="width: 47%;">47%</div>
                                    <div class="progress-bar progress-success-custom d-flex justify-content-start ps-3 text-white fw-bold" style="width: 53%;">53%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card border-0 rounded-4 shadow-sm p-4 text-center h-100">
                            <h6 class="fw-bold text-dark mb-4 mt-2">Pengumpulan Tugas Siswa</h6>
                            
                            <div class="px-2">
                                <div class="progress-label-container w-100">
                                    <div class="progress-line"></div>
                                    <div class="progress-label left">Belum Mengikuti</div>
                                    <div class="progress-label right">Selesai</div>
                                </div>
                                <div class="progress custom-progress mt-3 w-100 shadow-sm">
                                    <div class="progress-bar progress-danger-custom d-flex justify-content-end pe-3 text-white fw-bold" style="width: 71%;">71%</div>
                                    <div class="progress-bar progress-success-custom d-flex justify-content-start ps-3 text-white fw-bold" style="width: 29%;">29%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-area">
            <div class="notification-list">
                <div class="notification-item unread">
                    <span class="notification-icon bg-primary-subtle text-primary"><i class="fa-solid fa-user-plus"></i></span>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start gap-2">
                            <div>
                                <div class="fw-semibold">Permintaan bergabung kelas baru</div>
                                <div class="text-muted small">12 siswa meminta akses ke kelas "IX-B Informatika".</div>
                            </div>
                            <small class="text-muted">Baru saja</small>
                        </div>
                    </div>
                </div>

                <div class="notification-item unread">
                    <span class="notification-icon bg-success-subtle text-success"><i class="fa-solid fa-clipboard-check"></i></span>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start gap-2">
                            <div>
                                <div class="fw-semibold">Tugas telah dipublikasikan</div>
                                <div class="text-muted small">Tugas "Laporan Praktikum Sistem Komputer" berhasil dipublikasikan.</div>
                            </div>
                            <small class="text-muted">5 menit lalu</small>
                        </div>
                    </div>
                </div>

                <div class="notification-item">
                    <span class="notification-icon bg-warning-subtle text-warning"><i class="fa-solid fa-circle-exclamation"></i></span>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start gap-2">
                            <div>
                                <div class="fw-semibold">Ada 4 tugas terlambat dikumpulkan</div>
                                <div class="text-muted small">Periksa detail pengumpulan pada kelas "IX-B Matematika".</div>
                            </div>
                            <small class="text-muted">1 jam lalu</small>
                        </div>
                    </div>
                </div>

                <div class="notification-item">
                    <span class="notification-icon bg-info-subtle text-info"><i class="fa-solid fa-gear"></i></span>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start gap-2">
                            <div>
                                <div class="fw-semibold">Pengaturan website berhasil diperbarui</div>
                                <div class="text-muted small">Nama website dan hero index diperbarui oleh Super Admin.</div>
                            </div>
                            <small class="text-muted">Kemarin</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection