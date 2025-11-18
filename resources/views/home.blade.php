<x-layouts.frontend.front>
    <section id="inicio" class="scroll-animate">
        <livewire:front.hero-section />
    </section>

    <section id="modelos" class="scroll-animate">
        <livewire:front.model-section />
    </section>

    <section id="servicios" class="scroll-animate">
        <livewire:front.action-boxes-section />
    </section>

    <section id="beneficios" class="scroll-animate">
        <livewire:front.BenefitsSection />
    </section>

    <section id="nosotros" class="scroll-animate">
        <livewire:front.about-section
            :sectionData="[
                'logo' => 'frontend/images/logo-blanco.svg',
                'background_color' => '#000',
                'text_color' => '#fff'
            ]"
        />

{{--        <livewire:front.about-section--}}
{{--            layout="split-left"--}}
{{--            :sectionData="[--}}
{{--                'logo' => 'frontend/images/logo-blanco.svg',--}}
{{--                'background_color' => '#000',--}}
{{--                'text_color' => '#fff'--}}
{{--            ]"--}}
{{--        />--}}

{{--        <livewire:front.about-section layout="split-right"--}}
{{--                                      :sectionData="[--}}
{{--                    'logo' => 'frontend/images/logo-blanco.svg',--}}
{{--                    'background_color' => '#000',--}}
{{--                    'text_color' => '#fff'--}}
{{--                ]"--}}
{{--        />--}}

{{--        <livewire:front.about-section layout="compact-right"--}}
{{--                                      :sectionData="[--}}
{{--                    'logo' => 'frontend/images/logo-negro.svg',--}}
{{--                    'background_color' => '#fff',--}}
{{--                    'text_color' => '#000'--}}
{{--                ]"--}}
{{--        />--}}

{{--        <livewire:front.about-section layout="compact-left"--}}
{{--                                      :sectionData="[--}}
{{--                    'logo' => 'frontend/images/logo-negro.svg',--}}
{{--                    'background_color' => '#fff',--}}
{{--                    'text_color' => '#000'--}}
{{--                ]"--}}
{{--        />--}}
    </section>

    <section id="test-drive" class="scroll-animate">
{{--        <livewire:front.test-drive-section--}}
{{--            layout="hero"--}}
{{--            :sectionData="[--}}
{{--                'image_position' => 'top-third',--}}
{{--                'show_features' => true--}}
{{--            ]"/>--}}

        <livewire:front.test-drive-section
            layout="overlay-left"
            :sectionData="[
                'section_height' => 'min-h-[600px]',
                'show_image' => true,
                'background_image' => 'frontend/images/vehicles/rd6/Riddara-Bolivia-Camionetas-Electricas-Test-Drive-web.jpg'
        ]"/>


{{--        <livewire:front.test-drive-section--}}
{{--            layout="banner"--}}
{{--            :sectionData="[--}}
{{--        'show_image' => false--}}
{{--        ]"/>--}}

{{--        <livewire:front.test-drive-section layout="banner-thin"/>--}}
    </section>

    <section id="postventa" class="scroll-animate">
        <livewire:front.postventa-section
            layout="split-right"
            :sectionData="[
                'section_height' => 'min-h-[600px]'
            ]"
        />

{{--        <livewire:front.postventa-section--}}
{{--            layout="compact"--}}
{{--            :sectionData="[--}}
{{--                'section_height' => 'min-h-[600px]'--}}
{{--            ]"--}}
{{--        />--}}

{{--        <livewire:front.postventa-section--}}
{{--            layout="overlay-left"--}}
{{--            :sectionData="[--}}
{{--                'subtitle' => 'SERVICIO',--}}
{{--                'title' => 'POSVENTA DE CALIDAD GLOBAL',--}}
{{--                'section_height' => 'min-h-[900px]'--}}
{{--            ]"--}}
{{--        />--}}
    </section>

    <section id="direcciones" class="scroll-animate">
        <livewire:front.direcciones-section
            layout="map-cards"
            :sectionData="[
                'background_color' => '#000'
            ]" />

    </section>

    <div id="back-to-top" class="fixed bottom-8 right-8 z-50 hidden">
        <button onclick="scrollToTop()"
                class="bg-black hover:bg-gray-800 text-white p-3 rounded-full shadow-lg transition-all duration-300 hover:scale-110">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
        </button>
    </div>

    @push('scripts')
        <script>
            // Scroll suave para anclas
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Mostrar/ocultar botón volver arriba
            window.addEventListener('scroll', function() {
                const backToTop = document.getElementById('back-to-top');
                if (window.pageYOffset > 300) {
                    backToTop.classList.remove('hidden');
                    backToTop.classList.add('animate-fade-in');
                } else {
                    backToTop.classList.add('hidden');
                    backToTop.classList.remove('animate-fade-in');
                }
            });

            // Función para volver arriba
            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            // Intersection Observer para animaciones
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            // Observar elementos con clase scroll-animate
            document.querySelectorAll('.scroll-animate').forEach(el => {
                observer.observe(el);
            });
        </script>
    @endpush
</x-layouts.frontend.front>
