@extends('Layouts.appSiswa')
@section('content')

    <header class="quiz-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pe-lg-5">
                    <h1 class="course-header-title">Judul QUIZ</h1>
                    <div class="quiz-question-container mb-4">
                        <p class="quiz-question-text text-warning text-bold mb-4" style="font-size: 1.15rem; line-height: 1.6; font-weight: 500;">
                            Pertanyaan 1
                        </p>
                        <p class="quiz-question-text text-white mb-4" style="font-size: 1.15rem; line-height: 1.6; font-weight: 500;">
                            Seorang kepala desa ingin menerapkan prinsip Sila Keempat Pancasila, "Kerakyatan yang Dipimpin oleh Hikmat Kebijaksanaan dalam Permusyawaratan/Perwakilan," dalam pengambilan keputusan pembangunan desa. Sikap yang paling tepat adalah...
                        </p>

                        <div class="quiz-options-list d-flex flex-column gap-3">
                            
                            <button type="button" class="quiz-option-item btn w-100 text-start bg-white border shadow-sm p-3.5 rounded-4">
                                <span class="option-text text-dark">A. Menggelar voting terbuka untuk memilih proyek pembangunan yang diinginkan warga.</span>
                            </button>

                            <button type="button" class="quiz-option-item btn w-100 text-start bg-white border shadow-sm p-3.5 rounded-4">
                                <span class="option-text text-dark">B. Meminta pendapat tokoh masyarakat sebelum memutuskan rencana pembangunan desa.</span>
                            </button>

                            <button type="button" class="quiz-option-item btn w-100 text-start bg-white border shadow-sm p-3.5 rounded-4">
                                <span class="option-text text-dark">C. Menetapkan keputusan sendiri berdasarkan pengalaman dan kebijaksanaan pribadi.</span>
                            </button>

                            <button type="button" class="quiz-option-item btn w-100 text-start shadow-sm p-3.5 rounded-4 selected">
                                <span class="option-text text-dark fw-medium">D. Mengadakan musyawarah desa yang melibatkan seluruh warga untuk menentukan prioritas pembangunan.</span>
                            </button>

                        </div>

                        <div class="quiz-navigation-bar d-flex justify-content-center align-items-center mt-5 pt-4 border-top border-white-10">

                            <div class="quiz-pager d-flex align-items-center gap-3 bg-white px-3 py-1.5 rounded-pill shadow-sm border">
                                <button type="button" class="btn btn-link p-0 text-secondary"><i class="fa-solid fa-arrow-left"></i></button>
                                <span class="fw-bold text-dark small">1 / 30</span>
                                <button type="button" class="btn btn-link p-0 text-secondary"><i class="fa-solid fa-arrow-right"></i></button>
                            </div>

                        </div>
                    </div>

                    

                </div>
                <div class="col-lg-4 course-sidebar-wrapper">
                    <div class="sidebar-card">
                        
                        <div class="sidebar-content position-relative">
                            <!-- <div class="shadow-sm rounded-4 p-0"> -->
                                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                    <h6 class="fw-bold text-dark mb-0"><i class="fa-solid fa-th-large me-2 text-primary"></i> Navigasi Soal</h6>
                                    <span class="badge bg-light text-secondary border px-2.5 py-1" style="font-size: 0.75rem;">30 Soal</span>
                                </div>
                                
                                <div class="quiz-number-grid">
                                    <button class="num-item done">1</button>
                                    <button class="num-item done">2</button>
                                    <button class="num-item current">3</button>
                                    <button class="num-item blank">4</button>
                                    <button class="num-item blank">5</button>
                                    <button class="num-item blank">6</button>
                                    <button class="num-item blank">7</button>
                                    <button class="num-item blank">8</button>
                                    <button class="num-item blank">9</button>
                                    <button class="num-item blank">10</button>
                                    @for ($i = 11; $i <= 30; $i++)
                                        <button class="num-item blank">{{ $i }}</button>
                                    @endfor
                                </div>
                                
                                <div class="d-flex flex-wrap gap-3 mt-4 pt-3 border-top justify-content-center" style="font-size: 0.75rem;">
                                    <div class="d-flex align-items-center gap-1.5">
                                        <span class="status-dot bg-success"></span> <span class="text-secondary"> Sudah Diisi</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-1.5">
                                        <span class="status-dot bg-warning"></span> <span class="text-secondary"> Posisi Aktif</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-1.5">
                                        <span class="status-dot bg-white border"></span> <span class="text-secondary"> Belum Diisi</span>
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>

                        
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-lg-8 pe-lg-5">
                    
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                        
                    </div>
                    
                </div>

                
            </div> -->
        </div>
    </header>

    

@endsection