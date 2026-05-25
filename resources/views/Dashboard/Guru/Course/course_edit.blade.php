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
                <span class="text-primary small fw-bold">Informatika</span>
                <!-- <button class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-share-nodes"></i> Bagikan</button> -->
            </div>
        </div>

        <div class="content-area">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_course_detail') }}">Topik</a></li>
                <!-- <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_class_users') }}">Anggota <span class="badge bg-light text-dark">15</span></a></li>
                <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_class_discuss') }}"><i class="fa-regular fa-comments"></i> Diskusi</a></li> -->
                <li class="nav-item"><a class="nav-link active fw-bold" href="#"><i class="fa-solid fa-gear"></i> Pengaturan</a></li>
                <!-- <li class="nav-item ms-auto"><span class="nav-link border-0 text-muted">Informatika</span></li> -->
            </ul>

            <div class="course-edit-form bg-white mx-auto mt-4">
                <form>
                    <!-- Form Group: Nama Materi -->
                    <div class="form-group-edit mb-4">
                        <label class="form-label-edit">NAMA MATERI</label>
                        <input type="text" class="form-control form-control-edit" value="IX B-INFORMATIKA (KOMP)" readonly>
                    </div>

                    <!-- Form Group: Link Materi -->
                    <div class="form-group-edit mb-4">
                        <label class="form-label-edit">LINK MATERI</label>
                        <input type="text" class="form-control form-control-edit" value="https://youtu.be/VFwUjio4NW4?si=lTuhY1Pwoy2vrTJ1" readonly>
                    </div>
                    <div class="form-group-edit mb-4">
                        <label class="form-label-edit">DURASI PEMBELAJARAN</label>
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
                                <span class="input-group-text bg-light border-start-0">Jam</span>
                            </div>
                    </div>


                    <!-- Form Group: Deskripsi Materi -->
                    <div class="form-group-edit mb-4">
                        <label class="form-label-edit">DESKRIPSI MATERI</label>
                        <div class="editor-toolbar d-flex flex-wrap gap-2 align-items-center mb-2">
                            <select class="form-select form-select-sm w-auto border-0 bg-light"><option>Font</option></select>
                            <select class="form-select form-select-sm w-auto border-0 bg-light"><option>Size</option></select>
                            <div class="text-muted">|</div>
                            <button type="button" class="btn btn-sm btn-light" title="Bold"><i class="fa-solid fa-bold"></i></button>
                            <button type="button" class="btn btn-sm btn-light" title="Italic"><i class="fa-solid fa-italic"></i></button>
                            <button type="button" class="btn btn-sm btn-light" title="Strikethrough"><i class="fa-solid fa-strikethrough"></i></button>
                            <div class="text-muted">|</div>
                            <button type="button" class="btn btn-sm btn-light" title="Numbered List"><i class="fa-solid fa-list-ol"></i></button>
                            <button type="button" class="btn btn-sm btn-light" title="Bullet List"><i class="fa-solid fa-list-ul"></i></button>
                        </div>
                        <div class="editor-content bg-light" contenteditable="true">-</div>
                    </div>

                    <!-- Form Group: Persyaratan Materi -->
                    <div class="form-group-edit mb-4">
                        <label class="form-label-edit">PERSYARATAN MATERI</label>
                        <div class="editor-toolbar d-flex flex-wrap gap-2 align-items-center mb-2">
                            <select class="form-select form-select-sm w-auto border-0 bg-light"><option>Font</option></select>
                            <select class="form-select form-select-sm w-auto border-0 bg-light"><option>Size</option></select>
                            <div class="text-muted">|</div>
                            <button type="button" class="btn btn-sm btn-light" title="Bold"><i class="fa-solid fa-bold"></i></button>
                            <button type="button" class="btn btn-sm btn-light" title="Italic"><i class="fa-solid fa-italic"></i></button>
                            <button type="button" class="btn btn-sm btn-light" title="Strikethrough"><i class="fa-solid fa-strikethrough"></i></button>
                            <div class="text-muted">|</div>
                            <button type="button" class="btn btn-sm btn-light" title="Numbered List"><i class="fa-solid fa-list-ol"></i></button>
                            <button type="button" class="btn btn-sm btn-light" title="Bullet List"><i class="fa-solid fa-list-ul"></i></button>
                        </div>
                        <div class="editor-content bg-light" contenteditable="true">-</div>
                    </div>

                    <!-- Form Group: Background Materi -->
                    <div class="form-group-edit mb-4">
                        <label class="form-label-edit">BACKGROUND MATERI</label>
                        <div class="upload-area-edit">
                            <div class="card-cover-edit rounded mb-3 border border-dashed" style="height: 180px;"></div>
                            <button type="button" class="btn btn-outline-secondary w-100 py-2">Ganti Sampul</button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-actions-edit mt-5 pt-3 border-top">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">
                            <i class="fa-solid fa-save"></i> Simpan Kelas
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection