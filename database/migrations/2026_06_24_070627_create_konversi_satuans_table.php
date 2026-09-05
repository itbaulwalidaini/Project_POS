<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_konversi_satuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('tb_produk')->cascadeOnDelete();
            $table->unsignedInteger('level')->default(0);
            $table->foreignId('satuan_id')->nullable()->constrained('tb_satuan');
            $table->decimal('konversi', 12, 3);
            $table->timestamps();

            $table->unique(['produk_id', 'satuan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_konversi_satuan');
    }
};
// DONE