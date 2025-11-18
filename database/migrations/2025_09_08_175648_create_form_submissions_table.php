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
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_formulario'); // test-drive, cotizacion, consulta
            $table->string('nombre');
            $table->string('email');
            $table->string('telefono');
            $table->string('codigo_pais');
            $table->string('ciudad');
            $table->string('vehiculo')->nullable();
            $table->text('mensaje')->nullable();
            $table->boolean('receive_offers')->default(false);
            $table->string('categoria_vehiculo')->nullable();
            $table->string('slug_vehiculo')->nullable();
            $table->json('datos_completos')->nullable(); // Para guardar todo el array
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_submissions');
    }
};
