@extends('Layouts.app')

@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection

@section('content')
    <div class="topbar d-flex justify-content-between align-items-center w-100">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('guru_course_detail', $subTopic->topic->course_id) }}" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
            <h5 class="mb-0 fw-bold">Update Sub-Topik</h5>
        </div>
        <div class="d-flex align-items-center gap-3">
            <button type="button" class="btn btn-danger rounded-pill px-4 py-2.5 fw-bold text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#deleteSubTopicModal">
                <i class="fa-solid fa-trash-can me-1"></i> Hapus Sub-Topik
            </button>
        </div>
    </div>

    <div class="content-area">
        <div class="create-form-panel mx-auto bg-white p-5 rounded-4 shadow-sm">
            <div class="create-form-title fs-4 fw-bold mb-1">Update Aktivitas Pembelajaran</div>
            <div class="create-form-subtitle text-muted mb-4">Materi: <strong class="text-primary">{{ $subTopic->judul }}</strong></div>

            @if ($errors->any())
                <div class="alert alert-danger mb-4 rounded-3 border-0">
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('guru_subtopik_update', $subTopic->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row g-4 border-bottom pb-4 mb-2">
                    <div class="col-md-8">
                        <label class="form-section-label fw-bold mb-2">Letak Topik / Bab</label>
                        <select name="topic_id" class="form-select border p-3" required>
                            @foreach($topics as $t)
                                <option value="{{ $t->id }}" {{ old('topic_id', $subTopic->topic_id) == $t->id ? 'selected' : '' }}>
                                    Bab {{ $t->urutan }} - {{ $t->nama_topic }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted d-block mt-1">Anda dapat memindahkan materi ini ke topik/bab lain.</small>
                    </div>

                    <div class="col-md-4">
                        <label class="form-section-label fw-bold mb-2">Urutan Tampil</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">No.</span>
                            <input type="number" name="urutan" class="form-control border-start-0 p-3" value="{{ old('urutan', $subTopic->urutan) }}" min="1" required>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-section-label fw-bold mb-2">Judul Materi / Tugas</label>
                        <input type="text" name="judul" class="form-control border p-3" value="{{ old('judul', $subTopic->judul) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-section-label fw-bold mb-2">Tipe Aktivitas</label>
                        <select name="jenis" class="form-select border p-3" required>
                            <option value="materi" {{ old('jenis', $subTopic->jenis) == 'materi' ? 'selected' : '' }}>Materi Pembelajaran (PPT, PDF, Video)</option>
                            <option value="tugas" {{ old('jenis', $subTopic->jenis) == 'tugas' ? 'selected' : '' }}>Penugasan / Upload File</option>
                            <option value="quiz" {{ old('jenis', $subTopic->jenis) == 'quiz' ? 'selected' : '' }}>Kuis / Ujian Interaktif</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-section-label fw-bold mb-2">Status Publikasi</label>
                        <select name="status" class="form-select border p-3" required>
                            <option value="publish" {{ old('status', $subTopic->status) == 'publish' ? 'selected' : '' }}>Terbitkan Langsung (Publish)</option>
                            <option value="un-publish" {{ old('status', $subTopic->status) == 'un-publish' ? 'selected' : '' }}>Simpan sebagai Draft (Un-Publish)</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-section-label fw-bold mb-2">Deskripsi / Instruksi Tambahan</label>
                        <textarea name="deskripsi" class="form-control border p-3" rows="4">{{ old('deskripsi', $subTopic->deskripsi) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-section-label fw-bold mb-2"><i class="fa-solid fa-link me-1"></i> Link Referensi</label>
                        
                        <div id="linkContainer">
                            <div class="mb-2" id="linkSlot1">
                                <input type="url" name="link_1" class="form-control border p-3" placeholder="Slot 1: https://..." value="{{ old('link_1', $subTopic->link_1) }}">
                            </div>
                            <div class="mb-2 {{ old('link_2', $subTopic->link_2) ? '' : 'd-none' }}" id="linkSlot2">
                                <input type="url" name="link_2" class="form-control border p-3" placeholder="Slot 2: https://..." value="{{ old('link_2', $subTopic->link_2) }}">
                            </div>
                            <div class="mb-2 {{ old('link_3', $subTopic->link_3) ? '' : 'd-none' }}" id="linkSlot3">
                                <input type="url" name="link_3" class="form-control border p-3" placeholder="Slot 3: https://..." value="{{ old('link_3', $subTopic->link_3) }}">
                            </div>
                        </div>

                        <button type="button" class="btn btn-light w-100 mt-2 text-primary fw-semibold" id="btnAddLink" style="border: 2px dashed #dee2e6; {{ old('link_3', $subTopic->link_3) ? 'display: none;' : '' }}">
                            <i class="fa-solid fa-plus"></i> Tambah Slot Link
                        </button>
                    </div>

                    <div class="col-md-6">
                        <label class="form-section-label fw-bold mb-2"><i class="fa-solid fa-file-arrow-up me-1"></i> Upload File Lampiran</label>
                        
                        <div id="fileContainer">
                            <div class="mb-2" id="fileSlot1">
                                @if($subTopic->file_1) 
                                    <a href="{{ asset('uploads/sub_topics/' . $subTopic->file_1) }}" target="_blank" class="badge bg-primary text-decoration-none mb-2 d-inline-block text-truncate" style="max-width: 100%; padding: 8px 12px;">
                                        <i class="fa-solid fa-up-right-from-square me-1"></i> Lihat File 1 Tersimpan
                                    </a> 
                                @endif
                                <input type="file" name="file_1" class="form-control border p-2" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip,.rar">
                            </div>
                            
                            <div class="mb-2 {{ old('file_2', $subTopic->file_2) ? '' : 'd-none' }}" id="fileSlot2">
                                @if($subTopic->file_2) 
                                    <a href="{{ asset('uploads/sub_topics/' . $subTopic->file_2) }}" target="_blank" class="badge bg-primary text-decoration-none mb-2 d-inline-block text-truncate" style="max-width: 100%; padding: 8px 12px;">
                                        <i class="fa-solid fa-up-right-from-square me-1"></i> Lihat File 2 Tersimpan
                                    </a> 
                                @endif
                                <input type="file" name="file_2" class="form-control border p-2" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip,.rar">
                            </div>
                            
                            <div class="mb-2 {{ old('file_3', $subTopic->file_3) ? '' : 'd-none' }}" id="fileSlot3">
                                @if($subTopic->file_3) 
                                    <a href="{{ asset('uploads/sub_topics/' . $subTopic->file_3) }}" target="_blank" class="badge bg-primary text-decoration-none mb-2 d-inline-block text-truncate" style="max-width: 100%; padding: 8px 12px;">
                                        <i class="fa-solid fa-up-right-from-square me-1"></i> Lihat File 3 Tersimpan
                                    </a> 
                                @endif
                                <input type="file" name="file_3" class="form-control border p-2" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip,.rar">
                            </div>
                        </div>
                        
                        <small class="text-muted mt-1 d-block mb-2">Pilih file baru jika ingin mengganti file yang sudah ada.</small>
                        
                        <button type="button" class="btn btn-light w-100 mt-1 text-primary fw-semibold" id="btnAddFile" style="border: 2px dashed #dee2e6; {{ old('file_3', $subTopic->file_3) ? 'display: none;' : '' }}">
                            <i class="fa-solid fa-plus"></i> Tambah Slot File
                        </button>
                    </div>
                </div>
                @php
                    $pgQs = $subTopic->quizQuestions->where('tipe', 'pg')->values();
                    $essayQs = $subTopic->quizQuestions->where('tipe', 'essay')->values();
                @endphp

                <div id="quizBuilderArea" class="col-12 mt-4" style="display: none;">
                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-4"><i class="fa-solid fa-layer-group text-primary me-2"></i>Builder Kuis</h5>

                    <div class="mb-4 p-3 bg-light rounded-3 border">
                        <label class="form-section-label fw-bold mb-3 d-block">Pilih Format Kuis yang Ingin Dibuat / Diedit:</label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="format_kuis" id="formatPG" value="pg" {{ $pgQs->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="formatPG">Pilihan Ganda (Otomatis Dinilai)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="format_kuis" id="formatEssay" value="essay" {{ $essayQs->count() > 0 && $pgQs->count() == 0 ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="formatEssay">Soal Essay (Penilaian Manual)</label>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" id="pgCreatedQuizCard" style="display: none;">
                        <div class="card-body p-4">
                            <h6 class="fw-bold text-dark mb-3">Tabel Soal Pilihan Ganda <span class="badge bg-success-subtle text-success ms-2 fw-normal border border-success">Nilai Dihitung Otomatis</span></h6>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 5%;" class="text-center align-middle">No</th>
                                            <th style="width: 30%;" class="align-middle">Pertanyaan</th>
                                            <th style="width: 12%;" class="text-center align-middle">Opsi A</th>
                                            <th style="width: 12%;" class="text-center align-middle">Opsi B</th>
                                            <th style="width: 12%;" class="text-center align-middle">Opsi C</th>
                                            <th style="width: 12%;" class="text-center align-middle">Opsi D</th>
                                            <th style="width: 10%;" class="text-center align-middle">Jawaban</th>
                                            <th style="width: 7%;" class="text-center align-middle"><i class="fa-solid fa-gear"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody id="pgTableBody">
                                        @foreach($pgQs as $index => $q)
                                            <tr>
                                                <td class="text-center align-middle"><span class="badge bg-light text-dark fw-bold pg-num">{{ $index + 1 }}</span></td>
                                                <td class="align-middle">
                                                    <input type="hidden" name="pg_id[]" value="{{ $q->id }}">
                                                    <textarea name="pg_pertanyaan[]" class="form-control border p-2" rows="2" required>{{ $q->pertanyaan }}</textarea>
                                                </td>
                                                <td class="text-center align-middle"><textarea name="pg_opsi_a[]" class="form-control border p-2" rows="2" required>{{ $q->opsi_a }}</textarea></td>
                                                <td class="text-center align-middle"><textarea name="pg_opsi_b[]" class="form-control border p-2" rows="2" required>{{ $q->opsi_b }}</textarea></td>
                                                <td class="text-center align-middle"><textarea name="pg_opsi_c[]" class="form-control border p-2" rows="2" required>{{ $q->opsi_c }}</textarea></td>
                                                <td class="text-center align-middle"><textarea name="pg_opsi_d[]" class="form-control border p-2" rows="2" required>{{ $q->opsi_d }}</textarea></td>
                                                <td class="text-center align-middle">
                                                    <select name="pg_kunci[]" class="form-select border p-2" required>
                                                        <option value="a" {{ $q->kunci_jawaban_pg == 'a' ? 'selected' : '' }}>A</option>
                                                        <option value="b" {{ $q->kunci_jawaban_pg == 'b' ? 'selected' : '' }}>B</option>
                                                        <option value="c" {{ $q->kunci_jawaban_pg == 'c' ? 'selected' : '' }}>C</option>
                                                        <option value="d" {{ $q->kunci_jawaban_pg == 'd' ? 'selected' : '' }}>D</option>
                                                    </select>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <button type="button" class="btn btn-outline-danger btn-sm btn-remove-row"><i class="fa-solid fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="8" class="text-center py-3">
                                                <button type="button" id="btnAddPGTable" class="btn btn-primary btn-sm rounded-pill px-4"><i class="fa-solid fa-plus me-2"></i> Tambah Pertanyaan PG</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" id="essayCreatedQuizCard" style="display: none;">
                        <div class="card-body p-4">
                            <h6 class="fw-bold text-dark mb-3">Tabel Soal Essay</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 5%;" class="text-center align-middle">No</th>
                                            <th style="width: 70%;" class="align-middle">Pertanyaan Essay</th>
                                            <th style="width: 15%;" class="text-center align-middle">Bobot Nilai</th>
                                            <th style="width: 10%;" class="text-center align-middle"><i class="fa-solid fa-gear"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody id="essayTableBody">
                                        @foreach($essayQs as $index => $q)
                                            <tr>
                                                <td class="text-center align-middle"><span class="badge bg-light text-dark fw-bold essay-num">{{ $index + 1 }}</span></td>
                                                <td class="align-middle">
                                                    <input type="hidden" name="essay_id[]" value="{{ $q->id }}">
                                                    <textarea name="essay_pertanyaan[]" class="form-control border p-2" rows="2" required>{{ $q->pertanyaan }}</textarea>
                                                </td>
                                                <td class="text-center align-middle"><input type="number" name="essay_bobot[]" class="form-control border text-center" value="{{ $q->bobot_nilai }}" min="1" required></td>
                                                <td class="text-center align-middle">
                                                    <button type="button" class="btn btn-outline-danger btn-sm btn-remove-row"><i class="fa-solid fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-center py-3">
                                                <button type="button" id="btnAddEssayTable" class="btn btn-warning text-dark fw-bold btn-sm rounded-pill px-4"><i class="fa-solid fa-plus me-2"></i> Tambah Pertanyaan Essay</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-5 pt-4 border-top">
                    <a href="{{ route('guru_course_detail', $subTopic->topic->course_id) }}" class="btn btn-light rounded-pill px-4 border py-2 fw-bold text-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm">
                        <i class="fa-solid fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="deleteSubTopicModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
                <div class="modal-body text-center p-5">
                    <div class="text-danger mb-4">
                        <i class="fa-solid fa-circle-exclamation" style="font-size: 4rem;"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-3">Konfirmasi Hapus Sub-Topik</h5>
                    <p class="text-muted px-2 mb-4" style="line-height: 1.6;">
                        Apakah kamu yakin untuk menghapus sub-topic <strong class="text-dark">"{{ $subTopic->judul }}"</strong> ini?
                    </p>
                    
                    <form action="{{ route('guru_subtopik_destroy', $subTopic->id) }}" method="POST" class="d-flex gap-3 justify-content-center">
                        @csrf
                        @method('DELETE')
                        
                        <button type="button" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-secondary flex-grow-1 border" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        
                        <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 fw-bold text-white flex-grow-1 shadow-sm">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let linkCount = {{ (old('link_3') || $subTopic->link_3) ? 3 : ((old('link_2') || $subTopic->link_2) ? 2 : 1) }};
            const btnAddLink = document.getElementById('btnAddLink');
            
            btnAddLink.addEventListener('click', function() {
                if (linkCount === 1) {
                    document.getElementById('linkSlot2').classList.remove('d-none');
                    linkCount++;
                } else if (linkCount === 2) {
                    document.getElementById('linkSlot3').classList.remove('d-none');
                    linkCount++;
                    btnAddLink.style.display = 'none'; 
                }
            });

            let fileCount = {{ (old('file_3') || $subTopic->file_3) ? 3 : ((old('file_2') || $subTopic->file_2) ? 2 : 1) }};
            const btnAddFile = document.getElementById('btnAddFile');
            
            btnAddFile.addEventListener('click', function() {
                if (fileCount === 1) {
                    document.getElementById('fileSlot2').classList.remove('d-none');
                    fileCount++;
                } else if (fileCount === 2) {
                    document.getElementById('fileSlot3').classList.remove('d-none');
                    fileCount++;
                    btnAddFile.style.display = 'none'; 
                }
            });
        });
     </script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
        // 1. Selector Elemen Utama
        const jenisSelect = document.querySelector('select[name="jenis"]');
        const quizArea = document.getElementById('quizBuilderArea');
        const regularArea = document.getElementById('regularArea');
        
        const radioPG = document.getElementById('formatPG');
        const radioEssay = document.getElementById('formatEssay');
        const pgCard = document.getElementById('pgCreatedQuizCard');
        const essayCard = document.getElementById('essayCreatedQuizCard');

        const pgTableBody = document.getElementById('pgTableBody');
        const essayTableBody = document.getElementById('essayTableBody');

        // 2. Fungsi Toggle Tipe Aktivitas (Kuis vs Materi/Tugas)
        function toggleQuizArea() {
            if (!jenisSelect || !quizArea) return;
            
            if (jenisSelect.value === 'quiz') {
                quizArea.style.display = 'block';
                if (regularArea) regularArea.style.display = 'none';
            } else {
                quizArea.style.display = 'none';
                if (regularArea) regularArea.style.display = 'flex';
            }
        }

        // 3. Fungsi Toggle Format Kuis (PG vs Essay)
        function toggleFormatKuis() {
            if (!radioPG || !radioEssay || !pgCard || !essayCard) return;

            if (radioPG.checked) {
                pgCard.style.display = 'block';
                essayCard.style.display = 'none';
            } else if (radioEssay.checked) {
                essayCard.style.display = 'block';
                pgCard.style.display = 'none';
            } else {
                // Sembunyikan kedua tabel jika guru belum memilih radio button format
                pgCard.style.display = 'none';
                essayCard.style.display = 'none';
            }
        }

        // Jalankan fungsi pemantau saat pertama kali halaman dimuat
        if (jenisSelect) {
            jenisSelect.addEventListener('change', toggleQuizArea);
            toggleQuizArea();
        }
        if (radioPG && radioEssay) {
            radioPG.addEventListener('change', toggleFormatKuis);
            radioEssay.addEventListener('change', toggleFormatKuis);
            toggleFormatKuis();
        }

        // 4. Tambah Baris PG Dinamis
        const btnAddPGTable = document.getElementById('btnAddPGTable');
        if (btnAddPGTable && pgTableBody) {
            btnAddPGTable.addEventListener('click', function() {
                const rowCount = pgTableBody.children.length + 1;
                const rowHTML = `
                    <tr>
                        <td class="text-center align-middle"><span class="badge bg-light text-dark fw-bold pg-num">${rowCount}</span></td>
                        <td class="align-middle">
                            <input type="hidden" name="pg_id[]" value="">
                            <textarea name="pg_pertanyaan[]" class="form-control border p-2" rows="2" required></textarea>
                        </td>
                        <td class="text-center align-middle"><textarea name="pg_opsi_a[]" class="form-control border p-2" rows="2" required></textarea></td>
                        <td class="text-center align-middle"><textarea name="pg_opsi_b[]" class="form-control border p-2" rows="2" required></textarea></td>
                        <td class="text-center align-middle"><textarea name="pg_opsi_c[]" class="form-control border p-2" rows="2" required></textarea></td>
                        <td class="text-center align-middle"><textarea name="pg_opsi_d[]" class="form-control border p-2" rows="2" required></textarea></td>
                        <td class="text-center align-middle">
                            <select name="pg_kunci[]" class="form-select border p-2" required>
                                <option value="a">A</option><option value="b">B</option>
                                <option value="c">C</option><option value="d">D</option>
                            </select>
                        </td>
                        <td class="text-center align-middle">
                            <button type="button" class="btn btn-outline-danger btn-sm btn-remove-row"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                `;
                pgTableBody.insertAdjacentHTML('beforeend', rowHTML);
            });
        }

        // 5. Tambah Baris Essay Dinamis
        const btnAddEssayTable = document.getElementById('btnAddEssayTable');
        if (btnAddEssayTable && essayTableBody) {
            btnAddEssayTable.addEventListener('click', function() {
                const rowCount = essayTableBody.children.length + 1;
                const rowHTML = `
                    <tr>
                        <td class="text-center align-middle"><span class="badge bg-light text-dark fw-bold essay-num">${rowCount}</span></td>
                        <td class="align-middle">
                            <input type="hidden" name="essay_id[]" value="">
                            <textarea name="essay_pertanyaan[]" class="form-control border p-2" rows="2" required></textarea>
                        </td>
                        <td class="text-center align-middle"><input type="number" name="essay_bobot[]" class="form-control border text-center" value="10" min="1" required></td>
                        <td class="text-center align-middle">
                            <button type="button" class="btn btn-outline-danger btn-sm btn-remove-row"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                `;
                essayTableBody.insertAdjacentHTML('beforeend', rowHTML);
            });
        }

        // 6. Sinkronisasi Hitung Ulang Nomor Urut Tabel jika dihapus
        function updateRowNumbers(tbody, numClass) {
            tbody.querySelectorAll('tr').forEach((row, index) => {
                const numSpan = row.querySelector('.' + numClass);
                if (numSpan) numSpan.textContent = index + 1;
            });
        }

        if (pgTableBody) {
            pgTableBody.addEventListener('click', function(e) {
                if (e.target.closest('.btn-remove-row')) {
                    e.target.closest('tr').remove();
                    updateRowNumbers(pgTableBody, 'pg-num');
                }
            });
        }

        if (essayTableBody) {
            essayTableBody.addEventListener('click', function(e) {
                if (e.target.closest('.btn-remove-row')) {
                    e.target.closest('tr').remove();
                    updateRowNumbers(essayTableBody, 'essay-num');
                }
            });
        }

        // 7. Menjaga Fungsi Slot Ekspansi Link & File Anda Tetap Berjalan Baik
        let linkCount = {{ (old('link_3') || $subTopic->link_3) ? 3 : ((old('link_2') || $subTopic->link_2) ? 2 : 1) }};
        const btnAddLink = document.getElementById('btnAddLink');
        if (btnAddLink) {
            btnAddLink.addEventListener('click', function() {
                if (linkCount === 1) {
                    const slot2 = document.getElementById('linkSlot2');
                    if (slot2) slot2.classList.remove('d-none');
                    linkCount++;
                } else if (linkCount === 2) {
                    const slot3 = document.getElementById('linkSlot3');
                    if (slot3) slot3.classList.remove('d-none');
                    linkCount++;
                    btnAddLink.style.display = 'none';
                }
            });
        }

        let fileCount = {{ (old('file_3') || $subTopic->file_3) ? 3 : ((old('file_2') || $subTopic->file_2) ? 2 : 1) }};
        const btnAddFile = document.getElementById('btnAddFile');
        if (btnAddFile) {
            btnAddFile.addEventListener('click', function() {
                if (fileCount === 1) {
                    const slot2 = document.getElementById('fileSlot2');
                    if (slot2) slot2.classList.remove('d-none');
                    fileCount++;
                } else if (fileCount === 2) {
                    const slot3 = document.getElementById('fileSlot3');
                    if (slot3) slot3.classList.remove('d-none');
                    fileCount++;
                    btnAddFile.style.display = 'none';
                }
            });
        }
    });
</script>
@endsection