{{-- Mostrar vehículo pre-seleccionado --}}
@if($selectedVehicle)
    <div class="mb-6 px-4 py-1 text-sm bg-blue-50 rounded-lg border border-blue-200">
        <p class="text-sm text-[#3B4C39]">
            <strong>Vehículo seleccionado:</strong> {{ $selectedVehicle['name'] }}
        </p>
    </div>
@endif

{{-- Formulario --}}
<form wire:submit="submitForm" class="space-y-8">

    {{-- Nombre --}}
    <div class="flex items-center">
        <label class="text-sm font-medium text-gray-700 w-20 flex-shrink-0 pb-2 border-b border-gray-300">Nombre</label>
        <div class="flex-1 relative">
            <input type="text"
                   wire:model="formData.nombre"
                   placeholder="Nombre y Apellido"
                   class="w-full pb-2 border-0 border-b border-gray-300 focus:border-blue-500 focus:ring-0 bg-transparent placeholder-gray-400 text-sm">
            @error('formData.nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Email --}}
    <div class="flex items-center">
        <label class="text-sm font-medium text-gray-700 w-20 flex-shrink-0 pb-2 border-b border-gray-300">Email</label>
        <div class="flex-1 relative">
            <input type="email"
                   wire:model="formData.email"
                   placeholder="name@email.com"
                   class="w-full pb-2 border-0 border-b border-gray-300 focus:border-blue-500 focus:ring-0 bg-transparent placeholder-gray-400 text-sm">
            @error('formData.email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Celular --}}
    <div class="flex items-center">
        <label class="text-sm font-medium text-gray-700 w-20 flex-shrink-0 pb-2 border-b border-gray-300">Celular</label>
        <div class="flex-1 relative">
            <div class="flex items-center border-b border-gray-300 focus-within:border-blue-500">
                {{-- Selector de país --}}
                <div class="relative" x-data="{ open: false }">
                    <button type="button"
                            @click="open = !open"
                            class="flex items-center pr-3 focus:outline-none">
                        <img src="https://flagcdn.com/16x12/{{ strtolower($paises[$paisSeleccionado]['codigo_iso']) }}.png"
                             alt="{{ $paises[$paisSeleccionado]['nombre'] }}"
                             class="w-4 h-3 mr-1">
                        <span class="text-sm text-gray-600">{{ $paises[$paisSeleccionado]['nombre'] }}</span>
                        <svg class="w-4 h-4 ml-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    {{-- Dropdown de países --}}
                    <div x-show="open"
                         @click.away="open = false"
                         x-transition
                         class="absolute top-full left-0 bg-white border border-gray-300 rounded-md shadow-lg z-50 min-w-[140px]">
                        @foreach($paises as $key => $pais)
                            <button type="button"
                                    wire:click="cambiarPais('{{ $key }}')"
                                    @click="open = false"
                                    class="flex items-center w-full px-3 py-2 text-sm hover:bg-gray-100">
                                <img src="https://flagcdn.com/16x12/{{ strtolower($pais['codigo_iso']) }}.png"
                                     alt="{{ $pais['nombre'] }}"
                                     class="w-4 h-3 mr-2">
                                <span>{{ $pais['nombre'] }}</span>
                                <span class="ml-auto text-gray-500 text-xs">{{ $pais['codigo'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <span class="text-gray-600 pr-2 text-sm">{{ $formData['codigo_pais'] }}</span>
                <input type="tel"
                       wire:model="formData.telefono"
                       placeholder="Ej. 70677777"
                       class="flex-1 pb-2 border-0 focus:ring-0 bg-transparent placeholder-gray-400 text-sm">
            </div>
            @error('formData.telefono') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Ciudad --}}
    <div class="flex items-center">
        <label class="text-sm font-medium text-gray-700 w-20 flex-shrink-0 pb-2 border-b border-gray-300">Ciudad</label>
        <div class="flex-1 relative">
            <select wire:model="formData.ciudad"
                    class="w-full pb-2 border-0 border-b border-gray-300 focus:border-blue-500 focus:ring-0 bg-transparent appearance-none text-gray-600 text-sm">
                <option value="">Selecciona tu ciudad</option>
                <option value="santa-cruz">Santa Cruz</option>
                <option value="la-paz">La Paz</option>
                <option value="cochabamba">Cochabamba</option>
                <option value="el-alto">El Alto</option>
                <option value="sucre">Sucre</option>
                <option value="tarija">Tarija</option>
                <option value="oruro">Oruro</option>
                <option value="potosi">Potosí</option>
                <option value="trinidad">Trinidad</option>
            </select>
            <svg class="absolute right-0 bottom-2 w-5 h-5 text-gray-400 pointer-events-none" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
            @error('formData.ciudad') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Selector de vehículo (solo si no viene pre-seleccionado) --}}
    @if(!$selectedVehicle)
        <div class="flex items-center">
            <label class="text-sm font-medium text-gray-700 w-20 flex-shrink-0 pb-2 border-b border-gray-300">Vehículo</label>
            <div class="flex-1 relative">
                <select wire:model="formData.vehiculo"
                        class="w-full pb-2 border-0 border-b border-gray-300 focus:border-blue-500 focus:ring-0 bg-transparent appearance-none text-gray-600 text-sm">
                    <option value="">Selecciona el vehículo de tu interés</option>
                    @foreach($this->getAllVehicles() as $vehicle)
                        <option value="{{ $vehicle['value'] }}">{{ $vehicle['label'] }}</option>
                    @endforeach
                </select>
                <svg class="absolute right-0 bottom-2 w-5 h-5 text-gray-400 pointer-events-none" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
                @error('formData.vehiculo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
    @endif

    {{-- Campo mensaje solo para consulta --}}
    @if($activeTab === 'consulta')
        <div class="flex items-start">
            <label class="text-sm font-medium text-gray-700 w-20 flex-shrink-0">Mensaje</label>
            <div class="flex-1 relative">
                <textarea wire:model="formData.mensaje"
                          placeholder="Escribe tu consulta aquí..."
                          rows="4"
                          class="w-full pb-2 border-0 border-b border-gray-300 focus:border-blue-500 focus:ring-0 bg-transparent placeholder-gray-400 text-sm resize-none"></textarea>
                @error('formData.mensaje') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
    @endif

    {{-- Checkbox y botón en la misma línea --}}
    <div class="flex items-center gap-6 pt-4">
        {{-- Checkbox y texto (70%) --}}
        <div class="flex items-start flex-grow max-w-[70%]">
            <input type="checkbox"
                   wire:model="formData.receive_offers"
                   id="receive_offers_{{ $activeTab }}"
                   class="mt-1 h-4 w-4 text-[#3B4C39] focus:ring-blue-500 border-gray-300 rounded">
            <label for="receive_offers_{{ $activeTab }}" class="ml-2 text-sm text-gray-600">
                Deseo recibir ofertas y promociones especiales de Riddara por WhatsApp / Email
            </label>
        </div>

        {{-- Botón enviar --}}
        <button type="submit"
                class="bg-[#194BFF] hover:bg-gray-500 text-white font-medium py-3 px-8 rounded-lg transition-colors duration-200 whitespace-nowrap">
            Enviar
        </button>
    </div>
</form>

{{-- Mensaje de éxito --}}
@if (session()->has('message'))
    <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
        {{ session('message') }}
    </div>
@endif
