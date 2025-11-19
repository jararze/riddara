{{-- resources/views/livewire/front/test-drive-section.blade.php --}}
<div>
    @if($layout === 'hero')
        {{-- Layout Hero con posición de imagen configurable --}}
        <section class="test-drive-hero relative {{ $sectionData['section_height'] }}">

            @php
                // Configurar alturas basadas en image_position
                $imageHeight = match($sectionData['image_position'] ?? 'top-half') {
                    'top-third' => ['image' => 'h-1/3', 'content' => 'h-2/3', 'bg_top' => 'h-1/3', 'bg_bottom' => 'h-2/3'],
                    'top-half' => ['image' => 'h-1/2', 'content' => 'h-1/2', 'bg_top' => 'h-1/2', 'bg_bottom' => 'h-1/2'],
                    'top-two-thirds' => ['image' => 'h-2/3', 'content' => 'h-1/3', 'bg_top' => 'h-2/3', 'bg_bottom' => 'h-1/3'],
                    'top-three-quarters' => ['image' => 'h-3/4', 'content' => 'h-1/4', 'bg_top' => 'h-3/4', 'bg_bottom' => 'h-1/4'],
                    default => ['image' => 'h-1/2', 'content' => 'h-1/2', 'bg_top' => 'h-1/2', 'bg_bottom' => 'h-1/2']
                };
            @endphp

            {{-- Fondo superior --}}
            <div class="absolute top-0 left-0 right-0 {{ $imageHeight['bg_top'] }}"
                 style="background-color: {{ $sectionData['top_background_color'] ?? '#ffffff' }};"></div>

            {{-- Fondo inferior --}}
            <div class="absolute bottom-0 left-0 right-0 {{ $imageHeight['bg_bottom'] }}"
                 style="background: {{ $sectionData['background_color'] }};"></div>

            <div class="container mx-auto px-4 h-full relative z-10">
                <div class="flex flex-col h-full">

                    {{-- Sección de imagen --}}
                    @if($sectionData['show_image'])
                        <div class="{{ $imageHeight['image'] }} flex items-center justify-center py-8">
                            <div class="max-w-4xl w-full h-full">
                                {{-- Imagen para móvil (visible en pantallas pequeñas) --}}
                                <img src="{{ asset($sectionData['background_image_mobile']) }}"
                                     alt="Test Drive"
                                     class="w-full h-full object-cover rounded-lg shadow-lg block md:hidden">

                                {{-- Imagen para desktop (visible en pantallas medianas y grandes) --}}
                                <img src="{{ asset($sectionData['background_image']) }}"
                                     alt="Test Drive"
                                     class="w-full h-full object-cover rounded-lg shadow-lg hidden md:block">
                            </div>
                        </div>
                    @endif

                    {{-- Sección de contenido --}}
                    <div class="{{ $imageHeight['content'] }} flex flex-col justify-center py-8">
                        <div class="max-w-6xl mx-auto w-full">
                            <h2 class="text-3xl lg:text-5xl font-bold mb-8"
                                style="color: {{ $sectionData['text_color'] }}; color: #FFFFFF">
                                {{ $sectionData['title'] }}
                            </h2>

                            @if($sectionData['show_features'])
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                                    @foreach($sectionData['features'] as $feature)
                                        <div class="text-sm">
                                            <h3 class="font-bold text-base mb-3"
                                                style="color: {{ $sectionData['text_color'] }};">
                                                {{ $feature['title'] }}
                                            </h3>
                                            <p class="text-sm leading-relaxed"
                                               style="color: {{ $sectionData['text_color'] }}; opacity: 0.9;">
                                                {{ $feature['description'] }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mb-6">
                                <p class="text-lg mb-2" style="color: {{ $sectionData['text_color'] }};">
                                    {{ $sectionData['description'] }}
                                </p>
                                <p class="text-lg font-bold" style="color: {{ $sectionData['text_color'] }};">
                                    {{ $sectionData['cta_text'] }}
                                </p>
                            </div>

                            <a href="{{ $sectionData['button_url'] }}"
                               class="inline-block px-8 py-3 bg-black hover:bg-gray-800 text-white font-medium transition-colors duration-300">
                                {{ $sectionData['button_text'] }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @elseif($layout === 'overlay-left')
        {{-- Layout con imagen y texto superpuesto a la izquierda --}}
        <section class="test-drive-overlay relative"
                 style="height: 800px; @if(!$sectionData['show_image']) background: {{ $sectionData['background_color'] }}; @endif">

            @if($sectionData['show_image'])
                <div class="absolute inset-0 z-0 w-full h-full">
                    {{-- Imagen para móvil (visible en pantallas pequeñas) --}}
                    <img src="{{ asset($sectionData['background_image_mobile']) }}"
                         alt="Test Drive"
                         class="block md:hidden"
                         style="width: 100%; height: 100%; object-fit: cover; object-position: center;">

                    {{-- Imagen para desktop (visible en pantallas medianas y grandes) --}}
                    <img src="{{ asset($sectionData['background_image']) }}"
                         alt="Test Drive"
                         class="hidden md:block"
                         style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                </div>
            @endif

                <div class="relative z-10 container mx-auto px-4 h-full">
                    <div class="flex items-start h-full pt-8 md:pt-15 pb-16 px-4">
                        <div class="max-w-lg">
                            <h2 class="text-3xl lg:text-5xl font-bold mb-6 text-{{ $sectionData['text_color_phone'] }} md:text-{{ $sectionData['text_color'] }}" style="color: {{ $sectionData['text_color'] }};">
{{--                                @dd($sectionData['text_color_phone'],  $sectionData['text_color'])--}}
                                {{ $sectionData['title'] }}
                            </h2>

                            <div class="mb-8 space-y-2">
                                <p class="text-base leading-relaxed text-{{ $sectionData['text_color_phone'] }} md:text-{{ $sectionData['text_color'] }}" style="color: {{ $sectionData['text_color'] }};">
                                    {{ $sectionData['description'] }}
                                </p>
                                <p class="text-base font-bold text-{{ $sectionData['text_color_phone'] }} md:text-{{ $sectionData['text_color'] }}" style="color: {{ $sectionData['text_color'] }};">
                                    {{ $sectionData['cta_text'] }}
                                </p>
                            </div>

                            <a href="{{ $sectionData['button_url'] }}"
                               class="inline-block px-8 py-3 bg-black hover:bg-gray-800 text-white font-medium transition-colors duration-300">
                                {{ $sectionData['button_text'] }}
                            </a>
                        </div>
                    </div>
                </div>
        </section>

    @elseif($layout === 'banner')
        {{-- Layout banner horizontal --}}
        <section class="test-drive-banner py-12"
                 style="background: {{ $sectionData['background_color'] }};">
            <div class="container mx-auto px-4">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                    <div class="flex-1">
                        <h2 class="text-2xl lg:text-3xl font-bold mb-3"
                            style="color: {{ $sectionData['text_color'] }};">
                            {{ $sectionData['title'] }}
                        </h2>
                        <div class="text-sm lg:text-base">
                            <p style="color: {{ $sectionData['text_color'] }};">
                                {{ $sectionData['description'] }}
                            </p>
                            <p class="font-semibold" style="color: {{ $sectionData['text_color'] }};">
                                {{ $sectionData['cta_text'] }}
                            </p>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ $sectionData['button_url'] }}"
                           class="inline-block px-8 py-3 bg-black hover:bg-gray-800 text-white font-medium transition-colors duration-300">
                            {{ $sectionData['button_text'] }}
                        </a>
                    </div>
                </div>
            </div>
        </section>

    @elseif($layout === 'banner-thin')
        {{-- Layout banner horizontal delgado con container --}}
        <div class="py-6">
            <div class="container mx-auto px-4">
                <section class="test-drive-banner-thin py-6 rounded-lg"
                         style="background: {{ $sectionData['background_color'] }};">
                    <div class="px-6">
                        <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                            <div class="flex-1">
                                <h2 class="text-xl lg:text-2xl font-bold"
                                    style="color: {{ $sectionData['text_color'] }};">
                                    {{ $sectionData['title'] }}
                                </h2>
                                <div class="text-sm">
                                    <span
                                        style="color: {{ $sectionData['text_color'] }};">{{ $sectionData['description'] }}</span> <br />
                                    <span class="font-semibold ml-2"
                                          style="color: {{ $sectionData['text_color'] }};">{{ $sectionData['cta_text'] }}</span>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="{{ $sectionData['button_url'] }}"
                                   class="inline-block px-6 py-2 bg-black hover:bg-gray-800 text-white font-medium text-sm transition-colors duration-300">
                                    {{ $sectionData['button_text'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    @endif
</div>
