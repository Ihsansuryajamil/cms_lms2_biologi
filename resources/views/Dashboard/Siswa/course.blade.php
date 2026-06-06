@extends('Layouts.appSiswa')

@section('content')
    <section id="courses-container" class="toolbar-section" style="height: auto; padding-top: 6rem;">
        <div class="container">
            @if(Auth::user()->status === 'active') 
                <form action="{{ route('students_course') }}" method="GET">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                        
                        <div class="search-wrapper">
                            <i class="fa-solid fa-magnifying-glass search-icon"></i>
                            <input type="text" name="search" class="form-control" placeholder="Cari materi pembelajaran..." value="{{ request('search') }}">
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-muted small fw-medium text-nowrap d-none d-sm-inline">Urutkan:</span>
                                <select class="form-select filter-select" name="sort" onchange="this.form.submit()">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru (Rilis Pertama)</option>
                                </select>
                            </div>
                            <div class="d-flex gap-1 border-start ps-2 ms-1">
                                <button type="submit" class="btn btn-sm btn-warning border-2 rounded-pill text-black w-100" style="font-size: 0.85rem; padding: 6px 16px;">
                                    <i class="fa-solid fa-magnifying-glass"></i> Cari
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            @else
                <div class="d-flex align-items-center gap-2 text-muted">
                    <span class="small fw-semibold"><i class="fa-solid fa-lock me-2"></i> Portal Pembelajaran Terkunci sementara</span>
                </div>
            @endif
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            
            @if(Auth::user()->status === 'inactive')
                
                <div class="row justify-content-center py-4">
                    <div class="col-md-7 text-center">
                        <div class="card border-0 shadow-sm p-5 rounded-4 bg-white">
                            <div class="card-body">
                                <div class="text-danger mb-4">
                                    <i class="fa-solid fa-user-lock" style="font-size: 4.5rem; opacity: 0.8;"></i>
                                </div>
                                <h4 class="fw-bold text-dark mb-2">Akun Anda Belum Aktif!</h4>
                                <p class="text-muted small mb-4 mx-auto" style="max-width: 450px; line-height: 1.6;">
                                    Status pendaftaran akun Anda saat ini masih <strong class="text-danger">Nonaktif (Inactive)</strong>. Anda belum diizinkan untuk mengakses atau membaca materi pembelajaran biologi.
                                </p>
                                <div class="alert alert-warning border-0 rounded-3 small p-3 mb-0 text-start d-flex gap-3 align-items-center" style="background-color: #fff3cd; color: #664d03;">
                                    <i class="fa-solid fa-circle-info fs-5 mt-0.5 text-warning"></i>
                                    <span><strong>Petunjuk Akses:</strong> Mohon segera hubungi Guru Pengajar terkait atau pihak Administrator sekolah untuk mengaktifkan akun Anda.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
                    @forelse ($courses as $course)
                        @php
                            $namaGuru = $course->pembuat->nama ?? 'Instruktur';
                        @endphp
                        
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
                                    
                                    <span> <i class="fa-solid fa-user"></i><span class="course-category"> {{ $namaGuru }}</span></span>
                                    
                                    <a href="{{ route('students_detail_course', $course->id) }}" class="btn btn-light mt-3 w-100 text-primary border border-primary-subtle">Lihat Materi</a>
                                </div>
                            </div>

                            <div class="course-popover">
                                <div class="popover-header d-flex align-items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($namaGuru) }}&background=16a34a&color=fff" alt="Instruktur" style="border-radius: 50%; width: 40px; height: 40px;">
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">{{ $course->nama_course }}</h6>
                                        <small class="text-muted">Oleh: {{ $namaGuru }}</small>
                                    </div>
                                </div>
                                
                                <p class="small text-muted mt-3 mb-0" style="line-height: 1.5;">
                                    {{ Str::limit($course->deskripsi, 350) }}
                                </p>
                                <div class="popover-specifications">
                                    <div class="spec-item">
                                        <i class="fa-solid fa-book-open"></i>
                                        {{ $course->topics->count() }} Topik
                                    </div>
                                    <div class="spec-item">
                                        <i class="fa-regular fa-clock"></i>
                                        Materi Online
                                    </div>
                                </div>
                                
                                <a href="{{ route('students_detail_course', $course->id) }}" class="btn btn-preview-course text-center text-decoration-none d-block">LIHAT MATERI</a>
                            </div>
                        </div>
                        
                    @empty
                        <div class="col-12 w-100 text-center py-5">
                            <div class="card bg-white border-0 shadow-sm p-5 rounded-4 mx-auto" style="max-width: 600px;">
                                <div class="card-body">
                                    <div class="mb-4 text-warning">
                                        <i class="fa-solid fa-folder-open" style="font-size: 4.5rem; opacity: 0.7;"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-2">Materi Tidak Ditemukan</h5>
                                    <p class="text-muted small mb-0 mx-auto" style="max-width: 400px;">
                                        Tidak ada materi pembelajaran yang cocok dengan kata kunci pencarian Anda saat ini.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

            @endif

        </div>
    </section>
@endsection