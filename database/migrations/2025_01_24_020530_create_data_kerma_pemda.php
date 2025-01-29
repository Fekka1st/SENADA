<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_kerma_pemdas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemada');
            $table->string('provinsi');
            $table->integer('status'); // 0 = belum MoU, 1 = sudah MoU, 2 = dalam proses MoU
            $table->integer('join_grup'); // 0 = belum join grup, 1 = sudah join grup
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kerma_pemda');
    }
};
