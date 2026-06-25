@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
<!-- <div class="main-content"> -->
        <div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <h6 class="mb-0 fw-bold" style="font-size: 0.95rem;"><i class="fa-solid fa-user"></i> Pengaturan Profil</h6>
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
            <form action="{{ route('guru_profile_update') }}" method="POST">
            @csrf
            @method('PUT')
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Tab Profil -->
                        <div id="profil-tab" class="tab-content">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body p-4">
                                    <h6 class="fw-bold text-muted mb-4"><i class="fa-solid fa-id-card me-2"></i> Biodata Diri</h6>
                                    
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label small fw-bold text-secondary">NAMA LENGKAP</label>
                                            <span class="text-danger small fw-bold" style="font-size: 0.7rem;">WAJIB DIISI</span>
                                        </div>
                                        <input type="text" name="nama" class="form-control border p-2.5 bg-light fw-medium text-dark" value="{{ old('nama', $user->nama) }}" required>
                                    </div>

                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-secondary">ALAMAT EMAIL AKTIF</label>
                                            <input type="email" name="email" class="form-control border p-2.5 bg-light fw-medium text-dark" value="{{ old('email', $user->email) }}" required>
                                            <small class="text-muted d-block mt-1" style="font-size: 0.7rem;"><i class="fa-solid fa-circle-info me-1"></i> Digunakan sebagai kredensial utama sistem login Anda.</small>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-secondary">KATA SANDI / PASSWORD</label>
                                            <input type="text" name="xyz" class="form-control border p-2.5 bg-light fw-medium text-dark font-monospace" value="{{ old('xyz', $user->xyz) }}" required>
                                            <small class="text-muted d-block mt-1" style="font-size: 0.7rem;"><i class="fa-solid fa-circle-info me-1"></i> Password minimal terdiri dari 6 karakter unik.</small>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-secondary">JENIS KELAMIN</label>
                                            <select class="form-select border p-2.5 bg-light text-dark fw-medium">
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-secondary">NIS (Siswa) / NIP (Guru)</label>
                                            <input type="text" name="{{ $user->role === 'student' ? 'nis' : 'nip' }}" 
                                                class="form-control border p-2.5 bg-light fw-medium text-dark font-monospace" 
                                                value="{{ $user->role === 'student' ? old('nis', $user->nis) : old('nip', $user->nip) }}">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label small fw-bold text-secondary">NOMOR TELEPON / WHATSAPP</label>
                                        <input type="tel" name="no_telp" class="form-control border p-2.5 bg-light fw-medium text-dark" placeholder="Contoh: 08123456789" value="{{ old('no_telp', $user->no_telp) }}">
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-label small fw-bold text-secondary">ALAMAT DOMISILI LENGKAP</label>
                                        <textarea name="alamat" class="form-control border p-2.5 bg-light text-dark fw-medium" rows="4" placeholder="Tuliskan alamat lengkap tempat tinggal Anda saat ini...">{{ old('alamat', $user->alamat) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-4 border-bottom pb-3"><i class="fa-solid fa-shield-halved text-success me-2"></i> Hak Akses & Status Otoritas</h6>
                                
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary mb-1">Peran Pengguna (Role)</label>
                                    <input type="text" class="form-control border p-2.5 text-uppercase fw-bold text-muted bg-light" 
                                        value="{{ $user->role === 'super_admin' ? 'Super Admin' : ($user->role === 'teacher' ? 'Guru / Instruktur' : 'Siswa / Murid') }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary mb-1">Kelas Terdaftar</label>
                                    <input type="text" class="form-control border p-2.5 fw-bold text-muted bg-light" value="{{ $user->kelasJoined->nama_kelas ?? 'Tanpa Hubungan Kelas' }}" disabled>
                                </div>
                                
                                <div class="mb-1">
                                    <label class="form-label small fw-bold text-secondary mb-1">Status Keaktifan Akun</label>
                                    <span class="badge {{ $user->status === 'active' ? 'bg-success' : 'bg-danger' }} d-block w-100 py-2.5 fw-bold text-uppercase rounded-3" style="letter-spacing: 0.5px;">
                                        <i class="fa-solid {{ $user->status === 'active' ? 'fa-user-check' : 'fa-user-slash' }} me-1"></i> Akun {{ $user->status }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        

                        <button type="submit" class="btn btn-primary w-100 py-2.5 rounded-pill fw-bold shadow-sm mb-4">
                        <i class="fa-solid fa-floppy-disk me-1.5"></i> Simpan Perubahan Profil
                    </button>
                        
                    </div>
                </div>
            </form>
        </div>
    <!-- </div> -->
@endsection