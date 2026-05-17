@extends('Layouts.app')
@section('content')
    <div class="topbar d-flex align-items-center w-100">
        <div class="d-flex align-items-center gap-3 w-100">
            <span class="fw-bold"><i class="fa-solid fa-star text-danger"></i> Nilai Saya</span>
            <select class="form-select w-auto"><option>Semester Ganjil 2025/2026</option></select>
        </div>
    </div>

    <div class="content-area">

        <!-- Ringkasan Nilai -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-3 p-3 text-center">
                    <div class="fw-bold fs-2 text-primary">82</div>
                    <div class="text-muted small">Rata-Rata Nilai</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-3 p-3 text-center">
                    <div class="fw-bold fs-2 text-success">95</div>
                    <div class="text-muted small">Nilai Tertinggi</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-3 p-3 text-center">
                    <div class="fw-bold fs-2 text-warning">68</div>
                    <div class="text-muted small">Nilai Terendah</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-3 p-3 text-center">
                    <div class="fw-bold fs-2 text-info">8</div>
                    <div class="small text-muted">Tugas Dinilai</div>
                </div>
            </div>
        </div>

        <!-- Tabel Nilai per Mata Pelajaran -->
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white pt-3 px-4">
                <h6 class="fw-bold mb-0">Rekap Nilai per Mata Pelajaran</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-anggota mb-0">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th width="130">MATA PELAJARAN</th>
                                <th>JUDUL TUGAS</th>
                                <th width="120" class="text-center">JENIS</th>
                                <th width="100" class="text-center">NILAI</th>
                                <th width="120" class="text-center">GRADE</th>
                                <th width="150">TANGGAL DINILAI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-muted fw-bold">1</td>
                                <td><span class="badge-mapel badge-mapel-blue">Informatika</span></td>
                                <td class="fw-medium">Tugas Mengenal Hardware</td>
                                <td class="text-center"><span class="badge bg-light text-dark border small">Tugas</span></td>
                                <td class="text-center">
                                    <span class="nilai-circle" style="background:#dcfce7;color:#16a34a;">90</span>
                                </td>
                                <td class="text-center"><span class="grade-badge grade-a">A</span></td>
                                <td class="text-muted small">12 Jul 2025</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-bold">2</td>
                                <td><span class="badge-mapel badge-mapel-blue">Informatika</span></td>
                                <td class="fw-medium">UH Bab 1 - Sistem Komputer</td>
                                <td class="text-center"><span class="badge bg-light text-dark border small">Ulangan</span></td>
                                <td class="text-center">
                                    <span class="nilai-circle" style="background:#dcfce7;color:#16a34a;">85</span>
                                </td>
                                <td class="text-center"><span class="grade-badge grade-a">A</span></td>
                                <td class="text-muted small">10 Jul 2025</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-bold">3</td>
                                <td><span class="badge-mapel badge-mapel-green">Matematika</span></td>
                                <td class="fw-medium">Latihan Soal Persamaan Linear</td>
                                <td class="text-center"><span class="badge bg-light text-dark border small">Tugas</span></td>
                                <td class="text-center">
                                    <span class="nilai-circle" style="background:#fef9c3;color:#854d0e;">75</span>
                                </td>
                                <td class="text-center"><span class="grade-badge grade-b">B</span></td>
                                <td class="text-muted small">8 Jul 2025</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-bold">4</td>
                                <td><span class="badge-mapel badge-mapel-orange">B. Indonesia</span></td>
                                <td class="fw-medium">Analisis Teks Eksposisi</td>
                                <td class="text-center"><span class="badge bg-light text-dark border small">Tugas</span></td>
                                <td class="text-center">
                                    <span class="nilai-circle" style="background:#dcfce7;color:#16a34a;">95</span>
                                </td>
                                <td class="text-center"><span class="grade-badge grade-a">A</span></td>
                                <td class="text-muted small">5 Jul 2025</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-bold">5</td>
                                <td><span class="badge-mapel badge-mapel-red">IPA</span></td>
                                <td class="fw-medium">Kuis Sel dan Jaringan</td>
                                <td class="text-center"><span class="badge bg-light text-dark border small">Kuis</span></td>
                                <td class="text-center">
                                    <span class="nilai-circle" style="background:#fee2e2;color:#dc2626;">68</span>
                                </td>
                                <td class="text-center"><span class="grade-badge grade-c">C</span></td>
                                <td class="text-muted small">3 Jul 2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection