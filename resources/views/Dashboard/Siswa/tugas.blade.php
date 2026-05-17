@extends('Layouts.app')
@section('content')
    <div class="topbar d-flex align-items-center w-100">
        <div class="d-flex align-items-center gap-3 w-100">
            <span class="fw-bold"><i class="fa-solid fa-clipboard-list text-warning"></i> Tugas Saya</span>
            <select class="form-select w-auto"><option>Semua Mata Pelajaran</option><option>Informatika</option><option>Matematika</option></select>
            <!-- <div class="input-group ms-auto" style="width: 250px;">
                <input type="text" class="form-control" placeholder="Cari tugas...">
                <button class="btn btn-outline-secondary"><i class="fa-solid fa-search"></i></button>
            </div> -->
        </div>
    </div>

    <div class="content-area">

        <!-- Summary Badges -->
        <div class="d-flex gap-3 mb-4 flex-wrap">
            <div class="summary-badge-card" style="border-left:4px solid #dc2626;">
                <div class="fw-bold fs-4 text-danger">2</div>
                <div class="small text-muted">Belum Dikumpul</div>
            </div>
            <div class="summary-badge-card" style="border-left:4px solid #16a34a;">
                <div class="fw-bold fs-4 text-success">5</div>
                <div class="small text-muted">Sudah Dikumpul</div>
            </div>
            <div class="summary-badge-card" style="border-left:4px solid #ea580c;">
                <div class="fw-bold fs-4 text-warning">1</div>
                <div class="small text-muted">Terlambat</div>
            </div>
            <div class="summary-badge-card" style="border-left:4px solid #0891b2;">
                <div class="fw-bold fs-4" style="color:#0891b2;">3</div>
                <div class="small text-muted">Sudah Dinilai</div>
            </div>
        </div>

        <!-- Tab Filter -->
        <div class="sub-tabs mb-4">
            <a href="#" class="active">Semua <span class="badge rounded-pill">8</span></a>
            <a href="#">Belum Dikumpul <span class="badge rounded-pill">2</span></a>
            <a href="#">Sudah Dikumpul <span class="badge rounded-pill">5</span></a>
            <a href="#">Terlambat <span class="badge rounded-pill">1</span></a>
        </div>

        <div class="table-responsive bg-white rounded border">
            <table class="table table-anggota mb-0">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th width="130">MATA PELAJARAN</th>
                        <th>JUDUL TUGAS</th>
                        <th width="140">DEADLINE</th>
                        <th width="130" class="text-center">STATUS</th>
                        <th width="80" class="text-center">NILAI</th>
                        <th width="120" class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-muted fw-bold">1</td>
                        <td><span class="badge-mapel badge-mapel-blue">Informatika</span></td>
                        <td>
                            <div class="fw-medium text-dark">Membuat desain flowchart sederhana</div>
                            <div class="text-muted small">Kumpulkan dalam format PDF atau JPG</div>
                        </td>
                        <td class="text-muted small">20 Jul 2025, 23:59</td>
                        <td class="text-center"><span class="status-badge status-pending">Belum Dikumpul</span></td>
                        <td class="text-center text-muted">-</td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm rounded-pill px-3">Kumpulkan</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-bold">2</td>
                        <td><span class="badge-mapel badge-mapel-green">Matematika</span></td>
                        <td>
                            <div class="fw-medium text-dark">Latihan Soal Aljabar Bab 3</div>
                            <div class="text-muted small">Kerjakan di buku tulis, foto & upload</div>
                        </td>
                        <td class="text-muted small">22 Jul 2025, 23:59</td>
                        <td class="text-center"><span class="status-badge status-done">Sudah Dikumpul</span></td>
                        <td class="text-center fw-bold text-success">-</td>
                        <td class="text-center">
                            <button class="btn btn-outline-secondary btn-sm rounded-pill px-3">Lihat</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-bold">3</td>
                        <td><span class="badge-mapel badge-mapel-orange">B. Indonesia</span></td>
                        <td>
                            <div class="fw-medium text-dark">Menulis Teks Narasi 2 Halaman</div>
                            <div class="text-muted small">Tema bebas, kumpulkan format DOCX</div>
                        </td>
                        <td class="text-muted small">25 Jul 2025, 23:59</td>
                        <td class="text-center"><span class="status-badge status-pending">Belum Dikumpul</span></td>
                        <td class="text-center text-muted">-</td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm rounded-pill px-3">Kumpulkan</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-bold">4</td>
                        <td><span class="badge-mapel badge-mapel-red">IPA</span></td>
                        <td>
                            <div class="fw-medium text-dark">Laporan Praktikum Fotosintesis</div>
                            <div class="text-muted small">Laporan lengkap dengan data dan analisis</div>
                        </td>
                        <td class="text-muted small">15 Jul 2025, 23:59</td>
                        <td class="text-center"><span class="status-badge status-late">Terlambat</span></td>
                        <td class="text-center text-muted">-</td>
                        <td class="text-center">
                            <button class="btn btn-outline-danger btn-sm rounded-pill px-3">Kumpulkan</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-bold">5</td>
                        <td><span class="badge-mapel badge-mapel-blue">Informatika</span></td>
                        <td>
                            <div class="fw-medium text-dark">Tugas Mengenal Hardware</div>
                            <div class="text-muted small">Identifikasi 10 komponen hardware komputer</div>
                        </td>
                        <td class="text-muted small">10 Jul 2025, 23:59</td>
                        <td class="text-center"><span class="status-badge status-graded">Sudah Dinilai</span></td>
                        <td class="text-center fw-bold text-primary">90</td>
                        <td class="text-center">
                            <button class="btn btn-outline-secondary btn-sm rounded-pill px-3">Lihat</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection