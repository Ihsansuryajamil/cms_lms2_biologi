@extends('Layouts.app')

@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection

@section('content')
        <div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('guru_class_all') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="d-flex align-items-center gap-2">
                <h6 class="mb-0 fw-bold" style="font-size: 0.95rem;">
                    <i class="fa-solid fa-school text-primary"></i> Kelas: {{ $class->nama_kelas }} 
                    <span class="text-muted fw-normal">- {{ $class->tahun_ajar }}</span>
                </h6>
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
                    <form action="{{ route('guru_class_detail', $class->id) }}" method="GET" id="filterForm">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama atau email di kelas ini..." value="{{ request('search') }}" style="font-size: 0.85rem;">
                            </div>
                            <div class="col-md-3">
                                <select name="role" class="form-select form-select-sm" onchange="document.getElementById('filterForm').submit();" style="font-size: 0.85rem;">
                                    <option value="">Semua Role</option>
                                    <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>Guru</option>
                                    <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Siswa</option>
                                    <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-select form-select-sm" onchange="document.getElementById('filterForm').submit();" style="font-size: 0.85rem;">
                                    <option value="">Semua Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
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
                                <th style="width: 25%; padding: 8px 8px;">Nama Pengguna</th>
                                <!-- <th style="padding: 8px 8px;">Email</th> -->
                                <th style="padding: 8px 8px;">Role</th>
                                <th style="padding: 8px 8px;">Status</th>
                                <!-- <th class="text-center" style="width: 12%; padding: 8px 8px;">Tanggal Masuk</th> -->
                                <th class="text-center" style="width: 15%; padding: 8px 8px;">History</th>
                                <th class="text-center" style="width: 12%; padding: 8px 8px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td class="text-center" style="padding: 6px 4px;">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                    <td style="padding: 6px 8px;">
                                        <div class="d-flex align-items-center gap-2">
                                            <div>
                                                <div class="mb-0 fw-bold" style="font-size: 0.9rem;">{{ $user->nama }}</div>
                                                <small class="text-muted text-uppercase" style="font-size: 0.7rem;">
                                                    {{ $user->nis ?? $user->nip ?? '-' }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding: 6px 8px;"><small>{{ $user->email }}</small></td>
                                    <td style="padding: 6px 8px;">
                                        @if($user->role == 'teacher')
                                            <span class="badge bg-primary text-uppercase" style="font-size: 0.7rem;">{{ $user->role }}</span>
                                        @elseif($user->role == 'super_admin')
                                            <span class="badge bg-danger text-uppercase" style="font-size: 0.7rem;">Super Admin</span>
                                        @else
                                            <span class="badge bg-success text-uppercase" style="font-size: 0.7rem;">{{ $user->role }}</span>
                                        @endif
                                    </td>
                                    <!-- <td style="padding: 6px 8px;">
                                        @if($user->status == 'active')
                                            <span class="badge bg-success-subtle text-success border border-success" style="font-size: 0.7rem;">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary border border-secondary" style="font-size: 0.7rem;">Nonaktif</span>
                                        @endif
                                    </td> -->
                                    <!-- <td class="text-center" style="padding: 6px 8px;"><small class="text-muted">{{ $user->created_at->format('d M Y') }}</small></td> -->
                                    <td class="text-center" style="padding: 6px 8px;">
                                        <a href="{{ route('guru_user_history', $user->id) }}" class="btn btn-sm btn-outline-primary rounded-pill" style="font-size: 0.75rem; padding: 4px 10px;">
                                            <i class="fa-solid fa-clock me-1"></i> Pembelajaran
                                        </a>
                                    </td>
                                    <td class="text-center" style="padding: 6px 8px;">
                                        <a href="{{ route('guru_user_detail', $user->id) }}" class="btn btn-sm btn-outline-primary rounded-pill" style="font-size: 0.75rem; padding: 4px 10px;"><i class="fa-solid fa-eye me-1"></i> Profil</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fa-solid fa-user-slash mb-2 opacity-50" style="font-size: 1.8rem;"></i><br>
                                        <small>Belum ada siswa atau guru yang dimasukkan ke dalam kelas ini.</small>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($users->hasPages())
                    <div class="card-footer bg-white border-top py-2 d-flex justify-content-center" style="font-size: 0.85rem;">
                        {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                @endif
                
            </div>
        </div>
@endsection