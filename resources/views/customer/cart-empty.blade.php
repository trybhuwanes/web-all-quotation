<x-guest-layout>
    <!--begin::Header-->
    @include('layouts.guest.header')
    <!--end::Header-->


    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container  container-xxl">
         <!--begin::Card-->
        <div class="card">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Heading-->
                <div class="card-px text-center pt-15 pb-15">
                    <!--begin::Title-->
                    <h2 class="fs-2x text-gray-600 mb-0">{{__('Keranjang Anda Kosong')}}</h2>
                    <!--end::Title-->

                    <!--begin::Description-->
                    <p class="text-gray-500 fs-4 fw-semibold py-7">
                        {{__('Dapatkan Penawaran produk Terbaik Kami')}}</p>
                    <!--end::Description-->

                    <!--begin::Action-->
                    <a href="{{ route('product-overview.index') }}" class="btn btn-primary er fs-6 px-8 py-4" >
                        {{__('Cari Produk')}}
                    </a>
                    <!--end::Action-->
                </div>
                <!--end::Heading-->

                <!--begin::Illustration-->
                <div class="text-center pb-15 px-5">
                    {{-- <img src="/template/assets/media/illustrations/sketchy-1/2.png" alt="" class="mw-100 h-200px h-sm-325px"/>           --}}
                    <img src="{{ url('template/assets/media/product/empty-cart.webp') }} " alt="" class="mw-100 h-200px h-sm-325px"/>          
                </div>
                <!--end::Illustration-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->

        

    </div>
    <!--end::Content container-->



    <!--begin::Footer-->
    @include('layouts.guest.footer')
    <!--end::Footer-->
</x-guest-layout>
