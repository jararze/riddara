<div>
    {{-- Loader específico para este componente --}}
    <div wire:loading class="fixed inset-0 bg-white bg-opacity-75 flex items-center justify-center z-50">
        <div class="text-center">
            <div class="loader-spinner mb-4"></div>
            <p class="text-gray-600">Cargando...</p>
        </div>
    </div>

    {{-- Loader específico para diferentes acciones --}}
    <div wire:loading.delay wire:target="testSlowTab" class="fixed inset-0 bg-blue-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="text-center text-white">
            <div class="loader-spinner mb-4 border-white border-t-blue-200"></div>
            <p>Cambiando tab...</p>
        </div>
    </div>

    <div wire:loading.delay wire:target="testSlowColor" class="fixed inset-0 bg-green-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="text-center text-white">
            <div class="loader-spinner mb-4 border-white border-t-green-200"></div>
            <p>Cambiando color...</p>
        </div>
    </div>

    <div wire:loading.delay wire:target="testSlowView" class="fixed inset-0 bg-purple-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="text-center text-white">
            <div class="loader-spinner mb-4 border-white border-t-purple-200"></div>
            <p>Cambiando vista...</p>
        </div>
    </div>

    <section class="vehicle-versions {{ $versionsData['section_background'] }} {{ $versionsData['section_padding'] }}">
        <div class="container mx-auto px-4">

            {{-- Header --}}
            <div class="text-left mb-12">
                <h2 class="{{ $versionsData['header']['title_size'] }} font-bold text-gray-900 mb-4">
                    {{ $versionsData['header']['title'] }}
                </h2>
                <p class="{{ $versionsData['header']['subtitle_size'] }} text-gray-600">
                    {{ $versionsData['header']['subtitle'] }}
                </p>
            </div>

            {{-- Caja única con gradiente --}}
            <div class="relative rounded-lg overflow-hidden shadow-lg"
                 style="background: linear-gradient(135deg, #e3f2fd 0%, #f8f9fa 70%, rgba(248,249,250,0) 100%);">

                <div class="grid grid-cols-1 lg:grid-cols-3">

                    {{-- Panel Izquierdo: Configuración (1/3) --}}
                    <div class="p-6 lg:p-8 order-2 lg:order-1">

                        {{-- Selector de Versión --}}
                        <div class="mb-6">
                            <select wire:model.live="selectedVersion"
                                    class="w-full bg-[#194BFF] text-white p-3 pr-10 rounded font-medium text-lg appearance-none"
                                    style="font-family: 'GeelyTitle', sans-serif;">
                                @foreach($versionsData['versions'] as $key => $version)
                                    <option class="bg-white text-black" value="{{ $key }}">{{ $version['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Especificaciones --}}
                        <div class="mb-6">
                            @php $currentVersion = $this->getCurrentVersion(); @endphp
                            @foreach($currentVersion['specs'] ?? [] as $label => $value)
                                <div class="flex justify-between py-2 border-b border-gray-200">
                                    <span class="text-gray-600 text-sm">{{ $label }}</span>
                                    <span class="font-medium text-gray-900 text-sm">{{ $value }}</span>
                                </div>
                            @endforeach
                        </div>

                        {{-- Tabs --}}
                        <div class="mb-6">
                            <div class="flex flex-wrap gap-2">
                                @foreach($versionsData['tabs'] as $key => $tab)
                                    <button wire:click="selectTab('{{ $key }}')"
                                            class="py-2 px-2 text-xs font-small rounded transition-colors {{ $selectedTab === $key ? 'bg-[#194BFF] text-white' : 'bg-white text-gray-600 hover:bg-[#194BFF] hover:text-white border border-gray-300' }}">
                                        {{ $tab['label'] }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        {{-- Contenido dinámico según el tab --}}
                        <div class="mb-6">
                            @if($selectedTab === 'precio')
                                {{-- Información de Precio --}}
                                @php $pricing = $this->getCurrentTabContent(); @endphp
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Año Comercial:</span>
                                        <span class="font-medium text-sm">{{ $pricing['year'] ?? 'N/A' }}</span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Precio de lista:</span>
                                        <span class="font-medium text-sm">{{ $pricing['currency'] ?? '$' }}{{ number_format($pricing['list_price'] ?? 0) }}</span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Descuento Lanzamiento:</span>
                                        <span class="font-medium text-green-600 text-sm">{{ $pricing['currency'] ?? '$' }} {{ number_format($pricing['discount'] ?? 0) }}</span>
                                    </div>

                                    <div class="flex justify-between text-lg font-bold border-t pt-2 mt-3">
                                        <span class="text-[#194BFF]">Precio final:</span>
                                        <span class="text-[#194BFF]">{{ $pricing['currency'] ?? '$' }} {{ number_format($pricing['final_price'] ?? 0) }}</span>
                                    </div>
                                </div>

                            @elseif($selectedTab === 'motor')
                                {{-- Información del Motor --}}
                                @php $motor = $this->getCurrentTabContent(); @endphp
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Tipo de motor:</span>
                                        <span class="font-medium text-sm">{{ $motor['tipo_motor'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Potencia:</span>
                                        <span class="font-medium text-sm">{{ $motor['potencia'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Torque:</span>
                                        <span class="font-medium text-sm">{{ $motor['torque'] ?? 'N/A' }}</span>
                                    </div>
{{--                                    <div class="flex justify-between">--}}
{{--                                        <span class="text-gray-600 text-sm">Combustible:</span>--}}
{{--                                        <span class="font-medium text-sm">{{ $motor['combustible'] ?? 'N/A' }}</span>--}}
{{--                                    </div>--}}
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Tracción:</span>
                                        <span class="font-medium text-sm">{{ $motor['consumo_ciudad'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Norma de emisiones:</span>
                                        <span class="font-medium text-sm">{{ $motor['consumo_carretera'] ?? 'N/A' }}</span>
                                    </div>
                                </div>

                            @elseif($selectedTab === 'equipamiento')
                                {{-- Información del Equipamiento --}}
                                @php $equipamiento = $this->getCurrentTabContent(); @endphp
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Pantalla:</span>
                                        <span class="font-medium text-sm">{{ $equipamiento['pantalla'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Asientos:</span>
                                        <span class="font-medium text-sm">{{ $equipamiento['asientos'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">{{ ($vehicle["slug"] == "coolray") ? "Faros:" : "Climatizador:" }}</span>
                                        <span class="font-medium text-sm">{{ $equipamiento['climatizador'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Cámara:</span>
                                        <span class="font-medium text-sm">{{ $equipamiento['camara'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Sensores:</span>
                                        <span class="font-medium text-sm">{{ $equipamiento['sensores'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Conectividad:</span>
                                        <span class="font-medium text-sm">{{ $equipamiento['conectividad'] ?? 'N/A' }}</span>
                                    </div>
                                </div>

                            @elseif($selectedTab === 'seguridad')
                                {{-- Información de Seguridad --}}
                                @php $seguridad = $this->getCurrentTabContent(); @endphp
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Airbags:</span>
                                        <span class="font-medium text-sm">{{ $seguridad['airbags'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Sistema de frenado:</span>
                                        <span class="font-medium text-sm">{{ $seguridad['abs'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">{{ ($vehicle["slug"] == "coolray") ? "Neumáticos:" : "Control estabilidad:" }}</span>
                                        <span class="font-medium text-sm">{{ $seguridad['control_estabilidad'] ?? 'N/A' }}</span>
                                    </div>
{{--                                    <div class="flex justify-between">--}}
{{--                                        <span class="text-gray-600 text-sm">Asistente frenado:</span>--}}
{{--                                        <span class="font-medium text-sm">{{ $seguridad['asistente_frenado'] ?? 'N/A' }}</span>--}}
{{--                                    </div>--}}
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">{{ ($vehicle["slug"] == "coolray") ? "Seguros:" : "Control tracción:" }}</span>
                                        <span class="font-medium text-sm">{{ $seguridad['control_traccion'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Cinturones:</span>
                                        <span class="font-medium text-sm">{{ $seguridad['cinturones'] ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>


                        {{-- Botones de Acción --}}
                        <div class="space-y-3">
                            <button wire:click="requestQuote"
                                    class="w-full py-3 bg-black text-white rounded font-medium transition-colors hover:bg-gray-800">
                                {{ $versionsData['buttons']['quote']['text'] }}
                            </button>

                            <button wire:click="downloadCatalog"
                                    class="w-full py-2 border border-gray-400 text-gray-700 rounded font-medium transition-colors hover:bg-black hover:text-white text-sm">
                                {{ $versionsData['buttons']['catalog']['text'] }}
                            </button>

                            <button wire:click="scheduleTestDrive"
                                    class="w-full py-2 border border-gray-400 text-gray-700 rounded font-medium transition-colors hover:bg-black hover:text-white text-sm">
                                {{ $versionsData['buttons']['test_drive']['text'] }}
                            </button>

                            <a href="#"
                               wire:click.prevent="contactWhatsapp"
                               target="_blank"
                               class="w-full py-2 border border-gray-400 text-gray-700 rounded font-medium transition-colors hover:bg-black hover:text-white text-sm inline-block text-center">
                                {{ $versionsData['buttons']['whatsapp']['text'] }}
                            </a>

                            @push('scripts')
                                <script>
                                    document.addEventListener('livewire:init', () => {
                                        Livewire.on('openWhatsapp', (event) => {
                                            window.open(event.url, '_blank');
                                        });
                                    });
                                </script>
                            @endpush
                        </div>
                    </div>

                    {{-- Panel Derecho: Visualización (2/3) --}}
                    <div class="lg:col-span-2 p-6 lg:p-8 flex flex-col order-1 lg:order-2">

                        {{-- Toggle Exterior/Interior --}}
                        <div class="flex justify-center mb-6">
                            <div class="flex bg-gray-200 rounded-full p-1">
                                <button wire:click="selectView('exterior')"
                                        class="px-6 py-2 rounded-full font-medium transition-colors {{ $selectedView === 'exterior' ? 'bg-white text-gray-900 shadow' : 'text-gray-600' }}">
                                    Exterior
                                </button>
                                <button wire:click="selectView('interior')"
                                        class="px-6 py-2 rounded-full font-medium transition-colors {{ $selectedView === 'interior' ? 'bg-black text-white shadow' : 'text-gray-600' }}">
                                    Interior
                                </button>
                            </div>
                        </div>

                        {{-- Imagen del Vehículo --}}
                        <div class="flex-1 flex items-center justify-center">
                            <div class="relative w-full max-w-2xl">
                                @if($selectedView === 'interior')
                                    {{-- Imagen interior con efectos --}}
                                    @php
                                        $currentVersion = $this->getCurrentVersion();
                                        $interiorImage = $currentVersion['images']['interior']['default'] ?? '';
                                    @endphp
                                    <div class="relative w-full h-[175px] md:h-[550px] lg:h-[600px] bg-gradient-to-br rounded-lg overflow-hidden group shadow-lg">
                                        <img src="{{ asset($interiorImage) }}"
                                             alt="Interior del vehículo"
                                             class="w-full h-full object-contain transition-all duration-500 ease-out group-hover:scale-105 group-hover:brightness-110">

                                        {{-- Overlay con efecto hover --}}
                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all duration-300"></div>

                                        {{-- Badge inferior --}}
                                        <div class="absolute bottom-4 right-4 bg-black/80 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium opacity-80 group-hover:opacity-100 transition-all duration-300 transform group-hover:scale-105">
                                            Vista interior
                                        </div>

                                        {{-- Efecto de brillo --}}
                                        <div class="absolute inset-0 opacity-0 group-hover:opacity-20 transition-opacity duration-500 bg-gradient-to-r from-transparent via-white to-transparent transform -skew-x-12 group-hover:animate-shine"></div>
                                    </div>
                                @else
                                    {{-- Imagen exterior con efectos similares --}}
                                    <div class="relative w-full h-[175px] md:h-[450px] lg:h-[500px] rounded-lg overflow-hidden group">
                                        <img src="{{ asset($this->getCurrentImage()) }}"
                                             alt="exterior"
                                             class="w-full h-full object-contain transition-all duration-500 ease-out group-hover:scale-102 group-hover:brightness-105">

                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-all duration-300"></div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Selector de Colores (solo para exterior) --}}
                        @if($selectedView === 'exterior')
                            <div class="flex justify-center space-x-3 mt-6 bg-white rounded-full py-3 px-5 w-fit mx-auto">
                                @php $currentVersion = $this->getCurrentVersion(); @endphp
                                @foreach($currentVersion['colors'] ?? [] as $colorKey => $color)
                                    <button wire:click="selectColor('{{ $colorKey }}')"
                                            class="relative w-10 h-10 rounded-full border-2 transition-all duration-200 {{ $selectedColor === $colorKey ? 'border-gray-800 scale-110 shadow-lg' : 'border-gray-300 hover:border-gray-400' }}"
                                            style="background-color: {{ $color['hex'] }};"
                                            title="{{ $color['name'] }}">
                                        @if($selectedColor === $colorKey)
                                            <div class="absolute inset-0 rounded-full border-2 border-white"></div>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Mensajes Flash --}}
            @if (session()->has('message'))
                <div class="mt-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </section>

    <style>
        select {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 26px;
            padding-right: 40px !important;
        }
        @keyframes shine {
            0% { transform: translateX(-100%) skewX(-12deg); }
            100% { transform: translateX(200%) skewX(-12deg); }
        }

        .animate-shine {
            animation: shine 1.5s ease-in-out;
        }

        .group:hover .animate-shine {
            animation: shine 1.5s ease-in-out;
        }
    </style>
</div>

