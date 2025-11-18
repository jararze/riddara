{{-- resources/views/livewire/front/model-section.blade.php --}}
<section class="{{ $modelsConfig['section_settings']['background_color'] }} {{ $modelsConfig['section_settings']['padding_y'] }} pt-10">
    <div class="container mx-auto px-4">

        {{-- Header responsive --}}
        <div class="mb-10">
            <div class="flex flex-col lg:flex-row lg:items-center lg:gap-8">
                {{-- Título MODELOS --}}
                <div class="mb-6 lg:mb-0 text-center lg:text-left">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 {{ $modelsConfig['header']['title_color'] }} {{ $modelsConfig['header']['title_size'] }} {{ $modelsConfig['header']['title_weight'] }}">
                        {{ $modelsConfig['header']['title'] }}
                    </h2>
                </div>

                {{-- Texto descriptivo solo en móvil --}}
                @if(isset($modelsConfig['header']['subtitle_mobile']))
                    <div class="block lg:hidden mb-6 text-center">
                        <p class="text-lg text-gray-600">
                            {{ $modelsConfig['header']['subtitle_mobile'] }}
                        </p>
                    </div>
                @endif

                {{-- Categories Navigation --}}
                <div class="flex flex-wrap justify-center lg:justify-start gap-6 lg:gap-12">
                    @foreach($modelsConfig['categories'] as $category)
                        <button
                            wire:click="setActiveCategory('{{ $category['id'] }}')"
                            class="relative py-2 font-medium text-base lg:text-lg transition-all duration-200 font-geely-title pr-2 lg:pr-[55px]
                               {{ $activeCategory === $category['id']
                                  ? 'text-purple-600'
                                  : 'text-gray-400 hover:text-purple-600' }}"
                        >
                            {{ $category['label'] }}
                            @if($activeCategory === $category['id'])
                                <div class="absolute bottom-0 left-0 h-0.5 bg-purple-600" style="width: calc(100% - 8px);"></div>
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Vehicles Display --}}
        @if(isset($modelsConfig['vehicles'][$activeCategory]))
            <div class="relative">
                {{-- Desktop View --}}
                <div class="hidden lg:block">
                    @include('livewire.front.partials.vehicles-desktop')
                </div>

                {{-- Mobile View --}}
                <div class="lg:hidden">
                    @include('livewire.front.partials.vehicles-mobile')
                </div>
            </div>
        @endif
    </div>
</section>
@push('scripts')
{{--    <script src="{{ asset('assets/js/carousel-3d.js') }}"></script>--}}
@endpush
