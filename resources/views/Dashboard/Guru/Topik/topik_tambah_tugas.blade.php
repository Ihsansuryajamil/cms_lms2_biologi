@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
<div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('guru_class_detail') }}" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                <h5 class="mb-0 fw-bold">Edit Tugas</h5>
            </div>
        </div>

        <div class="content-area">
            <div class="create-form-panel mx-auto" style="max-width: 900px;">
                <div class="create-form-title">Tugas Siswa</div>
                <div class="create-form-subtitle">Edit tugas dengan deadline dan metode pengumpulan.</div>

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-section-label mb-2">Judul Tugas</label>
                        <input type="text" class="form-control" placeholder="Contoh: Laporan Praktikum Sistem Komputer" value="Memahami Sistem Komputer: Input, Proses, dan Output">
                    </div>
                    <div class="col-md-4">
                        <label class="form-section-label mb-2">Topik</label>
                        <select class="form-select">
                            <option selected>Topik 1 - Dasar Komputer</option>
                            <option>Topik 2 - Browser dan CMS</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-section-label mb-2">Tanggal Mulai</label>
                        <input type="date" class="form-control" value="2025-08-01">
                    </div>
                    <div class="col-md-4">
                        <label class="form-section-label mb-2">Deadline</label>
                        <input type="date" class="form-control" value="2025-08-15">
                    </div>
                    <div class="col-md-4">
                        <label class="form-section-label mb-2">Pukul</label>
                        <input type="time" class="form-control" value="17:00">
                    </div>
                    <div class="col-md-4">
                        <label class="form-section-label mb-2">Nilai Maksimal</label>
                        <input type="number" class="form-control" value="100">
                    </div>
                    <div class="col-md-4">
                        <label class="form-section-label mb-2">Mode Penilaian</label>
                        <select class="form-select">
                            <option selected>Manual</option>
                            <option>Rubrik</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-section-label mb-2">Status</label>
                        <select class="form-select">
                            <option>Draft</option>
                            <option selected>Publish</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-section-label mb-2">Instruksi Tugas</label>
                        <textarea class="form-control" rows="4" placeholder="Tuliskan detail instruksi pengerjaan tugas">Pembahasan fungsi tiap komponen komputer untuk menerima, menyimpan, memproses, dan menampilkan data. Buatlah laporan lengkap dengan penjelasan masing-masing komponen.</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-section-label mb-2">Pengumpulan</label>
                        <div class="d-flex flex-wrap gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="opsiFile" checked>
                                <label class="form-check-label" for="opsiFile">Upload File</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="opsiTeks" checked>
                                <label class="form-check-label" for="opsiTeks">Jawaban Teks</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="opsiLink">
                                <label class="form-check-label" for="opsiLink">Lampiran Link</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            <strong><i class="fa-solid fa-circle-info"></i> Info:</strong> Tugas ini telah dipublikasikan. <strong>28 siswa</strong> sudah mengumpulkan tugas, <strong>2 siswa</strong> belum mengumpulkan.
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('guru_class_detail') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
                    <button class="btn btn-danger rounded-pill px-4 me-2"><i class="fa-solid fa-trash-can"></i> Hapus Tugas</button>
                    <button class="btn btn-primary rounded-pill px-4"><i class="fa-solid fa-save"></i> Simpan Perubahan</button>
                </div>
            </div>
        </div>
@endsection