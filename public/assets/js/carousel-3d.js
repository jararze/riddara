// public/js/smooth-vehicle-carousel.js
class SmoothVehicleCarousel {
    constructor() {
        this.isAnimating = false;
        this.init();
    }

    init() {
        this.setupEventListeners();
        console.log('Smooth Vehicle Carousel inicializado');
    }

    setupEventListeners() {
        // Interceptar clicks de los botones de navegación
        document.addEventListener('click', (e) => {
            // Buscar si el click fue en un botón de navegación
            const prevButton = e.target.closest('[wire\\:click="prevSlide"]');
            const nextButton = e.target.closest('[wire\\:click="nextSlide"]');

            if (prevButton || nextButton) {
                e.preventDefault();

                if (this.isAnimating) return;

                // Ejecutar animación antes de Livewire
                this.animateTransition(nextButton ? 'next' : 'prev');

                // Después de la animación, ejecutar Livewire
                setTimeout(() => {
                    if (nextButton) {
                        this.triggerLivewireMethod('nextSlide');
                    } else {
                        this.triggerLivewireMethod('prevSlide');
                    }
                }, 300);
            }
        });

        // Soporte para teclado
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                e.preventDefault();
                this.handleNavigation('prev');
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                this.handleNavigation('next');
            }
        });

        // Soporte para mouse wheel
        const vehicleContainer = document.querySelector('.flex.items-center.justify-center.space-x-8');
        if (vehicleContainer) {
            vehicleContainer.addEventListener('wheel', (e) => {
                e.preventDefault();
                if (this.isAnimating) return;

                if (e.deltaY > 0) {
                    this.handleNavigation('next');
                } else {
                    this.handleNavigation('prev');
                }
            });
        }
    }

    handleNavigation(direction) {
        if (this.isAnimating) return;

        this.animateTransition(direction);

        setTimeout(() => {
            this.triggerLivewireMethod(direction === 'next' ? 'nextSlide' : 'prevSlide');
        }, 300);
    }

    animateTransition(direction) {
        this.isAnimating = true;

        const vehicleContainer = document.querySelector('.flex.items-center.justify-center.space-x-8');
        if (!vehicleContainer) {
            this.isAnimating = false;
            return;
        }

        const vehicles = vehicleContainer.children;
        const leftVehicle = vehicles[0]; // Left vehicle
        const centerVehicle = vehicles[1]; // Center vehicle
        const rightVehicle = vehicles[2]; // Right vehicle

        // Aplicar animación de salida
        Array.from(vehicles).forEach(vehicle => {
            vehicle.style.transition = 'all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        });

        if (direction === 'next') {
            // Animación hacia la izquierda
            if (leftVehicle) {
                leftVehicle.style.transform = 'translateX(-100px) scale(0.6)';
                leftVehicle.style.opacity = '0';
            }
            if (centerVehicle) {
                centerVehicle.style.transform = 'translateX(-400px) scale(0.75)';
                centerVehicle.style.opacity = '0.7';
            }
            if (rightVehicle) {
                rightVehicle.style.transform = 'translateX(-400px) scale(1)';
                rightVehicle.style.opacity = '1';
            }
        } else {
            // Animación hacia la derecha
            if (leftVehicle) {
                leftVehicle.style.transform = 'translateX(400px) scale(1)';
                leftVehicle.style.opacity = '1';
            }
            if (centerVehicle) {
                centerVehicle.style.transform = 'translateX(400px) scale(0.75)';
                centerVehicle.style.opacity = '0.7';
            }
            if (rightVehicle) {
                rightVehicle.style.transform = 'translateX(100px) scale(0.6)';
                rightVehicle.style.opacity = '0';
            }
        }

        // Resetear después de la animación
        setTimeout(() => {
            Array.from(vehicles).forEach(vehicle => {
                vehicle.style.transform = '';
                vehicle.style.opacity = '';
                vehicle.style.transition = '';
            });
            this.isAnimating = false;
        }, 500);
    }

    triggerLivewireMethod(method) {
        // Buscar el componente Livewire
        const livewireElement = document.querySelector('[wire\\:id]');
        if (livewireElement && window.Livewire) {
            const componentId = livewireElement.getAttribute('wire:id');
            const component = window.Livewire.find(componentId);
            if (component) {
                component.call(method);
            }
        }
    }

    // Método para animación de entrada después de actualización de Livewire
    animateIn() {
        const vehicleContainer = document.querySelector('.flex.items-center.justify-center.space-x-8');
        if (!vehicleContainer) return;

        const vehicles = vehicleContainer.children;

        Array.from(vehicles).forEach((vehicle, index) => {
            vehicle.style.opacity = '0';
            vehicle.style.transform = 'translateY(30px) scale(0.9)';
            vehicle.style.transition = 'all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94)';

            setTimeout(() => {
                vehicle.style.opacity = '';
                vehicle.style.transform = '';

                setTimeout(() => {
                    vehicle.style.transition = '';
                }, 500);
            }, index * 100);
        });
    }
}

// Inicializar el carousel
let smoothCarousel = null;

function initSmoothCarousel() {
    smoothCarousel = new SmoothVehicleCarousel();
}

// Inicializar cuando el DOM esté listo
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSmoothCarousel);
} else {
    initSmoothCarousel();
}

// Re-inicializar cuando Livewire actualice el contenido
if (window.Livewire) {
    window.Livewire.hook('morph.updated', () => {
        setTimeout(() => {
            initSmoothCarousel();
            if (smoothCarousel) {
                smoothCarousel.animateIn();
            }
        }, 50);
    });
}

// Exponer globalmente para debugging
window.smoothCarousel = smoothCarousel;
