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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('NomorRekamMedis')->unique();
            $table->string('namaPasien');
            $table->date('tanggalLahir');
            $table->enum('jenisKelamin', ['L', 'P']);
            $table->text('alamatPasien');
            $table->string('kotaPasien');
            $table->integer('usiaPasien');
            $table->text('penyakitPasien');
            $table->char('idDokter');
            $table->date('tanggalMasuk');
            $table->date('tanggalKeluar')->nullable();
            $table->integer('nomorKamar');
            $table->timestamps();

            $table->foreign('idDokter')->references('idDokter')->on('dokters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
