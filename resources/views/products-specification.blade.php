<x-guest-layout>
    <!--begin::Header-->
    @include('layouts.guest.header')
    <!--end::Header-->


    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">

        <x-product-detail-header :productShow="$productShow" :productType="$productType" />

        <div class="app-container container-xxl mt-5">
            <div class="d-flex flex-column flex-lg-row">

                <div class="app-content flex-row-fluid me-lg-25 me-0">

                    <div class="pt-0">
                        {!!$productShow->spesifikasi_deskripsi !!}  
                        {{--Forex FAS --}}
                        @if($productShow->specificationFas->isNotEmpty())
                            @include('_specification-fas')
                        @endif

                        {{--Forex FMP/MPS --}}
                        @if($productShow->specificationFmp->isNotEmpty())
                            @include('_specification-mps')
                        @endif
                    </div>
                </div>



                <div class="app-aside app-aside-default flex-column w-lg-375px ms-lg-20" data-kt-drawer="true"
                    data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}"
                    data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'250px', '400px': '350px'}"
                    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">

                    <div class="row mb-8">
                        <div class="col">
                            <div class="h-100 rounded-3 border p-8 d-flex flex-column flex-center me-1">
                                <div class="mb-1">

                                    <div class="rating">
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label checked">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                        <div class="rating-label ">
                                            <i class="ki-duotone ki-star fs-6"></i>
                                        </div>
                                    </div>

                                </div>
                                <div class="text-muted fw-semibold fs-7">
                                    Ulasan
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="h-100 rounded-3 border p-8 d-flex flex-column flex-center ms-1">
                                <div class="fs-1 text-dark fw-bold lh-1 mb-1">
                                    200
                                </div>
                                <div class="text-muted fw-semibold fs-7">
                                    Terjual
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3 border p-8 mb-8">
                        
                        
                        <div class="d-flex flex-column flex-center">
                            <div class="fa-base mb-3 text-gray-600 fw-bold">
                                Pembelian Mudah
                            </div>

                            <div class="mb-3">
                                <img src="https://keenthemes.com/assets/media/payment-methods/default/paypal.svg"
                                    alt="" class="h-30px me-2 rounded">

                                <img src="https://keenthemes.com/assets/media/payment-methods/default/visa.svg"
                                    alt="" class="h-30px me-2 rounded">

                                <img src="https://keenthemes.com/assets/media/payment-methods/default/mastercard.svg"
                                    alt="" class="h-30px me-2 rounded">
                            </div>
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
