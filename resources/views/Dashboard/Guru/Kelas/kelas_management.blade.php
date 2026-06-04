@extends('Layouts.app')

@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection

@section('content')
        <div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-2">
                <h6 class="mb-0 fw-bold" style="font-size: 0.95rem;"><i class="fa-solid fa-school"></i> Manajemen Kelas</h6>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('guru_kelas_tambah') }}" class="btn btn-sm border-2 rounded-pill text-white" style="background: #0d6efd; font-size: 0.85rem; padding: 6px 16px;">
                    <i class="fa-solid fa-plus"></i> Tambah Kelas
                </a>
            </div>
        </div>

        <div class="content-area p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mb-4 rounded-3 border-0">
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body p-3">
                    <form action="{{ route('guru_class_all') }}" method="GET" id="filterForm">
                        <div class="row g-2">
                            <div class="col-md-7">
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama kelas atau deskripsi..." value="{{ request('search') }}" style="font-size: 0.85rem;">
                            </div>
                            <div class="col-md-3">
                                <select name="tahun_ajar" class="form-select form-select-sm" onchange="document.getElementById('filterForm').submit();" style="font-size: 0.85rem;">
                                    <option value="">Semua Tahun Ajar</option>
                                    @foreach($list_tahun_ajar as $ta)
                                        <option value="{{ $ta }}" {{ request('tahun_ajar') == $ta ? 'selected' : '' }}>{{ $ta }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-sm btn-warning border-2 rounded-pill text-black w-100" style="font-size: 0.85rem; padding: 6px 16px;"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
                        <thead class="bg-light">
                            <tr style="font-size: 0.8rem;">
                                <th class="text-center" style="width: 5%; padding: 8px 10px;">No</th>
                                <th style="width: 20%; padding: 8px 8px;">Nama Kelas</th>
                                <th style="width: 15%; padding: 8px 8px;">Guru Pengajar / Wali</th>
                                <th style="width: 15%; padding: 8px 8px;">Tahun Ajar</th>
                                <th class="text-center" style="width: 10%; padding: 8px 8px;">Total Murid</th>
                                <th class="text-center" style="width: 12%; padding: 8px 8px;">Tanggal Dibuat</th>
                                <th class="text-center" style="width: 20%; padding: 8px 8px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($classes as $kelas)
                                <tr>
                                    <td class="text-center" style="padding: 6px 4px;">{{ $loop->iteration + ($classes->currentPage() - 1) * $classes->perPage() }}</td>
                                    <td style="padding: 6px 8px;">
                                        <div>
                                            <div class="mb-0 fw-bold" style="font-size: 0.9rem; color: #0056b3;">{{ $kelas->nama_kelas }}</div>
                                            <small class="text-muted d-block text-truncate" style="max-width: 220px; font-size: 0.75rem;">
                                                {{ Str::words($kelas->deskripsi_kelas ?? 'Tidak ada deskripsi.', 20) }}
                                            </small>
                                        </div>
                                    </td>
                                    <td style="padding: 6px 8px;">
                                        <div class="fw-medium text-dark">{{ $kelas->guru->nama ?? '-' }}</div>
                                        <small class="text-muted" style="font-size: 0.7rem;">NIP: {{ $kelas->guru->nis ?? '-' }}</small>
                                    </td>
                                    <td style="padding: 6px 8px;"><span class="badge bg-light text-secondary border px-2.5 py-1.5">{{ $kelas->tahun_ajar }}</span></td>
                                    <td class="text-center style="padding: 6px 8px;">
                                        <span class="badge bg-success-subtle text-success border border-success px-2 py-1.5" style="font-size: 0.75rem;">
                                            <i class="fa-solid fa-graduation-cap me-1"></i> {{ $kelas->murid->count() }} Siswa
                                        </span>
                                    </td>
                                    <td class="text-center" style="padding: 6px 8px;">
                                        <small class="text-muted">{{ $kelas->created_at->format('d M Y') }}<br>{{ $kelas->created_at->format('H:i') }} WIB</small>
                                    </td>
                                    <td class="text-center" style="padding: 6px 8px;">
                                        <a href="{{ route('guru_class_detail', $kelas->id) }}" class="btn btn-sm btn-outline-primary rounded-pill" style="font-size: 0.75rem; padding: 4px 10px;">
                                            <i class="fa-solid fa-eye me-1"></i> Detail
                                        </a>
                                        <a href="{{ route('guru_class_update', $kelas->id) }}" class="btn btn-sm btn-outline-warning rounded-pill" style="font-size: 0.75rem; padding: 4px 10px;">
                                            <i class="fa-solid fa-pen me-1"></i> update
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fa-solid fa-folder-open mb-2 opacity-50" style="font-size: 2rem;"></i><br>
                                        <small>Tidak ada data kelas yang ditemukan dalam sistem.</small>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($classes->hasPages())
                    <div class="card-footer bg-white border-top py-2 d-flex justify-content-center" style="font-size: 0.85rem;">
                        {{ $classes->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                @endif
                
            </div>
        </div>
@endsection