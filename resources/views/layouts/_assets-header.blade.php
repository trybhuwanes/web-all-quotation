<title>
@if (isset($title))
    {{ $title }} -
@endif
{{ config('app.name', 'Grinviro') }}
</title>
<!-- Primary Meta Tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
<meta name="title" content="Guna Hijau Inovasi" />
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta name="description" content="Guna Hijau Inovasi perusahaan manufaktur yang berfokus pada pengembangan dan produksi peralatan canggih untuk Water, Waste, Air, and Energy"/>
<meta name="keywords" content="Grinviro Global Exhibition" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ url('/images/favicon.ico') }}" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://gunahijauinovasi.com/" />
<meta property="og:title" content="Guna Hijau Inovasi" />
<meta property="og:description" content="Guna Hijau Inovasi perusahaan manufaktur yang berfokus pada pengembangan dan produksi peralatan canggih untuk Water, Waste, Air, and Energy" />
<meta property="og:image" content="https://grinviro-global.com/iamges/logo/thumbnail.jpg" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="https://nandangpy.github.io/" />
<meta property="twitter:title" content="Guna Hijau Inovasi" />
<meta property="twitter:description" content="Guna Hijau Inovasi perusahaan manufaktur yang berfokus pada pengembangan dan produksi peralatan canggih untuk Water, Waste, Air, and Energy" />
<meta property="twitter:image" content="https://grinviro-global.com/iamges/logo/thumbnail.jpg" />

<!--begin::Fonts-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
<!--end::Fonts-->

<!--begin::Global Stylesheets Bundle-->
<link href="{{ url('template/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('template/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('template/assets/css/pagination-js-2.5.0/pagination.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('template/assets/css/GrinviroCSS.css') }}" rel="stylesheet" type="text/css" />
<!--end::Global Stylesheets Bundle-->
<style>
    .minimized{
        display: none;
    }
</style>
