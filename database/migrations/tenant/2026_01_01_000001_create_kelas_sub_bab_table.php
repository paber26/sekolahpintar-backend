<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel ini berfungsi sebagai jembatan (pivot) bahwa sebuah kelas 
        // mengadopsi (mengambil) sebuah sub-bab dari master data pusat.
        Schema::create('kelas_sub_bab', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
            
            // ID dari database central master_sub_bab
            $table->unsignedBigInteger('sub_bab_id'); 
            
            // Tambahan info jika guru menambahkan instruksi khusus
            $table->text('instruksi_guru')->nullable();
            
            $table->timestamps();

            // Opsional: Pastikan satu kelas tidak mengambil sub_bab yang sama dua kali
            $table->unique(['kelas_id', 'sub_bab_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas_sub_bab');
    }
};
