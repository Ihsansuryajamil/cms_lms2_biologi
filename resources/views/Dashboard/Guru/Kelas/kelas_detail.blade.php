@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
    
        <div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('teachers_dashboard') }}" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                <h5 class="mb-0 fw-bold">IX B-INFORMATIKA (KOMP)</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-success small fw-bold"><i class="fa-solid fa-check-circle"></i> Kelas Disetujui</span>
                <button class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-share-nodes"></i> Bagikan</button>
            </div>
        </div>

        <div class="content-area">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item"><a class="nav-link active fw-bold" href="#">Topik <span class="badge bg-light text-dark">9</span></a></li>
                <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_class_users') }}">Anggota <span class="badge bg-light text-dark">15</span></a></li>
                <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_class_discuss') }}"><i class="fa-regular fa-comments"></i> Diskusi</a></li>
                <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_class_edit') }}"><i class="fa-solid fa-gear"></i> Pengaturan</a></li>
                <li class="nav-item ms-auto"><span class="nav-link border-0 text-muted">Informatika</span></li>
            </ul> 

            <button class="btn btn-light w-100 border border-dashed text-primary py-3 mb-4 border-2" style="border-style: dashed !important;" data-bs-toggle="modal" data-bs-target="#createTopikModal">
                <i class="fa-solid fa-plus"></i> Buat Topik Baru
            </button>
            <div id="topik-content" class="tab-content">
                <!-- Topik List (read-only untuk siswa) -->
                <div class="accordion mb-4" id="topicAccordion">
                    
                    <!-- Accordion Item 1: Materi -->
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header" id="headingTopik1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTopik1" aria-expanded="true">
                                <div class="d-flex align-items-center gap-4 w-100 pe-3">
                                    <div class="bg-primary text-white rounded p-3" style="min-width: 50px;">
                                        <i class="fa-solid fa-book-open-reader"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="mb-1">
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill"><i class="fa-solid fa-circle-check"></i> Materi</span>
                                        </div>
                                        <h6 class="fw-bold mb-0">Pengenalan Komputer dan Sistem Operasi</h6>
                                    </div>
                                    <span class="small text-muted fw-normal">5 Sub • 45m</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseTopik1" class="accordion-collapse collapse show" data-bs-parent="#topicAccordion">
                            <div class="accordion-body bg-white">
                                <div class="topic-detail-item">
                                    <span class="item-number">1</span>
                                    <i class="fa-solid fa-book item-icon text-success"></i>
                                    <a href="materi_detail_siswa.html" class="item-title">Pengantar Komputer</a>
                                    <div class="topic-side">
                                        <div class="topic-actions">
                                            <button class="btn btn-success rounded-pill btn-sm px-3"><i class="fa-solid fa-paper-plane"></i> Publish</button>
                                            <a href="{{ route('guru_topik_edit_materi') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ route('guru_topik_detail_materi') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="topic-detail-item">
                                    <span class="item-number">2</span>
                                    <i class="fa-solid fa-book item-icon text-success"></i>
                                    <a href="materi_detail_siswa.html" class="item-title">Tugas Materi</a>
                                    <div class="topic-side">
                                        <div class="topic-actions">
                                            <button class="btn btn-success rounded-pill btn-sm px-3"><i class="fa-solid fa-paper-plane"></i> Publish</button>
                                            <!-- <button class="btn btn-light border btn-sm"><i class="fa-solid fa-ellipsis"></i></button> -->
                                            <a href="{{ route('guru_topik_edit_tugas') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ route('guru_topik_detail_tugas') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="topic-detail-item">
                                    <span class="item-number">3</span>
                                    <i class="fa-solid fa-circle-question item-icon text-warning"></i>
                                    <a href="materi_detail_siswa.html" class="item-title">Kuis Pra-Syarat</a>
                                     <div class="topic-side">
                                        <div class="topic-actions">
                                            <button class="btn btn-outline-danger rounded-pill btn-sm px-3">Unpublish</button>
                                            <a href="{{ route('guru_topik_edit_quiz') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ route('guru_topik_detail_quiz') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="topic-detail-item">
                                    <span class="item-number">4</span>
                                    <i class="fa-solid fa-book item-icon text-success"></i>
                                    <a href="materi_detail_siswa.html" class="item-title">Latihan Interaktif</a>
                                    <span class="item-type">Text lesson</span>
                                </div>
                                <div class="topic-detail-item">
                                    <span class="item-number">5</span>
                                    <i class="fa-solid fa-download item-icon text-primary"></i>
                                    <a href="materi_detail_siswa.html" class="item-title">Download Materi</a>
                                    <span class="item-type">Text lesson</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Item 2: Quiz -->
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header" id="headingTopik2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTopik2">
                                <div class="d-flex align-items-center gap-4 w-100 pe-3">
                                    <div class="bg-warning text-white rounded p-3" style="min-width: 50px;">
                                        <i class="fa-solid fa-circle-question"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="mb-1">
                                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill"><i class="fa-solid fa-spinner"></i> Quiz</span>
                                        </div>
                                        <h6 class="fw-bold mb-0">Browser dan CMS</h6>
                                    </div>
                                    <span class="small text-muted fw-normal">1 Quiz • 30m</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseTopik2" class="accordion-collapse collapse" data-bs-parent="#topicAccordion">
                            <div class="accordion-body bg-white">
                                <div class="topic-detail-item">
                                    <span class="item-number">1</span>
                                    <i class="fa-solid fa-circle-question item-icon text-warning"></i>
                                    <a href="quiz_detail_siswa.html" class="item-title">Browser dan CMS</a>
                                    <span class="item-type">15 questions</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Item 3: Tugas -->
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header" id="headingTopik3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTopik3">
                                <div class="d-flex align-items-center gap-4 w-100 pe-3">
                                    <div class="bg-secondary text-white rounded p-3" style="min-width: 50px;">
                                        <i class="fa-solid fa-clipboard-check"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="mb-1">
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill"><i class="fa-solid fa-lock"></i> Tugas</span>
                                        </div>
                                        <h6 class="fw-bold mb-0 text-muted">Algoritma dan Pemrograman Dasar</h6>
                                    </div>
                                    <span class="small text-muted fw-normal">2 Tugas</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseTopik3" class="accordion-collapse collapse" data-bs-parent="#topicAccordion">
                            <div class="accordion-body bg-white">
                                <div class="topic-detail-item">
                                    <span class="item-number">1</span>
                                    <i class="fa-solid fa-clipboard-check item-icon text-secondary"></i>
                                    <a href="tugas_detail_siswa.html" class="item-title">Tugas 1: Buat Flowchart</a>
                                    <span class="item-type">Text lesson</span>
                                </div>
                                <div class="topic-detail-item">
                                    <span class="item-number">2</span>
                                    <i class="fa-solid fa-clipboard-check item-icon text-secondary"></i>
                                    <a href="tugas_detail_siswa.html" class="item-title">Tugas 2: Program Sederhana</a>
                                    <span class="item-type">Text lesson</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Item 4: Materi Terkunci -->
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header" id="headingTopik4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTopik4" disabled>
                                <div class="d-flex align-items-center gap-4 w-100 pe-3">
                                    <div class="bg-secondary text-white rounded p-3" style="min-width: 50px; opacity: 0.6;">
                                        <i class="fa-solid fa-book-open-reader"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="mb-1">
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill"><i class="fa-solid fa-lock"></i> Materi</span>
                                        </div>
                                        <h6 class="fw-bold mb-0 text-muted">Jaringan Komputer</h6>
                                    </div>
                                    <span class="small text-muted fw-normal"><i class="fa-solid fa-lock"></i> Terkunci</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseTopik4" class="accordion-collapse collapse" data-bs-parent="#topicAccordion">
                            <div class="accordion-body bg-white pt-2 pb-2">
                                <p class="text-muted">Materi ini akan dibuka setelah Anda menyelesaikan modul sebelumnya.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal copied from original -->
    <div class="modal fade" id="createTopikModal" tabindex="-1" aria-labelledby="createTopikModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="createTopikModalLabel">Buat Topik Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3">
                    <p class="text-muted small mb-3">Pilih jenis konten yang ingin ditambahkan ke topik kelas:</p>
                    <a href="{{ route('guru_subtopik_tambah') }}" class="create-type-card text-decoration-none">
                        <span class="create-type-icon text-primary bg-primary-subtle"><i class="fa-solid fa-book-open-reader"></i></span>
                        <span>
                            <strong class="d-block text-dark">Materi Baru</strong>
                            <small class="text-muted">Unggah konten pembelajaran, video, dokumen, atau ringkasan materi.</small>
                        </span>
                        <i class="fa-solid fa-chevron-right text-muted"></i>
                    </a>
                    <a href="{{ route('guru_topik_tambah_quiz') }}" class="create-type-card text-decoration-none">
                        <span class="create-type-icon text-warning bg-warning-subtle"><i class="fa-solid fa-circle-question"></i></span>
                        <span>
                            <strong class="d-block text-dark">Quiz Baru</strong>
                            <small class="text-muted">Buat pertanyaan pilihan ganda atau isian dengan skor otomatis.</small>
                        </span>
                        <i class="fa-solid fa-chevron-right text-muted"></i>
                    </a>
                    <a href="{{ route('guru_topik_tambah_tugas') }}" class="create-type-card text-decoration-none mb-0">
                        <span class="create-type-icon text-success bg-success-subtle"><i class="fa-solid fa-clipboard-check"></i></span>
                        <span>
                            <strong class="d-block text-dark">Tugas Baru</strong>
                            <small class="text-muted">Tetapkan deadline, instruksi, dan ketentuan pengumpulan tugas.</small>
                        </span>
                        <i class="fa-solid fa-chevron-right text-muted"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection