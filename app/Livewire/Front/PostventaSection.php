<?php

namespace App\Livewire\Front;

use Livewire\Component;

class PostventaSection extends Component
{

    public $layout = 'split-right'; // split-right, compact, overlay-left
    public $sectionData = [];

    private $defaultSectionData = [
        'title' => 'POSVENTA',
        'subtitle' => '',
        'description' => 'En Riddara Bolivia, disfruta 5 años de garantía extendida, 6 mantenimientos incluidos y garantía de batería por 8 años. Además, todos nuestros modelos incluyen un cargador de 2.2 kW para acompañarte desde el primer día.Nuestro servicio técnico especializado está preparado para cuidar tu Riddara con la precisión que exigen la nuevas energías. Te acompañamos en cada carga, cada ruta y cada kilómetro. ',
        'button_text' => 'Agenda ahora',
        'button_url' => '#',
        'building_image' => 'frontend/images/geely-building.png',
        'building_image_mobile' => 'frontend/images/Geely_Bolivia_building_mobile.jpg',
        'background_color' => '#ffffff',
        'text_color' => '#333333',
        'show_image' => true,
        'section_height' => 'min-h-[500px]',
        'image_classes' => 'w-full h-full object-cover'
    ];

    public function mount($layout = 'split-right', $sectionData = [])
    {
        $this->layout = $layout;
        $this->sectionData = array_merge($this->defaultSectionData, $sectionData);
    }
    public function render()
    {
        return view('livewire.front.postventa-section');
    }
}
