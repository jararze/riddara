<div>
    @if($sectionAvailable)
        @push('styles')
            <style>
                /* Animación para thumbnails */
                .thumbnail-container {
                    transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                }

                @keyframes fade-in {
                    from {
                        opacity: 0;
                        transform: translateY(10px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                @keyframes slide-in {
                    from {
                        opacity: 0;
                        transform: translateX(30px);
                    }
                    to {
                        opacity: 1;
                        transform: translateX(0);
                    }
                }

                .animate-fade-in {
                    animation: fade-in 0.6s ease-out;
                }

                .animate-slide-in {
                    animation: slide-in 0.8s ease-out;
                }

                /* Animación para la imagen principal */
                .main-image-container {
                    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .main-image-container img {
                    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
                }

            </style>
        @endpush

        @push('scripts')
            <script>
                document.addEventListener('livewire:initialized', () => {
                    let autoplayInterval;
                    let autoplayDelay = {{ $featureData['autoplay']['delay'] ?? 5000 }};
                    let autoplayEnabled = {{ $featureData['autoplay']['enabled'] ? 'true' : 'false' }};
                    let isPaused = false;

                    function startAutoplay() {
                        if (autoplayEnabled && !autoplayInterval && !isPaused) {
                            autoplayInterval = setInterval(() => {
                                // Agregar clase de transición antes del cambio
                                document.querySelector('.main-image-container')?.classList.add('opacity-90');

                                setTimeout(() => {
                                    @this.
                                    call('nextSlide');

                                    // Quitar clase después del cambio
                                    setTimeout(() => {
                                        document.querySelector('.main-image-container')?.classList.remove('opacity-90');
                                    }, 100);
                                }, 200);

                            }, autoplayDelay);
                        }
                    }

                    function stopAutoplay() {
                        if (autoplayInterval) {
                            clearInterval(autoplayInterval);
                            autoplayInterval = null;
                        }
                    }

                    // Iniciar autoplay después de un pequeño delay
                    setTimeout(startAutoplay, 1000);

                    // Pausar autoplay cuando el usuario interactúa
                    document.addEventListener('click', (e) => {
                        if (e.target.closest('[wire\\:click*="goToSlide"]')) {
                            stopAutoplay();
                            isPaused = true;

                            // Reiniciar después de 5 segundos
                            setTimeout(() => {
                                isPaused = false;
                                startAutoplay();
                            }, 5000);
                        }
                    });

                    // Pausar en hover
                    const sliderContainer = document.querySelector('.feature-slider-container');
                    if (sliderContainer) {
                        sliderContainer.addEventListener('mouseenter', () => {
                            isPaused = true;
                            stopAutoplay();
                        });

                        sliderContainer.addEventListener('mouseleave', () => {
                            isPaused = false;
                            setTimeout(startAutoplay, 500);
                        });
                    }
                });
            </script>
        @endpush


        <section class="{{ $featureData['section_background'] }} {{ $featureData['section_padding'] }}">
            <div class="container mx-auto px-4">
                <!-- Header -->
                @if(!empty($featureData['header']['title']))
                    <div class="mb-8">
                        <h2 class="{{ $featureData['header']['title_size'] }} {{ $featureData['header']['title_weight'] }} {{ $featureData['header']['title_color'] }}">
                            {{ $featureData['header']['title'] }}
                        </h2>
                    </div>
                @endif

            </div>

            @php $currentSlideData = $featureData['slides'][$currentSlide] ?? $featureData['slides'][0]; @endphp

            <div class="feature-slider-container relative overflow-hidden w-full">
                @if($featureData['layout']['direction'] === 'left')
                    <div class="hidden lg:flex items-start gap-6">
                        <!-- Imagen Principal -->
                        <div class="w-2/3 ml-10">
                            <div
                                class="relative h-[500px] rounded-2xl overflow-hidden bg-gray-200 main-image-container shadow-2xl">
                                <img
                                    src="{{ asset($this->getCurrentSlide()['main_image']) }}"
                                    class="w-full h-full object-cover animate-slide-in"
                                    alt=""
                                    wire:key="main-{{ $currentSlide }}">

                                <div class="absolute inset-0">
                                    <div class="absolute bottom-6 left-6 text-white animate-fade-in">
                                        <h3 class="text-2xl font-bold mb-2">{{ $this->getCurrentSlide()['title'] }}</h3>
                                        <p class="text-lg opacity-90">{{ $this->getCurrentSlide()['subtitle'] }}</p>
                                        <p class="text-sm opacity-80 mt-1">{{ $this->getCurrentSlide()['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thumbnails - se cortan en la derecha -->
                        <div class="w-1/3 flex gap-4 pr-0" style="margin-right: -100px;">

                            @foreach($this->getOrderedThumbnails() as $position => $thumbnailData)
                                <div wire:key="thumbnail-{{ $thumbnailData['index'] }}-active-{{ $currentSlide }}"
                                     wire:click="goToSlide({{ $thumbnailData['index'] }})"
                                     class="flex-shrink-0 cursor-pointer transition-all duration-500 ease-in-out transform hover:scale-105"
                                     style="width: 250px;">

                                    <div class="relative h-[350px] rounded-xl overflow-hidden shadow-lg">
                                        <img src="{{ asset($thumbnailData['slide']['thumbnail_image']) }}"
                                             class="w-full h-full object-cover transition-all duration-500" alt="">

                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent">
                                            <div class="absolute bottom-2 left-3 text-white">
                                                <p class="text-xs font-semibold">{{ $thumbnailData['slide']['subtitle'] }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Descripción solo para el primer thumbnail (posición 0) --}}
                                    @if($this->shouldShowDescription($position))
                                        <div class="mt-3 px-1 transition-all duration-500 animate-fade-in"
                                             wire:key="description-{{ $thumbnailData['index'] }}-{{ $currentSlide }}">
                                            <h4 class="font-bold text-sm text-gray-900 leading-tight mb-1">
                                                {{ $thumbnailData['slide']['title'] }}
                                            </h4>
                                            <p class="text-xs text-gray-600 leading-relaxed">
                                                {{ $thumbnailData['slide']['description'] }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="lg:hidden">
                        @include('livewire.front.partials.feature-slider-mobile')
                    </div>
                @else
                    <div class="hidden lg:flex items-start gap-6">
                        <!-- Thumbnails - overflow solo del lado izquierdo -->
                        <div class="w-1/3 flex gap-4" style="margin-left: -295px; min-width: calc(48%);">
                            @php
                                $allThumbnails = $this->getOrderedThumbnails();
                                $limitedThumbnails = array_reverse(array_slice($allThumbnails, -3));
                            @endphp

                            @foreach($limitedThumbnails as $position => $thumbnailData)
                                <div wire:key="thumbnail-right-{{ $thumbnailData['index'] }}-active-{{ $currentSlide }}"
                                     wire:click="goToSlide({{ $thumbnailData['index'] }})"
                                     class="flex-shrink-0 cursor-pointer transition-all duration-500 ease-in-out transform hover:scale-105"
                                     style="width: 250px;">

                                    <div class="relative h-[350px] rounded-xl overflow-hidden shadow-lg">
                                        <img src="{{ asset($thumbnailData['slide']['thumbnail_image']) }}"
                                             class="w-full h-full object-cover transition-all duration-500" alt="">

                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent">
                                            <div class="absolute bottom-2 left-3 text-white">
                                                <p class="text-xs font-semibold">{{ $thumbnailData['slide']['subtitle'] }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    @if($position === 2)
                                        <div class="mt-3 px-1 transition-all duration-500 animate-fade-in"
                                             wire:key="description-right-{{ $thumbnailData['index'] }}-{{ $currentSlide }}">
                                            <h4 class="font-bold text-sm text-gray-900 leading-tight mb-1">
                                                {{ $thumbnailData['slide']['title'] }}
                                            </h4>
                                            <p class="text-xs text-gray-600 leading-relaxed">
                                                {{ $thumbnailData['slide']['description'] }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Imagen Principal -->
                        <div class="w-2/3 mr-10 flex-shrink-0">
                            <div
                                class="relative h-[500px] rounded-2xl overflow-hidden bg-gray-200 main-image-container shadow-2xl">
                                <img
                                    src="{{ asset($this->getCurrentSlide()['main_image']) }}"
                                    class="w-full h-full object-cover animate-slide-in"
                                    alt=""
                                    wire:key="main-right-{{ $currentSlide }}">

                                <div class="absolute inset-0">
                                    <div class="absolute bottom-6 right-6 text-white text-right animate-fade-in">
                                        <h3 class="text-2xl font-bold mb-2">{{ $this->getCurrentSlide()['title'] }}</h3>
                                        <p class="text-lg opacity-90">{{ $this->getCurrentSlide()['subtitle'] }}</p>
                                        <p class="text-sm opacity-80 mt-1">{{ $this->getCurrentSlide()['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:hidden">
                        @include('livewire.front.partials.feature-slider-mobile')
                    </div>
                @endif
            </div>

            <!-- Dots -->
            @if($featureData['navigation']['dots_enabled'])
                <div class="{{ $featureData['navigation']['dots_container_class'] }}">
                    @foreach($featureData['slides'] as $index => $slide)
                        <button wire:click="goToSlide({{ $index }})"
                                class="transition-all duration-200 {{ $currentSlide === $index ? $featureData['navigation']['active_dot_style'] : $featureData['navigation']['dots_style'] }}">
                        </button>
                    @endforeach
                </div>
            @endif

        </section>
    @endif
</div>
