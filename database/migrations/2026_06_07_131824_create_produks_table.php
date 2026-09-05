<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_produk', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 10)->nullable();
            $table->string('barcode', 13)->nullable();
            $table->enum('jenis', ['internal','konsinyasi'])->default('internal');
            $table->string('nama', 150);
            $table->string('tipe', 30);
            $table->foreignId('kategori_id')->nullable()->constrained('tb_kategori', 'id');
            $table->foreignId('satuan_id')->nullable()->constrained('tb_satuan', 'id');
            $table->decimal('hpp', 12, 0)->nullable();
            $table->decimal('hjretail', 12, 0)->nullable();
            $table->decimal('hjmember', 12, 0)->nullable();
            $table->decimal('stok', 12, 3)->default(0);
            $table->decimal('stok_min', 12, 3);
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();

            // Unik meskipun data dihapus mempunyai deleted_at
            $table->unique(['nama', 'deleted_at']);
            $table->unique(['sku', 'deleted_at']);
            $table->unique(['barcode', 'deleted_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_produk');
    }
};
// DONE