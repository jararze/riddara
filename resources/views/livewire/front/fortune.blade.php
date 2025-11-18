<div>
    <section class="about-section py-8" style="background-color: #fff;">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">

                <div class=" mx-auto">
                    <h1 class="text-3xl leading-relaxed max-w-3xl mx-auto bg-gradient-to-r from-blue-500 to-[#3B4C39] bg-clip-text text-transparent">
                        EL MUNDO ES DEMASIADO FASCINANTE COMO PARA VERLO A MEDIAS.
                    </h1>
                    <p class="mx-auto color-white" >Tú tienes la <span class="uppercase text-xl font-bold">fortuna</span> de verlo en su totalidad</p>
                    <p class="mx-auto color-white" >Hoy comienza un viaje donde cada kilómetro es una oportunidad</p>
                </div>
            </div>
        </div>
    </section>
    <section class="about-section py-1" style="background-color: white;">
        <div class="container mx-auto px-4">
                {{-- SECCIÓN DE VIDEO --}}
            <div class="my-5">
                {{-- Contenedor responsive mejorado --}}
                <div class="w-full max-w-6xl mx-auto px-2 sm:px-4">
                    <div class="relative bg-black rounded-lg overflow-hidden shadow-2xl">
                        {{-- Video Player con altura mínima para móviles --}}
                        <div class="relative w-full"
                             style="aspect-ratio: 16/9; min-height: 250px;"
                             x-data="{ playing: false }">
                            {{-- Thumbnail --}}
                            <div x-show="!playing" class="relative w-full h-full">
                                <img src="{{ asset('frontend/images/videoframe_14013.png') }}"
                                     alt="Video Geely"
                                     class="w-full h-full object-cover">

                                {{-- Play Button con tamaño responsive --}}
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <button @click="playing = true"
                                            class="bg-black bg-opacity-50 rounded-full p-4 sm:p-6 hover:bg-opacity-70 transition-all transform hover:scale-110 active:scale-95">
                                        {{-- Icono más grande en móviles --}}
                                        <svg class="w-12 h-12 sm:w-16 sm:h-16 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </button>
                                </div>

                                {{-- Duration Badge responsive --}}
                                <div class="absolute bottom-2 right-2 sm:bottom-4 sm:right-4 bg-black bg-opacity-75 text-white px-2 py-1 sm:px-3 sm:py-2 rounded text-xs sm:text-sm font-medium">
                                    2:55
                                </div>
                            </div>

                            {{-- YouTube iframe --}}
                            <div x-show="playing" x-transition class="w-full h-full">
                                <iframe x-show="playing"
                                        src="https://www.youtube.com/embed/OilbZ1cg28c?si=ZWwugDn6WrUjBLl_?autoplay=1&rel=0&modestbranding=1"
                                        class="w-full h-full border-0"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen
                                        referrerpolicy="strict-origin-when-cross-origin">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                {{-- SECCIÓN DE TEXTO CON FONDO BLANCO Y BOTÓN --}}
                <div class="bg-white py-5 px-8 rounded-lg mt-5">
                    <div class="max-w-3xl mx-auto text-center">
                        <p class="text-gray-600 text-lg mb-4 italic">
                            Nacimos con el deseo de descubrir,<br>
                            de abrir la mirada y vivir la vida completa.<br>
                            En <span class="font-bold text-[#3B4C39]">Geely</span> ponemos a las personas primero,<br>
                            porque la vida no se mira a medias... se mira entera
                        </p>

                        <h3 class="text-2xl font-bold text-gray-800 mb-6 italic">
                            SEE THE WORLD IN FULL
                        </h3>

                        <p class="text-gray-700 text-lg mb-10">
                            Descubre cómo Geely está transformando la manera de ver<br>
                            y vivir el mundo
                        </p>

                        {{-- Botón --}}
                        <div>
                            <a href="/"
                               class="inline-block bg-black text-white px-8 py-4 text-lg font-bold uppercase tracking-wider hover:bg-gray-800 transition-colors duration-300">
                                EXPLORA AQUÍ
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
