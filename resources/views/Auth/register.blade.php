<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('lms_biologi/assets/style.css') }}">
</head>
<body class="login-page">

    <div class="login-wrapper">
        <div class="login-box">
            <!-- Sisi Kiri: Form -->
            <div class="login-form-container">
                <!-- <div class="login-header">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0056b3" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    <h2>Selamat datang di LMS<br>Nama Sekolah/ Kampus</h2>
                    <p>Sistem manajemen pembelajaran dengan<br>teknologi unggulan terbaik.</p>
                </div> -->

                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3" style="font-size: 0.85rem; margin-bottom: 25px; border: none; background-color: #f8d7da; color: #842029;">
                            <ul class="mb-0 m-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="input-group-login" style="margin-bottom: 12px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Nama Lengkap</label>
                        <input type="text" name="nama" id="inputNama" placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc;">
                    </div>

                    <div class="input-group-login" style="margin-bottom: 12px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">NIS / NIM</label>
                        <input type="text" name="nis" id="inputNis" placeholder="Masukkan Nomor Induk" value="{{ old('nis') }}" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc;">
                    </div>

                    <div style="margin-bottom: 12px;">
                        <button type="button" onclick="generateCredentials()" class="btn btn-sm w-100 fw-bold shadow-sm" class="btn btn-primary btn-sm rounded-pill px-4 py-2 fw-bold shadow-sm" style="background-color: #ffc107; color: #212529; border: none; border-radius: 12px; padding: 12px 0; font-size: 0.95rem; transition: all 0.2s;">
                            <i class="fa-solid fa-wand-magic-sparkles me-2"></i> Generate Akun Anda
                        </button>
                    </div>

                    <div class="input-group-login" style="margin-bottom: 12px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #666;">Email Akses <span class="text-danger small" style="font-size: 0.75rem; font-weight: normal;">(Hasil Otomatis)</span></label>
                        <input type="email" name="email" id="inputEmail" placeholder="Klik tombol generate di atas..." readonly required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ddd; background-color: #e9ecef; cursor: not-allowed; color: #495057;">
                    </div>

                    <div class="input-group-login" style="margin-bottom: 12px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #666;">Password Akses <span class="text-danger small" style="font-size: 0.75rem; font-weight: normal;">(Hasil Otomatis)</span></label>
                        <input type="text" name="password" id="inputPassword" placeholder="Klik tombol generate di atas..." readonly required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ddd; background-color: #e9ecef; cursor: not-allowed; color: #495057;">
                    </div>

                    <button type="submit" class="btn-login" style="padding: 14px 0; font-size: 1rem; font-weight: 700; border-radius: 8px;">Simpan & Daftar Akun</button>
                </form>
            </div>

            <!-- Sisi Kanan: Gambar -->
            <div class="login-image-container">
                <div class="login-image-overlay">
                    <h3>LMS Sekolah<br>Nama Sekolah/ Kampus </h3>
                    <p>Kemudahan Akses Materi Belajar &<br>Pembelajaran Online</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="mobile-bottom-nav">
        <ul>
            <li>
                <a href="{{ route('homepage') }}">
                <i class="fa-solid fa-house fs-5"></i>
                <span>Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('homepage') }}#courses-container">
                <i class="fa-solid fa-table-cells-large fs-5"></i>
                <span>Course</span>
                </a>
            </li>
            <li>
                <a href="{{ route('history') }}">
                <i class="fa-solid fa-clock-rotate-left fs-5"></i>
                <span>History</span>
                </a>
            </li>
            <li>
                <a href="{{ route('login') }}" class="active">
                <i class="fa-solid fa-circle-user fs-5"></i>
                <span>Login</span>
                </a>
            </li>
        </ul>
    </nav>
<script>
        function generateCredentials() {
            const inputNama = document.getElementById('inputNama').value;
            const inputNis = document.getElementById('inputNis').value;
            
            if (inputNama.trim() === '' || inputNis.trim() === '') {
                alert('Mohon isi field "Nama Lengkap" dan "NIS / NIM" terlebih dahulu sebelum melakukan generate.');
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
            
            // Bersihkan nama dari spasi/karakter aneh dan ubah ke huruf kecil
            firstName = firstName.toLowerCase().replace(/[^a-z0-9]/g, '');

            // 2. Generate Email: nama depan + 3 angka acak + @LMSBiologi.com
            const randomNum = Math.floor(Math.random() * 900) + 100; 
            const generatedEmail = firstName + randomNum + '@LMSBiologi.com';
            
            // 3. Generate Password: nama depan + jam menit detik waktu saat ini (HHMMSS)
            const now = new Date();
            const jam = String(now.getHours()).padStart(2, '0');
            const menit = String(now.getMinutes()).padStart(2, '0');
            const detik = String(now.getSeconds()).padStart(2, '0');
            const waktuSekarang = jam + menit + detik; 
            
            const generatedPassword = firstName + waktuSekarang;

            // Suntikkan hasil otomatis ke dalam box input HTML
            document.getElementById('inputEmail').value = generatedEmail;
            document.getElementById('inputPassword').value = generatedPassword;
        }
    </script>
</body>
</html>