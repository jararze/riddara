{{-- resources/views/livewire/front/direcciones-section.blade.php --}}
<div>
    @if($layout === 'map-cards')
        {{-- Layout con mapa y tarjetas --}}
        <section class="direcciones-section py-16"
                 style="background: linear-gradient(135deg, #ffffff 0%, #f1f3f4 100%);">
            <div class="container mx-auto px-4">


                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

                    {{-- Mapa --}}
                    @if($sectionData['show_map'])
                        <div class="hidden lg:flex justify-center">
                            <div class="relative">
                                <img src="{{ asset($sectionData['map_image']) }}"
                                     alt="Mapa de Bolivia"
                                     class="w-full max-w-md h-auto">
                            </div>
                        </div>
                    @endif

                    {{-- Columna derecha: Título + Tarjetas lado a lado --}}
                    <div>
                        {{-- Título en esta columna --}}
                        <div class="mb-8">
                            <h2 class="text-3xl lg:text-4xl font-bold mb-4"
                                style="color: {{ $sectionData['text_color'] }};">
                                {{ $sectionData['title'] }}
                            </h2>
                            <p class="text-lg" style="color: {{ $sectionData['text_color'] }};">
                                {{ $sectionData['subtitle'] }}
                            </p>
                        </div>

                        {{-- Tarjetas lado a lado --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($sectionData['locations'] as $location)
                                <div
                                    class="bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-400">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h3 class="text-lg font-bold mb-3"
                                                style="color: {{ $sectionData['text_color'] }};">
                                                {{ $location['name'] }}
                                            </h3>

                                            <div class="space-y-1 text-xs"
                                                 style="color: {{ $sectionData['text_color'] }};">
                                                <p>{{ $location['address'] }}</p>
                                                <p>{{ $location['phone'] }}</p>
                                                <p>{{ $location['hours'] }}</p>
                                                <p class="font-medium">{{ $location['city'] }}</p>
                                            </div>
                                        </div>

                                        {{-- Icono de ubicación --}}
                                        <div class="ml-2">
                                            <a href="{{ $location['map_link'] }}" target="_blank"
                                               class="inline-flex items-center justify-center w-10 h-10 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors duration-300">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                          d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- Botón central --}}
                            @if($sectionData['show_button'])
                                <div class="text-left mt-12">
                                    <a href="{{ $sectionData['button_url'] }}"
                                       class="inline-block px-8 py-3 bg-black hover:bg-gray-800 text-white font-medium transition-colors duration-300">
                                        {{ $sectionData['button_text'] }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


            </div>
        </section>

    @elseif($layout === 'list-only')
        {{-- Layout solo con lista de ubicaciones --}}
        <section class="direcciones-list py-16"
                 style="background-color: {{ $sectionData['background_color'] }};">
            <div class="container mx-auto px-4">

                {{-- Header --}}
                <div class="text-center mb-12">
                    <h2 class="text-3xl lg:text-5xl font-bold mb-4" style="color: {{ $sectionData['text_color'] }};">
                        {{ $sectionData['title'] }}
                    </h2>
                    <p class="text-lg" style="color: {{ $sectionData['text_color'] }};">
                        {{ $sectionData['subtitle'] }}
                    </p>
                </div>

                {{-- Grid de tarjetas --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                    @foreach($sectionData['locations'] as $location)
                        <div
                            class="bg-gray-100 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="text-center">
                                <h3 class="text-xl font-bold mb-4" style="color: {{ $sectionData['text_color'] }};">
                                    {{ $location['name'] }}
                                </h3>

                                <div class="space-y-2 text-sm mb-4" style="color: {{ $sectionData['text_color'] }};">
                                    <p>{{ $location['address'] }}</p>
                                    <p>{{ $location['phone'] }}</p>
                                    <p>{{ $location['hours'] }}</p>
                                    <p class="font-medium">{{ $location['city'] }}</p>
                                </div>

                                <a href="{{ $location['map_link'] }}"
                                   class="inline-flex items-center justify-center px-4 py-2 bg-black text-white rounded hover:bg-gray-800 transition-colors duration-300 text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                    Ubicación
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Botón central --}}
                @if($sectionData['show_button'])
                    <div class="text-center mt-12">
                        <a href="{{ $sectionData['button_url'] }}"
                           class="inline-block px-8 py-3 bg-black hover:bg-gray-800 text-white font-medium transition-colors duration-300">
                            {{ $sectionData['button_text'] }}
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif
</div>
