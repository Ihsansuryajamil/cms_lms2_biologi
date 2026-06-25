@extends('Layouts.app')

@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection

@section('content')
        <div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-2">
                <h6 class="mb-0 fw-bold" style="font-size: 0.95rem;"><i class="fa-solid fa-comments"></i> Forum Diskusi</h6>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-sm btn-primary rounded-pill" type="button" disabled style="font-size: 0.85rem; padding: 6px 16px;">
                    <i class="fa-solid fa-plus"></i> Buat Diskusi Baru
                </button>
            </div>
        </div>

        <div class="content-area p-4">
            <div class="card border-0 shadow-sm mb-4 rounded-4">
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm" placeholder="Cari topik diskusi..." style="font-size: 0.85rem;">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select form-select-sm" style="font-size: 0.85rem;">
                                <option value="">Semua Kelas</option>
                                <option value="10A">Biologi 10A</option>
                                <option value="11B">Biologi 11B</option>
                                <option value="12C">Biologi 12C</option>
                            </select>
                        </div>
                        <!-- <div class="col-md-2">
                            <select class="form-select form-select-sm" style="font-size: 0.85rem;">
                                <option value="">Semua Status</option>
                                <option value="open">Terbuka</option>
                                <option value="closed">Tutup</option>
                            </select>
                        </div> -->
                        <div class="col-md-2 d-grid">
                            <button class="btn btn-sm btn-warning border-2 rounded-pill text-black" style="font-size: 0.85rem; padding: 6px 16px;">Filter</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4 rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">
                        <div>
                            <h5 class="fw-bold mb-1" style="font-size: 1rem;">Pembahasan Fotosintesis pada Daun</h5>
                            <div class="small text-muted">
                                Dipost oleh <span class="fw-semibold text-dark">Dewi Prasetya</span> • Biologi 10A • 24 Juni 2026 09:20
                            </div>
                        </div>
                        <span class="badge bg-primary-subtle text-primary text-uppercase" style="font-size: 0.75rem; padding: 0.55em 0.85em;">Guru</span>
                    </div>

                    <p class="text-muted mb-4" style="font-size: 0.92rem; line-height: 1.7;">Bagaimana proses fotosintesis pada daun berjalan secara detail? Jelaskan hubungan klorofil, sinar matahari, dan aliran energi pada tingkat sel.</p>

                    <div class="bg-light rounded-4 p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <span class="badge bg-success-subtle text-success text-uppercase" style="font-size: 0.75rem; padding: 0.55em 0.85em;">2 Balasan</span>
                            </div>
                            <a href="#" class="small text-decoration-none">Lihat semua balasan</a>
                        </div>

                        <div class="d-flex gap-3 mb-3">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; font-size: 0.95rem;">R</div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 align-items-start">
                                    <div>
                                        <div class="fw-semibold">Rina Cahya <small class="text-muted">(Siswa)</small></div>
                                        <div class="small text-muted">Biologi 10A • 24 Juni 2026 09:48</div>
                                    </div>
                                </div>
                                <p class="mb-0 text-secondary" style="font-size: 0.9rem; line-height: 1.6;">Fotosintesis dimulai dari penyerapan cahaya oleh klorofil, kemudian energi digunakan untuk memecah H2O menjadi O2 dan H. Karbon dioksida bergabung dengan H untuk membentuk glukosa.</p>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; font-size: 0.95rem;">Y</div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 align-items-start">
                                    <div>
                                        <div class="fw-semibold">Yoga Pratama <small class="text-muted">(Siswa)</small></div>
                                        <div class="small text-muted">Biologi 10A • 24 Juni 2026 10:05</div>
                                    </div>
                                </div>
                                <p class="mb-0 text-secondary" style="font-size: 0.9rem; line-height: 1.6;">Kalau menurut saya, kloroplas berfungsi sebagai pabrik energi. Produk akhirnya adalah glukosa yang digunakan sel sebagai bahan bakar.</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill" type="button"><i class="fa-solid fa-thumbs-up me-1"></i> Suka</button>
                        <button class="btn btn-sm btn-outline-primary rounded-pill" type="button"><i class="fa-solid fa-reply me-1"></i> Balas</button>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4 rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">
                        <div>
                            <h5 class="fw-bold mb-1" style="font-size: 1rem;">Pengaruh Kadar Air Tanah terhadap Pertumbuhan Akar</h5>
                            <div class="small text-muted">
                                Dipost oleh <span class="fw-semibold text-dark">Ayu Lestari</span> • Biologi 11B • 25 Juni 2026 13:10
                            </div>
                        </div>
                        <span class="badge bg-primary-subtle text-primary text-uppercase" style="font-size: 0.75rem; padding: 0.55em 0.85em;">Guru</span>
                    </div>

                    <p class="text-muted mb-4" style="font-size: 0.92rem; line-height: 1.7;">Diskusikan bagaimana kadar air tanah memengaruhi panjang dan struktur akar tanaman. Apakah ada batas optimal untuk akar tumbuh dengan baik?</p>

                    <div class="bg-light rounded-4 p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <span class="badge bg-success-subtle text-success text-uppercase" style="font-size: 0.75rem; padding: 0.55em 0.85em;">1 Balasan</span>
                            </div>
                            <a href="#" class="small text-decoration-none">Lihat semua balasan</a>
                        </div>

                        <div class="d-flex gap-3 mb-3">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; font-size: 0.95rem;">B</div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 align-items-start">
                                    <div>
                                        <div class="fw-semibold">Bima Nur <small class="text-muted">(Siswa)</small></div>
                                        <div class="small text-muted">Biologi 11B • 25 Juni 2026 13:35</div>
                                    </div>
                                </div>
                                <p class="mb-0 text-secondary" style="font-size: 0.9rem; line-height: 1.6;">Kadar air yang cukup membuat akar lebih mudah menyerap nutrisi. Jika terlalu basah, oksigen di tanah berkurang sehingga akar bisa busuk.</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill" type="button"><i class="fa-solid fa-thumbs-up me-1"></i> Suka</button>
                        <button class="btn btn-sm btn-outline-primary rounded-pill" type="button"><i class="fa-solid fa-reply me-1"></i> Balas</button>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4 rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">
                        <div>
                            <h5 class="fw-bold mb-1" style="font-size: 1rem;">Struktur Hormon Endokrin pada Sistem Tubuh Manusia</h5>
                            <div class="small text-muted">
                                Dipost oleh <span class="fw-semibold text-dark">Dewi Prasetya</span> • Biologi 12C • 25 Juni 2026 15:50
                            </div>
                        </div>
                        <span class="badge bg-primary-subtle text-primary text-uppercase" style="font-size: 0.75rem; padding: 0.55em 0.85em;">Guru</span>
                    </div>

                    <p class="text-muted mb-4" style="font-size: 0.92rem; line-height: 1.7;">Jelaskan perbedaan antara hormon protein dan hormon steroid. Berikan contoh kelenjar yang menghasilkan masing-masing jenis hormon.</p>

                    <div class="bg-light rounded-4 p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <span class="badge bg-success-subtle text-success text-uppercase" style="font-size: 0.75rem; padding: 0.55em 0.85em;">1 Balasan</span>
                            </div>
                            <a href="#" class="small text-decoration-none">Lihat semua balasan</a>
                        </div>

                        <div class="d-flex gap-3 mb-3">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; font-size: 0.95rem;">S</div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 align-items-start">
                                    <div>
                                        <div class="fw-semibold">Sari Anindya <small class="text-muted">(Siswa)</small></div>
                                        <div class="small text-muted">Biologi 12C • 25 Juni 2026 16:05</div>
                                    </div>
                                </div>
                                <p class="mb-0 text-secondary" style="font-size: 0.9rem; line-height: 1.6;">Hormon protein bersifat larut dalam air dan disekresikan oleh kelenjar seperti pankreas (insulin). Hormon steroid larut dalam lemak, contohnya kortisol dari kelenjar adrenal.</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill" type="button"><i class="fa-solid fa-thumbs-up me-1"></i> Suka</button>
                        <button class="btn btn-sm btn-outline-primary rounded-pill" type="button"><i class="fa-solid fa-reply me-1"></i> Balas</button>
                    </div>
                </div>
            </div>
        </div>
@endsection