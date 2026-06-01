@extends('Layouts.app')

@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection

@section('content')
    <div class="topbar d-flex align-items-center w-100">
        <div class="d-flex align-items-center gap-3 w-100">
            <span class="fw-bold"><i class="fa-solid fa-chalkboard"></i> Materi Pembelajaran</span>
        </div>
    </div>

    <div class="content-area">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
            <div>
                <a href="#" class="text-decoration-none fw-bold border-bottom border-primary border-3 pb-2 text-dark">Daftar Materi</a>
            </div>
            <a href="{{ route('guru_course_tambah') }}" class="btn btn-sm border-3 rounded-pill text-white" style="background: #0d6efd;">
                <i class="fa-solid fa-plus"></i> Tambah Materi
            </a>
        </div>
        
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
            @forelse ($courses as $course)
                <div class="col course-item-wrapper">
                    <div class="course-card">
                        <div class="course-img-container">
                            @if($course->avatar)
                                <img src="{{ asset('image/course/avatar/' . $course->avatar) }}" alt="Course Cover" class="w-100 object-fit-cover" style="height: 160px;">
                            @else
                                <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&q=80" alt="Course Cover" class="w-100 object-fit-cover" style="height: 160px;">
                            @endif
                        </div>
                        <div class="card-body-custom">
                            <h6 class="course-title">{{ Str::limit($course->nama_course, 25) }}</h6>
                            <span> <i class="fa-solid fa-user"></i><span class="course-category"> {{ Auth::user()->nama }}</span></span>
                            <a href="{{ route('guru_course_detail', $course->id) }}" class="btn btn-light mt-3 w-100 text-primary border border-primary-subtle">Lihat Materi</a>
                        </div>
                        
                    </div>

                    <div class="course-popover">
                        <div class="popover-header d-flex align-items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}&background=16a34a&color=fff" alt="Instruktur" style="border-radius: 50%; width: 40px; height: 40px;">
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">{{ $course->nama_course }}</h6>
                                <small class="text-muted">Oleh: {{ Auth::user()->nama }}</small>
                            </div>
                        </div>
                        
                        <p class="small text-muted mt-3 mb-0" style="line-height: 1.5;">
                            {{ Str::limit($course->deskripsi, 350) }}
                        </p>
                        
                        <!-- <div class="popover-specifications">
                            <div class="spec-item">
                                <i class="fa-solid fa-book-open"></i>
                                26 Materi
                            </div>
                            <div class="spec-item">
                                <i class="fa-regular fa-clock"></i>
                                4 Jam
                            </div>
                        </div> -->

                        <a href="{{ route('guru_course_detail', $course->id) }}" class="btn btn-preview-course text-center text-decoration-none d-block">LIHAT MATERI</a>
                        
                        
                    </div>
                </div>
                
            @empty
                <div class="col-12 w-100 text-center py-5">
                    <div class="card bg-white border-0 shadow-sm p-5 rounded-4 mx-auto" style="max-width: 600px;">
                        <div class="card-body">
                            <div class="mb-4 text-warning">
                                <i class="fa-solid fa-folder-open" style="font-size: 4.5rem; opacity: 0.7;"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">Belum Ada Kelas atau Materi</h5>
                            <p class="text-muted small mb-4 mx-auto" style="max-width: 400px;">
                                Anda belum membuat materi pembelajaran apa pun saat ini. Silakan buat materi baru untuk memulai proses pembelajaran siswa Anda.
                            </p>
                            <a href="{{ route('guru_course_tambah') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm border-0" style="background-color: #0d6efd;">
                                <i class="fa-solid fa-plus me-1"></i> Buat Materi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection