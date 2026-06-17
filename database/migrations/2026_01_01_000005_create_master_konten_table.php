<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_konten', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_bab_id')->constrained('master_sub_bab')->cascadeOnDelete();
            $table->string('judul'); // e.g. Video Pembelajaran Persegi
            $table->enum('tipe', ['video', 'teks', 'pdf', 'kuis']);
            $table->longText('isi_konten')->nullable(); // HTML text or description
            $table->string('url_file')->nullable(); // Video URL or PDF path
            $table->integer('durasi_menit')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_konten');
    }
};
