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
        Schema::create('data_kerjasama_pts', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pt');
            $table->string('nama_pt');
            $table->integer('jumlah_mou');
            $table->integer('jumlah_moa');
            $table->integer('jumlah_ia');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kerjasama_pts');
    }
};
