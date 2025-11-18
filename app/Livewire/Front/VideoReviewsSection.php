<?php

namespace App\Livewire\Front;

use Livewire\Component;

class VideoReviewsSection extends Component
{

    public $currentSlide = 0;
    public $videosData = [];
    public $vehicle = [];

    private $defaultVideosData = [
        'section_background' => 'bg-black',
        'section_padding' => 'py-16',

        'header' => [
            'title' => 'VIDEOS Y RESEÑAS',
            'subtitle' => 'Conoce todo sobre Geely Starray con los siguientes videos',
            'title_size' => 'text-3xl lg:text-4xl',
            'subtitle_size' => 'text-lg',
            'title_color' => 'text-white',
            'subtitle_color' => 'text-gray-300'
        ],

        'videos' => [
            [
                'id' => 'video-1',
                'title' => 'This is where the ride can get for your video',
                'subtitle' => 'REVIEW GX3 PRO',
                'channel' => 'CARS & LIFESTYLES',
                'thumbnail' => '/frontend/images/1.png',
                'video_url' => 'https://www.youtube-nocookie.com/embed/POBCHlhgO0Q?rel=0&modestbranding=1',
                'duration' => '05:31',
                'views' => '125K views'
            ],
        ],

        'autoplay' => [
            'enabled' => true,
            'delay' => 6000
        ],

        'navigation' => [
            'dots_container_class' => 'flex justify-center mt-8',
            'dots_wrapper_class' => 'bg-gray-800 rounded-full px-4 py-2 flex space-x-2',
            'dots_style' => 'w-3 h-3 bg-gray-500 hover:bg-gray-400 rounded-full',
            'active_dot_style' => 'w-8 h-3 bg-blue-500 rounded-full'
        ]
    ];

    public function mount($vehicle = [], $videosData = [])
    {
        $this->vehicle = $vehicle;

        // Obtener configuración específica del vehículo ANTES del merge
        $vehicleSlug = $vehicle['slug'] ?? 'default';
        $vehicleConfig = $this->getVehicleConfig($vehicleSlug);

        // Merge con orden de prioridad: default -> vehicle -> custom
        $this->videosData = array_merge($this->defaultVideosData, $vehicleConfig, $videosData);
        $this->currentSlide = 0;
    }

    private function getVehicleConfig($slug)
    {
        $configs = [
            'starray' => [
                'header' => [
                    'title' => 'VIDEOS Y RESEÑAS',
                    'subtitle' => 'Conoce todo sobre Geely Starray con los siguientes videos',
                    'title_size' => 'text-3xl lg:text-4xl',
                    'subtitle_size' => 'text-lg',
                    'title_color' => 'text-white',
                    'subtitle_color' => 'text-gray-300'
                ],

                'videos' => [
                    [
                        'id' => 'video-1',
                        'title' => 'This is where the ride can get for your video',
                        'subtitle' => 'REVIEW STARRAY',
                        'channel' => 'Reseñas',
                        'thumbnail' => '/frontend/images/1.png',
                        'video_url' => 'https://www.youtube.com/embed/XFKtYQuqWPI',
                        'duration' => '05:31',
                        'views' => '125K views'
                    ],
                    [
                        'id' => 'video-2',
                        'title' => 'This is where the ride can get for your video',
                        'subtitle' => 'REVIEW STARRAY',
                        'channel' => 'Reseñas',
                        'thumbnail' => '/frontend/images/1.png',
                        'video_url' => 'https://www.youtube.com/embed/Bi1i4T8tMGM?si=TA5Vvy3PptKLwG5p',
                        'duration' => '05:31',
                        'views' => '125K views'
                    ],
                ],
            ],

            'gx3-pro' => [
                'header' => [
                    'title' => 'VIDEOS Y RESEÑAS',
                    'subtitle' => 'Conoce todo sobre Geely GX3 PRO con los siguientes videos',
                    'title_size' => 'text-3xl lg:text-4xl',
                    'subtitle_size' => 'text-lg',
                    'title_color' => 'text-white',
                    'subtitle_color' => 'text-gray-300'
                ],

                'videos' => [
                    [
                        'id' => 'video-1',
                        'title' => 'This is where the ride can get for your video',
                        'subtitle' => 'REVIEW GX3 PRO',
                        'channel' => 'Reseñas',
                        'thumbnail' => '/frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3_PRO_Portada_Reviews.jpg',
                        'video_url' => 'https://www.youtube.com/embed/631B54-0P80?si=foam_lPDmAwoHR5G',
                        'duration' => '05:31',
                        'views' => '125K views'
                    ],
                    [
                        'id' => 'video-2',
                        'title' => 'This is where the ride can get for your video',
                        'subtitle' => 'REVIEW GX3 PRO',
                        'channel' => 'Reseñas',
                        'thumbnail' => '/frontend/images/vehicles/gx3pro/Geely_Bolivia_GX3_PRO_Portada_Reviews.jpg',
                        'video_url' => 'https://www.youtube.com/embed/8oVUOlZtQ9U?si=Ov1jSCoJ26OrX2nM',
                        'duration' => '05:31',
                        'views' => '125K views'
                    ],
                ],
            ],

            'cityray' => [
                'header' => [
                    'title' => 'VIDEOS Y RESEÑAS',
                    'subtitle' => 'Conoce todo sobre Geely CITYRAY con los siguientes videos',
                    'title_size' => 'text-3xl lg:text-4xl',
                    'subtitle_size' => 'text-lg',
                    'title_color' => 'text-white',
                    'subtitle_color' => 'text-gray-300'
                ],

                'videos' => [
                    [
                        'id' => 'video-1',
                        'title' => 'This is where the ride can get for your video',
                        'subtitle' => 'REVIEW CITYRAY',
                        'channel' => 'Reseñas',
                        'thumbnail' => '/frontend/images/vehicles/cityray/Geely Cityray Review Poratada.jpg',
                        'video_url' => 'https://www.youtube.com/embed/fcVfqc5WCHc?si=WIvSDGyFGt73yByX',
                        'duration' => '05:31',
                        'views' => '125K views'
                    ],
                ],
            ],

            'coolray' => [
                'header' => [
                    'title' => 'VIDEOS Y RESEÑAS',
                    'subtitle' => 'Conoce todo sobre Geely COOLRAY con los siguientes videos',
                    'title_size' => 'text-3xl lg:text-4xl',
                    'subtitle_size' => 'text-lg',
                    'title_color' => 'text-white',
                    'subtitle_color' => 'text-gray-300'
                ],

                'videos' => [
                    [
                        'id' => 'video-1',
                        'title' => 'This is where the ride can get for your video',
                        'subtitle' => 'REVIEW COOLRAY',
                        'channel' => 'Reseñas',
                        'thumbnail' => '/frontend/images/vehicles/coolray/GEELY_BOLIVIA_PORTADA VIDEO.png',
                        'video_url' => 'https://www.youtube.com/embed/Nc0YfZ8V0Mw?si=vgXDbQiE-KlljUlq',
                        'duration' => '05:31',
                        'views' => '125K views'
                    ],
                ],
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
        $totalSlides = count($this->videosData['videos']);
        $this->currentSlide = ($this->currentSlide + 1) % $totalSlides;
    }

    public function prevSlide()
    {
        $totalSlides = count($this->videosData['videos']);
        $this->currentSlide = ($this->currentSlide - 1 + $totalSlides) % $totalSlides;
    }

    public function getCurrentVideo()
    {
        return $this->videosData['videos'][$this->currentSlide] ?? [];
    }

    public function playVideo($videoId)
    {
        // Aquí puedes agregar lógica para abrir el video
        session()->flash('message', 'Reproduciendo video...');
    }
    public function render()
    {
        return view('livewire.front.video-reviews-section');
    }
}
