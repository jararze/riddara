<div>
    <section class="vehicle-hero relative {{ $heroData['section_height'] }} overflow-hidden">
        {{-- Imagen de fondo --}}
        <div class="absolute inset-0">
            {{-- Imagen para móvil --}}
            @if(isset($heroData['background_image_mobile']) && $heroData['background_image_mobile'])
                <img src="{{ asset($heroData['background_image_mobile']) }}"
                     alt="{{ $heroData['title'] }}"
                     class="w-full h-full object-cover block md:hidden"
                     style="object-position: {{ $heroData['background_position'] }};">
            @endif

            {{-- Imagen para desktop --}}
            <img src="{{ asset($heroData['background_image']) }}"
                 alt="{{ $heroData['title'] }}"
                 class="w-full h-full object-cover hidden md:block"
                 style="object-position: {{ $heroData['background_position'] }};">

            {{-- Overlay base --}}

            {{-- Fadeout gradient --}}
            @if($heroData['fadeout_enabled'])
                @php
                    $fadeoutColor = $heroData['fadeout_color'];
                    $fadeoutOpacity = $heroData['fadeout_opacity'];

                    // Convertir hex a rgb para usar con opacity
                    $hex = str_replace('#', '', $fadeoutColor);
                    $r = hexdec(substr($hex, 0, 2));
                    $g = hexdec(substr($hex, 2, 2));
                    $b = hexdec(substr($hex, 4, 2));
                    $rgbColor = "$r, $g, $b";

                    $gradientStyle = match($heroData['fadeout_direction']) {
                        'to-bottom' => "background: linear-gradient(to bottom, rgba($rgbColor, 0) 0%, rgba($rgbColor, 0) " . (100 - (int)str_replace('%', '', $heroData['fadeout_height'])) . "%, rgba($rgbColor, $fadeoutOpacity) 100%);",
                        'to-top' => "background: linear-gradient(to top, rgba($rgbColor, 0) 0%, rgba($rgbColor, 0) " . (100 - (int)str_replace('%', '', $heroData['fadeout_height'])) . "%, rgba($rgbColor, $fadeoutOpacity) 100%);",
                        'to-left' => "background: linear-gradient(to left, rgba($rgbColor, 0) 0%, rgba($rgbColor, 0) " . (100 - (int)str_replace('%', '', $heroData['fadeout_height'])) . "%, rgba($rgbColor, $fadeoutOpacity) 100%);",
                        'to-right' => "background: linear-gradient(to right, rgba($rgbColor, 0) 0%, rgba($rgbColor, 0) " . (100 - (int)str_replace('%', '', $heroData['fadeout_height'])) . "%, rgba($rgbColor, $fadeoutOpacity) 100%);",
                        default => "background: linear-gradient(to bottom, rgba($rgbColor, 0) 50%, rgba($rgbColor, $fadeoutOpacity) 100%);"
                    };
                @endphp

                <div class="absolute inset-0" style="{{ $gradientStyle }}"></div>
            @endif
        </div>

        {{-- Contenido principal --}}
        <div class="relative z-10 h-full flex items-center">
            <div class="container mx-auto px-4">

                @if($layout === 'center')
                    {{-- Layout centrado --}}
                    <div class="text-center">
                        @if($heroData['title_type'] === 'image')
                            <img src="{{ asset($heroData['title_image']) }}"
                                 alt="{{ $heroData['title_image_alt'] ?: $heroData['title'] }}"
                                 class="{{ $heroData['title_image_width'] }} {{ $heroData['title_image_height'] }} mx-auto mb-2 ">
                        @else
                            <h1 class="{{ $heroData['title_size'] }} {{ $heroData['title_weight'] }} {{ $heroData['title_spacing'] }} mb-2 ml-7"
                                style="color: {{ $heroData['title_color'] }};">
                                {{ $heroData['title'] }}
                            </h1>
                        @endif

                        <p class="{{ $heroData['subtitle_size'] }} {{ $heroData['subtitle_weight'] }} {{ $heroData['subtitle_spacing'] }}"
                           style="color: {{ $heroData['subtitle_color'] }}; margin-top: 20px">
                            {{ $heroData['subtitle'] }}
                        </p>
                    </div>

                @elseif($layout === 'left')
                    {{-- Layout izquierda --}}
                    <div class="max-w-2xl">
                        @if($heroData['title_type'] === 'image')
                            <img src="{{ asset($heroData['title_image']) }}"
                                 alt="{{ $heroData['title_image_alt'] ?: $heroData['title'] }}"
                                 class="{{ $heroData['title_image_width'] }} {{ $heroData['title_image_height'] }} mx-auto mb-4">
                        @else
                            <h1 class="{{ $heroData['title_size'] }} {{ $heroData['title_weight'] }} {{ $heroData['title_spacing'] }} mb-4 ml-5"
                                style="color: {{ $heroData['title_color'] }};">
                                {{ $heroData['title'] }}
                            </h1>
                        @endif

                        <p class="{{ $heroData['subtitle_size'] }} {{ $heroData['subtitle_weight'] }} {{ $heroData['subtitle_spacing'] }}"
                           style="color: {{ $heroData['subtitle_color'] }};">
                            {{ $heroData['subtitle'] }}
                        </p>
                    </div>

                @elseif($layout === 'right')
                    {{-- Layout derecha --}}
                    <div class="text-right ml-auto max-w-2xl">
                        @if($heroData['title_type'] === 'image')
                            <img src="{{ asset($heroData['title_image']) }}"
                                 alt="{{ $heroData['title_image_alt'] ?: $heroData['title'] }}"
                                 class="{{ $heroData['title_image_width'] }} {{ $heroData['title_image_height'] }} mx-auto mb-4">
                        @else
                            <h1 class="{{ $heroData['title_size'] }} {{ $heroData['title_weight'] }} {{ $heroData['title_spacing'] }} mb-4"
                                style="color: {{ $heroData['title_color'] }};">
                                {{ $heroData['title'] }}
                            </h1>
                        @endif

                        <p class="{{ $heroData['subtitle_size'] }} {{ $heroData['subtitle_weight'] }} {{ $heroData['subtitle_spacing'] }}"
                           style="color: {{ $heroData['subtitle_color'] }};">
                            {{ $heroData['subtitle'] }}
                        </p>
                    </div>

                @elseif($layout === 'top-left')
                    {{-- Layout arriba izquierda --}}
                    <div class="absolute top-10 left-8 max-w-2xl">
                        @if($heroData['title_type'] === 'image')
                            <img src="{{ asset($heroData['title_image']) }}"
                                 alt="{{ $heroData['title_image_alt'] ?: $heroData['title'] }}"
                                 class="{{ $heroData['title_image_width'] }} {{ $heroData['title_image_height'] }} mx-auto mb-2 ml-7">
                        @else
                            <h1 class="{{ $heroData['title_size'] }} {{ $heroData['title_weight'] }} {{ $heroData['title_spacing'] }} mb-2 ml-7"
                                style="color: {{ $heroData['title_color'] }};">
                                {{ $heroData['title'] }}
                            </h1>
                        @endif

                        <p class="{{ $heroData['subtitle_size'] }} {{ $heroData['subtitle_weight'] }} {{ $heroData['subtitle_spacing'] }} left-8"
                           style="color: {{ $heroData['subtitle_color'] }}; margin-left: 35px">
                            {{ $heroData['subtitle'] }}
                        </p>
                    </div>

                @elseif($layout === 'top-right')
                    {{-- Layout arriba derecha --}}
                    <div class="absolute top-20 right-8 max-w-2xl text-right">
                        @if($heroData['title_type'] === 'image')
                            <img src="{{ asset($heroData['title_image']) }}"
                                 alt="{{ $heroData['title_image_alt'] ?: $heroData['title'] }}"
                                 class="{{ $heroData['title_image_width'] }} {{ $heroData['title_image_height'] }} mx-auto mb-4">
                        @else
                            <h1 class="{{ $heroData['title_size'] }} {{ $heroData['title_weight'] }} {{ $heroData['title_spacing'] }} mb-4"
                                style="color: {{ $heroData['title_color'] }};">
                                {{ $heroData['title'] }}
                            </h1>
                        @endif

                        <p class="{{ $heroData['subtitle_size'] }} {{ $heroData['subtitle_weight'] }} {{ $heroData['subtitle_spacing'] }}"
                           style="color: {{ $heroData['subtitle_color'] }};">
                            {{ $heroData['subtitle'] }}
                        </p>
                    </div>

                @elseif($layout === 'bottom-left')
                    {{-- Layout abajo izquierda --}}
                    <div class="absolute bottom-32 left-8 max-w-2xl">
                        @if($heroData['title_type'] === 'image')
                            <img src="{{ asset($heroData['title_image']) }}"
                                 alt="{{ $heroData['title_image_alt'] ?: $heroData['title'] }}"
                                 class="{{ $heroData['title_image_width'] }} {{ $heroData['title_image_height'] }} mx-auto mb-4">
                        @else
                            <h1 class="{{ $heroData['title_size'] }} {{ $heroData['title_weight'] }} {{ $heroData['title_spacing'] }} mb-4"
                                style="color: {{ $heroData['title_color'] }};">
                                {{ $heroData['title'] }}
                            </h1>
                        @endif

                        <p class="{{ $heroData['subtitle_size'] }} {{ $heroData['subtitle_weight'] }} {{ $heroData['subtitle_spacing'] }}"
                           style="color: {{ $heroData['subtitle_color'] }};">
                            {{ $heroData['subtitle'] }}
                        </p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Especificaciones técnicas --}}
        @if($heroData['show_specs'])
            <div class="absolute bottom-0 left-0 right-0 z-20">
                <div class="container mx-auto px-4">

                    @if($heroData['specs_position'] === 'bottom-center')
                        <div class="flex justify-center">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-10 {{ $heroData['specs_background'] }} rounded-t-2xl px-8 py-6">
                                @foreach($heroData['selected_specs'] as $key => $spec)
                                    <div class="text-center">
                                        <div class="flex items-baseline justify-center gap-1">
                                            @if(isset($spec['prefix']) && $spec['prefix'])
                                                <span class="{{ $heroData['specs_prefix_size'] ?? 'text-sm' }} font-medium {{ $heroData['specs_font_family'] }}"
                                                      style="color: {{ $heroData['specs_text_color'] }};">
                                                    {{ $spec['prefix'] }}
                                                </span>
                                            @endif
                                            <span class="{{ $heroData['specs_value_size'] }} font-bold {{ $heroData['specs_font_family'] }}"
                                                  style="color: {{ $heroData['specs_text_color'] }};">
                                                {{ $spec['value'] }}
                                            </span>
                                            @if($spec['unit'])
                                                <span class="{{ $heroData['specs_unit_size'] }} font-medium {{ $heroData['specs_font_family'] }}"
                                                      style="color: {{ $heroData['specs_text_color'] }};">
                                            {{ $spec['unit'] }}
                                        </span>
                                            @endif
                                        </div>
                                        <p class="{{ $heroData['specs_label_size'] }} font-medium"
                                           style="color: {{ $heroData['specs_text_color'] }};">
                                            {{ $spec['label'] }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    @elseif($heroData['specs_position'] === 'bottom-left')
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 {{ $heroData['specs_background'] }} rounded-tr-2xl px-8 py-6 max-w-4xl">
                            @foreach($heroData['selected_specs'] as $key => $spec)
                                <div class="text-center md:text-left">
                                    <div class="flex items-baseline gap-1 mb-2">
                                        @if(isset($spec['prefix']) && $spec['prefix'])
                                            <span class="{{ $heroData['specs_prefix_size'] ?? 'text-sm' }} font-medium {{ $heroData['specs_font_family'] }}"
                                                  style="color: {{ $heroData['specs_text_color'] }};">
                                                    {{ $spec['prefix'] }}
                                                </span>
                                        @endif
                                <span class="text-2xl lg:text-3xl font-bold {{ $heroData['specs_font_family'] }}"
                                      style="color: {{ $heroData['specs_text_color'] }};">
                                    {{ $spec['value'] }}
                                </span>
                                        @if($spec['unit'])
                                            <span class="text-base font-medium {{ $heroData['specs_font_family'] }}"
                                                  style="color: {{ $heroData['specs_text_color'] }};">
                                        {{ $spec['unit'] }}
                                    </span>
                                        @endif
                                    </div>
                                    <p class="text-xs font-medium"
                                       style="color: {{ $heroData['specs_text_color'] }};">
                                        {{ $spec['label'] }}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                    @elseif($heroData['specs_position'] === 'bottom-right')
                        <div class="flex justify-end">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 {{ $heroData['specs_background'] }} rounded-tl-2xl px-8 py-6 max-w-4xl">
                                @foreach($heroData['selected_specs'] as $key => $spec)
                                    <div class="text-center md:text-right">
                                        <div class="flex items-baseline justify-center md:justify-end gap-1 mb-2">
                                            @if(isset($spec['prefix']) && $spec['prefix'])
                                                <span class="{{ $heroData['specs_prefix_size'] ?? 'text-sm' }} font-medium {{ $heroData['specs_font_family'] }}"
                                                      style="color: {{ $heroData['specs_text_color'] }};">
                                                    {{ $spec['prefix'] }}
                                                </span>
                                            @endif
                                    <span class="text-2xl lg:text-3xl font-bold {{ $heroData['specs_font_family'] }}"
                                          style="color: {{ $heroData['specs_text_color'] }};">
                                        {{ $spec['value'] }}
                                    </span>
                                            @if($spec['unit'])
                                                <span class="text-base font-medium {{ $heroData['specs_font_family'] }}"
                                                      style="color: {{ $heroData['specs_text_color'] }};">
                                            {{ $spec['unit'] }}
                                        </span>
                                            @endif
                                        </div>
                                        <p class="text-xs font-medium"
                                           style="color: {{ $heroData['specs_text_color'] }};">
                                            {{ $spec['label'] }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </section>
</div>
