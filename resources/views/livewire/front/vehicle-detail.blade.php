<div>
    {{-- Hero del Vehículo --}}
    <section id="hero" data-section="hero">
        <livewire:front.vehicle-hero layout="top-left" :vehicle="$vehicle"/>
    </section>

    <livewire:front.vehicle-sub-navigation :vehicle="$vehicle"/>

    <section>
        <livewire:front.vehicle-features :vehicle="$vehicle"/>
    </section>

{{--    <section id="versiones" data-section="versiones">--}}
{{--        <livewire:front.vehicle-versions--}}
{{--            :vehicle="$vehicle"--}}
{{--            :category="$categorySlug"--}}
{{--            :slug="$vehicleSlug"--}}
{{--        />--}}
{{--    </section>--}}

{{--    --}}{{-- Action Boxes --}}
    <section id="servicios">
        <livewire:front.action-boxes-section/>
    </section>


{{--    <section id="slider">--}}
{{--        <livewire:front.promotions-slider-section :vehicle="$vehicle"/>--}}
{{--    </section>--}}

    <section id="beneficios">
        <livewire:front.BenefitsSection/>
    </section>

    <livewire:front.video-reviews-section :vehicle="$vehicle"/>

    <livewire:front.section-breaker-section :vehicle="$vehicle"/>

{{--    <section data-section="tecnologia" id="tecnologia">--}}
{{--        <livewire:front.feature-slider-section--}}
{{--            :vehicle="$vehicle"--}}
{{--            section="potente_dinamico"--}}
{{--        />--}}
{{--    </section>--}}

{{--    <livewire:front.feature-slider-section--}}
{{--        :vehicle="$vehicle"--}}
{{--        section="interior_lujoso"--}}
{{--    />--}}

{{--    <livewire:front.feature-slider-section--}}
{{--        :vehicle="$vehicle"--}}
{{--        section="tecnologia"--}}
{{--    />--}}

{{--    <livewire:front.feature-slider-section--}}
{{--        :vehicle="$vehicle"--}}
{{--        section="seguridad"--}}
{{--    />--}}

{{--    <livewire:front.mosaic-gallery-section :vehicle="$vehicle"/>--}}


{{--    <livewire:front.about-section--}}
{{--        :sectionData="[--}}
{{--                'logo' => 'frontend/images/logo-blanco.svg',--}}
{{--                'background_color' => '#000',--}}
{{--                'text_color' => '#fff'--}}
{{--            ]"--}}
{{--    />--}}

{{--    <livewire:front.test-drive-section--}}
{{--        layout="overlay-left"--}}
{{--        :sectionData="[--}}
{{--                'section_height' => 'min-h-[600px]',--}}
{{--                'show_image' => true,--}}
{{--        ]"/>--}}

{{--    <livewire:front.postventa-section--}}
{{--        layout="split-right"--}}
{{--        :sectionData="[--}}
{{--                'section_height' => 'min-h-[600px]'--}}
{{--            ]"--}}
{{--    />--}}


{{--    <section id="diseno" data-section="diseno">--}}
{{--        <livewire:front.direcciones-section--}}
{{--            layout="map-cards"--}}
{{--            :sectionData="[--}}
{{--                'background_color' => '#ffffff'--}}
{{--            ]"/>--}}
{{--    </section>--}}

{{--    <div id="back-to-top" class="fixed bottom-8 right-8 z-50" style="display: none;">--}}
{{--        <button onclick="scrollToTop()"--}}
{{--                class="bg-black hover:bg-gray-800 text-white p-3 rounded-full shadow-lg transition-all duration-300 hover:scale-110">--}}
{{--            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                      d="M5 10l7-7m0 0l7 7m-7-7v18"></path>--}}
{{--            </svg>--}}
{{--        </button>--}}
{{--    </div>--}}
{{--    <script>--}}
{{--        function scrollToTop() {--}}
{{--            console.log('scrollToTop ejecutado'); // Debug--}}

{{--            // Múltiples métodos para scroll hacia arriba--}}
{{--            window.scrollTo({--}}
{{--                top: 0,--}}
{{--                behavior: 'smooth'--}}
{{--            });--}}

{{--            // Fallback por si el primer método no funciona--}}
{{--            document.documentElement.scrollTop = 0;--}}
{{--            document.body.scrollTop = 0;--}}
{{--        }--}}

{{--        function checkScroll() {--}}
{{--            const button = document.getElementById('back-to-top');--}}
{{--            if (!button) return;--}}

{{--            const scrollTop = window.pageYOffset ||--}}
{{--                document.documentElement.scrollTop ||--}}
{{--                document.body.scrollTop ||--}}
{{--                window.scrollY;--}}

{{--            if (scrollTop > 300) {--}}
{{--                button.style.display = 'block';--}}
{{--                button.style.opacity = '1';--}}
{{--            } else {--}}
{{--                button.style.display = 'none';--}}
{{--                button.style.opacity = '0';--}}
{{--            }--}}
{{--        }--}}

{{--        document.addEventListener('DOMContentLoaded', function () {--}}
{{--            // Event listener para el botón--}}
{{--            const scrollBtn = document.getElementById('scroll-top-btn');--}}
{{--            if (scrollBtn) {--}}
{{--                scrollBtn.addEventListener('click', function (e) {--}}
{{--                    e.preventDefault();--}}
{{--                    console.log('Click detectado'); // Debug--}}
{{--                    scrollToTop();--}}
{{--                });--}}
{{--            }--}}

{{--            // Event listeners para scroll--}}
{{--            window.addEventListener('scroll', checkScroll, {passive: true});--}}
{{--            document.addEventListener('scroll', checkScroll, {passive: true});--}}
{{--            document.body.addEventListener('scroll', checkScroll, {passive: true});--}}

{{--            document.addEventListener('livewire:navigated', checkScroll);--}}
{{--            document.addEventListener('livewire:load', checkScroll);--}}

{{--            setInterval(checkScroll, 1000);--}}
{{--        });--}}
{{--    </script>--}}
</div>

