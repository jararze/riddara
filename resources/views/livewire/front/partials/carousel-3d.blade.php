{{-- resources/views/livewire/front/partials/carousel-3d.blade.php --}}
<div class="carousel-3d-container" style="height: 700px;">
    <div class="carousel-3d-stage">
        <div class="carousel-3d-wrapper"
             style="transform: rotateY({{ $currentSlide * -(360 / count($modelsConfig['vehicles'][$activeCategory])) }}deg);">

            @foreach($modelsConfig['vehicles'][$activeCategory] as $index => $vehicle)
                @php
                    $totalItems = count($modelsConfig['vehicles'][$activeCategory]);
                    $angle = 360 / $totalItems;
                    $rotateY = $index * $angle;
                    $translateZ = 350; // Distancia del centro
                    $isActive = $index === $currentSlide;
                @endphp

                <div class="carousel-3d-item {{ $isActive ? 'active' : '' }}"
                     style="transform: rotateY({{ $rotateY }}deg) translateZ({{ $translateZ }}px);">

                    <div class="vehicle-card">
                        {{-- Vehicle Name --}}
                        <div class="vehicle-header">
                            <h3 class="vehicle-name {{ $isActive ? 'text-3xl' : 'text-xl' }}">
                                {{ $vehicle['name'] }}
                            </h3>
                            @if($isActive)
                                <p class="vehicle-description">{{ $vehicle['description'] }}</p>
                            @endif
                        </div>

                        {{-- Vehicle Image --}}
                        <div class="vehicle-image-container">
                            {{-- Badge --}}
                            @if($vehicle['features']['show_badge'])
                                <div class="vehicle-badge {{ $vehicle['features']['badge_color'] }}">
                                    {{ $vehicle['features']['badge_text'] }}
                                </div>
                            @endif

                            <img src="{{ asset($vehicle['image']) }}"
                                 alt="{{ $vehicle['name'] }}"
                                 class="vehicle-image">
                        </div>

                        {{-- Vehicle Info --}}
                        <div class="vehicle-info">
                            {{-- Pricing --}}
                            <div class="vehicle-pricing">
                                <div class="price-before">
                                    {{ $vehicle['pricing']['from_label'] }}
                                    <span class="line-through text-gray-500">
                                        {{ $vehicle['pricing']['currency_before'] }} {{ $vehicle['pricing']['price_before'] }}
                                    </span>
                                </div>
                                <div class="price-current">
                                    <span class="price-label">{{ $vehicle['pricing']['discount_label'] }}</span>
                                    <span class="price-amount {{ $isActive ? 'text-3xl' : 'text-xl' }}">
                                        {{ $vehicle['pricing']['currency_now'] }} {{ $vehicle['pricing']['price_now'] }}
                                    </span>
                                </div>
                            </div>

                            {{-- Button (solo para activo) --}}
                            @if($isActive && $vehicle['button_primary']['show'])
                                <button class="vehicle-button">
                                    {{ $vehicle['button_primary']['text'] }}
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Navigation Controls --}}
    <div class="carousel-controls">
        {{-- Previous Button --}}
        <button wire:click="prevSlide" class="carousel-btn carousel-btn-prev">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        {{-- Next Button --}}
        <button wire:click="nextSlide" class="carousel-btn carousel-btn-next">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

    {{-- Dots Navigation --}}
    <div class="carousel-dots">
        @foreach($modelsConfig['vehicles'][$activeCategory] as $index => $vehicle)
            <button wire:click="goToSlide({{ $index }})"
                    class="carousel-dot {{ $currentSlide === $index ? 'active' : '' }}">
            </button>
        @endforeach
    </div>
</div>

<style>
    /* Contenedor principal */
    .carousel-3d-container {
        position: relative;
        width: 100%;
        overflow: hidden;
        perspective: 1200px;
    }

    /* Escenario 3D */
    .carousel-3d-stage {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Wrapper que rota */
    .carousel-3d-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
        transform-style: preserve-3d;
        transition: transform 0.8s cubic-bezier(0.4, 0.0, 0.2, 1);
    }

    /* Items individuales */
    .carousel-3d-item {
        position: absolute;
        width: 400px;
        height: 500px;
        left: 50%;
        top: 50%;
        margin-left: -200px;
        margin-top: -250px;
        backface-visibility: hidden;
        transition: all 0.8s cubic-bezier(0.4, 0.0, 0.2, 1);
        opacity: 0.6;
        filter: blur(1px) brightness(0.7);
    }

    .carousel-3d-item.active {
        opacity: 1;
        filter: blur(0) brightness(1);
        z-index: 10;
    }

    /* Card del vehículo */
    .vehicle-card {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        padding: 2rem;
        border-radius: 1rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.8s ease;
    }

    .carousel-3d-item.active .vehicle-card {
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        transform: scale(1.05);
    }

    /* Header del vehículo */
    .vehicle-header {
        text-align: center;
        margin-bottom: 1rem;
    }

    .vehicle-name {
        font-weight: bold;
        color: #1f2937;
        transition: all 0.5s ease;
        margin-bottom: 0.5rem;
    }

    .vehicle-description {
        color: #6b7280;
        font-size: 1rem;
        max-width: 300px;
    }

    /* Contenedor de imagen */
    .vehicle-image-container {
        position: relative;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .vehicle-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 5;
    }

    .vehicle-image {
        max-width: 100%;
        max-height: 200px;
        object-fit: contain;
        transition: all 0.8s ease;
    }

    .carousel-3d-item.active .vehicle-image {
        transform: scale(1.1);
    }

    /* Info del vehículo */
    .vehicle-info {
        text-align: center;
        margin-top: 1rem;
    }

    .vehicle-pricing {
        margin-bottom: 1.5rem;
    }

    .price-before {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .price-current {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .price-label {
        font-size: 0.875rem;
        color: #3b82f6;
        font-weight: 600;
    }

    .price-amount {
        font-weight: bold;
        color: #3b82f6;
        transition: all 0.5s ease;
    }

    .vehicle-button {
        background: #000;
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .vehicle-button:hover {
        background: #374151;
        transform: translateY(-2px);
    }

    /* Controles */
    .carousel-controls {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding: 0 2rem;
        pointer-events: none;
        z-index: 20;
    }

    .carousel-btn {
        pointer-events: auto;
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 50%;
        width: 3rem;
        height: 3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #374151;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .carousel-btn:hover {
        background: white;
        transform: scale(1.1);
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
    }

    /* Dots */
    .carousel-dots {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 0.75rem;
        z-index: 20;
    }

    .carousel-dot {
        width: 0.75rem;
        height: 0.75rem;
        border-radius: 50%;
        border: none;
        background: rgba(156, 163, 175, 0.6);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .carousel-dot.active {
        background: #7c3aed;
        transform: scale(1.3);
    }

    .carousel-dot:hover {
        background: #7c3aed;
        transform: scale(1.1);
    }

    /* Responsivo */
    @media (max-width: 768px) {
        .carousel-3d-item {
            width: 300px;
            height: 400px;
            margin-left: -150px;
            margin-top: -200px;
        }

        .vehicle-card {
            padding: 1.5rem;
        }

        .vehicle-name {
            font-size: 1.25rem;
        }

        .price-amount {
            font-size: 1.5rem;
        }
    }
</style>
