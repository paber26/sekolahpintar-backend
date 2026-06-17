<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_soal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konten_id')->constrained('master_konten')->cascadeOnDelete();
            $table->text('pertanyaan');
            $table->string('pilihan_a');
            $table->string('pilihan_b');
            $table->string('pilihan_c');
            $table->string('pilihan_d');
            $table->string('pilihan_e')->nullable();
            $table->string('jawaban_benar', 1); // A, B, C, D, E
            $table->text('pembahasan')->nullable();
            $table->integer('bobot')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_soal');
    }
};
