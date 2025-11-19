<?php

namespace App\Livewire\Front;

use Livewire\Component;

class VehicleSubNavigation extends Component
{

    public $activeSection = '';
    public $menuItems = [];
    public $vehicle = [];

    private $defaultMenuItems = [
        [
            'id' => 'starray',
            'label' => 'Starray',
            'anchor' => '#hero',
            'active' => true
        ],
        [
            'id' => 'versiones',
            'label' => 'Versiones',
            'anchor' => '#versiones',
            'active' => false
        ],
        [
            'id' => 'tecnologia',
            'label' => 'Tecnología',
            'anchor' => '#tecnologia',
            'active' => false
        ],
        [
            'id' => 'diseno',
            'label' => 'Diseño',
            'anchor' => '#diseno',
            'active' => false
        ]
    ];

    public function mount($vehicle = [], $menuItems = [])
    {
        $this->vehicle = $vehicle;
        $vehicleSlug = $vehicle['slug'] ?? 'default';
        $this->menuItems = empty($menuItems) ? $this->getVehicleConfig($vehicleSlug) : $menuItems;
        $this->activeSection = $this->menuItems[0]['id'] ?? '';

    }

    private function getVehicleConfig($slug)
    {
        $configs = [
            'rd6-electrica-bev-econ-4x2' => [
                ['id' => 'rd6-electrica-bev-econ-4x2', 'label' => 'RD6 BEV ECON', 'anchor' => '#hero', 'active' => true],
                ['id' => 'versiones', 'label' => 'Versiones', 'anchor' => '#versiones', 'active' => true],
                ['id' => 'tecnologia', 'label' => 'Tecnología', 'anchor' => '#tecnologia', 'active' => true],
                ['id' => 'diseno', 'label' => 'Diseño', 'anchor' => '#diseno', 'active' => true]
            ],

            'rd6-electrica-bev-econ-4x4' => [
                ['id' => 'rd6-electrica-bev-econ-4x4', 'label' => 'RD6 BEV ECON', 'anchor' => '#hero', 'active' => true],
                ['id' => 'versiones', 'label' => 'Versiones', 'anchor' => '#versiones', 'active' => true],
                ['id' => 'tecnologia', 'label' => 'Tecnología', 'anchor' => '#tecnologia', 'active' => true],
                ['id' => 'diseno', 'label' => 'Diseño', 'anchor' => '#diseno', 'active' => true]
            ],

            'rd6-hibrida-bev-phev-gl-4x4' => [
                ['id' => 'rd6-hibrida-bev-phev-gl-4x4', 'label' => 'RD6 BEV PHEV', 'anchor' => '#hero', 'active' => true],
                ['id' => 'versiones', 'label' => 'Versiones', 'anchor' => '#versiones', 'active' => true],
                ['id' => 'tecnologia', 'label' => 'Tecnología', 'anchor' => '#tecnologia', 'active' => true],
                ['id' => 'diseno', 'label' => 'Diseño', 'anchor' => '#diseno', 'active' => true]
            ],

            'rd6-hibrida-bev-phev-gs-4x4' => [
                ['id' => 'rd6-hibrida-bev-phev-gs-4x4', 'label' => 'RD6 BEV PHEV', 'anchor' => '#hero', 'active' => true],
                ['id' => 'versiones', 'label' => 'Versiones', 'anchor' => '#versiones', 'active' => true],
                ['id' => 'tecnologia', 'label' => 'Tecnología', 'anchor' => '#tecnologia', 'active' => true],
                ['id' => 'diseno', 'label' => 'Diseño', 'anchor' => '#diseno', 'active' => true]
            ],

            'rd6-electrica-bev-pro-4x4' => [
                ['id' => 'rd6-electrica-bev-pro-4x4', 'label' => 'RD6 BEV PRO', 'anchor' => '#hero', 'active' => true],
                ['id' => 'versiones', 'label' => 'Versiones', 'anchor' => '#versiones', 'active' => true],
                ['id' => 'tecnologia', 'label' => 'Tecnología', 'anchor' => '#tecnologia', 'active' => true],
                ['id' => 'diseno', 'label' => 'Diseño', 'anchor' => '#diseno', 'active' => true]
            ],
        ];

        return $configs[$slug] ?? [];
    }
    public function render()
    {
        return view('livewire.front.vehicle-sub-navigation');
    }
}
