@extends('Layouts.app')
@section('content')
    <style>
        .setting-tabs .nav-link {
            color: #6c757d;
            font-weight: 600;
            padding: 15px 20px;
            border-bottom: 3px solid transparent;
        }
        .setting-tabs .nav-link.active {
            color: #0d6efd;
            border-bottom: 3px solid #0d6efd;
        }
    </style>

    <div class="topbar d-flex justify-content-between align-items-center w-100">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('students_profil') }}" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
            <h5 class="mb-0 fw-bold">Pengaturan Profil</h5>
        </div>
    </div>

    <div class="content-area">
        <ul class="nav nav-tabs mb-4 setting-tabs" id="settingTabs">
            <li class="nav-item"><a class="nav-link active fw-bold" href="#" data-tab="profil" onclick="switchSettingTab(event, 'profil')"><i class="fa-solid fa-id-card"></i> Profil</a></li>
            <li class="nav-item"><a class="nav-link text-muted" href="#" data-tab="password" onclick="switchSettingTab(event, 'password')"><i class="fa-solid fa-key"></i> Kata Sandi</a></li>
        </ul>

        <div class="row">
            <div class="col-lg-8">
                <div id="profil-tab" class="tab-content">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold text-muted mb-4"><i class="fa-solid fa-id-card me-2"></i> Biodata Diri</h6>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label small fw-bold text-muted">NAMA LENGKAP</label>
                                    <span class="text-danger small fw-bold">WAJIB DIISI</span>
                                </div>
                                <input type="text" class="form-control" value="Budi Santoso">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">NOMOR INDUK SISWA (NIS)</label>
                                <input type="text" class="form-control" value="2024001" disabled>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">EMAIL <span class="badge bg-success text-white ms-1">TERVERIFIKASI</span></label>
                                <input type="email" class="form-control mb-1" value="budi.santoso@email.com">
                                <small class="text-muted"><i class="fa-solid fa-circle-info"></i> Kami tidak membagikan alamat email Anda kepada siapapun.</small>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">TEMPAT LAHIR</label>
                                    <input type="text" class="form-control" value="Jakarta">
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <label class="form-label small fw-bold text-muted">TANGGAL LAHIR</label>
                                    <input type="date" class="form-control" value="2009-05-15">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">JENIS KELAMIN</label>
                                    <select class="form-select">
                                        <option>Pilih Jenis Kelamin</option>
                                        <option selected>Laki-laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <label class="form-label small fw-bold text-muted">AGAMA</label>
                                    <select class="form-select">
                                        <option>Pilih Agama</option>
                                        <option selected>Islam</option>
                                        <option>Kristen</option>
                                        <option>Katholik</option>
                                        <option>Hindu</option>
                                        <option>Buddha</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">NOMOR TELEPON</label>
                                <input type="tel" class="form-control" placeholder="Contoh: 08123456789">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">TENTANG DIRI</label>
                                <textarea class="form-control" rows="3" placeholder="Tuliskan deskripsi singkat tentang diri Anda"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="password-tab" class="tab-content" style="display: none;">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h6 class="fw-bold text-muted mb-4"><i class="fa-solid fa-key me-2"></i> Ubah Kata Sandi</h6>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">KATA SANDI LAMA</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">KATA SANDI BARU</label>
                                <input type="password" class="form-control">
                                <small class="text-muted"><i class="fa-solid fa-circle-info"></i> Minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka</small>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">KONFIRMASI KATA SANDI BARU</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="alert alert-warning bg-warning bg-opacity-10 border-0 text-dark small py-3">
                                <i class="fa-solid fa-exclamation-triangle me-2"></i> Untuk keamanan akun Anda, gunakan kata sandi yang kuat dan jangan bagikan dengan siapapun.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-muted mb-4"><i class="fa-regular fa-image me-2"></i> Foto Profil</h6>
                        <div class="text-center mb-3">
                            <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=4f46e5&color=fff&size=150" alt="Foto Profil" class="rounded-circle" style="width: 120px; height: 120px;">
                        </div>
                        <input type="file" class="form-control form-control-sm mb-2" accept="image/*">
                        <small class="text-muted"><i class="fa-solid fa-circle-info"></i> Format: JPG, PNG (Max 2MB)</small>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-muted mb-4"><i class="fa-solid fa-location-dot me-2"></i> Alamat</h6>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">PROVINSI</label>
                            <select class="form-select form-select-sm">
                                <option>Pilih Provinsi</option>
                                <option selected>Jawa Barat</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">KOTA/KABUPATEN</label>
                            <select class="form-select form-select-sm">
                                <option>Pilih Kota/Kabupaten</option>
                                <option selected>Bandung</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">ALAMAT</label>
                            <textarea class="form-control form-control-sm" rows="3" placeholder="Jalan, No, RT/RW"></textarea>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary w-100 py-2 rounded-pill fw-bold shadow-sm mb-2"><i class="fa-solid fa-save"></i> Simpan Perubahan</button>
                <button class="btn btn-outline-secondary w-100 py-2 rounded-pill fw-bold"><i class="fa-solid fa-times"></i> Batalkan</button>
            </div>
        </div>
    </div>

    <script>
        function switchSettingTab(e, tabName) {
            e.preventDefault();
            const tabs = document.querySelectorAll('[id$="-tab"]');
            tabs.forEach(tab => tab.style.display = 'none');
            const navLinks = document.querySelectorAll('#settingTabs .nav-link');
            navLinks.forEach(link => {
                link.classList.remove('active', 'fw-bold');
                link.classList.add('text-muted');
            });
            const selectedTab = document.getElementById(tabName + '-tab');
            if (selectedTab) {
                selectedTab.style.display = 'block';
            }
            e.target.closest('.nav-link').classList.add('active', 'fw-bold');
            e.target.closest('.nav-link').classList.remove('text-muted');
        }
    </script>
@endsection