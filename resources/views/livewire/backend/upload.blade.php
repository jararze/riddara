<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\Vehicle;
use App\Models\VehicleVersion;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

new class extends Component {
    use WithFileUploads;

    public $activeTab = 'vehicles'; // 'vehicles' o 'versions'

    #[Validate('required|file|mimes:xlsx,xls|max:10240')]
    public $file;

    public $uploading = false;
    public $previewData = [];
    public $showPreview = false;
    public $importing = false;

    // Estadísticas
    public $stats = [
        'vehicles' => [
            'total' => 0,
            'active' => 0,
            'lastUpdate' => null,
        ],
        'versions' => [
            'total' => 0,
            'active' => 0,
            'lastUpdate' => null,
        ]
    ];

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        // Estadísticas de vehículos
        $this->stats['vehicles']['total'] = Vehicle::count();
        $this->stats['vehicles']['active'] = Vehicle::where('is_active', 1)->count();
        $lastVehicle = Vehicle::latest('updated_at')->first();
        $this->stats['vehicles']['lastUpdate'] = $lastVehicle?->updated_at; // ✅ Objeto Carbon

        // Estadísticas de versiones
        $this->stats['versions']['total'] = VehicleVersion::count();
        $this->stats['versions']['active'] = VehicleVersion::where('is_active', 1)->count();
        $lastVersion = VehicleVersion::latest('updated_at')->first();
        $this->stats['versions']['lastUpdate'] = $lastVersion?->updated_at; // ✅ Objeto Carbon
    }

    public function exportVehicles()
    {
        try {
            $vehicles = Vehicle::with('category')
                ->select([
                    'id',
                    'vehicle_category_id',
                    'name',
                    'description',
                    'currency_before',
                    'price_before',
                    'currency_now',
                    'price_now',
                    'discount_label',
                    'from_label',
                    'is_active'
                ])
                ->orderBy('id')
                ->get();

            $export = new class($vehicles) implements \Maatwebsite\Excel\Concerns\FromCollection,
                \Maatwebsite\Excel\Concerns\WithHeadings,
                \Maatwebsite\Excel\Concerns\WithMapping {
                private $vehicles;

                public function __construct($vehicles) {
                    $this->vehicles = $vehicles;
                }

                public function collection() {
                    return $this->vehicles;
                }

                public function headings(): array {
                    return [
                        'ID',
                        'Categoría ID',
                        'Categoría Nombre',
                        'Nombre',
                        'Descripción',
                        'Moneda Antes',
                        'Precio Antes',
                        'Moneda Ahora',
                        'Precio Ahora',
                        'Etiqueta Descuento',
                        'Etiqueta Desde',
                        'Activo (1=Sí, 0=No)'
                    ];
                }

                public function map($vehicle): array {
                    return [
                        $vehicle->id,
                        $vehicle->vehicle_category_id,
                        $vehicle->category->name ?? '',
                        $vehicle->name,
                        $vehicle->description,
                        $vehicle->currency_before,
                        $vehicle->price_before,
                        $vehicle->currency_now,
                        $vehicle->price_now,
                        $vehicle->discount_label,
                        $vehicle->from_label,
                        $vehicle->is_active
                    ];
                }
            };

            return Excel::download($export, 'vehiculos_' . now()->format('Y-m-d_His') . '.xlsx');

        } catch (\Exception $e) {
            session()->flash('error', 'Error al exportar: ' . $e->getMessage());
        }
    }

    public function exportVersions()
    {
        try {
            $versions = VehicleVersion::with('vehicle')
                ->orderBy('vehicle_id')
                ->orderBy('order')
                ->get();

            $export = new class($versions) implements \Maatwebsite\Excel\Concerns\FromCollection,
                \Maatwebsite\Excel\Concerns\WithHeadings,
                \Maatwebsite\Excel\Concerns\WithMapping {
                private $versions;

                public function __construct($versions) {
                    $this->versions = $versions;
                }

                public function collection() {
                    return $this->versions;
                }

                public function headings(): array {
                    return [
                        'ID',
                        'Vehículo ID',
                        'Vehículo Nombre',
                        'Nombre Versión',
                        'Activo (1=Sí, 0=No)',
                        'Cilindraje',
                        'Transmisión',
                        'Tracción',
                        'Plataforma',
                        'Año',
                        'Precio Lista',
                        'Descuento',
                        'Precio Final',
                        'Moneda',
                        'Tipo Motor',
                        'Caballos Fuerza',
                        'Torque',
                        'Combustible',
                        'Consumo Ciudad',
                        'Consumo Carretera',
                        'Norma Emisión',
                        'Tracción',
                        'Pantalla',
                        'Detalle Pantalla',
                        'Asientos',
                        'Control Clima',
                        'Cámara',
                        'Sensores',
                        'Conectividad',
                        'Airbags',
                        'ABS',
                        'Control Estabilidad',
                        'Asistencia Frenado',
                        'Control Tracción',
                        'Cinturones'
                    ];
                }

                public function map($version): array {
                    return [
                        $version->id,
                        $version->vehicle_id,
                        $version->vehicle->name ?? '',
                        $version->name,
                        $version->is_active,
                        $version->engine_displacement,
                        $version->transmission,
                        $version->drivetrain,
                        $version->platform,
                        $version->year,
                        $version->list_price,
                        $version->discount,
                        $version->final_price,
                        $version->currency,
                        $version->motor_type,
                        $version->horsepower,
                        $version->torque,
                        $version->fuel_type,
                        $version->city_consumption,
                        $version->highway_consumption,
                        $version->emission_standard,
                        $version->traccion,
                        $version->screen,
                        $version->screen_detail,
                        $version->seats,
                        $version->climate_control,
                        $version->camera,
                        $version->sensors,
                        $version->connectivity,
                        $version->airbags,
                        $version->abs,
                        $version->stability_control,
                        $version->brake_assist,
                        $version->traction_control,
                        $version->seatbelts
                    ];
                }
            };

            return Excel::download($export, 'versiones_' . now()->format('Y-m-d_His') . '.xlsx');

        } catch (\Exception $e) {
            session()->flash('error', 'Error al exportar: ' . $e->getMessage());
        }
    }

    public function updatedFile()
    {
        $this->validate();
        $this->processPreview();
    }

    public function processPreview()
    {
        try {
            $this->uploading = true;
            $this->previewData = [];

            $data = Excel::toArray(new class implements \Maatwebsite\Excel\Concerns\ToArray {
                public function array(array $array) {
                    return $array;
                }
            }, $this->file)[0];

            // Remover encabezados
            array_shift($data);

            // Tomar solo primeras 10 filas para preview
            $preview = array_slice($data, 0, 10);

            if ($this->activeTab === 'vehicles') {
                foreach ($preview as $row) {
                    $this->previewData[] = [
                        'id' => $row[0] ?? null,
                        'name' => $row[3] ?? '',
                        'price_before' => $row[6] ?? '',
                        'price_now' => $row[8] ?? '',
                        'is_active' => $row[11] ?? 1,
                    ];
                }
            } else {
                foreach ($preview as $row) {
                    $this->previewData[] = [
                        'id' => $row[0] ?? null,
                        'name' => $row[3] ?? '',
                        'list_price' => $row[10] ?? '',
                        'final_price' => $row[12] ?? '',
                        'is_active' => $row[4] ?? 1,
                    ];
                }
            }

            $this->showPreview = true;
            $this->uploading = false;

        } catch (\Exception $e) {
            $this->uploading = false;
            session()->flash('error', 'Error al procesar archivo: ' . $e->getMessage());
        }
    }

    public function confirmImport()
    {
        try {
            $this->importing = true;

            $data = Excel::toArray(new class implements \Maatwebsite\Excel\Concerns\ToArray {
                public function array(array $array) {
                    return $array;
                }
            }, $this->file)[0];

            array_shift($data); // Remover encabezados

            DB::beginTransaction();

            if ($this->activeTab === 'vehicles') {
                $this->importVehicles($data);
            } else {
                $this->importVersions($data);
            }

            DB::commit();

            $this->importing = false;
            $this->showPreview = false;
            $this->file = null;
            $this->previewData = [];

            $this->loadStats();

            session()->flash('success', 'Datos importados correctamente. ' . count($data) . ' registros actualizados.');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->importing = false;
            session()->flash('error', 'Error al importar: ' . $e->getMessage());
        }
    }

    private function importVehicles($data)
    {
        foreach ($data as $row) {
            $id = $row[0] ?? null;

            if (!$id) continue;

            Vehicle::where('id', $id)->update([
                'name' => $row[3] ?? '',
                'description' => $row[4] ?? '',
                'currency_before' => $row[5] ?? '$us.',
                'price_before' => $row[6] ?? null,
                'currency_now' => $row[7] ?? '$us.',
                'price_now' => $row[8] ?? null,
                'discount_label' => $row[9] ?? null,
                'from_label' => $row[10] ?? null,
                'is_active' => (int)($row[11] ?? 1),
            ]);
        }
    }

    private function importVersions($data)
    {
        foreach ($data as $row) {
            $id = $row[0] ?? null;

            if (!$id) continue;

            VehicleVersion::where('id', $id)->update([
                'name' => $row[3] ?? '',
                'is_active' => (int)($row[4] ?? 1),
                'engine_displacement' => $row[5] ?? null,
                'transmission' => $row[6] ?? null,
                'drivetrain' => $row[7] ?? null,
                'platform' => $row[8] ?? null,
                'year' => $row[9] ?? 2026,
                'list_price' => $row[10] ?? 0,
                'discount' => $row[11] ?? 0,
                'final_price' => $row[12] ?? 0,
                'currency' => $row[13] ?? '$us.',
                'motor_type' => $row[14] ?? null,
                'horsepower' => $row[15] ?? null,
                'torque' => $row[16] ?? null,
                'fuel_type' => $row[17] ?? null,
                'city_consumption' => $row[18] ?? null,
                'highway_consumption' => $row[19] ?? null,
                'emission_standard' => $row[20] ?? null,
                'traccion' => $row[21] ?? null,
                'screen' => $row[22] ?? null,
                'screen_detail' => $row[23] ?? null,
                'seats' => $row[24] ?? null,
                'climate_control' => $row[25] ?? null,
                'camera' => $row[26] ?? null,
                'sensors' => $row[27] ?? null,
                'connectivity' => $row[28] ?? null,
                'airbags' => $row[29] ?? null,
                'abs' => $row[30] ?? null,
                'stability_control' => $row[31] ?? null,
                'brake_assist' => $row[32] ?? null,
                'traction_control' => $row[33] ?? null,
                'seatbelts' => $row[34] ?? null,
            ]);
        }
    }

    public function cancelPreview()
    {
        $this->showPreview = false;
        $this->file = null;
        $this->previewData = [];
    }

    public function removeFile()
    {
        $this->file = null;
        $this->showPreview = false;
        $this->previewData = [];
    }

    public function closeAlert($type)
    {
        session()->forget($type);
    }
}; ?>

<section class="w-full">

    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Gestión de Precios') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Exporta, edita y actualiza los precios de vehículos y versiones') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Tabs para seleccionar tabla --}}
    <div class="mb-6">
        <div class="flex gap-2 p-1 bg-zinc-100 dark:bg-zinc-800 rounded-lg w-fit">
            <button
                wire:click="$set('activeTab', 'vehicles')"
                class="px-6 py-2.5 rounded-md font-medium text-sm transition-all duration-200 {{ $activeTab === 'vehicles' ? 'bg-white dark:bg-zinc-700 text-[#3B4C39] dark:text-blue-400 shadow-sm' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-200' }}"
            >
                <div class="flex items-center gap-2">
                    <flux:icon icon="truck" variant="micro"/>
                    <span>Vehículos</span>
                </div>
            </button>
            <button
                wire:click="$set('activeTab', 'versions')"
                class="px-6 py-2.5 rounded-md font-medium text-sm transition-all duration-200 {{ $activeTab === 'versions' ? 'bg-white dark:bg-zinc-700 text-[#3B4C39] dark:text-blue-400 shadow-sm' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-200' }}"
            >
                <div class="flex items-center gap-2">
                    <flux:icon icon="rectangle-stack" variant="micro"/>
                    <span>Versiones</span>
                </div>
            </button>
        </div>
    </div>

    {{-- Tarjetas de estadísticas según el tab activo --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        @php
            $currentStats = $activeTab === 'vehicles' ? $stats['vehicles'] : $stats['versions'];
            $tableLabel = $activeTab === 'vehicles' ? 'Vehículos' : 'Versiones';
        @endphp

        <div class="group relative rounded-xl p-6 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-950 dark:to-blue-900 border border-blue-200 dark:border-blue-800 hover:shadow-lg transition-all duration-300">
            <div class="flex items-start justify-between mb-4">
                <div class="p-3 rounded-lg bg-blue-500 dark:bg-[#3B4C39] shadow-lg">
                    <flux:icon :icon="$activeTab === 'vehicles' ? 'truck' : 'rectangle-stack'" variant="solid" class="w-6 h-6 text-white"/>
                </div>
            </div>
            <flux:subheading class="text-blue-900 dark:text-blue-100 mb-1">Total {{ $tableLabel }}</flux:subheading>
            <flux:heading size="xl" class="text-blue-950 dark:text-blue-50">{{ number_format($currentStats['total']) }}</flux:heading>
        </div>

        <div class="group relative rounded-xl p-6 bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-950 dark:to-emerald-900 border border-emerald-200 dark:border-emerald-800 hover:shadow-lg transition-all duration-300">
            <div class="flex items-start justify-between mb-4">
                <div class="p-3 rounded-lg bg-emerald-500 dark:bg-emerald-600 shadow-lg">
                    <flux:icon icon="check-circle" variant="solid" class="w-6 h-6 text-white"/>
                </div>
            </div>
            <flux:subheading class="text-emerald-900 dark:text-emerald-100 mb-1">{{ $tableLabel }} Activos</flux:subheading>
            <flux:heading size="xl" class="mb-2 text-emerald-950 dark:text-emerald-50">{{ number_format($currentStats['active']) }}</flux:heading>
            <div class="text-xs text-emerald-700 dark:text-emerald-300">
                {{ number_format(($currentStats['active'] / max($currentStats['total'], 1)) * 100, 1) }}% del total
            </div>
        </div>

        <div class="group relative rounded-xl p-6 bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-950 dark:to-purple-900 border border-purple-200 dark:border-purple-800 hover:shadow-lg transition-all duration-300">
            <div class="flex items-start justify-between mb-4">
                <div class="p-3 rounded-lg bg-purple-500 dark:bg-purple-600 shadow-lg">
                    <flux:icon icon="clock" variant="solid" class="w-6 h-6 text-white"/>
                </div>
            </div>
            <flux:subheading class="text-purple-900 dark:text-purple-100 mb-1">Última Actualización</flux:subheading>
            <flux:heading size="lg" class="text-purple-950 dark:text-purple-50">
                {{ $currentStats['lastUpdate'] ? $currentStats['lastUpdate']->diffForHumans() : 'N/A' }}
            </flux:heading>
            <div class="text-xs text-purple-700 dark:text-purple-300 mt-1">
                {{ $currentStats['lastUpdate'] ? $currentStats['lastUpdate']->format('d/m/Y H:i') : '' }}
            </div>
        </div>

    </div>

    {{-- Mensajes --}}
    @if (session()->has('success'))
        <div class="mb-6 relative">
            <flux:callout variant="success">
                <flux:callout.heading icon="check-circle">Éxito</flux:callout.heading>
                <flux:callout.text>{{ session('success') }}</flux:callout.text>
            </flux:callout>
            <button
                wire:click="closeAlert('success')"
                class="absolute top-3 right-3 p-1 rounded hover:bg-green-100 dark:hover:bg-green-900/30 transition-colors"
            >
                <flux:icon icon="x-mark" variant="micro" class="w-4 h-4 text-green-700 dark:text-green-300"/>
            </button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 relative">
            <flux:callout variant="danger">
                <flux:callout.heading icon="x-circle">Error</flux:callout.heading>
                <flux:callout.text>{{ session('error') }}</flux:callout.text>
            </flux:callout>
            <button
                wire:click="closeAlert('error')"
                class="absolute top-3 right-3 p-1 rounded hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors"
            >
                <flux:icon icon="x-mark" variant="micro" class="w-4 h-4 text-red-700 dark:text-red-300"/>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 relative">
            <flux:callout variant="warning">
                <flux:callout.heading icon="exclamation-triangle">Error de Validación</flux:callout.heading>
                <flux:callout.text>{{ $errors->first() }}</flux:callout.text>
            </flux:callout>
        </div>
    @endif

    {{-- Sección de exportación --}}
    <div class="mb-6 rounded-xl bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-950/30 dark:to-orange-950/30 border border-amber-200 dark:border-amber-800 p-6">
        <div class="flex items-start gap-4">
            <div class="p-3 rounded-lg bg-amber-500 dark:bg-amber-600 shadow-lg">
                <flux:icon icon="arrow-down-tray" variant="solid" class="w-6 h-6 text-white"/>
            </div>
            <div class="flex-1">
                <flux:heading size="lg" class="mb-2">Paso 1: Exportar datos actuales</flux:heading>
                <flux:subheading class="mb-4">
                    Descarga el archivo Excel con los datos actuales de {{ $activeTab === 'vehicles' ? 'vehículos' : 'versiones' }} para editarlos
                </flux:subheading>
                <flux:button
                    wire:click="{{ $activeTab === 'vehicles' ? 'exportVehicles' : 'exportVersions' }}"
                    variant="primary"
                    icon="arrow-down-tray"
                >
                    Descargar Excel
                </flux:button>
            </div>
        </div>
    </div>

    {{-- Modal de preview --}}
    @if ($showPreview)
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                <div class="p-6 border-b border-zinc-200 dark:border-zinc-700">
                    <flux:heading size="lg">Vista Previa de Importación</flux:heading>
                    <flux:subheading>Revisa los datos antes de confirmar la actualización</flux:subheading>
                </div>

                <div class="p-6 overflow-y-auto max-h-[60vh]">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-zinc-50 dark:bg-zinc-800">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">ID</th>
                                <th class="px-4 py-3 text-left font-semibold">Nombre</th>
                                @if ($activeTab === 'vehicles')
                                    <th class="px-4 py-3 text-left font-semibold">Precio Antes</th>
                                    <th class="px-4 py-3 text-left font-semibold">Precio Ahora</th>
                                @else
                                    <th class="px-4 py-3 text-left font-semibold">Precio Lista</th>
                                    <th class="px-4 py-3 text-left font-semibold">Precio Final</th>
                                @endif
                                <th class="px-4 py-3 text-left font-semibold">Activo</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                            @foreach ($previewData as $row)
                                <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                                    <td class="px-4 py-3">{{ $row['id'] }}</td>
                                    <td class="px-4 py-3 font-medium">{{ $row['name'] }}</td>
                                    @if ($activeTab === 'vehicles')
                                        <td class="px-4 py-3">{{ $row['price_before'] }}</td>
                                        <td class="px-4 py-3 text-[#3B4C39] dark:text-blue-400 font-semibold">{{ $row['price_now'] }}</td>
                                    @else
                                        <td class="px-4 py-3">{{ $row['list_price'] }}</td>
                                        <td class="px-4 py-3 text-[#3B4C39] dark:text-blue-400 font-semibold">{{ $row['final_price'] }}</td>
                                    @endif
                                    <td class="px-4 py-3">
                                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $row['is_active'] ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                                                {{ $row['is_active'] ? 'Sí' : 'No' }}
                                            </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 p-3 rounded-lg bg-blue-50 dark:bg-blue-950/20 border border-blue-200 dark:border-blue-800">
                        <div class="flex items-start gap-2">
                            <flux:icon icon="information-circle" variant="solid" class="flex-shrink-0 w-5 h-5 text-[#3B4C39] dark:text-blue-400 mt-0.5"/>
                            <div class="text-sm text-blue-900 dark:text-blue-100">
                                <p class="font-medium mb-1">Mostrando las primeras 10 filas</p>
                                <p>Se actualizarán todos los registros del archivo al confirmar.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-zinc-200 dark:border-zinc-700 flex justify-end gap-3">
                    <flux:button
                        wire:click="cancelPreview"
                        variant="ghost"
                        :disabled="$importing"
                    >
                        Cancelar
                    </flux:button>
                    <flux:button
                        wire:click="confirmImport"
                        variant="primary"
                        icon="check"
                        :disabled="$importing"
                    >
                        <span wire:loading.remove wire:target="confirmImport">Confirmar Importación</span>
                        <span wire:loading wire:target="confirmImport">Importando...</span>
                    </flux:button>
                </div>
            </div>
        </div>
    @endif

    {{-- Área de Upload --}}
    <div class="relative">
        <div
            x-data="{
                isDragging: false,
                handleDrop(e) {
                    this.isDragging = false;
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        @this.upload('file', files[0]);
                    }
                }
            }"
            @dragover.prevent="isDragging = true"
            @dragleave.prevent="isDragging = false"
            @drop.prevent="handleDrop($event)"
            :class="{ 'border-blue-500 bg-blue-50 dark:bg-blue-950/20 scale-[1.02]': isDragging }"
            class="relative rounded-xl border-2 border-dashed border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 transition-all duration-200 hover:border-zinc-400 dark:hover:border-zinc-500"
        >
            @if (!$file)
                <div class="px-6 py-12 text-center">
                    <div class="mx-auto w-16 h-16 mb-4 rounded-full bg-gradient-to-br from-green-100 to-green-200 dark:from-green-900 dark:to-green-800 flex items-center justify-center shadow-lg">
                        <flux:icon icon="arrow-up-tray" variant="outline" class="w-8 h-8 text-green-600 dark:text-green-400"/>
                    </div>

                    <flux:heading size="lg" class="mb-2">
                        Paso 2: Importar Excel editado
                    </flux:heading>

                    <flux:subheading class="mb-6">
                        Arrastra el archivo Excel editado o haz clic para seleccionarlo
                    </flux:subheading>

                    <div class="flex items-center justify-center gap-3 mb-4">
                        <flux:button
                            wire:loading.attr="disabled"
                            onclick="document.getElementById('fileInput').click()"
                            variant="primary"
                            icon="arrow-up-tray"
                        >
                            Seleccionar Excel
                        </flux:button>
                    </div>

                    <input
                        type="file"
                        id="fileInput"
                        wire:model="file"
                        accept=".xlsx,.xls"
                        class="hidden"
                    />

                    <div class="flex items-center justify-center gap-2 text-sm text-zinc-500 dark:text-zinc-400">
                        <flux:icon icon="information-circle" variant="micro"/>
                        <span>Solo archivos XLSX o XLS (Máx. 10MB)</span>
                    </div>

                    <div wire:loading wire:target="file" class="mt-4">
                        <div class="flex items-center justify-center gap-2 text-sm text-[#3B4C39] dark:text-blue-400">
                            <flux:icon icon="arrow-path" variant="micro" class="animate-spin"/>
                            <span>Procesando archivo...</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Información adicional --}}
    <div class="mt-6">
        <flux:callout variant="info">
            <flux:callout.heading icon="information-circle">Instrucciones de uso</flux:callout.heading>
            <flux:callout.text>
                <ol class="list-decimal list-inside space-y-2 ml-2">
                    <li><strong>Exporta</strong> el archivo Excel con los datos actuales</li>
                    <li><strong>Edita</strong> el archivo en Excel (NO modifiques la columna ID ni los encabezados)</li>
                    <li><strong>Guarda</strong> el archivo Excel editado</li>
                    <li><strong>Importa</strong> el archivo usando el área de carga superior</li>
                    <li><strong>Revisa</strong> la vista previa y confirma los cambios</li>
                </ol>
                <div class="mt-3 p-2 bg-yellow-50 dark:bg-yellow-950/20 rounded border border-yellow-200 dark:border-yellow-800">
                    <p class="text-sm"><strong>Importante:</strong> No modifiques la columna ID ni elimines filas. Solo edita los valores de las celdas.</p>
                </div>
            </flux:callout.text>
        </flux:callout>
    </div>

</section>
