<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ---------------------------------------------------------
        // 1. TABEL TUGAS SUBMISSION (Untuk menampung jawaban Tugas Siswa)
        // ---------------------------------------------------------
        Schema::create('tugas_submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sub_topic_id'); // Relasi ke sub_topics (jenis: tugas)
            $table->unsignedInteger('student_id'); // Relasi ke users
            $table->text('jawaban_teks')->nullable(); // Jika siswa menjawab via teks (essay langsung)
            $table->string('file_jawaban', 255)->nullable(); // Jika siswa unggah PDF/Excel
            $table->string('link_jawaban', 255)->nullable(); // Jika siswa kirim link GDrive
            $table->integer('nilai')->nullable(); // Nilai manual dari guru
            $table->text('catatan_guru')->nullable(); // Feedback guru
            $table->enum('status', ['terkirim', 'dinilai'])->default('terkirim');
            $table->timestamps();

            $table->foreign('sub_topic_id')->references('id')->on('sub_topics')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
        });

        // ---------------------------------------------------------
        // 2. TABEL QUIZ QUESTIONS (Bank Soal dari Guru)
        // ---------------------------------------------------------
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sub_topic_id'); // Relasi ke sub_topics (jenis: quiz)
            $table->enum('tipe', ['pg', 'essay']);
            $table->text('pertanyaan');
            // Opsi untuk Pilihan Ganda (Kosongkan jika tipe=essay)
            $table->string('opsi_a', 255)->nullable();
            $table->string('opsi_b', 255)->nullable();
            $table->string('opsi_c', 255)->nullable();
            $table->string('opsi_d', 255)->nullable();
            $table->enum('kunci_jawaban_pg', ['a', 'b', 'c', 'd'])->nullable();
            
            $table->integer('bobot_nilai')->default(10); // Berguna jika soal essay nilainya lebih besar dari PG
            $table->timestamps();

            $table->foreign('sub_topic_id')->references('id')->on('sub_topics')->onDelete('cascade');
        });

        // ---------------------------------------------------------
        // 3. TABEL QUIZ ATTEMPTS (Sesi Siswa Mengerjakan & Skor Total)
        // ---------------------------------------------------------
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sub_topic_id');
            $table->unsignedInteger('student_id');
            $table->decimal('total_nilai', 5, 2)->default(0); // SKOR AKHIR SISWA DISIMPAN DI SINI
            
            // Status untuk membedakan apakah kuis butuh dinilai manual (karena ada essay) atau sudah otomatis selesai
            $table->enum('status', ['mengerjakan', 'selesai_auto', 'menunggu_dinilai_manual', 'dinilai_lengkap'])->default('mengerjakan');
            
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();

            $table->foreign('sub_topic_id')->references('id')->on('sub_topics')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
        });

        // ---------------------------------------------------------
        // 4. TABEL QUIZ STUDENT ANSWERS (Jawaban Detail per Nomor Soal)
        // ---------------------------------------------------------
        Schema::create('quiz_student_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quiz_attempt_id'); // Relasi ke sesi pengerjaan (bukan ke tabel student langsung)
            $table->unsignedInteger('quiz_question_id'); // Relasi ke soal
            
            $table->text('jawaban_siswa')->nullable(); // Berisi 'a', 'b', 'c', 'd' (jika PG) atau paragraf panjang (jika Essay)
            $table->boolean('is_correct')->nullable(); // True/False otomatis dari sistem (null untuk essay sebelum dinilai)
            $table->integer('nilai_didapat')->default(0); // Nilai per soal
            
            $table->timestamps();

            $table->foreign('quiz_attempt_id')->references('id')->on('quiz_attempts')->onDelete('cascade');
            $table->foreign('quiz_question_id')->references('id')->on('quiz_questions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_student_answers');
        Schema::dropIfExists('quiz_attempts');
        Schema::dropIfExists('quiz_questions');
        Schema::dropIfExists('tugas_submissions');
    }
};