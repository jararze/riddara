<?php

namespace App\Livewire\Front;

use App\Models\Vehicle;
use App\Models\VehicleFeatureCard;
use Livewire\Component;

class VehicleFeatures extends Component
{
    public $layout = 'three-columns';
    public $featuresData = [];
    public $vehicle = [];

    // Configuración por defecto (estática)
    private $defaultFeaturesData = [
        'section_background' => 'bg-gray-50',
        'section_padding' => 'py-16',

        'header' => [
            'title' => 'EL SUV ULTRA MODERNO',
            'title_color' => '#1f2937',
            'title_size' => 'text-3xl lg:text-4xl',
            'title_weight' => 'font-bold',
            'subtitle' => '3 Razones para elegir este vehículo:',
            'subtitle_color' => '#6b7280',
            'subtitle_size' => 'text-lg',
            'text_align' => 'text-left',
            'margin_bottom' => 'mb-12'
        ],

        'grid_settings' => [
            'gap' => 'gap-0',
            'columns_mobile' => 'grid-cols-2',
            'columns_tablet' => 'md:grid-cols-2',
            'columns_desktop' => 'lg:grid-cols-3',
            'aspect_ratio' => 'aspect-[4/3]'
        ]
    ];

    public function mount($vehicle = [], $layout = 'three-columns', $featuresData = [])
    {
        $this->vehicle = $vehicle;
        $this->layout = $layout;

        // Cargar configuración desde BD
        $vehicleSlug = $vehicle['slug'] ?? null;

        if ($vehicleSlug) {
            $vehicleConfig = $this->loadVehicleFeatures($vehicleSlug);
        } else {
            $vehicleConfig = [];
        }

        // Merge: default -> vehicle -> custom
        $defaultHeader = $this->defaultFeaturesData['header'];
        $vehicleHeader = $vehicleConfig['header'] ?? [];
        $customHeader = $featuresData['header'] ?? [];
        $mergedHeader = array_merge($defaultHeader, $vehicleHeader, $customHeader);

        $this->featuresData = array_merge($this->defaultFeaturesData, $vehicleConfig, $featuresData);
        $this->featuresData['header'] = $mergedHeader;
    }

    /**
     * Cargar features desde la BD
     */
    private function loadVehicleFeatures($slug)
    {
        $vehicleModel = Vehicle::where('slug', $slug)->first();

        if (!$vehicleModel) {
            return [];
        }

        // Cargar feature cards desde BD
        $featureCards = VehicleFeatureCard::where('vehicle_id', $vehicleModel->id)
            ->active()
            ->ordered()
            ->get();

        if ($featureCards->isEmpty()) {
            return [];
        }

        // Formatear para la vista
        $features = $featureCards->map(function ($card) {
            return [
                'id' => $card->id,
                'title' => $card->title,
                'subtitle' => $card->subtitle,
                'image' => $card->image,
                'text_position' => $card->text_position,
                'text_color' => $card->text_color,
                'text_background' => 'bg-black bg-opacity-50',
                'overlay' => $card->overlay,
                'hover_effect' => $card->hover_effect,
            ];
        })->toArray();

        // Header personalizado según vehículo
        $headerTitles = [
            'starray' => [
                'title' => 'EL SUV ULTRA MODERNO',
                'subtitle' => '3 Razones para elegir a Geely Starray:',
            ],
            'gx3-pro' => [
                'title' => 'Multiplica tus posibilidades',
                'subtitle' => '3 razones para elegir a Geely GX3 Pro:',
            ],
            'cityray' => [
                'title' => 'El SUV Tecnológico',
                'subtitle' => '3 razones para elegir a Geely Cityray:',
            ],
            'coolray' => [
                'title' => 'Donde lo urbano se vuelve Premium',
                'subtitle' => '3 razones para elegir a Geely COOLRAY',
            ],
        ];

        $customHeader = $headerTitles[$slug] ?? [
            'title' => 'Características destacadas',
            'subtitle' => '3 razones para elegir este vehículo:',
        ];

        return [
            'header' => array_merge($this->defaultFeaturesData['header'], $customHeader),
            'features' => $features,
        ];
    }

    public function render()
    {
        return view('livewire.front.vehicle-features');
    }
}
