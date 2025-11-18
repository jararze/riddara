<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleCategory extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
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
