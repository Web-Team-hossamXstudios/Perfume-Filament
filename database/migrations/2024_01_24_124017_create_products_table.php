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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
            ->nullable()
            ->references('id')
            ->on('categories')
            ->onDelete('set null');
            $table->string('name');
            $table->string('description');
            $table->integer('stock');
            $table->decimal('price');
            $table->boolean('is_feature');
            $table->boolean('is_active');
            $table->string('tags');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
