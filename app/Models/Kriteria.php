<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kriteria extends Model
{
    protected $fillable = ['kode', 'nama', 'sifat', 'bobot'];

    protected $casts = [
        'bobot' => 'float',
    ];

    public function subKriterias(): HasMany
    {
        return $this->hasMany(SubKriteria::class)->orderBy('nilai');
    }
}
