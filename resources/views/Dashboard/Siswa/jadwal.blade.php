@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarSiswa')
@endsection
@section('content')
    <div class="topbar d-flex align-items-center w-100">
        <span class="fw-bold"><i class="fa-solid fa-calendar-days text-info"></i> Jadwal Pelajaran</span>
    </div>

    <div class="content-area">

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white pt-3 px-4 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0">Jadwal Minggu Ini — Kelas IX-B</h6>
                <span class="text-muted small">Semester Ganjil 2025/2026</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0 text-center" style="font-size:0.85rem;">
                        <thead style="background:#f8f9fa;">
                            <tr>
                                <th class="text-muted fw-bold py-3" style="width:80px;">JAM</th>
                                <th class="text-muted fw-bold py-3">SENIN</th>
                                <th class="text-muted fw-bold py-3">SELASA</th>
                                <th class="text-muted fw-bold py-3">RABU</th>
                                <th class="text-muted fw-bold py-3">KAMIS</th>
                                <th class="text-muted fw-bold py-3">JUM'AT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold text-muted small py-3">07.00<br>08.00</td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#ede9fe;color:#4f46e5;"><i class="fa-solid fa-laptop-code me-1"></i>Informatika</div></td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#dcfce7;color:#16a34a;"><i class="fa-solid fa-square-root-variable me-1"></i>Matematika</div></td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#fee2e2;color:#dc2626;"><i class="fa-solid fa-flask me-1"></i>IPA</div></td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#e0f2fe;color:#0891b2;"><i class="fa-solid fa-globe me-1"></i>IPS</div></td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#fef3c7;color:#d97706;"><i class="fa-solid fa-book-open me-1"></i>B. Indonesia</div></td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted small py-3">08.00<br>09.00</td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#ede9fe;color:#4f46e5;"><i class="fa-solid fa-laptop-code me-1"></i>Informatika</div></td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#dcfce7;color:#16a34a;"><i class="fa-solid fa-square-root-variable me-1"></i>Matematika</div></td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#fee2e2;color:#dc2626;"><i class="fa-solid fa-flask me-1"></i>IPA</div></td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#e0f2fe;color:#0891b2;"><i class="fa-solid fa-globe me-1"></i>IPS</div></td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#fef3c7;color:#d97706;"><i class="fa-solid fa-book-open me-1"></i>B. Indonesia</div></td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted small py-3">09.00<br>09.15</td>
                                <td colspan="5" class="text-muted small py-3" style="background:#f8f9fa;"><i class="fa-solid fa-coffee me-1"></i> Istirahat</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted small py-3">09.15<br>10.15</td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#fef3c7;color:#d97706;"><i class="fa-solid fa-book-open me-1"></i>B. Indonesia</div></td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#fee2e2;color:#dc2626;"><i class="fa-solid fa-flask me-1"></i>IPA</div></td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#dcfce7;color:#16a34a;"><i class="fa-solid fa-square-root-variable me-1"></i>Matematika</div></td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#ede9fe;color:#4f46e5;"><i class="fa-solid fa-laptop-code me-1"></i>Informatika</div></td>
                                <td class="p-2 text-muted small" style="background:#f8f9fa;">—</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted small py-3">10.15<br>11.15</td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#e0f2fe;color:#0891b2;"><i class="fa-solid fa-globe me-1"></i>IPS</div></td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#fee2e2;color:#dc2626;"><i class="fa-solid fa-flask me-1"></i>IPA</div></td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#dcfce7;color:#16a34a;"><i class="fa-solid fa-square-root-variable me-1"></i>Matematika</div></td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#ede9fe;color:#4f46e5;"><i class="fa-solid fa-laptop-code me-1"></i>Informatika</div></td>
                                <td class="p-2 text-muted small" style="background:#f8f9fa;">—</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted small py-3">11.15<br>12.00</td>
                                <td colspan="5" class="text-muted small py-3" style="background:#f8f9fa;"><i class="fa-solid fa-mosque me-1"></i> Istirahat & Sholat</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted small py-3">12.00<br>13.00</td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#fef3c7;color:#d97706;"><i class="fa-solid fa-book-open me-1"></i>B. Indonesia</div></td>
                                <td class="p-2 text-muted small" style="background:#f8f9fa;">—</td>
                                <td class="p-2"><div class="jadwal-cell" style="background:#e0f2fe;color:#0891b2;"><i class="fa-solid fa-globe me-1"></i>IPS</div></td>
                                <td class="p-2 text-muted small" style="background:#f8f9fa;">—</td>
                                <td class="p-2 text-muted small" style="background:#f8f9fa;">—</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection