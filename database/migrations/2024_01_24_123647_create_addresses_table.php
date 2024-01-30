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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
            ->nullable()
            ->references('id')
            ->on('clients')
            ->cascadeOnDelete();
            $table->string('type');
            $table->string('city');
            $table->string('area');
            $table->string('buliding');
            $table->integer('appartment');
            $table->integer('floor');
            $table->string('street');
            $table->text('additional_directions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
