<?php

namespace App\Livewire\Front;

use App\Models\Vehicle;
use App\Models\VehicleSpecification;
use App\Models\VehicleFeature;
use Livewire\Component;

class VehicleDetail extends Component
{
    public $vehicleSlug;
    public $categorySlug;
    public $vehicle;
    public $relatedVehicles = [];

    public function mount($category, $slug)
    {
        $this->categorySlug = $category;
        $this->vehicleSlug = $slug;

        // Buscar vehículo en la BD
        $this->vehicle = $this->findVehicle($slug);

        if (!$this->vehicle) {
            abort(404, 'Vehículo no encontrado');
        }

        // Obtener vehículos relacionados
        $this->relatedVehicles = $this->getRelatedVehicles($this->vehicle['category_id'], $this->vehicle['id']);
    }

    private function findVehicle($slug)
    {
        $vehicleModel = Vehicle::with(['category', 'specifications', 'features'])
            ->where('slug', $slug)
            ->active()
            ->first();

        if (!$vehicleModel) {
            return null;
        }

        // Formatear para la vista (mantener estructura original)
        return [
            'id' => $vehicleModel->id,
            'slug' => $vehicleModel->slug,
            'name' => $vehicleModel->name,
            'description' => $vehicleModel->description,
            'long_description' => $vehicleModel->long_description,
            'image' => $vehicleModel->image,
            'gallery' => $vehicleModel->gallery ?? [],
            'category' => $vehicleModel->category->name, // SUV, ELECTRICOS
            'category_id' => $vehicleModel->category->id,
            'featured' => $vehicleModel->featured,

            'pricing' => [
                'currency_before' => $vehicleModel->currency_before,
                'price_before' => $vehicleModel->price_before,
                'currency_now' => $vehicleModel->currency_now,
                'price_now' => $vehicleModel->price_now,
                'discount_label' => $vehicleModel->discount_label,
                'from_label' => $vehicleModel->from_label,
            ],

            // Especificaciones desde la tabla vehicle_specifications
            'specifications' => $vehicleModel->specifications()
                ->ordered()
                ->get()
                ->pluck('value', 'key')
                ->toArray(),

            // Features desde la tabla vehicle_features
            'features' => $vehicleModel->features()
                ->ordered()
                ->get()
                ->pluck('feature')
                ->toArray(),
        ];
    }

    private function getRelatedVehicles($categoryId, $excludeId, $limit = 3)
    {
        return Vehicle::where('vehicle_category_id', $categoryId)
            ->where('id', '!=', $excludeId)
            ->active()
            ->ordered()
            ->limit($limit)
            ->get()
            ->map(function ($vehicle) {
                return [
                    'id' => $vehicle->id,
                    'slug' => $vehicle->slug,
                    'name' => $vehicle->name,
                    'description' => $vehicle->description,
                    'image' => $vehicle->image,
                    'category' => $vehicle->category->slug,
                    'pricing' => [
                        'currency_now' => $vehicle->currency_now,
                        'price_now' => $vehicle->price_now,
                    ],
                ];
            })
            ->toArray();
    }

    public function requestTestDrive()
    {
        session()->flash('message', 'Solicitud de test drive enviada correctamente.');
    }

    public function requestQuote()
    {
        session()->flash('message', 'Solicitud de cotización enviada correctamente.');
    }

    public function render()
    {
        return view('livewire.front.vehicle-detail')
            ->layout('components.layouts.frontend.front');
    }
}
