<section class="benefits-section" style="{{ $this->getBackgroundStyle() }}">
    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">

            <!-- Columna 1: Título principal -->
            <div class="text-left">
                <h2 class="text-3xl lg:text-4xl font-bold text-white leading-tight">
                    {{ $sectionTitle }}
                </h2>
                <p class="text-white/80 mt-4 text-lg">
                    {{ $sectionDescription }}
                </p>
            </div>

            <!-- Columna 2: Garantía Extendida -->
            <div class="text-center">
                <h3 class="text-white text-sm font-medium mb-4 uppercase tracking-wider">
                    GARANTÍA EXTENDIDA
                </h3>

                <div class="flex items-center justify-center gap-4">
                    <!-- Card 5 años -->
                    <div class="benefit-card-custom {{--bg-white/20 backdrop-blur-sm rounded-2xl flex flex-col items-center justify-center text-center--}}">
                        <div class="benefit-number">5</div>
                        <div class="benefit-unit text-white/90 font-medium">AÑOS</div>
                    </div>

                    <!-- Conector "ó" -->
                    <div class="text-white connector-text">ó</div>

                    <!-- Card 150.000 KM -->
                    <div class="benefit-card-custom {{--bg-white/20 backdrop-blur-sm rounded-2xl flex flex-col items-center justify-center text-center--}}">
                        <div class="benefit-unit">150.000</div>
                        <div class="benefit-number text-white/90 font-medium">KM</div>
                    </div>
                </div>
            </div>

            <!-- Columna 3: Mantenimientos -->
            <div class="text-center">
                <h3 class="text-white text-sm font-medium mb-4 uppercase tracking-wider">
                    Y MANTENIMIENTOS INCLUIDOS
                </h3>

                <div class="flex items-center justify-center gap-4">
                    <!-- Card 6 servicios -->
                    <div class="benefit-card-custom {{--bg-white/20 backdrop-blur-sm rounded-2xl flex flex-col items-center justify-center text-center--}}">
                        <div class="benefit-number">6</div>
                        <div class="text-sm benefit-unit text-white/90 font-medium" style="font-size: 20px">SERVICIOS</div>
                    </div>

                    <!-- Conector "EN" -->
                    <div class="text-white connector-text" >EN</div>

                    <!-- Card 3 años -->
                    <div class="benefit-card-custom {{--bg-white/20 backdrop-blur-sm rounded-2xl flex flex-col items-center justify-center text-center--}}">
                        <div class="benefit-number">3</div>
                        <div class="benefit-unit text-white/90 font-medium">AÑOS</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer text -->
        <div class="text-center mt-8">
            <p class="text-white/70 text-sm">{{ $footerText }}</p>
        </div>
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

            /*border-radius: 16px;*/
            /*background: linear-gradient(135deg,*/
            /*rgba(255, 255, 255, 0.2) 0%,*/
            /*rgba(255, 255, 255, 0.05) 100%);*/
            /*backdrop-filter: blur(20px);*/
            /*border: 1px solid rgba(255, 255, 255, 0.25);*/
            /*box-shadow:*/
            /*    0 8px 32px rgba(31, 38, 135, 0.37),*/
            /*    inset 0 1px 0 rgba(255, 255, 255, 0.3);*/

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

        /*.benefit-card-custom::before {*/
        /*    content: '';*/
        /*    position: absolute;*/
        /*    top: -4px;    !* Cambiar de -2px a -4px *!*/
        /*    left: -4px;   !* Cambiar de -2px a -4px *!*/
        /*    right: -4px;  !* Cambiar de -2px a -4px *!*/
        /*    bottom: -4px; !* Cambiar de -2px a -4px *!*/
        /*    background: linear-gradient(145deg, rgba(255,255,255,0.8), rgba(255,255,255,0.2));*/
        /*    border-radius: 20px; !* Ajustar también el border-radius *!*/
        /*    z-index: -1;*/
        /*}*/

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

