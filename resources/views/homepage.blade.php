
@extends('Layouts.appDepan')
@section('content')
    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="hero-title mb-3">Portal Pendidikan<br>LMS Pembelajaran</h1>
                    <p class="hero-subtitle mb-0">Jelajahi materi dan ruang kelas interaktif untuk mendukung kegiatan belajar mengajar yang efektif baik di sekolah maupun di rumah.</p>
                </div>
            </div>
        </div>
    </header>

    <section id="courses-container" class="toolbar-section">
        <div class="container d-flex flex-wrap justify-content-between align-items-center gap-3">
            
            <div class="search-wrapper">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input type="text" class="form-control" placeholder="Cari materi pembelajaran...">
            </div>

            <div class="d-flex align-items-center gap-2">
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small fw-medium text-nowrap d-none d-sm-inline">Urutkan:</span>
                    <select class="form-select filter-select">
                        <option>Terbaru (Rilis Pertama)</option>
                        <option>Abjad (A-Z)</option>
                    </select>
                </div>
                <div class="d-flex gap-1 border-start ps-2 ms-1">
                    <button class="view-toggle-btn active" title="Grid View"><i class="fa-solid fa-table-cells-large"></i></button>
                    <button class="view-toggle-btn" title="List View"><i class="fa-solid fa-list"></i></button>
                </div>
            </div>

        </div> 
    </section>

    <section class="py-5">
        <div class="container">
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
                    
                    <a href="{{ route('detail_course', $course->id) }}" class="btn btn-light mt-3 w-100 text-primary border border-primary-subtle">Lihat Materi</a>
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
                
                <a href="{{ route('detail_course', $course->id) }}" class="btn btn-preview-course text-center text-decoration-none d-block">LIHAT MATERI</a>
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
                        Guru belum membuat materi pembelajaran apa pun saat ini.
                    </p>
                    
                </div>
            </div>
        </div>
    @endforelse
</div>
        </div>
    </section>
@endsection