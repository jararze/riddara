<div>
    <div x-data="{
    autoplay: {{ $videosData['autoplay']['enabled'] ? 'true' : 'false' }},
    delay: {{ $videosData['autoplay']['delay'] }},
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
         class="{{ $videosData['section_background'] }} {{ $videosData['section_padding'] }}">

        <div class="container mx-auto px-4">
            {{-- Header --}}
            <div class="text-left mb-12">
                <h2 class="{{ $videosData['header']['title_size'] }} font-bold {{ $videosData['header']['title_color'] }} mb-4">
                    {{ $videosData['header']['title'] }}
                </h2>
                <p class="{{ $videosData['header']['subtitle_size'] }} {{ $videosData['header']['subtitle_color'] }}">
                    {{ $videosData['header']['subtitle'] }}
                </p>
            </div>

            {{-- Video Container --}}
            {{-- Video Container --}}
            <div class="max-w-6xl mx-auto">
                @php $currentVideo = $this->getCurrentVideo(); @endphp

                <div class="relative {{ $videosData['section_background'] }} rounded-lg overflow-hidden">
                    {{-- Títulos FUERA del video - arriba --}}
                    <div class="p-6 text-right">
                        <h3 class="text-xxl font-bold bg-gradient-to-r from-[#3B4C39] to-blue-300 bg-clip-text text-transparent mb-1">
                            {{ $currentVideo['subtitle'] ?? '' }}
                        </h3>
                        <p class="text-blue-400 font-xl">
                            {{ $currentVideo['channel'] ?? '' }}
                        </p>
                    </div>

                    {{-- Video Player con altura mínima mejorada para móviles --}}
                    <div class="w-full max-w-6xl mx-auto px-2 sm:px-4">
                        <div class="relative bg-black rounded-lg overflow-hidden shadow-2xl">
                            <div class="relative w-full"
                                 style="aspect-ratio: 16/9; min-height: 300px;"
                                 x-data="{
                                    playing: false,
                                    videoUrl: '{{ $currentVideo['video_url'] ?? 'https://www.youtube.com/embed/POBCHlhgO0Q' }}',
                                    getEmbedUrl() {
                                        // Agregar autoplay cuando se reproduce
                                        return this.videoUrl + (this.videoUrl.includes('?') ? '&' : '?') + 'autoplay=1&rel=0&modestbranding=1';
                                    }
                                 }">

                                {{-- Thumbnail --}}
                                <div x-show="!playing" class="relative w-full h-full">
                                    <img src="{{ asset($currentVideo['thumbnail'] ?? 'frontend/images/default-video.jpg') }}"
                                         alt="{{ $currentVideo['title'] ?? 'Video' }}"
                                         class="w-full h-full object-cover">

                                    {{-- Play Button con tamaño responsive mejorado --}}
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <button @click="playing = true"
                                                class="bg-black bg-opacity-60 rounded-full p-6 sm:p-8 hover:bg-opacity-80 transition-all transform hover:scale-110 active:scale-95 shadow-2xl">
                                            {{-- Icono más grande --}}
                                            <svg class="w-16 h-16 sm:w-20 sm:h-20 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </button>
                                    </div>

                                    {{-- Duration Badge --}}
                                    <div class="absolute bottom-3 right-3 sm:bottom-4 sm:right-4 bg-black bg-opacity-80 text-white px-3 py-2 rounded-md text-sm sm:text-base font-medium">
                                        {{ $currentVideo['duration'] ?? '00:00' }}
                                    </div>
                                </div>

                                {{-- YouTube iframe dinámico --}}
                                <div x-show="playing" x-transition class="w-full h-full">
                                    <iframe x-show="playing"
                                            :src="playing ? getEmbedUrl() : ''"
                                            class="w-full h-full border-0"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen
                                            referrerpolicy="strict-origin-when-cross-origin">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Video Info abajo --}}

                </div>
            </div>

            {{-- Dots Navigation --}}
            <div class="{{ $videosData['navigation']['dots_container_class'] }}">
                <div class="{{ $videosData['navigation']['dots_wrapper_class'] }}">
                    @foreach($videosData['videos'] as $index => $video)
                        <button wire:click="goToSlide({{ $index }})"
                                class="transition-all duration-300 {{ $this->currentSlide === $index ? $videosData['navigation']['active_dot_style'] : $videosData['navigation']['dots_style'] }}">
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Flash Messages --}}
            @if (session()->has('message'))
                <div class="mt-6 bg-blue-100 border border-blue-400 text-[#3B4C39] px-4 py-3 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>
</div>
