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
            'starray' => [
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
                    [
                        'column' => 1,
                        'row_span' => 1,
                        'image' => 'frontend/images/mosaico/2.jpg',
                        'alt' => 'Seat detail',
                        'overlay' => false
                    ],
                    // Columna 2 (1 fila completa)
                    [
                        'column' => 2,
                        'row_span' => 2,
                        'image' => 'frontend/images/mosaico/3.jpg',
                        'alt' => 'Car front view',
                        'overlay' => false
                    ],
                    // Columna 3 (2 filas)
                    [
                        'column' => 3,
                        'row_span' => 1,
                        'image' => 'frontend/images/mosaico/4.png',
                        'alt' => 'Grille detail',
                        'overlay' => false
                    ],
                    [
                        'column' => 3,
                        'row_span' => 1,
                        'image' => 'frontend/images/mosaico/5.png',
                        'alt' => 'Dashboard',
                        'overlay' => false
                    ]
                ]
            ],

            'gx3-pro' => [
                'layout' => [
                    'columns' => 2,
                    'gap' => 'gap-0',
                    'container_height' => 'h-[700px]'
                ],

                'images' => [
                    [
                        'column' => 1,
                        'row_span' => 1,
                        'image' => 'frontend/images/vehicles/gx3pro/mosaic/GX3 Pro Trasero.jpg',
                        'alt' => 'Interior detail',
                        'overlay' => false
                    ],
                    [
                        'column' => 1,
                        'row_span' => 1,
                        'image' => 'frontend/images/vehicles/gx3pro/mosaic/0_4-zoom_322a3488.jpg',
                        'alt' => 'Seat detail',
                        'overlay' => false
                    ],
                    [
                        'column' => 2,
                        'row_span' => 1,
                        'image' => 'frontend/images/vehicles/gx3pro/mosaic/GX3 Pro Diagonal.jpg',
                        'alt' => 'Grille detail',
                        'overlay' => false
                    ],
                    [
                        'column' => 2,
                        'row_span' => 1,
                        'image' => 'frontend/images/vehicles/gx3pro/mosaic/GX3 Pro Aro.jpg',
                        'alt' => 'Dashboard',
                        'overlay' => false
                    ]
                ]
            ],

            'cityray' => [
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
                        'image' => 'frontend/images/vehicles/cityray/mosaic/1.jpg',
                        'alt' => 'Interior detail',
                        'overlay' => false
                    ],
                    [
                        'column' => 1,
                        'row_span' => 1,
                        'image' => 'frontend/images/vehicles/cityray/mosaic/2.jpg',
                        'alt' => 'Seat detail',
                        'overlay' => false
                    ],
                    // Columna 2 (1 fila completa)
                    [
                        'column' => 2,
                        'row_span' => 2,
                        'image' => 'frontend/images/vehicles/cityray/mosaic/3.jpg',
                        'alt' => 'Car front view',
                        'overlay' => false
                    ],
                    // Columna 3 (2 filas)
                    [
                        'column' => 2,
                        'row_span' => 2,
                        'image' => 'frontend/images/vehicles/cityray/mosaic/4.jpg',
                        'alt' => 'Grille detail',
                        'overlay' => false
                    ],
                    [
                        'column' => 3,
                        'row_span' => 1,
                        'image' => 'frontend/images/vehicles/cityray/mosaic/5.jpg',
                        'alt' => 'Dashboard',
                        'overlay' => false
                    ],
                    [
                        'column' => 3,
                        'row_span' => 2,
                        'image' => 'frontend/images/vehicles/cityray/mosaic/6.jpg',
                        'alt' => 'Dashboard',
                        'overlay' => false
                    ]
                ]
            ],

            'coolray' => [
                'layout' => [
                    'columns' => 3,
                    'gap' => 'gap-0',
                    'container_height' => 'h-[700px]'
                ],

                'images' => [
                    [
                        'column' => 1,
                        'row_span' => 2,
                        'image' => 'frontend/images/vehicles/coolray/mosaic/1.jpg',
                        'alt' => 'Interior detail',
                        'overlay' => false
                    ],
                    [
                        'column' => 2,
                        'row_span' => 2,
                        'image' => 'frontend/images/vehicles/coolray/mosaic/2.jpg',
                        'alt' => 'Seat detail',
                        'overlay' => false
                    ],
                    [
                        'column' => 3,
                        'row_span' => 2,
                        'image' => 'frontend/images/vehicles/coolray/mosaic/3.jpg',
                        'alt' => 'Grille detail',
                        'overlay' => false
                    ],
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
