<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kurikulum_id')->nullable()->constrained('master_kurikulum')->nullOnDelete();
            $table->string('nama'); // e.g. Matematika
            $table->string('tingkat'); // e.g. SMA
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_mata_pelajaran');
    }
};
