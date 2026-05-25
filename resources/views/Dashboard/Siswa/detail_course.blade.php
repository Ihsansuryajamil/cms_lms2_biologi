@extends('Layouts.appSiswa')
@section('content')

    <header class="course-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pe-lg-5">
                    
                    <div class="breadcrumb-custom">
                        <a href="index.html">Beranda</a> &nbsp;<i class="fa-solid fa-chevron-right fa-xs"></i>&nbsp; 
                        <a href="#">Biologi Sel</a> &nbsp;<i class="fa-solid fa-chevron-right fa-xs"></i>&nbsp; 
                        <span class="text-white">Sintesis Protein</span>
                    </div>

                    <h1 class="course-header-title">Sintesis Protein Lanjutan: Transkripsi & Translasi</h1>
                    
                    <p class="course-header-desc">
                        Tujuan Pembelajaran: Setelah menyelesaikan modul metabolisme, siswa dapat menjabarkan proses transkripsi dan translasi RNA secara komprehensif serta memahami kebiasaan berpikir ilmiah.
                    </p>

                    <div class="course-meta mb-3">
                        <span class="badge-bestseller">1,832</span>
                        <span>Siswa terdaftar</span>
                    </div>

                    <div class="course-meta">
                        <span>Dibuat oleh <a href="#instructor" class="text-warning text-decoration-none">Cita Tresnawati</a></span>
                        <span><i class="fa-solid fa-circle-exclamation text-white"></i> Terakhir diperbarui 05/2026</span>
                        <span><i class="fa-solid fa-globe text-white"></i> Bahasa Indonesia</span>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <section class="content-section">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-8 pe-lg-5">
                    

                    <div class="accordion mb-5" id="courseAccordion">
                        
                        <div class="accordion-item border-0 border-bottom">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true">
                                    <div class="d-flex justify-content-between w-100 pe-3">
                                        <span>Pengenalan Materi Genetik</span>
                                        <span class="small text-muted fw-normal">5 Materi • 45m</span>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#courseAccordion">
                                <div class="accordion-body bg-white">
                                    <div class="topic-detail-item">
                                        <span class="item-number">1</span>
                                        <i class="fa-solid fa-book item-icon text-success"></i>
                                        <a href="login.html" class="item-title">Pre Test Sintesis Protein</a>
                                        <span class="item-type">Text lesson</span>
                                    </div>
                                    <div class="topic-detail-item">
                                        <span class="item-number">2</span>
                                        <i class="fa-solid fa-book item-icon text-success"></i>
                                        <a href="login.html" class="item-title">Essay Sintesis Protein</a>
                                        <span class="item-type">Text lesson</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 border-bottom">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    <div class="d-flex justify-content-between w-100 pe-3">
                                        <span>RIBOSOM</span>
                                        <span class="small text-muted fw-normal">5 Materi • 1j 30m</span>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#courseAccordion">
                                <div class="accordion-body bg-white">
                                    <div class="topic-detail-item">
                                        <span class="item-number">3</span>
                                        <i class="fa-solid fa-book item-icon text-success"></i>
                                        <a href="login.html" class="item-title">PENDAHULUAN</a>
                                        <span class="item-type">Text lesson</span>
                                    </div>
                                    <div class="topic-detail-item">
                                        <span class="item-number">4</span>
                                        <i class="fa-solid fa-book item-icon text-success"></i>
                                        <a href="login.html" class="item-title">RIBOSOM</a>
                                        <span class="item-type">Text lesson</span>
                                    </div>
                                    <div class="topic-detail-item">
                                        <span class="item-number">5</span>
                                        <i class="fa-solid fa-book item-icon text-success"></i>
                                        <a href="login.html" class="item-title">STRUKTUR RIBOSOM</a>
                                        <span class="item-type">Text lesson</span>
                                    </div>
                                    <div class="topic-detail-item">
                                        <span class="item-number">6</span>
                                        <i class="fa-solid fa-circle-question item-icon text-warning"></i>
                                        <a href="login.html" class="item-title">FUN QUIZ - STRUKTUR RIBOSOM</a>
                                        <span class="item-type">1 questions</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 border-bottom">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    <div class="d-flex justify-content-between w-100 pe-3">
                                        <span>ASAM NUKLEAT</span>
                                        <span class="small text-muted fw-normal">5 Materi • 1j 45m</span>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#courseAccordion">
                                <div class="accordion-body bg-white">
                                    <div class="topic-detail-item">
                                        <span class="item-number">7</span>
                                        <i class="fa-solid fa-book item-icon text-success"></i>
                                        <a href="login.html" class="item-title">ASAM NUKLEAT - PENDAHULUAN</a>
                                        <span class="item-type">Text lesson</span>
                                    </div>
                                    <div class="topic-detail-item">
                                        <span class="item-number">8</span>
                                        <i class="fa-solid fa-book item-icon text-success"></i>
                                        <a href="login.html" class="item-title">STRUKTUR DNA & RNA</a>
                                        <span class="item-type">Text lesson</span>
                                    </div>
                                    <div class="topic-detail-item">
                                        <span class="item-number">9</span>
                                        <i class="fa-solid fa-circle-question item-icon text-warning"></i>
                                        <a href="login.html" class="item-title">FUN QUIZ - STRUKTUR DNA</a>
                                        <span class="item-type">1 questions</span>
                                    </div>
                                    <div class="topic-detail-item">
                                        <span class="item-number">10</span>
                                        <i class="fa-solid fa-book item-icon text-success"></i>
                                        <a href="login.html" class="item-title">PERBEDAAN DNA & RNA</a>
                                        <span class="item-type">Text lesson</span>
                                    </div>
                                    <div class="topic-detail-item">
                                        <span class="item-number">11</span>
                                        <i class="fa-solid fa-book item-icon text-success"></i>
                                        <a href="login.html" class="item-title">JENIS RNA</a>
                                        <span class="item-type">Text lesson</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2 class="section-title fs-5">Persyaratan</h2>
                    <ul class="text-muted small mb-4" style="line-height: 1.6;">
                        <li>Siswa diharapkan telah menyelesaikan kelas Dasar Biologi Sel.</li>
                        <li>Memiliki koneksi internet yang stabil untuk memutar video pembelajaran.</li>
                    </ul>

                    <h2 class="section-title fs-5">Deskripsi Kelas</h2>
                    <div class="text-muted small mb-5" style="line-height: 1.8;">
                        <p>Selamat datang di kelas Sintesis Protein Lanjutan. Kelas ini dirancang khusus untuk siswa SMP/SMA yang ingin mendalami proses biokimia terpenting di dalam tubuh makhluk hidup, yaitu bagaimana DNA diterjemahkan menjadi protein yang membentuk sifat fisik dan enzim tubuh.</p>
                        <p>Melalui metode visual yang interaktif dan penjelasan langkah demi langkah, instruktur akan membimbing Anda mulai dari tahap di dalam nukleus hingga ke ribosom. Anda tidak hanya disajikan teori, tetapi juga simulasi kasus untuk membaca kode genetik dengan benar.</p>
                    </div>
                </div>

                <div class="col-lg-4 course-sidebar-wrapper">
                    <div class="sidebar-card">
                        
                        <div class="sidebar-preview-img">
                            <img src="https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?auto=format&fit=crop&w=600&q=80" alt="Preview Video">
                            <div class="play-overlay">
                                <i class="fa-solid fa-play ps-1"></i>
                            </div>
                        </div>

                        <div class="sidebar-content">
                            <div class="price-tag">Gratis</div>
                            
                            <a href="login.html" class="btn btn-enroll text-center text-decoration-none d-block">DAFTAR SEKARANG</a>
                            
                            <p class="text-center text-muted small mt-2 mb-4">Akses materi selamanya setelah mendaftar</p>

                            
                            
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