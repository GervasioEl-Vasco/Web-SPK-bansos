<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        // Try to disable foreign key checks when permitted.
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        } catch (\Exception $e) {
            // Ignore when the DB user lacks permission.
        }
        
        SubKriteria::query()->delete();
        Kriteria::query()->delete();
        
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } catch (\Exception $e) {
            // Ignore when the DB user lacks permission.
        }

        $kriterias = [
            [
                'kode'  => 'C1',
                'nama'  => 'Penghasilan per Bulan',
                'sifat' => 'cost',
                'bobot' => 0.25,
                'sub'   => [
                    ['keterangan' => '≤ Rp 500.000', 'nilai' => 1],
                    ['keterangan' => 'Rp 500.001 – Rp 1.000.000', 'nilai' => 2],
                    ['keterangan' => 'Rp 1.000.001 – Rp 1.500.000', 'nilai' => 3],
                    ['keterangan' => '> Rp 1.500.000', 'nilai' => 4],
                ],
            ],
            [
                'kode'  => 'C2',
                'nama'  => 'Jumlah Tanggungan Keluarga',
                'sifat' => 'benefit',
                'bobot' => 0.15,
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
                'bobot' => 0.15,
                'sub'   => [
                    ['keterangan' => 'Numpang / Magersari', 'nilai' => 1],
                    ['keterangan' => 'Kontrak / Sewa', 'nilai' => 2],
                    ['keterangan' => 'Rumah Warisan / Keluarga', 'nilai' => 3],
                    ['keterangan' => 'Rumah Sendiri Permanen', 'nilai' => 4],
                ],
            ],
            [
                'kode'  => 'C4',
                'nama'  => 'Luas Bangunan',
                'sifat' => 'cost',
                'bobot' => 0.10,
                'sub'   => [
                    ['keterangan' => '< 30 m²', 'nilai' => 1],
                    ['keterangan' => '30 - 60 m²', 'nilai' => 2],
                    ['keterangan' => '61 - 90 m²', 'nilai' => 3],
                    ['keterangan' => '> 90 m²', 'nilai' => 4],
                ],
            ],
            [
                'kode'  => 'C5',
                'nama'  => 'Jenis Lantai',
                'sifat' => 'cost',
                'bobot' => 0.10,
                'sub'   => [
                    ['keterangan' => 'Tanah / Bambu', 'nilai' => 1],
                    ['keterangan' => 'Semen / Kayu', 'nilai' => 2],
                    ['keterangan' => 'Plester', 'nilai' => 3],
                    ['keterangan' => 'Keramik / Marmer', 'nilai' => 4],
                ],
            ],
            [
                'kode'  => 'C6',
                'nama'  => 'Sumber Penerangan',
                'sifat' => 'cost',
                'bobot' => 0.10,
                'sub'   => [
                    ['keterangan' => 'Tanpa Listrik / Lampu Tempel', 'nilai' => 1],
                    ['keterangan' => 'Listrik PLN 450 Watt', 'nilai' => 2],
                    ['keterangan' => 'Listrik PLN 900 Watt', 'nilai' => 3],
                    ['keterangan' => 'Listrik PLN > 900 Watt', 'nilai' => 4],
                ],
            ],
            [
                'kode'  => 'C7',
                'nama'  => 'Sumber Air Bersih',
                'sifat' => 'cost',
                'bobot' => 0.10,
                'sub'   => [
                    ['keterangan' => 'Sungai / Mata Air Terbuka', 'nilai' => 1],
                    ['keterangan' => 'Sumur Tetangga', 'nilai' => 2],
                    ['keterangan' => 'Sumur Sendiri', 'nilai' => 3],
                    ['keterangan' => 'PDAM Lancar / Air Kemasan', 'nilai' => 4],
                ],
            ],
            [
                'kode'  => 'C8',
                'nama'  => 'Kendaraan (Aset)',
                'sifat' => 'cost',
                'bobot' => 0.05,
                'sub'   => [
                    ['keterangan' => 'Sepeda / Jalan Kaki', 'nilai' => 1],
                    ['keterangan' => 'Motor 1 Unit', 'nilai' => 2],
                    ['keterangan' => 'Motor > 1 Unit', 'nilai' => 3],
                    ['keterangan' => 'Memiliki Mobil', 'nilai' => 4],
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
