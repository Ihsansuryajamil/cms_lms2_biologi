@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
    
        <div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('guru_course_all') }}" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-primary small fw-bold">{{ $course->nama_course }}</span>
                <!-- <button class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-share-nodes"></i> Bagikan</button> -->
            </div>
        </div>

        <div class="content-area">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item"><a class="nav-link active fw-bold" href="#">Topik</a></li>
                <!-- <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_class_users') }}">Anggota <span class="badge bg-light text-dark">15</span></a></li>
                <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_class_discuss') }}"><i class="fa-regular fa-comments"></i> Diskusi</a></li> -->
                <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_course_detail_edit') }}"><i class="fa-solid fa-gear"></i> Pengaturan</a></li>
                <!-- <li class="nav-item ms-auto"><span class="nav-link border-0 text-muted">Informatika</span></li> -->
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
                                        <h6 class="fw-bold mb-0">Pengenalan Komputer dan Sistem Operasi</h6>
                                        <span class="small text-muted fw-normal">5 Sub • 45m</span>
                                    </div>
                                    <span class="small text-muted fw-normal"><a href="{{ route('guru_course_detail_update_topik') }}" class="btn btn-light border btn-sm" title="Update Topik"><i class="fa-solid fa-pen-to-square"></i></a></span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseTopik1" class="accordion-collapse collapse show" data-bs-parent="#topicAccordion">
                            <div class="accordion-body bg-white">
                                <div class="topic-detail-item">
                                    <span class="item-number">1</span>
                                    <i class="fa-solid fa-book item-icon text-success"></i>
                                    <a href="materi_detail_siswa.html" class="item-title">Pengantar Komputer</a>
                                    <div class="item-type">
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
                                    <div class="item-type">
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
                                    <div class="item-type">
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
                                    <div class="item-type">
                                        <div class="topic-actions">
                                            <button class="btn btn-outline-danger rounded-pill btn-sm px-3">Unpublish</button>
                                            <a href="{{ route('guru_topik_edit_quiz') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ route('guru_topik_detail_quiz') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="topic-detail-item">
                                    <span class="item-number">5</span>
                                    <i class="fa-solid fa-download item-icon text-primary"></i>
                                    <a href="materi_detail_siswa.html" class="item-title">Download Materi</a>
                                    <div class="item-type">
                                        <div class="topic-actions">
                                            <button class="btn btn-outline-danger rounded-pill btn-sm px-3">Unpublish</button>
                                            <a href="{{ route('guru_topik_edit_quiz') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ route('guru_topik_detail_quiz') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="topic-detail-item">
                                    <button class="btn btn-success w-100 text-white item-title" data-bs-toggle="modal" data-bs-target="#createSubTopikModal">
                                        <i class="fa-solid fa-plus"></i> Tambah Sub Topik
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Item 2: Quiz -->
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header" id="headingTopik2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTopik2">
                                <div class="d-flex align-items-center gap-4 w-100 pe-3">
                                    <div class="bg-primary text-white rounded p-3" style="min-width: 50px;">
                                        <i class="fa-solid fa-book-open-reader"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        
                                        <h6 class="fw-bold mb-0">Browser dan CMS</h6>
                                        <span class="small text-muted fw-normal">1 Quiz • 30m</span>
                                    </div>
                                    <span class="small text-muted fw-normal"><a href="{{ route('guru_course_detail_update_topik') }}" class="btn btn-light border btn-sm" title="Update Topik"><i class="fa-solid fa-pen-to-square"></i></a></span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseTopik2" class="accordion-collapse collapse" data-bs-parent="#topicAccordion">
                            <div class="accordion-body bg-white">
                                <div class="topic-detail-item">
                                    <span class="item-number">1</span>
                                    <i class="fa-solid fa-circle-question item-icon text-warning"></i>
                                    <a href="quiz_detail_siswa.html" class="item-title">Browser dan CMS</a>
                                    <div class="item-type">
                                        <div class="topic-actions">
                                            <button class="btn btn-outline-danger rounded-pill btn-sm px-3">Unpublish</button>
                                            <a href="{{ route('guru_topik_edit_quiz') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ route('guru_topik_detail_quiz') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="topic-detail-item">
                                    <button class="btn btn-success w-100 text-white item-title" data-bs-toggle="modal" data-bs-target="#createSubTopikModal">
                                        <i class="fa-solid fa-plus"></i> Tambah Sub Topik
                                    </button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Item 3: Tugas -->
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header" id="headingTopik3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTopik3">
                                <div class="d-flex align-items-center gap-4 w-100 pe-3">
                                    <div class="bg-primary text-white rounded p-3" style="min-width: 50px;">
                                        <i class="fa-solid fa-book-open-reader"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-0">Algoritma dan Pemrograman Dasar</h6>
                                    <span class="small text-muted fw-normal">1 Quiz • 30m</span>
                                    </div>
                                    <span class="small text-muted fw-normal"><a href="{{ route('guru_course_detail_update_topik') }}" class="btn btn-light border btn-sm" title="Update Topik"><i class="fa-solid fa-pen-to-square"></i></a></span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseTopik3" class="accordion-collapse collapse" data-bs-parent="#topicAccordion">
                            <div class="accordion-body bg-white">
                                <div class="topic-detail-item">
                                    <span class="item-number">1</span>
                                    <i class="fa-solid fa-clipboard-check item-icon text-secondary"></i>
                                    <a href="tugas_detail_siswa.html" class="item-title">Tugas 1: Buat Flowchart</a>
                                    <div class="item-type">
                                        <div class="topic-actions">
                                            <button class="btn btn-outline-danger rounded-pill btn-sm px-3">Unpublish</button>
                                            <a href="{{ route('guru_topik_edit_quiz') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ route('guru_topik_detail_quiz') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="topic-detail-item">
                                    <span class="item-number">2</span>
                                    <i class="fa-solid fa-clipboard-check item-icon text-secondary"></i>
                                    <a href="tugas_detail_siswa.html" class="item-title">Tugas 2: Program Sederhana</a>
                                    <div class="item-type">
                                        <div class="topic-actions">
                                            <button class="btn btn-outline-danger rounded-pill btn-sm px-3">Unpublish</button>
                                            <a href="{{ route('guru_topik_edit_quiz') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ route('guru_topik_detail_quiz') }}" class="btn btn-light border btn-sm"><i class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="topic-detail-item">
                                    <button class="btn btn-success w-100 text-white item-title" data-bs-toggle="modal" data-bs-target="#createSubTopikModal">
                                        <i class="fa-solid fa-plus"></i> Tambah Sub Topik
                                    </button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Buat Topik Baru -->
    <div class="modal fade" id="createTopikModal" tabindex="-1" aria-labelledby="createTopikModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="createTopikModalLabel">Buat Topik Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3">
                    <form id="formCreateTopik">
                        <!-- Nama Topik -->
                        <div class="mb-4">
                            <label for="namaTopik" class="form-label fw-semibold mb-2">
                                <i class="fa-solid fa-book"></i> Nama Topik
                            </label>
                            <input 
                                type="text" 
                                class="form-control form-control-modal" 
                                id="namaTopik" 
                                name="nama_topik" 
                                placeholder="Contoh: Pengenalan Komputer dan Sistem Operasi"
                                required
                            >
                            <small class="text-muted d-block mt-1">Masukkan nama topik atau judul pembelajaran</small>
                        </div>

                        <!-- Durasi Pembelajaran -->
                        <div class="mb-4">
                            <label for="durasiPembelajaran" class="form-label fw-semibold mb-2">
                                <i class="fa-solid fa-clock"></i> Durasi Pembelajaran
                            </label>
                            <div class="input-group">
                                <input 
                                    type="number" 
                                    class="form-control form-control-modal" 
                                    id="durasiPembelajaran" 
                                    name="durasi_pembelajaran" 
                                    placeholder="45"
                                    min="1"
                                    max="999"
                                    required
                                >
                                <span class="input-group-text bg-light border-start-0">menit</span>
                            </div>
                            <small class="text-muted d-block mt-1">Estimasi waktu pembelajaran topik ini</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary rounded-pill px-4" id="btnSimpanTopik">
                        <i class="fa-solid fa-save"></i> Simpan Topik
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal copied from original -->
    <div class="modal fade" id="createSubTopikModal" tabindex="-1" aria-labelledby="createTopikModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="createTopikModalLabel">Buat Sub-Topik Baru</h5>
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

@section('scripts')
<script>
    // Handle Create Topik Modal Submit
    document.addEventListener('DOMContentLoaded', function() {
        const btnSimpanTopik = document.getElementById('btnSimpanTopik');
        const formCreateTopik = document.getElementById('formCreateTopik');
        const namaTopikInput = document.getElementById('namaTopik');
        const durasiPembelajaranInput = document.getElementById('durasiPembelajaran');

        if (btnSimpanTopik) {
            btnSimpanTopik.addEventListener('click', function() {
                // Validasi form
                if (!formCreateTopik.checkValidity()) {
                    formCreateTopik.reportValidity();
                    return;
                }

                // Ambil nilai input
                const namaTopik = namaTopikInput.value.trim();
                const durasiPembelajaran = durasiPembelajaranInput.value.trim();

                // Validasi tidak boleh kosong
                if (!namaTopik || !durasiPembelajaran) {
                    alert('Semua field harus diisi!');
                    return;
                }

                // Validasi durasi harus berupa angka positif
                if (isNaN(durasiPembelajaran) || parseInt(durasiPembelajaran) <= 0) {
                    alert('Durasi pembelajaran harus berupa angka positif!');
                    return;
                }

                // TODO: Kirim data ke backend
                // Untuk sekarang, tampilkan sukses dan reset form
                console.log({
                    nama_topik: namaTopik,
                    durasi_pembelajaran: durasiPembelajaran + ' menit'
                });

                // Tampilkan notifikasi sukses
                alert(`Topik "${namaTopik}" berhasil dibuat dengan durasi ${durasiPembelajaran} menit!`);

                // Reset form
                formCreateTopik.reset();

                // Tutup modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('createTopikModal'));
                if (modal) {
                    modal.hide();
                }
            });
        }

        // Reset form saat modal dibuka
        const createTopikModalEl = document.getElementById('createTopikModal');
        if (createTopikModalEl) {
            createTopikModalEl.addEventListener('show.bs.modal', function() {
                formCreateTopik.reset();
                namaTopikInput.focus();
            });
        }
    });
</script>
@endsection