<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $webSettings->nama_website }} | Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('lms_biologi/assets/style.css') }}">
</head>

<body class="dashboard-page text-sm">

    @yield('sidebar')
    <!-- ===== MAIN CONTENT ===== -->
    <div class="main-content bg-light">

    @yield('content')
    </div><!-- end main-content -->
    <nav class="mobile-bottom-nav">
        <ul> 
            <li>
                <a  href="{{ route('teachers_dashboard') }}" class="{{ Request::is('Teachers/Dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-home fs-5"></i>
                <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a  href="{{ route('guru_course_all') }}" class="{{ Request::is('Teachers/Materi') ? 'active' : '' }}">
                <i class="fa-solid fa-chalkboard-user fs-5"></i>
                <span>Materi</span>
                </a>
            </li>
            <li>
                <a  href="{{ route('guru_class_all') }}" class="{{ Request::is('Teachers/Kelas') ? 'active' : '' }}">
                <i class="fa-solid fa-chalkboard-user fs-5"></i>
                <span>Kelas</span>
                </a>
            </li>
            <li>
                <a  href="{{ route('guru_user_management') }}" class="{{ Request::is('Teachers/Users') ? 'active' : '' }}">
                <i class="fa-solid fa-users fs-5"></i>
                <span>User</span>
                </a>
            </li>
            <li>
                <a  href="{{ route('guru_pengaturan_website') }}" class="{{ Request::is('Teachers/Pengaturan') ? 'active' : '' }}">
                <i class="fa-solid fa-gear fs-5"></i>
                <span>Pengaturan</span>
                </a>
            </li>
        </ul>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lms_biologi/assets/sidebar-toggle.js') }}"></script>
</body>
</html>
