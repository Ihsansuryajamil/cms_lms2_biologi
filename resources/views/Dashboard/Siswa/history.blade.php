@extends('Layouts.appSiswa')
@section('content')

    <header class="history-header">
        <div class="container">
            <h1><i class="fa-solid fa-history me-3"></i>Riwayat Pengerjaan</h1>
            <p class="mb-0 text-light">Lihat semua riwayat pengerjaan tugas, nilai, dan pencapaian Anda</p>
        </div>
    </header>

    <section class="history-content">
        <div class="container">
            
            <!-- Filter Section -->
            <!-- <div class="filter-section">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label small fw-600">Filter Status</label>
                        <select class="form-select">
                            <option value="">Semua Status</option>
                            <option value="completed">Selesai</option>
                            <option value="pending">Pending</option>
                            <option value="late">Terlambat</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-600">Urutkan Tanggal</label>
                        <select class="form-select">
                            <option value="newest">Terbaru</option>
                            <option value="oldest">Tertua</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-600">Jenis Tugas</label>
                        <select class="form-select">
                            <option value="">Semua Jenis</option>
                            <option value="tugas">Tugas</option>
                            <option value="quiz">Quiz</option>
                            <option value="ujian">Ujian</option>
                        </select>
                    </div>
                </div>
            </div> -->

            <!-- Statistics Cards -->
            <!-- <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-value">87.5</div>
                    <div class="stat-label">Rata-Rata Nilai</div>
                </div>
                <div class="stat-card success">
                    <div class="stat-value">24</div>
                    <div class="stat-label">Tugas Selesai</div>
                </div>
                <div class="stat-card warning">
                    <div class="stat-value">3</div>
                    <div class="stat-label">Pending</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">95</div>
                    <div class="stat-label">Nilai Tertinggi</div>
                </div>
            </div> -->

            <!-- History Table -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-history">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Jenis</th>
                                <th>Judul</th>
                                <th>Mata Pelajaran</th>
                                <th>Tanggal Pengumpulan</th>
                                <!-- <th>Deadline</th> -->
                                <!-- <th>Status</th> -->
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><span class="badge bg-primary">Materi</span></td>
                                <td><strong>Analisis Proses Fotosintesis</strong></td>
                                <td>Sistem Endokrin (Endocrine System)</td>
                                <td>18 Mei 2026</td>
                                <td><span class="score-cell high">-</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><span class="badge bg-danger">Quiz PG</span></td>
                                <td><strong>Quiz Transportasi Membran</strong></td>
                                <td>Sistem Endokrin (Endocrine System)</td>
                                <td>16 Mei 2026</td>
                                <!-- <td>16 Mei 2026</td> -->
                                <!-- <td><span class="badge-status badge-completed"><i class="fa-solid fa-check-circle me-1"></i>Selesai</span></td> -->
                                <td><span class="score-cell high">88</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><span class="badge bg-danger">Quiz Essay</span></td>
                                <td><strong>Ujian Tengah Semester - Biologi</strong></td>
                                <td>Sistem Endokrin (Endocrine System)</td>
                                <td>15 Mei 2026</td>
                                <!-- <td>15 Mei 2026</td> -->
                                <!-- <td><span class="badge-status badge-completed"><i class="fa-solid fa-check-circle me-1"></i>Selesai</span></td> -->
                                <td><span class="score-cell high">85</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><span class="badge bg-primary">Materi</span></td>
                                <td><strong>Laporan Eksperimen Osmosis</strong></td>
                                <td>Sistem Endokrin (Endocrine System)</td>
                                <td>12 Mei 2026</td>
                                <!-- <td>14 Mei 2026</td> -->
                                <!-- <td><span class="badge-status badge-completed"><i class="fa-solid fa-check-circle me-1"></i>Selesai</span></td> -->
                                <td><span class="score-cell">-</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection
