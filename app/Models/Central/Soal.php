<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $connection = 'central';
    protected $table = 'master_soal';

    protected $fillable = [
        'materi_id',
        'pertanyaan',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'pilihan_e',
        'jawaban_benar',
        'pembahasan',
        'bobot',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
