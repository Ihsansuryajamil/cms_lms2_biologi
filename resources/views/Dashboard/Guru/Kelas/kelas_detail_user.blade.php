@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
    
        <div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('guru_dashboard') }}" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
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
                <a href="#" class="active">Anggota Aktif <span class="badge rounded-pill">15</span></a>
                <a href="{{ route('guru_class_user_request') }}">Permintaan Bergabung <span class="badge rounded-pill">0</span></a>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="input-group" style="max-width: 800px;">
                    <input type="text" class="form-control rounded-start-pill py-2" placeholder="Cari disini...">
                    <button class="btn btn-outline-secondary rounded-end-pill px-3"><i class="fa-solid fa-search"></i></button>
                </div>
                <button class="btn btn-outline-danger text-danger bg-danger bg-opacity-10 border-danger border-opacity-25 rounded-pill px-4 py-2 fw-bold">
                    <i class="fa-solid fa-trash-can"></i> Hapus Anggota
                </button>
            </div>

            <div class="table-responsive bg-white rounded border">
                <table class="table table-anggota mb-0">
                    <thead>
                        <tr>
                            <th width="40" class="text-center"><input class="form-check-input" type="checkbox"></th>
                            <th width="50">#</th>
                            <th width="150">NIP / NIS</th>
                            <th>NAMA</th>
                            <th width="120" class="text-center">ROLE</th>
                            <th width="150">ROMBEL</th>
                            <th width="200">TANGGAL BERGABUNG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"><input class="form-check-input" type="checkbox"></td>
                            <td class="text-muted fw-bold">1</td>
                            <td class="fw-bold">232407003</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=Alexander+Mehaga&background=f39c12&color=fff" class="student-avatar" alt="Avatar">
                                    <div>
                                        <div class="fw-bold mb-1 text-dark">ALEXANDER MEHAGA BEN ANDIKO MANIK</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><span class="role-badge">Siswa</span></td>
                            <td class="text-muted">KELAS IX-B</td>
                            <td class="text-muted">14 Jul 2025, 21:21</td>
                        </tr>
                        <tr>
                            <td class="text-center"><input class="form-check-input" type="checkbox"></td>
                            <td class="text-muted fw-bold">2</td>
                            <td class="fw-bold">232407004</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=Allena+Aurelia&background=e67e22&color=fff" class="student-avatar" alt="Avatar">
                                    <div>
                                        <div class="fw-bold mb-1 text-dark">ALLENA AURELIA GUNAWAN</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><span class="role-badge">Siswa</span></td>
                            <td class="text-muted">KELAS IX-B</td>
                            <td class="text-muted">14 Jul 2025, 21:21</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection