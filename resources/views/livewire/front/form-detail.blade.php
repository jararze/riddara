<div>
    <div class="min-h-screen bg-gray-50">

        {{-- Sección 1: Formulario con Tabs --}}
        <section class="bg-gray-100 py-16">
            <div class="container mx-auto px-4">

                {{-- Header --}}
                <div class="text-left mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">
                        {{ $pageData['title'] }}
                    </h1>
                    <p class="text-lg text-gray-600">
                        {{ $pageData['description'] }}
                    </p>
                </div>

                {{-- Tabs --}}
                <div class=" mx-auto">
                    {{-- Vista Desktop (Tabs) --}}
                    <div class="hidden md:flex mb-8">
                        @foreach($pageData['tabs'] as $key => $tab)
                            <div class="flex-1">
                                <button wire:click="setActiveTab('{{ $key }}')"
                                        class="w-full p-6 text-left transition-all duration-300
                               {{ $activeTab === $key ? 'border-t-4 border-[#3B4C39]' : 'border-t-4 border-gray-600 hover:border-blue-400' }}"
                                        style="{{ $activeTab === $key ? 'background: linear-gradient(to bottom, #3b82f6 0%, rgba(59, 130, 246, 0.3) 20%, transparent 40%);' : 'background: transparent;' }}">
                                    <h3 class="font-bold text-lg mb-2 {{ $activeTab === $key ? 'text-white' : 'text-gray-800' }}">
                                        {{ $tab['title'] }}
                                    </h3>
                                    <p class="text-sm {{ $activeTab === $key ? 'text-gary-600 opacity-90' : 'text-gray-600' }}">
                                        {{ $tab['description'] }}
                                    </p>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    {{-- Vista Móvil (Acordeón) --}}
                    <div class="md:hidden">
                        <div class="space-y-2">
                            @foreach($pageData['tabs'] as $key => $tab)
                                <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                                    {{-- Header del acordeón --}}
                                    <button wire:click="setActiveTab('{{ $key }}')"
                                            class="w-full p-4 text-left flex items-center justify-between transition-all duration-300
                               {{ $activeTab === $key ? 'bg-[#3B4C39] text-white' : 'bg-white text-gray-800 hover:bg-gray-50' }}">
                                        <div>
                                            <h3 class="font-bold text-base">
                                                {{ $tab['title'] }}
                                            </h3>
                                            <p class="text-sm mt-1 {{ $activeTab === $key ? 'text-blue-100' : 'text-gray-500' }}">
                                                {{ $tab['description'] }}
                                            </p>
                                        </div>
                                        <svg class="w-5 h-5 transform transition-transform duration-300 {{ $activeTab === $key ? 'rotate-180' : '' }}"
                                             fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>

                                    {{-- Contenido con formulario --}}
                                    @if($activeTab === $key)
                                        <div class="p-4 bg-white animate-fade-in">
                                            @include('livewire.front.partials.form-content')
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Contenido del formulario --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

                        {{-- Imagen del interior --}}
                        <div class="order-2 lg:order-1">
                            <img src="{{ asset('frontend/images/Riddara-Bolivia-Razon-1.jpg') }}"
                                 alt="Interior Geely"
                                 class="w-full rounded-2xl shadow-lg">
                        </div>

                        {{-- Formulario --}}
                        <div class="order-1 lg:order-2 hidden md:block">
                            <div class="bg-white rounded-xl shadow-lg p-8">
                                @include('livewire.front.partials.form-content')
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>

        <!-- Modal de Agradecimiento -->
        @if($showThankYouModal)
            <div class="fixed inset-0 z-50 overflow-y-auto"
                 x-data="{ show: @entangle('showThankYouModal') }"
                 x-show="show"
                 x-cloak
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">

                <!-- Overlay oscuro -->
                <div class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm"></div>

                <!-- Contenido del Modal -->
                <div class="fixed inset-0 flex items-center justify-center p-4">
                    <div class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full p-8 text-center"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-90"
                         x-transition:enter-end="opacity-100 transform scale-100">

                        <!-- Ícono de éxito animado -->
                        <div class="mx-auto w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mb-6 animate-bounce">
                            <svg class="w-14 h-14 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>

                        <!-- Título -->
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">
                            ¡Gracias por contactarnos!
                        </h2>

                        <!-- Mensaje -->
                        <p class="text-gray-600 text-lg mb-6">
                            Hemos recibido tu solicitud exitosamente. Un asesor de
                            <span class="font-semibold text-blue-600">Riddara Bolivia</span>
                            se pondrá en contacto contigo muy pronto.
                        </p>

                        <!-- Info adicional -->
                        <div class="bg-blue-50 rounded-xl p-4 mb-6 border border-blue-100">
                            <div class="flex items-center justify-center space-x-2 text-blue-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-medium">
                        Te contactaremos en las próximas <strong>24 horas hábiles</strong>
                    </span>
                            </div>
                        </div>

                        <!-- Vehículo seleccionado (si aplica) -->
                        @if($formData['vehiculo'])
                            <div class="bg-gray-50 rounded-lg p-3 mb-6 text-sm text-gray-600">
                                <span class="font-medium">Vehículo de interés:</span> {{ $formData['vehiculo'] }}
                            </div>
                        @endif

                        <!-- Botón cerrar -->
                        <button wire:click="closeThankYouModal"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-xl transition duration-200 transform hover:scale-[1.02]">
                            Entendido
                        </button>

                        <!-- X para cerrar -->
                        <button wire:click="closeThankYouModal"
                                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        {{-- Sección 2: Sucursales --}}
        <livewire:front.direcciones-section
            layout="map-cards"
            :sectionData="[
                'background_color' => '#ffffff'
            ]"/>
    </div>

    <style>
        .tab-container {
            background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
            border-radius: 12px;
            padding: 4px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .tab-button-active {
            background: linear-gradient(135deg, #3b82f6 0%, #3B4C39 100%);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
            transform: translateY(-1px);
        }

        .tab-button-inactive {
            background: transparent;
            transition: all 0.3s ease;
        }

        .tab-button-inactive:hover {
            background: rgba(255, 255, 255, 0.7);
            transform: translateY(-0.5px);
        }

        .tabs-background {
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 50%, #94a3b8 100%);
        }
    </style>
</div>
