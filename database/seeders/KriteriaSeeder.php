<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks during seeding
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        SubKriteria::truncate();
        Kriteria::truncate();
        
        // Re-enable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $kriterias = [
            [
                'kode'  => 'C1',
                'nama'  => 'Penghasilan per Bulan',
                'sifat' => 'cost',
                'bobot' => 0.25,
                'sub'   => [
                    ['keterangan' => '≤ Rp 1.000.000', 'nilai' => 1],
                    ['keterangan' => 'Rp 1.000.001 – Rp 3.000.000', 'nilai' => 2],
                    ['keterangan' => 'Rp 3.000.001 – Rp 5.000.000', 'nilai' => 3],
                    ['keterangan' => '> Rp 5.000.000', 'nilai' => 4],
                ],
            ],
            [
                'kode'  => 'C2',
                'nama'  => 'Jumlah Tanggungan Keluarga',
                'sifat' => 'cost',
                'bobot' => 0.20,
                'sub'   => [
                    ['keterangan' => '1 orang', 'nilai' => 1],
                    ['keterangan' => '2 orang', 'nilai' => 2],
                    ['keterangan' => '3 orang', 'nilai' => 3],
                    ['keterangan' => '≥ 4 orang', 'nilai' => 4],
                ],
            ],
            [
                'kode'  => 'C3',
                'nama'  => 'Kondisi / Status Rumah',
                'sifat' => 'cost',
                'bobot' => 0.20,
                'sub'   => [
                    ['keterangan' => 'Kontrak / Sewa', 'nilai' => 1],
                    ['keterangan' => 'Bambu / Kayu', 'nilai' => 2],
                    ['keterangan' => 'Plester / Semi Permanen', 'nilai' => 3],
                    ['keterangan' => 'Tembok Keramik / Permanen', 'nilai' => 4],
                ],
            ],
            [
                'kode'  => 'C4',
                'nama'  => 'Luas Bangunan',
                'sifat' => 'cost',
                'bobot' => 0.15,
                'sub'   => [
                    ['keterangan' => '< 30 m²', 'nilai' => 1],
                    ['keterangan' => '30 – 60 m²', 'nilai' => 2],
                    ['keterangan' => '61 – 90 m²', 'nilai' => 3],
                    ['keterangan' => '> 90 m²', 'nilai' => 4],
                ],
            ],
            [
                'kode'  => 'C5',
                'nama'  => 'Jenis Lantai',
                'sifat' => 'cost',
                'bobot' => 0.10,
                'sub'   => [
                    ['keterangan' => 'Tanah', 'nilai' => 1],
                    ['keterangan' => 'Papan / Kayu', 'nilai' => 2],
                    ['keterangan' => 'Plester / Semen', 'nilai' => 3],
                    ['keterangan' => 'Keramik / Granit', 'nilai' => 4],
                ],
            ],
            [
                'kode'  => 'C6',
                'nama'  => 'Sumber Penerangan',
                'sifat' => 'cost',
                'bobot' => 0.05,
                'sub'   => [
                    ['keterangan' => 'Tidak Ada Listrik', 'nilai' => 1],
                    ['keterangan' => 'PLN Tanpa Meteran', 'nilai' => 2],
                    ['keterangan' => 'PLN ≤ 450 VA', 'nilai' => 3],
                    ['keterangan' => 'PLN > 450 VA', 'nilai' => 4],
                ],
            ],
            [
                'kode'  => 'C7',
                'nama'  => 'Kepemilikan Kendaraan',
                'sifat' => 'cost',
                'bobot' => 0.05,
                'sub'   => [
                    ['keterangan' => 'Tidak Punya', 'nilai' => 1],
                    ['keterangan' => 'Sepeda Motor', 'nilai' => 2],
                    ['keterangan' => 'Mobil', 'nilai' => 3],
                    ['keterangan' => 'Motor & Mobil', 'nilai' => 4],
                ],
            ],
        ];

        foreach ($kriterias as $data) {
            $sub = $data['sub'];
            unset($data['sub']);
            $k = Kriteria::create($data);
            foreach ($sub as $s) {
                SubKriteria::create(array_merge($s, ['kriteria_id' => $k->id]));
            }
        }
    }
}
