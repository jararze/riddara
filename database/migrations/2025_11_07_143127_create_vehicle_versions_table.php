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
        Schema::create('vehicle_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');

            // Básico
            $table->string('name'); // "Starray Signature 1.5 Turbo"
            $table->string('code')->unique(); // "gk-2-0", "pro-mid-mt-1-5"
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);

            // Specs (lo que se muestra arriba)
            $table->string('engine_displacement')->nullable(); // "1.499 c.c. TURBO con 174 HP"
            $table->string('transmission')->nullable(); // "7 velocidades doble embrague"
            $table->string('drivetrain')->nullable(); // "FWD Delantera"
            $table->string('platform')->nullable(); // "CMA"

            // Pricing (tab PRECIO)
            $table->integer('year')->default(2026);
            $table->decimal('list_price', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('final_price', 10, 2);
            $table->string('currency')->default('$us.');

            // TAB MOTOR
            $table->string('motor_type')->nullable(); // "Motor Turbo de 4 cilindros"
            $table->string('horsepower')->nullable(); // "174 HP"
            $table->string('torque')->nullable(); // "290/2000-3500 (Nm/rpm)"
            $table->string('fuel_type')->nullable(); // "Gasolina"
            $table->string('city_consumption')->nullable(); // Consumo ciudad
            $table->string('highway_consumption')->nullable(); // Consumo carretera
            $table->string('emission_standard')->nullable(); // "Euro VI b"
            $table->string('traccion')->nullable(); // Para algunos modelos usan esto

            // TAB EQUIPAMIENTO
            $table->string('screen')->nullable(); // "Táctil HD 13.2""
            $table->text('screen_detail')->nullable(); // Detalles adicionales de pantalla
            $table->string('seats')->nullable(); // "Cuero sintético"
            $table->string('climate_control')->nullable(); // "Automático bi-zona"
            $table->string('camera')->nullable(); // "Reversa + HD 360°"
            $table->string('sensors')->nullable(); // "delantero y trasero"
            $table->text('connectivity')->nullable(); // "Bluetooth, MP3, Radio..."

            // TAB SEGURIDAD
            $table->string('airbags')->nullable(); // "6 bolsas de aire"
            $table->string('abs')->nullable(); // "ABS, EBD y BA"
            $table->string('stability_control')->nullable(); // "ESP"
            $table->string('brake_assist')->nullable(); // "BAS"
            $table->string('traction_control')->nullable(); // "TCS"
            $table->string('seatbelts')->nullable(); // "Pretensores y limitadores"

            // Imagen interior
            $table->string('interior_image')->nullable();

            $table->timestamps();

            $table->index(['vehicle_id', 'is_active', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_versions');
    }
};
