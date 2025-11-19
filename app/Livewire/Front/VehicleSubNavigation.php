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
            'starray' => [
                ['id' => 'starray', 'label' => 'Starray', 'anchor' => '#hero', 'active' => true],
                ['id' => 'versiones', 'label' => 'Versiones', 'anchor' => '#versiones', 'active' => true],
                ['id' => 'tecnologia', 'label' => 'Tecnología', 'anchor' => '#tecnologia', 'active' => true],
                ['id' => 'diseno', 'label' => 'Diseño', 'anchor' => '#diseno', 'active' => true]
            ],

            'gx3-pro' => [
                ['id' => 'gx3pro', 'label' => 'Gx3 Pro', 'anchor' => '#hero', 'active' => true],
                ['id' => 'versiones', 'label' => 'Versiones', 'anchor' => '#versiones', 'active' => true],
                ['id' => 'tecnologia', 'label' => 'Tecnología', 'anchor' => '#tecnologia', 'active' => true],
                ['id' => 'diseno', 'label' => 'Diseño', 'anchor' => '#diseno', 'active' => true]
            ],

            'cityray' => [
                ['id' => 'cityray', 'label' => 'Cityray', 'anchor' => '#hero', 'active' => true],
                ['id' => 'versiones', 'label' => 'Versiones', 'anchor' => '#versiones', 'active' => true],
                ['id' => 'tecnologia', 'label' => 'Tecnología', 'anchor' => '#tecnologia', 'active' => true],
                ['id' => 'diseno', 'label' => 'Diseño', 'anchor' => '#diseno', 'active' => true]
            ],

            'coolray' => [
                ['id' => 'coolray', 'label' => 'Coolray', 'anchor' => '#hero', 'active' => true],
                ['id' => 'versiones', 'label' => 'Versiones', 'anchor' => '#versiones', 'active' => true],
                ['id' => 'tecnologia', 'label' => 'Tecnología', 'anchor' => '#tecnologia', 'active' => true],
                ['id' => 'diseno', 'label' => 'Diseño', 'anchor' => '#diseno', 'active' => true]
            ],

            'rd6-electrica-bev-pro-4x4' => [
                ['id' => 'RD6 BEV PRO', 'label' => 'RD6 BEV PRO', 'anchor' => '#hero', 'active' => true],
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
