@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
    <div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('guru_class_detail') }}" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                <h5 class="mb-0 fw-bold">Tambah Quiz Baru</h5>
            </div>
        </div>

        <div class="content-area">
            <div class="create-form-panel mx-auto" style="max-width: 900px;">
                <div class="create-form-title">Quiz Evaluasi</div>
                <div class="create-form-subtitle">Buat quiz untuk menguji pemahaman siswa pada materi tertentu.</div>

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-section-label mb-2">Judul Quiz</label>
                        <input type="text" class="form-control" placeholder="Contoh: Quiz Bab 1 Sistem Komputer">
                    </div>
                    <div class="col-md-4">
                        <label class="form-section-label mb-2">Topik</label>
                        <select class="form-select">
                            <option>Topik 1 - Dasar Komputer</option>
                            <option>Topik 2 - Browser dan CMS</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-section-label mb-2">Jumlah Soal</label>
                        <input type="number" class="form-control" value="10">
                    </div>
                    <div class="col-md-3">
                        <label class="form-section-label mb-2">Durasi</label>
                        <input type="text" class="form-control" placeholder="30 menit">
                    </div>
                    <div class="col-md-3">
                        <label class="form-section-label mb-2">Skor Minimum</label>
                        <input type="number" class="form-control" value="70">
                    </div>
                    <div class="col-md-3">
                        <label class="form-section-label mb-2">Status</label>
                        <select class="form-select">
                            <option>Draft</option>
                            <option>Publish</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-section-label mb-2">Instruksi Quiz</label>
                        <textarea class="form-control" rows="3" placeholder="Tuliskan instruksi sebelum siswa mulai quiz"></textarea>
                    </div>
                    <div class="col-12">
                        <div class="border rounded-3 p-3 bg-light">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong>Soal 1 (Pilihan Ganda)</strong>
                                <button class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div>
                            <p class="mb-0 text-muted small">Contoh soal akan muncul di sini. Klik tombol tambah soal untuk melanjutkan.</p>
                        </div>
                        <button class="btn btn-light border mt-2"><i class="fa-solid fa-plus"></i> Tambah Soal</button>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('guru_class_detail') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
                    <button class="btn btn-primary rounded-pill px-4"><i class="fa-solid fa-save"></i> Simpan Quiz</button>
                </div>
            </div>
        </div>
@endsection