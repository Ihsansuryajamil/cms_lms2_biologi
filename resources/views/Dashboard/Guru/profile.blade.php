@extends('Layouts.app')
@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection
@section('content')
<!-- <div class="main-content bg-light"> -->
        <div class="content-area pt-4">
            
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4 d-flex align-items-center">
                    <img src="https://ui-avatars.com/api/?name=Staff+Komputer&background=e0e0e0&color=999&size=100" class="rounded-circle me-4" alt="Avatar">
                    <div>
                        <h4 class="fw-bold mb-1">Staff Komputer</h4>
                        <p class="text-muted mb-3">0000000002</p>
                        <a href="{{ route('guru_profile_setting') }}" class="btn btn-outline-secondary rounded-pill btn-sm px-3 fw-medium">
                            <i class="fa-solid fa-gear"></i> Pengaturan
                        </a>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h6 class="fw-bold m-0 border-bottom border-primary border-3 d-inline-block pb-3" style="color: #444;">Profil</h6>
                    <hr class="m-0 mt-n1">
                </div>
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-md-4 p-4 border-end border-bottom">
                            <div class="d-flex gap-3">
                                <i class="fa-solid fa-id-badge text-muted mt-1"></i>
                                <div>
                                    <div class="small text-muted mb-1">Nomor Induk</div>
                                    <div class="fw-medium">0000000002</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p-4 border-end border-bottom">
                            <div class="d-flex gap-3">
                                <i class="fa-solid fa-envelope text-muted mt-1"></i>
                                <div>
                                    <div class="small text-muted mb-1">Email</div>
                                    <div class="fw-medium">bcepbandung@gmail.com</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p-4 border-bottom">
                            <div class="d-flex gap-3">
                                <i class="fa-solid fa-phone text-muted mt-1"></i>
                                <div>
                                    <div class="small text-muted mb-1">Nomor</div>
                                    <div class="fw-medium">0000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0">
                        <div class="col-md-8 p-4 border-end border-bottom">
                            <div class="d-flex gap-3">
                                <i class="fa-solid fa-location-dot text-muted mt-1"></i>
                                <div>
                                    <div class="small text-muted mb-1">Alamat</div>
                                    <div class="fw-medium">Jl. Raya Cibinong No. 123, Bogor</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p-4 border-bottom">
                            <div class="d-flex gap-3">
                                <i class="fa-solid fa-chalkboard-user text-muted mt-1"></i>
                                <div>
                                    <div class="small text-muted mb-1">Kelas</div>
                                    <div class="fw-medium">0000</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    <!-- </div> -->
@endsection