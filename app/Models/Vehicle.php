<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $guarded = [];

    protected $casts = [
        'gallery' => 'array',
        'featured' => 'boolean',
        'is_active' => 'boolean',
        'show_from_label' => 'boolean',
        'show_badge' => 'boolean',
    ];

    // Relación: Pertenece a una categoría
    public function category()
    {
        return $this->belongsTo(VehicleCategory::class, 'vehicle_category_id');
    }

    // Relación: Tiene muchas versiones
    public function versions()
    {
        return $this->hasMany(VehicleVersion::class);
    }

    // Relación: Tiene muchas especificaciones
    public function specifications()
    {
        return $this->hasMany(VehicleSpecification::class);
    }

    // Relación: Tiene muchos features
    public function features()
    {
        return $this->hasMany(VehicleFeature::class);
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

    public function scopeByCategory($query, $categorySlug)
    {
        return $query->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    // Método helper para formato de pricing (para la vista)
    public function getPricingAttribute()
    {
        return [
            'currency_before' => $this->currency_before,
            'price_before' => $this->price_before,
            'price_before_color' => $this->price_before_color,
            'price_before_decoration' => $this->price_before_decoration,
            'currency_now' => $this->currency_now,
            'price_now' => $this->price_now,
            'price_now_color' => $this->price_now_color,
            'price_now_size' => $this->price_now_size,
            'price_now_weight' => $this->price_now_weight,
            'discount_label' => $this->discount_label,
            'discount_label_color' => $this->discount_label_color,
            'show_from_label' => $this->show_from_label,
            'from_label' => $this->from_label,
        ];
    }

    // Método helper para botón
    public function getButtonPrimaryAttribute()
    {
        return [
            'text' => 'Ver modelo',
            'bg_color' => $this->button_bg_color,
            'text_color' => $this->button_text_color,
            'hover_bg' => $this->button_hover_bg,
            'size' => 'px-8 py-3',
            'border_radius' => 'rounded-lg',
            'font_weight' => 'font-medium',
            'show' => true
        ];
    }

    // Método helper para features/badge
    public function getFeaturesAttribute()
    {
        return [
            'show_badge' => $this->show_badge,
            'badge_text' => $this->badge_text,
            'badge_color' => $this->badge_color,
            'badge_position' => $this->badge_position,
        ];
    }

    public function featureCards()
    {
        return $this->hasMany(VehicleFeatureCard::class);
    }
}
