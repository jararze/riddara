<div>
    <section class="{{ $galleryData['section_background'] }} {{ $galleryData['section_padding'] }}">
        <div class="container mx-auto px-5">

            {{-- Header opcional --}}
            @if($galleryData['header']['show_header'])
                <div class="text-left mb-12">
                    <h2 class="{{ $galleryData['header']['title_size'] }} {{ $galleryData['header']['title_color'] }} {{ $galleryData['header']['title_weight'] }}">
                        {{ $galleryData['header']['title'] }}
                    </h2>
                </div>
            @endif
        </div>

        {{-- Desktop Layout --}}
        <div class="hidden lg:block">
            <div class="grid grid-cols-3 gap-0 h-[700px]">

                {{-- Columna 1 - 2 imágenes verticales --}}
                <div class="flex flex-col gap-0">
                    @foreach($this->getImagesByColumn(1) as $image)
                        <div class="relative overflow-hidden h-1/2 group">
                            <img
                                src="{{ asset($image['image']) }}"
                                alt="{{ $image['alt'] }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                            @if(($image['overlay'] ?? false))
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="absolute bottom-4 left-4 text-white">
                                        <p class="text-sm font-medium">{{ $image['alt'] }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Columna 2 - 1 imagen completa --}}
                <div class="flex flex-col gap-0">
                    @foreach($this->getImagesByColumn(2) as $image)
                        <div class="relative overflow-hidden h-full group">
                            <img
                                src="{{ asset($image['image']) }}"
                                alt="{{ $image['alt'] }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                            @if(($image['overlay'] ?? false))
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="absolute bottom-4 left-4 text-white">
                                        <p class="text-sm font-medium">{{ $image['alt'] }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Columna 3 - 2 imágenes verticales --}}
                <div class="flex flex-col gap-0">
                    @foreach($this->getImagesByColumn(3) as $image)
                        <div class="relative overflow-hidden h-1/2 group">
                            <img
                                src="{{ asset($image['image']) }}"
                                alt="{{ $image['alt'] }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                            @if(($image['overlay'] ?? false))
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="absolute bottom-4 left-4 text-white">
                                        <p class="text-sm font-medium">{{ $image['alt'] }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        {{-- Mobile Layout (Vertical Stack) --}}
        <div class="lg:hidden">
            <div>
                @foreach($galleryData['images'] as $image)
                    <div class="overflow-hidden">
                        <img src="{{ asset($image['image']) }}"
                             alt="{{ $image['alt'] }}"
                             class="w-full h-64 object-cover">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        /* Animaciones adicionales */
        @keyframes zoomIn {
            from {
                transform: scale(1);
            }
            to {
                transform: scale(1.05);
            }
        }

        .group:hover img {
            animation: zoomIn 0.5s ease-in-out forwards;
        }
    </style>
</div>
