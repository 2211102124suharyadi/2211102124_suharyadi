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

Schema::create('cars', function (Blueprint $table) {
    $table->id();
    $table->foreignId('merk_id')->constrained('merks')->onDelete('cascade');
    $table->string('model');
    $table->string('color');
    $table->integer('year');
    $table->decimal('price', 15, 2);
    $table->string('image');  
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
