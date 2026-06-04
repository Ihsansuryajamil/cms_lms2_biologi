<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ukuran File Terlalu Besar - LMS</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="{{ asset('lms_biologi/assets/style.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { background-color: #f8f9fa; }
    </style>
</head>
<body class="dashboard-page error-page">
    <div class="container-fluid py-2">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-md-10 col-lg-8">
                
                <div class="card shadow-sm rounded-4 border-0">
                    <div class="card-body p-4 p-md-5">
                        
                        <div class="d-flex align-items-center mb-4">
                            <h1 class="error-title mb-0 me-3" style="font-size: 5rem; font-weight: 800; color: #1a73e8;">413</h1>
                            <div class="border-start border-2 ps-3">
                                <h3 class="fw-bold mb-1 text-dark">Ukuran File Terlalu Besar</h3>
                                <div class="error-icon text-danger mt-1 fs-4">
                                    <i class="fa-solid fa-file-arrow-up"></i>
                                </div>
                            </div>
                        </div>

                        <p class="error-text mb-4 text-secondary" style="font-size: 1.1rem; line-height: 1.6;">
                            Maaf, berkas yang Anda coba unggah melebihi batas maksimal kapasitas yang diizinkan oleh sistem. Silakan kompres atau perkecil ukuran berkas Anda, lalu coba unggah kembali.
                        </p>

                        <div class="d-flex flex-wrap gap-3 mb-4">
                            <button onclick="history.back()" class="btn btn-primary btn-lg rounded-pill px-4 fw-bold shadow-sm">
                                <i class="fa-solid fa-arrow-rotate-left me-1"></i> Kembali Sebelumnya
                            </button>
                            <a href="{{ route('homepage') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4 fw-bold">
                                Beranda
                            </a>
                        </div>

                        <hr class="opacity-25">

                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                            <div class="text-muted small"><i class="fa-solid fa-circle-info me-1"></i> Jika Anda terus mengalami kendala ini, silakan hubungi administrator LMS.</div>
                            <a href="{{ route('login') }}" class="text-decoration-none fw-medium small">Masuk ke Sistem <i class="fa-solid fa-arrow-right ms-1"></i></a>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>