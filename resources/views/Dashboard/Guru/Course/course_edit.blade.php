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
                <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_course_detail', $course->id) }}">Topik</a></li>
                <li class="nav-item"><a class="nav-link active fw-bold" href="#"><i class="fa-solid fa-gear"></i> Pengaturan</a></li>
            </ul>

            <div class="course-edit-form bg-white mx-auto mt-4">
                @if ($errors->any())
                    <div class="alert alert-danger border-0 rounded-3 mb-4">
                        <ul class="mb-0 py-1 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('guru_course_update', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group-edit mb-4">
                        <label class="form-label-edit fw-bold text-dark mb-2">NAMA MATERI / KELAS</label>
                        <input type="text" name="nama_course" class="form-control form-control-edit border rounded-3 p-3 text-dark" value="{{ old('nama_course', $course->nama_course) }}" required>
                    </div>

                    <div class="form-group-edit mb-4">
                        <label class="form-label-edit fw-bold text-dark mb-2">LINK VIDEO MATERI (YOUTUBE / DRIVE)</label>
                        <input type="url" name="link_video" class="form-control form-control-edit border rounded-3 p-3 text-dark" value="{{ old('link_video', $course->link_video) }}">
                    </div>

                    <div class="form-group-edit mb-4">
                        <label class="form-label-edit fw-bold text-dark mb-2">DESKRIPSI MATERI</label>
                        <textarea name="deskripsi" class="form-control border rounded-3 p-3 text-dark" rows="5" required style="resize: vertical; line-height: 1.6;">{{ old('deskripsi', $course->deskripsi) }}</textarea>
                    </div>

                    <div class="form-group-edit mb-4">
                        <label class="form-label-edit fw-bold text-dark mb-2">PERSYARATAN BELAJAR</label>
                        <textarea name="persyaratan" class="form-control border rounded-3 p-3 text-dark" rows="4" style="resize: vertical; line-height: 1.6;">{{ old('persyaratan', $course->persyaratan) }}</textarea>
                    </div>

                    <div class="form-group-edit mb-4">
                        <label class="form-label-edit fw-bold text-dark mb-2">BACKGROUND MATERI (SAMPUL)</label>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            @if($course->avatar)
                                <div class="rounded overflow-hidden shadow-sm" style="width: 120px; height: 70px;">
                                    <img src="{{ asset('image/course/avatar/' . $course->avatar) }}" class="w-100 h-100 object-fit-cover" alt="Current Sampul">
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <input type="file" name="avatar" class="form-control border rounded-3 p-2 text-dark" accept="image/png, image/jpeg, image/webp, image/jpg">
                                <small class="text-muted d-block mt-1">Pilih file baru jika ingin mengubah gambar sampul (Format: JPG, PNG, WEBP).</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions-edit mt-5 pt-3 border-top text-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-2.5 fw-bold shadow-sm" style="background-color: #0d6efd; border: none;">
                            <i class="fa-solid fa-cloud-arrow-up me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
                <div class="bg-white mx-auto mt-5 p-4 p-md-5 rounded-4 shadow-sm border border-danger border-opacity-25" style="max-width: 800px;">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div>
                            <h5 class="fw-bold text-danger mb-1"><i class="fa-solid fa-triangle-exclamation me-1"></i> Hapus Course</h5>
                            <p class="text-muted small mb-0">Setelah Anda menghapus course ini, seluruh data topik,<br> sub-topik, materi, dan konten di dalamnya akan terhapus secara permanen.</p>
                        </div>
                        <div>
                            <button type="button" class="btn btn-danger rounded-pill px-4 py-2.5 fw-bold text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#deleteCourseModal">
                                <i class="fa-solid fa-trash-can me-1"></i> Hapus Permanen
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>
    </div>
    <div class="modal fade" id="deleteCourseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
                <div class="modal-body text-center p-5">
                    <div class="text-danger mb-4">
                        <i class="fa-solid fa-circle-exclamation" style="font-size: 4rem;"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-3">Konfirmasi Hapus Course</h5>
                    <p class="text-muted px-2 mb-4" style="line-height: 1.6;">
                        Apakah kamu yakin untuk menghapus course <strong class="text-dark">"{{ $course->nama_course }}"</strong> ini?
                    </p>
                    
                    <form action="{{ route('guru_course_destroy', $course->id) }}" method="POST" class="d-flex gap-3 justify-content-center">
                        @csrf
                        @method('DELETE')
                        
                        <button type="button" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-secondary flex-grow-1 border" data-bs-dismiss="modal">
                            Tidak
                        </button>
                        
                        <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 fw-bold text-white flex-grow-1 shadow-sm">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection