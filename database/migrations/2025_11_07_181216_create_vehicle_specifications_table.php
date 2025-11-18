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
        Schema::create('vehicle_specifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');

            $table->string('key'); // "Motor", "Potencia", "Año"
            $table->string('value'); // "Turbo 1.5L", "177 HP", "2024"
            $table->integer('order')->default(0);

            $table->timestamps();

            $table->index(['vehicle_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_specifications');
    }
};
