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
        Schema::create('data_direktori_pt', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pt');
            $table->string('nama_pt');
            $table->string('akreditasi');
            $table->string('alamat');
            $table->string('jenis_pt');
            $table->string('domisili');
            $table->string('provinsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_direktori_p_t');
    }
};
