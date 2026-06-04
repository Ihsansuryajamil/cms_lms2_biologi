<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kesalahan Server - LMS Biologi</title>
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
                                <span class="badge bg-danger-subtle text-danger py-2 px-3 rounded-pill mb-3">Error 500</span>
                                <h1 class="error-code mb-1">500</h1>
                                <h2 class="error-title mb-3">Kesalahan Server Internal</h2>
                            </div>
                            <div class="text-md-end">
                                <div class="error-icon text-danger" style="background: rgba(220, 38, 38, 0.08); color: #dc2626;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                            </div>
                        </div>

                        <p class="error-text mb-4">
                            Terjadi kesalahan pada server. Tim teknis kami sedang memperbaiki masalah ini. Silakan coba lagi beberapa saat lagi.
                        </p>

                        <div class="alert alert-info mb-4" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            Jika diperlukan, hubungi administrator untuk mempercepat penanganan.
                        </div>

                        <div class="d-flex flex-wrap gap-3 mb-4">
                            <button onclick="window.location.reload()" class="btn btn-danger btn-lg">Coba Lagi</button>
                            <a href="{{ route('homepage') }}" class="btn btn-outline-secondary btn-lg">Beranda</a>
                        </div>

                        <hr>

                        <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                            <div class="text-muted small">Kalau error masih muncul, silakan laporkan kepada tim IT dengan screenshot halaman ini.</div>
                            <span class="text-muted small">Error ID: SRV-500-000000000000</span>
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