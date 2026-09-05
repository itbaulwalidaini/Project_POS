<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_perencanaan_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perencanaan_id')->constrained('tb_perencanaan')->cascadeOnDelete();
            $table->foreignId('produk_id')->constrained('tb_produk');
            $table->string('satuan', 15);
            $table->decimal('qty_rencana', 10,3);

            $table->unique(['perencanaan_id', 'produk_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_perencanaan_detail');
    }
};
// DONE