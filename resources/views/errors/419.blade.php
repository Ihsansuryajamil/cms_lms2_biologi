<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesi Kadaluarsa - LMS Biologi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('lms_biologi/assets/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="dashboard-page error-page">
    <div class="container-fluid py-2">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card shadow-sm rounded-4 border-0">
                    <div class="card-body p-5">
                        <div class="d-flex flex-column flex-md-row error-header gap-4">
                            <div>
                                <span class="badge bg-warning-subtle text-warning py-2 px-3 rounded-pill mb-3">Error 419</span>
                                <h1 class="error-code mb-1">419</h1>
                                <h2 class="error-title mb-3">Sesi Kadaluarsa</h2>
                            </div>
                            <div class="text-md-end">
                                <div class="error-icon text-warning" style="background: rgba(255, 193, 7, 0.12); color: #d97706;">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                        </div>

                        <p class="error-text mb-4">
                            Sesi Anda telah berakhir untuk alasan keamanan. Silakan masuk kembali untuk melanjutkan ke dashboard atau tugas Anda.
                        </p>

                        <div class="d-flex flex-wrap gap-3 mb-4">
                            <a href="{{ route('login') }}" class="btn btn-warning btn-lg">Masuk Kembali</a>
                            <button onclick="window.location.reload()" class="btn btn-outline-secondary btn-lg">Muat Ulang</button>
                        </div>

                        <hr>

                        <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                            <div class="text-muted small">Bersihkan cache browser jika Anda masih melihat halaman yang sama setelah login ulang.</div>
                            <a href="{{ route('homepage') }}" class="text-decoration-none">Kembali ke Beranda <i class="fa-solid fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>