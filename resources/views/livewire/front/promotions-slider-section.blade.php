<div>
    <div x-data="{
    autoplay: {{ $promotionsData['autoplay']['enabled'] ? 'true' : 'false' }},
    delay: {{ $promotionsData['autoplay']['delay'] }},
    interval: null,
    startAutoplay() {
        if (this.autoplay) {
            this.interval = setInterval(() => {
                $wire.call('nextSlide');
            }, this.delay);
        }
    },
        stopAutoplay() {
            if (this.interval) {
                clearInterval(this.interval);
                this.interval = null;
            }
        }
    }"
         x-init="startAutoplay()"
         @mouseenter="stopAutoplay()"
         @mouseleave="startAutoplay()"
         class="{{ $promotionsData['section_background'] }} {{ $promotionsData['section_padding'] }}">

        <div class="container mx-auto px-4">
            {{-- Header --}}
            <div class="text-left mb-8">
                <h2 class="{{ $promotionsData['header']['title_size'] }} font-bold text-gray-900 mb-2">
                    {{ $promotionsData['header']['title'] }}
                </h2>
                <p class="{{ $promotionsData['header']['subtitle_size'] }} text-gray-600">
                    {{ $promotionsData['header']['subtitle'] }}
                </p>
            </div>

            {{-- Slider Container --}}
            <div class="relative rounded-2xl overflow-hidden shadow-xl max-w-4xl mx-auto">
                @php $currentSlide = $this->getCurrentSlide(); @endphp

                <div class="relative h-[600px] sm:h-[550px] lg:h-[500px] {{ $currentSlide['background_color'] ?? 'bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300' }}">
                    {{-- Slide Content --}}
                    <div class="flex flex-col lg:grid lg:grid-cols-2 h-full">
                        {{-- Left Content --}}
                        <div class="flex flex-col justify-center p-8 lg:p-16 {{ $currentSlide['text_color'] ?? 'text-gray-800' }}">
                            <div class="space-y-6">
                                {{-- Offer Title con degradado --}}
                                <div class="space-y-2">
                                    <h3 class="text-3xl lg:text-4xl font-bold leading-none {{ $currentSlide['title_gradient'] ?? 'bg-gradient-to-r from-blue-500 to-[#3B4C39] bg-clip-text text-transparent' }}">
                                        {{ $currentSlide['title'] ?? '' }}
                                    </h3>
                                    <h4 class="text-2xl lg:text-3xl font-semibold {{ $currentSlide['title_gradient'] ?? 'bg-gradient-to-r from-blue-500 to-[#3B4C39] bg-clip-text text-transparent' }}">
                                        {{ $currentSlide['subtitle'] ?? '' }}
                                    </h4>
                                </div>

                                {{-- Description en color normal --}}
                                <p class="text-lg lg:text-xl leading-relaxed max-w-md text-gray-700">
                                    {{ $currentSlide['description'] ?? '' }}
                                </p>

                                {{-- Vehicle Info --}}
                                <div class="space-y-1">
                                    <h5 class="text-xl font-bold text-gray-900">
                                        {{ $currentSlide['vehicle_model'] ?? '' }}
                                    </h5>
                                    <p class="text-sm text-gray-600 max-w-xs">
                                        {{ $currentSlide['vehicle_subtitle'] ?? '' }}
                                    </p>
                                </div>

                                {{-- Action Button con degradado azul --}}

                            </div>
                        </div>

                        {{-- Right Image --}}
                        <div class="flex flex-col p-4 lg:p-8">
                            {{-- Imagen - más arriba en móvil --}}
                            <div class="flex-1 flex items-start lg:items-center justify-center">
                                <div class="relative w-full h-full flex items-center justify-center">
                                    <img src="{{ asset($currentSlide['image'] ?? 'frontend/images/default-car.jpg') }}"
                                         alt="{{ $currentSlide['vehicle_model'] ?? 'Vehículo' }}"
                                         class="max-w-full max-h-full  oobject-contain transition-transform duration-300 hover:scale-105">
                                </div>
                            </div>

                            {{-- Botón - visible en móvil y desktop --}}
                            <div class="flex justify-center lg:justify-end mt-4">
                                <button
                                    wire:click="claimPromotion('{{ $currentSlide['id'] ?? '' }}')"
                                    class="px-6 py-2 lg:px-8 lg:py-3 bg-black text-white rounded-lg font-semibold transition-colors hover:bg-gray-800 text-sm lg:text-base">
                                    {{ $currentSlide['button']['text'] ?? 'Obtener promo' }}
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Navigation Arrows --}}
                    @if($promotionsData['navigation']['arrows_enabled'] ?? true)
                        <button wire:click="prevSlide"
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full p-3 transition-all text-[#3B4C39] shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>

                        <button wire:click="nextSlide"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full p-3 transition-all text-[#3B4C39] shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    @endif
                </div>


            </div>
            {{-- Dots Navigation con contenedor configurable --}}
            <div class="{{ $promotionsData['navigation']['dots_container_class'] ?? 'flex justify-center mt-6' }}">
                <div class="{{ $promotionsData['navigation']['dots_wrapper_class'] ?? 'bg-gray-200 rounded-full px-4 py-2 flex space-x-2' }}">
                    @foreach($promotionsData['slides'] as $index => $slide)
                        <button wire:click="goToSlide({{ $index }})"
                                class="transition-all duration-300 {{ $this->currentSlide === $index ? ($promotionsData['navigation']['active_dot_style'] ?? 'w-8 h-3 bg-[#3B4C39] rounded-full') : ($promotionsData['navigation']['dots_style'] ?? 'w-3 h-3 bg-gray-400 hover:bg-gray-500 rounded-full') }}">
                        </button>
                    @endforeach
                </div>
            </div>
            {{-- Flash Messages --}}
            @if (session()->has('message'))
                <div class="mt-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif
        </div>

    </div>
</div>
