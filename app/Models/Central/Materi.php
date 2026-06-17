<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $connection = 'central';
    protected $table = 'master_materi';

    protected $fillable = [
        'judul',
        'deskripsi',
        'mata_pelajaran',
        'tingkat',
        'semester',
        'tipe',          // pdf, video, teks
        'konten',        // teks/html content
        'file_path',     // path di MinIO
        'video_url',     // URL video (YouTube/MinIO)
        'urutan',
        'kurikulum_id',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'urutan'    => 'integer',
        ];
    }

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class);
    }

    public function soal()
    {
        return $this->hasMany(Soal::class);
    }
}
