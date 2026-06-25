@extends('Layouts.appSiswa')
@section('content')

    <!-- <header class="history-header">
        <div class="container">
            <h1><i class="fa-solid fa-history me-3"></i>Update Profile</h1>
            <p class="mb-0 text-light">Lihat semua riwayat pengerjaan tugas, nilai, dan pencapaian Anda</p>
        </div>
    </header> -->
    <header class="quiz-header">
        <div class="container">
            @if(Auth::user()->status === 'active')
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
                <form action="{{ route('students_profile_update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-lg-8">
                        <div id="profil-tab" class="tab-content">
                            <div class="card border-0 shadow-sm mb-4 bg-white rounded-4">
                                <div class="card-body p-4 p-md-5">
                                    <h6 class="fw-bold text-muted mb-4"><i class="fa-solid fa-id-card me-2 text-primary"></i> Biodata Diri Siswa</h6>
                                    
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
                                            <small class="text-muted d-block mt-1" style="font-size: 0.7rem;"><i class="fa-solid fa-circle-info me-1"></i> Digunakan sebagai identitas utama login akun Anda.</small>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-secondary">KATA SANDI / PASSWORD</label>
                                            <input type="text" name="xyz" class="form-control border p-2.5 bg-light fw-medium text-dark font-monospace" value="{{ old('xyz', $user->xyz) }}" required>
                                            <small class="text-muted d-block mt-1" style="font-size: 0.7rem;"><i class="fa-solid fa-lock me-1"></i> Rahasiakan password Anda dari orang lain.</small>
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
                                            <label class="form-label small fw-bold text-secondary">NOMOR INDUK SISWA (NIS)</label>
                                            <input type="text" name="nis" class="form-control border p-2.5 bg-light fw-medium text-dark font-monospace" value="{{ old('nis', $user->nis) }}">
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

                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm mb-4 bg-white rounded-4">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-4 border-bottom pb-3"><i class="fa-solid fa-shield-halved text-success me-2"></i> Status Otoritas Akun</h6>
                                
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary mb-1">Peran Pengguna (Role)</label>
                                    <input type="text" class="form-control border p-2.5 text-uppercase fw-bold text-muted bg-light" value="Siswa / Murid" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary mb-1">Kelas Terdaftar</label>
                                    <input type="text" class="form-control border p-2.5 fw-bold text-muted bg-light" value="{{ $user->kelasJoined->nama_kelas ?? 'Tanpa Hubungan Kelas' }}" disabled>
                                </div>
                                
                                <div class="mb-1">
                                    <label class="form-label small fw-bold text-secondary mb-1">Status Keaktifan</label>
                                    <span class="badge {{ $user->status === 'active' ? 'bg-success' : 'bg-danger' }} d-block w-100 py-2.5 fw-bold text-uppercase rounded-3" style="letter-spacing: 0.5px;">
                                        <i class="fa-solid {{ $user->status === 'active' ? 'fa-user-check' : 'fa-user-slash' }} me-1"></i> Akun Aktif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 py-2.5 rounded-pill fw-bold shadow-sm mb-4">
                            <i class="fa-solid fa-floppy-disk me-1.5"></i> Simpan Perubahan Profil
                        </button>
                    </div>
                </div>
            </form>
            </div>
            @else
            <div class="row justify-content-center py-4">
                    <div class="col-md-8 text-center">
                        <div class="card border-0 shadow-sm p-5 rounded-4 bg-white">
                            <div class="card-body">
                                <div class="text-danger mb-4">
                                    <i class="fa-solid fa-user-lock" style="font-size: 4.5rem; opacity: 0.8;"></i>
                                </div>
                                <h4 class="fw-bold text-dark mb-2">Akses Profil Terkunci!</h4>
                                <p class="text-muted small mb-4 mx-auto" style="max-width: 500px; line-height: 1.6;">
                                    Status akun Anda saat ini masih <strong class="text-danger">Nonaktif (Inactive)</strong>. Anda tidak diperbolehkan melihat isi bab materi, sub-topik, tugas, kuis, maupun video penunjang di dalam kelas ini.
                                </p>
                                <div class="alert alert-warning border-0 rounded-3 small p-3 mb-0 text-start d-flex gap-3 align-items-center" style="background-color: #fff3cd; color: #664d03;">
                                    <i class="fa-solid fa-circle-info fs-5 text-warning flex-shrink-0"></i>
                                    <span><strong>Petunjuk:</strong> Silakan hubungi Guru Pengajar atau pihak Administrator untuk mengaktifkan status kepesertaan Anda agar kunci materi ini terbuka otomatis.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </header>

    
@endsection
