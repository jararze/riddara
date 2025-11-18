{{-- resources/views/livewire/front/partials/vehicles-desktop.blade.php --}}
@php
    $currentSet = $this->getCurrentSet();
@endphp

<div class="relative w-full" wire:key="desktop-vehicles-{{ $activeCategory }}-{{ $currentIndex }}">
    {{-- Navigation Arrows --}}
    @if(count($modelsConfig['vehicles'][$activeCategory]) > 1)
        <button
            wire:click="prevSlide"
            class="absolute left-4 top-1/2 transform -translate-y-1/2 z-20 rounded-full p-3 shadow-lg hover:shadow-xl transition-all duration-200"
        >
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <button
            wire:click="nextSlide"
            class="absolute right-4 top-1/2 transform -translate-y-1/2 z-20 rounded-full p-3 shadow-lg hover:shadow-xl transition-all duration-200"
        >
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    @endif

    {{-- Vehicles Container --}}
    <div class="flex items-center justify-center space-x-8 px-20 py-8 min-h-[400px]">
        {{-- Left Vehicle (Smaller) --}}
        @if(isset($currentSet['left']))
            <div class="flex-shrink-0 opacity-70 scale-75 transform transition-all duration-500 hover:opacity-90 hover:scale-80">
                @include('livewire.front.partials.vehicle-card', ['vehicle' => $currentSet['left'], 'position' => 'side'])
            </div>
        @endif

        {{-- Center Vehicle (Featured/Larger) --}}
        @if(isset($currentSet['center']))
            <div class="flex-shrink-0 scale-100 transform transition-all duration-500 z-10">
                @include('livewire.front.partials.vehicle-card', ['vehicle' => $currentSet['center'], 'position' => 'center'])
            </div>
        @endif

        {{-- Right Vehicle (Smaller) --}}
        @if(isset($currentSet['right']))
            <div class="flex-shrink-0 opacity-70 scale-75 transform transition-all duration-500 hover:opacity-90 hover:scale-80">
                @include('livewire.front.partials.vehicle-card', ['vehicle' => $currentSet['right'], 'position' => 'side'])
            </div>
        @endif
    </div>
</div>
