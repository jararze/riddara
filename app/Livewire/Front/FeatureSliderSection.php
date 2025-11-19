<?php

namespace App\Livewire\Front;

use Livewire\Component;

class FeatureSliderSection extends Component
{
    public $currentSlide = 0;
    public $featureData = [];

    public $vehicle = [];

    public $sectionAvailable = true;

    private $defaultFeatureData = [
        'section_background' => 'bg-gray-100',
        'section_padding' => 'py-16',

        'header' => [
            'title' => 'POTENTE Y DINÁMICO',
            'title_size' => 'text-3xl lg:text-4xl',
            'title_color' => 'text-gray-900',
            'title_weight' => 'font-bold'
        ],

        'layout' => [
            'direction' => 'left', // left o right
            'main_image_size' => 'lg:col-span-2',
            'content_size' => 'lg:col-span-1'
        ],

        'slides' => [
            [
                'id' => 'motor-turbo',
                'title' => 'MOTOR 2.0 TURBO',
                'subtitle' => '2.0 Turbo Motor - 215 hp Potencia',
                'description' => 'Diseño ultra moderno y vanguardista que destaca en todos los espacios urbanos, citadinos y en los viajes más largos.',
                'main_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente0.jpg',
                'thumbnail_image' => 'frontend/images/vehicles/starray/potenteydinamico/Geely_Bolivia_Starray_Potente0.jpg',
                'background_overlay' => 'bg-gradient-to-r from-[#3B4C39]/80 to-transparent'
            ],
        ],


        'autoplay' => [
            'enabled' => false,
            'delay' => 7000
        ],

        'navigation' => [
            'dots_enabled' => true,
            'dots_container_class' => 'flex justify-center mt-8 space-x-2',
            'dots_style' => 'w-3 h-3 bg-gray-400 rounded-full',
            'active_dot_style' => 'w-8 h-3 bg-[#3B4C39] rounded-full'
        ]
    ];

    public function mount($vehicle = [], $section = 'potente_dinamico', $featureData = [])
    {
        $this->vehicle = $vehicle;

        $vehicleSlug = $vehicle['slug'] ?? 'default';
        $vehicleConfigs = $this->getVehicleConfig($vehicleSlug);

        // Obtener configuración de la sección específica
        $sectionConfig = $vehicleConfigs[$section] ?? null;

        // Si no existe la sección, marcar como no disponible
        if ($sectionConfig === null) {
            $this->sectionAvailable = false;
            return; // Salir temprano
        }

        $this->sectionAvailable = true;

        // Aplicar configuración: default -> vehicle -> custom
        $this->featureData = $this->defaultFeatureData;

        foreach (['section_background', 'header', 'layout', 'slides'] as $key) {
            if (isset($sectionConfig[$key])) {
                if (in_array($key, ['header', 'layout'])) {
                    $this->featureData[$key] = array_merge($this->featureData[$key], $sectionConfig[$key]);
                } else {
                    $this->featureData[$key] = $sectionConfig[$key];
                }
            }

        }

        $this->featureData['autoplay']['enabled'] = false;
        $this->currentSlide = 0;
    }
    private function getVehicleConfig($slug)
    {
        $configs = [
            'rd6-electrica-bev-pro-4x4' => [
                'potente_dinamico' => [
                    'header' => ['title' => 'Potencia y rendimiento'],
                    'layout' => ['direction' => 'left'],
                    'slides' => [
                        [
                            'id' => 'motor-turbo',
                            'title' => 'La más rápida del mercado',
                            'subtitle' => '',
                            'description' => 'Acelera de 0 a 100 en solo 4.3 segundos',
                            'main_image' => 'frontend/images/vehicles/rd6/potencia/RIDDARA_RD6_Bolivia_Potencia_Rendimiento_1.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/rd6/potencia/RIDDARA_RD6_Bolivia_Potencia_Rendimiento_1.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-[#3B4C39]/80 to-transparent'
                        ],
                        [
                            'id' => 'estabilidad-cma',
                            'title' => 'Ultra potente',
                            'subtitle' => '',
                            'description' => '315 kW / 422 Hp y carga directa de 30 a 80% en 32 minutos.',
                            'main_image' => 'frontend/images/vehicles/rd6/potencia/RIDDARA_RD6_Bolivia_Potencia_Rendimiento_2.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/rd6/potencia/RIDDARA_RD6_Bolivia_Potencia_Rendimiento_2.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                        ],
                        [
                            'id' => 'tecnologia-avanzada',
                            'title' => 'Versión 100% Eléctrica',
                            'subtitle' => '',
                            'description' => 'Autonomía de hasta 424 Km',
                            'main_image' => 'frontend/images/vehicles/rd6/potencia/RIDDARA_RD6_Bolivia_Potencia_Rendimiento_3.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/rd6/potencia/RIDDARA_RD6_Bolivia_Potencia_Rendimiento_3.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                        ],
                        [
                            'id' => 'motor-turbo1',
                            'title' => 'Versión híbrida',
                            'subtitle' => '',
                            'description' => 'Con tanque de combustible de 60 L',
                            'main_image' => 'frontend/images/vehicles/rd6/potencia/RIDDARA_RD6_Bolivia_Potencia_Rendimiento_4.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/rd6/potencia/RIDDARA_RD6_Bolivia_Potencia_Rendimiento_4.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-[#3B4C39]/80 to-transparent'
                        ],
                        [
                            'id' => 'estabilidad-cma1',
                            'title' => 'Control Inteligente ',
                            'subtitle' => '',
                            'description' => 'Una experiencia de conducción tan cómoda y suave como un SUV.',
                            'main_image' => 'frontend/images/vehicles/rd6/potencia/RIDDARA_RD6_Bolivia_Potencia_Rendimiento_5.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/rd6/potencia/RIDDARA_RD6_Bolivia_Potencia_Rendimiento_5.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                        ],
                    ]
                ],
                'interior_lujoso' => [
                    'header' => ['title' => 'Resistencia y durabilidad'],
                    'layout' => ['direction' => 'right'],
                    'slides' => [
                        [
                            'id' => 'interno-1',
                            'title' => 'Gran capacidad de carga y remolque',
                            'subtitle' => '',
                            'description' => '2500 KG de capacidad de remolque y 1.2 TON de carga',
                            'main_image' => 'frontend/images/vehicles/rd6/resistencia/RIDDARA_RD6_Bolivia_Resistencia_Durabilidad_1.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/rd6/resistencia/RIDDARA_RD6_Bolivia_Resistencia_Durabilidad_1.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-[#3B4C39]/80 to-transparent'
                        ],
                        [
                            'id' => 'interno-2a',
                            'title' => 'Suspensión independiente en las 4 ruedas',
                            'subtitle' => '',
                            'description' => 'Suspensión independiente MacPherson en la parte delantera y suspensión independiente multilink en la parte trasera.',
                            'main_image' => 'frontend/images/vehicles/rd6/resistencia/RIDDARA_RD6_Bolivia_Resistencia_Durabilidad_2.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/rd6/resistencia/RIDDARA_RD6_Bolivia_Resistencia_Durabilidad_2.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                        ],
                        [
                            'id' => 'interno-10',
                            'title' => 'Chasis reforzado',
                            'subtitle' => '',
                            'description' => 'Estructura con acero de alta resistencia.',
                            'main_image' => 'frontend/images/vehicles/rd6/resistencia/RIDDARA_RD6_Bolivia_Resistencia_Durabilidad_3.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/rd6/resistencia/RIDDARA_RD6_Bolivia_Resistencia_Durabilidad_3.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                        ],
                        [
                            'id' => 'interno-3',
                            'title' => 'Durabilidad comprobada',
                            'subtitle' => '',
                            'description' => 'Tres años de desarrollo, con más de un millón de kilómetros de prueba.',
                            'main_image' => 'frontend/images/vehicles/rd6/resistencia/RIDDARA_RD6_Bolivia_Resistencia_Durabilidad_4.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/rd6/resistencia/RIDDARA_RD6_Bolivia_Resistencia_Durabilidad_4.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                        ],
                    ]
                ],
                'seguridad' => [
                    'header' => ['title' => 'Diseño y equipamiento'],
                    'layout' => ['direction' => 'left'],
                    'slides' => [
                        [
                            'id' => 'seguridad-1',
                            'title' => 'Cluster en pantalla LED',
                            'subtitle' => '',
                            'description' => 'Tecnología y diseño de vanguardia que facilitan la visualización de la información al conducir.',
                            'main_image' => 'frontend/images/vehicles/rd6/seguridad/RIDDARA_RD6_Bolivia_Diseno_Equipamiento_1.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/rd6/seguridad/RIDDARA_RD6_Bolivia_Diseno_Equipamiento_1.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-[#3B4C39]/80 to-transparent'
                        ],
                        [
                            'id' => 'seguridad-2',
                            'title' => 'Tapicería de Cuero',
                            'subtitle' => '',
                            'description' => 'Elegantes acabados, suaves en tapicería de tipo cuero PVC de color negro.',
                            'main_image' => 'frontend/images/vehicles/rd6/seguridad/RIDDARA_RD6_Bolivia_Diseno_Equipamiento_2.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/rd6/seguridad/RIDDARA_RD6_Bolivia_Diseno_Equipamiento_2.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-purple-600/80 to-transparent'
                        ],
                        [
                            'id' => 'seguridad-3',
                            'title' => 'Descarga externa',
                            'subtitle' => '',
                            'description' => 'Ideal para el camping Cooler E-bikes ',
                            'main_image' => 'frontend/images/vehicles/rd6/seguridad/RIDDARA_RD6_Bolivia_Diseno_Equipamiento_3.jpg',
                            'thumbnail_image' => 'frontend/images/vehicles/rd6/seguridad/RIDDARA_RD6_Bolivia_Diseno_Equipamiento_3.jpg',
                            'background_overlay' => 'bg-gradient-to-r from-green-600/80 to-transparent'
                        ],

                    ]
                ]
            ],

        ];

        return $configs[$slug] ?? [];
    }

    public function goToSlide($index)
    {
        $this->currentSlide = $index;
    }

    public function nextSlide()
    {
        $totalSlides = count($this->featureData['slides']);
        $this->currentSlide = ($this->currentSlide + 1) % $totalSlides;

    }

    public function prevSlide()
    {
        $totalSlides = count($this->featureData['slides']);
        $this->currentSlide = ($this->currentSlide - 1 + $totalSlides) % $totalSlides;
    }

    public function getFirstVisibleThumbnailIndex()
    {
        // Buscar el primer índice que NO sea el slide actual
        for ($i = 0; $i < count($this->featureData['slides']); $i++) {
            if ($i !== $this->currentSlide) {
                return $i;
            }
        }
        return null;
    }


    public function getCurrentSlide()
    {
        $slide = $this->featureData['slides'][$this->currentSlide] ?? [];

        // Solo validar main_image hasta que implementes la validación en admin
        if (!isset($slide['main_image']) || empty($slide['main_image'])) {
            $slide['main_image'] = 'frontend/images/default-placeholder.png';
        }

        return $slide;
    }
    public function getOrderedThumbnails()
    {
        $totalSlides = count($this->featureData['slides']);
        $thumbnails = [];

        // Crear orden que asegure que todos los slides sean primer thumbnail
        for ($i = 1; $i < $totalSlides; $i++) {
            $index = ($this->currentSlide + $i) % $totalSlides;
            $thumbnails[] = [
                'index' => $index,
                'slide' => $this->featureData['slides'][$index]
            ];
        }

        return $thumbnails;
    }

    public function shouldShowDescription($thumbnailPosition, $direction = 'left')
    {
        if ($direction === 'right') {
            // En RIGHT, el último thumbnail (posición más alta) muestra descripción
            $totalThumbnails = count($this->featureData['slides']) - 1; // -1 porque uno está en principal
            return $thumbnailPosition === ($totalThumbnails - 1);
        }

        // En LEFT, el primer thumbnail (posición 0) muestra descripción
        return $thumbnailPosition === 0;
    }
    public function render()
    {
        return view('livewire.front.feature-slider-section');
    }
}
