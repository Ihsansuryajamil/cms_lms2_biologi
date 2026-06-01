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
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item"><a class="nav-link active fw-bold" href="#">Topik</a></li>
                <!-- <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_class_users') }}">Anggota <span class="badge bg-light text-dark">15</span></a></li>
                <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_class_discuss') }}"><i class="fa-regular fa-comments"></i> Diskusi</a></li> -->
                <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_course_edit', $course->id) }}"><i class="fa-solid fa-gear"></i> Pengaturan</a></li>
                <!-- <li class="nav-item ms-auto"><span class="nav-link border-0 text-muted">Informatika</span></li> -->
            </ul>  
 
            <button class="btn btn-light w-100 border border-dashed text-primary py-3 mb-4 border-2" style="border-style: dashed !important;" data-bs-toggle="modal" data-bs-target="#createTopikModal">
                <i class="fa-solid fa-plus"></i> Buat Topik Baru
            </button>
            <div id="topik-content" class="tab-content">
                <!-- Topik List (read-only untuk siswa) -->
                <div class="accordion" id="accordionTopik">
    
                @forelse($course->topics as $topic)
                    <div class="accordion-item border-0 mb-3 rounded-4 shadow-sm overflow-hidden">
                        <h2 class="accordion-header" id="headingTopik{{ $topic->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTopik{{ $topic->id }}" aria-expanded="false">
                                <div class="d-flex align-items-center gap-4 w-100 pe-3">
                                    <div class="bg-primary text-white rounded p-3" style="min-width: 50px; text-align: center;">
                                        <i class="fa-solid fa-book-open-reader"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-0">{{ $topic->nama_topic }}</h6>
                                        
                                        <span class="small text-muted fw-normal">{{ $topic->subTopics->count() }} Sub • {{ $topic->durasi_pembelajaran }}m</span>
                                    </div>
                                    
                                    <span class="small text-muted fw-normal">
                                        <a href="{{ route('guru_course_edit_topik', $topic->id) }}" class="btn btn-light border btn-sm" title="Update Topik">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseTopik{{ $topic->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionTopik">
                            <div class="accordion-body bg-white">
                                @forelse($topic->subTopics as $sub)
                                <div class="topic-detail-item">
                                    <span class="item-number">{{ $loop->iteration }}</span>
                                    @if($sub->jenis == 'materi') 
                                        <i class="fa-solid fa-file-lines text-primary"></i>
                                    @elseif($sub->jenis == 'tugas') 
                                        <i class="fa-solid fa-clipboard-list text-warning"></i>
                                    @else 
                                        <i class="fa-solid fa-clipboard-question text-danger"></i> 
                                    @endif
                                    <a href="{{ route('guru_topik_detail_materi', $sub->id) }}" class="item-title">{{ Str::limit($sub->judul, 75) }}</a>
                                    <div class="item-type">
                                        <div class="topic-actions">
                                            @if($sub->status == 'publish')
                                                
                                                <button class="btn btn-success rounded-pill btn-sm px-3"><i class="fa-solid fa-paper-plane"></i> Publish</button>
                                            @else
                                                <button class="btn btn-danger rounded-pill btn-sm px-3"><i class="fa-solid fa-paper-plane"></i> Unpublish</button>
                                            @endif
                                            <a href="{{ route('guru_subtopik_edit', $sub->id) }}" class="btn btn-light border btn-sm" title="Edit Sub-Topik">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('guru_topik_detail_materi', $sub->id) }}" class="btn btn-light border btn-sm" title="Pratinjau Tampilan Siswa">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <p class="text-muted small text-center mb-3">Belum ada materi, kuis, atau tugas di topik ini.</p>
                                @endforelse
                                <div class="topic-detail-item mt-3">
                                    
                                    <a href="{{ route('guru_subtopik_tambah', $topic->id) }}" class="btn btn-success w-100 text-white item-title">
                                                    <i class="fa-solid fa-plus"></i> Tambah Sub Topik
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                @empty
                    <div class="text-center py-4 text-muted">
                        Belum ada topik pembelajaran. Silakan buat topik baru.
                    </div>
                @endforelse
                </div>
                <!-- <div class="accordion mb-4" id="topicAccordion">
                    
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
                                    <span class="small text-muted fw-normal"><a href="#" class="btn btn-light border btn-sm" title="Update Topik"><i class="fa-solid fa-pen-to-square"></i></a></span>
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
                                            <a href="#" class="btn btn-light border btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="#" class="btn btn-light border btn-sm"><i class="fa-solid fa-eye"></i></a>
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
                                    <span class="small text-muted fw-normal"><a href="#" class="btn btn-light border btn-sm" title="Update Topik"><i class="fa-solid fa-pen-to-square"></i></a></span>
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
                                    <a href="#" class="btn btn-success w-100 text-white item-title">
                                        <i class="fa-solid fa-plus"></i> Tambah Sub Topik
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <span class="small text-muted fw-normal"><a href="#" class="btn btn-light border btn-sm" title="Update Topik"><i class="fa-solid fa-pen-to-square"></i></a></span>
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
                                    <a href="#" class="btn btn-success w-100 text-white item-title">
                                        <i class="fa-solid fa-plus"></i> Tambah Sub Topik
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div> -->
            </div>
        </div>
    </div>

    <!-- Modal: Buat Topik Baru -->
    <div class="modal fade" id="createTopikModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Buat Topik Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="{{ route('guru_course_store_topik', $course->id) }}" method="POST">
                    @csrf
                    <div class="modal-body pt-3">
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2"><i class="fa-solid fa-book"></i> Nama Topik</label>
                            <input type="text" class="form-control form-control-modal" name="nama_topik" placeholder="Contoh: Pengenalan Komputer" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2"><i class="fa-solid fa-clock"></i> Durasi Pembelajaran</label>
                            <div class="input-group">
                                <input type="number" class="form-control form-control-modal" name="durasi_pembelajaran" placeholder="45" min="1" required>
                                <span class="input-group-text bg-light border-start-0">menit</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-save"></i> Simpan Topik
                        </button>
                    </div>
                </form>
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
                    <a href="#" class="create-type-card text-decoration-none">
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