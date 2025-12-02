<section class="benefits-section" style="{{ $this->getBackgroundStyle() }}">
    <div class="container mx-auto px-4 py-8 lg:py-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-2 items-center">

            <!-- Columna 1: Título principal -->
            <div class="text-center lg:text-left">
                <h2 class="text-3xl lg:text-4xl font-bold text-white leading-tight">
                    {{ $sectionTitle }}
                </h2>
                <p class="text-white/80 mt-4 text-lg">
                    {{ $sectionDescription }}
                </p>
            </div>

            <!-- Columna 2: Garantía Extendida -->
            <div class="flex justify-center items-center">
                <img src="{{ asset("assets/images/Grupo 1.png") }}" alt="" class="w-64 mx-auto">
            </div>

            <!-- Columna 3: Mantenimientos -->
            <div class="flex justify-center items-center">
                <img src="{{ asset("assets/images/Grupo 2.png") }}" alt="" class="w-64 mx-auto lg:mt-[-41px]">
            </div>

            <!-- Columna 4 -->
            <div class="flex justify-center items-center">
                <img src="{{ asset("assets/images/Grupo 3.png") }}" alt="" class="w-64 mx-auto lg:mt-[-21px]">
            </div>
        </div>

        <!-- Footer text -->
        {{--        <div class="text-center mt-8">--}}
        {{--            <p class="text-white/70 text-sm">{{ $footerText }}</p>--}}
        {{--        </div>--}}
    </div>

    <style>
        .benefit-card-custom {
            min-width: 150px;
            max-width: 200px;
            min-height: 150px;
            max-height: 200px;
            padding: 16px;
            font-family: 'GeelyTitle', sans-serif;
            position: relative;

            background-color: transparent;

            background-image: url('/{{ $cardBackgroundImage }}');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;

        }


        .benefit-number {
            font-size: 40px;
            font-weight: bold;
        }

        .benefit-unit {
            font-size: 25px;
            font-weight: 500;
        }

        .connector-text {
            font-family: 'GeelyTitle', sans-serif;
            font-size: 25px;
        }
    </style>
</section>
