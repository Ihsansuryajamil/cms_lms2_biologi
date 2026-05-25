@extends('Layouts.appDepan')
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
            <div class="filter-section">
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
                            <option value="oldest">Terlama</option>
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
            </div>

            <!-- Statistics Cards -->
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-value">-</div>
                    <div class="stat-label">Rata-Rata Nilai</div>
                </div>
                <div class="stat-card success">
                    <div class="stat-value">-</div>
                    <div class="stat-label">Tugas Selesai</div>
                </div>
                <div class="stat-card warning">
                    <div class="stat-value">-</div>
                    <div class="stat-label">Pending</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">-</div>
                    <div class="stat-label">Nilai Tertinggi</div>
                </div>
            </div>

            <!-- History Table -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-history">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Jenis Tugas</th>
                                <th>Judul</th>
                                <th>Mata Pelajaran</th>
                                <th>Tanggal Pengumpulan</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection
