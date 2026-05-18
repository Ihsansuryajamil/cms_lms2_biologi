@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarSiswa')
@endsection
@section('content')
    <div class="topbar d-flex justify-content-between align-items-center w-100">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('students_dashboard') }}" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
            <h5 class="mb-0 fw-bold"><i class="fa-solid fa-bell"></i> Notifikasi</h5>
        </div>
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-sm btn-outline-secondary rounded-pill"><i class="fa-solid fa-check-double"></i> Tandai Semua Dibaca</button>
        </div>
    </div>

    <div class="content-area">
        <div class="row">
            <div class="col-lg-8">
                <!-- Tab Notifikasi -->
                <ul class="nav nav-tabs mb-4" id="notificationTabs">
                    <li class="nav-item"><a class="nav-link active fw-bold" href="#" data-tab="semua" onclick="switchNotificationTab(event, 'semua')">Semua <span class="badge bg-danger rounded-pill ms-2">5</span></a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="#" data-tab="belum-dibaca" onclick="switchNotificationTab(event, 'belum-dibaca')">Belum Dibaca <span class="badge bg-light text-dark rounded-pill ms-2">3</span></a></li>
                </ul>

                <!-- Notifikasi Items -->
                <div id="semua-tab" class="tab-content">
                    <div class="card border-0 shadow-sm mb-3 p-3">
                        <div class="d-flex gap-3">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-clipboard-list text-warning"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1 fw-bold">Tugas Baru: Pengenalan Komputer</h6>
                                        <p class="mb-2 text-muted small">Guru telah menambahkan tugas baru pada kelas Informatika</p>
                                        <small class="text-muted"><i class="fa-solid fa-clock"></i> 2 jam yang lalu</small>
                                    </div>
                                    <button class="btn btn-sm btn-close"></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-3 p-3">
                        <div class="d-flex gap-3">
                            <div class="bg-info bg-opacity-10 rounded-circle p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-circle-question text-info"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1 fw-bold">Quiz Dimulai: Sistem Operasi</h6>
                                        <p class="mb-2 text-muted small">Quiz tentang Sistem Operasi telah dibuka untuk dijawab</p>
                                        <small class="text-muted"><i class="fa-solid fa-clock"></i> 4 jam yang lalu</small>
                                    </div>
                                    <button class="btn btn-sm btn-close"></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-3 p-3">
                        <div class="d-flex gap-3">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-star text-success"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1 fw-bold">Nilai Telah Diunggah</h6>
                                        <p class="mb-2 text-muted small">Guru telah mengunggah nilai untuk tugas Algoritma dan Pemrograman</p>
                                        <small class="text-muted"><i class="fa-solid fa-clock"></i> 1 hari yang lalu</small>
                                    </div>
                                    <button class="btn btn-sm btn-close"></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-3 p-3">
                        <div class="d-flex gap-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-book text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1 fw-bold">Materi Baru: Browser dan CMS</h6>
                                        <p class="mb-2 text-muted small">Guru telah menambahkan materi baru pada kelas Informatika</p>
                                        <small class="text-muted"><i class="fa-solid fa-clock"></i> 2 hari yang lalu</small>
                                    </div>
                                    <button class="btn btn-sm btn-close"></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-3 p-3">
                        <div class="d-flex gap-3">
                            <div class="bg-danger bg-opacity-10 rounded-circle p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-megaphone text-danger"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1 fw-bold">Pengumuman: Jadwal UTS</h6>
                                        <p class="mb-2 text-muted small">Guru telah membuat pengumuman mengenai jadwal UTS bulan Agustus</p>
                                        <small class="text-muted"><i class="fa-solid fa-clock"></i> 3 hari yang lalu</small>
                                    </div>
                                    <button class="btn btn-sm btn-close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="belum-dibaca-tab" class="tab-content" style="display: none;">
                    <div class="card border-0 shadow-sm mb-3 p-3" style="background: #f0f4ff;">
                        <div class="d-flex gap-3">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-clipboard-list text-warning"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1 fw-bold">Tugas Baru: Pengenalan Komputer</h6>
                                        <p class="mb-2 text-muted small">Guru telah menambahkan tugas baru pada kelas Informatika</p>
                                        <small class="text-muted"><i class="fa-solid fa-clock"></i> 2 jam yang lalu</small>
                                    </div>
                                    <button class="btn btn-sm btn-close"></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-3 p-3" style="background: #f0f4ff;">
                        <div class="d-flex gap-3">
                            <div class="bg-info bg-opacity-10 rounded-circle p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-circle-question text-info"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1 fw-bold">Quiz Dimulai: Sistem Operasi</h6>
                                        <p class="mb-2 text-muted small">Quiz tentang Sistem Operasi telah dibuka untuk dijawab</p>
                                        <small class="text-muted"><i class="fa-solid fa-clock"></i> 4 jam yang lalu</small>
                                    </div>
                                    <button class="btn btn-sm btn-close"></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-3 p-3" style="background: #f0f4ff;">
                        <div class="d-flex gap-3">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-star text-success"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1 fw-bold">Nilai Telah Diunggah</h6>
                                        <p class="mb-2 text-muted small">Guru telah mengunggah nilai untuk tugas Algoritma dan Pemrograman</p>
                                        <small class="text-muted"><i class="fa-solid fa-clock"></i> 1 hari yang lalu</small>
                                    </div>
                                    <button class="btn btn-sm btn-close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3"><i class="fa-solid fa-info-circle text-primary"></i> Pengaturan Notifikasi</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="notifTugas" checked>
                            <label class="form-check-label small" for="notifTugas">
                                Notifikasi Tugas Baru
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="notifQuiz" checked>
                            <label class="form-check-label small" for="notifQuiz">
                                Notifikasi Quiz
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="notifNilai" checked>
                            <label class="form-check-label small" for="notifNilai">
                                Notifikasi Nilai
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="notifMateri" checked>
                            <label class="form-check-label small" for="notifMateri">
                                Notifikasi Materi Baru
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="notifPengumuman" checked>
                            <label class="form-check-label small" for="notifPengumuman">
                                Notifikasi Pengumuman
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchNotificationTab(e, tabName) {
            e.preventDefault();
            const tabs = document.querySelectorAll('[id$="-tab"]');
            tabs.forEach(tab => tab.style.display = 'none');
            const navLinks = document.querySelectorAll('#notificationTabs .nav-link');
            navLinks.forEach(link => {
                link.classList.remove('active', 'fw-bold');
                link.classList.add('text-muted');
            });
            const selectedTab = document.getElementById(tabName + '-tab');
            if (selectedTab) {
                selectedTab.style.display = 'block';
            }
            e.target.closest('.nav-link').classList.add('active', 'fw-bold');
            e.target.closest('.nav-link').classList.remove('text-muted');
        }
    </script>
@endsection