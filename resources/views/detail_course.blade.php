@extends('Layouts.appDepan')
@section('content')

    <header class="course-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pe-lg-5">
                    
                    <div class="breadcrumb-custom">
                        <a href="{{ route('homepage') }}">Beranda</a> &nbsp;<i class="fa-solid fa-chevron-right fa-xs"></i>&nbsp; 
                        <a href="#">Materi</a> &nbsp;<i class="fa-solid fa-chevron-right fa-xs"></i>&nbsp; 
                        <span class="text-white">{{ $course->nama_course }}</span>
                    </div>

                    <h1 class="course-header-title">{{ $course->nama_course }}</h1>

                    <p class="course-header-desc">
                        {{ $course->deskripsi }}
                    </p>

                    <!-- <div class="course-meta mb-3">
                        <span class="badge-bestseller">1,832</span>
                        <span>Siswa terdaftar</span>
                    </div> -->
                    <div class="course-meta">
                        @php
                            // Mengambil nama pembuat kelas dari relasi user
                            $namaGuru = $course->pembuat->nama ?? 'Instruktur';
                        @endphp
                        <span>Dibuat oleh <a href="#" class="text-warning text-decoration-none fw-bold">{{ $namaGuru }}</a></span>
                        <span><i class="fa-solid fa-circle-exclamation text-white"></i> Terakhir diperbarui {{$course->updated_at->format('d M Y')}}</span>
                        <span><i class="fa-solid fa-globe text-white"></i> Bahasa Indonesia</span>
                    </div>
                    <!-- <div class="course-meta">
                        <span>Dibuat oleh <a href="#instructor" class="text-warning text-decoration-none">Cita Tresnawati</a></span>
                        <span><i class="fa-solid fa-circle-exclamation text-white"></i> Terakhir diperbarui 05/2026</span>
                        <span><i class="fa-solid fa-globe text-white"></i> Bahasa Indonesia</span>
                    </div> -->

                </div>
            </div>
        </div>
    </header>

    <section class="content-section">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-8 pe-lg-5">
                    

                    <div class="accordion shadow-sm rounded-4 overflow-hidden" id="accordionKurikulumSiswa">
                        @forelse($course->topics as $topic)
                            <div class="accordion-item border-0 border-bottom bg-white">
                                <h2 class="accordion-header" id="headingSiswa{{ $topic->id }}">
                                    <button class="accordion-button collapsed bg-white py-3 px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSiswa{{ $topic->id }}" aria-expanded="false">
                                        <div class="d-flex align-items-center gap-3 w-100">
                                            <div class="bg-primary text-white rounded p-3" style="min-width: 50px; text-align: center;">
                                        <i class="fa-solid fa-book-open-reader"></i>
                                    </div>
                                            <div>
                                                <h6 class="fw-bold mb-0 text-dark">{{ $topic->nama_topic }}</h6>
                                                <span class="small text-muted fw-normal">{{ $topic->subTopics->count() }} Sub Bab • {{ $topic->durasi_pembelajaran }} Menit</span>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                
                                <div id="collapseSiswa{{ $topic->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionKurikulumSiswa">
                                    <div class="accordion-body bg-white px-4 py-2 border-top">
                                        
                                        @forelse($topic->subTopics as $sub)
                                            <div class="d-flex align-items-center justify-content-between py-3 border-bottom border-light">
                                                <div class="d-flex align-items-center gap-3">
                                                    <span class="text-muted small fw-bold" style="min-width: 20px;">{{ $sub->urutan }}</span>
                                                    
                                                    @if($sub->jenis == 'materi')
                                                        <i class="fa-solid fa-file-lines text-primary"></i>
                                                    @elseif($sub->jenis == 'tugas')
                                                        <i class="fa-solid fa-clipboard-list text-warning"></i>
                                                    @else
                                                        <i class="fa-solid fa-clipboard-question text-danger"></i>
                                                    @endif
                                                    
                                                    <span class="text-dark small fw-medium">{{ $sub->judul }}</span>
                                                </div>
                                                <div>
                                                    <span class="badge bg-light text-secondary text-uppercase border px-2 py-1" style="font-size: 0.65rem; letter-spacing: 0.5px;">{{ $sub->jenis }}</span>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-muted small text-center py-3 my-0">Belum ada aktivitas pembelajaran di bab ini.</p>
                                        @endforelse
                                        
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-4 text-center bg-white text-muted small border rounded-4">
                                Belum ada materi kurikulum yang diterbitkan untuk kelas ini.
                            </div>
                        @endforelse
                    </div>

                    <h2 class="section-title mt-4 fs-5">Persyaratan</h2>
                    <div class="text-muted small mb-4" style="line-height: 1.8;">
                        {{ $course->persyaratan ?? 'Tidak ada persyaratan khusus untuk mengikuti materi pembelajaran ini.' }}
                    </div>
                    
                    <h2 class="section-title fs-5">Deskripsi Kelas</h2>
                    <div class="text-muted small mb-5" style="line-height: 1.8;">
                        {{ $course->deskripsi }}
                    </div>
                </div>

                <div class="col-lg-4 course-sidebar-wrapper">
                    <div class="sidebar-card">
                        
                        <div class="sidebar-preview-img position-relative" style="height: 220px; border-radius: 12px 12px 0 0; overflow: hidden; background-color: #000;">
                            @if($course->link_video)
                                @php
                                    $embedUrl = $course->link_video;
                                    
                                    // 1. YOUTUBE & YOUTUBE SHORTS
                                    if (str_contains($embedUrl, 'youtube.com') || str_contains($embedUrl, 'youtu.be')) {
                                        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/shorts\/)([a-zA-Z0-9_-]{11})/', $embedUrl, $matches)) {
                                            $embedUrl = "https://www.youtube.com/embed/" . $matches[1];
                                        }
                                    } 
                                    
                                    // 2. TIKTOK
                                    elseif (str_contains($embedUrl, 'tiktok.com')) {
                                        if (preg_match('/\/video\/(\d+)/', $embedUrl, $matches)) {
                                            $embedUrl = "https://www.tiktok.com/embed/v2/" . $matches[1];
                                        }
                                    } 
                                    
                                    // 3. GOOGLE DRIVE
                                    elseif (str_contains($embedUrl, 'drive.google.com')) {
                                        $embedUrl = str_replace(['/view', '/edit'], '/preview', $embedUrl);
                                        $embedUrl = explode('?', $embedUrl)[0]; // Bersihkan parameter
                                    }
                                    
                                    // 4. VIMEO (Sering digunakan untuk video course premium)
                                    elseif (str_contains($embedUrl, 'vimeo.com')) {
                                        if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $embedUrl, $matches)) {
                                            $embedUrl = "https://player.vimeo.com/video/" . $matches[1];
                                        }
                                    }
                                    
                                    // 5. LOOM (Banyak digunakan guru untuk rekam layar penjelasan)
                                    elseif (str_contains($embedUrl, 'loom.com/share')) {
                                        $embedUrl = str_replace('/share/', '/embed/', $embedUrl);
                                    }
                                    
                                    // 6. DAILYMOTION
                                    elseif (str_contains($embedUrl, 'dailymotion.com')) {
                                        if (preg_match('/dailymotion\.com\/video\/([a-zA-Z0-9]+)/', $embedUrl, $matches)) {
                                            $embedUrl = "https://www.dailymotion.com/embed/video/" . $matches[1];
                                        }
                                    }
                                    
                                    // 7. CANVA PRESENTATION (Mengizinkan presentasi langsung digeser di web)
                                    elseif (str_contains($embedUrl, 'canva.com/design')) {
                                        $embedUrl = explode('?', $embedUrl)[0]; // Buang parameter ekstra
                                        if (str_ends_with($embedUrl, '/edit')) {
                                            $embedUrl = str_replace('/edit', '/view?embed', $embedUrl);
                                        } elseif (str_ends_with($embedUrl, '/view')) {
                                            $embedUrl .= '?embed';
                                        } else {
                                            $embedUrl .= '/view?embed';
                                        }
                                    }
                                @endphp

                                <iframe src="{{ $embedUrl }}" 
                                        width="100%" 
                                        height="220" 
                                        style="border: none; display: block;" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen>
                                </iframe>
                            @else
                                @if($course->avatar)
                                    <img src="{{ asset('image/course/avatar/' . $course->avatar) }}" alt="Preview" class="w-100 h-100 object-fit-cover">
                                @else
                                    <img src="https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?auto=format&fit=crop&w=600&q=80" alt="Preview" class="w-100 h-100 object-fit-cover">
                                @endif
                            @endif
                        </div>

                        <div class="sidebar-content p-4 bg-white" style="border-radius: 0 0 12px 12px;">
                            <div class="price-tag fw-bold fs-3 text-dark mb-3">Gratis</div>
                            
                            <a href="{{ route('login') }}" class="btn btn-enroll text-center text-decoration-none d-block w-100 py-3 rounded-pill fw-bold text-white" style="background-color: #0d6efd; border: none;">
                                DAFTAR SEKARANG
                            </a>
                            
                            <p class="text-center text-muted small mt-3 mb-4">Akses materi selamanya setelah mendaftar</p>
                            
                            <div class="d-flex justify-content-center gap-4 mt-4 pt-3 border-top text-muted small fw-medium">
                                <span style="cursor: pointer;"><i class="fa-solid fa-share ms-1 me-1"></i> Bagikan</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection