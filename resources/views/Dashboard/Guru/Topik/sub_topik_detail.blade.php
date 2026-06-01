@extends('Layouts.app')

@section('sidebar')
    @include('Layouts.sideBarGuru')
@endsection

@section('content')
    <div class="topbar d-flex justify-content-between align-items-center w-100">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('guru_course_detail', $subTopic->topic->course_id) }}" class="btn btn-outline-secondary rounded-pill">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <h5 class="mb-0 fw-bold">Pratinjau Aktivitas <span class="badge bg-warning text-dark small ms-2" style="font-size: 0.75rem;">Mode Guru</span></h5>
        </div>
    </div>
    @if($subTopic->jenis == 'quiz')
    <div class="content-area mt-4">
        <div class="row g-4"> 
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                        <div class="d-flex align-items-center gap-3 pb-3 border-bottom">
                            <div class="p-3 rounded-3 text-white
                                @if($subTopic->jenis == 'materi')
                                    bg-primary
                                @elseif($subTopic->jenis == 'tugas')
                                    bg-warning text-dark
                                @else
                                    bg-danger
                                @endif
                            ">
                                @if($subTopic->jenis == 'materi')
                                    <i class="fa-solid fa-book-open-reader fa-xl"></i>
                                @elseif($subTopic->jenis == 'tugas')
                                    <i class="fa-solid fa-clipboard-list fa-xl"></i>
                                @else
                                    <i class="fa-solid fa-circle-question fa-xl"></i>
                                @endif
                            </div>
                            <div>
                                <span class="badge bg-light text-primary text-uppercase mb-1 fw-bold">{{ $subTopic->jenis }}</span>
                                <h4 class="mb-0 fw-bold text-dark">{{ $subTopic->judul }}</h4>
                                <small class="text-muted">Bab: {{ $subTopic->topic->nama_topic }}</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-2"><i class="fa-solid fa-align-left me-1 text-muted"></i> Deskripsi / Instruksi Quiz:</h6>
                        <div class="p-3 bg-light rounded-3 text-secondary" style="line-height: 1.7; min-height: 50px; white-space: pre-line;">
                            {!! $subTopic->deskripsi ? e($subTopic->deskripsi) : '<em>Tidak ada deskripsi tambahan untuk aktivitas ini.</em>' !!}
                        </div>
                    </div>
                </div>
                @if($subTopic->jenis == 'quiz')
                    @php
                        // Pisahkan soal berdasarkan tipenya
                        $pgQuestions = $subTopic->quizQuestions->where('tipe', 'pg');
                        $essayQuestions = $subTopic->quizQuestions->where('tipe', 'essay');
                    @endphp

                    @if($pgQuestions->count() > 0)
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" id="pgQuizCard">
                            <div class="card-body p-4">
                                <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-list-ul me-1 text-primary"></i> Tabel Quiz PG</h6>
                                
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 5%;" class="text-center fw-bold">No</th>
                                                <th style="width: 30%;" class="fw-bold">Pertanyaan</th>
                                                <th style="width: 10%;" class="text-center fw-bold">A</th>
                                                <th style="width: 10%;" class="text-center fw-bold">B</th>
                                                <th style="width: 10%;" class="text-center fw-bold">C</th>
                                                <th style="width: 10%;" class="text-center fw-bold">D</th>
                                                <th style="width: 8%;" class="text-center fw-bold">Jawaban</th>
                                                <th style="width: 12%;" class="text-center fw-bold">Bobot Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pgQuestions as $q)
                                                <tr>
                                                    <td class="text-center align-middle">
                                                        <span class="badge bg-light text-dark fw-bold">{{ $loop->iteration }}</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <small class="text-secondary">{{ $q->pertanyaan }}</small>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <small class="text-muted">{{ $q->opsi_a }}</small>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <small class="text-muted">{{ $q->opsi_b }}</small>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <small class="text-muted">{{ $q->opsi_c }}</small>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <small class="text-muted">{{ $q->opsi_d }}</small>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <span class="badge bg-success">{{ strtoupper($q->kunci_jawaban_pg) }}</span>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <span class="badge bg-info text-dark">{{ $q->bobot_nilai }} Poin</span>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($essayQuestions->count() > 0)
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" id="essayQuizCard">
                            <div class="card-body p-4">
                                <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-pen-nib me-1 text-warning"></i> Tabel Quiz Essay</h6>
                                
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 5%;" class="text-center fw-bold">No</th>
                                                <th style="width: 75%;" class="fw-bold">Pertanyaan</th>
                                                <th style="width: 20%;" class="text-center fw-bold">Bobot Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($essayQuestions as $q)
                                                <tr>
                                                    <td class="text-center align-middle">
                                                        <span class="badge bg-light text-dark fw-bold">{{ $loop->iteration }}</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <small class="text-secondary">{{ $q->pertanyaan }}</small>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <span class="badge bg-warning text-dark">{{ $q->bobot_nilai }} Poin</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                
                
            </div>

            <div class="col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-paperclip me-1 text-primary"></i> Berkas Lampiran (Max 3)</h6>
                        <div class="d-flex flex-column gap-2">
                            @php $hasFiles = false; @endphp
                            
                            @for($i = 1; $i <= 3; $i++)
                                @php $fileKey = 'file_' . $i; @endphp
                                @if($subTopic->$fileKey)
                                    @php $hasFiles = true; @endphp
                                    <div class="d-flex align-items-center justify-content-between p-3 border rounded-3 bg-white hover-shadow">
                                        <div class="d-flex align-items-center gap-2 overflow-hidden">
                                            <i class="fa-solid fa-file-pdf text-danger fs-4"></i>
                                            <div class="overflow-hidden">
                                                <div class="fw-bold text-dark text-truncate small" style="max-width: 180px;" title="{{ $subTopic->$fileKey }}">Slot {{ $i }}</div>
                                                <small class="text-muted d-block text-truncate" style="max-width: 150px;">{{ $subTopic->$fileKey }}</small>
                                            </div>
                                        </div>
                                        <a href="{{ asset('uploads/sub_topics/' . $subTopic->$fileKey) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                @endif
                            @endfor

                            @if(!$hasFiles)
                                <div class="text-center py-4 text-muted small bg-light rounded-3 border border-dashed">
                                    Tidak ada file lampiran yang diunggah.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-globe me-1 text-success"></i> Tautan / Link Eksternal (Max 3)</h6>
                        <div class="d-flex flex-column gap-2">
                            @php $hasLinks = false; @endphp

                            @for($i = 1; $i <= 3; $i++)
                                @php $linkKey = 'link_' . $i; @endphp
                                @if($subTopic->$linkKey)
                                    @php $hasLinks = true; @endphp
                                    <div class="d-flex align-items-center justify-content-between p-3 border rounded-3 bg-white">
                                        <div class="d-flex align-items-center gap-2 overflow-hidden">
                                            <i class="fa-solid fa-link text-success fs-5"></i>
                                            <div class="overflow-hidden">
                                                <div class="fw-bold text-dark small">Referensi {{ $i }}</div>
                                                <small class="text-muted d-block text-truncate" style="max-width: 180px;">{{ $subTopic->$linkKey }}</small>
                                            </div>
                                        </div>
                                        <a href="{{ $subTopic->$linkKey }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                    </div>
                                @endif
                            @endfor

                            @if(!$hasLinks)
                                <div class="text-center py-4 text-muted small bg-light rounded-3 border border-dashed">
                                    Tidak ada link referensi eksternal.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
    <div class="content-area mt-4">
        <div class="row g-4"> 
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                        <div class="d-flex align-items-center gap-3 pb-3 border-bottom">
                            <div class="p-3 rounded-3 text-white
                                @if($subTopic->jenis == 'materi')
                                    bg-primary
                                @elseif($subTopic->jenis == 'tugas')
                                    bg-warning text-dark
                                @else
                                    bg-danger
                                @endif
                            ">
                                @if($subTopic->jenis == 'materi')
                                    <i class="fa-solid fa-book-open-reader fa-xl"></i>
                                @elseif($subTopic->jenis == 'tugas')
                                    <i class="fa-solid fa-clipboard-list fa-xl"></i>
                                @else
                                    <i class="fa-solid fa-circle-question fa-xl"></i>
                                @endif
                            </div>
                            <div>
                                <span class="badge bg-light text-primary text-uppercase mb-1 fw-bold">{{ $subTopic->jenis }}</span>
                                <h4 class="mb-0 fw-bold text-dark">{{ $subTopic->judul }}</h4>
                                <small class="text-muted">Bab: {{ $subTopic->topic->nama_topic }}</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-2"><i class="fa-solid fa-align-left me-1 text-muted"></i> Deskripsi / Instruksi Pembelajaran:</h6>
                        <div class="p-3 bg-light rounded-3 text-secondary" style="line-height: 1.7; min-height: 350px; white-space: pre-line;">
                            {!! $subTopic->deskripsi ? e($subTopic->deskripsi) : '<em>Tidak ada deskripsi tambahan untuk aktivitas ini.</em>' !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-paperclip me-1 text-primary"></i> Berkas Lampiran (Max 3)</h6>
                        <div class="d-flex flex-column gap-2">
                            @php $hasFiles = false; @endphp
                            
                            @for($i = 1; $i <= 3; $i++)
                                @php $fileKey = 'file_' . $i; @endphp
                                @if($subTopic->$fileKey)
                                    @php $hasFiles = true; @endphp
                                    <div class="d-flex align-items-center justify-content-between p-3 border rounded-3 bg-white hover-shadow">
                                        <div class="d-flex align-items-center gap-2 overflow-hidden">
                                            <i class="fa-solid fa-file-pdf text-danger fs-4"></i>
                                            <div class="overflow-hidden">
                                                <div class="fw-bold text-dark text-truncate small" style="max-width: 180px;" title="{{ $subTopic->$fileKey }}">Slot {{ $i }}</div>
                                                <small class="text-muted d-block text-truncate" style="max-width: 250px;">{{ $subTopic->$fileKey }}</small>
                                            </div>
                                        </div>
                                        <a href="{{ asset('uploads/sub_topics/' . $subTopic->$fileKey) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                @endif
                            @endfor

                            @if(!$hasFiles)
                                <div class="text-center py-4 text-muted small bg-light rounded-3 border border-dashed">
                                    Tidak ada file lampiran yang diunggah.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-globe me-1 text-success"></i> Tautan / Link Eksternal (Max 3)</h6>
                        <div class="d-flex flex-column gap-2">
                            @php $hasLinks = false; @endphp

                            @for($i = 1; $i <= 3; $i++)
                                @php $linkKey = 'link_' . $i; @endphp
                                @if($subTopic->$linkKey)
                                    @php $hasLinks = true; @endphp
                                    <div class="d-flex align-items-center justify-content-between p-3 border rounded-3 bg-white">
                                        <div class="d-flex align-items-center gap-2 overflow-hidden">
                                            <i class="fa-solid fa-link text-success fs-5"></i>
                                            <div class="overflow-hidden">
                                                <div class="fw-bold text-dark small">Referensi {{ $i }}</div>
                                                <small class="text-muted d-block text-truncate" style="max-width: 250px;">{{ $subTopic->$linkKey }}</small>
                                            </div>
                                        </div>
                                        <a href="{{ $subTopic->$linkKey }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                    </div>
                                @endif
                            @endfor

                            @if(!$hasLinks)
                                <div class="text-center py-4 text-muted small bg-light rounded-3 border border-dashed">
                                    Tidak ada link referensi eksternal.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    
<!-- <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" id="pgQuizCard">
                    
    <div class="card-body p-4">
        <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-align-left me-1 text-muted"></i> Tabel Quiz PG</h6>
        
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;" class="text-center fw-bold">No</th>
                        <th style="width: 35%;" class="fw-bold">Pertanyaan</th>
                        <th style="width: 12%;" class="text-center fw-bold">A</th>
                        <th style="width: 12%;" class="text-center fw-bold">B</th>
                        <th style="width: 12%;" class="text-center fw-bold">C</th>
                        <th style="width: 12%;" class="text-center fw-bold">D</th>
                        <th style="width: 12%;" class="text-center fw-bold">Jawaban</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center align-middle">
                            <span class="badge bg-light text-dark fw-bold">1</span>
                        </td>
                        <td class="align-middle">
                            <small class="text-secondary">Apa yang dimaksud dengan sistem operasi?</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">Program aplikasi</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">Perangkat lunak</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">Antivirus</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">Aplikasi browsing</small>
                        </td>
                        <td class="text-center align-middle">
                            <span class="badge bg-info">B</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">
                            <span class="badge bg-light text-dark fw-bold">2</span>
                        </td>
                        <td class="align-middle">
                            <small class="text-secondary">Komponen mana yang bertanggung jawab untuk memproses data?</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">RAM</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">Hard Drive</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">CPU</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">Power Supply</small>
                        </td>
                        <td class="text-center align-middle">
                            <span class="badge bg-success">C</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">
                            <span class="badge bg-light text-dark fw-bold">3</span>
                        </td>
                        <td class="align-middle">
                            <small class="text-secondary">Apa singkatan dari RAM?</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">Read Access Mem</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">Random Access M</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">Rapid App Mode</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">Remote Auto Mem</small>
                        </td>
                        <td class="text-center align-middle">
                            <span class="badge bg-info">B</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">
                            <span class="badge bg-light text-dark fw-bold">4</span>
                        </td>
                        <td class="align-middle">
                            <small class="text-secondary">Fungsi utama ROM adalah untuk?</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">Menyimpan aplikasi</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">Menyimpan data</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">Instruksi startup</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">Tingkatkan prosesor</small>
                        </td>
                        <td class="text-center align-middle">
                            <span class="badge bg-success">C</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">
                            <span class="badge bg-light text-dark fw-bold">5</span>
                        </td>
                        <td class="align-middle">
                            <small class="text-secondary">Berapa byte dalam 1 Megabyte?</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">1.000 byte</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">10.000 byte</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">1.048.576 byte</small>
                        </td>
                        <td class="text-center align-middle">
                            <small class="text-muted">2.097.152 byte</small>
                        </td>
                        <td class="text-center align-middle">
                            <span class="badge bg-success">C</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" id="essayQuizCard">
    <div class="card-body p-4">
        <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-align-left me-1 text-muted"></i> Tabel Quiz Essay</h6>
        
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;" class="text-center fw-bold">No</th>
                        <th style="width: 35%;" class="fw-bold">Pertanyaan</th>
                        <th style="width: 60%;" class="text-right fw-bold">Jawaban Benar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center align-middle">
                            <span class="badge bg-light text-dark fw-bold">1</span>
                        </td>
                        <td class="align-middle">
                            <small class="text-secondary">Apa yang dimaksud dengan sistem operasi?</small>
                        </td>
                        <td class="text-right align-middle">
                            <small class="text-secondary"></small>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">
                            <span class="badge bg-light text-dark fw-bold">2</span>
                        </td>
                        <td class="align-middle">
                            <small class="text-secondary">Komponen mana yang bertanggung jawab untuk memproses data?</small>
                        </td>
                        <td class="text-right align-middle">
                            <small class="text-secondary"></small>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div> -->
@endsection