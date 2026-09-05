<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_stok_opname', function (Blueprint $table) {
            $table->id();
            $table->string('batch', 20)->unique()->nullable();
            $table->date('per_tanggal');
            $table->string('keterangan', 150)->nullable();
            $table->enum('status', ['draft', 'pending', 'approved'])->default('draft');
            $table->decimal('total_selisih_hpp', 12, 0);
            $table->foreignId('created_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_stok_opname');
    }
};
// DONE