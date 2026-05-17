@extends('Layouts.app')
@section('content')
    <div class="content-area pt-4">

        <!-- Profile Card -->
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-body p-4 d-flex align-items-center">
                <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=4f46e5&color=fff&size=100" class="rounded-circle me-4" alt="Avatar">
                <div>
                    <h4 class="fw-bold mb-1">Budi Santoso</h4>
                    <p class="text-muted mb-1">NIS: 232407001 &nbsp;|&nbsp; Kelas IX-B</p>
                    <p class="text-muted mb-3 small">Tahun Pelajaran 2025/2026 — Semester Ganjil</p>
                    <a href="{{ route('students_profile_setting') }}" class="btn btn-outline-secondary rounded-pill btn-sm px-3 fw-medium">
                        <i class="fa-solid fa-gear"></i> Pengaturan Profil
                    </a>
                </div>
            </div>
        </div>

        <!-- Info Profil -->
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h6 class="fw-bold m-0 border-bottom border-primary border-3 d-inline-block pb-3" style="color:#444;">Profil Siswa</h6>
                <hr class="m-0 mt-n1">
            </div>
            <div class="card-body p-0">
                <div class="row g-0">
                    <div class="col-md-4 p-4 border-end border-bottom">
                        <div class="d-flex gap-3">
                            <i class="fa-solid fa-id-badge text-muted mt-1"></i>
                            <div>
                                <div class="small text-muted mb-1">Nomor Induk Siswa (NIS)</div>
                                <div class="fw-medium">232407001</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 p-4 border-end border-bottom">
                        <div class="d-flex gap-3">
                            <i class="fa-solid fa-school text-muted mt-1"></i>
                            <div>
                                <div class="small text-muted mb-1">Kelas</div>
                                <div class="fw-medium">IX-B</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 p-4 border-bottom">
                        <div class="d-flex gap-3">
                            <i class="fa-solid fa-envelope text-muted mt-1"></i>
                            <div>
                                <div class="small text-muted mb-1">Email</div>
                                <div class="fw-medium">budi.santoso@siswa.sch.id</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-md-4 p-4 border-end border-bottom">
                        <div class="d-flex gap-3">
                            <i class="fa-solid fa-phone text-muted mt-1"></i>
                            <div>
                                <div class="small text-muted mb-1">No. Telepon</div>
                                <div class="fw-medium">08123456789</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 p-4 border-end border-bottom">
                        <div class="d-flex gap-3">
                            <i class="fa-solid fa-cake-candles text-muted mt-1"></i>
                            <div>
                                <div class="small text-muted mb-1">Tanggal Lahir</div>
                                <div class="fw-medium">10 Januari 2010</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 p-4 border-bottom">
                        <div class="d-flex gap-3">
                            <i class="fa-solid fa-venus-mars text-muted mt-1"></i>
                            <div>
                                <div class="small text-muted mb-1">Jenis Kelamin</div>
                                <div class="fw-medium">Laki-laki</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-12 p-4 border-bottom">
                        <div class="d-flex gap-3">
                            <i class="fa-solid fa-location-dot text-muted mt-1"></i>
                            <div>
                                <div class="small text-muted mb-1">Alamat</div>
                                <div class="fw-medium">Jl. Contoh No. 10, Bandung, Jawa Barat</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-4">
                        <div class="d-flex gap-3">
                            <i class="fa-solid fa-user text-muted mt-1"></i>
                            <div class="w-100">
                                <div class="small text-muted mb-2">Tentang</div>
                                <div class="bg-light rounded p-3 text-muted small">Tidak Ada Data</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection