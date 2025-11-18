<div>
    <section class="vehicle-features {{ $featuresData['section_background'] }} {{ $featuresData['section_padding'] }}">
        <div class="container mx-auto px-4">

            {{-- Header --}}
            <div
                class="{{ $featuresData['header']['text_align'] ?? 'text-left' }} {{ $featuresData['header']['margin_bottom'] ?? 'mb-12' }}">
                <h2 class="{{ $featuresData['header']['title_size'] ?? 'text-3xl lg:text-4xl' }} {{ $featuresData['header']['title_weight'] ?? 'font-bold' }}"
                    style="color: {{ $featuresData['header']['title_color'] ?? '#1f2937' }};">
                    {{ $featuresData['header']['title'] }}
                </h2>

                @if(isset($featuresData['header']['subtitle']) && $featuresData['header']['subtitle'])
                    <p class="{{ $featuresData['header']['subtitle_size'] ?? 'text-lg' }} mt-4"
                       style="color: {{ $featuresData['header']['subtitle_color'] ?? '#6b7280' }};">
                        {{ $featuresData['header']['subtitle'] }}
                    </p>
                @endif
            </div>
        </div>

        {{-- Grid de Features --}}
        <div class="w-full grid {{ $featuresData['grid_settings']['columns_mobile'] }} {{ $featuresData['grid_settings']['columns_tablet'] }} {{ $featuresData['grid_settings']['columns_desktop'] }} {{ $featuresData['grid_settings']['gap'] }}">

            @foreach($featuresData['features'] as $index => $feature)
                <div class="feature-card relative {{ $featuresData['grid_settings']['aspect_ratio'] }} overflow-hidden group cursor-pointer
                    {{ $index === 2 ? 'col-span-2 lg:col-span-1' : '' }}">

                    {{-- Imagen de fondo --}}
                    <div class="absolute inset-0">
                        <img src="{{ asset($feature['image']) }}"
                             alt="{{ $feature['title'] }}"
                             class="w-full h-full object-cover transition-transform duration-500 {{ $feature['hover_effect'] ? 'group-hover:scale-110' : '' }}">
                    </div>

                    {{-- Contenido de texto --}}
                    <div class="absolute inset-0 flex items-end justify-start p-6 z-10">
                        @if($feature['text_position'] === 'bottom-left')
                            <div class="text-left">
                                <h3 class="text-2xl lg:text-3xl font-bold mb-2 transition-transform duration-300 {{ $feature['hover_effect'] ? 'group-hover:translate-y-[-4px]' : '' }}"
                                    style="color: {{ $feature['text_color'] }};">
                                    {{ $feature['title'] }}
                                </h3>
                                <p class="text-sm lg:text-base transition-opacity duration-300 {{ $feature['hover_effect'] ? 'group-hover:opacity-90' : '' }}"
                                   style="color: {{ $feature['text_color'] }};">
                                    {{ $feature['subtitle'] }}
                                </p>
                            </div>

                        @elseif($feature['text_position'] === 'bottom-center')
                            <div class="text-center w-full">
                                <h3 class="text-2xl lg:text-3xl font-bold mb-2"
                                    style="color: {{ $feature['text_color'] }};">
                                    {{ $feature['title'] }}
                                </h3>
                                <p class="text-sm lg:text-base"
                                   style="color: {{ $feature['text_color'] }};">
                                    {{ $feature['subtitle'] }}
                                </p>
                            </div>

                        @elseif($feature['text_position'] === 'bottom-right')
                            <div class="text-right ml-auto">
                                <h3 class="text-2xl lg:text-3xl font-bold mb-2"
                                    style="color: {{ $feature['text_color'] }};">
                                    {{ $feature['title'] }}
                                </h3>
                                <p class="text-sm lg:text-base"
                                   style="color: {{ $feature['text_color'] }};">
                                    {{ $feature['subtitle'] }}
                                </p>
                            </div>

                        @elseif($feature['text_position'] === 'center')
                            <div class="absolute inset-0 flex items-center justify-center text-center">
                                <div>
                                    <h3 class="text-2xl lg:text-3xl font-bold mb-2"
                                        style="color: {{ $feature['text_color'] }};">
                                        {{ $feature['title'] }}
                                    </h3>
                                    <p class="text-sm lg:text-base"
                                       style="color: {{ $feature['text_color'] }};">
                                        {{ $feature['subtitle'] }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Efecto hover adicional --}}
                    @if($feature['hover_effect'])
                        <div class="absolute inset-0 border-2 border-white border-opacity-0 group-hover:border-opacity-30 transition-all duration-300"></div>
                    @endif
                </div>
            @endforeach
        </div>

    </section>

    <style>
        .feature-card {
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
            z-index: 15;
        }

        .feature-card:hover::before {
            left: 100%;
        }

        /* Animación de entrada */
        .feature-card {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</div>
