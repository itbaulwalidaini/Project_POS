<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_satuan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->string('kode', 20);
            $table->text('deskripsi')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['nama', 'deleted_at']);
            $table->unique(['kode', 'deleted_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_satuan');
    }
};
// DONE