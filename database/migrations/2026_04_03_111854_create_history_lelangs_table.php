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
        Schema::create('history_lelang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_lelang')->constrained('lelang');
            $table->foreignId('id_barang')->constrained('barang');
            $table->foreignId('id_user')->constrained('users');
            $table->integer('penawaran_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_lelangs');
    }
};
