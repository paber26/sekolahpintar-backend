<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Model;

class SubBab extends Model
{
    protected $connection = 'central';
    protected $table = 'master_sub_bab';
    protected $guarded = [];

    public function bab()
    {
        return $this->belongsTo(Bab::class, 'bab_id');
    }

    public function kontens()
    {
        return $this->hasMany(Konten::class, 'sub_bab_id');
    }
}
