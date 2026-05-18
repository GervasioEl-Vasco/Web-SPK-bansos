<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penduduk_id')->constrained('penduduks')->onDelete('cascade');
            $table->string('periode', 10); // e.g. "2024"
            $table->decimal('nilai_akhir', 8, 6)->default(0);
            $table->unsignedInteger('ranking')->default(0);
            $table->enum('status', ['layak', 'tidak_layak'])->default('tidak_layak');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
