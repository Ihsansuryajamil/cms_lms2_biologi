<!-- ===== SIDEBAR ===== -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="school-logo">
                <i class="fa-solid fa-school text-primary mb-4"></i>
                <div>Sekolah<br>Nama Sekolah/ Kampus</div>
            </div>
        </div>

        <div class="user-profile">
            <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=4f46e5&color=fff" alt="User">
            <div>
                <div class="fw-bold">Budi Santoso</div>
                <div class="text-muted small">Siswa • IX-B</div>
            </div>
        </div>
        <div class="sidebar-actions">
            <div class="d-flex gap-2">
                <a href="{{ route('students_notifikasi') }}" class="btn btn-outline-secondary d-flex justify-content-between align-items-center rounded-pill">
                    <span>Notifikasi </span>
                </a>
                <a href="{{ route('students_profil') }}" class="btn btn-outline-secondary d-flex justify-content-between align-items-center rounded-pill bg-light text-dark">
                    <span>Profil </span>
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-danger d-flex justify-content-between align-items-center rounded-pill bg-light text-danger">
                    <span>Keluar </span>
                </a>
            </a>
            </div>
        </div>

        <nav class="nav-menu">
            <a href="{{ route('students_dashboard') }}" class="nav-link {{ Request::is('Students/Dashboard') ? 'active' : '' }}"><i class="fa-solid fa-home text-primary"></i> Dashboard</a>
            <a href="{{ route('students_kelas') }}" class="nav-link {{ Request::is('Students/Kelas') ? 'active' : '' }}"><i class="fa-solid fa-chalkboard-user text-success"></i> Kelas Saya</a>
            <a href="{{ route('students_tugas') }}" class="nav-link {{ Request::is('Students/Tugas') ? 'active' : '' }}"><i class="fa-solid fa-clipboard-list text-warning"></i> Tugas</a>
            <a href="{{ route('students_nilai') }}" class="nav-link {{ Request::is('Students/Nilai') ? 'active' : '' }}"><i class="fa-solid fa-star text-danger"></i> Nilai</a>
            <a href="{{ route('students_jadwal') }}" class="nav-link {{ Request::is('Students/Jadwal') ? 'active' : '' }}"><i class="fa-solid fa-calendar-days text-info"></i> Jadwal</a>
        </nav>

        
    </div>