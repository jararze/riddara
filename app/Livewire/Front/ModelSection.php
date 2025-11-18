<?php

namespace App\Livewire\Front;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Livewire\Component;

class ModelSection extends Component
{
    public $currentSlide = 0;
    public $activeCategory = 'ELECTRICOS';
    public $totalSlides = 0;
    public $currentIndex = 0;
    public $totalVehicles = 0;

    public $modelsConfig = [
        'section_settings' => [
            'background_color' => 'bg-white',
            'padding_y' => 'py-0',
            'show_arrows' => true,
            'autoplay' => false,
            'autoplay_interval' => 5000,
        ],

        'header' => [
            'title' => 'MODELOS',
            'subtitle_mobile' => 'Desliza para conocer la línea de vehículos Geely disponible en Bolivia.',
            'title_color' => 'text-gray-900',
            'title_size' => 'text-4xl md:text-5xl',
            'title_weight' => 'font-bold',
            'subtitle' => 'Desliza para conocer la línea de vehículos Geely disponible en Bolivia.',
            'subtitle_color' => 'text-gray-600',
            'subtitle_size' => 'text-lg',
            'subtitle_max_width' => 'max-w-2xl',
            'text_align' => 'text-center',
            'margin_bottom' => 'mb-16'
        ],
    ];

    public function mount(): void
    {
        // Cargar categorías desde BD
        $this->modelsConfig['categories'] = $this->loadCategories();

        // Cargar vehículos desde BD
        $this->modelsConfig['vehicles'] = $this->loadAllVehicles();

        $this->updateTotalVehicles();
    }

    /**
     * Cargar categorías desde la BD
     */
    private function loadCategories()
    {
        return VehicleCategory::active()
            ->ordered()
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->name, // SUV, ELECTRICOS
                    'label' => $category->label,
                    'active_color' => $category->active_color,
                    'inactive_color' => $category->inactive_color,
                    'border_color' => $category->border_color,
                ];
            })
            ->toArray();
    }

    /**
     * Cargar TODOS los vehículos agrupados por categoría
     */
    private function loadAllVehicles()
    {
        $categories = VehicleCategory::active()->ordered()->get();
        $vehiclesByCategory = [];

        foreach ($categories as $category) {
            $vehicles = Vehicle::where('vehicle_category_id', $category->id)
                ->active()
                ->ordered()
                ->get();

            $vehiclesByCategory[$category->name] = $vehicles->map(function ($vehicle) {
                return [
                    'id' => $vehicle->id,
                    'slug' => $vehicle->slug,
                    'category' => $vehicle->category->slug,
                    'name' => $vehicle->name,
                    'description' => $vehicle->description,
                    'image' => $vehicle->image,
                    'position' => $vehicle->position,
                    'featured' => $vehicle->featured,

                    'pricing' => [
                        'currency_before' => $vehicle->currency_before,
                        'price_before' => $vehicle->price_before,
                        'price_before_color' => $vehicle->price_before_color,
                        'price_before_decoration' => $vehicle->price_before_decoration,
                        'currency_now' => $vehicle->currency_now,
                        'price_now' => $vehicle->price_now,
                        'price_now_color' => $vehicle->price_now_color,
                        'price_now_size' => $vehicle->price_now_size,
                        'price_now_weight' => $vehicle->price_now_weight,
                        'discount_label' => $vehicle->discount_label,
                        'discount_label_color' => $vehicle->discount_label_color,
                        'show_from_label' => $vehicle->show_from_label,
                        'from_label' => $vehicle->from_label,
                    ],

                    'button_primary' => [
                        'text' => 'Ver modelo',
                        'bg_color' => $vehicle->button_bg_color,
                        'text_color' => $vehicle->button_text_color,
                        'hover_bg' => $vehicle->button_hover_bg,
                        'size' => 'px-8 py-3',
                        'border_radius' => 'rounded-lg',
                        'font_weight' => 'font-medium',
                        'show' => true
                    ],

                    'features' => [
                        'show_badge' => $vehicle->show_badge,
                        'badge_text' => $vehicle->badge_text,
                        'badge_color' => $vehicle->badge_color,
                        'badge_position' => $vehicle->badge_position,
                    ]
                ];
            })->toArray();
        }

        return $vehiclesByCategory;
    }

    private function updateTotalVehicles(): void
    {
        $this->totalVehicles = count($this->modelsConfig['vehicles'][$this->activeCategory] ?? []);
    }

    public function setActiveCategory($category)
    {
        $this->activeCategory = $category;
        $this->currentIndex = 0;
        $this->updateTotalVehicles();
    }

    public function nextSlide()
    {
        $vehicles = $this->modelsConfig['vehicles'][$this->activeCategory] ?? [];
        $totalVehicles = count($vehicles);

        if ($totalVehicles > 0) {
            $this->currentIndex = ($this->currentIndex + 1) % $totalVehicles;
        }
    }

    public function prevSlide()
    {
        $vehicles = $this->modelsConfig['vehicles'][$this->activeCategory] ?? [];
        $totalVehicles = count($vehicles);

        if ($totalVehicles > 0) {
            $this->currentIndex = $this->currentIndex > 0 ? $this->currentIndex - 1 : $totalVehicles - 1;
        }
    }

    public function getCurrentSet()
    {
        $vehicles = $this->modelsConfig['vehicles'][$this->activeCategory] ?? [];
        $total = count($vehicles);

        if ($total === 0) return [];

        $prev = ($this->currentIndex - 1 + $total) % $total;
        $current = $this->currentIndex;
        $next = ($this->currentIndex + 1) % $total;

        return [
            'left' => $vehicles[$prev],
            'center' => $vehicles[$current],
            'right' => $vehicles[$next]
        ];
    }

    public function goToSlide($index): void
    {
        $this->currentIndex = $index;
    }

    public function render()
    {
        return view('livewire.front.model-section');
    }
}
