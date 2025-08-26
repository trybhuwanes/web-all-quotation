<x-guest-layout>
    <!--begin::Header-->
    @include('layouts.guest.header')
    <!--end::Header-->


    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container  container-xxl">

        {{--  --}}
        <x-product-detail-header :productShow="$productShow" :productType="$productType" />

        <div class="app-container container-xxl mt-5">
            <div class="d-flex flex-column flex-lg-row">

                <div class="app-content flex-row-fluid me-lg-25 me-0 mb-0">
                    {!!$productShow->ringkasan_deskripsi !!}                    
                </div>



                <div class="app-aside app-aside-default flex-column w-lg-375px ms-lg-20" data-kt-drawer="true"
                    data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}"
                    data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'250px', '400px': '350px'}"
                    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
                    


                    <div class="row mb-8">
                        <div class="col">
                            <!--begin::Slider-->
                    <div class="tns tns-default mb-10">
                        <!--begin::Wrapper-->
                        <div data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false" data-tns-speed="2000"
                            data-tns-autoplay="true" data-tns-autoplay-timeout="18000" data-tns-controls="true"
                            data-tns-nav="false" data-tns-items="1" data-tns-center="false" data-tns-dots="false"
                            data-tns-prev-button="#kt_team_slider_prev" data-tns-next-button="#kt_team_slider_next"
                            data-tns-responsive="{1200: {items: 1}, 992: {items: 1}, 768: {items: 1}, 576: {items: 1}}">

                            

                            @foreach($productShow->getMedia('product-gallery') as $gallery)
                            <a class="d-block card-rounded overlay h-lg-100" data-fslightbox="lightbox-projects" href="{{ $gallery->getUrl() }}">       
                                <!--begin::Image-->

                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-lg-100 min-h-250px" style="background-image:url('{{ $gallery->getUrl() }}')">                       
                                </div>
                                <!--end::Image-->
                    
                                <!--begin::Action-->
                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                    <i class="fa-solid fa-magnifying-glass-plus fs-3x text-white"></i>
                                </div>  
                                <!--end::Action-->      
                            </a>
                            @endforeach                            

                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Button-->
                        <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev">
                            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/keenthemes/keen/docs/core/html/src/media/icons/duotune/arrows/arr074.svg-->
                            <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z"
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
                                    <path
                                        d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Slider-->
                        </div>
                    </div>



                    

                </div>



            </div>
        </div>

    </div>
    <!--end::Content container-->



    <!--begin::Footer-->
    @include('layouts.guest.footer')
    <!--end::Footer-->

    @push('js')

    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="/template/assets/plugins/custom/fslightbox/fslightbox.bundle.js"></script>
    <script src="/template/assets/plugins/custom/typedjs/typedjs.bundle.js"></script>
    <!--end::Vendors Javascript-->

    @endpush
</x-guest-layout>
