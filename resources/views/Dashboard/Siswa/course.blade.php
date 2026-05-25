
@extends('Layouts.appSiswa')
@section('content')
    <!-- <header class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="hero-title mb-3">Portal Pendidikan<br>LMS Pembelajaran</h1>
                    <p class="hero-subtitle mb-0">Jelajahi materi dan ruang kelas interaktif untuk mendukung kegiatan belajar mengajar yang efektif baik di sekolah maupun di rumah.</p>
                </div>
            </div>
        </div>
    </header> -->

    <section id="courses-container" class="toolbar-section" style="height: auto; padding-top: 6rem;">
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
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                
                <div class="col course-item-wrapper">
                    <div class="course-card" onclick="window.location.href='{{ route('students_detail_course') }}';" style="cursor: pointer;">
                        <div class="course-img-container">
                            <img src="https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?auto=format&fit=crop&w=600&q=80" alt="Sintesis Protein"> 
                            <span class="badge-status badge-new">BARU</span>
                        </div>
                        <div class="card-body-custom">
                            <span class="course-category">Biologi Sel</span>
                            <h6 class="course-title">Sintesis Protein Lanjutan</h6>
                        </div>
                        <div class="card-footer-custom">
                            <div class="text-warning small">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                <span class="text-dark fw-bold ms-1">5.0</span>
                            </div>
                            <div class="fw-bold text-success">Gratis</div>
                        </div>
                    </div>

                    <div class="course-popover">
                        <div class="popover-header d-flex align-items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=Cita+Tresnawati&background=0D8ABC&color=fff" alt="Instruktur">
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">Sintesis Protein Lanjutan</h6>
                                <small class="text-muted">Oleh: Cita Tresnawati</small>
                            </div>
                        </div>
                        
                        <p class="small text-muted mt-3 mb-0" style="line-height: 1.5;">
                            Tujuan Pembelajaran: Setelah menyelesaikan modul metabolisme, siswa dapat menjabarkan proses transkripsi dan translasi RNA secara komprehensif.
                        </p>
                        
                        <div class="popover-specifications">
                            <div class="spec-item">
                                <i class="fa-solid fa-layer-group"></i>
                                Menengah
                            </div>
                            <div class="spec-item">
                                <i class="fa-solid fa-book-open"></i>
                                26 Materi
                            </div>
                            <div class="spec-item">
                                <i class="fa-regular fa-clock"></i>
                                4 Jam
                            </div>
                        </div>

                        <a href="{{ route('students_detail_course') }}" class="btn btn-preview-course text-center text-decoration-none d-block">LIHAT PREVIEW MATERI</a>
                        
                        
                    </div>
                </div>

                <div class="col course-item-wrapper">
                    <div class="course-card" onclick="window.location.href='{{ route('students_detail_course') }}';" style="cursor: pointer;">
                        <div class="course-img-container">
                            <img src="https://images.unsplash.com/photo-1530026405186-ed1f139313f8?auto=format&fit=crop&w=600&q=80" alt="Metabolisme Sel">
                            <span class="badge-status badge-new">POPULER</span>
                        </div>
                        <div class="card-body-custom">
                            <span class="course-category">Biokimia</span>
                            <h6 class="course-title">Metabolisme Sel & Peran Enzim</h6>
                        </div>
                        <div class="card-footer-custom">
                            <div class="text-warning small">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                                <span class="text-dark fw-bold ms-1">4.7</span>
                            </div>
                            <div class="fw-bold text-success">Gratis</div>
                        </div>
                    </div>

                    <div class="course-popover">
                        <div class="popover-header d-flex align-items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=16a34a&color=fff" alt="Instruktur">
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">Metabolisme Sel & Enzim</h6>
                                <small class="text-muted">Oleh: Budi Santoso</small>
                            </div>
                        </div>
                        
                        <p class="small text-muted mt-3 mb-0" style="line-height: 1.5;">
                            Membahas reaksi anabolisme dan katabolisme di dalam sel, serta bagaimana struktur enzim mempengaruhi laju reaksi metabolisme makhluk hidup.
                        </p>
                        
                        <div class="popover-specifications">
                            <div class="spec-item">
                                <i class="fa-solid fa-layer-group"></i>
                                Mahir
                            </div>
                            <div class="spec-item">
                                <i class="fa-solid fa-book-open"></i>
                                18 Materi
                            </div>
                            <div class="spec-item">
                                <i class="fa-regular fa-clock"></i>
                                5 Jam
                            </div>
                        </div>

                        <a href="{{ route('students_detail_course') }}" class="btn btn-preview-course text-center text-decoration-none d-block">LIHAT PREVIEW MATERI</a>
                        
                        
                    </div>
                </div>

                <div class="col course-item-wrapper">
                    <div class="course-card" onclick="window.location.href='{{ route('students_detail_course') }}';" style="cursor: pointer;">
                        <div class="course-img-container">
                            <img src="https://images.unsplash.com/photo-1576086213369-97a306d36557?auto=format&fit=crop&w=600&q=80" alt="Pembelahan Sel">
                            <span class="badge-status badge-hot">HOT</span>
                        </div>
                        <div class="card-body-custom">
                            <span class="course-category">Genetika</span>
                            <h6 class="course-title">Pembelahan Sel: Mitosis & Meiosis</h6>
                        </div>
                        <div class="card-footer-custom">
                            <div class="text-warning small">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                <span class="text-dark fw-bold ms-1">4.9</span>
                            </div>
                            <div class="fw-bold text-success">Gratis</div>
                        </div>
                    </div>

                    <div class="course-popover">
                        <div class="popover-header d-flex align-items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=Dewi+Sartika&background=e11d48&color=fff" alt="Instruktur">
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">Mitosis & Meiosis</h6>
                                <small class="text-muted">Oleh: Dewi Sartika</small>
                            </div>
                        </div>
                        
                        <p class="small text-muted mt-3 mb-0" style="line-height: 1.5;">
                            Pelajari siklus hidup sel secara detail melalui materi visual interaktif mengenai tahapan pembelahan mitosis dan meiosis.
                        </p>
                        
                        <div class="popover-specifications">
                            <div class="spec-item">
                                <i class="fa-solid fa-layer-group"></i>
                                Dasar
                            </div>
                            <div class="spec-item">
                                <i class="fa-solid fa-book-open"></i>
                                12 Materi
                            </div>
                            <div class="spec-item">
                                <i class="fa-regular fa-clock"></i>
                                3 Jam
                            </div>
                        </div>

                        <a href="{{ route('students_detail_course') }}" class="btn btn-preview-course text-center text-decoration-none d-block">LIHAT PREVIEW MATERI</a>
                        
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection