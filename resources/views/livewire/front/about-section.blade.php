{{-- resources/views/livewire/front/about-section.blade.php --}}
<div>
    @if($layout === 'centered')
        {{-- Layout Centrado Original --}}
        <section class="about-section py-16" style="background-color: {{ $sectionData['background_color'] }};">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <div class="mb-8">
                        <img src="{{ asset($sectionData['logo']) }}"
                             alt="{{ $sectionData['title'] }}"
                             class="mx-auto h-4 w-auto">
                    </div>
                    <div class="mb-10">
                        <p class="text-lg leading-relaxed max-w-3xl mx-auto"
                           style="color: {{ $sectionData['text_color'] }};">
                            {{ $sectionData['description'] }}
                        </p>
                    </div>
                    <div>
                        <a href="{{ $sectionData['button_url'] }}"
                           class="inline-block px-8 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded transition-colors duration-300">
                            {{ $sectionData['button_text'] }}
                        </a>
                    </div>
                </div>
            </div>
        </section>

    @elseif($layout === 'split-left')
        {{-- Layout Pantalla Completa - Texto Izquierda --}}
        <section class="about-section" style="background-color: {{ $sectionData['background_color'] }};">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="flex items-center justify-center p-8 lg:p-16">
                    <div class="max-w-md text-center lg:text-left">
                        <div class="mb-8">
                            <img src="{{ asset($sectionData['logo']) }}"
                                 alt="{{ $sectionData['title'] }}"
                                 class="h-12 w-auto mx-auto lg:mx-0">
                        </div>
                        <div class="mb-10">
                            <p class="text-base leading-relaxed"
                               style="color: {{ $sectionData['text_color'] }};">
                                {{ $sectionData['description'] }}
                            </p>
                        </div>
                        <div>
                            <a href="{{ $sectionData['button_url'] }}"
                               class="inline-block px-8 py-3 bg-white hover:bg-gray-100 text-black font-medium transition-colors duration-300">
                                {{ $sectionData['button_text'] }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="{{ asset($sectionData['car_image']) }}"
                         alt="{{ $sectionData['car_alt'] }}"
                         class="{{ $sectionData['image_classes'] }} {{ $sectionData['image_height'] }}">
                </div>
            </div>
        </section>

    @elseif($layout === 'split-right')
        {{-- Layout Pantalla Completa - Texto Derecha --}}
        <section class="about-section" style="background-color: {{ $sectionData['background_color'] }};">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="relative order-2 lg:order-1">
                    <img src="{{ asset($sectionData['car_image']) }}"
                         alt="{{ $sectionData['car_alt'] }}"
                         class="{{ $sectionData['image_classes'] }} {{ $sectionData['image_height'] }}">
                </div>
                <div class="flex items-center justify-center p-8 lg:p-16 order-1 lg:order-2">
                    <div class="max-w-md text-center lg:text-left">
                        <div class="mb-8">
                            <img src="{{ asset($sectionData['logo']) }}"
                                 alt="{{ $sectionData['title'] }}"
                                 class="h-12 w-auto mx-auto lg:mx-0">
                        </div>
                        <div class="mb-10">
                            <p class="text-base leading-relaxed"
                               style="color: {{ $sectionData['text_color'] }};">
                                {{ $sectionData['description'] }}
                            </p>
                        </div>
                        <div>
                            <a href="{{ $sectionData['button_url'] }}"
                               class="inline-block px-8 py-3 bg-white hover:bg-gray-100 text-black font-medium transition-colors duration-300">
                                {{ $sectionData['button_text'] }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @elseif($layout === 'compact-left')
        {{-- Layout Compacto - Texto Izquierda --}}
        <section class="about-section py-12" style="background-color: {{ $sectionData['background_color'] }};">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div class="text-center lg:text-left">
                        <div class="mb-6">
                            <img src="{{ asset($sectionData['logo']) }}"
                                 alt="{{ $sectionData['title'] }}"
                                 class="h-10 w-auto mx-auto lg:mx-0">
                        </div>
                        <div class="mb-8">
                            <p class="text-base leading-relaxed"
                               style="color: {{ $sectionData['text_color'] }};">
                                {{ $sectionData['description'] }}
                            </p>
                        </div>
                        <div>
                            <a href="{{ $sectionData['button_url'] }}"
                               class="inline-block px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium transition-colors duration-300">
                                {{ $sectionData['button_text'] }}
                            </a>
                        </div>
                    </div>
                    <div class="relative">
                        <img src="{{ asset($sectionData['car_image']) }}"
                             alt="{{ $sectionData['car_alt'] }}"
                             class="w-full h-auto rounded-lg shadow-lg">
                    </div>
                </div>
            </div>
        </section>

    @elseif($layout === 'compact-right')
        {{-- Layout Compacto - Texto Derecha --}}
        <section class="about-section py-12" style="background-color: {{ $sectionData['background_color'] }};">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div class="relative order-2 lg:order-1">
                        <img src="{{ asset($sectionData['car_image']) }}"
                             alt="{{ $sectionData['car_alt'] }}"
                             class="w-full h-auto rounded-lg shadow-lg">
                    </div>
                    <div class="text-center lg:text-left order-1 lg:order-2">
                        <div class="mb-6">
                            <img src="{{ asset($sectionData['logo']) }}"
                                 alt="{{ $sectionData['title'] }}"
                                 class="h-10 w-auto mx-auto lg:mx-0">
                        </div>
                        <div class="mb-8">
                            <p class="text-base leading-relaxed"
                               style="color: {{ $sectionData['text_color'] }};">
                                {{ $sectionData['description'] }}
                            </p>
                        </div>
                        <div>
                            <a href="{{ $sectionData['button_url'] }}"
                               class="inline-block px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium transition-colors duration-300">
                                {{ $sectionData['button_text'] }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
