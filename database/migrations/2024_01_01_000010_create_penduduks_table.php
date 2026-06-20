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
            // C4 - Anggota Keluarga Sekolah
            $table->unsignedTinyInteger('luas_bangunan')->default(0);
            // C5 - Pendidikan Kepala Keluarga
            $table->unsignedTinyInteger('jenis_lantai')->default(1);
            // C6 - Daya Listrik Rumah
            $table->unsignedTinyInteger('sumber_penerangan')->default(1);
            // C7 - Sumber Air Bersih
            $table->unsignedTinyInteger('sumber_air')->default(1);
            // C8 - Aset Transportasi
            $table->unsignedTinyInteger('kendaraan')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
