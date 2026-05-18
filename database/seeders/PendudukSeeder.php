<?php

namespace Database\Seeders;

use App\Models\Penduduk;
use Illuminate\Database\Seeder;

class PendudukSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks during seeding
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        Penduduk::truncate();
        
        // Re-enable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            // NIK, Nama, Alamat, Pekerjaan, Penghasilan, Tanggungan, KondisiRumah, LuasBangunan, JenisLantai, SumberPenerangan, Kendaraan
            ['3201010101010001', 'Budi Santoso',       'Jl. Melati No. 1, RT 01/01',     'Buruh Harian',     800000,  3, 2, 36, 1, 2, 1],
            ['3201010101010002', 'Siti Aminah',        'Jl. Mawar No. 5, RT 01/02',      'Ibu Rumah Tangga', 0,       4, 1, 24, 1, 1, 1],
            ['3201010101010003', 'Ahmad Fauzi',        'Jl. Kenanga No. 12, RT 02/01',   'Petani',           1500000, 2, 2, 48, 2, 3, 1],
            ['3201010101010004', 'Dewi Rahayu',        'Jl. Anggrek No. 3, RT 02/02',    'Pedagang Kecil',   2000000, 3, 3, 60, 3, 3, 2],
            ['3201010101010005', 'Hendra Gunawan',     'Jl. Dahlia No. 8, RT 03/01',     'Wirausaha',        4500000, 2, 3, 72, 4, 4, 2],
            ['3201010101010006', 'Nurul Hidayah',      'Jl. Flamboyan No. 2, RT 03/02',  'Buruh Cuci',       700000,  4, 1, 20, 1, 2, 1],
            ['3201010101010007', 'Joko Widagdo',       'Jl. Cempaka No. 15, RT 04/01',   'Sopir Angkot',     2500000, 3, 2, 40, 2, 3, 2],
            ['3201010101010008', 'Rina Wulandari',     'Jl. Seruni No. 7, RT 04/02',     'Asisten Rumah Tangga', 600000, 4, 1, 18, 1, 1, 1],
            ['3201010101010009', 'Dadang Hermawan',    'Jl. Tulip No. 9, RT 05/01',      'Karyawan Swasta',  3500000, 1, 3, 80, 4, 4, 2],
            ['3201010101010010', 'Euis Susilawati',    'Jl. Teratai No. 4, RT 05/02',    'Penjual Sayur',    900000,  3, 2, 30, 1, 2, 1],
            ['3201010101010011', 'Asep Kurniawan',     'Jl. Nusa Indah No. 6, RT 06/01', 'Tukang Bangunan',  1800000, 4, 2, 45, 2, 3, 1],
            ['3201010101010012', 'Fatimah Zahra',      'Jl. Bougenville No. 11, RT 06/02','Jahit Rumahan',   500000,  5, 1, 22, 1, 2, 1],
            ['3201010101010013', 'Ridwan Kamil Jr.',   'Jl. Palm No. 20, RT 07/01',      'Pegawai Kontrak',  3200000, 2, 3, 65, 3, 4, 2],
            ['3201010101010014', 'Lilis Karlina',      'Jl. Bambu No. 3, RT 07/02',      'Penjual Gorengan', 750000,  4, 1, 28, 1, 2, 1],
            ['3201010101010015', 'Wahyu Setiawan',     'Jl. Akasia No. 14, RT 08/01',    'Nelayan',          1200000, 3, 2, 50, 2, 3, 1],
        ];

        foreach ($data as $row) {
            Penduduk::create([
                'nik'               => $row[0],
                'nama'              => $row[1],
                'alamat'            => $row[2],
                'pekerjaan'         => $row[3],
                'penghasilan'       => $row[4],
                'tanggungan'        => $row[5],
                'kondisi_rumah'     => $row[6],
                'luas_bangunan'     => $row[7],
                'jenis_lantai'      => $row[8],
                'sumber_penerangan' => $row[9],
                'kendaraan'         => $row[10],
            ]);
        }
    }
}
