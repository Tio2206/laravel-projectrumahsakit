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
        Schema::create('ruangans', function (Blueprint $table) {
            $table->id(); // auto-increment primary key
            $table->string('kodeRuangan')->unique(); // kode ruangan, unique constraint
            $table->string('namaRuangan'); // nama ruangan
            $table->integer('dayaTampung'); // daya tampung
            $table->string('lokasi'); // lokasi ruangan
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangans');
    }
};
