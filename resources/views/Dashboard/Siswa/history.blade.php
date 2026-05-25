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
            </div>

            <!-- Statistics Cards -->
            <div class="stats-cards">
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
                                <td>1</td>
                                <td><span class="badge bg-primary">Tugas</span></td>
                                <td><strong>Analisis Proses Fotosintesis</strong></td>
                                <td>Biologi</td>
                                <td>18 Mei 2026</td>
                                <td>20 Mei 2026</td>
                                <td><span class="badge-status badge-completed"><i class="fa-solid fa-check-circle me-1"></i>Selesai</span></td>
                                <td><span class="score-cell high">92</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><span class="badge bg-info">Quiz</span></td>
                                <td><strong>Quiz Transportasi Membran</strong></td>
                                <td>Biologi</td>
                                <td>16 Mei 2026</td>
                                <td>16 Mei 2026</td>
                                <td><span class="badge-status badge-completed"><i class="fa-solid fa-check-circle me-1"></i>Selesai</span></td>
                                <td><span class="score-cell high">88</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><span class="badge bg-success">Ujian</span></td>
                                <td><strong>Ujian Tengah Semester - Biologi</strong></td>
                                <td>Biologi</td>
                                <td>15 Mei 2026</td>
                                <td>15 Mei 2026</td>
                                <td><span class="badge-status badge-completed"><i class="fa-solid fa-check-circle me-1"></i>Selesai</span></td>
                                <td><span class="score-cell high">85</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><span class="badge bg-primary">Tugas</span></td>
                                <td><strong>Laporan Eksperimen Osmosis</strong></td>
                                <td>Biologi</td>
                                <td>12 Mei 2026</td>
                                <td>14 Mei 2026</td>
                                <td><span class="badge-status badge-completed"><i class="fa-solid fa-check-circle me-1"></i>Selesai</span></td>
                                <td><span class="score-cell">80</span></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><span class="badge bg-info">Quiz</span></td>
                                <td><strong>Quiz Struktur Sel</strong></td>
                                <td>Biologi</td>
                                <td>10 Mei 2026</td>
                                <td>10 Mei 2026</td>
                                <td><span class="badge-status badge-completed"><i class="fa-solid fa-check-circle me-1"></i>Selesai</span></td>
                                <td><span class="score-cell high">95</span></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td><span class="badge bg-primary">Tugas</span></td>
                                <td><strong>Proyek Organiser Sel Hewan</strong></td>
                                <td>Biologi</td>
                                <td>08 Mei 2026</td>
                                <td>08 Mei 2026</td>
                                <td><span class="badge-status badge-completed"><i class="fa-solid fa-check-circle me-1"></i>Selesai</span></td>
                                <td><span class="score-cell high">90</span></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td><span class="badge bg-primary">Tugas</span></td>
                                <td><strong>Essay: Mutasi dan Evolusi</strong></td>
                                <td>Biologi</td>
                                <td>-</td>
                                <td>25 Mei 2026</td>
                                <td><span class="badge-status badge-pending"><i class="fa-solid fa-hourglass-end me-1"></i>Pending</span></td>
                                <td><span class="score-cell low">-</span></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td><span class="badge bg-info">Quiz</span></td>
                                <td><strong>Quiz Genetika Mendel</strong></td>
                                <td>Biologi</td>
                                <td>-</td>
                                <td>23 Mei 2026</td>
                                <td><span class="badge-status badge-pending"><i class="fa-solid fa-hourglass-end me-1"></i>Pending</span></td>
                                <td><span class="score-cell low">-</span></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td><span class="badge bg-primary">Tugas</span></td>
                                <td><strong>Analisis Diagram Daur Hidup Katak</strong></td>
                                <td>Biologi</td>
                                <td>03 Mei 2026</td>
                                <td>02 Mei 2026</td>
                                <td><span class="badge-status badge-late"><i class="fa-solid fa-clock me-1"></i>Terlambat</span></td>
                                <td><span class="score-cell low">70</span></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td><span class="badge bg-success">Ujian</span></td>
                                <td><strong>Ujian Harian Evolusi</strong></td>
                                <td>Biologi</td>
                                <td>01 Mei 2026</td>
                                <td>01 Mei 2026</td>
                                <td><span class="badge-status badge-completed"><i class="fa-solid fa-check-circle me-1"></i>Selesai</span></td>
                                <td><span class="score-cell high">87</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection
