@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
    <!-- <div class="main-content"> -->
        <form action="{{ route('guru_pengaturan_website_update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="topbar d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <span class="fw-bold"><i class="fa-solid fa-sliders"></i> Pengaturan Website</span>
            </div>
            <button type="submit" class="btn btn-sm border-3 rounded-pill text-white" style="background: #0d6efd;">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Pengaturan
            </button>
        </div>

        <div class="content-area">
            
            @if(session('success'))
                <div class="alert alert-success rounded-3 mb-4"><i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger rounded-3 mb-4">
                    <ul class="mb-0 small">@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                </div>
            @endif

            <div class="settings-grid">
                <div class="settings-card span-6">
                    <h6 class="fw-bold text-dark">Identitas Website</h6>
                    <p class="settings-helper">Atur nama website, tagline, dan informasi singkat penunjang aplikasi.</p>
                    
                    <div class="mb-3">
                        <label class="form-section-label mb-2 fw-semibold text-secondary">Nama Aplikasi Website</label>
                        <input type="text" name="nama_website" class="form-control text-dark bg-white" value="{{ old('nama_website', $settings->nama_website) }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-section-label mb-2 fw-semibold text-secondary">Nama Sekolah / Universitas / Kampus</label>
                        <input type="text" name="nama_institusi" class="form-control text-dark bg-white" value="{{ old('nama_institusi', $settings->nama_institusi) }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-section-label mb-2 fw-semibold text-secondary">Tagline / Slogan</label>
                        <input type="text" name="tagline" class="form-control text-dark bg-white" value="{{ old('tagline', $settings->tagline) }}">
                    </div>
                </div>

                <div class="settings-card span-6">
                    <h6 class="fw-bold text-dark">Aset Desain Logotype</h6>
                    <p class="settings-helper">Gunakan file gambar beresolusi proporsional. Ekstensi otomatis dikonversi ke WebP.</p>
                    
                    <div class="row align-items-center g-3 mb-4">
                        <div class="col-auto">
                            @if($settings->logo)
                                <img src="{{ asset('image/website/' . $settings->logo) }}" class="rounded-3 border border-2 object-fit-contain bg-light" style="width: 70px; height: 70px;">
                            @else
                                <div class="rounded-3 border border-dashed bg-light text-muted d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; font-size: 0.7rem;">No Logo</div>
                            @endif
                        </div>
                        <div class="col">
                            <label class="form-section-label mb-1.5 d-block fw-semibold text-secondary">Upload Logo Baru</label>
                            <input type="file" name="logo" class="form-control form-control-sm" accept="image/*">
                        </div>
                    </div>

                    <div class="row align-items-center g-3">
                        <div class="col-auto">
                            @if($settings->favicon)
                                <img src="{{ asset('image/website/' . $settings->favicon) }}" class="rounded-3 border border-2 object-fit-contain bg-light" style="width: 45px; height: 45px;">
                            @else
                                <div class="rounded-3 border border-dashed bg-light text-muted d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; font-size: 0.6rem;">Icon</div>
                            @endif
                        </div>
                        <div class="col">
                            <label class="form-section-label mb-1.5 d-block fw-semibold text-secondary">Upload Favicon Browser</label>
                            <input type="file" name="favicon" class="form-control form-control-sm" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- </div> -->
@endsection 