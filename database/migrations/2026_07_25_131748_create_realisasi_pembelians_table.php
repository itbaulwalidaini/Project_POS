<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_realisasi_pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 16);
            $table->foreignId('perencanaan_id')->nullable()->constrained('tb_perencanaan')->nullOnDelete();
            $table->enum('status', ['sukses', 'dibatalkan'])->default('sukses');
            $table->text('keterangan')->nullable();
            $table->decimal('total_belanja', 12, 0);
            $table->bigInteger('user_id');
            $table->foreignId('created_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_realisasi_pembelian');
    }
};
// DONE