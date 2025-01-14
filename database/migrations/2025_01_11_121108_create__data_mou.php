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
        Schema::create('data_mous', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mitra');
            $table->text('perihal');
            $table->integer('tahun');
            $table->integer('jenis_mitra');
            $table->integer('jenis_kerjasama');
            $table->integer('masa_berlaku');
            $table->date('mulai_berlaku');
            $table->date('kadaluarsa');
            $table->string('nomor_agenda_mitra');
            $table->string('nomor_agenda_lldikti');
            $table->integer('status');
            $table->text('keterangan_dokumen')->nullable();
            $table->string('jenis_file'); // Link Google Drive Atau File Storage
            $table->string('file');
            $table->text('bentuk_tindak_lanjut')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_mou');
    }
};
