<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;

    protected $connection = 'central';
    protected $table = 'master_kurikulum';

    protected $fillable = [
        'nama',
        'tahun',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function materi()
    {
        return $this->hasMany(Materi::class);
    }
}
