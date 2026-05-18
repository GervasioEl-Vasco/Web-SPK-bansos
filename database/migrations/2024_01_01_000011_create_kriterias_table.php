<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kriterias', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 5)->unique(); // C1, C2, ...
            $table->string('nama');
            $table->enum('sifat', ['benefit', 'cost'])->default('cost');
            $table->decimal('bobot', 5, 4); // e.g. 0.2500
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kriterias');
    }
};
