@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
    
        <div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('guru_class_all') }}" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                <h5 class="mb-0 fw-bold">Buat Kelas Baru</h5>
            </div>
        </div>

        <div class="content-area">

            <div class="border rounded p-5 bg-white mx-auto mt-4" style="max-width: 850px;">
                <div class="row mb-4 align-items-center">
                    <div class="col-md-3 text-muted small fw-bold text-md-end">NAMA KELAS</div>
                    <div class="col-md-9">
                        <input type="text" class="form-control border-0 border-bottom rounded-0 px-0 text-secondary" value="IX B-INFORMATIKA (KOMP)">
                    </div>
                </div>

                <div class="row mb-4 align-items-center">
                    <div class="col-md-3 text-muted small fw-bold text-md-end">MATA PELAJARAN</div>
                    <div class="col-md-9">
                        <select class="form-select text-dark">
                            <option selected>Informatika</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-4 align-items-center">
                    <div class="col-md-3 text-muted small fw-bold text-md-end">TINGKAT</div>
                    <div class="col-md-9">
                        <select class="form-select text-dark">
                            <option selected>9 SMP</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-4 align-items-center">
                    <div class="col-md-3 text-muted small fw-bold text-md-end">KODE KELAS</div>
                    <div class="col-md-9">
                        <input type="text" class="form-control border-0 border-bottom rounded-0 px-0">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3 text-muted small fw-bold text-md-end mt-2">DESKRIPSI KELAS</div>
                    <div class="col-md-9">
                        <div class="editor-toolbar d-flex flex-wrap gap-1 align-items-center">
                            <select class="form-select form-select-sm w-auto border-0"><option>Font</option></select>
                            <select class="form-select form-select-sm w-auto border-0"><option>Size</option></select>
                            <span class="text-muted px-2">|</span>
                            <button><i class="fa-solid fa-bold"></i></button>
                            <button><i class="fa-solid fa-italic"></i></button>
                            <button><i class="fa-solid fa-strikethrough"></i></button>
                            <span class="text-muted px-2">|</span>
                            <button><i class="fa-solid fa-list-ol"></i></button>
                            <button><i class="fa-solid fa-list-ul"></i></button>
                        </div>
                        <div class="editor-content bg-white" contenteditable="true">-</div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <div class="border rounded p-3 bg-white">
                            <div class="card-cover rounded mb-3 border border-dashed" style="height: 180px;"></div>
                            <button class="btn btn-outline-secondary w-100 py-2">Ganti Sampul</button>
                        </div>
                        
                        <div class="text-end mt-4">
                            <button class="btn btn-primary rounded-pill px-5 fw-bold"><i class="fa-solid fa-save"></i> Buat Kelas</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection