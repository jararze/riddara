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
        Schema::create('purchased_vehicle_forms', function (Blueprint $table) {
            $table->id();

            // Datos personales obligatorios
            $table->string('first_name');
            $table->string('last_name');
            $table->string('second_last_name');
            $table->enum('gender', ['masculino', 'femenino', 'otro']);
            $table->string('nationality');
            $table->string('id_document'); // carnet o pasaporte
            $table->date('birth_date');
            $table->string('mobile_phone');
            $table->string('email');

            // Preferencias de comunicación
            $table->boolean('wants_promotions')->default(false);
            $table->boolean('promo_whatsapp')->default(false);
            $table->boolean('promo_email')->default(false);
            $table->boolean('promo_sms')->default(false);
            $table->boolean('no_promotions')->default(false);

            // Dirección
            $table->string('city');
            $table->string('neighborhood');
            $table->text('full_address');

            // Estado civil y familia
            $table->enum('marital_status', ['soltero', 'casado', 'divorciado', 'viudo']);
            $table->boolean('has_children');
            $table->integer('number_of_children')->nullable();

            // Información laboral y vehículo
            $table->string('work_field');
            $table->string('sales_advisor_name');
            $table->string('purchased_vehicle');
            $table->text('vehicle_attractive_feature');

            // Campos opcionales
            $table->json('hobbies')->nullable();
            $table->enum('education_level', ['primaria', 'secundaria', 'universitario', 'postgrado'])->nullable();
            $table->enum('main_driver', ['yo', 'conyuge', 'hijo', 'otro'])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchased_vehicle_forms');
    }
};
