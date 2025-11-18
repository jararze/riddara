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
        Schema::create('vehicle_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // SUV, ELECTRICOS
            $table->string('slug')->unique(); // suv, electricos
            $table->string('label'); // SUV, ELÉCTRICOS (para mostrar)
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);

            // Estilos (los que tienes hardcodeados)
            $table->string('active_color')->default('bg-purple-600 text-white');
            $table->string('inactive_color')->default('text-gray-600 hover:text-purple-600');
            $table->string('border_color')->default('border-purple-600');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_categories');
    }
};
