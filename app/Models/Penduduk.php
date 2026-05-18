<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penduduk extends Model
{
    protected $fillable = [
        'nik', 'nama', 'alamat', 'pekerjaan',
        'penghasilan', 'tanggungan', 'kondisi_rumah',
        'luas_bangunan', 'jenis_lantai', 'sumber_penerangan', 'kendaraan',
    ];

    public function penilaians(): HasMany
    {
        return $this->hasMany(Penilaian::class);
    }

    public function penilaianTerakhir()
    {
        return $this->hasOne(Penilaian::class)->latestOfMany();
    }

    // Label kondisi rumah
    public function getKondisiRumahLabelAttribute(): string
    {
        return match ($this->kondisi_rumah) {
            1 => 'Kontrak/Sewa',
            2 => 'Bambu/Kayu',
            3 => 'Plester',
            4 => 'Keramik',
            default => '-',
        };
    }

    // Label jenis lantai
    public function getJenisLantaiLabelAttribute(): string
    {
        return match ($this->jenis_lantai) {
            1 => 'Tanah',
            2 => 'Papan/Kayu',
            3 => 'Plester/Semen',
            4 => 'Keramik/Granit',
            default => '-',
        };
    }

    // Label sumber penerangan
    public function getSumberPeneranganLabelAttribute(): string
    {
        return match ($this->sumber_penerangan) {
            1 => 'Tidak Ada',
            2 => 'PLN Tanpa Meteran',
            3 => 'PLN ≤450 VA',
            4 => 'PLN >450 VA',
            default => '-',
        };
    }

    // Label kendaraan
    public function getKendaraanLabelAttribute(): string
    {
        return match ($this->kendaraan) {
            1 => 'Tidak Punya',
            2 => 'Sepeda Motor',
            3 => 'Mobil',
            4 => 'Motor & Mobil',
            default => '-',
        };
    }
}
