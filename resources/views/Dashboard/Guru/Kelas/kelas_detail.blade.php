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

            <div class="topic-stack">
                <div class="topic-card-modern">
                    <div class="topic-main">
                        
                        <span class="create-type-icon text-primary bg-primary-subtle"><i class="fa-solid fa-book-open-reader"></i></span>
                        <div>
                            <div class="topic-meta mb-1">
                                <span class="text-primary"><i class="fa-solid fa-circle-check"></i>Materi</span>
                            </div>
                            <h6 class="fw-bold mb-1">Pengenalan Materi Semester 1</h6>
                            <p class="text-muted small mb-0">Materi pembuka untuk memahami alur belajar, aturan kelas, dan target capaian.</p>
                        </div>
                    </div>
                    <div class="topic-side">
                        <div class="topic-actions">
                            <button class="btn btn-success rounded-pill btn-sm px-3"><i class="fa-solid fa-paper-plane"></i> Publish</button>
                            <a href="{{ route('guru_topik_edit_materi') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('guru_topik_detail_materi') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-eye"></i></a>
                        </div>
                    </div>
                </div>

                <div class="topic-card-modern">
                    <div class="topic-main">
                        <span class="create-type-icon text-warning bg-warning-subtle"><i class="fa-solid fa-circle-question"></i></span>
                        <div>
                            <div class="topic-meta mb-1">
                                <span class="text-warning"><i class="fa-solid fa-circle-info"></i> Quiz</span>
                            </div>
                            <h6 class="fw-bold mb-1">Browser dan CMS untuk Digitalisasi Budaya Indonesia</h6>
                            <p class="text-muted small mb-0">Topik praktik menggunakan browser modern, mesin pencari, dan CMS untuk proyek kelas.</p>
                        </div>
                    </div>
                    <div class="topic-side">
                        <div class="topic-actions">
                            <button class="btn btn-outline-danger rounded-pill btn-sm px-3">Unpublish</button>
                            <a href="{{ route('guru_topik_edit_quiz') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('guru_topik_detail_quiz') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-eye"></i></a>
                        </div>
                    </div>
                </div>

                <div class="topic-card-modern">
                    <div class="topic-main">
                        <span class="create-type-icon text-success bg-success-subtle"><i class="fa-solid fa-clipboard-check"></i></span>
                        <div>
                            <div class="topic-meta mb-1">
                                <span class="text-success"><i class="fa-solid fa-circle-info"></i> Tugas</span>
                            </div>
                            <h6 class="fw-bold mb-1">Memahami Sistem Komputer: Input, Proses, dan Output</h6>
                            <p class="text-muted small mb-0">Pembahasan fungsi tiap komponen komputer untuk menerima, menyimpan, memproses, dan menampilkan data.</p>
                        </div>
                    </div>
                    <div class="topic-side">
                        <div class="topic-actions">
                            <button class="btn btn-success rounded-pill btn-sm px-3"><i class="fa-solid fa-paper-plane"></i> Publish</button>
                            <!-- <button class="btn btn-light border btn-sm"><i class="fa-solid fa-ellipsis"></i></button> -->
                            <a href="{{ route('guru_topik_edit_tugas') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('guru_topik_detail_tugas') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-eye"></i></a>
                        </div>
                    </div>
                </div>
                <!-- other topic cards omitted for brevity (kept same structure) -->
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
                    <a href="{{ route('guru_topik_tambah_materi') }}" class="create-type-card text-decoration-none">
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