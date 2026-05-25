@extends('Layouts.app')

@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection

@section('content')
    <div class="topbar d-flex justify-content-between align-items-center w-100">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('guru_course_all') }}" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
            <h5 class="mb-0 fw-bold">Buat Materi Pembelajaran Baru</h5>
        </div>
    </div>

    <div class="content-area">
        <div class="course-edit-form bg-white mx-auto mt-4 p-4 p-md-5 rounded-4 shadow-sm" style="max-width: 800px;">
            
            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-3 mb-4">
                    <ul class="mb-0 py-1 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('guru_course_store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group-edit mb-4">
                    <label class="form-label-edit fw-bold text-dark mb-2">NAMA MATERI / KELAS</label>
                    <input type="text" name="nama_course" class="form-control form-control-edit border rounded-3 p-3 text-dark" placeholder="Contoh: BIOLOGI - STRUKTUR SEL (KELAS IX-B)" value="{{ old('nama_course') }}" required>
                </div>

                <div class="form-group-edit mb-4">
                    <label class="form-label-edit fw-bold text-dark mb-2">LINK VIDEO MATERI (YOUTUBE / DRIVE)</label>
                    <input type="url" name="link_video" class="form-control form-control-edit border rounded-3 p-3 text-dark" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('link_video') }}">
                </div>

                <div class="form-group-edit mb-4">
                    <label class="form-label-edit fw-bold text-dark mb-2">DESKRIPSI MATERI</label>
                    <textarea name="deskripsi" class="form-control border rounded-3 p-3 text-dark" rows="5" placeholder="Jelaskan secara singkat mengenai materi pembelajaran ini..." required style="resize: vertical; line-height: 1.6;">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="form-group-edit mb-4">
                    <label class="form-label-edit fw-bold text-dark mb-2">PERSYARATAN BELAJAR (PREREQUISITES)</label>
                    <textarea name="persyaratan" class="form-control border rounded-3 p-3 text-dark" rows="4" placeholder="Contoh: Siswa wajib memahami konsep dasar pembelahan sel sebelum mempelajari materi ini..." style="resize: vertical; line-height: 1.6;">{{ old('persyaratan') }}</textarea>
                </div>
                <div class="form-group-edit mb-4">
                    <label class="form-label-edit fw-bold text-dark mb-2">BACKGROUND MATERI (SAMPUL)</label>
                    <input type="file" name="avatar" class="form-control border rounded-3 p-2 text-dark" accept="image/png, image/jpeg, image/webp, image/jpg">
                    <small class="text-muted mt-1 d-block">Format: JPG, PNG, WEBP. Gambar akan otomatis di-compress (Max 5MB).</small>
                </div>

                <div class="form-actions-edit mt-5 pt-4 border-top text-end">
                    <button type="submit" class="btn btn-primary rounded-pill px-5 py-2.5 fw-bold shadow-sm" style="background-color: #0d6efd; border: none;">
                        <i class="fa-solid fa-save me-1"></i> Simpan Kelas & Materi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection