<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Model;

class Bab extends Model
{
    protected $connection = 'central';
    protected $table = 'master_bab';
    protected $guarded = [];

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function subBabs()
    {
        return $this->hasMany(SubBab::class, 'bab_id');
    }
}
