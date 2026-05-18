@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
<div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('guru_class_detail') }}" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                <h5 class="mb-0 fw-bold">Edit Materi</h5>
            </div>
        </div>

        <div class="content-area">
            <div class="create-form-panel mx-auto" style="max-width: 900px;">
                <div class="create-form-title">Materi Pembelajaran</div>
                <div class="create-form-subtitle">Edit materi pembelajaran untuk topik kelas Informatika.</div>

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-section-label mb-2">Judul Materi</label>
                        <input type="text" class="form-control" placeholder="Contoh: Pengenalan Sistem Komputer" value="Pengenalan Materi Semester 1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-section-label mb-2">Topik</label>
                        <select class="form-select">
                            <option selected>Topik 1 - Dasar Komputer</option>
                            <option>Topik 2 - Browser dan CMS</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-section-label mb-2">Tipe Materi</label>
                        <select class="form-select">
                            <option>Video</option>
                            <option selected>Dokumen</option>
                            <option>Teks</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-section-label mb-2">Estimasi Durasi</label>
                        <input type="text" class="form-control" placeholder="Contoh: 20 menit" value="15 menit">
                    </div>
                    <div class="col-md-4">
                        <label class="form-section-label mb-2">Status Publikasi</label>
                        <select class="form-select">
                            <option>Draft</option>
                            <option selected>Publish</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-section-label mb-2">Deskripsi Materi</label>
                        <textarea class="form-control" rows="4" placeholder="Tuliskan ringkasan materi untuk siswa">Materi pembuka untuk memahami alur belajar, aturan kelas, dan target capaian dalam semester ini.</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-section-label mb-2">Link / Lampiran</label>
                        <input type="text" class="form-control mb-2" placeholder="Tempel link video / dokumen" value="https://drive.google.com/file/d/materi-pembuka">
                        <button class="btn btn-light border"><i class="fa-solid fa-paperclip"></i> Tambah Lampiran</button>
                    </div>
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            <strong><i class="fa-solid fa-circle-info"></i> Info:</strong> Materi ini telah dipublikasikan dan dapat diakses oleh siswa. Perubahan akan langsung terlihat.
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('guru_class_detail') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
                    <button class="btn btn-danger rounded-pill px-4 me-2"><i class="fa-solid fa-trash-can"></i> Hapus Materi</button>
                    <button class="btn btn-primary rounded-pill px-4"><i class="fa-solid fa-save"></i> Simpan Perubahan</button>
                </div>
            </div>
        </div>
@endsection