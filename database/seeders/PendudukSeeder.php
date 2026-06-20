<?php

namespace Database\Seeders;

use App\Models\Penduduk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendudukSeeder extends Seeder
{
    public function run(): void
    {
        // Try to disable foreign key checks when permitted.
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        } catch (\Exception $e) {
            // Ignore when the DB user lacks permission.
        }
        
        Penduduk::query()->delete();
        
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } catch (\Exception $e) {
            // Ignore when the DB user lacks permission.
        }

        $data = [
            // NIK, Nama, Alamat, Pekerjaan, Penghasilan, Tanggungan, KondisiRumah, AnggotaSekolah, PendidikanKK, DayaListrik, SumberAir, AsetTransportasi
            ['3201010101010001', 'Budi Santoso', 'Jl. Contoh No. 1, RT 01/01', 'Pekerjaan Umum', 2000000, 8, 4, 3, 4, 4, 3, 4],
            ['3201010101010002', 'Siti Aminah', 'Jl. Contoh No. 2, RT 01/02', 'Pekerjaan Umum', 1250000, 6, 4, 2, 4, 3, 3, 4],
            ['3201010101010003', 'Ahmad Fauzi', 'Jl. Contoh No. 3, RT 01/03', 'Pekerjaan Umum', 750000, 8, 3, 3, 3, 2, 2, 3],
            ['3201010101010004', 'Dewi Lestari', 'Jl. Contoh No. 4, RT 01/04', 'Pekerjaan Umum', 2000000, 6, 4, 1, 4, 4, 4, 4],
            ['3201010101010005', 'Joko Prasetyo', 'Jl. Contoh No. 5, RT 02/01', 'Pekerjaan Umum', 300000, 4, 2, 0, 2, 1, 1, 1],
            ['3201010101010006', 'Rina Marlina', 'Jl. Contoh No. 6, RT 02/02', 'Pekerjaan Umum', 1250000, 8, 3, 2, 3, 3, 2, 3],
            ['3201010101010007', 'Agus Riyanto', 'Jl. Contoh No. 7, RT 02/03', 'Pekerjaan Umum', 2000000, 8, 4, 3, 4, 4, 4, 4],
            ['3201010101010008', 'Nur Hayati', 'Jl. Contoh No. 8, RT 02/04', 'Pekerjaan Umum', 750000, 6, 2, 1, 3, 2, 2, 2],
            ['3201010101010009', 'Fajar Nugroho', 'Jl. Contoh No. 9, RT 03/01', 'Pekerjaan Umum', 1250000, 4, 3, 1, 2, 2, 2, 2],
            ['3201010101010010', 'Yanti Susilowati', 'Jl. Contoh No. 10, RT 03/02', 'Pekerjaan Umum', 2000000, 8, 3, 3, 4, 3, 4, 4],
            ['3201010101010011', 'Dedi Kurniawan', 'Jl. Contoh No. 11, RT 03/03', 'Pekerjaan Umum', 300000, 2, 1, 0, 1, 1, 1, 1],
            ['3201010101010012', 'Sri Wahyuni', 'Jl. Contoh No. 12, RT 03/04', 'Pekerjaan Umum', 1250000, 6, 4, 2, 4, 3, 3, 3],
            ['3201010101010013', 'Hendra Saputra', 'Jl. Contoh No. 13, RT 04/01', 'Pekerjaan Umum', 750000, 4, 2, 1, 2, 2, 2, 2],
            ['3201010101010014', 'Lina Karlina', 'Jl. Contoh No. 14, RT 04/02', 'Pekerjaan Umum', 2000000, 6, 4, 3, 4, 4, 3, 4],
            ['3201010101010015', 'Bayu Firmansyah', 'Jl. Contoh No. 15, RT 04/03', 'Pekerjaan Umum', 1250000, 8, 3, 2, 3, 2, 2, 3],
            ['3201010101010016', 'Asep Maulana', 'Jl. Contoh No. 16, RT 04/04', 'Pekerjaan Umum', 750000, 6, 2, 1, 3, 2, 3, 2],
            ['3201010101010017', 'Fitri Handayani', 'Jl. Contoh No. 17, RT 05/01', 'Pekerjaan Umum', 2000000, 8, 4, 2, 4, 4, 4, 4],
            ['3201010101010018', 'Wahyu Hidayat', 'Jl. Contoh No. 18, RT 05/02', 'Pekerjaan Umum', 300000, 4, 1, 0, 2, 1, 1, 1],
            ['3201010101010019', 'Intan Permata', 'Jl. Contoh No. 19, RT 05/03', 'Pekerjaan Umum', 1250000, 6, 3, 1, 3, 3, 2, 3],
            ['3201010101010020', 'Rizki Ananda', 'Jl. Contoh No. 20, RT 05/04', 'Pekerjaan Umum', 2000000, 8, 4, 3, 4, 3, 4, 4],
            ['3201010101010021', 'Sulastri', 'Jl. Contoh No. 21, RT 06/01', 'Pekerjaan Umum', 750000, 4, 3, 1, 2, 2, 2, 2],
            ['3201010101010022', 'Tono Saputro', 'Jl. Contoh No. 22, RT 06/02', 'Pekerjaan Umum', 1250000, 8, 3, 2, 3, 3, 3, 3],
            ['3201010101010023', 'Nuraini', 'Jl. Contoh No. 23, RT 06/03', 'Pekerjaan Umum', 2000000, 8, 4, 3, 4, 4, 4, 3],
            ['3201010101010024', 'Imam Syafii', 'Jl. Contoh No. 24, RT 06/04', 'Pekerjaan Umum', 750000, 6, 2, 1, 2, 2, 3, 2],
            ['3201010101010025', 'Rahmat Hidayat', 'Jl. Contoh No. 25, RT 07/01', 'Pekerjaan Umum', 300000, 2, 1, 0, 1, 1, 1, 1],
            ['3201010101010026', 'Yuliana Sari', 'Jl. Contoh No. 26, RT 07/02', 'Pekerjaan Umum', 1250000, 6, 3, 2, 3, 3, 2, 3],
            ['3201010101010027', 'Arif Setiawan', 'Jl. Contoh No. 27, RT 07/03', 'Pekerjaan Umum', 2000000, 8, 3, 3, 4, 4, 4, 4],
            ['3201010101010028', 'Melati Indah', 'Jl. Contoh No. 28, RT 07/04', 'Pekerjaan Umum', 750000, 4, 2, 2, 2, 2, 2, 2],
            ['3201010101010029', 'Dani Prakoso', 'Jl. Contoh No. 29, RT 08/01', 'Pekerjaan Umum', 1250000, 8, 3, 2, 3, 2, 3, 3],
            ['3201010101010030', 'Eka Wulandari', 'Jl. Contoh No. 30, RT 08/02', 'Pekerjaan Umum', 2000000, 8, 4, 3, 4, 4, 3, 4],
            ['3201010101010031', 'Hasan Basri', 'Jl. Contoh No. 31, RT 08/03', 'Pekerjaan Umum', 300000, 4, 1, 0, 1, 1, 1, 1],
            ['3201010101010032', 'Putri Ramadhani', 'Jl. Contoh No. 32, RT 08/04', 'Pekerjaan Umum', 1250000, 6, 4, 2, 4, 3, 3, 3],
            ['3201010101010033', 'Yusuf Maulana', 'Jl. Contoh No. 33, RT 09/01', 'Pekerjaan Umum', 750000, 6, 2, 1, 2, 2, 2, 2],
            ['3201010101010034', 'Rudi Hartono', 'Jl. Contoh No. 34, RT 09/02', 'Pekerjaan Umum', 2000000, 8, 4, 2, 4, 4, 4, 4],
            ['3201010101010035', 'Nisa Aulia', 'Jl. Contoh No. 35, RT 09/03', 'Pekerjaan Umum', 1250000, 6, 3, 3, 3, 3, 3, 3],
            ['3201010101010036', 'Bambang Irawan', 'Jl. Contoh No. 36, RT 09/04', 'Pekerjaan Umum', 300000, 2, 2, 0, 1, 1, 1, 1],
            ['3201010101010037', 'Ayu Puspitasari', 'Jl. Contoh No. 37, RT 010/01', 'Pekerjaan Umum', 2000000, 8, 4, 3, 4, 3, 4, 4],
            ['3201010101010038', 'Dwi Cahyo', 'Jl. Contoh No. 38, RT 010/02', 'Pekerjaan Umum', 750000, 4, 2, 1, 2, 2, 2, 2],
            ['3201010101010039', 'Miftahul Jannah', 'Jl. Contoh No. 39, RT 010/03', 'Pekerjaan Umum', 1250000, 8, 3, 2, 3, 3, 3, 3],
            ['3201010101010040', 'Galih Pratama', 'Jl. Contoh No. 40, RT 010/04', 'Pekerjaan Umum', 2000000, 8, 4, 3, 4, 4, 4, 4],
            ['3201010101010041', 'Novi Andriani', 'Jl. Contoh No. 41, RT 011/01', 'Pekerjaan Umum', 750000, 6, 2, 1, 2, 2, 3, 2],
            ['3201010101010042', 'Tri Wahyono', 'Jl. Contoh No. 42, RT 011/02', 'Pekerjaan Umum', 300000, 2, 1, 0, 1, 1, 1, 1],
            ['3201010101010043', 'Nur Fadilah', 'Jl. Contoh No. 43, RT 011/03', 'Pekerjaan Umum', 2000000, 8, 3, 3, 4, 4, 4, 4],
            ['3201010101010044', 'Jihan Safitri', 'Jl. Contoh No. 44, RT 011/04', 'Pekerjaan Umum', 1250000, 6, 3, 2, 3, 3, 3, 3],
            ['3201010101010045', 'Slamet Riyadi', 'Jl. Contoh No. 45, RT 012/01', 'Pekerjaan Umum', 750000, 4, 2, 1, 2, 2, 2, 2],
            ['3201010101010046', 'Dian Kartika', 'Jl. Contoh No. 46, RT 012/02', 'Pekerjaan Umum', 2000000, 8, 4, 3, 4, 4, 3, 4],
            ['3201010101010047', 'Farhan Akbar', 'Jl. Contoh No. 47, RT 012/03', 'Pekerjaan Umum', 1250000, 6, 3, 2, 3, 2, 3, 3],
            ['3201010101010048', 'Sari Dewi', 'Jl. Contoh No. 48, RT 012/04', 'Pekerjaan Umum', 2000000, 8, 4, 2, 4, 4, 4, 4],
            ['3201010101010049', 'Abdul Rohman', 'Jl. Contoh No. 49, RT 013/01', 'Pekerjaan Umum', 300000, 4, 1, 0, 1, 1, 1, 1],
            ['3201010101010050', 'Wulan Safitri', 'Jl. Contoh No. 50, RT 013/02', 'Pekerjaan Umum', 1250000, 8, 3, 3, 3, 3, 3, 3],
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
                'sumber_air'        => $row[10],
                'kendaraan'         => $row[11],
            ]);
        }
    }
}
