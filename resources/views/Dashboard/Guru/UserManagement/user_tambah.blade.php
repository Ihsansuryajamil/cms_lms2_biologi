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
            <h5 class="mb-0 fw-bold">Tambah Pengguna Baru</h5>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button type="submit" form="createUserForm" class="btn btn-primary btn-sm rounded-pill px-4 py-2 fw-bold shadow-sm">
                <i class="fa-solid fa-save me-1"></i> Simpan Pengguna
            </button>
        </div>
    </div>

    <div class="content-area">
        @if ($errors->any())
            <div class="alert alert-danger mb-4 rounded-3 border-0">
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="createUserForm" action="{{ route('guru_user_store') }}" method="POST">
            @csrf
            
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4 p-md-5">
                            
                            <h6 class="fw-bold text-dark mb-4"><i class="fa-regular fa-id-card text-primary me-2"></i>Informasi Pribadi</h6>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                                    <input type="text" name="nama" id="inputNama" class="form-control border p-2.5 bg-light" placeholder="Masukkan nama lengkap..." value="{{ old('nama') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-secondary">NIS (Siswa) / NIP (Guru)</label>
                                    <input type="text" name="nis" class="form-control border p-2.5 bg-light" placeholder="Nomor Induk..." value="{{ old('nis') }}">
                                    <small class="text-muted" style="font-size: 0.7rem;">Gunakan ini untuk data NIS atau NIP.</small>
                                </div>
                            </div>

                            <hr class="my-5 opacity-25">

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h6 class="fw-bold text-dark mb-0"><i class="fa-solid fa-key text-warning me-2"></i>Kredensial Login</h6>
                                <button type="button" onclick="generateCredentials()" class="btn btn-sm btn-outline-warning text-dark fw-bold rounded-pill shadow-sm">
                                    <i class="fa-solid fa-wand-magic-sparkles me-1"></i> Generate Otomatis
                                </button>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-secondary">Alamat Email</label>
                                    <input type="email" name="email" id="inputEmail" class="form-control border p-2.5 bg-light" placeholder="email@sekolah.com" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-secondary">Password Akses</label>
                                    <input type="text" name="password" id="inputPassword" class="form-control border p-2.5 bg-light" placeholder="Minimal 6 karakter" required>
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
                                <select name="role" class="form-select border p-2.5 bg-light" required>
                                    <option value="" disabled selected>Pilih Peran...</option>
                                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Siswa / Murid</option>
                                    <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Guru / Instruktur</option>
                                    <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label class="form-label small fw-bold text-secondary">Status Akun</label>
                                <select name="status" class="form-select border p-2.5 bg-light" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif (Dapat Login)</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif (Suspend)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info border-0 rounded-4 shadow-sm" role="alert">
                        <h6 class="fw-bold"><i class="fa-solid fa-circle-info me-2"></i> Petunjuk</h6>
                        <p class="mb-0 small" style="line-height: 1.6;">
                            Anda dapat membuat akun dengan menekan tombol <strong>Generate Otomatis</strong>. Sistem akan membuatkan email dan password acak yang unik berdasarkan nama pengguna.
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function generateCredentials() {
            const inputNama = document.getElementById('inputNama').value;
            
            if (inputNama.trim() === '') {
                alert('Mohon isi field "Nama Lengkap" terlebih dahulu sebelum men-generate akun.');
                document.getElementById('inputNama').focus();
                return;
            }

            // 1. Ekstraksi Nama Depan Pintar (Skip kata tunggal 1 huruf seperti 'm')
            const words = inputNama.trim().split(/\s+/);
            let firstName = words[0];
            
            for (let i = 0; i < words.length; i++) {
                if (words[i].length > 1) {
                    firstName = words[i];
                    break;
                }
            }
            
            // Bersihkan nama dari karakter aneh dan ubah ke huruf kecil
            firstName = firstName.toLowerCase().replace(/[^a-z0-9]/g, '');

            // 2. Generate Email: nama depan + 3 angka acak + @LMSBiologi.com
            const randomNum = Math.floor(Math.random() * 900) + 100; // Menghasilkan 3 digit pas (100-999)
            const generatedEmail = firstName + randomNum + '@LMSBiologi.com';
            
            // 3. Generate Password: nama depan + jam menit detik waktu sekarang (HHMMSS)
            const now = new Date();
            const jam = String(now.getHours()).padStart(2, '0');
            const menit = String(now.getMinutes()).padStart(2, '0');
            const detik = String(now.getSeconds()).padStart(2, '0');
            const waktuSekarang = jam + menit + detik; // Hasil format: "152644"
            
            const generatedPassword = firstName + waktuSekarang;

            // Masukkan hasil otomatis ke dalam input box masing-masing
            document.getElementById('inputEmail').value = generatedEmail;
            document.getElementById('inputPassword').value = generatedPassword;
        }
    </script>
@endsection