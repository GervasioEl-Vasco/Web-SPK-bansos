<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penduduk extends Model
{
    protected $fillable = [
        'nik', 'nama', 'alamat', 'pekerjaan',
        'penghasilan', 'tanggungan', 'kondisi_rumah',
        'luas_bangunan', 'jenis_lantai', 'sumber_penerangan', 'sumber_air', 'kendaraan',
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
            1 => 'Numpang/Magersari',
            2 => 'Kontrak/Sewa',
            3 => 'Rumah Warisan/Keluarga',
            4 => 'Rumah Sendiri Permanen',
            default => '-',
        };
    }

    // Label jenis lantai
    public function getJenisLantaiLabelAttribute(): string
    {
        return match ($this->jenis_lantai) {
            1 => 'Tanah/Bambu',
            2 => 'Semen/Kayu',
            3 => 'Plester',
            4 => 'Keramik/Marmer',
            default => '-',
        };
    }

    // Label sumber penerangan
    public function getDayaListrikLabelAttribute(): string
    {
        return match ($this->sumber_penerangan) {
            1 => 'Tanpa Listrik/Lampu Tempel',
            2 => 'Listrik PLN 450 Watt',
            3 => 'Listrik PLN 900 Watt',
            4 => 'Listrik PLN > 900 Watt',
            default => '-',
        };
    }

    public function getSumberAirLabelAttribute(): string
    {
        return match ($this->sumber_air) {
            1 => 'Sungai/Mata Air Terbuka',
            2 => 'Sumur Tetangga',
            3 => 'Sumur Sendiri',
            4 => 'PDAM Lancar/Air Kemasan',
            default => '-',
        };
    }

    // Label aset transportasi
    public function getAsetTransportasiLabelAttribute(): string
    {
        return match ($this->kendaraan) {
            1 => 'Sepeda/Jalan Kaki',
            2 => 'Motor 1 Unit',
            3 => 'Motor > 1 Unit',
            4 => 'Memiliki Mobil',
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
