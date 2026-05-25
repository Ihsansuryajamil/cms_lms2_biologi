<div class="sidebar">
        <div class="sidebar-header">
            <div class="school-logo">
                <i class="fa-solid fa-school text-primary mb-4"></i>
                <div>Sekolah<br>Nama Sekolah/ Kampus</div>
            </div>
        </div>
        
        <div class="user-profile">
            <img src="https://ui-avatars.com/api/?name=Staff+Komputer&background=e0e0e0&color=333" alt="User">
            <div>
                <div class="fw-bold">Staff Komputer</div>
                <div class="text-muted small">Super Admin</div>
            </div>
        </div>

        <div class="sidebar-actions">
            <div class="d-flex gap-2">
                <a href="{{ route('guru_notifikasi') }}" class="btn btn-outline-secondary d-flex justify-content-between align-items-center rounded-pill">
                    <span>Notifikasi </span>
                </a>
                <a href="{{ route('guru_profil') }}" class="btn btn-outline-secondary d-flex justify-content-between align-items-center rounded-pill bg-light text-dark">
                    <span>Profil </span>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger d-flex justify-content-between align-items-center rounded-pill bg-light text-danger w-100" style="border: 1px solid #dc3545; padding: 8px 15px;">
                        <span>Keluar</span>
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>

        <nav class="nav-menu">
            <a href="{{ route('teachers_dashboard') }}" class="nav-link {{ Request::is('Teachers/Dashboard') ? 'active' : '' }}"><i class="fa-solid fa-home"></i> Dashboard</a>
            
            <a href="{{ route('guru_course_all') }}" class="nav-link {{ Request::is('Teachers/Materi') ? 'active' : '' }}"><i class="fa-solid fa-book"></i> Materi</a>
            <a href="{{ route('guru_class_all') }}" class="nav-link {{ Request::is('Teachers/Kelas') ? 'active' : '' }}"><i class="fa-solid fa-chalkboard-user"></i> Kelas</a>
            <a href="{{ route('guru_user_management') }}" class="nav-link {{ Request::is('Teachers/Users') ? 'active' : '' }}"><i class="fa-solid fa-users"></i> Manajemen User</a>
            <a href="{{ route('guru_pengaturan_website') }}" class="nav-link {{ Request::is('Teachers/Pengaturan') ? 'active' : '' }}"><i class="fa-solid fa-gear"></i> Pengaturan Website</a>
        </nav>

        
    </div>