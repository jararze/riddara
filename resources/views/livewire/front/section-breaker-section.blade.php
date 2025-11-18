<div>
    <section class="{{ $breakerData['section_background'] ?? 'bg-gray-100' }} {{ $breakerData['section_padding'] ?? 'py-16' }}">
        <div class="container mx-auto px-4">
            <div class="{{ $breakerData['content']['text_align'] ?? 'text-center' }} {{ $breakerData['content']['max_width'] ?? 'max-w-4xl' }} mx-auto">
                <div class="{{ $breakerData['content']['spacing'] ?? 'space-y-4' }}">
                    {{-- Título --}}
                    @if(!empty($breakerData['content']['title'] ?? ''))
                        <h2 class="{{ $breakerData['content']['title_size'] ?? 'text-3xl lg:text-4xl' }} {{ $breakerData['content']['title_font_weight'] ?? 'font-bold' }}
                              {{ ($breakerData['styles']['title_gradient'] ?? false) ? ($breakerData['styles']['title_gradient_colors'] ?? '') : ($breakerData['content']['title_color'] ?? 'text-gray-900') }}">
                            {{ $breakerData['content']['title'] }}
                        </h2>
                    @endif

                    {{-- Subtítulo --}}
                    @if(!empty($breakerData['content']['subtitle'] ?? ''))
                        <p class="{{ $breakerData['content']['subtitle_size'] ?? 'text-lg lg:text-xl' }} {{ $breakerData['content']['subtitle_font_weight'] ?? 'font-normal' }}
                             {{ ($breakerData['styles']['subtitle_gradient'] ?? false) ? ($breakerData['styles']['subtitle_gradient_colors'] ?? '') : ($breakerData['content']['subtitle_color'] ?? 'text-gray-600') }}">
                            {{ $breakerData['content']['subtitle'] }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
