<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LMS</title>
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

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="alert alert-danger" style="color: red; margin-bottom: 15px; font-size: 14px;">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="input-group">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email (contoh@mail.com)" value="{{ old('email') }}" required>
                    </div>
                    
                    <div class="input-group">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="••••••••" required>
                        <i class="fa-solid fa-eye right-icon"></i>
                    </div>
                    
                    <div class="forgot-password">
                        <a href="#">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn-login">Login</button>
                    <div style="text-align: center; margin-top: 15px;">
                        <a href="{{ route('register.get') }}" style="text-decoration: none;">Belum punya akun? Daftar di sini</a>
                    </div>
                    <div style="text-align: center; margin-top: 15px;">
                        <a href="{{ route('homepage') }}" style="text-decoration: none;">Kembali</a>
                    </div>
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

</body>
</html>