<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_keterangan_stok', function (Blueprint $table) {
            $table->id();
            $table->string('caption', 50);
            $table->enum('referensi', ['opname', 'penyesuaian', 'all']);
            $table->text('deskripsi')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->softDeletes(); 
            $table->timestamps();

            $table->unique(['caption', 'deleted_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_keterangan_stok');
    }
};
// DONE