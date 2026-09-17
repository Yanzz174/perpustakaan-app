<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('borrowings', function (Blueprint $table) {
        $table->id();
        $table->string('borrow_code')->unique();
        $table->foreignId('member_id')->constrained()->cascadeOnDelete();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Petugas yang melayani
        $table->date('borrow_date');
        $table->date('return_date'); // Tanggal harus kembali
        $table->date('actual_return_date')->nullable(); // Tanggal pengembalian asli
        $table->enum('status', ['pending', 'dipinjam', 'dikembalikan', 'terlambat', 'ditolak'])->default('pending');
        $table->decimal('total_fine', 10, 2)->default(0); // Denda
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
