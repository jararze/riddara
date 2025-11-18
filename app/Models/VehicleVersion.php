<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleVersion extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'list_price' => 'decimal:2',
        'discount' => 'decimal:2',
        'final_price' => 'decimal:2',
    ];

    // Relación: Pertenece a un vehículo
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Relación: Tiene muchos colores
    public function colors()
    {
        return $this->hasMany(VehicleColor::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    // Helper: Specs formateados
    public function getSpecsAttribute()
    {
        $specs = [];
        if ($this->engine_displacement) $specs['Cilindrada:'] = $this->engine_displacement;
        if ($this->transmission) $specs['Transmisión:'] = $this->transmission;
        if ($this->drivetrain) $specs['Tracción:'] = $this->drivetrain;
        if ($this->platform) $specs['Plataforma:'] = $this->platform;
        return $specs;
    }

    // Helper: Pricing formateado
    public function getPricingFormatAttribute()
    {
        return [
            'year' => $this->year,
            'list_price' => $this->list_price,
            'discount' => $this->discount,
            'final_price' => $this->final_price,
            'currency' => $this->currency,
        ];
    }

    // Helper: Tab content
    public function getTabContentAttribute()
    {
        return [
            'motor' => [
                'tipo_motor' => $this->motor_type,
                'potencia' => $this->horsepower,
                'torque' => $this->torque,
                'combustible' => $this->fuel_type,
                'consumo_ciudad' => $this->city_consumption,
                'consumo_carretera' => $this->highway_consumption,
                'traccion' => $this->traccion,
            ],
            'equipamiento' => [
                'pantalla' => $this->screen,
                'asientos' => $this->seats,
                'climatizador' => $this->climate_control,
                'camara' => $this->camera,
                'sensores' => $this->sensors,
                'conectividad' => $this->connectivity,
            ],
            'seguridad' => [
                'airbags' => $this->airbags,
                'abs' => $this->abs,
                'control_estabilidad' => $this->stability_control,
                'asistente_frenado' => $this->brake_assist,
                'control_traccion' => $this->traction_control,
                'cinturones' => $this->seatbelts,
            ]
        ];
    }
}
