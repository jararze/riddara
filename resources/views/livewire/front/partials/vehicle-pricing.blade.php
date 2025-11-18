{{-- resources/views/livewire/front/partials/vehicle-pricing.blade.php --}}
@props(['vehicle', 'position' => 'center'])

@php
    $isCenter = $position === 'center';
    // Definir tamaños según posición
    $priceBeforeSize = $isCenter ? 'text-sm' : 'text-xs';
    $priceLabelSize = $isCenter ? 'text-base' : 'text-sm';
    $priceAmountSize = $isCenter ? 'text-xl' : 'text-[0.7rem] !important';
    $buttonTextSize = $isCenter ? 'text-base' : 'text-sm';
    $buttonPadding = $isCenter ? 'py-3 px-8' : 'py-2 px-6';
    $wrapperScale = $isCenter ? '' : 'scale-90';
@endphp

<div class="vehicle-pricing-wrapper {{ $wrapperScale }}">
    {{-- Precio anterior (fuera del componente principal) --}}
    @if($vehicle['pricing']['show_from_label'] ?? false)
        <div class="price-before-external {{ $priceBeforeSize }}">
            Desde {{ $vehicle['pricing']['currency_before'] }}{{ number_format($vehicle['pricing']['price_before']) }}
        </div>
    @endif

    {{-- Componente principal con precio actual y botón --}}
    <div class="vehicle-pricing-container">
        {{-- Sección de precios (solo precio actual) --}}
        <div class="price-section {{ $isCenter ? 'min-w-[200px]' : 'min-w-[160px]' }}">
            <div class="price-now">

                <span class="price-now-label {{ $priceLabelSize }}">{{ $vehicle['pricing']['discount_label'] }}</span>
                <span class="price-now-amount {{ $priceAmountSize }}">
                    {{ $vehicle['pricing']['currency_now'] }} {{ number_format($vehicle['pricing']['price_now']) }}
                </span>
            </div>
        </div>

        {{-- Botón Ver modelo --}}
        @if($vehicle['button_primary']['show'] ?? false)
            <a
                href="{{ route('vehicle.detail', ['category' => strtolower($vehicle['category']), 'slug' => $vehicle['slug']]) }}"
                class="view-model-btn {{ $buttonTextSize }} {{ $buttonPadding }} {{ $isCenter ? 'min-w-[140px]' : 'min-w-[100px]' }}">
                {{ $isCenter ? $vehicle['button_primary']['text'] : 'Ver modelo' }}
            </a>
        @endif
    </div>
</div>
