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
                <div class="login-header">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0056b3" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    <h2>Selamat datang di LMS<br>Nama Sekolah/ Kampus</h2>
                    <p>Sistem manajemen pembelajaran dengan<br>teknologi unggulan terbaik.</p>
                </div>

                <form action="superAdmin/dashboard.html">
                    <div class="input-group">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="0000000002" required>
                    </div>
                    <div class="input-group">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="••••••••" required>
                        <i class="fa-solid fa-eye right-icon"></i>
                    </div>
                    
                    <div class="forgot-password">
                        <a href="#">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn-login">Login</button>
                    
                    <!-- <a href="superAdmin/dashboard.html" class="btn-outline-login"><i class="fa-solid fa-chalkboard-user"></i> Ke Halaman Guru</a>
                    <a href="admin/dashboard_siswa.html" class="btn-outline-login"><i class="fa-solid fa-user-graduate"></i> Ke Halaman Siswa</a> -->
                    <!-- <button type="button" class="btn-outline-login"><img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" width="16"> Login With Google</button> -->
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

</body>
</html>