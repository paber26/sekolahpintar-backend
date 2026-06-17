<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    protected $connection = 'central';
    protected $table = 'master_konten';
    protected $guarded = [];

    public function subBab()
    {
        return $this->belongsTo(SubBab::class, 'sub_bab_id');
    }

    public function soals()
    {
        return $this->hasMany(Soal::class, 'konten_id');
    }
}
