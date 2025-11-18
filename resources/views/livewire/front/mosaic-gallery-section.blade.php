<div>
    <section class="{{ $galleryData['section_background'] }} {{ $galleryData['section_padding'] }}">
        <div class="container mx-auto px-0">

            {{-- Header opcional --}}
            @if($galleryData['header']['show_header'])
                <div class="text-left mb-12">
                    <h2 class="{{ $galleryData['header']['title_size'] }} {{ $galleryData['header']['title_color'] }} {{ $galleryData['header']['title_weight'] }}">
                        {{ $galleryData['header']['title'] }}
                    </h2>
                </div>
            @endif
        </div>
        <div class="hidden lg:block">
            {{-- Grid de mosaico --}}
            <div
                class="grid grid-cols-{{ $galleryData['layout']['columns'] }} {{ $galleryData['layout']['gap'] }} {{ $galleryData['layout']['container_height'] }}">

                @for($col = 1; $col <= $galleryData['layout']['columns']; $col++)
                    <div class="flex flex-col {{ $galleryData['layout']['gap'] }}">
                        @foreach($this->getImagesByColumn($col) as $image)
                            <div
                                class="relative overflow-hidden {{ $image['row_span'] == 2 ? 'flex-1' : 'h-1/2' }} group">
                                <img
                                    src="{{ asset($image['image']) }}"
                                    alt="{{ $image['alt'] }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                                @if(($image['overlay'] ?? false))
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <div class="absolute bottom-4 left-4 text-white">
                                            <p class="text-sm font-medium">{{ $image['alt'] }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endfor
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
        /* Asegurar que las columnas tengan la misma altura */
        .grid > div {
            min-height: 100%;
        }

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
