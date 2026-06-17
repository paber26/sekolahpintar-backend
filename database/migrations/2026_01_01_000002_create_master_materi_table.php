<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_materi', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('mata_pelajaran');
            $table->string('tingkat');
            $table->string('semester');
            $table->string('tipe'); // pdf, video, teks
            $table->longText('konten')->nullable();
            $table->string('file_path')->nullable();
            $table->string('video_url')->nullable();
            $table->integer('urutan')->default(0);
            $table->foreignId('kurikulum_id')->constrained('master_kurikulum')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_materi');
    }
};
