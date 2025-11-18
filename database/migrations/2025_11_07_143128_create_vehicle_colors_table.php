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
        Schema::create('vehicle_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_version_id')->constrained()->onDelete('cascade');

            $table->string('name'); // "Plata", "Negro", "Azul"
            $table->string('code'); // "silver", "negro", "azul"
            $table->string('hex_code'); // "#C0C0C0"
            $table->string('image'); // Ruta de la imagen
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['vehicle_version_id', 'is_active', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_colors');
    }
};
