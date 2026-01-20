@extends('components.layouts.frontend.front')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-white flex items-center justify-center px-4 py-16">
        <div class="max-w-2xl w-full text-center">

            <!-- Ícono de éxito -->
            <div class="mx-auto w-28 h-28 bg-green-100 rounded-full flex items-center justify-center mb-8 animate-bounce">
                <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <!-- Título -->
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                ¡Gracias por contactarnos!
            </h1>

            <!-- Mensaje personalizado -->
            <p class="text-xl text-gray-600 mb-8">
                @if(isset($submission['nombre']))
                    <span class="font-semibold text-gray-800">{{ $submission['nombre'] }}</span>,
                @endif
                hemos recibido tu solicitud exitosamente.
            </p>

            <!-- Card con detalles -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 text-left">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 text-center">Resumen de tu solicitud</h2>

                <div class="space-y-4">
                    @if(isset($submission['tipo']))
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-500">Tipo de solicitud</span>
                            <span class="font-medium text-gray-900">
                        @switch($submission['tipo'])
                                    @case('test-drive')
                                        Test Drive
                                        @break
                                    @case('cotizacion')
                                        Cotización
                                        @break
                                    @default
                                        Consulta
                                @endswitch
                    </span>
                        </div>
                    @endif

                    @if(isset($submission['vehiculo']) && $submission['vehiculo'])
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-500">Vehículo de interés</span>
                            <span class="font-medium text-gray-900">{{ $submission['vehiculo'] }}</span>
                        </div>
                    @endif

                    @if(isset($submission['email']))
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-500">Te contactaremos a</span>
                            <span class="font-medium text-gray-900">{{ $submission['email'] }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between items-center py-3">
                        <span class="text-gray-500">Tiempo de respuesta</span>
                        <span class="font-medium text-blue-600">24 horas hábiles</span>
                    </div>
                </div>
            </div>

            <!-- Info adicional -->
            <div class="bg-blue-50 rounded-xl p-6 mb-8 border border-blue-100">
                <div class="flex items-center justify-center space-x-3 text-blue-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <span class="text-base font-medium">
                    Un asesor de <strong>Geely Bolivia</strong> te contactará pronto
                </span>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center justify-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition duration-200 transform hover:scale-[1.02]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Volver al inicio
                </a>

                <a href="{{ route('vehicles.index') }}"
                   class="inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-xl border-2 border-gray-200 transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Ver más vehículos
                </a>
            </div>

            <!-- Número de referencia -->
            @if(isset($submission['id']))
                <p class="mt-8 text-sm text-gray-400">
                    Número de referencia: #{{ str_pad($submission['id'], 6, '0', STR_PAD_LEFT) }}
                </p>
            @endif

        </div>
    </div>
@endsection
