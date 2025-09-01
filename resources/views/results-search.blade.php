<x-guest-layout>
    <!--begin::Header-->
    @include('layouts.guest.header')
    <!--end::Header-->

    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">



        <section class="mt-5">
            <ol class="breadcrumb breadcrumb-dot text-muted fs-6 fw-semibold">
                <li class="breadcrumb-item"><a href="/" class="">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item text-muted">{{ __('Search') }}</li>
            </ol>
            <div class="border-gray-300 border-bottom border-bottom-dashed"></div>
        </section>
        
        <section class="mt-5">
            <h3 class="fs-4">Hasil Untuk "{{ $query }}"</h3>
        </section>

        <section class="mt-3">
            {{-- CONTENCT --}}
            <div class="flex-lg-row-fluid ms-lg-7 ms-xl-12">
                <!--begin::Content-->
                <div class="tab-content" id="kt_app_demos_tab_content">
                    <!--begin::Row-->
<div class="row g-4">
    @forelse ($products as $product)
        <!--begin::Col-->
        <div class="col-md-3">
            <div class="card shadow-sm hover-elevate card-rounded mb-3">
                <a class="d-block card-rounded" href="{{ route('product-overview.detail', $product->slug) }}">
                    <div class="card-xl-stretch">
                        <!--begin::Image-->
                        @if ($product->getFirstMediaUrl('product-thumbnail') == null)
                            <img alt="photo-product-grinviro" src="/template/assets/media/product/no-image.jpg" class="rounded-4 border border-4 border-gray-200 w-100">
                        @else
                            <img alt="photo-product-grinviro" src="{{ $product->getFirstMediaUrl('product-thumbnail') }}" class="rounded-4 border border-4 border-gray-200 w-100">
                        @endif
                        <!--end::Image-->

                        <!--begin::Body-->
                        <div class="my-3">
                            <!--begin::Title-->
                            <div class="fs-3 text-gray-900 fw-bold text-hover-primary lh-base text-center d-block mb-3">
                                {{ $product->nama_produk }}
                            </div>
                            <!--end::Title-->

                            <!--begin::Text-->
                            <div class="fs-7 text-center text-gray-900">
                                {{ substr($product->deskripsi_produk, 0, 70) }}...
                            </div>
                            <!--end::Text-->
                        </div>
                        <!--end::Body-->
                    </div>
                </a>
            </div>
        </div>
        <!--end::Col-->
    @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">
                {{ __('Tidak ada hasil ditemukan untuk pencarian Anda.') }}
            </div>
        </div>
    @endforelse
</div>
<!--end::Row-->


                    <!--begin::Pagination-->
                    <div class="card-footer mt-2">
                       
                    </div>
                    <!--end::Pagination-->
                </div>
                <!--end::Content-->
            </div>
            {{-- CONTENCT --}}
        </section>
    </div>
    <!--end::Content container-->


    <!--begin::Testimonials Section-->
    <div class="mt-20 mb-n20 position-relative z-index-2">

        <!--begin::Container-->
        <div class="container">
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
                    class="btn btn-lg btn-outline border-2 btn-outline-white flex-shrink-0 my-2">Dapatkan Produk Lainnya
                </a>
                <!--end::Link-->
            </div>
            <!--end::Highlight-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Testimonials Section-->

    <!--begin::Footer-->
    @include('layouts.guest.footer')
    <!--end::Footer-->
</x-guest-layout>
