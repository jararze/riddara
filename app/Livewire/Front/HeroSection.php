<?php

namespace App\Livewire\Front;

use Livewire\Component;

class HeroSection extends Component
{

    public $currentSlide = 0;
    public $videoProgress = 0; // Progreso del video (0-100)
    public $videoCurrentTime = 0;
    public $videoDuration = 0;
    public $isPaused = false;

    public $isMobile = false;

    public $heroConfig = [
        'autoplay' => true,
        'autoplay_interval' => 8000,
        'show_dots' => true,
        'show_arrows' => true,
        'pause_on_hover' => true,
        'show_video_controls' => true,

        'layout_config' => [
            'spacing' => 'space-y-4', // space-y-2, space-y-4, space-y-6, space-y-8
            'element_order' => ['title', 'subtitle', 'description', 'buttons'] // Orden personalizable
        ],

        'slides' => [

            [
                'id' => 1,
                'media_type' => 'image',
                'media_src' => 'frontend/images/Riddara-Bolivia-Camionetas-Electricas-Hero-banner-web.jpg',
                'media_src_mobile' => 'frontend/images/Riddara-Bolivia-Camionetas-Electricas-Hero-banner-mobile.jpg',
                'media_fit' => 'contain', // cover, contain, fill, scale-down
                'media_position' => 'left', // center, top, bottom, left, right
                'media_background' => 'bg-black', // Color de fondo si la imagen no cubre todo
                'object_position_mobile' => '50% 70%', // En móvil enfoca el auto (parte inferior)
                'object_position_desktop' => '50% 50%', // En desktop enfoca el centro
                'overlay_opacity' => 0.3,
                'only_image' => true,
                'buttons' => true,
                'show_title' => true,    // Ocultar título
                'show_subtitle' => true, // Ocultar subtítulo
                'show_description' => false, // Ocultar descripción

                'title' => [
                    'text' => 'Potencia Eléctrica Para el Futuro',
                    'highlight_text' => 'Potencia Eléctrica Para el Futuro',
                    'gradient_from' => '#FF5B00',  // Blanco
                    'gradient_to' => '#FF5B00',    // Free Orange
                    'font_size' => 'text-2xl md:text-4xl',
                    'font_weight' => 'font-bold',
                    'text_color' => 'text-white',
                    'position' => 'top-left',
                    'margin_top' => 'mt-20',
                    'margin_bottom' => 'mb-6',
                    'line_height' => 'leading-tight',
                    'letter_spacing' => 'tracking-normal',
                    'line_wrap' => 'nowrap',
                    'max_width' => 'max-w-none',
                ],

                'subtitle' => [
                    'text' => 'RIDDARA RD6: Línea de camionetas eléctricas e híbridas',
                    'font_size' => 'text-xl md:text-xl',
                    'font_weight' => 'font-light',
                    'text_color' => 'text-white/90',
                    'position' => 'top-left', // Independiente del título
                    'margin_top' => 'mt-0', // Margen superior
                    'margin_bottom' => 'mb-6', // Margen inferior
                    'line_wrap' => 'nowrap', // nowrap, wrap, break-words
                    'max_width' => 'max-w-none', // max-w-none para una línea, max-w-2xl para wrap
                ],


                'primary_button' => [
                    'text' => 'Descúbrelas',
                    'show' => true,
                    'style' => 'solid', // solid, outline, ghost
                    'bg_color' => 'bg-black',
                    'text_color' => 'text-white',
                    'hover_bg' => 'hover:bg-black/90',
                    'hover_scale' => 'hover:scale-105',
                    'size' => 'px-8 py-4 text-lg',
                    'font_weight' => 'font-semibold',
                    'border_radius' => 'rounded-lg',
                    'icon' => 'arrow-right',
                    'icon_position' => 'right', // left, right, none
                    'action' => 'scroll-to-models',
                    'line_wrap' => 'wrap',
                    'max_width' => 'max-w-2xl',
                ],


                'button_container' => [
                    'layout' => 'flex-col sm:flex-row',
                    'gap' => 'gap-4',
                    'position' => 'bottom-left', // Posición del contenedor de botones
                    'margin_top' => 'mt-0', // Margen superior
                    'margin_bottom' => 'mb-12', // Margen inferior
                ]
            ],

            [
                'id' => 2,
                'media_type' => 'image',
                'media_src' => 'frontend/images/Riddara-Bolivia-Camionetas-Electricas-Test-Drive-web.jpg',
                'media_src_mobile' => 'frontend/images/Riddara-Bolivia-Camionetas-Electricas-Test-Drive-mobile.jpg',
                'media_fit' => 'contain', // cover, contain, fill, scale-down
                'media_position' => 'center', // center, top, bottom, left, right
                'media_background' => 'bg-black', // Color de fondo si la imagen no cubre todo
                'object_position_mobile' => '50% 70%', // En móvil enfoca el auto (parte inferior)
                'object_position_desktop' => '50% 50%', // En desktop enfoca el centro
                'overlay_opacity' => 0.3,
                'show_title' => true,    // Ocultar título
                'show_subtitle' => true, // Ocultar subtítulo
                'show_description' => false, // Ocultar descripción

                'title' => [
                    'text' => 'Potencia Eléctrica Para el Futuro',
                    'highlight_text' => 'Potencia Eléctrica Para el Futuro',
                    'gradient_from' => '#FF5B00',  // Blanco
                    'gradient_to' => '#FF5B00',    // Free Orange
                    'font_size' => 'text-2xl md:text-4xl',
                    'font_weight' => 'font-bold',
                    'text_color' => 'text-white',
                    'position' => 'top-left',
                    'margin_top' => 'mt-20',
                    'margin_bottom' => 'mb-6',
                    'line_height' => 'leading-tight',
                    'letter_spacing' => 'tracking-normal',
                    'line_wrap' => 'nowrap',
                    'max_width' => 'max-w-none',
                ],

                'subtitle' => [
                    'text' => 'RIDDARA RD6: Línea de camionetas eléctricas e híbridas',
                    'font_size' => 'text-xl md:text-xl',
                    'font_weight' => 'font-light',
                    'text_color' => 'text-white/90',
                    'position' => 'top-left', // Independiente del título
                    'margin_top' => 'mt-0', // Margen superior
                    'margin_bottom' => 'mb-6', // Margen inferior
                    'line_wrap' => 'nowrap', // nowrap, wrap, break-words
                    'max_width' => 'max-w-none', // max-w-none para una línea, max-w-2xl para wrap
                ],


                'primary_button' => [
                    'text' => 'Descúbrelas',
                    'show' => true,
                    'style' => 'solid', // solid, outline, ghost
                    'bg_color' => 'bg-black',
                    'text_color' => 'text-white',
                    'hover_bg' => 'hover:bg-black/90',
                    'hover_scale' => 'hover:scale-105',
                    'size' => 'px-8 py-4 text-lg',
                    'font_weight' => 'font-semibold',
                    'border_radius' => 'rounded-lg',
                    'icon' => 'arrow-right',
                    'icon_position' => 'right', // left, right, none
                    'action' => 'scroll-to-models',
                    'line_wrap' => 'wrap',
                    'max_width' => 'max-w-2xl',
                ],


                'button_container' => [
                    'layout' => 'flex-col sm:flex-row',
                    'gap' => 'gap-4',
                    'position' => 'bottom-left', // Posición del contenedor de botones
                    'margin_top' => 'mt-0', // Margen superior
                    'margin_bottom' => 'mb-12', // Margen inferior
                ]
            ],

        ]
    ];

    public function updateVideoProgress($currentTime, $duration)
    {
        $this->videoCurrentTime = $currentTime;
        $this->videoDuration = $duration;
        $this->videoProgress = $duration > 0 ? ($currentTime / $duration) * 100 : 0;
    }

    public function videoEnded()
    {
        $this->nextSlide();
    }

    public function isOnlyImage($slide)
    {
        return isset($slide['only_image']) && $slide['only_image'] === true;
    }

    public function mount()
    {
        $this->isMobile = $this->detectMobile();
    }

    private function detectMobile()
    {
        $userAgent = request()->header('User-Agent');
        return preg_match('/(android|iphone|ipad|mobile)/i', $userAgent);
    }

    public function pauseVideo()
    {
        $this->isPaused = true;
        $this->dispatch('pause-video');
    }

    public function playVideo()
    {
        $this->isPaused = false;
        $this->dispatch('play-video');
    }

    public function nextSlide()
    {
        $this->currentSlide = ($this->currentSlide + 1) % count($this->heroConfig['slides']);
        $this->videoProgress = 0;
        $this->videoCurrentTime = 0;
        $this->videoDuration = 0;
    }

    public function prevSlide()
    {
        $this->currentSlide = $this->currentSlide > 0 ? $this->currentSlide - 1 : count($this->heroConfig['slides']) - 1;
        $this->videoProgress = 0;
        $this->videoCurrentTime = 0;
        $this->videoDuration = 0;
    }

    public function goToSlide($index)
    {
        $this->currentSlide = $index;
        $this->videoProgress = 0;
        $this->videoCurrentTime = 0;
        $this->videoDuration = 0;
    }

    public function render()
    {
        return view('livewire.front.hero-section');
    }
}
