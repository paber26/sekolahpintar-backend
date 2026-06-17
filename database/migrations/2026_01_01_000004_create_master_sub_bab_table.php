<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_sub_bab', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bab_id')->constrained('master_bab')->cascadeOnDelete();
            $table->string('judul'); // e.g. Persegi
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_sub_bab');
    }
};
