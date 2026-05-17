@extends('Layouts.app')
@section('content')
    <div class="topbar d-flex align-items-center w-100">
            <div class="d-flex align-items-center gap-3 w-100">
                <span class="fw-bold"><i class="fa-solid fa-chalkboard"></i> Kelas Belum Disetujui</span>
                <select class="form-select w-auto"><option>Tahun Pelajaran 2025/2026 - (Aktif)</option></select>
            </div>
        </div>

        <div class="content-area">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 flex-wrap gap-3">
                <ul class="nav nav-tabs mb-0" id="kelasTab" style="flex: 1; min-width: 0;">
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="{{ route('students_kelas') }}" data-tab="aktif" onclick="switchKelasTab(event, 'aktif')">Kelas Aktif <span class="badge bg-primary rounded-pill ms-2">5</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-muted" href="{{ route('students_kelas_belum_disetujui') }}" title="Kelas Non-Aktif">Kelas Non-Aktif <span class="badge bg-warning rounded-pill ms-2">1</span></a>
                    </li>
                </ul>
            </div>

            <!-- Kelas Belum Disetujui Cards -->
            <div class="row row-cols-2 row-cols-md-2 row-cols-xl-4 g-4">

                <!-- Card Kelas Belum Disetujui 1 -->
                <div class="col">
                    <div class="class-card" style="border: 2px dashed #ffc107;">
                        <div class="card-cover" style="background: linear-gradient(135deg,#fbbf24,#fcd34d); position: relative;">
                            <span class="text-white small opacity-75"><i class="fa-regular fa-file-lines"></i> Menunggu Persetujuan</span>
                            <span class="badge bg-warning text-dark" style="position: absolute; top: 10px; right: 10px;"><i class="fa-solid fa-hourglass-end"></i> Pending</span>
                        </div>
                        <div style="background:#fbbf24; color:white; padding:8px 15px; font-size:0.8rem; display:flex; align-items:center; gap:10px;">
                            <i class="fa-solid fa-book"></i>
                            <span>Materi:<br><strong>Biologi Lanjut</strong></span>
                        </div>
                        <div class="p-3">
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <span><i class="fa-solid fa-user-tie"></i> Guru: Ibu Siti</span>
                            </div>
                            <p class="small text-muted mb-2">Kode Kelas: <strong>BIO2024</strong></p>
                            <p class="small mb-3"><i class="fa-solid fa-calendar-days text-muted"></i> Terdaftar: 10 Mei 2026</p>
                            
                            <button class="btn btn-outline-warning w-100 rounded-pill btn-sm" onclick="withdrawClass('BIO2024')"><i class="fa-solid fa-times"></i> Batalkan Pendaftaran</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Empty State (when no pending classes) -->
            <div class="text-center py-5" style="display: none;" id="emptyState">
                <i class="fa-solid fa-inbox text-muted" style="font-size: 3rem;"></i>
                <h5 class="text-muted mt-3">Tidak ada kelas yang menunggu persetujuan</h5>
                <p class="text-muted small">Semua permintaan kelas Anda telah disetujui atau tidak ada permintaan baru.</p>
                <a href="kelas_siswa.html" class="btn btn-primary rounded-pill btn-sm mt-2">Lihat Kelas Aktif</a>
            </div>
        </div>
@endsection