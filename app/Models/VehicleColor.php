<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleColor extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relación: Pertenece a una versión
    public function version()
    {
        return $this->belongsTo(VehicleVersion::class, 'vehicle_version_id');
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
}
