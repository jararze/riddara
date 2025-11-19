<?php

namespace App\Livewire\Front;

use Livewire\Component;

class Navigation extends Component
{
    public $isMenuOpen = false;
    public $isHomePage = false;

    public $logo = [
        'image' => 'frontend/images/logo-negro.png',
        'alt' => 'Riddara Bolivia',
    ];

    public function mount()
    {
        // Detectar si estamos en el home
        $this->isHomePage = request()->routeIs('home') || request()->is('/');
    }

    public function getMenuItemsProperty()
    {
        if ($this->isHomePage) {
            // Menú con anclas para el home
            return [
                [
                    'label' => 'Vehículos',
                    'url' => '#modelos',
                    'active' => false,
                    'has_dropdown' => true,
                    'dropdown_items' => [
                        ['label' => 'SUV', 'url' => '/vehiculos/suv'],
                        ['label' => 'Eléctricos', 'url' => '/vehiculos/electricos'],
                        ['label' => 'Camionetas', 'url' => '/vehiculos/camionetas']
                    ]
                ],
                [
                    'label' => 'Direcciones',
                    'url' => '#direcciones',
                    'active' => false,
                    'has_dropdown' => false
                ],
                [
                    'label' => 'Sobre Geely',
                    'url' => '#nosotros',
                    'active' => false,
                    'has_dropdown' => false
                ],
                [
                    'label' => 'Servicios',
                    'url' => '#servicios',
                    'active' => false,
                    'has_dropdown' => false
                ],
                [
                    'label' => 'Posventa',
                    'url' => '#posventa',
                    'active' => false,
                    'has_dropdown' => true,
                    'dropdown_items' => [
                        ['label' => 'Test Drive', 'url' => '#test-drive'],
                        ['label' => 'Beneficios', 'url' => '#beneficios'],
                        ['label' => 'Ver Todo', 'url' => '/posventa']
                    ]
                ],
                [
                    'label' => 'Contáctanos',
                    'url' => '#direcciones',
                    'active' => false,
                    'has_dropdown' => false
                ]
            ];
        } else {
            // Menú normal para otras páginas
            return [
                [
                    'label' => 'Vehículos',
                    'url' => '/vehiculos',
                    'active' => false,
                    'has_dropdown' => true,
                    'dropdown_items' => [
                        ['label' => 'SUV', 'url' => '/vehiculos/suv'],
                        ['label' => 'Eléctricos', 'url' => '/vehiculos/electricos'],
                        ['label' => 'Camionetas', 'url' => '/vehiculos/camionetas']
                    ]
                ],
                [
                    'label' => 'Direcciones',
                    'url' => '/direcciones',
                    'active' => false,
                    'has_dropdown' => false
                ],
                [
                    'label' => 'Sobre Geely',
                    'url' => '/sobre-geely',
                    'active' => false,
                    'has_dropdown' => false
                ],
                [
                    'label' => 'Noticias',
                    'url' => '/noticias',
                    'active' => false,
                    'has_dropdown' => false
                ],
                [
                    'label' => 'Posventa',
                    'url' => '/posventa',
                    'active' => false,
                    'has_dropdown' => true,
                    'dropdown_items' => [
                        ['label' => 'Servicio Técnico', 'url' => '/posventa/servicio'],
                        ['label' => 'Repuestos', 'url' => '/posventa/repuestos'],
                        ['label' => 'Garantía', 'url' => '/posventa/garantia']
                    ]
                ],
                [
                    'label' => 'Contáctanos',
                    'url' => '/contactanos',
                    'active' => false,
                    'has_dropdown' => false
                ]
            ];
        }
    }

    public function toggleMenu()
    {
        $this->isMenuOpen = !$this->isMenuOpen;
    }

    public function render()
    {
        return view('livewire.front.navigation');
    }
}
