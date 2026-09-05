<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->foreignId('parent_id')->nullable()->constrained('tb_kategori')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->softDeletes(); 
            $table->timestamps();

            $table->unique(['nama', 'parent_id', 'deleted_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_kategori');
    }
};
// DONE