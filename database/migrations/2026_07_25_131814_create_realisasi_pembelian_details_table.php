<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_realisasi_pembelian_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('realisasi_pembelian_id')->constrained('tb_realisasi_pembelian')->cascadeOnDelete();
            $table->foreignId('produk_id')->constrained('tb_produk')->cascadeOnDelete();
            $table->decimal('qty_rencana', 10, 3)->nullable();
            $table->decimal('total_beli', 15, 0);
            $table->decimal('hpp', 12, 0);
            $table->string('satuan', 15);
            $table->string('satuan_konversi', 15)->nullable();
            $table->decimal('qty', 10, 3);
            $table->decimal('isi_konversi', 10, 3)->nullable();
            $table->decimal('qty_konversi', 12, 3)->nullable();
            $table->decimal('qty_stok', 12, 3);
            $table->decimal('selisih', 10, 3)->nullable();
            $table->enum('status_beli', ['terbeli', 'dibatalkan'])->default('terbeli');

            $table->unique(['realisasi_pembelian_id', 'produk_id', 'satuan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_realisasi_pembelian_detail');
    }
};
// DONE