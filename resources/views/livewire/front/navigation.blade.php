<!-- resources/views/livewire/navigation.blade.php -->
<header class="sticky top-0 z-50 bg-white shadow-md">
    <div class="container mx-auto px-4">
        <nav class="flex items-center justify-between h-16 lg:h-20">
            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="/" class="block">
                    <img
                        src="{{ asset($logo['image']) }}"
                        alt="{{ $logo['alt'] }}"
                        class="h-8 lg:h-18 w-auto object-contain"
                    />
                </a>
            </div>


            {{-- Desktop Menu --}}
{{--            <div class="hidden lg:flex items-center space-x-8">--}}
{{--                @foreach($this->menuItems as $item)--}}
{{--                    <div class="relative group" x-data="{ open: false }">--}}
{{--                        @if($item['has_dropdown'])--}}
{{--                            <button--}}
{{--                                @mouseenter="open = true"--}}
{{--                                @mouseleave="open = false"--}}
{{--                                class="geely-nav-item flex items-center transition-colors duration-200 py-2 hover:text-geely-blue"--}}
{{--                            >--}}
{{--                                {{ $item['label'] }}--}}
{{--                                <svg class="ml-1 w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>--}}
{{--                                </svg>--}}
{{--                            </button>--}}

{{--                            --}}{{-- Dropdown --}}
{{--                            <div--}}
{{--                                x-show="open"--}}
{{--                                x-transition:enter="transition ease-out duration-200"--}}
{{--                                x-transition:enter-start="opacity-0 transform scale-95"--}}
{{--                                x-transition:enter-end="opacity-100 transform scale-100"--}}
{{--                                x-transition:leave="transition ease-in duration-150"--}}
{{--                                x-transition:leave-start="opacity-100 transform scale-100"--}}
{{--                                x-transition:leave-end="opacity-0 transform scale-95"--}}
{{--                                @mouseenter="open = true"--}}
{{--                                @mouseleave="open = false"--}}
{{--                                class="absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2"--}}
{{--                            >--}}
{{--                                @foreach($item['dropdown_items'] as $dropdownItem)--}}

{{--                                    <a href="{{ $dropdownItem['url'] }}"--}}
{{--                                    class="geely-dropdown-item block px-4 py-2 hover:bg-gray-50 hover:text-geely-blue transition-colors duration-200"--}}
{{--                                    >--}}
{{--                                    {{ $dropdownItem['label'] }}--}}
{{--                                    </a>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        @else--}}

{{--                            <a href="{{ $item['url'] }}"--}}
{{--                            class="geely-nav-item transition-colors duration-200 py-2 hover:text-geely-blue {{ $item['active'] ? 'text-geely-blue border-b-2 border-geely-blue' : '' }}"--}}
{{--                            >--}}
{{--                            {{ $item['label'] }}--}}
{{--                            </a>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}

            {{-- Mobile Menu Button --}}
{{--            <div class="lg:hidden">--}}
{{--                <button--}}
{{--                    wire:click="toggleMenu"--}}
{{--                    class="p-2 rounded-md text-black focus:outline-none focus:ring-2 focus:ring-geely-blue"--}}
{{--                >--}}
{{--                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                        @if($isMenuOpen)--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>--}}
{{--                        @else--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>--}}
{{--                        @endif--}}
{{--                    </svg>--}}
{{--                </button>--}}
{{--            </div>--}}
        </nav>
    </div>

    {{-- Mobile Menu - FUERA del container de navegación --}}
    @if($isMenuOpen)
{{--        <div class="lg:hidden bg-white border-t border-gray-200 shadow-lg">--}}
{{--            <div class="container mx-auto px-4 py-4">--}}
{{--                @foreach($menuItems as $item)--}}
{{--                    <div x-data="{ mobileOpen: false }" class="mb-2">--}}
{{--                        @if($item['has_dropdown'])--}}
{{--                            <button--}}
{{--                                @click="mobileOpen = !mobileOpen"--}}
{{--                                class="geely-nav-item flex items-center justify-between w-full px-4 py-3 text-left hover:bg-gray-50 hover:text-geely-blue transition-colors duration-200 rounded-lg"--}}
{{--                            >--}}
{{--                                <span>{{ $item['label'] }}</span>--}}
{{--                                <svg class="w-4 h-4 transition-transform duration-200" :class="mobileOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>--}}
{{--                                </svg>--}}
{{--                            </button>--}}

{{--                            <div x-show="mobileOpen" x-collapse class="bg-gray-50 rounded-lg mt-2">--}}
{{--                                @foreach($item['dropdown_items'] as $dropdownItem)--}}
{{--                                    <a--}}
{{--                                        href="{{ $dropdownItem['url'] }}"--}}
{{--                                        class="geely-dropdown-item block px-8 py-3 hover:text-geely-blue transition-colors duration-200"--}}
{{--                                    >--}}
{{--                                        {{ $dropdownItem['label'] }}--}}
{{--                                    </a>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        @else--}}
{{--                            <a--}}
{{--                                href="{{ $item['url'] }}"--}}
{{--                                class="geely-nav-item block px-4 py-3 hover:bg-gray-50 hover:text-geely-blue transition-colors duration-200 rounded-lg {{ $item['active'] ? 'text-geely-blue bg-blue-50' : '' }}"--}}
{{--                            >--}}
{{--                                {{ $item['label'] }}--}}
{{--                            </a>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
    @endif

</header>
