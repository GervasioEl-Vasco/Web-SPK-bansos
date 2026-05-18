<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('nama');
            $table->text('alamat');
            $table->string('pekerjaan');
            // C1 - Penghasilan per Bulan
            $table->unsignedInteger('penghasilan')->default(0);
            // C2 - Jumlah Tanggungan Keluarga
            $table->unsignedTinyInteger('tanggungan')->default(0);
            // C3 - Status / Kondisi Rumah (1=Kontrak/Sewa, 2=Bambu, 3=Plester, 4=Keramik)
            $table->unsignedTinyInteger('kondisi_rumah')->default(1);
            // C4 - Luas Bangunan (m²)
            $table->unsignedInteger('luas_bangunan')->default(0);
            // C5 - Jenis Lantai (1=Tanah, 2=Papan, 3=Plester, 4=Keramik)
            $table->unsignedTinyInteger('jenis_lantai')->default(1);
            // C6 - Sumber Penerangan (1=Tidak ada, 2=PLN tanpa meteran, 3=PLN meteran >450VA)
            $table->unsignedTinyInteger('sumber_penerangan')->default(1);
            // C7 - Kendaraan (1=Tidak punya, 2=Motor, 3=Mobil, 4=Motor+Mobil)
            $table->unsignedTinyInteger('kendaraan')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
