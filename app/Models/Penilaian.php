<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penilaian extends Model
{
    protected $fillable = [
        'penduduk_id', 'periode', 'nilai_akhir', 'ranking', 'status',
    ];

    protected $casts = [
        'nilai_akhir' => 'float',
    ];

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class);
    }
}
