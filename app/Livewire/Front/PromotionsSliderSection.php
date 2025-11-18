<?php

namespace App\Livewire\Front;

use Livewire\Component;

class PromotionsSliderSection extends Component
{

    public $currentSlide = 0;
    public $promotionsData = [];
    public $vehicle = [];

    private $defaultPromotionsData = [
        'section_background' => 'bg-gray-50',
        'section_padding' => 'py-16',

        'header' => [
            'title' => 'PROMOCIONES Y OFERTAS',
            'subtitle' => 'Por Pre-venta',
            'title_size' => 'text-3xl lg:text-4xl',
            'subtitle_size' => 'text-lg'
        ],

        'slides' => [
            [
                'id' => 'starray-50-discount',
                'title' => '$us. 1,000',
                'subtitle' => 'DE DESCUENTO',
                'description' => 'Aprovecha los precios de lanzamiento para comprar tu Geely Starray. Válido en todas sus versiones.',
                'vehicle_model' => 'STARRAY',
                'vehicle_subtitle' => 'El SUV ultra moderno',
                'background_color' => 'bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300',
                'text_color' => 'text-gray-800',
                'title_gradient' => 'bg-gradient-to-r from-blue-500 to-[#3B4C39] bg-clip-text text-transparent',
                'image' => 'frontend/images/prom1.png',
                'button' => [
                    'text' => 'Obtener promo',
                    'style' => 'bg-white text-[#3B4C39] hover:bg-gray-100'
                ]
            ],
//            [
//                'id' => 'starray-financing',
//                'title' => '0%',
//                'subtitle' => 'DE INTERÉS',
//                'description' => 'Financiamiento especial a 48 meses. Sin enganche. Válido para todos los modelos SUV.',
//                'vehicle_model' => 'STARRAY',
//                'vehicle_subtitle' => 'TECNOLOGÍA HÍBRIDA AVANZADA',
//                'background_color' => 'bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300',
//                'text_color' => 'text-gray-800',
//                'title_gradient' => 'bg-gradient-to-r from-blue-500 to-[#3B4C39] bg-clip-text text-transparent',
//                'image' => 'frontend/images/prom1.png',
//                'button' => [
//                    'text' => 'Más información',
//                    'style' => 'bg-white text-green-600 hover:bg-gray-100'
//                ]
//            ],
//            [
//                'id' => 'starray-exchange',
//                'title' => 'TU AUTO',
//                'subtitle' => 'COMO PARTE DE PAGO',
//                'description' => 'Recibe hasta $15,000 adicionales por tu vehículo usado. Evaluación gratuita incluida.',
//                'vehicle_model' => 'STARRAY',
//                'vehicle_subtitle' => 'PROGRAMA DE INTERCAMBIO',
//                'background_color' => 'bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300',
//                'text_color' => 'text-gray-800',
//                'title_gradient' => 'bg-gradient-to-r from-blue-500 to-[#3B4C39] bg-clip-text text-transparent',
//                'image' => 'frontend/images/prom1.png',
//                'button' => [
//                    'text' => 'Evaluar mi auto',
//                    'style' => 'bg-white text-purple-600 hover:bg-gray-100'
//                ]
//            ]
        ],

        'autoplay' => [
            'enabled' => true,
            'delay' => 5000 // 5 segundos
        ],

        'navigation' => [
            'dots_style' => 'w-3 h-3 bg-gray-400 hover:bg-gray-500 rounded-full',
            'active_dot_style' => 'w-8 h-3 bg-[#3B4C39] rounded-full',
            'arrows_enabled' => true,
            'dots_container_class' => 'flex justify-center mt-6',
            'dots_wrapper_class' => 'bg-gray-200 rounded-full px-4 py-2 flex space-x-2'
        ]
    ];

    public function mount($vehicle = [], $promotionsData = [])
    {
        $this->vehicle = $vehicle;

        // Obtener configuración específica del vehículo ANTES del merge
        $vehicleSlug = $vehicle['slug'] ?? 'default';
        $vehicleConfig = $this->getVehicleConfig($vehicleSlug);

        // Merge con orden de prioridad: default -> vehicle -> custom
        $this->promotionsData = array_merge($this->defaultPromotionsData, $vehicleConfig, $promotionsData);
        $this->currentSlide = 0;
    }

    private function getVehicleConfig($slug)
    {
        $configs = [
            'starray' => [
                'slides' => [
                    [
                        'id' => 'starray-50-discount',
                        'title' => '$us. 1,000',
                        'subtitle' => 'DE DESCUENTO',
                        'description' => 'Aprovecha los precios de lanzamiento para comprar tu Geely Starray. Válido en todas sus versiones.',
                        'vehicle_model' => 'STARRAY',
                        'vehicle_subtitle' => 'El SUV ultra moderno',
                        'background_color' => 'bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300',
                        'text_color' => 'text-gray-800',
                        'title_gradient' => 'bg-gradient-to-r from-blue-500 to-[#3B4C39] bg-clip-text text-transparent',
                        'image' => 'frontend/images/prom1.png',
                        'button' => [
                            'text' => 'Obtener promo',
                            'style' => 'bg-white text-[#3B4C39] hover:bg-gray-100'
                        ]
                    ],
                ],
            ],

            'gx3-pro' => [
                'slides' => [
                    [
                        'id' => 'gx3pro-50-discount',
                        'title' => '$us. 500',
                        'subtitle' => 'DE DESCUENTO',
                        'description' => 'Aprovecha los precios de lanzamiento para comprar tu Geely GX3 Pro. Válido en todas sus versiones.',
                        'vehicle_model' => 'Gx3 Pro',
                        'vehicle_subtitle' => 'El SUV ultra moderno',
                        'background_color' => 'bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300',
                        'text_color' => 'text-gray-800',
                        'title_gradient' => 'bg-gradient-to-r from-blue-500 to-[#3B4C39] bg-clip-text text-transparent',
                        'image' => 'frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3_PRO_Promo.png',
                        'button' => [
                            'text' => 'Obtener promo',
                            'style' => 'bg-white text-[#3B4C39] hover:bg-gray-100'
                        ]
                    ],
                ]
            ],

            'cityray' => [
                'slides' => [
                    [
                        'id' => 'cityray-50-discount',
                        'title' => '$us. 2000',
                        'subtitle' => 'DE DESCUENTO',
                        'description' => 'Aprovecha los precios de Lanzamiento para comprar tu Geely Cityray. Valido en todas sus versiones. ',
                        'vehicle_model' => 'CITYRAY',
                        'vehicle_subtitle' => 'El SUV tecnológico',
                        'background_color' => 'bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300',
                        'text_color' => 'text-gray-800',
                        'title_gradient' => 'bg-gradient-to-r from-blue-500 to-[#3B4C39] bg-clip-text text-transparent',
                        'image' => 'frontend/images/vehicles/cityray/Geely_Bolivia_Promociones.png',
                        'button' => [
                            'text' => 'Obtener promo',
                            'style' => 'bg-white text-[#3B4C39] hover:bg-gray-100'
                        ]
                    ],
                ]
            ],

            'coolray' => [
                'slides' => [
                    [
                        'id' => 'coolray-50-discount',
                        'title' => 'Por Pre-venta ',
                        'subtitle' => '$us. 1500 DE DESCUENTO',
                        'description' => 'Es tu momento de estrenar un Geely Coolray con precios de lanzamiento.',
                        'vehicle_model' => 'COOLRAY',
                        'vehicle_subtitle' => 'SUV PERFECTA PARA LA VIDA URBANA',
                        'background_color' => 'bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300',
                        'text_color' => 'text-gray-800',
                        'title_gradient' => 'bg-gradient-to-r from-blue-500 to-[#3B4C39] bg-clip-text text-transparent',
                        'image' => 'frontend/images/vehicles/coolray/GEELY_BOLIVIA_COOLRAY_DESCUENTOS.png',
                        'button' => [
                            'text' => 'Obtener promo',
                            'style' => 'bg-white text-[#3B4C39] hover:bg-gray-100'
                        ]
                    ],
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
        $totalSlides = count($this->promotionsData['slides']);
        $this->currentSlide = ($this->currentSlide + 1) % $totalSlides;
    }

    public function prevSlide()
    {
        $totalSlides = count($this->promotionsData['slides']);
        $this->currentSlide = ($this->currentSlide - 1 + $totalSlides) % $totalSlides;
    }

    public function getCurrentSlide()
    {
        return $this->promotionsData['slides'][$this->currentSlide] ?? [];
    }

    public function claimPromotion($slideId)
    {
        session()->flash('message', 'Promoción solicitada correctamente. Te contactaremos pronto.');
    }
    public function render()
    {
        return view('livewire.front.promotions-slider-section');
    }
}
