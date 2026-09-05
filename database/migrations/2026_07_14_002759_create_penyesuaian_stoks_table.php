<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_penyesuaian_stok', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi', 15)->unique();
            $table->foreignId('produk_id')->constrained('tb_produk');
            $table->decimal('hpp', 12, 0);
            $table->enum('jenis', ['stok_masuk', 'stok_keluar']);
            $table->decimal('stok_awal', 12, 3);
            $table->decimal('stok_pny', 12, 3);
            $table->decimal('stok_akhir', 12, 3);
            $table->foreignId('ket_stok_id')->nullable()->constrained('tb_keterangan_stok');
            $table->decimal('total_hpp', 12, 0);
            $table->foreignId('created_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_penyesuaian_stok');
    }
};
// DONE