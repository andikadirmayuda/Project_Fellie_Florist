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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kategori');
            $table->foreign('id_kategori')->references('id')->on('kategori')->onDelete('cascade');
            $table->string('nama_produk');
            $table->string('kode_produk')->unique();
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->enum('status_produk', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->timestamp('tanggal_dibuat')->useCurrent();
            $table->string('dibuat_oleh')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
