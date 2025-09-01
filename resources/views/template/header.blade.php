<head>
    <link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;subset=latin-ext" rel="stylesheet" >
    <link rel="stylesheet" href="{{ asset('frond-end/fonts/Linearicons/Linearicons/Font/demo-files/demo.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/assets/owl.carousel.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('plugins/slick/slick/slick.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('frond-end/plugins/lightGallery-master/dist/css/lightgallery.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('frond-end/css/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frond-end/css/all.css') }}">
    @vite(['resources/js/app.js'])
    {{-- <link rel="shortcut icon" href="{{ asset('img/').'/'.$logo_ico }}" /> --}}
    @stack('head')
  </head>
