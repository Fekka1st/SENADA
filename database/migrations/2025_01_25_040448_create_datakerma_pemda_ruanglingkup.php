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
        Schema::create('datakerma_pemda_ruanglingkup', function (Blueprint $table) {
            $table->id();
            $table->string('ruang_lingkup');
            $table->string('nama_program');
            $table->string('tgl_pelaksanaan_start');
            $table->string('tgl_pelaksanaan_end');
            $table->string('kpi_program');
            $table->string('pencapaian_program');
            $table->string('evaluasi_program');
            $table->string('dukungan_pihak_lain');
            $table->foreignId('pemda_id')->constrained('data_kerma_pemdas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datakerma_pemda_ruanglingkup');
    }
};
