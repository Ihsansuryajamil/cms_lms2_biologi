@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
<div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <a href="user_management.html" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                <h5 class="mb-0 fw-bold">Detail User</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-warning btn-sm rounded-pill"><i class="fa-solid fa-pencil"></i> Edit User</button>
                <button class="btn btn-danger btn-sm rounded-pill"><i class="fa-solid fa-trash"></i> Hapus User</button>
            </div>
        </div>

        <div class="content-area p-4">
            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-lg-8">
                    <!-- Profile Info Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-4 mb-4">
                                <img src="https://ui-avatars.com/api/?name=Ibu+Siti&background=27ae60&color=fff&size=120" class="rounded-circle" width="120" height="120" alt="Avatar">
                                <div>
                                    <h5 class="fw-bold mb-1">Ibu Siti Nurhaliza</h5>
                                    <p class="text-muted mb-2"><span class="badge bg-success">Guru</span> <span class="badge bg-success ms-2">Aktif</span></p>
                                    <p class="text-muted small mb-1"><strong>Email:</strong> siti.nurhaliza@gmail.com</p>
                                    <p class="text-muted small mb-0"><strong>No. Telepon:</strong> 08123456789</p>
                                </div>
                            </div>
                            <hr>
                            <h6 class="fw-bold mb-3"><i class="fa-solid fa-id-card me-2"></i> Informasi Pribadi</h6>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">NIP / NIS</label>
                                    <p class="fw-medium">198505121999032002</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">JENIS KELAMIN</label>
                                    <p class="fw-medium">Perempuan</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">TEMPAT LAHIR</label>
                                    <p class="fw-medium">Jakarta</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">TANGGAL LAHIR</label>
                                    <p class="fw-medium">12 Mei 1985</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">AGAMA</label>
                                    <p class="fw-medium">Islam</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">KEWARGANEGARAAN</label>
                                    <p class="fw-medium">Indonesia</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Card -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3"><i class="fa-solid fa-location-dot me-2"></i> Alamat</h6>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">PROVINSI</label>
                                    <p class="fw-medium">Jawa Barat</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">KOTA/KABUPATEN</label>
                                    <p class="fw-medium">Bandung</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">KECAMATAN</label>
                                    <p class="fw-medium">Sukasari</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">KODE POS</label>
                                    <p class="fw-medium">40154</p>
                                </div>
                            </div>
                            <div>
                                <label class="form-label small fw-bold text-muted">ALAMAT LENGKAP</label>
                                <p class="fw-medium">Jalan Merdeka No. 25, RT 03 RW 05, Sukasari, Bandung 40154</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-4">
                    <!-- Status Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3"><i class="fa-solid fa-bar-chart me-2"></i> Status Akun</h6>
                            <div class="mb-3">
                                <div class="small fw-bold text-muted mb-2">ROLE</div>
                                <p class="fw-medium mb-0">Guru</p>
                            </div>
                            <div class="mb-3">
                                <div class="small fw-bold text-muted mb-2">STATUS</div>
                                <p class="mb-0"><span class="badge bg-success">Aktif</span></p>
                            </div>
                            <div class="mb-3">
                                <div class="small fw-bold text-muted mb-2">TERDAFTAR</div>
                                <p class="fw-medium mb-0">15 Juli 2025</p>
                            </div>
                            <hr>
                            <div class="mb-0">
                                <div class="small fw-bold text-muted mb-2">KELAS MENGAJAR</div>
                                <p class="fw-medium mb-0">5 Kelas</p>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Card -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3"><i class="fa-solid fa-history me-2"></i> Aktivitas Terbaru</h6>
                            <div class="small text-muted mb-3">
                                <div class="mb-2">
                                    <strong>Login</strong><br>
                                    <small>Hari ini, 10:30</small>
                                </div>
                                <div class="mb-2">
                                    <strong>Mengubah Profil</strong><br>
                                    <small>Kemarin, 14:15</small>
                                </div>
                                <div class="mb-2">
                                    <strong>Membuat Kelas</strong><br>
                                    <small>3 hari yang lalu</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection