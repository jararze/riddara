<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleFeatureCard extends Model
{
    protected $guarded = [];

    protected $casts = [
        'hover_effect' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
