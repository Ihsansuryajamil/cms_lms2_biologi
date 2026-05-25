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
                <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_course_detail') }}">Topik</a></li>
                <!-- <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_class_users') }}">Anggota <span class="badge bg-light text-dark">15</span></a></li>
                <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_class_discuss') }}"><i class="fa-regular fa-comments"></i> Diskusi</a></li> -->
                <li class="nav-item"><a class="nav-link text-muted fw-bold" href="{{ route('guru_course_detail_edit') }}"><i class="fa-solid fa-gear"></i> Pengaturan</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('guru_course_detail_update_topik') }}"><i class="fa-solid fa-pen-to-square"></i> Update Topik</a></li>
                <!-- <li class="nav-item ms-auto"><span class="nav-link border-0 text-muted">Informatika</span></li> -->
            </ul>

            <div class="course-edit-form bg-white mx-auto mt-4">
                <form>
                    <!-- Form Group: Nama Materi -->
                    <div class="form-group-edit mb-4">
                        <label class="form-label-edit">NAMA TOPIK</label>
                        <input type="text" class="form-control form-control-edit" value="IX B-INFORMATIKA (KOMP)">
                    </div>

                    <!-- Form Group: Link Materi -->
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
                                <span class="input-group-text bg-light border-start-0">menit</span>
                            </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-actions-edit mt-5 pt-3 border-top">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">
                            <i class="fa-solid fa-save"></i> Simpan Update
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection