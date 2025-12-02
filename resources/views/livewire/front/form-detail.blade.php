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
