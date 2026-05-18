<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id'); // INT PRIMARY KEY AUTO_INCREMENT
            $table->string('nama', 100);
            $table->string('email', 100)->unique(); 
            $table->string('password', 255);
            $table->enum('role', ['super_admin', 'teacher', 'student']);
            $table->string('nis', 20)->unique()->nullable();
            $table->string('nip', 20)->unique()->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->string('avatar', 255)->nullable();
            $table->string('no_telp', 15)->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps(); // Otomatis membuat created_at dan updated_at

            // Membuat index khusus untuk role (email otomatis ter-index karena unique)
            $table->index('role', 'idx_role');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id'); // INT PRIMARY KEY AUTO_INCREMENT
            $table->string('nama', 100);
            $table->text('deskripsi')->nullable();
            
            // Menggunakan unsignedInteger karena di tabel users kita menggunakan increments('id')
            $table->unsignedInteger('guru_id'); 
            
            $table->string('mata_pelajaran', 100);
            $table->string('tahun_ajaran', 9)->nullable();
            
            // Untuk CHECK constraint (semester IN (1,2)), di Laravel praktik terbaiknya 
            // adalah menangani validasi ini di sisi Aplikasi (Controller/Request), 
            // namun kita tetap menggunakan tipe data yang sesuai.
            $table->tinyInteger('semester')->nullable(); 
            
            $table->integer('jumlah_peserta')->default(0);
            $table->enum('status', ['active', 'archived', 'draft'])->default('active');
            
            $table->timestamps(); // Membuat created_at dan updated_at

            // Foreign Key dan Index
            $table->foreign('guru_id')->references('id')->on('users')->onDelete('restrict');
            $table->index('guru_id', 'idx_guru');
            $table->index('status', 'idx_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id'); // INT PRIMARY KEY AUTO_INCREMENT
            $table->unsignedInteger('class_id');
            $table->string('judul', 100);
            $table->text('deskripsi')->nullable();
            $table->integer('urutan');
            $table->enum('status', ['active', 'archived'])->default('active');
            
            // Sesuai SQL Anda yang hanya meminta created_at tanpa updated_at
            $table->timestamp('created_at')->useCurrent();

            // Foreign Key, Unique, dan Index
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->unique(['class_id', 'urutan'], 'unique_class_urutan');
            $table->index('class_id', 'idx_class');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topic_id');
            $table->string('judul', 100);
            $table->longText('konten')->nullable();
            $table->string('file_url', 255)->nullable();
            $table->string('file_type', 50)->nullable();
            $table->integer('urutan')->nullable();
            $table->enum('status', ['published', 'draft'])->default('published');
            
            $table->timestamp('created_at')->useCurrent();

            // Foreign Key dan Index
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
            $table->index('topic_id', 'idx_topic');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topic_id');
            $table->string('judul', 100);
            $table->text('deskripsi')->nullable();
            $table->string('file_url', 255)->nullable();
            $table->dateTime('deadline')->nullable();
            $table->integer('poin')->default(100);
            $table->integer('urutan')->nullable();
            $table->enum('status', ['published', 'draft'])->default('published');
            
            $table->timestamp('created_at')->useCurrent();

            // Foreign Key dan Index
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
            $table->index('deadline', 'idx_deadline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('task_id');
            $table->unsignedInteger('student_id');
            $table->string('file_url', 255);
            $table->dateTime('submitted_at')->useCurrent();
            $table->enum('status', ['belum_dikumpul', 'sudah_dikumpul', 'terlambat', 'dinilai'])->default('sudah_dikumpul');
            $table->integer('nilai')->nullable();
            $table->text('feedback')->nullable();
            $table->dateTime('graded_at')->nullable();
            
            // Relasi ke user_id guru (bisa null jika belum dinilai atau guru dihapus)
            $table->unsignedInteger('graded_by')->nullable();
            
            $table->timestamp('created_at')->useCurrent();

            // Foreign Keys
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('graded_by')->references('id')->on('users')->onDelete('set null');

            // Unique Keys dan Indexes
            $table->unique(['task_id', 'student_id'], 'unique_task_student');
            $table->index('student_id', 'idx_student');
            $table->index('status', 'idx_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_submissions');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topic_id');
            $table->string('judul', 100);
            $table->integer('durasi_menit')->default(60);
            $table->integer('total_pertanyaan')->nullable();
            $table->integer('passing_score')->default(70);
            $table->integer('poin')->default(100);
            $table->boolean('auto_grade')->default(true);
            $table->enum('status', ['published', 'draft'])->default('published');
            
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quiz_id');
            $table->text('pertanyaan');
            $table->enum('jenis', ['multiple_choice', 'essay', 'true_false'])->default('multiple_choice');
            $table->integer('poin')->default(1);
            $table->integer('urutan')->nullable();
            
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
            $table->index('quiz_id', 'idx_quiz');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('question_id');
            $table->text('jawaban');
            $table->boolean('is_correct')->default(false);
            $table->integer('urutan')->nullable();
            
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('question_id')->references('id')->on('quiz_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_answers');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quiz_id');
            $table->unsignedInteger('student_id');
            $table->integer('skor')->nullable();
            $table->enum('status', ['in_progress', 'completed', 'expired'])->default('in_progress');
            $table->dateTime('started_at');
            $table->dateTime('submitted_at')->nullable();
            $table->integer('waktu_pengerjaan_detik')->nullable();
            
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('student_id', 'idx_student');
            $table->index('status', 'idx_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_attempts');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz_attempt_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('attempt_id');
            $table->unsignedInteger('question_id');
            $table->text('jawaban_text')->nullable();
            
            // answer_id wajib nullable karena kita pakai onDelete('set null')
            $table->unsignedInteger('answer_id')->nullable(); 
            $table->boolean('is_correct')->nullable();
            
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('attempt_id')->references('id')->on('quiz_attempts')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('quiz_questions')->onDelete('cascade');
            $table->foreign('answer_id')->references('id')->on('quiz_answers')->onDelete('set null');
            
            $table->unique(['attempt_id', 'question_id'], 'unique_attempt_question');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_attempt_answers');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('class_enrollments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('student_id');
            $table->enum('enrollment_status', ['active', 'completed', 'dropped'])->default('active');
            $table->dateTime('enrolled_at')->useCurrent();
            $table->dateTime('completed_at')->nullable();
            
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->unique(['class_id', 'student_id'], 'unique_class_student');
            $table->index('student_id', 'idx_student');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_enrollments');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('class_enrollment_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('student_id');
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending');
            $table->text('alasan_penolakan')->nullable();
            $table->dateTime('requested_at')->useCurrent();
            $table->unsignedInteger('approved_by')->nullable();
            $table->dateTime('approved_at')->nullable();
            
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            
            $table->unique(['class_id', 'student_id'], 'unique_pending');
            $table->index('status', 'idx_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_enrollment_requests');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('student_id');
            $table->decimal('nilai_tugas', 5, 2)->nullable();
            $table->decimal('nilai_quiz', 5, 2)->nullable();
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->char('grade_letter', 1)->nullable();
            
            // Khusus tabel ini, SQL Anda hanya meminta updated_at.
            // useCurrentOnUpdate() memastikan waktu otomatis terbarui saat ada data yg diedit.
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->unique(['class_id', 'student_id'], 'unique_class_student');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('class_id');
            $table->string('hari', 20)->nullable();
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('ruangan', 50)->nullable();
            
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->index('class_id', 'idx_class');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('discussions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('author_id');
            $table->string('judul', 255);
            $table->text('konten');
            $table->unsignedInteger('parent_id')->nullable();
            $table->integer('total_replies')->default(0);
            $table->boolean('is_pinned')->default(false);
            $table->enum('status', ['active', 'archived', 'deleted'])->default('active');
            
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('discussions')->onDelete('cascade');
            
            $table->index('class_id', 'idx_class');
            $table->index('is_pinned', 'idx_pinned');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discussions');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('judul', 100);
            $table->text('pesan')->nullable();
            $table->enum('tipe', ['tugas', 'quiz', 'grade', 'request', 'system', 'discussion'])->nullable();
            $table->unsignedInteger('related_id')->nullable();
            $table->string('related_type', 50)->nullable();
            $table->boolean('is_read')->default(false);
            $table->dateTime('read_at')->nullable();
            
            $table->timestamp('created_at')->useCurrent();

            // Foreign Key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Indexes
            $table->index(['user_id', 'is_read'], 'idx_user_read');
            $table->index('created_at', 'idx_created');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('setting_key', 100)->unique();
            $table->text('setting_value')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            
            // Menggunakan updated_at saja sesuai SQL Anda
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
