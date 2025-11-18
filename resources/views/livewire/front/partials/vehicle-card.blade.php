{{-- resources/views/livewire/front/partials/vehicle-card.blade.php --}}
@php
    $isCenter = $position === 'center';
    $cardWidth = $isCenter ? 'w-96' : 'w-80';
    $imageHeight = $isCenter ? 'h-64' : 'h-48';
    $titleSize = $isCenter ? 'text-2xl' : 'text-lg'; // Cambié de text-xl a text-lg
    $descriptionSize = $isCenter ? 'text-base' : 'text-sm'; // Nuevo para descripción
    $paddingSize = $isCenter ? 'p-4' : 'p-3'; // Menos padding en laterales
@endphp

<div class="{{ $cardWidth }} rounded-lg overflow-visible relative">
    {{-- Badge --}}
    @if($vehicle['features']['show_badge'] ?? false)
        <div class="absolute top-4 right-4 z-10">
            <span class="{{ $vehicle['features']['badge_color'] }} px-3 py-1 rounded-full text-xs font-bold">
                {{ $vehicle['features']['badge_text'] }}
            </span>
        </div>
    @endif

    {{-- Vehicle Name --}}
    @if($position === 'center')
        <div class="text-center mb-4">
            <h3 class="{{ $titleSize }} font-bold text-gray-900">{{ $vehicle['name'] }}</h3>
            <p class="text-gray-600 mt-2 {{ $descriptionSize }}">{{ $vehicle['description'] }}</p>
        </div>
    @endif

    {{-- Vehicle Image --}}
    <div class="{{ $imageHeight }} flex items-center justify-center ">
        <a href="{{ route('vehicle.detail', ['category' => strtolower($vehicle['category']), 'slug' => $vehicle['slug']]) }}">
            <img
                src="{{ asset($vehicle['image']) }}"
                alt="{{ $vehicle['name'] }}"
                class="w-full h-full object-contain"
            >
        </a>
    </div>

    {{-- Vehicle Info para laterales --}}
    @if($position === 'side')
        <div class="{{ $paddingSize }} text-center">
            <h4 class="{{ $titleSize }} font-bold text-gray-900 mb-1">{{ $vehicle['name'] }}</h4>

            {{-- Descripción más pequeña para laterales --}}
            @if($vehicle['description'])
                <p class="text-gray-600 {{ $descriptionSize }} mb-2">{{ $vehicle['description'] }}</p>
            @endif

            {{-- Usar el nuevo componente de pricing --}}
            @if($vehicle['featured'])
                @include('livewire.front.partials.vehicle-pricing', ['vehicle' => $vehicle, 'position' => $position])
            @endif
        </div>
    @endif
</div>

{{-- Pricing y Button para vehículo central --}}
@if($position === 'center')
    <div class="text-center mt-6">
        {{-- Usar el nuevo componente de pricing --}}
        @if($vehicle['featured'])
            @include('livewire.front.partials.vehicle-pricing', ['vehicle' => $vehicle, 'position' => $position])
        @endif
    </div>
@endif
