<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedVehicleForm extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'birth_date' => 'date',
        'wants_promotions' => 'boolean',
        'promo_whatsapp' => 'boolean',
        'promo_email' => 'boolean',
        'promo_sms' => 'boolean',
        'no_promotions' => 'boolean',
        'has_children' => 'boolean',
        'hobbies' => 'array',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name . ' ' . $this->second_last_name;
    }
}
