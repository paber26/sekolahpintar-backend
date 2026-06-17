<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $connection = 'central';
    protected $table = 'master_soal';
    protected $guarded = [];

    public function konten()
    {
        return $this->belongsTo(Konten::class, 'konten_id');
    }
}
