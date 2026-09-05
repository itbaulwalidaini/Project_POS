<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_stok_awal_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stok_awal_id')->constrained('tb_stok_awal')->cascadeOnDelete();
            $table->foreignId('produk_id')->constrained('tb_produk');
            $table->decimal('total_beli', 15, 0);   
            $table->decimal('hpp', 12, 0);
            $table->string('satuan', 15);
            $table->string('satuan_konversi', 15)->nullable();
            $table->decimal('qty', 10, 3);  
            $table->decimal('isi_konversi', 10, 3)->nullable();
            $table->decimal('qty_konversi', 12, 3)->nullable();
            $table->decimal('qty_stok', 12, 3); 

            $table->unique(['stok_awal_id', 'produk_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_stok_awal_detail');
    }
};
// DONE