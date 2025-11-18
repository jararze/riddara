<?php

namespace App\Livewire\Front;

use Livewire\Component;

class AboutSection extends Component
{

    public $layout = 'centered'; // centered, split-left, split-right, compact-left, compact-right
    public $sectionData = [];

    private $defaultSectionData = [
        'logo' => 'frontend/images/logo-negro.svg',
        'title' => 'Riddara ',
        'description' => 'En Riddara Bolivia, encuentra la energía que impulsa el futuro. Riddara es la marca de camionetas de nueva energía del grupo Geely, creada para transformar la conducción con tecnología inteligente y potencia eléctrica. Líder en pickups eléctricas en China, combina fuerza, eficiencia y confort con una visión sostenible para las necesidades de Bolivia. Sus modelos 100% eléctricos e híbridos integran diseño avanzado, tracción inteligente y un espíritu de libertad que redefine la experiencia al volante.',
        'button_text' => 'Descubre más',
        'button_url' => 'https://global.geely.com/',
        'background_color' => '#000000',
        'text_color' => '#fff',
        'car_image' => 'frontend/images/7080348 1.png',
        'car_alt' => 'Geely Starray',
        'image_height' => 'h-[400px] lg:h-[500px]', // Nueva configuración
        'image_classes' => 'w-full object-cover' // Clases base de imagen
    ];

    public function mount($layout = 'centered', $sectionData = [])
    {
        $this->layout = $layout;
        $this->sectionData = array_merge($this->defaultSectionData, $sectionData);
    }

    public function render()
    {
        return view('livewire.front.about-section');
    }
}
