<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Pendidikan - LMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('lms_biologi/assets/style.css') }}">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom navbar-public fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#0d6efd" stroke-width="2.5">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
                <div class="logo-text">
                    <span class="fs-6 fw-bold text-dark mb-0">SMP Nama Sekolah</span>
                    <span class="text-muted" style="font-size: 0.75rem; font-weight: 500;">Portal Pendidikan</span>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 pt-3 pt-lg-0">
                    @if(Auth::user()->status === 'active')
                    <li class="nav-item"><a  class="nav-link {{ Request::is('Students/Course') ? 'active' : '' }}"  href="{{ route('students_course') }}">Courses</a></li>
                    <li class="nav-item"><a  class="nav-link {{ Request::is('Students/History') ? 'active' : '' }}" href="{{ route('students_history') }}">History</a></li>
                    @endif
                </ul>
                
                
                <div class="dropdown d-grid d-lg-flex mt-3 mt-lg-0 pb-3 pb-lg-0">
                    <a href="#" class="btn rounded-pill px-4 fw-bold d-flex align-items-center justify-content-center gap-2 dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-circle-user fs-5"></i> {{ auth()->user()->nama ?? 'User' }}
                    </a>
                    
                    <ul class="dropdown-menu dropdown-menu-end shadow mt-2 border-0 w-100" style="border-radius: 12px;">
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center justify-content-center gap-2 text-danger fw-semibold py-2">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')
    
    <nav class="mobile-bottom-nav">
        <ul>
            @if(Auth::user()->status === 'active')
            <li>
                <a href="{{ route('students_course') }}" class="{{ Request::is('Students/Course') ? 'active' : '' }}">
                <i class="fa-solid fa-table-cells-large fs-5"></i>
                <span>Course</span>
                </a>
            </li>
            <li>
                <a href="{{ route('students_history') }}" class="{{ Request::is('Students/History') ? 'active' : '' }}">
                <i class="fa-solid fa-clock-rotate-left fs-5"></i>
                <span>History</span>
                </a>
            </li>
            @endif
            <li class="dropup position-relative">
                <a href="#" class="d-flex flex-column align-items-center" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; color: #888; cursor: pointer;">
                    <i class="fa-solid fa-user fs-5"></i>
                    <span> {{ auth()->user()->nama ?? 'User' }}</span>
                </a>    
                
                <ul class="dropdown-menu shadow border-0 mb-2 text-center" style="border-radius: 12px; min-width: 120px; position: absolute; bottom: 100%; left: 50%;">
                    <li>
                        <!-- <a class="dropdown-item d-flex align-items-center justify-content-center gap-2 text-danger fw-semibold py-2" href="{{ route('logout') }}">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out
                        </a> -->
                        <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center justify-content-center gap-2 text-danger fw-semibold py-2">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
