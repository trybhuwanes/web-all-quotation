@push('script')
    <style media="screen">
        .ps-cart__content .ps-product--detail {
            margin-bottom: -25px;
        }

        .ps-cart__content .ps-product--detail>.ps-product__content {
            padding-top: 0px;
        }

        .ps-cart__content .ps-product--detail .ps-tab-list {
            font-size: 0px;
        }

        .ps-cart__content .ps-product--detail .ps-tab-list li a {
            font-size: 16px;
        }

        .ps-cart--mini {
            margin: 0 10px !important;
        }

        .header .header__top,
        .header.header--sticky .menu--product-categories .menu__toggle span,
        .header--mobile,
        .header--mobile.header--sticky .navigation--mobile {
            background: rgb(243, 244, 245);
            /* color: #70BCD9; */
        }

        .navigation {
            
        }

        .ps-product-list .ps-section__header,
        .ps-vendor-store .ps-block--vendor-filter,
        .ps-block--vendor .ps-block__container,
        .ps-shopping .ps-shopping__header,
        .widget_shop,
        .ps-vendor-dashboard .ps-section__links {
           
        }

        .ps-footer {
            
        }

        .ps-footer__links img {
            margin-right: 10px;
        }

        .ps-footer__links {
            border-top: 1px solid #eee;
        }

        .ps-footer__copyright {
            border-top: 1px solid #eee;
        }

        /* .ps-form--quick-search {
                                    border: 1px solid #ccc;
                                  } */

        .header .header__extra:hover i {
            /* color: #dda43a; */
            color: #70BCD9;
        }

        .ps-block--user-header .ps-block__right a:hover {
            /* color: #dda43a; */
            color: #70BCD9;
        }

        .widget_shop .ps-checkbox input[type=checkbox]:checked~label {
            color: black;
            font-weight: normal;
        }
    </style>
@endpush

<body>
    @php
        $user = auth()->guard('web')->user();
    @endphp
    <header class="header header--1 position-fixed" style="z-index: 99; left: 0; right: 0">
        <div class="header__top">
            <div class="ps-container">
                <div class="header__left">
                    {{-- <a class="ps-logo" href="{{ route('welcome') }}"><img
                            src="{{ asset('img/') . '/' . $logo_horizontal }}" alt="" width="170px"></a> --}}
                </div>
                <div class="header__center">

                </div>
                <div class="header__right">
                    <div class="header__actions">
                        @if (Auth::user())
                            <div class="ps-cart--mini"><a class="header__extra" href="#"><i
                                        class="fa fa-bell-o"></i><span>
                                        {{ Auth::user()->unReadnotifications->where('type', '!=', 'App\Notifications\NotifPembelian')->count() }}
                                    </span></a>
                                <div class="ps-cart__content">
                                    <div class="ps-cart__items border-bottom">
                                        <div class="ps-product--detail ps-product--fullwidth">
                                            <div class="ps-product__content ps-tab-root">
                                                <ul class="ps-tab-list">
                                                    <li class="active"><a href="#tab-umum">Umum</a></li>
                                                    <li class=""><a href="#tab-transaksi">Transaksi</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="ps-tab active" id="tab-umum">
                                            <div class="ps-product--cart-mobile">
                                                <div class="ps-product__content">
                                                    <strong>Diskusi</strong>
                                                    <hr>
                                                    <ul class="ps-custom-scrollbar ps-list--categories"
                                                        data-height="250">
                                                        @forelse(Auth::user()->unReadnotifications->whereIn('type', ['App\Notifications\NotifDiskusi', 'App\Notifications\NotifBalasDiskusi']) as $notifdiskusi)
                                                            <li>
                                                                <a
                                                                    href="{{ route("myshop.diskusi") }}">{{ $notifdiskusi->data['data']['keterangan'] }}</a>
                                                            </li>
                                                        @empty
                                                            <li>Anda belum memiliki notifikasi diskusi.</li>
                                                        @endforelse
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ps-tab" id="tab-transaksi">
                                            <div class="ps-product--cart-mobile">
                                                <div class="ps-product__content">
                                                    <strong>Penjualan</strong>
                                                    <hr>
                                                    <ul class="ps-custom-scrollbar ps-list--categories"
                                                        data-height="250">
                                                        @forelse(Auth::user()->unReadnotifications->whereIn('type', ['App\Notifications\NotifPesanan', 'App\Notifications\NotifPembayaranPenjual', 'App\Notifications\NotifTerimaPemesanan']) as $notifpenjualan)
                                                            <li><a
                                                                    href="{{ route('baca-notifikasi', $notifpenjualan->id) }}">{{ $notifpenjualan->data['data']['keterangan'] }}</a>
                                                            </li>
                                                        @empty
                                                            <li>Anda belum memiliki notifikasi penjualan.</li>
                                                        @endforelse
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (Auth::user())
                            <div class="ps-cart--mini">
                                <a class="header__extra" href="{{ route('redeem-code') }}">
                                    <i class="icon-color-sampler position-relative" style="top: -3px">
                                        <p class="position-absolute text-center" style="top: 27px; right: -4px; font-size: 10px; line-height: 10px; font-weight: 700;">Redeem Code</p>
                                    </i>
                                </a>
                            </div>
                        @endif

                        @if (Auth::user())
                            <div class="ps-cart--mini"><a class="header__extra" href="#"><i
                                        class="icon-user"></i></a>
                                <div class="ps-cart__content">
                                    <div class="ps-cart__items border-bottom">
                                        <div class="ps-product--cart-mobile m-0">
                                            <div class="ps-product__thumbnail">
                                                <a href="#">
                                                    @if (empty(Auth::user()->toko?->foto_toko))
                                                        <img src="{{ URL::asset('img/store.png') }}"
                                                            alt="" class="rounded img-thumbnail">
                                                    @else
                                                        <img src="{{ URL::asset('img/foto-toko/' . Auth::user()->toko?->foto_toko) }}" alt=""
                                                            class="rounded img-thumbnail">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="ps-product__content">
                                                <a href="{{ route('myshop') }}"><strong>{{ Auth::user()->toko?->nama_toko }}</strong></a>
                                                @if (Auth::user()->email_verified_at !== null)
                                                    <p>Toko terverifikasi <i class="fa fa-check-circle"
                                                            style="color:#06c;"></i></p>
                                                @endif
                                                <p><strong>Saldo:</strong> Rp
                                                    {{ number_format(Auth::user()->saldo, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ps-cart__footer">
                                        <div class="ps-product__content">
                                            <figure>
                                                <p></p>
                                                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                                    @csrf
                                                    <button type="submit" class="ps-btn ps-btn--sm">
                                                        <i class="fa fa-sign-out"></i>
                                                        Logout
                                                    </button>
                                                </form>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="ps-block--user-header">
                                <div class="ps-block__left"><i class="icon-user"></i></div>
                                <div class="ps-block__right">
                                    <a href="{{ route('login') }}">Masuk</a><a
                                        href="{{ route('register') }}">Daftar</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
    <header class="header header--mobile" data-sticky="true" style="text-align:left;">
        <div class="header__top">
            <div class="header__left">
                {{-- <p>Selamat datang di {{ $nama_marketplace }} !</p> --}}
            </div>
            <div class="header__right">
                {{-- <ul class="navigation__extra">
                    @if (empty($tokosaya))
                        <li><a href="{{ route('mulai') }}">Berjualan di {{ $nama_marketplace }}</a></li>
                    @endif
                </ul> --}}
            </div>
        </div>
        <div class="navigation--mobile">
            <div class="navigation__left">
                {{-- <a class="ps-logo" href="{{ route('welcome') }}"><img
                        src="{{ asset('img/') . '/' . $logo_horizontal }}" alt="" width="170px"></a> --}}
                    </div>
            <div class="navigation__right">
                <div class="header__actions">
                    @if (Auth::user())
                        <div class="ps-cart--mini"><a class="header__extra" href="#"><i
                                    class="icon-store"></i></a>
                            @if (empty($tokosaya))
                                <div class="ps-cart__content border-bottom">
                                    <div class="ps-cart__items">
                                        <p>Anda belum memiliki toko.</p> <a class="ps-btn ps-btn--fullwidth ps-btn--sm"
                                            href="{{ route('mulai') }}">Buka Toko</a>
                                    </div>
                                </div>
                            @else
                                <div class="ps-cart__content">
                                    <div class="ps-cart__items border-bottom">
                                        <div class="ps-product--cart-mobile border-bottom">
                                            <div class="ps-product__thumbnail">
                                                <a href="#">
                                                    @if (empty($tokosaya->foto_toko))
                                                        <img src="{{ URL::asset('img/store.png') }}" alt=""
                                                            class="rounded img-thumbnail" />
                                                    @else
                                                        <img src="{{ URL::asset('img/foto-toko/' . $tokosaya->foto_toko) }}"
                                                            alt="" class="rounded img-thumbnail" />
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="ps-product__content"><a
                                                    href="{{ route('halaman-toko', $tokosaya->domain) }}"><strong>{{ $tokosaya->nama_toko }}</strong></a>
                                                <p><strong>Saldo:</strong> Rp
                                                    {{ number_format(Auth::user()->toko->saldo, 2) }}</p>
                                            </div>
                                        </div>
                                        <div class="ps-product--cart-mobile">
                                            <div class="ps-product__content">
                                                <a href="{{ route('myshop-produk') }}"><strong><i
                                                            class="icon-list"></i> Daftar Produk</strong></a>
                                            </div>
                                        </div>
                                        <div class="ps-product--cart-mobile">
                                            <div class="ps-product__content">
                                                <a href="{{ route('pemesanan') }}"><strong><i class="icon-box"></i>
                                                        Pesanan</strong></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ps-cart__footer">
                                        <figure>
                                            {{-- <p>{{ $nama_marketplace }} Seller<br>Atur & pantau tokomu di satu tempat --}}
                                            </p>
                                            <a class="ps-btn ps-btn--sm" href="{{ route('myshop') }}"
                                                target="_blank"><i class="icon-cog"></i> Pengaturan Toko</a>
                                        </figure>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    @if (Auth::user())
                        <div class="ps-cart--mini"><a class="header__extra" href="#"><i
                                    class="icon-user"></i></i></a>
                            <div class="ps-cart__content">
                                <div class="ps-cart__items border-bottom">
                                    <div class="ps-product--cart-mobile border-bottom">
                                        <div class="ps-product__thumbnail"><a href="#">
                                                <img src="{{ URL::asset('img/avatar/' . Auth::user()->avatar) }}"
                                                    alt="" class="rounded img-thumbnail" />
                                        </div>
                                        <div class="ps-product__content">
                                            <a
                                                href="{{ route('user-akun', Auth::user()->username) }}"><strong>{{ Auth::user()->nama_lengkap }}</strong></a>
                                            @if (Auth::user()->email_verified_at !== null)
                                                <p>Akun terverifikasi <i class="fa fa-check-circle"
                                                        style="color:#06c;"></i></p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ps-product--cart-mobile">
                                        <div class="ps-product__content">
                                            <a href="{{ route('wishlist') }}"><strong><i class="icon-heart"></i>
                                                    Produk Favorit</strong></a>
                                        </div>
                                    </div>
                                    <div class="ps-product--cart-mobile">
                                        <div class="ps-product__content">
                                            <a href="{{ route('pembelian') }}"><strong><i class="icon-box"></i>
                                                    Pembelian</strong></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="ps-cart__footer">
                                    <div class="ps-product__content">
                                        <figure>
                                            <p></p>
                                            <a class="ps-btn ps-btn--sm" href="{{ route('logout') }}"><i
                                                    class="fa fa-sign-out"></i> Logout</a>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="ps-block--user-header">
                            <div class="ps-block__left"><i class="icon-user"></i></div>
                            <div class="ps-block__right">
                                <a href="{{ route('login') }}">Masuk</a><a href="{{ route('register') }}">Daftar</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </header>
    <div class="navigation--list">
        <div class="navigation__content">
            <a class="navigation__item" href="{{ route('welcome') }}">
                <i class="icon-home"></i><span> Home</span>
            </a>
            <a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile">
                <i class="icon-menu"></i><span> Kategori</span>
            </a>
            <a class="navigation__item ps-toggle--sidebar" href="#search-sidebar">
                <i class="icon-magnifier"></i><span> Search</span>
            </a>
            {{-- <a class="navigation__item" href="{{ route('cart') }}">
                <i class="icon-bag2"></i><span> Cart</span>
            </a> --}}
        </div>
    </div>
