<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleSpecification extends Model
{
    protected $guarded = [];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
