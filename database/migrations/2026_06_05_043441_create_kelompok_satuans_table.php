<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_kelompok_satuan', function (Blueprint $table) {
            $table->id();
            $table->string('tipe', 30);
            $table->foreignId('satuan_id')->constrained('tb_satuan')->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->timestamps();
            $table->unique(['tipe', 'satuan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_kelompok_satuan');
    }
};
// DONE