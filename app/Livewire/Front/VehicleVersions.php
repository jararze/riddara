<?php

namespace App\Livewire\Front;

use App\Models\Vehicle;
use App\Models\VehicleVersion;
use Livewire\Component;

class VehicleVersions extends Component
{
    public $selectedVersion;
    public $selectedView = 'exterior';
    public $selectedColor;
    public $selectedTab = 'precio';

    public $versionsData = [];
    public $vehicle = [];
    public $category;
    public $slug;

    private $defaultVersionsData = [
        'section_background' => 'bg-gray-100',
        'section_padding' => 'py-16',

        'header' => [
            'title' => 'VERSIONES Y PRECIOS',
            'subtitle' => 'Elige tu versión',
            'title_size' => 'text-3xl lg:text-4xl',
            'subtitle_size' => 'text-lg'
        ],

        'tabs' => [
            'precio' => ['label' => 'PRECIO', 'active' => true],
            'motor' => ['label' => 'MOTOR', 'active' => false],
            'equipamiento' => ['label' => 'EQUIPAMIENTO', 'active' => false],
            'seguridad' => ['label' => 'SEGURIDAD', 'active' => false]
        ],

        'buttons' => [
            'quote' => ['text' => 'Obtener Cotización', 'style' => 'bg-black text-white'],
            'catalog' => ['text' => 'Descargar Catálogo', 'style' => 'border border-gray-400 text-gray-700'],
            'test_drive' => ['text' => 'Agendar Test Drive', 'style' => 'border border-gray-400 text-gray-700'],
            'whatsapp' => ['text' => 'Consulta por Whatsapp', 'style' => 'border border-gray-400 text-gray-700'],
        ]
    ];

    public function mount($vehicle = [], $category, $slug, $versionsData = [])
    {
        $this->vehicle = $vehicle;
        $this->category = $category;
        $this->slug = $slug;

        // Cargar versiones desde BD
        $vehicleConfig = $this->loadVehicleVersions($slug);

        // Merge con datos default
        $this->versionsData = array_merge($this->defaultVersionsData, $vehicleConfig, $versionsData);

        // Seleccionar primera versión disponible
        if (!empty($this->versionsData['versions'])) {
            $this->selectedVersion = array_key_first($this->versionsData['versions']);

            // Inicializar primer color
            $currentVersion = $this->getCurrentVersion();
            if (isset($currentVersion['colors']) && !empty($currentVersion['colors'])) {
                $this->selectedColor = array_key_first($currentVersion['colors']);
            }
        }
    }

    /**
     * Cargar versiones desde la BD
     */
    private function loadVehicleVersions($slug)
    {
        $vehicleModel = Vehicle::where('slug', $slug)->first();

        if (!$vehicleModel) {
            return [];
        }

        // Cargar versiones con colores
        $versions = VehicleVersion::where('vehicle_id', $vehicleModel->id)
            ->with('colors')
            ->active()
            ->ordered()
            ->get();

        if ($versions->isEmpty()) {
            return [];
        }

        // Formatear para la vista
        $formattedVersions = [];

        foreach ($versions as $version) {
            $formattedVersions[$version->code] = [
                'name' => $version->name,
                'specs' => [
                    'Cilindrada:' => $version->engine_displacement,
                    'Transmisión:' => $version->transmission,
                    'Tracción:' => $version->drivetrain,
                    'Plataforma:' => $version->platform,
                ],
                'pricing' => [
                    'year' => $version->year,
                    'list_price' => $version->list_price,
                    'discount' => $version->discount,
                    'final_price' => $version->final_price,
                    'currency' => $version->currency,
                ],
                'tab_content' => [
                    'motor' => [
                        'tipo_motor' => $version->motor_type,
                        'potencia' => $version->horsepower,
                        'torque' => $version->torque,
                        'combustible' => $version->fuel_type,
                        'consumo_ciudad' => $version->drivetrain,
                        'consumo_carretera' => $version->emission_standard,
                    ],
                    'equipamiento' => [
                        'pantalla' => $version->screen,
                        'asientos' => $version->seats,
                        'climatizador' => $version->climate_control,
                        'camara' => $version->camera,
                        'sensores' => $version->sensors,
                        'conectividad' => $version->connectivity,
                    ],
                    'seguridad' => [
                        'airbags' => $version->airbags,
                        'abs' => $version->abs,
                        'control_estabilidad' => $version->stability_control,
                        'asistente_frenado' => $version->brake_assist,
                        'control_traccion' => $version->traction_control,
                        'cinturones' => $version->seatbelts,
                    ]
                ],
                'colors' => $version->colors->mapWithKeys(function ($color) {
                    return [$color->code => [
                        'name' => $color->name,
                        'hex' => $color->hex_code,
                        'image' => $color->image,
                    ]];
                })->toArray(),
                'images' => [
                    'interior' => [
                        'default' => $version->interior_image,
                    ]
                ]
            ];
        }

        // Header personalizado por vehículo
        $headerTitles = [
            'starray' => [
                'title' => 'VERSIONES Y PRECIOS',
                'subtitle' => 'Elige tu versión de Starray',
            ],
            'gx3-pro' => [
                'title' => 'VERSIONES Y PRECIOS',
                'subtitle' => 'Elige tu versión de GX3 Pro',
            ],
            'cityray' => [
                'title' => 'VERSIONES Y PRECIOS',
                'subtitle' => 'Elige tu versión de Cityray',
            ],
            'coolray' => [
                'title' => 'VERSIONES Y PRECIOS',
                'subtitle' => 'Elige tu versión de COOLRAY',
            ],
        ];

        $customHeader = $headerTitles[$slug] ?? [
            'title' => 'VERSIONES Y PRECIOS',
            'subtitle' => 'Elige tu versión',
        ];

        return [
            'header' => array_merge($this->defaultVersionsData['header'], $customHeader),
            'versions' => $formattedVersions,
        ];
    }

    public function selectTab($tab)
    {
        $this->selectedTab = $tab;
    }

    public function getCurrentTabContent()
    {
        $currentVersion = $this->getCurrentVersion();

        if ($this->selectedTab === 'precio') {
            return $currentVersion['pricing'] ?? [];
        }

        return $currentVersion['tab_content'][$this->selectedTab] ?? [];
    }

    public function selectVersion($version)
    {
        $this->selectedVersion = $version;

        // Reset color al cambiar versión
        $currentVersion = $this->getCurrentVersion();
        if (isset($currentVersion['colors']) && !empty($currentVersion['colors'])) {
            $this->selectedColor = array_key_first($currentVersion['colors']);
        }
    }

    public function selectView($view)
    {
        $this->selectedView = $view;
        $this->dispatch('viewChanged');
    }

    public function selectColor($color)
    {
        $this->selectedColor = $color;
    }

    public function getCurrentVersion()
    {
        return $this->versionsData['versions'][$this->selectedVersion] ?? [];
    }

    public function getCurrentImage()
    {
        $currentVersion = $this->getCurrentVersion();

        if ($this->selectedView === 'interior') {
            return $currentVersion['images']['interior']['default'] ?? '';
        }

        $colors = $currentVersion['colors'] ?? [];

        if (empty($this->selectedColor) && !empty($colors)) {
            $this->selectedColor = array_key_first($colors);
        }

        return $colors[$this->selectedColor]['image'] ?? '';
    }

    public function requestQuote()
    {
        return redirect()->route('forms.detail', [
            'category' => $this->category,
            'slug' => $this->slug
        ]);
    }

    public function downloadCatalog()
    {
        $vehicleModel = Vehicle::where('slug', $this->slug)->first();

        if (!$vehicleModel || !$vehicleModel->catalog_pdf_path) {
            session()->flash('error', 'El catálogo no está disponible en este momento.');
            return;
        }

        $fullPath = public_path($vehicleModel->catalog_pdf_path);

        if (file_exists($fullPath)) {
            return response()->download($fullPath, $vehicleModel->catalog_file_name ?? 'catalogo.pdf');
        }

        session()->flash('error', 'El catálogo no está disponible en este momento.');
    }

    public function scheduleTestDrive()
    {
        return redirect()->route('forms.detail', [
            'category' => $this->category,
            'slug' => $this->slug
        ])->with('activeTab', 'test-drive');
    }

    public function contactWhatsapp()
    {
        $phoneNumber = '59177595558';

        $vehicleName = str_replace('-', ' ', ucwords($this->slug, '-'));
        $vehicleCategory = strtoupper($this->category);
        $vehicleUrl = route('vehicle.detail', [
            'category' => strtolower($this->category),
            'slug' => $this->slug
        ]);

        $message = "Hola!\n\n";
        $message .= "Estoy interesado en el {$vehicleCategory} {$vehicleName}\n\n";
        $message .= "Link: {$vehicleUrl}\n\n";
        $message .= "Podrian brindarme mas informacion?";

        $whatsappUrl = "https://api.whatsapp.com/send?phone={$phoneNumber}&text=" . urlencode($message);

        $this->dispatch('openWhatsapp', url: $whatsappUrl);
    }

    public function render()
    {
        return view('livewire.front.vehicle-versions');
    }
}
