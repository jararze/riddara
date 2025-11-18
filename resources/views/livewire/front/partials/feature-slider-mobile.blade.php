{{-- resources/views/livewire/front/partials/feature-slider-mobile.blade.php --}}
<div class="px-4"
     x-data="{
        touchStartX: 0,
        touchEndX: 0,
        handleSwipe() {
            if (this.touchEndX < this.touchStartX - 50) {
                $wire.call('nextSlide');
            }
            if (this.touchEndX > this.touchStartX + 50) {
                $wire.call('prevSlide');
            }
        }
     }"
     @touchstart="touchStartX = $event.changedTouches[0].screenX"
     @touchend="touchEndX = $event.changedTouches[0].screenX; handleSwipe()">

    <div class="flex gap-3 h-80">
        <!-- Imagen Principal -->
        <div class="flex-2">
            <div class="relative h-full rounded-2xl overflow-hidden bg-gray-200 shadow-xl">
                <img
                    src="{{ asset($this->getCurrentSlide()['main_image']) }}"
                    class="w-full h-full object-cover"
                    alt=""
                    wire:key="mobile-main-{{ $currentSlide }}">
            </div>
        </div>

        <!-- Thumbnail siguiente (más pequeño al lado) -->
        <div class="w-10">
            @php
                $nextSlide = ($currentSlide + 1) % count($featureData['slides']);
                $nextSlideData = $featureData['slides'][$nextSlide];
            @endphp

            <div class="h-full rounded-xl overflow-hidden bg-gray-200 shadow-lg opacity-60" style="height: 80%; align-items: center; margin-top: 30px">
                <img
                    src="{{ asset($nextSlideData['thumbnail_image']) }}"
                    class="w-full h-full object-cover"
                    alt="">
            </div>
        </div>
    </div>

    <!-- Textos debajo -->
    <div class="mt-6">
        <h3 class="text-xl font-bold text-gray-900 mb-2">
            {{ $this->getCurrentSlide()['title'] }}
        </h3>
        <p class="text-base text-[#3B4C39] font-medium mb-2">
            {{ $this->getCurrentSlide()['subtitle'] }}
        </p>
        <p class="text-sm text-gray-600 leading-relaxed">
            {{ $this->getCurrentSlide()['description'] }}
        </p>
    </div>
</div>
