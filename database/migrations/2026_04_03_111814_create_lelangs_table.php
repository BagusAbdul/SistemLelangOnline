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
        Schema::create('lelang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang')->constrained('barang');
            $table->date('tgl_lelang');
            $table->integer('harga_akhir')->nullable();
            $table->foreignId('id_user')->nullable()->constrained('users'); // Pemenang
            $table->foreignId('id_petugas')->constrained('users');
            $table->enum('status', ['dibuka', 'ditutup'])->default('ditutup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lelangs');
    }
};
