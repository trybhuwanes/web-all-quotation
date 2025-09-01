<x-guest-layout>
    <!--begin::Header-->
    @include('layouts.guest.header')
    <!--end::Header-->


    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container  container-xxl">
        <section class="mt-5">
            <ol class="breadcrumb breadcrumb-dot text-muted fs-6 fw-semibold">
                <li class="breadcrumb-item"><a href="/" class="">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item text-muted">{{ __('About us') }}</li>
            </ol>
            <div class="border-gray-300 border-bottom border-bottom-dashed"></div>
        </section>
        <!--begin::About card-->
        <div class="card">
            <!--begin::Body-->
            <div class="card-body p-lg-5">
                <!--begin::About-->
                <div class="mb-18">
                    <!--begin::Wrapper-->
                    <div class="mb-10">
                        <!--begin::Top-->
                        <div class="text-center mb-15">
                            <!--begin::Title-->
                            <h1 class="fs-1 text-gray-900 mb-5">GUNA HIJAU INOVASI</h1>
                            <!--end::Title-->

                            <!--begin::Text-->
                            <h2 class="fs-5 text-muted fw-semibold">
                                Manufacturing for Water, Wastewater and Energy
                            </h2>
                            <!--end::Text-->
                        </div>
                        <!--end::Top-->

                        <!--begin::Overlay-->
                        <div class="overlay">
                            <!--begin::Image-->
                            <img class="w-100 card-rounded" src="{{ asset('/images/about/guna-hijau-inovasi-workshop.webp') }}"
                                alt="" />
                            <!--end::Image-->

                            <!--begin::Links-->
                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                <a href="{{ route('product-overview.index') }}" class="btn btn-primary">{{__('Produk')}}</a>
                            </div>
                            <!--end::Links-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Description-->
                    <div class="fs-5 fw-semibold text-gray-600">
                        <!--begin::Text-->
                        <p class="mb-8">
                            {{ __('Selamat datang di Guna Hijau Inovasi, salah satu company dari Grinviro Global. Kami adalah perusahaan manufaktur yang berfokus pada pengembangan dan produksi peralatan canggih untuk Water, Waste, Air, and Energy.') }}
                        </p>
                        <!--end::Text-->

                        <!--begin::Text-->
                        <p class="mb-8">
                            {{__('Sebagai bagian dari komitmen Grinviro Global terhadap solusi lingkungan berkelanjutan, Guna Hijau Inovasi menghadirkan teknologi inovatif, hemat energi, dan andal untuk memenuhi kebutuhan berbagai industri. Keahlian kami terletak pada perancangan dan produksi peralatan berkualitas tinggi yang memastikan kinerja optimal serta mematuhi standar lingkungan.')}}
                        </p>
                        <!--end::Text-->

                        <!--begin::Text-->
                        <p class="mb-8">
                            {{__('Di Guna Hijau Inovasi, kami berupaya menciptakan solusi yang berdampak positif untuk membantu bisnis mencapai tujuan keberlanjutannya. Dengan tim ahli yang berdedikasi dan fasilitas modern, kami memastikan setiap produk mencerminkan keunggulan dan visi dari Grinviro Global.')}}
                        </p>
                        <!--end::Text-->

                        <p class="mb-8">
                        </p>
                        <!--end::Text-->
                        
                        <!--begin::Text-->
                        <p class="mb-17">
                            {{__('Bersama perusahaan induk kami, kami berkomitmen untuk memimpin transformasi menuju masa depan yang lebih hijau. Mari berinovasi untuk keberlanjutan bersama.')}}
                            
                        </p>
                        <!--end::Text-->
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::About-->


                <!--begin::Statistics-->
                <div class="card bg-guna-hijau mb-18">
                    <!--begin::Body-->
                    <div class="card-body py-15">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-center">
                            <!--begin::Items-->
                            <div class="d-flex flex-center flex-wrap mb-10 mx-auto gap-5 w-xl-900px">
                                <!--begin::Item-->
                                <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-lg-10">
                                    <!--begin::Content-->
                                    <div class="text-center">
                                        <!--begin::Symbol-->
                                        <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/keenthemes/keen/docs/core/html/src/media/icons/duotune/abstract/abs026.svg-->
                                        <span class="svg-icon svg-icon-muted svg-icon-2hx fs-2tx text-primary"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3"
                                                    d="M7 20.5L2 17.6V11.8L7 8.90002L12 11.8V17.6L7 20.5ZM21 20.8V18.5L19 17.3L17 18.5V20.8L19 22L21 20.8Z"
                                                    fill="currentColor" />
                                                <path d="M22 14.1V6L15 2L8 6V14.1L15 18.2L22 14.1Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--end::Symbol-->

                                        <!--begin::Text-->
                                        <div class="mt-1">
                                            <!--begin::Animation-->
                                            <div class="fs-lg-2hx fs-2x fw-bold text-gray-800 d-flex align-items-center">
                                                <div class="min-w-50px" data-kt-countup="true" data-kt-countup-value="10">10</div>+
                                            </div>
                                            <!--end::Animation-->

                                            <!--begin::Label-->
                                            <span class="text-gray-600 fw-semibold fs-5 lh-0">{{__('Years Experience')}}</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-lg-10">
                                    <!--begin::Content-->
                                    <div class="text-center">
                                        <!--begin::Symbol-->
                                        <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/keenthemes/keen/docs/core/html/src/media/icons/duotune/graphs/gra010.svg-->
                                        <span class="svg-icon svg-icon-muted svg-icon-2hx fs-2tx text-success"><svg
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0021 10.9128V3.01281C13.0021 2.41281 13.5021 1.91281 14.1021 2.01281C16.1021 2.21281 17.9021 3.11284 19.3021 4.61284C20.7021 6.01284 21.6021 7.91285 21.9021 9.81285C22.0021 10.4129 21.5021 10.9128 20.9021 10.9128H13.0021Z"
                                                    fill="currentColor" />
                                                <path opacity="0.3"
                                                    d="M11.0021 13.7128V4.91283C11.0021 4.31283 10.5021 3.81283 9.90208 3.91283C5.40208 4.51283 1.90209 8.41284 2.00209 13.1128C2.10209 18.0128 6.40208 22.0128 11.3021 21.9128C13.1021 21.8128 14.7021 21.3128 16.0021 20.4128C16.5021 20.1128 16.6021 19.3128 16.1021 18.9128L11.0021 13.7128Z"
                                                    fill="currentColor" />
                                                <path opacity="0.3"
                                                    d="M21.9021 14.0128C21.7021 15.6128 21.1021 17.1128 20.1021 18.4128C19.7021 18.9128 19.0021 18.9128 18.6021 18.5128L13.0021 12.9128H20.9021C21.5021 12.9128 22.0021 13.4128 21.9021 14.0128Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--end::Symbol-->

                                        <!--begin::Text-->
                                        <div class="mt-1">
                                            <!--begin::Animation-->
                                            <div
                                                class="fs-lg-2hx fs-2x fw-bold text-gray-800 d-flex align-items-center">
                                                <div class="min-w-50px" data-kt-countup="true"
                                                    data-kt-countup-value="217">217</div>+
                                            </div>
                                            <!--end::Animation-->
                                            <!--begin::Label-->
                                            <span class="text-gray-600 fw-semibold fs-5 lh-0">{{__('Satisfied Clients')}}</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Item-->


                                
                                <!--begin::Item-->
                                <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-lg-10">
                                    <!--begin::Content-->
                                    <div class="text-center">
                                        <!--begin::Symbol-->
                                        <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/keenthemes/keen/docs/core/html/src/media/icons/duotune/medicine/med005.svg-->
                                        <span class="svg-icon svg-icon-muted svg-icon-2hx fs-2tx text-info"><svg
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3"
                                                    d="M17.9061 13H11.2061C11.2061 12.4 10.8061 12 10.2061 12C9.60605 12 9.20605 12.4 9.20605 13H6.50606L9.20605 8.40002V4C8.60605 4 8.20605 3.6 8.20605 3C8.20605 2.4 8.60605 2 9.20605 2H15.2061C15.8061 2 16.2061 2.4 16.2061 3C16.2061 3.6 15.8061 4 15.2061 4V8.40002L17.9061 13ZM13.2061 9C12.6061 9 12.2061 9.4 12.2061 10C12.2061 10.6 12.6061 11 13.2061 11C13.8061 11 14.2061 10.6 14.2061 10C14.2061 9.4 13.8061 9 13.2061 9Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M18.9061 22H5.40605C3.60605 22 2.40606 20 3.30606 18.4L6.40605 13H9.10605C9.10605 13.6 9.50605 14 10.106 14C10.706 14 11.106 13.6 11.106 13H17.8061L20.9061 18.4C21.9061 20 20.8061 22 18.9061 22ZM14.2061 15C13.1061 15 12.2061 15.9 12.2061 17C12.2061 18.1 13.1061 19 14.2061 19C15.3061 19 16.2061 18.1 16.2061 17C16.2061 15.9 15.3061 15 14.2061 15Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--end::Symbol-->

                                        <!--begin::Text-->
                                        <div class="mt-1">
                                            <!--begin::Animation-->
                                            <div
                                                class="fs-lg-2hx fs-2x fw-bold text-gray-800 d-flex align-items-center">
                                                <div class="min-w-50px" data-kt-countup="true"
                                                    data-kt-countup-value="250">250</div>+
                                            </div>
                                            <!--end::Animation-->

                                            <!--begin::Label-->
                                            <span class="text-gray-600 fw-semibold fs-5 lh-0">{{__('Project Done')}}</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Items-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Testimonial-->
                        <div class="fs-2 fw-semibold text-white text-center mb-3">
                            <span class="fs-1 lh-1 text-gray-700">“</span>Manufacturing for Water, Wastewater and Energy
                            <span class="fs-1 lh-1 text-gray-700">“</span>
                        </div>
                        <!--end::Testimonial-->

                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Statistics-->


                <!--begin::Section-->
                <div class="mb-16">
                    <!--begin::Top-->
                    <div class="text-center mb-12">
                        <!--begin::Title-->
                        <h1 class="fs-2hx text-gray-900 mb-5">{{__('Layanan')}}</h1>
                        <!--end::Title-->

                        <!--begin::Text-->
                        <h2 class="fs-5 text-muted fw-semibold">
                            Beragam layanan profesional yang dirancang untuk memenuhi kebutuhan Anda
                        </h2>
                        <!--end::Text-->
                    </div>
                    <!--end::Top-->

                    <!--begin::Row-->
                    <div class="row g-10">
                        <!--begin::Col-->
                        <div class="col-md-3">
                            <!--begin::Publications post-->
                            <div class="card-xl-stretch me-md-6">
                                <!--begin::Overlay-->
                                <a class="d-block overlay mb-4" data-fslightbox="lightbox-hot-sales"
                                    href="{{ url('/layanan/tim-profesional-grinviro.webp') }}">
                                    <!--begin::Image-->
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        style="background-image:url('{{ url('/layanan/tim-profesional-grinviro.webp') }}')">
                                    </div>
                                    <!--end::Image-->

                                    <!--begin::Action-->
                                    <div class="overlay-layer bg-dark card-rounded bg-opacity-25">
                                        <i class="ki-duotone ki-eye fs-2x text-white"></i>
                                    </div>
                                    <!--end::Action-->
                                </a>
                                <!--end::Overlay-->

                                <!--begin::Body-->
                                <div class="m-0">
                                    <!--begin::Title-->
                                    <h2 class="fs-4 text-gray-900 fw-bold text-gray-900 lh-base">{{__('Tim Profesional')}}</h2>
                                    <!--end::Title-->

                                    <!--begin::Text-->
                                    <h3 class="fw-semibold fs-7 text-gray-600 text-gray-900 mt-3 mb-5">
                                        Tim kami terdiri dari para profesional yang berdedikasi dengan keahlian mendalam dalam bidang pengolahan air dan air limbah. Dengan latar belakang pendidikan yang solid dan pengalaman bertahun-tahun, kami memastikan setiap proyek ditangani dengan kompetensi dan integritas.​
                                    </h3>
                                    <!--end::Text-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Publications post-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-3">
                            <!--begin::Publications post-->
                            <div class="card-xl-stretch mx-md-3">
                                <!--begin::Overlay-->
                                <a class="d-block overlay mb-4" data-fslightbox="lightbox-hot-sales"
                                    href="{{ url('/layanan/profesional-tim.webp') }}">
                                    <!--begin::Image-->
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        style="background-image:url('{{ url('/layanan/profesional-tim.webp') }}')">
                                    </div>
                                    <!--end::Image-->

                                    <!--begin::Action-->
                                    <div class="overlay-layer bg-dark card-rounded bg-opacity-25">
                                        <i class="ki-duotone ki-eye fs-2x text-white"></i>
                                    </div>
                                    <!--end::Action-->
                                </a>
                                <!--end::Overlay-->

                                <!--begin::Body-->
                                <div class="m-0">
                                    <!--begin::Title-->
                                    <h2 class="fs-4 text-gray-900 fw-bold text-gray-900 lh-base">{{__('Teknologi yang Tepat')}}</h2>
                                    <!--end::Title-->

                                    <!--begin::Text-->
                                    <h3 class="fw-semibold fs-7 text-gray-600 text-gray-900 mt-3 mb-5">
                                        Kami menggunakan teknologi terbaru dan paling tepat dalam setiap langkah pengolahan air dan air limbah. Dengan integrasi teknologi mutakhir seperti sistem filtrasi canggih, otomatisasi, dan kontrol proses, kami memastikan kualitas air yang optimal, efisiensi energi, dan kepatuhan regulasi lingkungan.​
                                    </h3>
                                    <!--end::Text-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Publications post-->



                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-3">
                            <!--begin::Publications post-->
                            <div class="card-xl-stretch ms-md-6">
                                <!--begin::Overlay-->
                                <a class="d-block overlay mb-4" data-fslightbox="lightbox-hot-sales"
                                    href="{{ url('/layanan/produk-lokal-grinviro.webp') }}">
                                    <!--begin::Image-->
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        style="background-image:url('{{ url('/layanan/produk-lokal-grinviro.webp') }}')">
                                    </div>
                                    <!--end::Image-->

                                    <!--begin::Action-->
                                    <div class="overlay-layer bg-dark card-rounded bg-opacity-25">
                                        <i class="ki-duotone ki-eye fs-2x text-white"></i>
                                    </div>
                                    <!--end::Action-->
                                </a>
                                <!--end::Overlay-->

                                <!--begin::Body-->
                                <div class="m-0">
                                    <!--begin::Title-->
                                    <h2 class="fs-4 text-gray-900 fw-bold text-gray-900 lh-base">{{__('Produk Lokal')}}</h2>
                                    <!--end::Title-->

                                    <!--begin::Text-->
                                    <h3 class="fw-semibold fs-7 text-gray-600 text-gray-900 mt-3 mb-5">
                                        Kami menggunakan produk lokal berkualitas tinggi dalam setiap proyek. Dengan memanfaatkan sumber daya lokal, kami tidak hanya mendukung ekonomi lokal tetapi juga memastikan ketersediaan suku cadang dan layanan yang lebih cepat dan lebih efisien.​
                                    </h3>
                                    <!--end::Text-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Publications post-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-3">
                            <!--begin::Publications post-->
                            <div class="card-xl-stretch ms-md-6">
                                <!--begin::Overlay-->
                                <a class="d-block overlay mb-4" data-fslightbox="lightbox-hot-sales"
                                    href="{{ url('/layanan/pengalaman-tim-grinviro.webp') }}">
                                    <!--begin::Image-->
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        style="background-image:url('{{ url('/layanan/pengalaman-tim-grinviro.webp') }}')">
                                    </div>
                                    <!--end::Image-->

                                    <!--begin::Action-->
                                    <div class="overlay-layer bg-dark card-rounded bg-opacity-25">
                                        <i class="ki-duotone ki-eye fs-2x text-white"></i>
                                    </div>
                                    <!--end::Action-->
                                </a>
                                <!--end::Overlay-->

                                <!--begin::Body-->
                                <div class="m-0">
                                    <!--begin::Title-->
                                    <h2 class="fs-4 text-gray-900 fw-bold text-gray-900 lh-base">{{__('Pengalaman Tinggi')}}</h2>
                                    <!--end::Title-->

                                    <!--begin::Text-->
                                    <h3 class="fw-semibold fs-7 text-gray-600 text-gray-900 mt-3 mb-5">
                                        Pengalaman yang luas dalam berbagai proyek pengolahan air dan air limbah, kami memiliki pemahaman mendalam tentang tantangan dan solusi yang efektif. Pengalaman kami mencakup berbagai skala proyek dari kecil hingga besar, di berbagai sektor industri.​
                                    </h3>
                                    <!--end::Text-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Publications post-->



                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Section-->



                <!--begin::Team-->
                <div class="mb-18">
                    <!--begin::Heading-->
                    <div class="text-center mb-12">
                        <!--begin::Title-->
                        <h3 class="fs-2hx text-gray-900 mb-5">{{__('Pelanggan Kami')}}</h3>
                        <!--end::Title-->

                        <!--begin::Sub-title-->
                        <div class="fs-5 text-muted fw-semibold">
                            Perusahaan dan organisasi yang telah mempercayakan kebutuhan mereka kepada kami
                        </div>
                        <!--end::Sub-title--->
                    </div>
                    <!--end::Heading-->

                    <!--begin::Slider-->
                    <div class="tns tns-default mb-10">
                        <!--begin::Wrapper-->
                        <div data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false" data-tns-speed="2000"
                            data-tns-autoplay="true" data-tns-autoplay-timeout="18000" data-tns-controls="true"
                            data-tns-nav="false" data-tns-items="1" data-tns-center="false" data-tns-dots="false"
                            data-tns-prev-button="#kt_team_slider_prev" data-tns-next-button="#kt_team_slider_next"
                            data-tns-responsive="{1200: {items: 3}, 992: {items: 2}}">

                            <!--begin::Item-->
                            <div class="text-center">
                                <!--begin::Photo-->
                                <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                    style="background-image:url('{{ url('/images/client/PT-Bumi-Menara-Internusa.gif') }}')">
                                </div>
                                <!--end::Photo-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="text-center">
                                <!--begin::Photo-->
                                <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                    style="background-image:url('{{ url('/images/client/PT-Cargill-Indonesia.gif') }}')">
                                </div>
                                <!--end::Photo-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="text-center">
                                <!--begin::Photo-->
                                <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                    style="background-image:url('{{ url('/images/client/PT-Citra-Enggal-Wings-Group.gif') }}')">
                                </div>
                                <!--end::Photo-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="text-center">
                                <!--begin::Photo-->
                                <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                    style="background-image:url('{{ url('/images/client/PT-CS-2-Pola-Sehat.gif') }}')">
                                </div>
                                <!--end::Photo-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="text-center">
                                <!--begin::Photo-->
                                <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                    style="background-image:url('{{ url('/images/client/PT-HM-Sampoerna-Tbk.gif') }}')">
                                </div>
                                <!--end::Photo-->
                            </div>
                            <!--end::Item-->

                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Button-->
                        <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev">
                            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/keenthemes/keen/docs/core/html/src/media/icons/duotune/arrows/arr074.svg-->
                            <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--end::Button-->

                        <!--begin::Button-->
                        <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next">
                            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/keenthemes/keen/docs/core/html/src/media/icons/duotune/arrows/arr071.svg-->
                            <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Slider-->
                </div>
                <!--end::Team-->


                <!--begin::Card-->
                <div class="card mb-4 bg-light text-center ">
                    <!--begin::Body-->
                    <div class="card-body py-12">
                        <!--begin::Icon-->
                        <a href="https://www.facebook.com/grinviroglobal" target="_blank" rel="noopener noreferrer" class="mx-4">
                            <img src="/template/assets/media/svg/brand-logos/facebook-4.svg" class="h-30px my-2" alt="" />
                        </a>
                        <!--end::Icon-->

                        <!--begin::Icon-->
                        <a href="https://www.instagram.com/grinviroglobal" target="_blank" rel="noopener noreferrer" target="_blank" rel="noopener noreferrer" class="mx-4">
                            <img src="/template/assets/media/svg/brand-logos/instagram-2-1.svg" class="h-30px my-2" alt="" />
                        </a>
                        <!--end::Icon-->

                        <!--begin::Icon-->
                        <a href="https://www.tiktok.com/@grinviroglobal" target="_blank" rel="noopener noreferrer" class="mx-4">
                            <img src="/template/assets/media/svg/brand-logos/tiktok.svg" class="h-30px my-2" alt="" />
                        </a>
                        <!--end::Icon-->

                        <!--begin::Icon-->
                        <a href="https://www.youtube.com/@grinviroglobal" target="_blank" rel="noopener noreferrer" class="mx-4">
                            <img src="/template/assets/media/svg/brand-logos/youtube-3.svg" class="h-30px my-2" alt="" />
                        </a>
                        <!--end::Icon-->

                        <!--begin::Icon-->
                        <a href="https://www.linkedin.com/company/pt-grinviro-biotekno-indonesia-grinviro-group" target="_blank" rel="noopener noreferrer" class="mx-4">
                            <img src="/template/assets/media/svg/brand-logos/linkedin-2.svg" class="h-30px my-2" alt="" />
                        </a>
                        <!--end::Icon-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::About card-->

    </div>
    <!--end::Content container-->



    <!--begin::Footer-->
    @include('layouts.guest.footer')
    <!--end::Footer-->
</x-guest-layout>
