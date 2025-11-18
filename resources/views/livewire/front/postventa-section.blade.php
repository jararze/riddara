{{-- resources/views/livewire/front/posventa-section.blade.php --}}
<div>
    @if($layout === 'split-right')
        {{-- Layout imagen izquierda, texto derecha --}}
        <section class="posventa-split"
                 style="background-color: {{ $sectionData['background_color'] }};">
            <div class="grid grid-cols-1 lg:grid-cols-3">
                {{-- Imagen (2/3 del espacio) --}}
                @if($sectionData['show_image'])
                    <div class="relative lg:col-span-2 order-2 lg:order-1">
                        {{-- Imagen para móvil --}}
                        @if(isset($sectionData['building_image_mobile']) && $sectionData['building_image_mobile'])
                            <img src="{{ asset($sectionData['building_image_mobile']) }}"
                                 alt="{{ $sectionData['title'] }}"
                                 class="w-full h-full object-cover min-h-[500px] block md:hidden">
                        @endif

                        {{-- Imagen para desktop --}}
                        <img src="{{ asset($sectionData['building_image']) }}"
                             alt="{{ $sectionData['title'] }}"
                             class="w-full h-full object-cover min-h-[500px] hidden md:block">
                    </div>
                @endif

                {{-- Contenido (1/3 del espacio) --}}
                <div class="lg:col-span-1 flex items-center justify-center p-8 lg:p-12 order-1 lg:order-2"
                     style="background: linear-gradient(135deg, #ffffff 0%, #f1f3f4 100%);">
                    <div class="max-w-lg text-center lg:text-left">
                        <h2 class="text-3xl lg:text-4xl font-bold mb-8" style="color: {{ $sectionData['text_color'] }};">
                            {{ $sectionData['title'] }}
                        </h2>

                        @if($sectionData['subtitle'])
                            <h3 class="text-xl lg:text-2xl font-semibold mb-6" style="color: {{ $sectionData['text_color'] }};">
                                {{ $sectionData['subtitle'] }}
                            </h3>
                        @endif

                        <div class="mb-8">
                            <p class="text-sm lg:text-base leading-relaxed" style="color: {{ $sectionData['text_color'] }};">
                                {{ $sectionData['description'] }}
                            </p>
                        </div>

{{--                        <a href="{{ $sectionData['button_url'] }}"--}}
{{--                           class="inline-block px-8 py-3 bg-black hover:bg-gray-800 text-white font-medium transition-colors duration-300">--}}
{{--                            {{ $sectionData['button_text'] }}--}}
{{--                        </a>--}}
                    </div>
                </div>
            </div>
        </section>

    @elseif($layout === 'compact')
        {{-- Layout compacto con imagen 2/3 y texto 1/3 --}}
        <section class="posventa-compact py-12"
                 style="background: linear-gradient(135deg, #ffffff 0%, #f1f3f4 100%);;">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
                    {{-- Imagen (2/3 del espacio) --}}
                    @if($sectionData['show_image'])
                        <div class="lg:col-span-2">
                            {{-- Imagen para móvil --}}
                            @if(isset($sectionData['building_image_mobile']) && $sectionData['building_image_mobile'])
                                <img src="{{ asset($sectionData['building_image_mobile']) }}"
                                     alt="{{ $sectionData['title'] }}"
                                     class="w-full h-auto rounded-lg shadow-lg block md:hidden">
                            @endif

                            {{-- Imagen para desktop --}}
                            <img src="{{ asset($sectionData['building_image']) }}"
                                 alt="{{ $sectionData['title'] }}"
                                 class="w-full h-auto rounded-lg shadow-lg hidden md:block">
                        </div>
                    @endif

                    {{-- Contenido (1/3 del espacio) --}}
                    <div class="lg:col-span-1 text-center lg:text-left">
                        <h2 class="text-2xl lg:text-3xl font-bold mb-6" style="color: {{ $sectionData['text_color'] }};">
                            {{ $sectionData['title'] }}
                        </h2>

                        @if($sectionData['subtitle'])
                            <h3 class="text-lg lg:text-xl font-semibold mb-4" style="color: {{ $sectionData['text_color'] }};">
                                {{ $sectionData['subtitle'] }}
                            </h3>
                        @endif

                        <div class="mb-8">
                            <p class="text-sm lg:text-base leading-relaxed" style="color: {{ $sectionData['text_color'] }};">
                                {{ $sectionData['description'] }}
                            </p>
                        </div>

{{--                        <a href="{{ $sectionData['button_url'] }}"--}}
{{--                           class="inline-block px-6 py-3 bg-black hover:bg-gray-800 text-white font-medium text-sm transition-colors duration-300">--}}
{{--                            {{ $sectionData['button_text'] }}--}}
{{--                        </a>--}}
                    </div>
                </div>
            </div>
        </section>

    @elseif($layout === 'overlay-left')
        {{-- Layout con imagen de fondo y overlay --}}
        <section class="posventa-overlay relative {{ $sectionData['section_height'] }}">
            @if($sectionData['show_image'])
                <div class="absolute inset-0 z-0">
                    {{-- Imagen para móvil --}}
                    @if(isset($sectionData['building_image_mobile']) && $sectionData['building_image_mobile'])
                        <img src="{{ asset($sectionData['building_image_mobile']) }}"
                             alt="{{ $sectionData['title'] }}"
                             class="block md:hidden"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    @endif

                    {{-- Imagen para desktop --}}
                    <img src="{{ asset($sectionData['building_image']) }}"
                         alt="{{ $sectionData['title'] }}"
                         class="hidden md:block"
                         style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            @endif

            <div class="relative z-10 container mx-auto px-4 h-full">
                <div class="flex items-center h-full py-16">
                    <div class="max-w-lg">
                        @if($sectionData['subtitle'])
                            <h3 class="text-lg lg:text-xl font-bold mb-2 text-black">
                                {{ $sectionData['subtitle'] }}
                            </h3>
                        @endif

                        <h2 class="text-2xl lg:text-4xl font-bold mb-8 text-black leading-tight">
                            {{ $sectionData['title'] }}
                        </h2>

                        <div class="mb-8">
                            <p class="text-base leading-relaxed text-black">
                                {{ $sectionData['description'] }}
                            </p>
                        </div>

{{--                        <a href="{{ $sectionData['button_url'] }}"--}}
{{--                           class="inline-block px-8 py-3 bg-black hover:bg-gray-800 text-white font-medium transition-colors duration-300">--}}
{{--                            {{ $sectionData['button_text'] }}--}}
{{--                        </a>--}}
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
