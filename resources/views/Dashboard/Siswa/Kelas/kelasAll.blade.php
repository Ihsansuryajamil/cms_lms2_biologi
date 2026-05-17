@extends('Layouts.app')
@section('content')
<div class="topbar d-flex align-items-center w-100">
            <div class="d-flex align-items-center gap-3 w-100">
                <span class="fw-bold"><i class="fa-solid fa-chalkboard"></i> Kelas Saya</span>
                <select class="form-select w-auto"><option>Tahun Pelajaran 2025/2026 - (Aktif)</option></select>
                <!-- <div class="input-group ms-auto" style="width: 250px;">
                    <input type="text" class="form-control" placeholder="Cari kelas...">
                    <button class="btn btn-outline-secondary"><i class="fa-solid fa-search"></i></button>
                </div> -->
            </div>
        </div>

        <div class="content-area">
            <!-- Tab Navigation & Button - Aligned -->
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 flex-wrap gap-3">
                <ul class="nav nav-tabs mb-0" id="kelasTab" style="flex: 1; min-width: 0;">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="{{ route('students_kelas') }}" data-tab="aktif" onclick="switchKelasTab(event, 'aktif')">Kelas Aktif <span class="badge bg-primary rounded-pill ms-2">5</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-muted" href="{{ route('students_kelas_belum_disetujui') }}" title="Kelas Non-Aktif">Kelas Non-Aktif <span class="badge bg-warning rounded-pill ms-2">1</span></a>
                    </li>
                </ul>
                <button class="btn btn-sm border-3 rounded-pill text-white" style="background: #0d6efd; white-space: nowrap;" onclick="showJoinClassModal()"><i class="fa-solid fa-plus"></i> Masuk Kelas</button>
            </div>

            <div id="aktif-tab" class="tab-content">
                <div class="row row-cols-2 row-cols-md-2 row-cols-xl-4 g-4">

                <!-- Card Kelas 1 -->
                <div class="col">
                    <div class="class-card">
                        <div class="card-cover" style="background: linear-gradient(135deg,#4f46e5,#818cf8);">
                            <span class="text-white small opacity-75"><i class="fa-regular fa-file-lines"></i> IX-B • Semester Ganjil</span>
                        </div>
                        <div style="background:#4f46e5; color:white; padding:8px 15px; font-size:0.8rem; display:flex; align-items:center; gap:10px;">
                            <i class="fa-solid fa-laptop-code"></i>
                            <span>Materi:<br><strong>Informatika</strong></span>
                        </div>
                        <div class="p-3">
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <span><i class="fa-solid fa-users"></i> 30 Peserta</span>
                                <span><i class="fa-regular fa-calendar"></i> 14/07/25</span>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-muted">Progress</span>
                                    <span class="text-primary fw-bold">60%</span>
                                </div>
                                <div class="progress" style="height:6px; border-radius:10px;">
                                    <div class="progress-bar bg-primary" style="width:60%;"></div>
                                </div>
                            </div>
                            <a href="{{ route('students_kelas_details') }}" class="btn btn-light w-100 text-primary border border-primary-subtle rounded-pill">Masuk Kelas</a>
                        </div>
                    </div>
                </div>

                <!-- Card Kelas 2 -->
                <div class="col">
                    <div class="class-card">
                        <div class="card-cover" style="background: linear-gradient(135deg,#16a34a,#4ade80);">
                            <span class="text-white small opacity-75"><i class="fa-regular fa-file-lines"></i> IX-B • Semester Ganjil</span>
                        </div>
                        <div style="background:#16a34a; color:white; padding:8px 15px; font-size:0.8rem; display:flex; align-items:center; gap:10px;">
                            <i class="fa-solid fa-square-root-variable"></i>
                            <span>Materi:<br><strong>Matematika</strong></span>
                        </div>
                        <div class="p-3">
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <span><i class="fa-solid fa-users"></i> 30 Peserta</span>
                                <span><i class="fa-regular fa-calendar"></i> 14/07/25</span>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-muted">Progress</span>
                                    <span class="fw-bold" style="color:#16a34a;">45%</span>
                                </div>
                                <div class="progress" style="height:6px; border-radius:10px;">
                                    <div class="progress-bar" style="width:45%; background:#16a34a;"></div>
                                </div>
                            </div>
                            <a href="#" class="btn btn-light w-100 text-success border border-success-subtle rounded-pill">Masuk Kelas</a>
                        </div>
                    </div>
                </div>

                <!-- Card Kelas 3 -->
                <div class="col">
                    <div class="class-card">
                        <div class="card-cover" style="background: linear-gradient(135deg,#ea580c,#fb923c);">
                            <span class="text-white small opacity-75"><i class="fa-regular fa-file-lines"></i> IX-B • Semester Ganjil</span>
                        </div>
                        <div style="background:#ea580c; color:white; padding:8px 15px; font-size:0.8rem; display:flex; align-items:center; gap:10px;">
                            <i class="fa-solid fa-book-open"></i>
                            <span>Materi:<br><strong>Bahasa Indonesia</strong></span>
                        </div>
                        <div class="p-3">
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <span><i class="fa-solid fa-users"></i> 30 Peserta</span>
                                <span><i class="fa-regular fa-calendar"></i> 14/07/25</span>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-muted">Progress</span>
                                    <span class="fw-bold" style="color:#ea580c;">80%</span>
                                </div>
                                <div class="progress" style="height:6px; border-radius:10px;">
                                    <div class="progress-bar" style="width:80%; background:#ea580c;"></div>
                                </div>
                            </div>
                            <a href="#" class="btn btn-light w-100 text-warning border border-warning-subtle rounded-pill">Masuk Kelas</a>
                        </div>
                    </div>
                </div>

                <!-- Card Kelas 4 -->
                <div class="col">
                    <div class="class-card">
                        <div class="card-cover" style="background: linear-gradient(135deg,#dc2626,#f87171);">
                            <span class="text-white small opacity-75"><i class="fa-regular fa-file-lines"></i> IX-B • Semester Ganjil</span>
                        </div>
                        <div style="background:#dc2626; color:white; padding:8px 15px; font-size:0.8rem; display:flex; align-items:center; gap:10px;">
                            <i class="fa-solid fa-flask"></i>
                            <span>Materi:<br><strong>IPA</strong></span>
                        </div>
                        <div class="p-3">
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <span><i class="fa-solid fa-users"></i> 30 Peserta</span>
                                <span><i class="fa-regular fa-calendar"></i> 14/07/25</span>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-muted">Progress</span>
                                    <span class="fw-bold text-danger">30%</span>
                                </div>
                                <div class="progress" style="height:6px; border-radius:10px;">
                                    <div class="progress-bar bg-danger" style="width:30%;"></div>
                                </div>
                            </div>
                            <a href="#" class="btn btn-light w-100 text-danger border border-danger-subtle rounded-pill">Masuk Kelas</a>
                        </div>
                    </div>
                </div>

                <!-- Card Kelas 5 -->
                <div class="col">
                    <div class="class-card">
                        <div class="card-cover" style="background: linear-gradient(135deg,#0891b2,#67e8f9);">
                            <span class="text-white small opacity-75"><i class="fa-regular fa-file-lines"></i> IX-B • Semester Ganjil</span>
                        </div>
                        <div style="background:#0891b2; color:white; padding:8px 15px; font-size:0.8rem; display:flex; align-items:center; gap:10px;">
                            <i class="fa-solid fa-globe"></i>
                            <span>Materi:<br><strong>IPS</strong></span>
                        </div>
                        <div class="p-3">
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <span><i class="fa-solid fa-users"></i> 30 Peserta</span>
                                <span><i class="fa-regular fa-calendar"></i> 14/07/25</span>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-muted">Progress</span>
                                    <span class="fw-bold" style="color:#0891b2;">55%</span>
                                </div>
                                <div class="progress" style="height:6px; border-radius:10px;">
                                    <div class="progress-bar" style="width:55%; background:#0891b2;"></div>
                                </div>
                            </div>
                            <a href="#" class="btn btn-light w-100 text-info border border-info-subtle rounded-pill">Masuk Kelas</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Masuk Kelas -->
    <div class="modal fade" id="joinClassModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-header border-bottom bg-light">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-key me-2"></i> Masuk Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-muted mb-3">Masukkan kode kelas yang diberikan oleh guru untuk bergabung dengan kelas.</p>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kode Kelas</label>
                        <input type="text" class="form-control form-control-lg" id="classCode" placeholder="Contoh: INF2024" maxlength="20">
                        <small class="text-muted">Kode kelas terdiri dari huruf dan angka</small>
                    </div>
                    <div class="alert alert-info bg-info bg-opacity-10 border-0 mb-0">
                        <small><i class="fa-solid fa-circle-info me-2"></i> Masukkan kode kelas dengan benar. Kelas yang bergabung akan menunggu persetujuan dari guru.</small>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary rounded-pill" onclick="joinClassWithCode()"><i class="fa-solid fa-check"></i> Masuk Kelas</button>
                </div>
            </div>
        </div>

@endsection