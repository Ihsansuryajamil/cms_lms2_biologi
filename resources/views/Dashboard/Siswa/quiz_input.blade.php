@extends('Layouts.appSiswa')
@section('content')

    <header class="quiz-header">
        <div class="container">
            <form action="{{ route('students_quiz_submit', $attempt->id) }}" method="POST" id="main-quiz-form">
                @csrf
                <div class="row">
                    <div class="col-lg-8 pe-lg-5">
                        <h1 class="course-header-title">{{ $attempt->subTopic->judul }}</h1>
                        
                        @foreach($questions as $index => $q)
                            <div class="quiz-question-container mb-4 question-block" id="question-block-{{ $index }}" style="{{ $index === 0 ? '' : 'display: none;' }}">
                                <p class="quiz-question-text text-warning text-bold mb-1" style="font-size: 1.15rem; line-height: 1.6; font-weight: 600;">
                                    Pertanyaan {{ $index + 1 }} 
                                    @if($q->tipe === 'essay')
                                        <span class="badge bg-warning text-dark ms-2" style="font-size: 0.7rem; vertical-align: middle;">Essay</span>
                                    @endif
                                </p>
                                <p class="quiz-question-text text-white mb-4" style="font-size: 1.15rem; line-height: 1.6; font-weight: 500;">
                                    {!! e($q->pertanyaan) !!}
                                </p>

                                @if($q->tipe === 'pg')
                                    <div class="quiz-options-list d-flex flex-column gap-3 options-for-{{ $q->id }}">
                                        @foreach(['a', 'b', 'c', 'd'] as $opsi)
                                            @php $kolomOpsi = 'opsi_' . $opsi; @endphp
                                            @if($q->$kolomOpsi)
                                                <input type="radio" name="answers[{{ $q->id }}]" value="{{ $opsi }}" id="radio-{{ $q->id }}-{{ $opsi }}" style="display: none;">
                                                
                                                <button type="button" class="quiz-option-item btn w-100 text-start bg-white border shadow-sm p-3.5 rounded-4" 
                                                        id="btn-{{ $q->id }}-{{ $opsi }}" 
                                                        onclick="selectOption({{ $q->id }}, {{ $index }}, '{{ $opsi }}')">
                                                    <span class="option-text text-dark"><strong class="text-uppercase">{{ $opsi }}.</strong> {{ $q->$kolomOpsi }}</span>
                                                </button>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <div class="bg-white p-4 rounded-4 shadow-sm">
                                        <label class="small text-muted mb-2 d-block">Tulis jawaban uraian Anda di bawah ini:</label>
                                        <textarea name="answers[{{ $q->id }}]" class="form-control rounded-3" rows="6" placeholder="Ketik jawaban lengkap..." oninput="typeEssay({{ $q->id }}, {{ $index }}, this.value)"></textarea>
                                    </div>
                                @endif

                                <div class="quiz-navigation-bar d-flex justify-content-center align-items-center mt-5 pt-4 border-top border-white-10">
                                    <div class="quiz-pager d-flex align-items-center gap-3 bg-white px-3 py-1.5 rounded-pill shadow-sm border">
                                        <button type="button" class="btn btn-link p-0 text-secondary" onclick="navigateQuestion(-1)"><i class="fa-solid fa-arrow-left"></i></button>
                                        <span class="fw-bold text-dark small current-pager-text">{{ $index + 1 }} / {{ $questions->count() }}</span>
                                        <button type="button" class="btn btn-link p-0 text-secondary" onclick="navigateQuestion(1)"><i class="fa-solid fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="col-lg-4 course-sidebar-wrapper">
                        <div class="sidebar-card">
                            <div class="sidebar-content position-relative">
                                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                    <h6 class="fw-bold text-dark mb-0"><i class="fa-solid fa-th-large me-2 text-primary"></i> Navigasi Soal</h6>
                                    <span class="badge bg-light text-secondary border px-2.5 py-1" style="font-size: 0.75rem;">{{ $questions->count() }} Soal</span>
                                </div>
                                
                                <div class="quiz-number-grid">
                                    @foreach($questions as $index => $q)
                                        <button type="button" class="num-item {{ $index === 0 ? 'current' : 'blank' }}" id="grid-item-{{ $index }}" onclick="showQuestion({{ $index }})">
                                            {{ $index + 1 }}
                                        </button>
                                    @endforeach
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
                            </div>

                            <div class="sidebar-content p-4 bg-white" style="border-radius: 0 0 12px 12px;">
                                <button type="button" class="btn btn-danger rounded-pill w-100 py-2.5 fw-bold shadow-sm" onclick="confirmSubmitQuiz()">
                                    <i class="fa-solid fa-paper-plane me-2"></i> Kumpulkan Ujian
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </header>

    <script>
        let currentIndex = 0;
        const totalQuestions = {{ $questions->count() }};

        // Fungsi berpindah halaman kuis secara manual / grid
        function showQuestion(index) {
            if(index < 0 || index >= totalQuestions) return;

            // Sembunyikan semua blok pertanyaan
            document.querySelectorAll('.question-block').forEach(el => el.style.display = 'none');
            // Tampilkan blok aktif
            document.getElementById(`question-block-${index}`).style.display = 'block';

            // Sinkronisasi status CSS tombol navigasi grid samping
            document.querySelectorAll('.num-item').forEach(btn => btn.classList.remove('current'));
            const activeGrid = document.getElementById(`grid-item-${index}`);
            if(activeGrid) activeGrid.classList.add('current');

            currentIndex = index;
        }

        // Fungsi tombol panah kanan kiri
        function navigateQuestion(direction) {
            showQuestion(currentIndex + direction);
        }

        // Fungsi interaksi klik opsi PG
        function selectOption(questionId, index, optionValue) {
            // Centang radio input asli di background
            document.getElementById(`radio-${questionId}-${optionValue}`).checked = true;

            // Reset seluruh warna tombol opsi pada soal ini
            document.querySelectorAll(`.options-for-${questionId} .quiz-option-item`).forEach(btn => {
                btn.classList.remove('selected');
                btn.querySelector('.option-text').classList.remove('fw-medium');
            });

            // Aktifkan style seleksi item terpilih
            const selectedBtn = document.getElementById(`btn-${questionId}-${optionValue}`);
            selectedBtn.classList.add('selected');
            selectedBtn.querySelector('.option-text').classList.add('fw-medium');

            // Tandai nomor grid samping menjadi hijau (Selesai diisi)
            const gridItem = document.getElementById(`grid-item-${index}`);
            if(gridItem) {
                gridItem.classList.remove('blank');
                gridItem.classList.add('done');
            }
        }

        // Fungsi interaksi ketik Essay
        function typeEssay(questionId, index, value) {
            const gridItem = document.getElementById(`grid-item-${index}`);
            if(gridItem) {
                if(value.trim() !== "") {
                    gridItem.classList.remove('blank');
                    gridItem.classList.add('done');
                } else {
                    gridItem.classList.remove('done');
                    gridItem.classList.add('blank');
                }
            }
        }

        // Konfirmasi akhir pengumpulan form murni
        function confirmSubmitQuiz() {
            let yakin = confirm('Apakah Anda yakin semua soal telah diperiksa dan ingin menyelesaikan sesi ujian ini?');
            if(yakin) {
                document.getElementById('main-quiz-form').submit();
            }
        }
    </script>

    <style>
        .quiz-option-item.selected {
            background-color: #e6f0ff !important;
            border-color: #0d6efd !important;
        }
        .quiz-option-item.selected .option-text {
            color: #0d6efd !important;
        }
        .num-item.done {
            background-color: #198754 !important;
            color: white !important;
            border-color: #198754 !important;
        }
        .num-item.current {
            background-color: #ffc107 !important;
            color: black !important;
            border-color: #ffc107 !important;
        }
    </style>

@endsection