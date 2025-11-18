<?php

namespace App\Livewire\Front;

use Livewire\Component;

class DireccionesSection extends Component
{
    public $layout = 'map-cards'; // map-cards, list-only
    public $sectionData = [];

    private $defaultSectionData = [
        'title' => 'DIRECCIONES',
        'subtitle' => 'Encuentra la sucursal Geely más cercana:',
        'map_image' => 'frontend/images/mapa Bolivia.jpg',
        'background_color' => '#ffffff',
        'text_color' => '#333333',
        'button_text' => 'Agenda ahora',
        'button_url' => '#',
        'show_map' => true,
        'show_button' => false,
        'locations' => [
            [
                'name' => 'SANTA CRUZ',
                'address' => 'Av. Doble Vía La Guardia N° 3325 Esq. Calle Rio Vilcas, entre 3er y 4to anillo ',
                'phone' => '',
                'hours' => '',
                'city' => 'Santa Cruz - Bolivia',
                'map_link' => 'https://maps.app.goo.gl/YQfPVMbUyNH6RjrU8',
                'icon' => 'location'
            ],
            [
                'name' => 'LA PAZ',
                'address' => 'Av. 6 de Marzo N° 1306 Frente Regimiento Ingavi ',
                'phone' => '',
                'hours' => '',
                'city' => 'El Alto - Bolivia',
                'map_link' => 'https://maps.app.goo.gl/veuGtGn2iECCP9Ez8',
                'icon' => 'location'
            ],
            [
                'name' => 'ORURO',
                'address' => 'Av. 6 de Agosto #853',
                'phone' => '',
                'hours' => '',
                'city' => 'Oruro - Bolivia',
                'map_link' => 'https://maps.app.goo.gl/DBPsGLxpBea5TroT6',
                'icon' => 'location'
            ]
        ]
    ];

    public function mount($layout = 'map-cards', $sectionData = [])
    {
        $this->layout = $layout;
        $this->sectionData = array_merge($this->defaultSectionData, $sectionData);
    }

    public function render()
    {
        return view('livewire.front.direcciones-section');
    }
}
