<div>
    <div x-data="vehicleSubNav()"
         x-init="init()"
         :class="isSticky ? 'fixed top-0' : 'relative'"
         @scroll.window="isSticky = window.scrollY > 100"
         class="vehicle-sub-nav z-50 bg-black shadow-lg w-full transition-all">

        <div class="container mx-auto px-4">
            <nav class="flex justify-center">
                <ul class="flex space-x-0">
                    @foreach($menuItems as $index => $item)
                        <li class="relative">
                            <a href="{{ $item['anchor'] }}"
                               @click="scrollToSection('{{ $item['id'] }}', '{{ $item['anchor'] }}', $event)"
                               :class="activeSection === '{{ $item['id'] }}' ? 'text-white' : 'text-gray-400'"
                               class="nav-item block px-6 lg:px-8 py-4 text-sm lg:text-base font-medium transition-colors duration-300 hover:text-white relative">

                                {{-- Texto del menú --}}
                                {{ $item['label'] }}

                                {{-- Border activo (sección actual) --}}
                                <div :class="activeSection === '{{ $item['id'] }}' ? 'w-full opacity-100' : 'w-0 opacity-0'"
                                     class="absolute bottom-0 left-0 h-0.5 bg-white transition-all duration-300 ease-out"></div>

                                {{-- Border hover --}}
                                <div class="absolute bottom-0 left-0 h-0.5 bg-white w-0 group-hover:w-full transition-all duration-300 ease-out hover-border"></div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>

    @push('scripts')
        <script>
            function vehicleSubNav() {
                return {
                    activeSection: @entangle('activeSection'),
                    showNav: true,
                    init() {
                        // Esperar a que Livewire termine de renderizar todos los componentes
                        this.$nextTick(() => {
                            setTimeout(() => {
                                this.setupIntersectionObserver();
                                this.setupSmoothScroll();
                            }, 100); // Pequeño delay para asegurar que todo esté listo
                        });
                    },

                    scrollToSection(sectionId, anchor, event) {
                        event.preventDefault();

                        const target = document.querySelector(anchor);

                        if (target) {
                            // Método simple y directo
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });

                            // Ajustar después del scroll para compensar navs fijos
                            setTimeout(() => {
                                const navHeight = document.querySelector('.vehicle-sub-nav')?.offsetHeight || 0;
                                const mainNavHeight = document.querySelector('header')?.offsetHeight || 0;
                                const adjustment = navHeight + mainNavHeight + 20;

                                window.scrollBy({
                                    top: -adjustment,
                                    behavior: 'smooth'
                                });
                            }, 100);

                            this.activeSection = sectionId;
                        }
                    },

                    setupIntersectionObserver() {
                        // Buscar de nuevo las secciones por si se renderizaron después
                        const sections = document.querySelectorAll('[data-section]');
                        console.log('Secciones encontradas:', sections);

                        if (sections.length === 0) {
                            console.warn('No se encontraron secciones, reintentando en 500ms...');
                            setTimeout(() => this.setupIntersectionObserver(), 500);
                            return;
                        }

                        const observer = new IntersectionObserver((entries) => {
                            entries.forEach(entry => {
                                if (entry.isIntersecting) {
                                    const sectionId = entry.target.getAttribute('data-section');
                                    this.activeSection = sectionId;
                                }
                            });
                        }, {
                            rootMargin: '-20% 0px -60% 0px',
                            threshold: 0.1
                        });

                        sections.forEach(section => observer.observe(section));
                    },

                    setupSmoothScroll() {
                        document.documentElement.style.scrollBehavior = 'smooth';
                    }
                }
            }
        </script>
    @endpush

    <style>
        .vehicle-sub-nav {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Hover effect solo para el border */
        .nav-item:hover .hover-border {
            width: 100% !important;
        }

        /* Animación de entrada del menú */
        .vehicle-sub-nav {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Asegurar que solo el texto cambie de color en hover */
        .nav-item {
            background: transparent !important;
        }

        .nav-item:hover {
            background: transparent !important;
        }
    </style>
</div>
