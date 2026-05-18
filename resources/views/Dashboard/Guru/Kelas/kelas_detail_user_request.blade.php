@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
    
        <div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('teachers_dashboard') }}" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                <h5 class="mb-0 fw-bold">IX B-INFORMATIKA (KOMP)</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-success small fw-bold"><i class="fa-solid fa-check-circle"></i> Kelas Disetujui</span>
                <button class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-share-nodes"></i> Bagikan</button>
            </div>
        </div>

        <div class="content-area">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_class_detail') }}">Topik <span class="badge bg-light text-dark">9</span></a></li>
                <li class="nav-item"><a class="nav-link active fw-bold" href="#">Anggota <span class="badge bg-light text-dark">15</span></a></li>
                <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_class_discuss') }}"><i class="fa-regular fa-comments"></i> Diskusi</a></li>
                <li class="nav-item"><a class="nav-link text-muted" href="{{ route('guru_class_edit') }}"><i class="fa-solid fa-gear"></i> Pengaturan</a></li>
                <li class="nav-item ms-auto"><span class="nav-link border-0 text-muted">Informatika</span></li>
            </ul>

            <div class="sub-tabs">
                <a href="{{ route('guru_class_users') }}">Anggota Aktif <span class="badge rounded-pill">15</span></a>
                <a href="#" class="active">Permintaan Bergabung <span class="badge rounded-pill">0</span></a>
            </div>

            <div class="position-relative mb-4">
                <input type="text" class="form-control rounded-pill py-2 pe-5" placeholder="Cari disini...">
                <i class="fa-solid fa-search position-absolute top-50 end-0 translate-middle-y me-4 text-muted"></i>
            </div>

            <div class="bg-light rounded p-5 text-center text-muted border border-1 border-opacity-50">
                <i class="fa-solid fa-triangle-exclamation fa-2x mb-2 text-secondary opacity-75"></i>
                <p class="mb-0 fw-medium">Tidak ada anggota permintaan bergabung.</p>
            </div>
        </div>
    </div>
@endsection