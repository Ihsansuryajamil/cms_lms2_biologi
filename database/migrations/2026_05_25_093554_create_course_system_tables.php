<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_course', 150);
            $table->unsignedInteger('user_id');
            $table->string('kode_course', 12)->unique();
            $table->text('deskripsi')->nullable();
            $table->text('persyaratan')->nullable();
            $table->string('link_video', 255)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_id');
            $table->string('nama_topic', 150);
            $table->integer('durasi_pembelajaran')->default(0);
            $table->integer('urutan')->default(1);
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });

        Schema::create('sub_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topic_id');
            $table->string('judul', 150);
            $table->enum('jenis', ['materi', 'quiz', 'tugas'])->default('materi');
            $table->enum('status', ['publish', 'un-publish'])->default('publish');
            $table->text('deskripsi')->nullable();
            $table->string('link_1', 255)->nullable();
            $table->string('link_2', 255)->nullable();
            $table->string('link_3', 255)->nullable();
            $table->string('file_1', 255)->nullable();
            $table->string('file_2', 255)->nullable();
            $table->string('file_3', 255)->nullable();
            $table->integer('urutan')->default(1);
            $table->timestamps();

            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_topics');
        Schema::dropIfExists('topics');
        Schema::dropIfExists('courses');
    }
};