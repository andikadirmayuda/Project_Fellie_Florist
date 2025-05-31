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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_variasi');
            $table->enum('jenis', ['masuk', 'keluar']);
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_variasi')
                  ->references('id')
                  ->on('variasi_produk')
                  ->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
