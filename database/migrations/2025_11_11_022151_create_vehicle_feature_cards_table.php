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
        Schema::create('vehicle_feature_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');

            $table->string('title'); // "Lujo", "Tecnología"
            $table->string('subtitle'); // "Acabados premium"
            $table->string('image'); // Ruta de la imagen

            // Configuración visual
            $table->enum('text_position', ['bottom-left', 'bottom-center', 'bottom-right', 'center', 'top-left', 'top-right'])
                ->default('bottom-left');
            $table->string('text_color')->default('#ffffff');
            $table->string('overlay')->default('bg-black bg-opacity-30');
            $table->boolean('hover_effect')->default(true);

            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['vehicle_id', 'is_active', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_feature_cards');
    }
};
