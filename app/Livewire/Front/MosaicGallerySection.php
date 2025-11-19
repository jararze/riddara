<?php

namespace App\Livewire\Front;

use Livewire\Component;

class MosaicGallerySection extends Component
{

    public $galleryData = [];
    public $vehicle = [];

    private $defaultGalleryData = [
        'section_background' => 'bg-white',
        'section_padding' => 'pt-16',

        'header' => [
            'title' => 'GALERÍA DE IMÁGENES',
            'title_size' => 'text-3xl lg:text-4xl',
            'title_color' => 'text-gray-900',
            'title_weight' => 'font-bold',
            'show_header' => true
        ],

        'layout' => [
            'columns' => 3,
            'gap' => 'gap-0',
            'container_height' => 'h-[700px]'
        ],

        'images' => [
            // Columna 1 (2 filas)
            [
                'column' => 1,
                'row_span' => 1,
                'image' => 'frontend/images/mosaico/1.png',
                'alt' => 'Interior detail',
                'overlay' => false
            ],
        ]
    ];

    public function mount($vehicle = [], $galleryData = [])
    {
        $this->vehicle = $vehicle;
        $vehicleSlug = $vehicle['slug'] ?? 'default';

        $vehicleConfig = $this->getVehicleConfig($vehicleSlug);
        $this->galleryData = array_merge($this->defaultGalleryData, $vehicleConfig, $galleryData);
    }

    private function getVehicleConfig($slug)
    {
        $configs = [
            'rd6-electrica-bev-pro-4x4' => [
                'layout' => [
                    'columns' => 3,
                    'gap' => 'gap-0',
                    'container_height' => 'h-[700px]'
                ],

                'images' => [
                    // Columna 1 (2 filas)
                    [
                        'column' => 1,
                        'row_span' => 1,
                        'image' => 'frontend/images/vehicles/rd6/mosaico/RIDDARA_RD6_Bolivia_Galeria_1.jpg',
                        'alt' => 'Interior detail',
                        'overlay' => false
                    ],
                    [
                        'column' => 1,
                        'row_span' => 1,
                        'image' => 'frontend/images/vehicles/rd6/mosaico/RIDDARA_RD6_Bolivia_Galeria_2.jpg',
                        'alt' => 'Seat detail',
                        'overlay' => false
                    ],
                    // Columna 2 (1 fila completa)
                    [
                        'column' => 2,
                        'row_span' => 2,
                        'image' => 'frontend/images/vehicles/rd6/mosaico/RIDDARA_RD6_Bolivia_Galeria_5.jpg',
                        'alt' => 'Car front view',
                        'overlay' => false
                    ],
                    // Columna 3 (2 filas)
                    [
                        'column' => 3,
                        'row_span' => 1,
                        'image' => 'frontend/images/vehicles/rd6/mosaico/RIDDARA_RD6_Bolivia_Galeria_4.jpg',
                        'alt' => 'Grille detail',
                        'overlay' => false
                    ],
                    [
                        'column' => 3,
                        'row_span' => 1,
                        'image' => 'frontend/images/vehicles/rd6/mosaico/RIDDARA_RD6_Bolivia_Galeria_3.jpg',
                        'alt' => 'Dashboard',
                        'overlay' => false
                    ]
                ]
            ],


        ];

        return $configs[$slug] ?? [];
    }

    public function getImagesByColumn($column)
    {
        return collect($this->galleryData['images'])
            ->where('column', $column)
            ->values();
    }

    public function render()
    {
        return view('livewire.front.mosaic-gallery-section');
    }
}
