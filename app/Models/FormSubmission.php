<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_formulario',
        'nombre',
        'email',
        'telefono',
        'codigo_pais',
        'ciudad',
        'vehiculo',
        'mensaje',
        'receive_offers',
        'categoria_vehiculo',
        'slug_vehiculo',
        'datos_completos',

        // Campos nuevos para Tecnom CRM
        'tecnom_id',
        'error_tecnom',
        'status',
        'agent_assigned',
        'sent_to_crm_at',
        'last_attempt_at',
        'tecnom_response',
    ];

    protected $casts = [
        'datos_completos' => 'array',
        'tecnom_response' => 'array',
        'receive_offers' => 'boolean',
        'sent_to_crm_at' => 'datetime',
        'last_attempt_at' => 'datetime',
    ];

    // Constantes para estados
    const STATUS_PENDING = 'pending';
    const STATUS_SENT_TO_CRM = 'sent_to_crm';
    const STATUS_ERROR = 'error';

    // Scopes útiles
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeSentToCrm($query)
    {
        return $query->where('status', self::STATUS_SENT_TO_CRM);
    }

    public function scopeWithErrors($query)
    {
        return $query->where('status', self::STATUS_ERROR);
    }

    public function scopeByAgent($query, $agentEmail)
    {
        return $query->where('agent_assigned', $agentEmail);
    }

    // Accessors útiles
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            self::STATUS_PENDING => '<span class="badge badge-warning">Pendiente</span>',
            self::STATUS_SENT_TO_CRM => '<span class="badge badge-success">Enviado</span>',
            self::STATUS_ERROR => '<span class="badge badge-danger">Error</span>',
            default => '<span class="badge badge-secondary">Desconocido</span>'
        };
    }

    public function getIsSuccessfulAttribute()
    {
        return $this->status === self::STATUS_SENT_TO_CRM && !empty($this->tecnom_id);
    }

    public function getHasErrorsAttribute()
    {
        return $this->status === self::STATUS_ERROR || !empty($this->error_tecnom);
    }
}
