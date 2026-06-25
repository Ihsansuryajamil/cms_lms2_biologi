@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
<div class="topbar d-flex justify-content-between align-items-center w-100 mb-4">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('guru_user_management') }}" class="btn btn-outline-secondary rounded-pill">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
           <h6 class="mb-0 fw-bold" style="font-size: 0.95rem;">Detail Pengguna</h6>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button type="submit" form="updateUserForm" class="btn btn-primary btn-sm rounded-pill px-4 py-2 fw-bold shadow-sm">
                <i class="fa-solid fa-save me-1"></i> Simpan Perubahan
            </button>
        </div>
    </div>

    <div class="content-area">
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

        <form id="updateUserForm" action="{{ route('guru_user_update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <div class="col-lg-8">
                    
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4 p-md-5">
                            
                            <div class="d-flex flex-column flex-md-row align-items-center gap-4 mb-5 border-bottom pb-4">
                                @if($user->avatar)
                                    <img src="{{ asset('image/avatar/' . $user->avatar) }}" alt="Avatar" class="rounded-circle object-fit-cover shadow-sm" style="width: 90px; height: 90px;">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=16a34a&color=fff&size=100" alt="Avatar" class="rounded-circle shadow-sm" style="width: 90px; height: 90px;">
                                @endif
                                
                                <div class="text-center text-md-start">
                                    <h4 class="fw-bold mb-1">{{ $user->nama }}</h4>
                                    <p class="text-muted mb-0">{{ $user->email }}</p>
                                    <div class="mt-2">
                                        <span class="badge bg-light text-secondary border px-3 py-2 text-uppercase" style="letter-spacing: 0.5px;">
                                            Terdaftar sejak {{ $user->created_at->format('d F Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <h6 class="fw-bold text-dark mb-4"><i class="fa-regular fa-id-card text-primary me-2"></i>Informasi Pribadi</h6>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control border p-2.5 bg-light" value="{{ old('nama', $user->nama) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-secondary">Alamat Email</label>
                                    <input type="email" name="email" class="form-control border p-2.5 bg-light" value="{{ old('email', $user->email) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-secondary">NIS (Siswa) / NIP (Guru)</label>
                                    <input type="text" name="{{ $user->role == 'guru' ? 'nip' : 'nis' }}" class="form-control border p-2.5 bg-light" value="{{ old('nis', $user->nis) ?? old('nip', $user->nip) }}">
                                    <small class="text-muted" style="font-size: 0.7rem;">Hanya isi yang sesuai dengan peran pengguna.</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-secondary">No. Telepon</label>
                                    <input type="text" name="no_telp" class="form-control border p-2.5 bg-light" value="{{ old('no_telp', $user->no_telp) }}">
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-secondary">Pasword</label>
                                    <input type="text" name="xyz" class="form-control border p-2.5 bg-light" value="{{ old('xyz', $user->xyz) }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-secondary">Alamat Domisili</label>
                                    <textarea name="alamat" class="form-control border p-2.5 bg-light" rows="4">{{ old('alamat', $user->alamat) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-4 border-bottom pb-3"><i class="fa-solid fa-shield-halved text-success me-2"></i> Hak Akses & Status</h6>
                            
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-secondary">Peran Pengguna (Role)</label>
                                <select name="role" class="form-select border p-2.5 bg-light">
                                    <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>Siswa / Murid</option>
                                    <option value="teacher" {{ old('role', $user->role) == 'teacher' ? 'selected' : '' }}>Guru / Instruktur</option>
                                    <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-secondary">Kelas Terdaftar</label>
                                <select name="kelas_id" class="form-select border p-2.5 bg-light">
                                    <option value="" {{ old('kelas_id', $user->kelas_id) == null ? 'selected' : '' }}>Belum Memiliki Kelas (Tanpa Kelas)</option>
                                    @foreach($classes as $kelas)
                                        <option value="{{ $kelas->id }}" {{ old('kelas_id', $user->kelas_id) == $kelas->id ? 'selected' : '' }}>
                                            {{ $kelas->nama_kelas }} - {{ $kelas->tahun_ajar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold text-secondary">Status Akun</label>
                                <select name="status" class="form-select border p-2.5 bg-light">
                                    <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Aktif (Dapat Login)</option>
                                    <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Nonaktif (Suspend / Diblokir)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm rounded-4 bg-light mb-4">
                        <div class="card-body p-4 text-muted small">
                            <h6 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-clock-rotate-left text-secondary me-2"></i> Log Sistem</h6>
                            <p class="mb-1"><strong>Terakhir Update:</strong></p>
                            <p class="mb-3">{{ $user->updated_at->format('d M Y - H:i:s') }} WIB</p>
                            
                            <p class="mb-1"><strong>Dibuat Pada:</strong></p>
                            <p class="mb-0">{{ $user->created_at->format('d M Y - H:i:s') }} WIB</p>
                        </div>
                    </div>
                    
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-4 text-muted small">
                            <h6 class="fw-bold mb-3 text-dark">
                                <i class="fa-solid fa-trash text-secondary me-2"></i> Hapus Akun
                            </h6>

                            @if($user->id !== Auth::id())
                                <p class="mb-3 text-muted" style="font-size: 0.75rem; line-height: 1.5;">
                                    Menghapus akun ini secara permanen dari sistem basis data LMS.
                                </p>
                                <button type="button" class="btn btn-danger btn-sm rounded-pill w-100 py-2 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#deleteUserModal">
                                    <i class="fa-solid fa-trash me-1"></i> Hapus Akun User Permanen
                                </button>
                            @else
                                <div class="alert alert-warning border-0 rounded-3 m-0 p-2.5" role="alert" style="background-color: #fff3cd; color: #664d03;">
                                    <small class="d-flex gap-2 align-items-start" style="font-size: 0.75rem; line-height: 1.4;">
                                        <i class="fa-solid fa-user-shield mt-0.5 fs-6"></i>
                                        <span>Anda sedang menggunakan akun ini. Anda tidak diizinkan menghapus akun Anda sendiri demi keamanan sistem.</span>
                                    </small>
                                </div>
                            @endif
                        </div>
                    </div>
                    

                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="deleteUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
            <div class="modal-body text-center p-5">
                <div class="text-danger mb-4">
                    <i class="fa-solid fa-circle-exclamation" style="font-size: 4rem;"></i>
                </div>
                <h5 class="fw-bold text-dark mb-3">Konfirmasi Hapus Akun User</h5>
                <p class="text-muted px-2 mb-4" style="line-height: 1.6;">
                    Apakah kamu yakin untuk menghapus akun user <strong class="text-dark">"{{ $user->nama }}"</strong> ini? Tindakan ini tidak dapat dibatalkan.
                </p>
                
                <form action="{{ route('guru_user_destroy', $user->id) }}" method="POST" class="d-flex gap-3 justify-content-center">
                    @csrf
                    @method('DELETE')
                    
                    <button type="button" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-secondary flex-grow-1 border" data-bs-dismiss="modal">
                        Tidak, Batalkan
                    </button>
                    
                    <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 fw-bold text-white flex-grow-1 shadow-sm">
                        Ya, Hapus Permanen
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection