@extends('Layouts.app')

@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection

@section('content')
    <div class="topbar d-flex justify-content-between align-items-center w-100 mb-4">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('guru_class_all') }}" class="btn btn-outline-secondary rounded-pill">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <h5 class="mb-0 fw-bold">Tambah Kelas Baru</h5>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button type="submit" form="createKelasForm" class="btn btn-primary btn-sm rounded-pill px-4 py-2 fw-bold shadow-sm">
                <i class="fa-solid fa-save me-1"></i> Simpan Kelas
            </button>
        </div>
    </div>

    <div class="content-area">
        @if ($errors->any())
            <div class="alert alert-danger mb-4 rounded-3 border-0">
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="createKelasForm" action="{{ route('guru_kelas_store') }}" method="POST">
            @csrf
            
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4 p-md-5">
                            
                            <h6 class="fw-bold text-dark mb-4"><i class="fa-solid fa-school text-primary me-2"></i>Informasi Kelas</h6>
                            
                            <div class="row g-4">
                                <div class="col-md-7">
                                    <label class="form-label small fw-bold text-secondary">Nama Kelas</label>
                                    <input type="text" name="nama_kelas" class="form-control border p-2.5 bg-light" placeholder="Contoh: Kelas XI IPA 1, Biologi Peminatan A" value="{{ old('nama_kelas') }}" required>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label small fw-bold text-secondary">Tahun Ajaran</label>
                                    <select name="tahun_ajar" class="form-select border p-2.5 bg-light" required>
                                        <option value="" disabled {{ old('tahun_ajar') ? '' : 'selected' }}>Pilih Tahun Ajaran</option>
                                        
                                        {{-- Loop otomatis dari tahun 2024 sampai 2034 --}}
                                        @for ($year = 2024; $year <= 2034; $year++)
                                            @php
                                                $nextYear = $year + 1;
                                                $ganjil = "{$year}/{$nextYear} (Ganjil)";
                                                $genap = "{$year}/{$nextYear} (Genap)";
                                            @endphp
                                            <option value="{{ $ganjil }}" {{ old('tahun_ajar') == $ganjil ? 'selected' : '' }}>{{ $ganjil }}</option>
                                            <option value="{{ $genap }}" {{ old('tahun_ajar') == $genap ? 'selected' : '' }}>{{ $genap }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold text-secondary">Deskripsi atau Ringkasan Materi Kelas</label>
                                    <textarea name="deskripsi_kelas" class="form-control border p-2.5 bg-light" rows="4" placeholder="Masukkan deskripsi singkat cakupan kelas pembelajaran biologi ini...">{{ old('deskripsi_kelas') }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-4 border-bottom pb-3"><i class="fa-solid fa-user-tie text-success me-2"></i> Guru Pengajar</h6>
                            
                            <div class="mb-2">
                                <label class="form-label small fw-bold text-secondary">Pilih Wali / Pengajar Kelas</label>
                                <select name="teacher_id" class="form-select border p-2.5 bg-light" required>
                                    <option value="" disabled selected>Pilih Guru...</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->nama }} ({{ $teacher->role == 'super_admin' ? 'Admin' : 'Guru' }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted d-block mt-2" style="font-size: 0.7rem; line-height: 1.4;">
                                    User yang dipilih di atas akan bertanggung jawab penuh mengelola modul dan kuis di dalam kelas ini.
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info border-0 rounded-4 shadow-sm" role="alert">
                        <h6 class="fw-bold"><i class="fa-solid fa-circle-info me-2"></i> Informasi Struktur</h6>
                        <p class="mb-0 small" style="line-height: 1.6;">
                            Setelah data kelas tersimpan, murid-murid dapat dimasukkan ke dalam kelas ini melalui halaman detail edit profil pengguna masing-masing.
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection