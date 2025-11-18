<div>

    @php
        $vehicleCategory  = $vehicle['category'] ?? $categorySlug;
        $vehicleType = match($vehicleCategory) {
            'ELÉCTRICOS' => 'electrico',
            'SUV' => 'suv',
            default => 'suv'
        };

        $isElectric = $vehicleType === 'electrico';
    @endphp
    {{-- Hero del Vehículo --}}
    <section id="hero" data-section="hero">
        <livewire:front.vehicle-hero layout="top-left" :vehicle="$vehicle"/>
    </section>

    @if($isElectric)

        <section id="electric-showcase" data-section="electric-showcase">
            <div class="relative min-h-[800px] bg-cover bg-center"
                 style="background-image: url('{{ asset("frontend/images/vehicles/electrico/cartilla-EX5-GEELY-fondo-desktop.jpg") }}') !important;">

                <div class="absolute inset-0  bg-opacity-70"></div>

                <div class="relative z-10 max-w-7xl mx-auto px-4 py-16">

                    <!-- Título alineado a la izquierda -->
                    <div class="text-center lg:text-left mb-12">
                        <img src="{{ asset('/frontend/images/vehicles/electrico/cartilla-EX5-GEELY-titulo.png') }}"
                             alt="EX5"
                             class="h-16 lg:h-24 drop-shadow-lg mx-auto lg:mx-0">
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">

                        <!-- Imagen del auto -->
                        <div class="flex justify-center lg:justify-end overflow-visible">
                            <img src="{{ asset('/frontend/images/vehicles/electrico/cartilla-EX5-GEELY-auto.png') }}"
                                 alt="EX5 Vehicle"
                                 class="w-full h-auto object-contain drop-shadow-2xl">
                        </div>

                        <!-- Grid de 4 cuadrantes con menos espacio -->
                        <div class="grid grid-cols-2 gap-1 lg:gap-1 order-1 lg:order-2">
                            <div class="aspect-square overflow-visible p-1">
                                <img src="{{ asset('/frontend/images/vehicles/electrico/EX5-GEELY-autonomia.png') }}"
                                     alt="Autonomía"
                                     class="w-full h-full object-contain">
                            </div>

                            <div class="aspect-square overflow-visible p-1">
                                <img src="{{ asset('/frontend/images/vehicles/electrico/EX5-GEELY-carga.png') }}"
                                     alt="Carga Rápida"
                                     class="w-full h-full object-contain">
                            </div>

                            <div class="aspect-square overflow-visible p-1">
                                <img src="{{ asset('/frontend/images/vehicles/electrico/EX5-GEELY-potencia.png') }}"
                                     alt="Potencia"
                                     class="w-full h-full object-contain">
                            </div>

                            <div class="aspect-square overflow-visible p-1">
                                <img src="{{ asset('/frontend/images/vehicles/electrico/EX5-GEELY-torque.png') }}"
                                     alt="Torque"
                                     class="w-full h-full object-contain">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

    @else
        <livewire:front.vehicle-sub-navigation :vehicle="$vehicle"/>

        <section>
            <livewire:front.vehicle-features :vehicle="$vehicle"/>
        </section>

        <section id="versiones" data-section="versiones">
            <livewire:front.vehicle-versions
                :vehicle="$vehicle"
                :category="$categorySlug"
                :slug="$vehicleSlug"
            />
        </section>

        {{-- Action Boxes --}}
        <section id="servicios">
            <livewire:front.action-boxes-section/>
        </section>


        <section id="slider">
{{--            <livewire:front.promotions-slider-section :vehicle="$vehicle"/>--}}
        </section>

        <section id="beneficios">
            <livewire:front.BenefitsSection/>
        </section>

        <livewire:front.video-reviews-section :vehicle="$vehicle"/>

        <livewire:front.section-breaker-section :vehicle="$vehicle"/>

        <section data-section="tecnologia" id="tecnologia">
            <livewire:front.feature-slider-section
                :vehicle="$vehicle"
                section="potente_dinamico"
            />
        </section>

        <livewire:front.feature-slider-section
            :vehicle="$vehicle"
            section="interior_lujoso"
        />

        <livewire:front.feature-slider-section
            :vehicle="$vehicle"
            section="tecnologia"
        />

        <livewire:front.feature-slider-section
            :vehicle="$vehicle"
            section="seguridad"
        />

        <livewire:front.mosaic-gallery-section :vehicle="$vehicle"/>


        <livewire:front.about-section
            :sectionData="[
                'logo' => 'frontend/images/logo-blanco.svg',
                'background_color' => '#000',
                'text_color' => '#fff'
            ]"
        />

        <livewire:front.test-drive-section
            layout="overlay-left"
            :sectionData="[
                'section_height' => 'min-h-[600px]',
                'show_image' => true,
        ]"/>

        <livewire:front.postventa-section
            layout="split-right"
            :sectionData="[
                'section_height' => 'min-h-[600px]'
            ]"
        />


        <section id="diseno" data-section="diseno">
            <livewire:front.direcciones-section
                layout="map-cards"
                :sectionData="[
                'background_color' => '#ffffff'
            ]"/>
        </section>
    @endif



    <div id="back-to-top" class="fixed bottom-8 right-8 z-50" style="display: none;">
        <button onclick="scrollToTop()"
                class="bg-black hover:bg-gray-800 text-white p-3 rounded-full shadow-lg transition-all duration-300 hover:scale-110">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
        </button>
    </div>
    <script>
        function scrollToTop() {
            console.log('scrollToTop ejecutado'); // Debug

            // Múltiples métodos para scroll hacia arriba
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

            // Fallback por si el primer método no funciona
            document.documentElement.scrollTop = 0;
            document.body.scrollTop = 0;
        }

        function checkScroll() {
            const button = document.getElementById('back-to-top');
            if (!button) return;

            const scrollTop = window.pageYOffset ||
                document.documentElement.scrollTop ||
                document.body.scrollTop ||
                window.scrollY;

            if (scrollTop > 300) {
                button.style.display = 'block';
                button.style.opacity = '1';
            } else {
                button.style.display = 'none';
                button.style.opacity = '0';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Event listener para el botón
            const scrollBtn = document.getElementById('scroll-top-btn');
            if (scrollBtn) {
                scrollBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Click detectado'); // Debug
                    scrollToTop();
                });
            }

            // Event listeners para scroll
            window.addEventListener('scroll', checkScroll, { passive: true });
            document.addEventListener('scroll', checkScroll, { passive: true });
            document.body.addEventListener('scroll', checkScroll, { passive: true });

            document.addEventListener('livewire:navigated', checkScroll);
            document.addEventListener('livewire:load', checkScroll);

            setInterval(checkScroll, 1000);
        });
    </script>
</div>

