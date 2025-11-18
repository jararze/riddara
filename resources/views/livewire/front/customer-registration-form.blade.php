<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4 max-w-4xl">
        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Registro de Cliente - Vehículo Adquirido
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Complete el siguiente formulario con sus datos personales para mejorar nuestro servicio posventa.
            </p>
        </div>

        {{-- Mensajes Flash --}}
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                <strong class="font-bold">¡Éxito!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                <strong class="font-bold">Error:</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Resumen de errores --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                <strong class="font-bold">Por favor corrija los siguientes errores:</strong>
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <form wire:submit.prevent="submitForm" class="p-6 md:p-8">

                {{-- SECCIÓN 1: DATOS PERSONALES OBLIGATORIOS --}}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 border-b-2 border-blue-500 pb-2">
                        Datos Personales (Obligatorios)
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {{-- Nombre --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre *
                            </label>
                            <input type="text"
                                   wire:model.blur="formData.first_name"
                                   class="w-full px-3 py-2 border @error('formData.first_name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('formData.first_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Apellido Paterno --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Apellido Paterno *
                            </label>
                            <input type="text"
                                   wire:model.blur="formData.last_name"
                                   class="w-full px-3 py-2 border @error('formData.last_name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('formData.last_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Apellido Materno --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Apellido Materno *
                            </label>
                            <input type="text"
                                   wire:model.blur="formData.second_last_name"
                                   class="w-full px-3 py-2 border @error('formData.second_last_name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('formData.second_last_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Sexo --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Sexo *
                            </label>
                            <select wire:model.blur="formData.gender"
                                    class="w-full px-3 py-2 border @error('formData.gender') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Seleccionar</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                                <option value="otro">Otro</option>
                            </select>
                            @error('formData.gender')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nacionalidad --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nacionalidad *
                            </label>
                            <select wire:model.blur="formData.nationality"
                                    class="w-full px-3 py-2 border @error('formData.nationality') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @foreach($nationalities as $nationality)
                                    <option value="{{ $nationality }}">{{ $nationality }}</option>
                                @endforeach
                            </select>
                            @error('formData.nationality')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Carnet/Pasaporte --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Carnet de Identidad / Pasaporte *
                            </label>
                            <input type="text"
                                   wire:model.blur="formData.id_document"
                                   class="w-full px-3 py-2 border @error('formData.id_document') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('formData.id_document')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Fecha de Nacimiento --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Fecha de Nacimiento *
                            </label>
                            <input type="date"
                                   wire:model.blur="formData.birth_date"
                                   class="w-full px-3 py-2 border @error('formData.birth_date') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('formData.birth_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Teléfono Móvil --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Número de Teléfono Móvil *
                            </label>
                            <input type="tel"
                                   wire:model.blur="formData.mobile_phone"
                                   class="w-full px-3 py-2 border @error('formData.mobile_phone') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('formData.mobile_phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Correo Electrónico *
                                <span class="text-xs text-gray-500 block">Para mensajes importantes (Facturas, documentos, alertas, etc.)</span>
                            </label>
                            <input type="email"
                                   wire:model.blur="formData.email"
                                   class="w-full px-3 py-2 border @error('formData.email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('formData.email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN 2: PROMOCIONES --}}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 border-b-2 border-blue-500 pb-2">
                        Preferencias de Comunicación
                    </h2>

                    <div class="space-y-4">
                        <p class="text-sm font-medium text-gray-700">¿Desea recibir promociones y ofertas especiales de posventa para su vehículo? *</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex items-center space-x-3">
                                <input type="checkbox"
                                       wire:model.defer="formData.promo_whatsapp"
                                       class="h-4 w-4 text-[#3B4C39] border-gray-300 rounded focus:ring-blue-500">
                                <span class="text-sm text-gray-700">Mediante WhatsApp</span>
                            </label>

                            <label class="flex items-center space-x-3">
                                <input type="checkbox"
                                       wire:model.defer="formData.promo_email"
                                       class="h-4 w-4 text-[#3B4C39] border-gray-300 rounded focus:ring-blue-500">
                                <span class="text-sm text-gray-700">Mediante Email</span>
                            </label>

                            <label class="flex items-center space-x-3">
                                <input type="checkbox"
                                       wire:model.defer="formData.promo_sms"
                                       class="h-4 w-4 text-[#3B4C39] border-gray-300 rounded focus:ring-blue-500">
                                <span class="text-sm text-gray-700">Mediante SMS</span>
                            </label>

                            <label class="flex items-center space-x-3">
                                <input type="checkbox"
                                       wire:model="formData.no_promotions"
                                       class="h-4 w-4 text-[#3B4C39] border-gray-300 rounded focus:ring-blue-500">
                                <span class="text-sm text-gray-700 font-medium">No deseo recibir promociones</span>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN 3: DIRECCIÓN --}}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 border-b-2 border-blue-500 pb-2">
                        Dirección de Residencia
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Ciudad --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Ciudad Residencia *
                            </label>
                            <select wire:model.blur="formData.city"
                                    class="w-full px-3 py-2 border @error('formData.city') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Seleccionar ciudad</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city }}">{{ $city }}</option>
                                @endforeach
                            </select>
                            @error('formData.city')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Zona/Barrio --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Zona o Barrio de Domicilio *
                            </label>
                            <input type="text"
                                   wire:model.blur="formData.neighborhood"
                                   class="w-full px-3 py-2 border @error('formData.neighborhood') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('formData.neighborhood')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Dirección Completa --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Dirección Completa de Domicilio *
                            </label>
                            <textarea wire:model.blur="formData.full_address"
                                      rows="2"
                                      class="w-full px-3 py-2 border @error('formData.full_address') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Ej: Av. Banzer #123, entre 2do y 3er anillo"></textarea>
                            @error('formData.full_address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN 4: ESTADO CIVIL Y FAMILIA --}}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 border-b-2 border-blue-500 pb-2">
                        Información Familiar
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {{-- Estado Civil --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Estado Civil *
                            </label>
                            <select wire:model.blur="formData.marital_status"
                                    class="w-full px-3 py-2 border @error('formData.marital_status') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Seleccionar</option>
                                <option value="soltero">Soltero/a</option>
                                <option value="casado">Casado/a</option>
                                <option value="divorciado">Divorciado/a</option>
                                <option value="viudo">Viudo/a</option>
                            </select>
                            @error('formData.marital_status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tiene Hijos --}}
                        <div class="md:col-span-2 lg:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                ¿Tiene hijos? *
                            </label>
                            <div class="flex space-x-4">
                                <label class="flex items-center">
                                    <input type="radio"
                                           wire:model.live="formData.has_children"
                                           value="si"
                                           class="h-4 w-4 text-[#3B4C39] border-gray-300 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Sí</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio"
                                           wire:model.live="formData.has_children"
                                           value="no"
                                           class="h-4 w-4 text-[#3B4C39] border-gray-300 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">No</span>
                                </label>
                            </div>
                            @error('formData.has_children')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Número de Hijos - Solo aparece si selecciona SÍ --}}
                        @if($formData['has_children'] === 'si')
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Número de Hijos *
                                </label>
                                <input type="number"
                                       wire:model.blur="formData.number_of_children"
                                       min="1"
                                       max="20"
                                       class="w-full md:w-1/3 px-3 py-2 border @error('formData.number_of_children') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="¿Cuántos hijos tiene?">
                                @error('formData.number_of_children')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>

                {{-- SECCIÓN 5: INFORMACIÓN LABORAL Y VEHÍCULO --}}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 border-b-2 border-blue-500 pb-2">
                        Información Laboral y Vehículo
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Campo Laboral --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Campo de Ejercicio Laboral *
                            </label>
                            <input type="text"
                                   wire:model.blur="formData.work_field"
                                   class="w-full px-3 py-2 border @error('formData.work_field') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Ej: Medicina, Ingeniería, Comercio, etc.">
                            @error('formData.work_field')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Asesor de Ventas --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre de su Asesor Profesional de Ventas *
                            </label>
                            <input type="text"
                                   wire:model.blur="formData.sales_advisor_name"
                                   class="w-full px-3 py-2 border @error('formData.sales_advisor_name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('formData.sales_advisor_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Vehículo Adquirido --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Vehículo Adquirido *
                            </label>
                            <select wire:model.blur="formData.purchased_vehicle"
                                    class="w-full px-3 py-2 border @error('formData.purchased_vehicle') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Seleccionar vehículo</option>
                                @foreach($vehicles as $key => $vehicle)
                                    <option value="{{ $vehicle }}">{{ $vehicle }}</option>
                                @endforeach
                            </select>
                            @error('formData.purchased_vehicle')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Característica Atractiva --}}
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            ¿Qué característica del vehículo adquirido le llamó más la atención? *
                        </label>
                        <textarea wire:model.blur="formData.vehicle_attractive_feature"
                                  rows="3"
                                  class="w-full px-3 py-2 border @error('formData.vehicle_attractive_feature') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Describa qué aspecto del vehículo le resultó más atractivo..."></textarea>
                        @error('formData.vehicle_attractive_feature')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- SECCIÓN 6: PREGUNTAS OPCIONALES --}}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 border-b-2 border-green-500 pb-2">
                        Preguntas Opcionales
                    </h2>

                    {{-- Aficiones --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Aficiones (Seleccione las que apliquen)
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                            @foreach($hobbiesOptions as $key => $hobby)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox"
                                           wire:model.defer="formData.hobbies"
                                           value="{{ $key }}"
                                           class="h-4 w-4 text-[#3B4C39] border-gray-300 rounded focus:ring-blue-500">
                                    <span class="text-sm text-gray-700">{{ $hobby }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Nivel de Estudios --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Estudios (Marque el nivel que completó)
                        </label>
                        <select wire:model.defer="formData.education_level"
                                class="w-full md:w-1/2 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Seleccionar nivel</option>
                            <option value="primaria">Primaria</option>
                            <option value="secundaria">Secundaria</option>
                            <option value="universitario">Universitario</option>
                            <option value="postgrado">Postgrado</option>
                        </select>
                    </div>

                    {{-- Conductor Principal --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            ¿Quién conducirá regularmente el vehículo?
                            <span class="text-xs text-gray-500 block">Por favor indique quién será la persona que normalmente usará el vehículo</span>
                        </label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio"
                                       wire:model.defer="formData.main_driver"
                                       value="yo"
                                       class="h-4 w-4 text-[#3B4C39] border-gray-300 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Yo conduciré el vehículo generalmente</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio"
                                       wire:model.defer="formData.main_driver"
                                       value="conyuge"
                                       class="h-4 w-4 text-[#3B4C39] border-gray-300 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Mi cónyuge conducirá el vehículo generalmente</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio"
                                       wire:model.defer="formData.main_driver"
                                       value="hijo"
                                       class="h-4 w-4 text-[#3B4C39] border-gray-300 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Mi hijo/hija conducirá el vehículo generalmente</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio"
                                       wire:model.defer="formData.main_driver"
                                       value="otro"
                                       class="h-4 w-4 text-[#3B4C39] border-gray-300 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Otra persona conducirá el vehículo generalmente</span>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Botón Submit --}}
                <div class="pt-6 border-t border-gray-200">
                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="w-full bg-[#3B4C39] hover:bg-[#3B4C39] disabled:bg-gray-400 disabled:cursor-not-allowed text-white font-medium py-4 px-8 rounded-lg transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <span wire:loading.remove>Registrar Información</span>
                        <span wire:loading>Procesando...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
