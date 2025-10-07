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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('model')->nullable();

            // Relasi ke tabel wiraniagas
            $table->foreignId('wiraniaga_id')
                ->constrained('wiraniagas')
                ->onDelete('cascade'); // Jika wiraniaga dihapus, penjualannya ikut terhapus

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_penjualans');
    }
};
