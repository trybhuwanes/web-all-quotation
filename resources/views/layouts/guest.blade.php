<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />

    <title>
        @hasSection('title')
            @yield('title') -
        @endif
        {{ config('app.name', 'Grinviro') }}
    </title>

    <!-- SEO -->
    <meta name="description" content="Guna Hijau Inovasi perusahaan manufaktur yang berfokus pada pengembangan dan produksi peralatan canggih untuk Water, Waste, Air, and Energy">
    <meta name="keywords" content="Grinviro Global Exhibition">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:title" content="Guna Hijau Inovasi" />
    <meta property="og:description" content="Guna Hijau Inovasi perusahaan manufaktur yang berfokus pada pengembangan dan produksi peralatan canggih untuk Water, Waste, Air, and Energy" />
    <meta property="og:image" content="https://grinviro-global.com/images/logo/thumbnail.jpg" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Guna Hijau Inovasi" />
    <meta name="twitter:description" content="Guna Hijau Inovasi perusahaan manufaktur yang berfokus pada pengembangan dan produksi peralatan canggih untuk Water, Waste, Air, and Energy" />
    <meta name="twitter:image" content="https://grinviro-global.com/images/logo/thumbnail.jpg" />

    <!-- Favicon -->
    <link rel="icon" href="{{ url('/images/favicon.ico') }}" type="image/x-icon" />
    <!--begin::Asset header-->
    @include('layouts._assets-header')
    <!--end::Asset header-->

    <!-- Fonts (preconnect + preload) -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700;900&display=swap" rel="stylesheet"> --}}

    <!-- Vite CSS & JS -->
    @vite(['resources/js/app.js'])

    

    <!-- Google Tag Manager -->
    <script async src="https://www.googletagmanager.com/gtm.js?id=GTM-TM4GLWSG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' });
    </script>
    <!-- End Google Tag Manager -->
</head>

<body id="kt_body" class="h-full bg-gray-50" data-theme="light">

    
    <!-- Theme Mode Setup -->
    <script>
        (() => {
            let themeMode = localStorage.getItem("data-theme") || "light";
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        })();
    </script>

    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TM4GLWSG"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- App Root -->
    <div id="kt_app_root" class="min-h-screen flex flex-col">
        {{ $slot }}
    </div>

    <!--begin::Asset footer-->
    @include('layouts._assets-footer')
    <!--end::Asset footer-->

    <!-- Custom per-page script -->
    @stack('js')
</body>
</html>
