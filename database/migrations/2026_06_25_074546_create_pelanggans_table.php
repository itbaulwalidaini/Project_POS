<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('id_pelanggan', 10)->nullable();
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('no_hp', 15);
            $table->text('alamat');
            $table->enum('level', ['bronze', 'silver', 'gold', 'platinum'])->default('bronze');
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('tb_user', 'id')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['id_pelanggan', 'deleted_at']);
            $table->unique(['no_hp', 'deleted_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_pelanggan');
    }
};
// DONE