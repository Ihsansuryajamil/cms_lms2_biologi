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
            <h5 class="mb-0 fw-bold">Edit Informasi Kelas</h5>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button type="submit" form="updateKelasForm" class="btn btn-primary btn-sm rounded-pill px-4 py-2 fw-bold shadow-sm">
                <i class="fa-solid fa-save me-1"></i> Simpan Perubahan
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

        <form id="updateKelasForm" action="{{ route('guru_class_update_put', $class->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4 p-md-5">
                            
                            <h6 class="fw-bold text-dark mb-4"><i class="fa-solid fa-school text-primary me-2"></i>Detail Data Kelas</h6>
                            
                            <div class="row g-4">
                                <div class="col-md-7">
                                    <label class="form-label small fw-bold text-secondary">Nama Kelas</label>
                                    <input type="text" name="nama_kelas" class="form-control border p-2.5 bg-light" value="{{ old('nama_kelas', $class->nama_kelas) }}" required>
                                </div>
                                
                                <div class="col-md-5">
                                    <label class="form-label small fw-bold text-secondary">Tahun Ajaran</label>
                                    <select name="tahun_ajar" class="form-select border p-2.5 bg-light" required>
                                        <option value="" disabled>Pilih Tahun Ajaran</option>
                                        @for ($year = 2024; $year <= 2034; $year++)
                                            @php
                                                $nextYear = $year + 1;
                                                $ganjil = "{$year}/{$nextYear} (Ganjil)";
                                                $genap = "{$year}/{$nextYear} (Genap)";
                                            @endphp
                                            <option value="{{ $ganjil }}" {{ old('tahun_ajar', $class->tahun_ajar) == $ganjil ? 'selected' : '' }}>{{ $ganjil }}</option>
                                            <option value="{{ $genap }}" {{ old('tahun_ajar', $class->tahun_ajar) == $genap ? 'selected' : '' }}>{{ $genap }}</option>
                                        @endfor
                                    </select>
                                </div>
                                
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-secondary">Deskripsi Kelas</label>
                                    <textarea name="deskripsi_kelas" class="form-control border p-2.5 bg-light" rows="4">{{ old('deskripsi_kelas', $class->deskripsi_kelas) }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-4 border-bottom pb-3"><i class="fa-solid fa-user-tie text-success me-2"></i> Penanggung Jawab</h6>
                            
                            <div class="mb-2">
                                <label class="form-label small fw-bold text-secondary">Wali / Pengajar Kelas</label>
                                <select name="teacher_id" class="form-select border p-2.5 bg-light" required>
                                    <option value="" disabled>Pilih Guru...</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ old('teacher_id', $class->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->nama }} ({{ $teacher->role == 'super_admin' ? 'Admin' : 'Guru' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="card border-0 shadow-sm rounded-4 bg-light mb-4">
                        <div class="card-body p-4 text-muted small">
                            <h6 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-clock-rotate-left text-secondary me-2"></i> Log Kelas</h6>
                            <p class="mb-1"><strong>Terakhir Pembaruan:</strong></p>
                            <p class="mb-3">{{ $class->updated_at->format('d M Y - H:i') }} WIB</p>
                            
                            <p class="mb-1"><strong>Dibuat Pada:</strong></p>
                            <p class="mb-0">{{ $class->created_at->format('d M Y - H:i') }} WIB</p>
                        </div>
                    </div> -->

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4 text-muted small">
                            <h6 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-triangle-exclamation text-danger me-2"></i> Zona Bahaya</h6>
                            <button type="button" class="btn btn-danger btn-sm rounded-pill w-100 py-2 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#deleteKelasModal">
                                <i class="fa-solid fa-trash me-1"></i> Hapus Kelas Permanen
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="deleteKelasModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteKelasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
                <div class="modal-body text-center p-5">
                    <div class="text-danger mb-4">
                        <i class="fa-solid fa-circle-exclamation" style="font-size: 4rem;"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-3">Konfirmasi Hapus Kelas</h5>
                    <p class="text-muted px-2 mb-4" style="line-height: 1.6;">
                        Apakah Anda yakin ingin menghapus kelas <strong class="text-dark">"{{ $class->nama_kelas }}"</strong>? <br>
                        <span class="text-success small fw-medium"><i class="fa-solid fa-shield-halved"></i> Akun siswa/guru di dalam kelas ini tidak akan terhapus.</span>
                    </p>
                    
                    <form action="{{ route('guru_class_destroy', $class->id) }}" method="POST" class="d-flex gap-3 justify-content-center">
                        @csrf
                        @method('DELETE')
                        
                        <button type="button" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-secondary flex-grow-1 border" data-bs-dismiss="modal">
                            Tidak, Batalkan
                        </button>
                        
                        <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 fw-bold text-white flex-grow-1 shadow-sm">
                            Ya, Hapus Kelas
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection