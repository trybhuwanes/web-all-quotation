<x-guest-layout>
    <!--begin::Header-->
    @include('layouts.guest.header')
    <!--end::Header-->

    <div id="loading-screen">
        <img loading="lazy" src="{{ url('/images/icon-grinviro-global.ico') }}" alt="grinviro-company" />
    </div>
      
    <!--begin::Banner-->
    <div id="kt_app_hero" class="app-hero  app-hero-home ">
        <!--begin::Hero container-->
        <div id="kt_app_hero_container" class="w-100">
            <!--begin::Hero wrapper-->
            <div class="app-hero-wrapper d-flex align-items-stretch py-0">
                <!--begin::Hero container-->
                <div class="d-flex flex-column justify-content-center w-100">
                    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                        <!-- Indicators -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                        </div>

                        <!-- Slides -->
                        <div class="carousel-inner">
                            <!-- Slide 1 -->
                            <div class="carousel-item active">
                                <img src="{{ url('/images/guna-hijau-inovasi-project.webp') }}" class="d-block w-100 img-fluid" alt="Banner 1">
                                <div class="carousel-caption">
                                    <h1 class="text-white fw-bold">{{__('Guna Hijau Inovasi')}}</h1>
                                    <p class="text-white fs-2">{{__('Teknologi inovatif untuk pengelolaan air, limbah, dan energi.')}}</p>
                                    <a href="{{ route('product-overview.index')}}" class="btn btn-ghi fw-bolder mt-3 px-4 py-2" aria-label="View Product" rel="noopener noreferrer"> 
                                        {{ __('Produk') }}
                                    </a>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div class="carousel-item">
                                <img src="{{ url('/images/guna-hijau-inovasi-staff-ahli.webp') }}" class="d-block w-100 img-fluid" alt="Banner 2">
                                <div class="carousel-caption">
                                    <h1 class="text-white fw-bolder">{{__('Solusi Terintegrasi')}}</h1>
                                    <p class="text-white fs-2">{{__('Menghadirkan desain yang optimal untuk efisiensi.')}}</p>
                                    <a href="#how-it-works" class="btn btn-light fw-bolder mt-3 px-4 py-2" aria-label="View Product" rel="noopener noreferrer">Pelajari Lebih Lanjut</a>
                                </div>
                            </div>
                            <!-- Slide 3 -->
                            <div class="carousel-item">
                                <img src="{{ url('/images/guna-hijau-inovasi-product.webp') }}" class="d-block w-100 img-fluid" alt="Banner 3">
                                <div class="carousel-caption">
                                    <h1 class="text-white fw-bolder">{{__('Tim Profesional')}}</h1>
                                    <p class="text-white fs-2">{{__('Dipercayakan para ahli di bidang pengelolaan limbah.')}}</p>
                                    <a href="{{ route('about-us')}}" class="btn btn-ghi fw-bolder mt-3 px-4 py-2" aria-label="View Product" rel="noopener noreferrer">Hubungi Kami</a>
                                </div>
                            </div>
                        </div>

                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
            <!--end::Hero wrapper-->
        </div>



    </div>
    <!--end::Banner-->
    
    <!--begin::Industry Category-->
    <section class="mt-20">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Heading-->
            <div class="text-center mb-17">
                <!--begin::Title-->
                <h2 class="fs-2hx text-gray-900 mb-2" id="how-it-works" data-kt-scroll-offset="{default: 100, lg: 150}">
                    {{ __('Kategori Industri') }}
                </h2>
                <!--end::Title-->

                <!--begin::Text-->
                <p class="fs-5 text-gray-800">
                    Produk kami dirancang untuk mendukung beragam kebutuhan di berbagai bidang industri<br>
                    Dari manufaktur hingga pengolahan air, temukan bagaimana produk kami berkontribusi
                </p>
                <!--end::Text-->
            </div>
            <!--end::Heading-->
            
        </div>
        <!--end::Container-->
            <div class="row g-0">
                <!--begin::Col-->
                <div class="col-md-2">
                    <!--begin::Card-->
                    <div class="card-xl-stretch">
                        <a class="d-block overlay mb-4" href="{{ route('product.industry', 'mining') }}">
                            <!--begin::Image-->
                            <div class="overlay-wrapper position-relative flex-center h-250px h-lg-250px">
                                <img loading="lazy" src="{{ url('/industry/mining.webp') }}" alt="Mining Petroleum Industry" width="270" height="250" class="img-fluid w-100 h-100 object-fit-cover">
                            </div>
                            <!--end::Image-->
                        
                            <!--begin::Action-->
                            <div class="overlay-layer bg-dark bg-opacity-75 d-flex flex-column align-items-center justify-content-center text-center">
                                <h3 class="text-white fs-5 mb-2">Mining & Petroleum Industry</h3>
                            </div>
                            <!--end::Action-->
                        </a>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-2">
                    <!--begin::Card-->
                    <div class="card-xl-stretch">
                        <a class="d-block overlay mb-4" href="{{ route('product.industry', 'foodandbeverange') }}">
                            <!--begin::Image-->
                            <div class="overlay-wrapper position-relative flex-center h-250px h-lg-250px">
                                <img loading="lazy" src="{{ url('/industry/food-and-beverage.webp') }}" alt="Food Beverages and Dairy Industry" width="270" height="250" class="img-fluid w-100 h-100 object-fit-cover">
                            </div>
                            <!--end::Image-->
                        
                            <!--begin::Action-->
                            <div class="overlay-layer bg-dark bg-opacity-75 d-flex flex-column align-items-center  justify-content-center text-center">
                                <h3 class="text-white fs-5 mb-2">Food, Beverages and Dairy Industry</h3>
                            </div>
                            <!--end::Action-->
                        </a>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-2">
                    <!--begin::Card-->
                    <div class="card-xl-stretch">
                        <a class="d-block overlay mb-4" href="{{ route('product.industry', 'agroindustry') }}">
                            <!--begin::Image-->
                            <div class="overlay-wrapper position-relative flex-center h-250px h-lg-250px">
                                <img loading="lazy" src="{{ url('/industry/agrikultur-industry.webp') }}" alt="AgroindustryIndustry" width="270" height="250" class="img-fluid w-100 h-100 object-fit-cover">
                            </div>
                            <!--end::Image-->
                        
                            <!--begin::Action-->
                            <div class="overlay-layer bg-dark bg-opacity-75 d-flex flex-column align-items-center justify-content-center text-center">
                                <h3 class="text-white fs-5 mb-2">Agroindustry</h3>
                            </div>
                            <!--end::Action-->
                        </a>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-2">
                    <!--begin::Card-->
                    <div class="card-xl-stretch">
                        <a class="d-block overlay mb-4" href="{{ route('product.industry', 'palmoil') }}">
                            <!--begin::Image-->
                            <div class="overlay-wrapper position-relative flex-center h-250px h-lg-250px">
                                <img loading="lazy" src="{{ url('/industry/palm-oil.webp') }}" alt="Tim Profesional" width="270" height="250" class="img-fluid w-100 h-100 object-fit-cover">
                            </div>
                            <!--end::Image-->
                        
                            <!--begin::Action-->
                            <div class="overlay-layer bg-dark bg-opacity-75 d-flex flex-column align-items-center justify-content-center text-center">
                                <h3 class="text-white fs-5 mb-2">Palm Oil & Derivatives Industry</h3>
                            </div>
                            <!--end::Action-->
                        </a>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-2">
                    <!--begin::Card-->
                    <div class="card-xl-stretch">
                        <a class="d-block overlay mb-4" href="{{ route('product.industry', 'textile') }}">
                            <!--begin::Image-->
                            <div class="overlay-wrapper position-relative flex-center h-250px h-lg-250px">
                                <img loading="lazy" src="{{ url('/industry/sugar.webp') }}" alt="Textile Pulp and Paper Industry" width="270" height="250" class="img-fluid w-100 h-100 object-fit-cover">
                            </div>
                            <!--end::Image-->
                        
                            <!--begin::Action-->
                            <div class="overlay-layer bg-dark bg-opacity-75 d-flex flex-column align-items-center justify-content-center text-center">
                                <h3 class="text-white fs-5 mb-2">Textile, Pulp & Paper Industry</h3>
                            </div>
                            <!--end::Action-->
                        </a>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-2">
                    <!--begin::Card-->
                    <div class="card-xl-stretch">
                        <a class="d-block overlay mb-4" href="{{ route('product.industry', 'hospitality') }}">
                            <!--begin::Image-->
                            <div class="overlay-wrapper position-relative flex-center h-250px h-lg-250px">
                                <img loading="lazy" src="{{ url('/industry/hospitality.webp') }}" 
                                    alt="Hospitality and Real Estate" 
                                    width="270" height="250"
                                    class="img-fluid w-100 h-100 object-fit-cover">
                            </div>
                            <!--end::Image-->
                        
                            <!--begin::Action-->
                            <div class="overlay-layer bg-dark bg-opacity-75 d-flex flex-column align-items-center justify-content-center text-center">
                                <h3 class="text-white fs-5 mb-2">Hospitality & Real Estate</h3>
                            </div>
                            <!--end::Action-->
                        </a>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
            </div>
    </section>
    <!--end::Industry Category-->


    <!--begin::Best Product-->
    <section class="mt-20">
        <div class="mt-sm-n10">
            <!--begin::Curve top-->
            <div class="landing-curve landing-dark-color">
                <svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z"
                        fill="currentColor">
                    </path>
                </svg>
            </div>
            <!--end::Curve top-->

            <!--begin::Wrapper-->
            <div class="pb-15 pt-18 landing-dark-bg">
                <!--begin::Container-->
                <div class="container d-flex flex-column justify-content-center align-items-center pt-lg-20">
                    <!--begin::Plans-->
                    <div class="d-flex flex-column container">
                        <!--begin::Heading-->
                        <div class="mb-10 text-center">
                            <h2 class="fs-2hx fw-bold text-white mb-2" id="pricing"
                                data-kt-scroll-offset="{default: 100, lg: 150}">{{ __('Produk Unggulan Kami') }}
                            </h2>
                            <p class="text-gray-400 fs-5">
                                {{ __('Temukan produk terbaik kami, sesuai kebutuhan Anda') }}
                            </p>
                        </div>
                        <!--end::Heading-->

                        <!--begin::Product Section-->
                        <div class="text-center" id="kt_products">
                            <!--begin::Row-->
                            <div class="row g-10 justify-content-center">
                                @foreach ($products as $item)
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="d-flex h-100 align-items-center">
                                        <!--begin::Card-->
                                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-6 px-4">
                                            <!--begin::Image-->
                                            <div class="mb-7 text-center">
                                                <img loading="lazy" src="{{ $item->getFirstMediaUrl('product-thumbnail') }}" 
                                                    alt="Product Grinviro"
                                                    width="264" height="264"
                                                    class="img-fluid" 
                                                    style="max-width: 100%; height: auto; border-radius: 10px;">
                                            </div>
                                            <!--end::Image-->

                                            <!--begin::Title-->
                                            <div class="text-center">
                                                <h2 class="text-gray-900 mb-5 fw-boldest">{{ $item->nama_produk}}</h2>
                                            </div>
                                            <!--end::Title-->

                                            <!--begin::Button-->
                                            <a href="{{ route('product-overview.detail', $item->slug) }}" class="btn btn-ghi px-10">Lihat
                                                Produk</a>
                                            <!--end::Button-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                @endforeach
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Product Section-->
                    </div>
                    <!--end::Plans-->
                </div>
                <!--end::Container-->

            </div>
            <!--end::Wrapper-->

            <!--begin::Curve bottom-->
            <div class="landing-curve landing-dark-color ">
                <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z"
                        fill="currentColor"></path>
                </svg>
            </div>
            <!--end::Curve bottom-->
        </div>
    </section>
    <!--end::Best Product-->

    <!--begin::Video Product-->
    <section class="mt-5">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Heading-->
            <div class="text-center mb-17">
                <!--begin::Title-->
                <h2 class="fs-2hx text-gray-900 mb-2" id="how-it-works" data-kt-scroll-offset="{default: 100, lg: 150}">
                    {{ __('Video Produk') }}
                </h2>
                <!--end::Title-->

                <!--begin::Text-->
                <p class="fs-5 text-gray-800">
                    {{ __('Solusi visual untuk memahami produk kami dengan mudah') }} <br>
                    {{ __('Tonton Video demonstrasi untuk membantu Anda mengenal produk kami lebih baik') }}
                </p>
                <!--end::Text-->
            </div>
            <!--end::Heading-->

            <!--begin::Row with Videos-->
            <div class="row g-5">
                <!--begin::Column 1-->
                <div class="col-md-6">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/dCAeZtfD9CM?si=JzqYGDXEFCH4VXCr" 
                                title="YouTube video player" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen loading="lazy">
                        </iframe>
                    </div>
                </div>
                <!--end::Column 1-->

                <!--begin::Column 2-->
                <div class="col-md-6">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/4LOZKbTLLVI?si=0E2yQXxChlDjRQbR" 
                                title="YouTube video player" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen loading="lazy">
                        </iframe>
                    </div>
                </div>
                <!--end::Column 2-->
            </div>
            <!--end::Row with Videos-->
        </div>
        <!--end::Container-->
    </section>
    <!--end::Video Product-->


    <!--begin::Projects Section-->
    <section class="mt-5">
        <div class="position-relative z-index-2">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card" style="filter: drop-shadow(0px 0px 40px rgba(68, 81, 96, 0.08))">
                    <!--begin::Card body-->
                    <div class="card-body p-lg-20">
                        <!--begin::Heading-->
                        <div class="text-center mb-5 mb-lg-10">
                            <!--begin::Title-->
                            <h2 class="fs-2hx text-gray-900 mb-2" id="portfolio"
                                data-kt-scroll-offset="{default: 100, lg: 250}">{{ __('Proyek Kami') }}
                            </h2>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
    
                        <!--begin::Tabs wrapper-->
                        <div class="d-flex flex-center mb-lg-5">
                            <!--begin::Tabs-->
                            <ul class="nav border-transparent flex-center fs-5 fw-bold">
                                <li class="nav-item">
                                    <a class="nav-link text-gray-500 text-active-primary px-3 px-lg-6 active"
                                        href="#" data-bs-toggle="tab"
                                        data-bs-target="#kt_landing_projects_latest">{{ __('FLOWREX Surface Aerator') }}</a>
                                </li>
    
                                <li class="nav-item">
                                    <a class="nav-link text-gray-500 text-active-primary px-3 px-lg-6" href="#"
                                        data-bs-toggle="tab" data-bs-target="#kt_landing_projects_web_design">{{ __('FLOWREX Screw Press') }}</a>
                                </li>
    
                                <li class="nav-item">
                                    <a class="nav-link text-gray-500 text-active-primary px-3 px-lg-6" href="#"
                                        data-bs-toggle="tab" data-bs-target="#kt_landing_projects_mobile_apps">{{ __('SUPRAX Bolted Tank') }}</a>
                                </li>
    
                                <li class="nav-item">
                                    <a class="nav-link text-gray-500 text-active-primary px-3 px-lg-6" href="#"
                                        data-bs-toggle="tab"
                                        data-bs-target="#kt_landing_projects_development">{{ __('DIAC-X') }}</a>
                                </li>
                            </ul>
                            <!--end::Tabs-->
                        </div>
                        <!--end::Tabs wrapper-->
    
                        <!--begin::Tabs content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_landing_projects_latest">
                                <!--begin::Row-->
                                <div class="row g-10">
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Item-->
                                        <a class="d-block card-rounded overlay h-lg-100"
                                            data-fslightbox="lightbox-projects"
                                            href="https://www.youtube.com/watch?v=rTKpItuTLLk">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-lg-100 min-h-250px"
                                                style="background-image:url('{{ url('/images/project/2024/fas/fas-implementasi.webp') }}')">
                                            </div>
                                            <!--end::Image-->
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <p class="fs-2 text-white fw-bold">
                                                    {{ __('Leachate Water Treatment | FAS 307') }}
                                                </p>
                                            </div> 
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
    
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Row-->
                                        <div class="row g-10 mb-10">
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Item-->
                                                <a class="d-block card-rounded overlay"
                                                    data-fslightbox="lightbox-projects"
                                                    href="https://www.youtube.com/watch?v=zBUbuLlD7pg">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px"
                                                        style="background-image:url('{{ url('/images/project/2024/fas/fas-industrial-estate.webp') }}')">
                                                    </div>
                                                    <!--end::Image-->
    
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 text-center">
                                                        <p class="fs-2 text-white">
                                                            {{ __('Industrial Estate WWTP | FAS 310') }}
                                                        </p>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Col-->
    
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Item-->
                                                <a class="d-block card-rounded overlay"
                                                    data-fslightbox="lightbox-projects"
                                                    href="https://www.youtube.com/watch?v=9okUVkKNYZM">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px"
                                                        style="background-image:url('{{ url('/images/project/2024/fas/fas-instalasi.webp') }}')">
                                                    </div>
                                                    <!--end::Image-->
    
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 text-center">
                                                        <p class="fs-2 text-white">
                                                            {{ __('Textile Industry | FAS 310') }}
                                                        </p>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
    
                                        <!--begin::Item-->
                                        <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects"
                                            href="https://www.youtube.com/watch?v=4rvGEnZibmw">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px"
                                                style="background-image:url('{{ url('/images/project/2024/fas/fas-paper-industry.webp') }}')">
                                            </div>
                                            <!--end::Image-->
    
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 text-center">
                                                <p class="fs-2 text-white">
                                                    {{ __('Pulp & Paper Industry | FAS 315') }}
                                                </p>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Tab pane-->
    
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_landing_projects_web_design">
                                <!--begin::Row-->
                                <div class="row g-10">
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Item-->
                                        <a class="d-block card-rounded overlay h-lg-100"
                                            data-fslightbox="lightbox-projects"
                                            href="https://www.youtube.com/watch?v=VwFfSned5dE">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-lg-100 min-h-250px"
                                                style="background-image:url('{{ url('/images/project/2024/mps/mps-termurah.webp') }}')">
                                            </div>
                                            <!--end::Image-->
    
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 text-center">
                                                <p class="fs-2 text-white fw-bold">
                                                    {{ __('Chocolate Industry | FMP 203') }}
                                                </p>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
    
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Row-->
                                        <div class="row g-10 mb-10">
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Item-->
                                                <a class="d-block card-rounded overlay"
                                                    data-fslightbox="lightbox-projects"
                                                    href="https://www.youtube.com/watch?v=nP3XDn-cH00">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px"
                                                        style="background-image:url('{{ url('/images/project/2024/mps/mps-pharmacy.webp') }}')">
                                                    </div>
                                                    <!--end::Image-->
    
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 text-center">
                                                        <p class="fs-2 text-white">
                                                            {{ __('Pharmacy Industry | FMP 132') }}
                                                        </p>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Col-->
    
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Item-->
                                                <a class="d-block card-rounded overlay"
                                                    data-fslightbox="lightbox-projects"
                                                    href="https://www.youtube.com/watch?v=TTU152_CxDg">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px"
                                                        style="background-image:url('{{ url('/images/project/2024/mps/mps-b3.webp') }}')">
                                                    </div>
                                                    <!--end::Image-->
    
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 text-center">
                                                        <p class="fs-2 text-white">
                                                            {{ __('B3 Waste Management | FMP 402') }}
                                                        </p>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
    
                                        <!--begin::Item-->
                                        <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects"
                                            href="https://www.youtube.com/watch?v=FHztTzABPhU">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px"
                                                style="background-image:url('{{ url('/images/project/2024/mps/mps-seafood.webp') }}')">
                                            </div>
                                            <!--end::Image-->
    
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 text-center">
                                                <p class="fs-2 text-white">
                                                    {{ __('Seafood Industry | FMP 303') }}
                                                </p>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Tab pane-->
    
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_landing_projects_mobile_apps">
                                <!--begin::Row-->
                                <div class="row g-10">
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Row-->
                                        <div class="row g-10 mb-10">
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Item-->
                                                <a class="d-block card-rounded overlay"
                                                    data-fslightbox="lightbox-projects"
                                                    href="https://www.youtube.com/watch?v=dCAeZtfD9CM">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px"
                                                        style="background-image:url('{{ url('/images/project/2024/bolted-tank/tank-industrial-esatate.webp') }}')">
                                                    </div>
                                                    <!--end::Image-->
    
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 text-center">
                                                        <p class="fs-2 text-white">
                                                            {{ __('Industrial Estate | Reservoir Tank 300 CMD') }}
                                                        </p>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Col-->
    
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Item-->
                                                <a class="d-block card-rounded overlay"
                                                    data-fslightbox="lightbox-projects"
                                                    href="https://www.youtube.com/watch?v=d5sujfQ1hmg">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px"
                                                        style="background-image:url('{{ url('/images/project/2024/bolted-tank/tank-sugar-industry.webp') }}')">
                                                    </div>
                                                    <!--end::Image-->
    
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 text-center">
                                                        <p class="fs-2 text-white">
                                                            {{ __('Sugar Industry | WWTP 1000 CMD') }}
                                                        </p>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
    
                                        <!--begin::Item-->
                                        <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects"
                                            href="https://www.youtube.com/watch?v=R2P1GTVjx9U">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px"
                                                style="background-image:url('{{ url('/images/project/2024/bolted-tank/tank-cigarrete.webp') }}')">
                                            </div>
                                            <!--end::Image-->
    
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 text-center">
                                                <p class="fs-2 text-white">
                                                    {{ __('Cigarette Industry | WWTP 600 CMD') }}
                                                </p>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
    
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Item-->
                                        <a class="d-block card-rounded overlay h-lg-100"
                                            data-fslightbox="lightbox-projects"
                                            href="https://www.youtube.com/watch?v=clI7nyFVVq0">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-lg-100 min-h-250px"
                                                style="background-image:url('{{ url('/images/project/2024/bolted-tank/tank-palm-oil.webp') }}')">
                                            </div>
                                            <!--end::Image-->
    
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <p class="fs-2 text-white fw-bold">
                                                    {{ __('Palm Oil Refinery Industry | WWTP 588 CMD') }}
                                                </p>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Tab pane-->
    
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_landing_projects_development">
                                <!--begin::Row-->
                                <div class="row g-10">
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Item-->
                                        <a class="d-block card-rounded overlay h-lg-100"
                                            data-fslightbox="lightbox-projects"
                                            href="https://www.youtube.com/watch?v=5XcDELOY6j0">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-lg-100 min-h-250px"
                                                style="background-image:url('{{ url('/images/project/2024/diac/diac-x-terbaik.webp') }}')">
                                            </div>
                                            <!--end::Image-->
    
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <p class="fs-2 text-white fw-bold">
                                                    {{ __('DIAC-X') }}
                                                </p>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
    
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Row-->
                                        <div class="row g-10 mb-10">
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Item-->
                                                <a class="d-block card-rounded overlay"
                                                    data-fslightbox="lightbox-projects"
                                                    href="https://www.youtube.com/watch?v=5XcDELOY6j0">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px"
                                                        style="background-image:url('{{ url('/images/project/2024/diac/diac-ai.webp') }}')">
                                                    </div>
                                                    <!--end::Image-->
    
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <p class="fs-2 text-white">
                                                            {{ __('DIAC-X') }}
                                                        </p>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Col-->
    
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Item-->
                                                <a class="d-block card-rounded overlay"
                                                    data-fslightbox="lightbox-projects"
                                                    href="https://www.youtube.com/watch?v=5XcDELOY6j0">
                                                    <!--begin::Image-->
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px"
                                                        style="background-image:url('{{ url('/images/project/2024/diac/diac-kualitas-terbaik.webp') }}')">
                                                    </div>
                                                    <!--end::Image-->
    
                                                    <!--begin::Action-->
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <p class="fs-2 text-white">
                                                            {{ __('DIAC-X') }}
                                                        </p>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
    
                                        <!--begin::Item-->
                                        <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects"
                                            href="https://www.youtube.com/watch?v=5XcDELOY6j0">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px"
                                                style="background-image:url('{{ url('/images/project/2024/diac/diac-monitoring-limbah.webp') }}')">
                                            </div>
                                            <!--end::Image-->
    
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <p class="fs-2 text-white">
                                                    {{ __('DIAC-X') }}
                                                </p>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Tab pane-->
                        </div>
                        <!--end::Tabs content-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
    </section>
    <!--end::Projects Section-->


    

    <!--begin::Testimonials Section-->
    <section class="mt-5">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Heading-->
            <div class="text-center mb-17">
                <!--begin::Title-->
                <h2 class="fs-2hx text-gray-900 mb-2" id="how-it-works" data-kt-scroll-offset="{default: 100, lg: 150}">
                    {{ __('Apa Kata Pelanggan Kami') }}</h2>
                <!--end::Title-->
    
                <!--begin::Text-->
                <p class="fs-5 text-gray-800">
                    {{ __('Kepercayaan mereka adalah inspirasi kami untuk terus melayani lebih baik') }}
                </p>
                <!--end::Text-->
            </div>
            <!--end::Heading-->
    
            <div class="row">
                <!--begin::Videos-->
                <!--begin::Column 1-->
                <div class="col-md-4 mb-5">
                    <div class="ratio ratio-16x9 rounded border">
                        <iframe src="https://www.youtube.com/embed/64bKehgi14M?si=acshjvnCKuMMZTSI" title="YouTube video" class="rounded" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
                <!--end::Column 1-->
                <!--end::Videos-->
    
                <!--begin::Column 2-->
                <div class="col-md-8 mb-5">
                    <!--begin::Slider-->
                    <div class="tns tns-default" style="direction: ltr">
                        <!--begin::Wrapper-->
                        <div data-tns="true" 
                                data-tns-loop="true" 
                                data-tns-swipe-angle="false" 
                                data-tns-speed="10000" 
                                data-tns-autoplay="true" 
                                data-tns-autoplay-timeout="5000" 
                                data-tns-controls="true" 
                                data-tns-nav="false" 
                                data-tns-items="1" 
                                data-tns-center="false" 
                                data-tns-dots="true" 
                                data-tns-prev-button="#kt_team_slider_prev" 
                                data-tns-next-button="#kt_team_slider_next" 
                                data-tns-responsive="{1200: {items: 2}, 992: {items: 2}}">

                            <!--begin::Item-->
                            <div class="m-1">
                                <!--begin::Testimonial-->
                                <div class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                                    <!--begin::Wrapper-->
                                    <div class="mb-7">
                                        <!--begin::Title-->
                                        <div class="fs-4 fw-bold text-gray-900 mb-3">
                                            {{__('Chocolate Industry')}}
                                        </div>
                                        <!--end::Title-->

                                        <!--begin::Rating-->
                                        <div class="rating mb-2">
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                        </div>
                                        <!--end::Rating-->

                                        <!--begin::Feedback-->
                                        <div class="fs-7">
                                            Layanan luar biasa dan kualitas produk yang sangat baik! Tim Guna Hijau Inovasi benar-benar memahami kebutuhan kami dan memberikan solusi tepat waktu yang efisien. Proyek kami berjalan lancar berkat teknologi canggih mereka. Sangat direkomendasikan!    
                                        </div>
                                        <!--end::Feedback-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Testimonial-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="m-1">
                                <!--begin::Testimonial-->
                                <div class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                                    <!--begin::Wrapper-->
                                    <div class="mb-7">
                                        <!--begin::Title-->
                                        <div class="fs-4 fw-bold text-gray-900 mb-3">
                                            {{__('Government')}}
                                        </div>
                                        <!--end::Title-->

                                        <!--begin::Rating-->
                                        <div class="rating mb-2">
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                        </div>
                                        <!--end::Rating-->

                                        <!--begin::Feedback-->
                                        <div class="fs-7">
                                            Kami sangat puas dengan hasil kerja Guna Hijau Inovasi. Mulai dari konsultasi hingga commissioning, semuanya dilakukan secara profesional. Produk mereka andal, hemat energi, dan sesuai standar. Kami akan bekerja sama lagi untuk proyek berikutnya!    
                                        </div>
                                        <!--end::Feedback-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Testimonial-->
                            </div>
                            <!--end::Item-->
                            

                            <!--begin::Item-->
                            <div class="m-1">
                                <!--begin::Testimonial-->
                                <div class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                                    <!--begin::Wrapper-->
                                    <div class="mb-7">
                                        <!--begin::Title-->
                                        <div class="fs-4 fw-bold text-gray-900 mb-3">
                                            {{__('Industrial Real Estate')}}
                                        </div>
                                        <!--end::Title-->

                                        <!--begin::Rating-->
                                        <div class="rating mb-2">
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                        </div>
                                        <!--end::Rating-->

                                        <!--begin::Feedback-->
                                        <div class="fs-7">
                                            Pelayanan dan produk yang memuaskan. Meskipun ada sedikit keterlambatan dalam pengiriman, tim mereka segera mengatasinya dengan solusi yang cepat. Kualitas peralatan sangat baik dan berfungsi optimal di lapangan. Kami menghargai kerja keras mereka!
                                        </div>
                                        <!--end::Feedback-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Testimonial-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="m-1">
                                <!--begin::Testimonial-->
                                <div class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                                    <!--begin::Wrapper-->
                                    <div class="mb-7">
                                        <!--begin::Title-->
                                        <div class="fs-4 fw-bold text-gray-900 mb-3">
                                            {{__('Textile Industry')}}
                                        </div>
                                        <!--end::Title-->

                                        <!--begin::Rating-->
                                        <div class="rating mb-2">
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2">
                                                <i class="ki-duotone ki-star fs-5"></i>
                                            </div>
                                        </div>
                                        <!--end::Rating-->

                                        <!--begin::Feedback-->
                                        <div class="fs-7">
                                            Tim yang profesional dan responsif. Teknologi yang ditawarkan sangat inovatif dan efisien. Ada beberapa perbaikan kecil yang perlu dilakukan di awal, tetapi mereka segera menanganinya. Secara keseluruhan, pengalaman kami positif!
                                        </div>
                                        <!--end::Feedback-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Testimonial-->
                            </div>
                            <!--end::Item-->

                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Button-->
                        <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev">
                            <i class="ki-duotone ki-left fs-2x"></i> </button>
                        <!--end::Button-->

                        <!--begin::Button-->
                        <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next">
                            <i class="ki-duotone ki-right fs-2x"></i> </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Slider-->
                </div>
                <!--end::Column 2-->
            </div>
            
            <hr>
        </div>
        <!--end::Container-->
    </section>
    <!--end::Testimonials Section-->

    

    
    <!--begin::Update-->
    <div class="mt-20 mb-n20 position-relative z-index-2">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Heading-->
            <div class="text-center mb-17">
                <!--begin::Title-->
                <h2 class="fs-2hx text-gray-900 mb-2" id="clients" data-kt-scroll-offset="{default: 125, lg: 150}">
                    {{ __('Update') }}
                </h2>
                <!--end::Title-->

                <!--begin::Description-->
                <p class="fs-5 text-gray-800">
                    {{ __('Produk dan inovasi teknologi terbaru perlu Anda ketahui') }}
                </p>
                <!--end::Description-->
            </div>
            <!--end::Heading-->

            <!--begin::Row-->
            <div class="row g-lg-10 mb-10 mb-lg-20 text-center">
                <!--begin::Col-->
                <div class="col-md-3">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Overlay-->
                        <a class="d-block overlay mb-4" href="https://grinviro-global.com/articles/category/flowrex-surface-aerator/" title="Baca artikel tentang FAS dari Grinviro">
                            <!--begin::Image-->
                            <div class="overlay-wrapper position-relative card-rounded flex-center h-300px h-lg-350px  shadow">
                                <img loading="lazy" src="{{ url('/update/fas-surface-aerator-berkualitas.webp') }}"  alt="Tim Profesional" class="img-fluid w-100 h-100 object-fit-cover card-rounded">
                            </div>
                            <!--end::Image-->
                        
                            <!--begin::Action-->
                            <div class="overlay-layer card-rounded bg-dark bg-opacity-75 d-flex flex-column align-items-center justify-content-center text-center  shadow">
                                <h2 class="text-white fs-4 fw-bold mb-2">{{ __('FAS') }}</h2>
                                <p class="text-white fs-7">{{ __('Floating Aerator Surface') }}</p>
                            </div>
                            <!--end::Action-->
                        </a>
                        <!--end::Overlay-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
                
                <!--begin::Col-->
                <div class="col-md-3">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Overlay-->
                        <a class="d-block overlay mb-4" href="https://grinviro-global.com/articles/category/flowrex-screw-press/" title="Baca artikel tentang MPS dari Grinviro">
                            <!--begin::Image-->
                            <div class="overlay-wrapper position-relative card-rounded flex-center h-300px h-lg-350px">
                                <img loading="lazy" src="{{ url('/update/flowrex-grinviro-indonesia.webp') }}" alt="Tim Profesional" class="img-fluid w-100 h-100 object-fit-cover card-rounded">
                            </div>
                            <!--end::Image-->
                        
                            <!--begin::Action-->
                            <div class="overlay-layer card-rounded bg-dark bg-opacity-75 d-flex flex-column align-items-center justify-content-center text-center">
                                <h2 class="text-white fs-4 fw-bold mb-2">{{ __('MPS') }}</h2>
                                <p class="text-white fs-7">{{ __('Multi Press Screw Press') }}</p>
                            </div>
                            <!--end::Action-->
                        </a>
                        <!--end::Overlay-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-3">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Overlay-->
                        <a class="d-block overlay mb-4" href="https://grinviro-global.com/articles/category/suprax-tank/" title="Baca artikel tentang Bolted Tank dari Grinviro">
                            <!--begin::Image-->
                            <div class="overlay-wrapper position-relative card-rounded flex-center h-300px h-lg-350px">
                                <img loading="lazy" src="{{ url('/update/biogenic.webp') }}" alt="Tim Profesional" class="img-fluid w-100 h-100 object-fit-cover card-rounded">
                            </div>
                            <!--end::Image-->
                        
                            <!--begin::Action-->
                            <div class="overlay-layer card-rounded bg-dark bg-opacity-75 d-flex flex-column align-items-center justify-content-center text-center">
                                <h2 class="text-white fs-4 fw-bold mb-2">{{ __('Bolted Tank') }}</h2>
                                <p class="text-white fs-7">{{ __('Bolted Tank Grinviro') }}</p>
                            </div>
                            <!--end::Action-->
                        </a>
                        <!--end::Overlay-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-3">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Overlay-->
                        <a class="d-block overlay mb-4" href="https://grinviro-global.com/articles/category/diac-x/" title="Baca artikel tentang Diac dari Grinviro">
                            <!--begin::Image-->
                            <div class="overlay-wrapper position-relative card-rounded flex-center h-300px h-lg-350px">
                                <img loading="lazy" src="{{ url('/update/diac.webp') }}" alt="Tim Profesional" class="img-fluid w-100 h-100 object-fit-cover card-rounded">
                            </div>
                            <!--end::Image-->
                        
                            <!--begin::Action-->
                            <div class="overlay-layer card-rounded bg-dark bg-opacity-75 d-flex flex-column align-items-center justify-content-center text-center">
                                <h2 class="text-white fs-4 fw-bold mb-2">{{ __('DIAC') }}</h2>
                                <p class="text-white fs-7">{{ __('Data Intellegence & Alalyzing Control') }}</p>
                            </div>
                            <!--end::Action-->
                        </a>
                        <!--end::Overlay-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->

            </div>
            <!--end::Row-->


        


            <!--begin::Highlight-->
            <div class="bg-guna-hijau d-flex flex-stack flex-wrap flex-md-nowrap card-rounded shadow p-8 p-lg-12 mb-n5 mb-lg-n13">
                <!--begin::Content-->
                <div class="my-2 me-5">
                    <!--begin::Title-->
                    <div class="fs-1 fs-lg-2qx fw-bold text-white mb-2">
                        {{__('Pilih Teknologi Tepat untuk Pengolahan Berkelanjutan,')}} <br />
                        <span class="fw-normal">{{__('Dapatkan penawaran terbaik!')}}</span>
                    </div>
                    <!--end::Title-->

                    <!--begin::Description-->
                    <div class="fs-6 fs-lg-5 text-white fw-semibold opacity-75">
                        {{__('Lebih dari 100+ perusahaan menggunakan produk kami')}}
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Content-->

                <!--begin::Link-->
                <a href="{{ route('product-overview.index')}}"
                    class="btn btn-lg btn-outline border-2 btn-outline-white flex-shrink-0 my-2">Dapatkan Produk
                </a>
                <!--end::Link-->
            </div>
            <!--end::Highlight-->
            

        </div>
        <!--end::Container-->
    </div>
    <!--end::Update-->



    <!--begin::Footer-->
    @include('layouts.guest.footer')
    <!--end::Footer-->

</x-guest-layout>