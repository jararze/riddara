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
        Schema::table('form_submissions', function (Blueprint $table) {
            // Campos para integración con Tecnom CRM
            $table->string('tecnom_id')->nullable()->after('datos_completos')->comment('ID retornado por Tecnom CRM');
            $table->text('error_tecnom')->nullable()->after('tecnom_id')->comment('Mensaje de error de Tecnom CRM');
            $table->string('status')->default('pending')->after('error_tecnom')->comment('Estado del envío: pending, sent_to_crm, error');

            // Campo para el email del agente asignado
            $table->string('agent_assigned')->nullable()->after('status')->comment('Email del agente asignado según la ciudad');

            // Timestamps adicionales
            $table->timestamp('sent_to_crm_at')->nullable()->after('agent_assigned')->comment('Fecha y hora de envío exitoso al CRM');
            $table->timestamp('last_attempt_at')->nullable()->after('sent_to_crm_at')->comment('Última fecha de intento de envío');

            // Campos para tracking de respuesta de Tecnom
            $table->json('tecnom_response')->nullable()->after('last_attempt_at')->comment('Respuesta completa de Tecnom CRM');
            $table->integer('attempt_count')->default(0)->after('tecnom_response')->comment('Número de intentos de envío');

            // Índices para optimizar consultas
            $table->index('status');
            $table->index('tecnom_id');
            $table->index('agent_assigned');
            $table->index('sent_to_crm_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['tecnom_id']);
            $table->dropIndex(['agent_assigned']);
            $table->dropIndex(['sent_to_crm_at']);

            // Eliminar columnas
            $table->dropColumn([
                'tecnom_id',
                'error_tecnom',
                'status',
                'agent_assigned',
                'sent_to_crm_at',
                'last_attempt_at',
                'tecnom_response',
                'attempt_count'
            ]);
        });
    }
};
