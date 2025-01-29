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
        Schema::create('datakerma_pemda_pts', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_kerjasama');
            $table->string('nama_pt');
            $table->string('jangka_waktu');
            $table->foreignId('pemda_id')->constrained('data_kerma_pemdas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datakerma_pemda_pts');
    }
};
