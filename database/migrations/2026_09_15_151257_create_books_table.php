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
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained()->cascadeOnDelete();
        $table->string('isbn')->unique();
        $table->string('title');
        $table->string('author');
        $table->string('publisher');
        $table->year('publication_year');
        $table->integer('total_stock')->default(0);
        $table->integer('available_stock')->default(0);
        $table->string('rack_location')->nullable();
        $table->string('cover_image')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
