@extends('Layouts.app')

@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection

@section('content')
        <div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-2">
                <a href="javascript:history.back()" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <h6 class="mb-0 fw-bold" style="font-size: 0.95rem;"><i class="fa-solid fa-users"></i> Riwayat Pembelajaran</h6>
            </div>
            <div class="d-flex align-items-center gap-2"> 
                <span class="badge bg-primary rounded-pill px-3 py-2 fw-bold">
                    <i class="fa-solid fa-graduation-cap me-1"></i> Siswa: {{ $student->nama }}
                </span>
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
                    <form action="{{ route('guru_user_history', $student->id) }}" method="GET" id="filterForm">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <!-- <label class="form-label small fw-600">Mata Pelajaran ( Course )</label> -->
                                <select class="form-select form-select-sm" name="course" onchange="this.form.submit()">
                                    <option value="">Semua Mata Pelajaran ( Course )</option>
                                    @foreach($coursesList as $c)
                                        <option value="{{ $c->nama_course }}" {{ request('course') == $c->nama_course ? 'selected' : '' }}>
                                            {{ $c->nama_course }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <!-- <label class="form-label small fw-600">Jenis Tugas</label> -->
                                <select class="form-select form-select-sm" name="activity_type" onchange="this.form.submit()">
                                    <option value="">Semua Jenis</option>
                                    <option value="materi" {{ request('activity_type') == 'materi' ? 'selected' : '' }}>Materi</option>
                                    <option value="tugas" {{ request('activity_type') == 'tugas' ? 'selected' : '' }}>Tugas</option>
                                    <option value="quiz" {{ request('activity_type') == 'quiz' ? 'selected' : '' }}>Quiz / Ujian</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <!-- <label class="form-label small fw-600">Urutkan Tanggal</label> -->
                                <select class="form-select form-select-sm" name="sort_date" onchange="this.form.submit()">
                                    <option value="newest" {{ request('sort_date') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="oldest" {{ request('sort_date') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-sm btn-warning border-2 rounded-pill text-black w-100" style="font-size: 0.85rem; padding: 6px 16px;"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="filter-section">
                <form action="{{ route('guru_user_history', $student->id) }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-600">Mata Pelajaran ( Course )</label>
                            <select class="form-select" name="course" onchange="this.form.submit()">
                                <option value="">Semua Course</option>
                                @foreach($coursesList as $c)
                                    <option value="{{ $c->nama_course }}" {{ request('course') == $c->nama_course ? 'selected' : '' }}>
                                        {{ $c->nama_course }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-600">Jenis Tugas</label>
                            <select class="form-select" name="activity_type" onchange="this.form.submit()">
                                <option value="">Semua Jenis</option>
                                <option value="materi" {{ request('activity_type') == 'materi' ? 'selected' : '' }}>Materi</option>
                                <option value="tugas" {{ request('activity_type') == 'tugas' ? 'selected' : '' }}>Tugas</option>
                                <option value="quiz" {{ request('activity_type') == 'quiz' ? 'selected' : '' }}>Quiz / Ujian</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-600">Urutkan Tanggal</label>
                            <select class="form-select" name="sort_date" onchange="this.form.submit()">
                                <option value="newest" {{ request('sort_date') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="oldest" {{ request('sort_date') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div> -->

            <!-- History Table -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary small text-uppercase">
                            <tr>
                                <th width="60" class="text-center fw-bold">No</th>
                                
                                <th width="140">Jenis Aktivitas</th>
                                <th>Mata Pelajaran (Course)</th>
                                <th>Judul Modul</th>
                                <th width="180" class="text-center">Nilai / Respon</th>
                                <th width="120">Pengerjaan</th>
                                <th width="130" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($historyCollection as $index => $item)
                                <tr>
                                    <td class="text-center fw-semibold text-muted">
                                        {{ ($historyCollection->currentPage() - 1) * $historyCollection->perPage() + $loop->iteration }}
                                    </td>
                                    
                                    
                                    <td>
                                        {{-- LOGIKA BADGE BERDASARKAN JENIS AKTIVITAS --}}
                                        @if($item->activity_type === 'materi')
                                            <span class="badge bg-primary px-2.5 py-1.5 rounded-3 w-100">
                                                <!-- <i class="fa-solid fa-book-open me-1"></i>  -->
                                                Materi</span>
                                        @elseif($item->activity_type === 'tugas')
                                            <span class="badge bg-warning text-dark px-2.5 py-1.5 rounded-3 w-100">
                                                <!-- <i class="fa-solid fa-tasks me-1"></i> -->
                                                 Tugas</span>
                                        @elseif($item->activity_type === 'quiz_pg')
                                            <span class="badge bg-danger px-2.5 py-1.5 rounded-3 w-100">
                                                <!-- <i class="fa-solid fa-list-check me-1"></i> -->
                                                 Kuis PG</span>
                                        @elseif($item->activity_type === 'quiz_essay')
                                            <span class="badge bg-danger px-2.5 py-1.5 rounded-3 w-100">
                                                <!-- <i class="fa-solid fa-pen-to-square me-1"></i> -->
                                                 Kuis Essay</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- <span class="text-secondary small fw-medium">{{ $item->subTopic->topic->course->nama_course }}</span> -->
                                         <strong class="text-dark d-block mb-0">{{ $item->subTopic->topic->course->nama_course }}</strong>
                                    </td>
                                    <td>
                                        
                                        <span class="text-secondary small fw-medium">{{ $item->subTopic->judul }}</span>
                                    </td>
                                    <td class="text-center">
                                        {{-- LOGIKA FORMAT INDIKATOR SKOR & EVALUASI --}}
                                        @if($item->activity_type === 'materi')
                                            @if($item->status === 'sangat_mengerti')
                                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3">Sangat Paham</span>
                                            @elseif($item->status === 'sudah_mengerti')
                                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3">Cukup Paham</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3">Belum Paham</span>
                                            @endif
                                        @elseif($item->activity_type === 'tugas')
                                            @if($item->status === 'terkirim')
                                                <small class="text-warning fw-bold font-monospace bg-warning-subtle px-2 py-1 rounded border border-warning-subtle" style="font-size: 0.75rem;">Belum dinilai</small>
                                            @else
                                                <span class="fs-5 fw-bold text-success font-monospace">{{ $item->nilai }}</span><span class="text-muted small">/100</span>
                                            @endif
                                        @else
                                            {{-- JIKA BERUPA KUIS --}}
                                            @if($item->status === 'menunggu_dinilai')
                                                <small class="text-warning fw-bold font-monospace bg-warning-subtle px-2 py-1 rounded border border-warning-subtle" style="font-size: 0.75rem;">Belum dinilai</small>
                                            @else
                                                <span class="fs-5 fw-bold text-primary font-monospace">{{ number_format($item->total_nilai, 0) }}</span><span class="text-muted small">/100</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-muted small">
                                            <i class="fa-regular fa-clock me-1"></i>{{ \Carbon\Carbon::parse($item->history_date)->translatedFormat('d M Y') }} <br>{{ \Carbon\Carbon::parse($item->history_date)->translatedFormat('H:i') }} WIB
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        {{-- TOMBOL MENUJU DETAIL SUB-TOPIK --}}
                                        <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold" style="font-size: 0.75rem;">
                                            <i class="fa-solid fa-arrow-right-to-bracket me-1"></i> Buka
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <div class="mb-2"><i class="fa-solid fa-folder-open fs-1 opacity-25"></i></div>
                                        <span class="small">Belum ada riwayat pengerjaan atau aktivitas belajar yang tercatat pada akun Anda.</span>
                                    </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($historyCollection->hasPages())
                    <div class="card-footer bg-white border-top py-3 d-flex justify-content-center" style="font-size: 0.85rem;">
                        {{ $historyCollection->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
@endsection