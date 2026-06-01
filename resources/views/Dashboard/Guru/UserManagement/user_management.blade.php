@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
<div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <h5 class="mb-0 fw-bold"><i class="fa-solid fa-users"></i> Manajemen User</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <button  class="btn btn-sm border-3 rounded-pill text-white"  style="background: #0d6efd;"><i class="fa-solid fa-user-plus"></i> Tambah User</button>
            </div>
        </div>

        <div class="content-area p-4">
            <!-- Filter & Search -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control form-control-sm" id="searchUser" placeholder="Cari nama atau email..." onkeyup="searchUsers()">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select form-select-sm" id="filterRole">
                                <option value="">Semua Role</option>
                                <option value="guru">Guru</option>
                                <option value="siswa">Siswa</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select form-select-sm" id="filterStatus">
                                <option value="">Semua Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Non-Aktif</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-secondary btn-sm w-100"><i class="fa-solid fa-redo"></i> Reset</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Table -->
            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 user-table">
                        <thead class="table-light">
                            <tr>
                                <th width="50">#</th>
                                <th width="250">NAMA USER</th>
                                <th>EMAIL</th>
                                <th width="100">ROLE</th>
                                <th width="100">STATUS</th>
                                <th width="120">TERDAFTAR</th>
                                <th width="100">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <!-- Data dinamis akan ditampilkan di sini -->
                            <tr>
                                <td class="text-muted fw-bold">1</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name=Ibu+Siti&background=27ae60&color=fff" class="rounded-circle" width="36" height="36" alt="Avatar">
                                        <div>
                                            <div class="fw-bold">Ibu Siti Nurhaliza</div>
                                            <small class="text-muted">NIP: 198505121999032002</small>
                                        </div>
                                    </div>
                                </td>
                                <td>siti.nurhaliza@gmail.com</td>
                                <td><span class="badge bg-success">Guru</span></td>
                                <td><span class="badge bg-success">Aktif</span></td>
                                <td class="text-muted small">15 Jul 2025</td>
                                <td>
                                    <a href="user_detail.html?id=1" class="btn btn-sm btn-outline-primary rounded-pill"><i class="fa-solid fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-bold">2</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name=Bapak+Ahmad&background=3498db&color=fff" class="rounded-circle" width="36" height="36" alt="Avatar">
                                        <div>
                                            <div class="fw-bold">Bapak Ahmad Wijaya</div>
                                            <small class="text-muted">NIP: 198612151997031003</small>
                                        </div>
                                    </div>
                                </td>
                                <td>ahmad.wijaya@gmail.com</td>
                                <td><span class="badge bg-success">Guru</span></td>
                                <td><span class="badge bg-success">Aktif</span></td>
                                <td class="text-muted small">15 Jul 2025</td>
                                <td>
                                    <a href="user_detail.html?id=2" class="btn btn-sm btn-outline-primary rounded-pill"><i class="fa-solid fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-bold">3</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=4f46e5&color=fff" class="rounded-circle" width="36" height="36" alt="Avatar">
                                        <div>
                                            <div class="fw-bold">Budi Santoso</div>
                                            <small class="text-muted">NIS: 2024001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>budi.santoso@siswa.sch.id</td>
                                <td><span class="badge bg-info">Siswa</span></td>
                                <td><span class="badge bg-success">Aktif</span></td>
                                <td class="text-muted small">16 Jul 2025</td>
                                <td>
                                    <a href="user_detail.html?id=3" class="btn btn-sm btn-outline-primary rounded-pill"><i class="fa-solid fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-bold">4</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name=Allena+Aurelia&background=e67e22&color=fff" class="rounded-circle" width="36" height="36" alt="Avatar">
                                        <div>
                                            <div class="fw-bold">Allena Aurelia Gunawan</div>
                                            <small class="text-muted">NIS: 2024002</small>
                                        </div>
                                    </div>
                                </td>
                                <td>allena.aurelia@siswa.sch.id</td>
                                <td><span class="badge bg-info">Siswa</span></td>
                                <td><span class="badge bg-success">Aktif</span></td>
                                <td class="text-muted small">16 Jul 2025</td>
                                <td>
                                    <a href="user_detail.html?id=4" class="btn btn-sm btn-outline-primary rounded-pill"><i class="fa-solid fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-bold">5</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name=Dewi+Santoso&background=d35400&color=fff" class="rounded-circle" width="36" height="36" alt="Avatar">
                                        <div>
                                            <div class="fw-bold">Ibu Dewi Santoso</div>
                                            <small class="text-muted">NIP: 197809241998032001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>dewi.santoso@gmail.com</td>
                                <td><span class="badge bg-success">Guru</span></td>
                                <td><span class="badge bg-danger">Non-Aktif</span></td>
                                <td class="text-muted small">15 Jul 2025</td>
                                <td>
                                    <a href="user_detail.html?id=5" class="btn btn-sm btn-outline-primary rounded-pill"><i class="fa-solid fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-bold">6</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name=Eka+Putri&background=16a34a&color=fff" class="rounded-circle" width="36" height="36" alt="Avatar">
                                        <div>
                                            <div class="fw-bold">Ibu Eka Putri</div>
                                            <small class="text-muted">NIP: 198902152001032003</small>
                                        </div>
                                    </div>
                                </td>
                                <td>eka.putri@gmail.com</td>
                                <td><span class="badge bg-success">Guru</span></td>
                                <td><span class="badge bg-success">Aktif</span></td>
                                <td class="text-muted small">18 Jul 2025</td>
                                <td>
                                    <a href="user_detail.html?id=6" class="btn btn-sm btn-outline-primary rounded-pill"><i class="fa-solid fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-light border-top py-3">
                    <nav aria-label="Table pagination">
                        <ul class="pagination mb-0 justify-content-center">
                            <li class="page-item disabled"><a class="page-link" href="#">Sebelumnya</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">Selanjutnya</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
@endsection