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
                        <h2 class="fw-bold mb-3">Hi, {{ auth()->user()->nama ?? 'User' }}</h2>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-circle-user"></i>
                            <span class="fw-medium">Selamat datang di website {{ $webSettings->nama_website }}!</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-7 mt-4 mt-lg-0">
                        <div class="d-flex flex-wrap gap-3 justify-content-lg-end">
                            <div class="stat-box d-flex align-items-center justify-content-between p-2 px-3 rounded-pill" style="min-width: 250px;">
                                <span class="fw-bold me-3">kelas</span>
                                <span class="fw-bold fs-5 me-3">9</span>
                                <a href="{{ route('guru_class_all') }}" class="btn btn-light btn-sm rounded-pill fw-bold text-dark px-3 py-1">Lihat Kelas</a>
                            </div>
                            
                            <div class="stat-box d-flex align-items-center justify-content-between p-2 px-3 rounded-pill" style="min-width: 250px;">
                                <span class="fw-bold me-3">Siswa</span>
                                <span class="fw-bold fs-5 me-3">10</span>
                                <a href="{{ route('guru_user_management') }}" class="btn btn-light btn-sm rounded-pill fw-bold text-dark px-3 py-1">Lihat Siswa</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <hr class="border-white opacity-25 mb-4">

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
                </div> -->
                <div class="card card-custom p-4 border-0 mb-3">
                    <h5 class="fw-bold text-dark mb-3">{{ $webSettings->nama_website }}</h5>
                    <p class="text-muted" style="line-height: 1.8; font-size: 0.95rem; text-align: justify;">
                        LMS Biologi School adalah aplikasi Learning Management System yang dirancang untuk merencanakan, mendistribusikan, mengelola, dan melacak aktivitas pembelajaran secara online. Sistem ini berfungsi layaknya ruang kelas virtual untuk kegiatan pendidikan, pelatihan, atau pengembangan keterampilan.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="content-area">
            <div class="container-fluid p-0">
            <div class="card card-custom p-4 border-0 mb-3">
                <div class="row">
                    <div class="col-lg-8">
                        
                    <h5 class="fw-bold text-dark mb-3">Panduan Aplikasi</h5>
                    </div>
                    <div class="col-lg-4">
                        
                    <!-- <a href="panduan.html" class="btn btn-primary text-white d-none d-sm-block">
                        <i class="bi bi-pen me-1"></i> Update Panduan
                    </a> -->
                    </div>
                </div>
                <div class="card border-0 shadow h-100 mt-2">
                    <div class="card-body p-0">
                        <iframe 
                            src="{{ asset('lms_biologi/Manual_Book_USER_KKN_UNFARI.pdf') }}" 
                            width="100%" 
                            height="500px" 
                            style="border: none;"
                            allowfullscreen>
                            
                            <div class="text-center p-5">
                                <p>Browser Anda tidak mendukung tampilan PDF secara langsung.</p>
                                <a href="../assets/Panduan_Penggunaan.pdf" class="btn btn-primary">Klik untuk Download PDF</a>
                            </div>
                        </iframe>
                    </div>
                </div>
            </div>
            
            
            
        </div>

        <footer class="mt-auto text-muted small">
            <p>Copyright &copy; 2026 Arini rahmadana</p>
        </footer>
        </div>
@endsection