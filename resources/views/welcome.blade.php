@extends('base-template')
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('css/notifIt.css') }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="format-detection" content="telephone=no">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <!-- Primary Meta Tags -->
        <title>Belanjar - Penuhi Segala Kebutuhanmu</title>
        <meta name="title" content="Penuhi Segala Kebutuhanmu - Aplikasi Belanjar" />
        <meta name="description"
            content="Temukan berbagai produk dengan kualitas terbaik di Aplikasi Belanjar. Nikmati penawaran spesial, diskon besar, dalam lokasi Universitas Dinamika" />
        <meta name="robots" content="index, follow">
        <meta name="keywords" content="Belanjar, Belanja Online, Harga Murah, Market Place, Ecommerce">
        <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
        <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://belanjar.com/" />
        <meta property="og:title" content="Penuhi Segala Kebutuhanmu - Aplikasi Belanjar" />
        <meta property="og:description"
            content="Temukan berbagai produk dengan kualitas terbaik di Aplikasi Belanjar. Nikmati penawaran spesial, diskon besar, dalam lokasi Universitas Dinamika" />
        <meta property="og:image" content="{{ asset('img/thumbnail.jpg') }}" />

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="https://belanjar.com/" />
        <meta property="twitter:title" content="Penuhi Segala Kebutuhanmu - Aplikasi Belanjar" />
        <meta property="twitter:description"
            content="Temukan berbagai produk dengan kualitas terbaik di Aplikasi Belanjar. Nikmati penawaran spesial, diskon besar, dalam lokasi Universitas Dinamika" />
        <meta property="twitter:image" content="{{ asset('img/thumbnail.jpg') }}" />
    @endpush
    @push('script')
        <script src="{{ asset('js/notifIt.js') }}"></script>
        <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    @endpush
    <div id="homepage-1">
        <div class="ps-home-banner ps-home-banner--1">
            <div class="ps-container">
                {{-- @if ($promos->count() > 1)
                    <div class="ps-section__left">
                        @if ($banners->count() > 1)
                            <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true"
                                data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true"
                                data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1"
                                data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
                                @foreach ($banners as $banner)
                                    <div class="ps-banner">
                                        <a href="#"><img src="{{ asset('img') . '/' . $banner->banner }}"
                                                alt=""></a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            @foreach ($banners as $banner)
                                <div class="ps-banner">
                                    <a href="#"><img src="{{ asset('img') . '/' . $banner->banner }}" alt=""></a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="ps-section__right">
                        @foreach ($promos as $promo)
                            <a class="ps-collection" href="#"><img src="{{ asset('img') . '/' . $promo->promo }}"
                                    alt=""></a>
                        @endforeach
                    </div>
                @else
                    @if ($banners->count() > 1)
                        <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true"
                            data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true"
                            data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1"
                            data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
                            @foreach ($banners as $banner)
                                <div class="ps-banner">
                                    <a href="#"><img src="{{ asset('img') . '/' . $banner->banner }}" alt=""></a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        @foreach ($banners as $banner)
                            <div class="ps-banner">
                                <a href="#"><img src="{{ asset('img') . '/' . $banner->banner }}" alt=""></a>
                            </div>
                        @endforeach
                    @endif
                @endif --}}
            </div>
        </div>
        <div class="ps-site-features">
            <div class="ps-container">
                <div class="ps-block--site-features">
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-diamond"></i></div>
                        <div class="ps-block__right">
                            <h4>Produk Lokal</h4>
                            <p>Kami menyediakan alat IPAL berkualitas dari pelaku lokal untuk mendukung pengelolaan lingkungan yang berkelanjutan.</p>
                        </div>
                    </div>
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-star"></i></div>
                        <div class="ps-block__right">
                            <h4>Ragam Produk</h4>
                            <p>Kami menawarkan berbagai alat IPAL, mulai dari tangki, pompa, blower, media filtrasi, hingga perlengkapan pendukung lainnya. Semua tersedia dalam satu platform yang mudah diakses dan informatif.</p>
                        </div>
                    </div>
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-bubbles"></i></div>
                        <div class="ps-block__right">
                            <h4>Live Chat</h4>
                            <p>Konsultasikan kebutuhan Anda secara langsung dengan penjual melalui fitur Live Chat.</p>
                        </div>
                    </div>
                    <div class="ps-block__item">
                        <div class="ps-block__left"><i class="icon-credit-card"></i></div>
                        <div class="ps-block__right">
                            <h4>Transaksi Mudah</h4>
                            <p>Proses pembelian alat IPAL menjadi lebih mudah dan aman di Belanjar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--begin::produk terbaru-->
        <div class="ps-product-list ps-new-arrivals">
            <div class="ps-container">
                <div class="card-list-produk">
                    <h3>Produk Terbaru</h3>
                    <div class="mt-3" style="margin: 0 1px">
                        <div class="row">
                            {{-- @foreach ($produks as $produks)
                                <div class="col-lg-2 col-md-4 col-6 card-produk-col">
                                    <x-card-produk :produk="$produks" :kategori='false'></x-card-produk>
                                </div>
                            @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::produk terbaru-->

        <!--begin::produk terlaris-->
        <div class="ps-product-list ps-new-arrivals mt-3">
            <div class="ps-container">
                <div class="card-list-produk">
                    <h3>Produk Terlaris</h3>
                    <div class="mt-3" style="margin: 0 1px">
                        <div class="row">
                            {{-- @php
                            // Assuming $bestSellProduk is a collection and quantity_sold is an attribute
                            $sortedBestSellProduk = $bestSellProduk->sortByDesc(function($produks) {
                                return $produks->quantity_sold;
                            });
                            @endphp

                            @foreach ($sortedBestSellProduk as $produks)
                                <div class="col-lg-2 col-md-4 col-6 card-produk-col">
                                    <x-card-produk :produk="$produks" :kategori='false'></x-card-produk>
                                </div>
                            @endforeach --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::produk terlaris-->

        <!--begin::kategori-->
        <div class="ps-product-list ps-new-arrivals mt-5 mt-lg-3">
            <div class="ps-container">
                <div class="row">
                    <div class="col-12 col-lg-3 col-xl-2 px-lg-0 pl-lg-3">
                        <div class="card card-filter px-4 py-5">
                            <h4>Filter Produk</h4>
                            <div class="form-group mb-0 mt-4">
                                <label for="ktg_value">Kategori Produk</label>
                                <select id="ktg_value" class="form-select select-option"
                                    aria-label="Default select example">
                                    <option value="0">Semua Kategori</option>
                                    {{-- @foreach ($kategori as $ktg)
                                        <option value="{{ $ktg->id_kategori }}">{{ $ktg->nama_kategori }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="form-group mb-0 mt-4">
                                {{-- <label for="ktg_value">Cluster Produk</label>
                                <select id="cluster_value" class="form-select select-option"
                                    aria-label="Default select example">
                                    <option value="0">Semua Cluster</option>
                                    @foreach ($clusters as $cluster)
                                        <option value="{{ $cluster->id }}">{{ $cluster->nama_cluster }}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                            <button type="button" class="btn btn-primary mt-5 btn-filter btn-apply">Terapkan Filter</button>
                            <button type="button" class="btn btn-outline-secondary mt-2 btn-filter" onclick="resetFilter()">Reset Filter</button>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9 col-xl-10 mt-md-5 mt-lg-0">
                        @include('_filter-produk')
                    </div>
                </div>
            </div>
        </div>
        <!--begin::kategori-->

    </div>

    <div class="modal fade" id="modalcart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle">Berhasil Ditambahkan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            {{-- <img height="100px" id="gbr_cart" src=""
                                onerror="this.src='{{ URL::asset('img/gambar-produk.jpg') }}';" /> --}}
                        </div>
                        <div class="col-md-8" id="produk_cart">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <a href="{{ route('cart') }}">
                        <button type="button" class="ps-btn">Lihat Keranjang</button>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>

    <button id="notif" onclick="push()" style="display:none;"></button>
    <button id="hapus" onclick="hapus()" style="display:none;"></button>
@endsection
