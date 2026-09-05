<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_stok_opname_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stok_opname_id')->constrained('tb_stok_opname')->cascadeOnDelete();
            $table->foreignId('produk_id')->constrained('tb_produk');
            $table->string('satuan', 15);
            $table->decimal('hpp', 12, 0)->nullable();
            $table->decimal('stok_sistem', 12, 3);
            $table->decimal('stok_fisik', 12, 3);
            $table->decimal('selisih_stok', 12, 3);
            $table->decimal('selisih_hpp', 12, 0);
            $table->foreignId('ket_stok_id')->nullable()->constrained('tb_keterangan_stok');

            $table->unique(['stok_opname_id', 'produk_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_stok_opname_detail');
    }
};
// DONE