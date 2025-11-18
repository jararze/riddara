<div class="relative" wire:key="mobile-vehicles-{{ $activeCategory }}-{{ $currentIndex }}">
    {{-- Current Vehicle --}}
    @if(isset($modelsConfig['vehicles'][$activeCategory][$currentIndex]))
        @php $vehicle = $modelsConfig['vehicles'][$activeCategory][$currentIndex]; @endphp

        <div class="text-center px-4">
            {{-- Vehicle Name --}}
            <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $vehicle['name'] }}</h3>

            {{-- Vehicle Image --}}
            <div class="relative mb-6">
                <a href="{{ route('vehicle.detail', ['category' => strtolower($vehicle['category']), 'slug' => $vehicle['slug']]) }}">
                    <img src="{{ asset($vehicle['image']) }}"
                         alt="{{ $vehicle['name'] }}"
                         class="w-full h-auto max-w-sm mx-auto">
                </a>
            </div>

            {{-- Solo mostrar pricing si show_badge es true --}}
            @if(($vehicle['featured']))
                <div class="mb-6">
                    {{-- Precio anterior arriba --}}
                    @if($vehicle['pricing']['price_before'] ?? false)
                        <div class="text-center text-sm text-gray-500 mb-2">
                            Desde {{ $vehicle['pricing']['currency_before'] }}{{ number_format($vehicle['pricing']['price_before']) }}
                        </div>
                    @endif

                    {{-- Contenedor tipo píldora unificado --}}
                    <div
                        class="inline-flex items-stretch bg-white rounded-full shadow-lg overflow-hidden border border-gray-200 mx-auto">
                        {{-- Sección del precio (lado izquierdo) --}}
                        <div class="px-6 py-1 lg:py-3 bg-gray-50 flex items-center">
                            <div class="text-center">
                                <span
                                    class="text-[#3B4C39] text-xs font-medium block mb-1">{{ $vehicle['pricing']['discount_label'] }}</span>
                                <span
                                    class="text-gray-900 text-base lg:text-lg font-bold">{{ $vehicle['pricing']['currency_now'] }} {{ number_format($vehicle['pricing']['price_now']) }}</span>
                            </div>
                        </div>

                        {{-- Botón (lado derecho) --}}
                        @if($vehicle['button_primary']['show'] ?? false)
                            <a href="{{ route('vehicle.detail', ['category' => strtolower($vehicle['category']), 'slug' => $vehicle['slug']]) }}"
                               class="px-6 py-1 lg:py-3 bg-black text-white font-medium hover:bg-gray-800 transition-colors flex items-center">
                                {{ $vehicle['button_primary']['text'] }}
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Description --}}
            <p class="text-gray-600 max-w-xs mx-auto">{{ $vehicle['description'] }}</p>
        </div>
    @endif

    {{-- Navigation Arrows --}}
    @if(count($modelsConfig['vehicles'][$activeCategory]) > 1)
        <button wire:click="prevSlide"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white
                       p-2 rounded-full shadow-lg transition-all duration-200 z-10">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <button wire:click="nextSlide"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white
                       p-2 rounded-full shadow-lg transition-all duration-200 z-10">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    @endif
</div>
