<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $connection = 'central';
    protected $table = 'master_mata_pelajaran';
    protected $guarded = [];

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class, 'kurikulum_id');
    }

    public function babs()
    {
        return $this->hasMany(Bab::class, 'mata_pelajaran_id');
    }
}
