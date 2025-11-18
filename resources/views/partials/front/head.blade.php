<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? 'Riddara Bolivia' }}</title>


<link rel="icon" type="image/png" href="/favicon-96x96.png?v=3" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="/favicon.svg?v=3" />
<link rel="shortcut icon" href="/favicon.ico?v=3" />
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=3" />
<link rel="manifest" href="/site.webmanifest?v=3" />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/carousel-3d.css') }}">
@stack('styles')

@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
