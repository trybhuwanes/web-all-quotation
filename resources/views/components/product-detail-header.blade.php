<section class="mt-5">
    <ol class="breadcrumb breadcrumb-dot text-muted fs-6 fw-semibold">
        <li class="breadcrumb-item"><a href="/" class="">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('product-overview.index') }}" class="">{{ __('Product') }}</a>
        </li>
        <li class="breadcrumb-item text-muted">{{ $productShow->nama_produk }}</li>
    </ol>
    <div class="border-gray-300 border-bottom border-bottom-dashed"></div>
</section>

<section class="pt-lg-15 mb-8">
    <div class="position-relative overflow-hidden">

        <div class="app-container container-xxl">
            <div class="d-lg-flex align-items-start">

                <div class="overlay rounded-3 position-relative zindex-1 w-lg-250px me-lg-15 mb-6 flex-shrink-0">
                    <div class="overlay-wrapper overflow-hidden rounded-4">
                        <img alt="photo-product-grinviro"
                            src="{{ $productShow->getFirstMediaUrl('product-thumbnail') }}"
                            class="rounded-4 border border-4 border-gray-200 w-100">
                    </div>
                    {{-- <div class="overlay-layer rounded-4">
                        <a href="https://preview.keenthemes.com/oswald-html-free"
                            class="btn btn-primary fw-bold me-4" target="_blank">Live Preview</a>
                    </div> --}}
                </div>



                <div class="d-flex align-items-end pt-lg-0 pt-15">

                    <div class="pt-6">

                        <div class="pb-2 d-flex">
                            <span class="badge  badge-success  badge-inline py-2 px-3 fs-7 fw-bold">
                                {{ $productShow->categoryProducts->nama_kategori }}
                            </span>
                        </div>

                        <div class="py-5 py-lg-6">
                            <h1 class="fw-bold fs-5 fs-lg-2hx text-gray-900">{{ $productShow->nama_produk }}</h1>

                            <span class="fs-5 text-gray-700 d-block pt-2">
                                {{ $productShow->deskripsi_produk }}
                            </span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between w-100 pb-lg-0 pb-3">
                            <div>
                                {{-- <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $productShow->id }}">
                                    <button type="submit" class="btn btn-primary  px-6 me-3">+ Masukan Keranjang</button>
                                </form> --}}
                                {{-- <a href="https://preview.keenthemes.com/oswald-html-free" target="_blank"
                                    class="btn btn-primary  px-6 me-3">+ Tambhakan Keranjang</a> --}}

                                <!-- File: product_detail.blade.php -->
                                <!-- Tombol untuk membuka modal -->
                                <button type="button" class="btn btn-primary px-6 me-3" data-bs-toggle="modal"
                                    data-bs-target="#productTypeModal">
                                    Beli Sekarang
                                </button>


                                <!--begin::Modal - Select Users-->
                                <div class="modal fade" id="productTypeModal" tabindex="-1"
                                    aria-labelledby="productTypeModalLabel">
                                    <!--begin::Modal dialog-->
                                    <div class="modal-dialog mw-700px">
                                        <!--begin::Modal content-->
                                        <div class="modal-content">
                                            <!--begin::Modal header-->
                                            <div class="modal-header  pb-0 border-0 d-flex justify-content-end">
                                                <!--begin::Close-->
                                                <div class="btn btn-sm btn-icon btn-active-color-primary"
                                                    data-bs-dismiss="modal">
                                                    <i class="ki-duotone ki-cross fs-1"><span
                                                            class="path1"></span><span class="path2"></span></i>
                                                </div>
                                                <!--end::Close-->
                                            </div>
                                            <!--end::Modal header-->

                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $productShow->id }}">
                                                <!--begin::Modal body-->
                                                <div class="modal-body scroll-y mx-5 mx-xl-10 pt-0 pb-15">
                                                    <!--begin::Heading-->
                                                    <div class="text-center mb-13">
                                                        <!--begin::Title-->
                                                        <h1
                                                            class="d-flex justify-content-center align-items-center mb-3">
                                                            {{ $productShow->nama_produk }} {{ __('Tipe') }}
                                                            {{-- <span class="badge badge-circle badge-secondary ms-3">81</span> --}}
                                                        </h1>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Heading-->

                                                    <!--begin::Users-->
                                                    <div class="mh-475px scroll-y me-n7 pe-7">
                                                        <!--begin::User-->
                                                        <div class="mb-10">
                                                            <!--begin::Heading-->
                                                            <div class="mb-3">
                                                                <!--begin::Label-->
                                                                <label
                                                                    class="d-flex align-items-center fs-5 fw-semibold">
                                                                    <span class="required">Pilih Tipe</span>
                                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                                        title="Pilihlah tipe produk sesuai kebutuhan Anda.">
                                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span
                                                                                class="path1"></span><span
                                                                                class="path2"></span><span
                                                                                class="path3"></span></i>
                                                                    </span>
                                                                </label>
                                                                <!--end::Label-->

                                                                <!--begin::Description-->
                                                                <div class="fs-7 fw-semibold text-muted">Jika Anda
                                                                    memerlukan informasi lebih lanjut, silakan periksa
                                                                    spesifikasi produk</div>
                                                                <!--end::Description-->
                                                            </div>
                                                            <!--end::Heading-->

                                                            <!--begin::Row-->
                                                            <div class="fv-row">
                                                                <!--begin::Radio group dengan grid Bootstrap -->
                                                                <div class="row" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                                                    @foreach ($productType as $type)
                                                                        <div class="col-6 col-sm-4 col-md-3 mb-3">
                                                                            <label class="btn btn-outline border-hover-primary btn-active-success btn-color-muted w-100" for="type_{{ $type->id }}" data-kt-button="true">
                                                                                <input class="btn-check" type="radio" name="product_type" id="type_{{ $type->id }}" value="{{ $type->id }}" />
                                                                                {{ $type->type_name }}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <!--end::Radio group-->
                                                            </div>
                                                            <!--end::Row-->
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer flex-center">
                                                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button> --}}
                                                        <button type="submit" id="submitButton" class="btn btn-primary">+ Masukan Keranjang</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</section>

<div class="app-container container-xxl">
    <!--begin::Menu-->
    <div class="py-4 d-flex align-items-center justify-content-lg-between flex-wrap border-top border-bottom">
        <div class="my-2 me-4 me-lg-10">
            <a href="{{ route('product-overview.detail', $productShow->slug) }}"
                class="{{ request()->routeIs('product-overview.detail') ? 'active bg-light' : '' }} btn btn-lg btn-color-gray-700 btn-active-color-primary text-uppercase fs-base ls-sm fw-bolder px-6 me-1">
                {{__('Ringkasan')}}
            </a>
            <a href="{{ route('product-overview.project', $productShow->slug) }}"
                class="{{ request()->routeIs('product-overview.project') ? 'active bg-light' : '' }} btn btn-lg btn-color-gray-700 btn-active-color-primary text-uppercase fs-base ls-sm fw-bolder px-6 me-1">
                {{__('Project Ref')}}
            </a>
            <a href="{{ route('product-overview.specification', $productShow->slug) }}"
                class="{{ request()->routeIs('product-overview.specification') ? 'active bg-light' : '' }} btn btn-lg btn-color-gray-700 btn-active-color-primary text-uppercase fs-base ls-sm fw-bolder px-6 me-1">
                {{__('Spesifikasi')}}
            </a>

            @auth
                @php
                    $slugToModal = [
                        'flowrex-multi-plate-screw-press' => '#kt_modal_mps',
                        'flowrex-surface-aerator' => '#kt_modal_fas',
                    ];
                
                    $modalTarget = $slugToModal[$productShow->slug] ?? null;
                @endphp

                @if ($modalTarget)
                    <a href="#"
                        class="btn btn-lg btn-color-gray-700 btn-active-color-primary text-uppercase fs-base ls-sm fw-bolder px-6 me-1 open-modal"
                        data-bs-toggle="modal" 
                        data-bs-target="{{ $modalTarget }}" 
                        data-system="product" 
                        data-uid="{{ $productShow->id }}">
                        {{__('Hitung')}}
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}"
                    class="btn btn-lg btn-color-gray-700 btn-active-color-primary text-uppercase fs-base ls-sm fw-bolder px-6 me-1">
                    {{__('Hitung')}}
                </a>
            @endauth
        </div>

        <div class="d-flex align-items-center flex-wrap my-2">
            <div class="d-flex align-items-center me-4 me-lg-10">
                <div class="symbol symbol-30px me-5">
                    <img alt="Icon" src="/template/assets/media/svg/files/pdf.svg">
                    @if (auth()->check())
                    <a href="{{ route('product-overview.brosur', $productShow->slug) }}" class="fs-6 ls-sm fw-bold my-3 me-18">{{__('Unduh Brosur')}}</a>
                    @else
                    <a href="{{ route('login') }}" class="fs-6 ls-sm fw-bold my-3 me-10">{{__('Unduh Brosur Setelah Login')}}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--end::Menu-->

    @include('_modal-count')
    @include('_modal-count-fas')
</div>

<script>
    // Menunggu sampai DOM sepenuhnya dimuat
    document.addEventListener('DOMContentLoaded', function () {
        const radioButtons = document.querySelectorAll('input[name="product_type"]');
        const submitButton = document.getElementById('submitButton');

        // Fungsi untuk memeriksa status radio button
        function checkRadioButtons() {
            let isChecked = false;
            radioButtons.forEach(function (radio) {
                if (radio.checked) {
                    isChecked = true;
                }
            });
            // Aktifkan atau nonaktifkan tombol berdasarkan status
            submitButton.disabled = !isChecked;
        }

        // Menambahkan event listener untuk setiap radio button
        radioButtons.forEach(function (radio) {
            radio.addEventListener('change', checkRadioButtons);
        });

        checkRadioButtons();
    });
</script>