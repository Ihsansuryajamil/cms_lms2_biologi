@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
    
        <div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('teachers_dashboard') }}" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-primary small fw-bold">Informatika</span>
                <!-- <button class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-share-nodes"></i> Bagikan</button> -->
            </div>
        </div>

        <div class="content-area">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_course_detail', $course->id) }}">Topik</a></li>
                <li class="nav-item"><a class="nav-link text-muted fw-bold" href="{{ route('guru_course_edit', $course->id) }}"><i class="fa-solid fa-gear"></i> Pengaturan</a></li>
                <li class="nav-item"><a class="nav-link active" href="#"><i class="fa-solid fa-pen-to-square"></i> Update Topik</a></li>
            </ul>

            <div class="course-edit-form bg-white mx-auto mt-4">
                <form action="{{ route('guru_course_update_topik', $topic->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group-edit mb-4">
                        <label class="form-label-edit fw-bold text-dark mb-2">NAMA TOPIK</label>
                        <input type="text" name="nama_topik" class="form-control form-control-edit border rounded-3 p-3 text-dark" value="{{ old('nama_topik', $topic->nama_topic) }}" required>
                    </div>

                    <div class="form-group-edit mb-4">
                        <label class="form-label-edit fw-bold text-dark mb-2">DURASI PEMBELAJARAN (MENIT)</label>
                        <div class="input-group">
                            <input type="number" name="durasi_pembelajaran" class="form-control border p-3 text-dark" value="{{ old('durasi_pembelajaran', $topic->durasi_pembelajaran) }}" min="1" required>
                            <span class="input-group-text bg-light">menit</span>
                        </div>
                    </div>

                    <div class="form-actions-edit mt-5 pt-3 border-top text-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-2.5 fw-bold shadow-sm">
                            <i class="fa-solid fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection