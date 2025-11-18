<?php

namespace App\Livewire\Front;

use Livewire\Component;

class SectionBreakerSection extends Component
{

    public $breakerData = [];
    public $vehicle = [];

    private $defaultBreakerData = [
        'section_background' => 'bg-gray-50',
        'section_padding' => 'py-20',

        'content' => [
            'title' => '¿QUÉ DESEAS HACER HOY?',
            'subtitle' => 'Explora todas las opciones disponibles para ti',
            'title_size' => 'text-3xl lg:text-4xl',
            'subtitle_size' => 'text-lg lg:text-xl',
            'title_color' => 'text-gray-900',
            'subtitle_color' => 'text-gray-600',
            'title_font_weight' => 'font-bold',
            'subtitle_font_weight' => 'font-normal',
            'text_align' => 'text-left',
            'max_width' => 'max-w-full',
            'spacing' => 'space-y-4'
        ],

        'styles' => [
            'title_gradient' => false,
            'title_gradient_colors' => 'bg-gradient-to-r from-[#3B4C39] to-blue-800 bg-clip-text text-transparent',
            'subtitle_gradient' => false,
            'subtitle_gradient_colors' => 'bg-gradient-to-r from-gray-600 to-gray-800 bg-clip-text text-transparent'
        ]
    ];

    public function mount($vehicle = [], $breakerData = [])
    {
        $this->vehicle = $vehicle;

        // Obtener configuración específica del vehículo
        $vehicleSlug = $vehicle['slug'] ?? 'default';
        $vehicleConfig = $this->getVehicleConfig($vehicleSlug);

        // Empezar con configuración por defecto
        $this->breakerData = $this->defaultBreakerData;

        // Aplicar configuración del vehículo
        if (isset($vehicleConfig['section_background'])) {
            $this->breakerData['section_background'] = $vehicleConfig['section_background'];
        }

        if (isset($vehicleConfig['section_padding'])) {
            $this->breakerData['section_padding'] = $vehicleConfig['section_padding'];
        }

        if (isset($vehicleConfig['content'])) {
            $this->breakerData['content'] = array_merge($this->breakerData['content'], $vehicleConfig['content']);
        }

        if (isset($vehicleConfig['styles'])) {
            $this->breakerData['styles'] = array_merge($this->breakerData['styles'], $vehicleConfig['styles']);
        }

        // Finalmente aplicar datos personalizados (prioridad más alta)
        if (isset($breakerData['section_background'])) {
            $this->breakerData['section_background'] = $breakerData['section_background'];
        }

        if (isset($breakerData['section_padding'])) {
            $this->breakerData['section_padding'] = $breakerData['section_padding'];
        }

        if (isset($breakerData['content'])) {
            $this->breakerData['content'] = array_merge($this->breakerData['content'], $breakerData['content']);
        }

        if (isset($breakerData['styles'])) {
            $this->breakerData['styles'] = array_merge($this->breakerData['styles'], $breakerData['styles']);
        }
    }

    private function getVehicleConfig($slug)
    {
        $configs = [
            'starray' => [
                'content' => [
                    'title' => 'GEELY STARRAY',
                    'subtitle' => 'Caracteristicas',
                    'title_size' => 'text-4xl lg:text-4xl',
                    'subtitle_size' => 'text-lg lg:text-xl',
                    'title_color' => 'text-[#3B4C39]',
                    'subtitle_color' => 'text-black',
                    'title_font_weight' => 'font-bold',
                    'subtitle_font_weight' => 'font-normal',
                    'text_align' => 'text-left',
                    'max_width' => 'max-w-full',
                    'spacing' => 'space-y-4'
                ],

                'styles' => [
                    'title_gradient' => false,
                    'title_gradient_colors' => 'bg-gradient-to-r from-[#3B4C39] to-blue-800 bg-clip-text text-transparent',
                    'subtitle_gradient' => false,
                    'subtitle_gradient_colors' => 'bg-gradient-to-r from-gray-600 to-gray-800 bg-clip-text text-transparent'
                ]
            ],

            'gx3-pro' => [
                'content' => [
                    'title' => 'GEELY GX3 PRO',
                    'subtitle' => 'Caracteristicas',
                    'title_size' => 'text-4xl lg:text-4xl',
                    'subtitle_size' => 'text-lg lg:text-xl',
                    'title_color' => 'text-blue-900',
                    'subtitle_color' => 'text-black',
                    'title_font_weight' => 'font-bold',
                    'subtitle_font_weight' => 'font-normal',
                    'text_align' => 'text-left',
                    'max_width' => 'max-w-full',
                    'spacing' => 'space-y-4'
                ],

                'styles' => [
                    'title_gradient' => false,
                    'title_gradient_colors' => 'bg-gradient-to-r from-[#3B4C39] to-blue-800 bg-clip-text text-transparent',
                    'subtitle_gradient' => false,
                    'subtitle_gradient_colors' => 'bg-gradient-to-r from-gray-600 to-gray-800 bg-clip-text text-transparent'
                ]
            ],

            'cityray' => [
                'content' => [
                    'title' => 'GEELY CITYRAY',
                    'subtitle' => 'Caracteristicas',
                    'title_size' => 'text-4xl lg:text-4xl',
                    'subtitle_size' => 'text-lg lg:text-xl',
                    'title_color' => 'text-blue-900',
                    'subtitle_color' => 'text-black',
                    'title_font_weight' => 'font-bold',
                    'subtitle_font_weight' => 'font-normal',
                    'text_align' => 'text-left',
                    'max_width' => 'max-w-full',
                    'spacing' => 'space-y-4'
                ],

                'styles' => [
                    'title_gradient' => false,
                    'title_gradient_colors' => 'bg-gradient-to-r from-[#3B4C39] to-blue-800 bg-clip-text text-transparent',
                    'subtitle_gradient' => false,
                    'subtitle_gradient_colors' => 'bg-gradient-to-r from-gray-600 to-gray-800 bg-clip-text text-transparent'
                ]
            ],

            'coolray' => [
                'content' => [
                    'title' => 'GEELY COOLRAY',
                    'subtitle' => 'Caracteristicas',
                    'title_size' => 'text-4xl lg:text-4xl',
                    'subtitle_size' => 'text-lg lg:text-xl',
                    'title_color' => 'text-blue-900',
                    'subtitle_color' => 'text-black',
                    'title_font_weight' => 'font-bold',
                    'subtitle_font_weight' => 'font-normal',
                    'text_align' => 'text-left',
                    'max_width' => 'max-w-full',
                    'spacing' => 'space-y-4'
                ],

                'styles' => [
                    'title_gradient' => false,
                    'title_gradient_colors' => 'bg-gradient-to-r from-[#3B4C39] to-blue-800 bg-clip-text text-transparent',
                    'subtitle_gradient' => false,
                    'subtitle_gradient_colors' => 'bg-gradient-to-r from-gray-600 to-gray-800 bg-clip-text text-transparent'
                ]
            ],
        ];

        return $configs[$slug] ?? [];
    }
    public function render()
    {
        return view('livewire.front.section-breaker-section');
    }
}
