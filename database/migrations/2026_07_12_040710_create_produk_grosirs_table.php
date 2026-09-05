<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_produk_grosir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('tb_produk')->cascadeOnDelete();
            $table->decimal('qty_min', 12, 3);
            $table->decimal('qty_max', 12, 3)->nullable();
            $table->decimal('hjgrosir', 12, 0);
            $table->timestamps();

            $table->unique(['produk_id', 'qty_min']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_produk_grosir');
    }
};
// DONE