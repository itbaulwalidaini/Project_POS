<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_perencanaan', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 9);
            $table->enum('status', ['draft', 'dibelanjakan'])->default('draft');
            $table->text('catatan')->nullable();
            $table->unsignedInteger('jumlah_item');
            $table->foreignId('created_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_perencanaan');
    }
};
// DONE