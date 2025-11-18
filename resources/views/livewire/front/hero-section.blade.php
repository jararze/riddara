<!-- resources/views/livewire/hero-section.blade.php -->
{{--<section class="relative min-h-[65vh] sm:min-h-[75vh] md:min-h-[80vh] lg:min-h-[85vh] xl:min-h-[90vh] overflow-hidden"--}}
<section class="relative overflow-hidden bg-black lg:!h-[calc(100vh-80px)] lg:!h-[calc(100svh-80px)]"
         style="height: calc(100vh - 64px); height: calc(100svh - 64px);"
         x-data="{
                currentSlide: @entangle('currentSlide'),
                totalSlides: {{ count($heroConfig['slides']) }},
                autoplay: {{ $heroConfig['autoplay'] ? 'true' : 'false' }},
                interval: null,
                currentVideo: null,
                videoProgress: @entangle('videoProgress'),

                startAutoplay() {
                    if (this.autoplay && this.getCurrentSlideType() === 'image') {
                        this.interval = setInterval(() => {
                            $wire.nextSlide();
                        }, {{ $heroConfig['autoplay_interval'] }});
                    }
                },

                stopAutoplay() {
                    if (this.interval) {
                        clearInterval(this.interval);
                        this.interval = null;
                    }
                },

                getCurrentSlideType() {
                    const slides = @js($heroConfig['slides']);
                    return slides[this.currentSlide]?.media_type || 'image';
                },

                optimizeVideoLoading() {
                    // Optimizar carga de videos adyacentes
                    const videos = this.$el.querySelectorAll('video');
                    videos.forEach((video, index) => {
                        if (index === this.currentSlide) {
                            // Video actual: carga completa
                            video.preload = 'auto';
                            if (!video.src && video.querySelector('source')) {
                                video.load();
                            }
                        } else if (Math.abs(index - this.currentSlide) === 1 ||
                                  (this.currentSlide === 0 && index === this.totalSlides - 1) ||
                                  (this.currentSlide === this.totalSlides - 1 && index === 0)) {
                            // Videos adyacentes: solo metadata
                            video.preload = 'metadata';
                        } else {
                            // Videos lejanos: no cargar
                            video.preload = 'none';
                        }
                    });
                },

                handleSlideChange() {
                    this.stopAutoplay();
                    this.optimizeVideoLoading();

                    if (this.getCurrentSlideType() === 'image') {
                        setTimeout(() => this.startAutoplay(), 100);
                    }

                    if (this.getCurrentSlideType() === 'video') {
                        this.$nextTick(() => {
                            this.setupVideoEvents();
                        });
                    }
                },

                setupVideoEvents() {
                    const video = this.$el.querySelector('.current-video');
                    if (video) {
                        this.currentVideo = video;

                        // Solo configurar eventos si no están ya configurados
                        if (!video.hasAttribute('data-events-setup')) {
                            video.setAttribute('data-events-setup', 'true');

                            video.addEventListener('loadedmetadata', () => {
                                $wire.updateVideoProgress(0, video.duration);
                            });

                            video.addEventListener('timeupdate', () => {
                                $wire.updateVideoProgress(video.currentTime, video.duration);
                            });

                            video.addEventListener('ended', () => {
                                $wire.videoEnded();
                            });

                            video.addEventListener('error', (e) => {
                                console.warn('Video loading error, skipping to next slide');
                                setTimeout(() => $wire.nextSlide(), 1000);
                            });
                        }

                        // Intentar reproducir si está pausado
                        if (video.paused && video.readyState >= 3) {
                            video.play().catch(console.warn);
                        }
                    }
                }
            }"
         x-init="
                handleSlideChange();
                $watch('currentSlide', () => handleSlideChange());
            "
         @mouseenter="stopAutoplay(); if(currentVideo) currentVideo.pause()"
         @mouseleave="startAutoplay(); if(currentVideo && !$wire.isPaused) currentVideo.play()"
>
    {{-- Slides Container --}}
    @foreach($heroConfig['slides'] as $index => $slide)
        <div
            class="absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $currentSlide === $index ? 'opacity-100' : 'opacity-0' }}">

            {{-- Background Media --}}
            @if($slide['media_type'] === 'video' && !($slide['only_image'] ?? false))
                @php
                    $isCurrentSlide = $currentSlide === $index;
                    $totalSlides = count($heroConfig['slides']);
                    $isNextSlide = $index === (($currentSlide + 1) % $totalSlides);
                    $isPrevSlide = $index === (($currentSlide - 1 + $totalSlides) % $totalSlides);
                    $isAdjacent = $isNextSlide || $isPrevSlide;
                @endphp

                @php
                    $isCurrentSlide = $currentSlide === $index;
                    $totalSlides = count($heroConfig['slides']);
                    $isNextSlide = $index === (($currentSlide + 1) % $totalSlides);
                    $isPrevSlide = $index === (($currentSlide - 1 + $totalSlides) % $totalSlides);
                    $isAdjacent = $isNextSlide || $isPrevSlide;
                @endphp

                <video
                    class="absolute inset-0 w-full h-full object-{{ $slide['media_fit'] ?? 'cover' }} object-{{ $slide['media_position'] ?? 'center' }} {{ $isCurrentSlide ? 'current-video' : '' }}"
                    @if($isCurrentSlide)
                        preload="auto"
                    @if($slide['video_autoplay']) autoplay @endif
                    @elseif($isAdjacent)
                        preload="metadata"
                    @else
                        preload="none"
                    @endif
                    @if($slide['video_muted']) muted @endif
                    @if($slide['video_loop']) loop @endif
                    playsinline
                    webkit-playsinline
                    poster="{{ $slide['video_poster'] ?? '' }}"
                >
                    <source src="{{ $slide['media_src'] }}" type="video/mp4">
                </video>
            @else
                @if(isset($slide['media_background']))
                    <div class="absolute inset-0 {{ $slide['media_background'] }}"></div>
                @endif

                {{-- Detectar si usar imagen móvil --}}
                @php
                    $imageSrc = $slide['media_src'];
                    if (isset($slide['media_src_mobile']) && $slide['media_src_mobile']) {
                        // Usar JavaScript para detectar tamaño de pantalla
                        $imageSrc = $slide['media_src'];
                    }
                @endphp

                    {{-- Imagen Desktop --}}
                    <img
                        src="{{ $slide['media_src'] }}"
                        alt="Hero background"
                        class="absolute inset-0 w-full h-full object-cover hidden sm:block"
                    />

                    {{-- Imagen Mobile --}}
                    @if(isset($slide['media_src_mobile']) && $slide['media_src_mobile'])
                        <img
                            src="{{ $slide['media_src_mobile'] }}"
                            alt="Hero background mobile"
                            class="absolute inset-0 w-full h-full object-cover block sm:hidden"
                        />
                    @else
                        <img
                            src="{{ $slide['media_src'] }}"
                            alt="Hero background"
                            class="absolute inset-0 w-full h-full object-cover block sm:hidden"
                        />
                    @endif
            @endif

            {{-- Overlay --}}
            @if(!($slide['only_image'] ?? false) || ($slide['buttons'] ?? false))
                <div class="absolute inset-0 bg-black" style="opacity: {{ $slide['overlay_opacity'] }}"></div>
            @endif

            {{-- Content Container con Grid 3x3 - Solo si no es only_image --}}
            @if(!($slide['only_image'] ?? false) || ($slide['buttons'] ?? false))
                <div class="relative z-10 container mx-auto px-4 h-screen">
                    <div class="h-full grid grid-rows-3 grid-cols-3">

                        @php
                            // Agrupar elementos por posición
                            $positionGroups = [];

                            // Título
                            $titlePosition = $slide['title']['position'] ?? 'top-left';
                            $positionGroups[$titlePosition][] = [
                                'type' => 'title',
                                'data' => $slide['title'] ?? [],
                                'order' => 1
                            ];

                            // Subtítulo
                            if(isset($slide['subtitle']['text']) && $slide['subtitle']['text']) {
                                $subtitlePosition = $slide['subtitle']['position'] ?? 'top-left';
                                $positionGroups[$subtitlePosition][] = [
                                    'type' => 'subtitle',
                                    'data' => $slide['subtitle'],
                                    'order' => 2
                                ];
                            }

                            // Descripción
                            if(isset($slide['description']['text']) && $slide['description']['text']) {
                                $descriptionPosition = $slide['description']['position'] ?? 'top-left';
                                $positionGroups[$descriptionPosition][] = [
                                    'type' => 'description',
                                    'data' => $slide['description'],
                                    'order' => 3
                                ];
                            }

                            // Botones
                            if(isset($slide['primary_button']['show']) && $slide['primary_button']['show']) {
                                $buttonPosition = $slide['button_container']['position'] ?? 'top-left';
                                $positionGroups[$buttonPosition][] = [
                                    'type' => 'buttons',
                                    'data' => [
                                        'primary_button' => $slide['primary_button'],
                                        'secondary_button' => $slide['secondary_button'] ?? [],
                                        'button_container' => $slide['button_container'] ?? []
                                    ],
                                    'order' => 4
                                ];
                            }

                            // Ordenar elementos dentro de cada grupo
                            foreach($positionGroups as $position => $elements) {
                                usort($positionGroups[$position], function($a, $b) {
                                    return $a['order'] <=> $b['order'];
                                });
                            }
                        @endphp

                        {{-- Renderizar cada grupo de posición --}}
                        @foreach($positionGroups as $position => $elements)
                            @php
                                [$row, $col] = match($position) {
                                    'top-left' => [1, 1],
                                    'top-middle' => [1, 2],
                                    'top-right' => [1, 3],
                                    'middle-left' => [2, 1],
                                    'middle-middle' => [2, 2],
                                    'middle-right' => [2, 3],
                                    'bottom-left' => [3, 1],
                                    'bottom-middle' => [3, 2],
                                    'bottom-right' => [3, 3],
                                    default => [1, 1]
                                };
                            @endphp

                            <div class="
                    row-start-{{ $row }} col-start-{{ $col }}
                    @if(str_contains($position, 'top')) self-start
                    @elseif(str_contains($position, 'middle')) self-center
                    @else self-end
                    @endif
                    @if(str_contains($position, 'left')) justify-self-start
                    @elseif(str_contains($position, 'middle')) justify-self-center
                    @else justify-self-end
                    @endif
                    max-w-md lg:max-w-lg xl:max-w-2xl
                ">
                                {{-- Renderizar elementos en orden --}}
                                @foreach($elements as $elementIndex => $element)
                                    @if($element['type'] === 'title')
                                        @if(!($slide['only_image'] ?? false) || ($slide['show_title'] ?? false))
                                        <div class="
                                {{ $element['data']['margin_top'] ?? 'mt-6' }}
                                {{ $element['data']['margin_bottom'] ?? 'mb-4' }}
                                @if(str_contains($position, 'middle')) text-center
                                @elseif(str_contains($position, 'right')) text-right
                                @else text-left
                                @endif
                                {{ $element['data']['max_width'] ?? 'max-w-2xl' }}
                            ">
                                            <h1 class="font-geely-title {{ $element['data']['font_size'] ?? 'text-4xl md:text-6xl' }} {{ $element['data']['font_weight'] ?? 'font-bold' }} {{ $element['data']['text_color'] ?? 'text-white' }} {{ $element['data']['line_height'] ?? 'leading-tight' }} {{ $element['data']['letter_spacing'] ?? 'tracking-normal' }}
                                    @if(($element['data']['line_wrap'] ?? 'wrap') === 'nowrap') whitespace-nowrap
                                    @elseif(($element['data']['line_wrap'] ?? 'wrap') === 'break-words') break-words
                                    @else whitespace-normal
                                    @endif
                                ">
                                                @if(isset($element['data']['highlight_text']) && $element['data']['highlight_text'])
                                                    {!! str_replace(
                                                        $element['data']['highlight_text'],
                                                        '<span class="bg-gradient-to-r text-transparent bg-clip-text" style="background-image: linear-gradient(to right, ' . ($element['data']['gradient_from'] ?? '#FF5B00') . ', ' . ($element['data']['gradient_to'] ?? '#fb923c') . ')">' . $element['data']['highlight_text'] . '</span>',
                                                        $element['data']['text'] ?? 'Título'
                                                    ) !!}
                                                @else
                                                    {{ $element['data']['text'] ?? 'Título' }}
                                                @endif
                                            </h1>
                                        </div>
                                        @endif

                                    @elseif($element['type'] === 'subtitle')
                                        @if(!($slide['only_image'] ?? false) || ($slide['show_subtitle'] ?? false))
                                            <div class="
                                                {{ $element['data']['margin_top'] ?? 'mt-6' }}
                                                {{ $element['data']['margin_bottom'] ?? 'mb-4' }}
                                                @if(str_contains($position, 'middle')) text-center
                                                @elseif(str_contains($position, 'right')) text-right
                                                @else text-left
                                                @endif
                                                {{ $element['data']['max_width'] ?? 'max-w-2xl' }}
                                            ">
                                                <h3 class="{{ $element['data']['font_size'] ?? 'text-xl md:text-2xl' }} {{ $element['data']['font_weight'] ?? 'font-light' }} {{ $element['data']['text_color'] ?? 'text-white/90' }}
                                                    @if(($element['data']['line_wrap'] ?? 'wrap') === 'nowrap') whitespace-nowrap
                                                    @elseif(($element['data']['line_wrap'] ?? 'wrap') === 'break-words') break-words
                                                    @else whitespace-normal
                                                    @endif
                                                ">
                                                    {{ $element['data']['text'] }}
                                                </h3>
                                            </div>
                                        @endif

                                    @elseif($element['type'] === 'description')
                                        @if(!($slide['only_image'] ?? false) || ($slide['show_description'] ?? false))
                                        <div class="
                                            {{ $element['data']['margin_top'] ?? 'mt-6' }}
                                            {{ $element['data']['margin_bottom'] ?? 'mb-4' }}
                                            @if(str_contains($position, 'middle')) text-center
                                            @elseif(str_contains($position, 'right')) text-right
                                            @else text-left
                                            @endif
                                            {{ $element['data']['max_width'] ?? 'max-w-2xl' }}
                                        ">
                                            <p class="{{ $element['data']['font_size'] ?? 'text-lg' }} {{ $element['data']['font_weight'] ?? 'font-normal' }} {{ $element['data']['text_color'] ?? 'text-white/80' }}
                                                @if(($element['data']['line_wrap'] ?? 'wrap') === 'nowrap') whitespace-nowrap
                                                @elseif(($element['data']['line_wrap'] ?? 'wrap') === 'break-words') break-words
                                                @else whitespace-normal
                                                @endif
                                            ">
                                                @if(isset($element['data']['highlight_text']) && $element['data']['highlight_text'])
                                                    {!! str_replace(
                                                        $element['data']['highlight_text'],
                                                        '<span class="' . ($element['data']['highlight_style'] ?? 'font-semibold') . '">' . $element['data']['highlight_text'] . '</span>',
                                                        $element['data']['text']
                                                    ) !!}
                                                @else
                                                    {{ $element['data']['text'] }}
                                                @endif
                                            </p>
                                        </div>
                                        @endif

                                    @elseif($element['type'] === 'buttons')
                                        {{-- Solo mostrar botones si no es only_image O si buttons está habilitado --}}
                                        @if(!($slide['only_image'] ?? false) || ($slide['buttons'] ?? false))
                                            <div class="
                                                @if($elementIndex > 0) {{ $element['data']['button_container']['margin_top'] ?? 'mt-6' }} @endif
                                                {{ $element['data']['button_container']['margin_bottom'] ?? '' }}
                                                @if(str_contains($position, 'middle')) flex justify-center
                                                @elseif(str_contains($position, 'right')) flex justify-end
                                                @else flex justify-start
                                                @endif
                                            ">
                                                <div class="flex {{ $element['data']['button_container']['layout'] ?? 'flex-col sm:flex-row' }} {{ $element['data']['button_container']['gap'] ?? 'gap-4' }}">
                                                    {{-- Primary Button --}}
                                                    <button class="{{ $element['data']['primary_button']['bg_color'] ?? 'bg-black' }} {{ $element['data']['primary_button']['text_color'] ?? 'text-white' }} {{ $element['data']['primary_button']['hover_bg'] ?? 'hover:bg-black/90' }} {{ $element['data']['primary_button']['hover_scale'] ?? 'hover:scale-105' }} {{ $element['data']['primary_button']['size'] ?? 'px-8 py-4 text-lg' }} {{ $element['data']['primary_button']['font_weight'] ?? 'font-semibold' }} {{ $element['data']['primary_button']['border_radius'] ?? 'rounded-lg' }} transition-all duration-300 flex items-center gap-2
                                                        @if(($element['data']['primary_button']['style'] ?? 'solid') === 'outline')
                                                            border-2 border-current bg-transparent
                                                        @endif
                                                    ">
                                                        {{-- Icon Left --}}
                                                        @if(($element['data']['primary_button']['icon_position'] ?? 'right') === 'left' && ($element['data']['primary_button']['icon'] ?? 'arrow-right') !== 'none')
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                            </svg>
                                                        @endif

                                                        {{ $element['data']['primary_button']['text'] ?? 'Botón' }}

                                                        {{-- Icon Right --}}
                                                        @if(($element['data']['primary_button']['icon_position'] ?? 'right') === 'right' && ($element['data']['primary_button']['icon'] ?? 'arrow-right') !== 'none')
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                            </svg>
                                                        @endif
                                                    </button>

                                                    {{-- Secondary Button --}}
                                                    @if(isset($element['data']['secondary_button']['show']) && $element['data']['secondary_button']['show'])
                                                        <button class="{{ $element['data']['secondary_button']['bg_color'] ?? 'bg-transparent' }} {{ $element['data']['secondary_button']['text_color'] ?? 'text-white' }} {{ $element['data']['secondary_button']['border_width'] ?? 'border-2' }} {{ $element['data']['secondary_button']['border_color'] ?? 'border-white/70' }} {{ $element['data']['secondary_button']['hover_bg'] ?? 'hover:bg-white/10' }} {{ $element['data']['secondary_button']['size'] ?? 'px-8 py-4 text-lg' }} {{ $element['data']['secondary_button']['font_weight'] ?? 'font-semibold' }} {{ $element['data']['secondary_button']['border_radius'] ?? 'rounded-lg' }} transition-all duration-300">
                                                            {{ $element['data']['secondary_button']['text'] ?? 'Botón 2' }}
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endforeach

    {{-- Navigation Arrows --}}
    @if($heroConfig['show_arrows'] && count($heroConfig['slides']) > 1)
        <button
            wire:click="nextSlide"
            class="absolute right-6 top-1/2 transform -translate-y-1/2 rounded-full p-3 text-white transition-all z-20"
            style="background-color: rgba(0, 0, 0, 0.7) !important; backdrop-filter: blur(4px) !important;"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <button
            wire:click="prevSlide"
            class="absolute left-6 top-1/2 transform -translate-y-1/2 rounded-full p-3 text-white transition-all z-20"
            style="background-color: rgba(0, 0, 0, 0.7) !important; backdrop-filter: blur(4px) !important;"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
    @endif

    {{-- Smart Dots/Progress Pagination --}}
    @if($heroConfig['show_dots'] && count($heroConfig['slides']) > 1)
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex items-center space-x-3 z-20">
            @foreach($heroConfig['slides'] as $index => $slide)
                @if($slide['media_type'] === 'video' && $currentSlide === $index)
                    {{-- Video Progress Bar --}}
                    <div class="relative">
                        <div class="w-16 h-1 bg-white/30 rounded-full overflow-hidden">
                            <div
                                class="h-full bg-white transition-all duration-300 rounded-full"
                                :style="`width: ${videoProgress}%`"
                            ></div>
                        </div>
                        <button
                            wire:click="goToSlide({{ $index }})"
                            class="absolute inset-0 w-full h-full"
                        ></button>
                    </div>
                @else
                    {{-- Normal Dot --}}
                    <button
                        wire:click="goToSlide({{ $index }})"
                        class="w-3 h-3 rounded-full transition-all duration-300 {{ $currentSlide === $index ? 'bg-white scale-125' : 'bg-white/50 hover:bg-white/70' }}"
                    ></button>
                @endif
            @endforeach
        </div>
    @endif
</section>
