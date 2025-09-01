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

        .ps-cart--mini .dropdown-item {
            font-size: 14px;
            padding: 8px 12px;
        }

        .ps-cart--mini .dropdown-item i {
            font-size: 14px;
            color: #616161;
        }

        .dropdown-menu {
            width: 150px;
            border-radius: 8px;
            border-color: #E0E0E0;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        }

        @media (min-width: 1200px) {
            .countcart-mobile {
                display: none;
            }
        }
    </style>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on('click', function(e) {
                e.preventDefault();
                $('a[data-toggle="tab"]').removeClass('active');
                $('.tab-pane').removeClass('active');
                $(this).addClass('active');
                $($(this).attr('href')).addClass('active');
            });
        });
    </script>
@endpush

<body>
    @php
        $user = auth()->guard('web')->user();
    @endphp
    <header class="header header--1" data-sticky="true">
        <div class="header__top">
            <div class="ps-container">
                <div class="header__left">
                    <div class="menu--product-categories">
                        {{-- <div class="menu__toggle"><i class="icon-menu"></i><span> Kategori</span></div>
                        <div class="menu__content">
                            <ul class="menu--dropdown">
                                @foreach ($semuakategori as $k)
                                    <li><a href="{{ route('shop', $k->slug) }}"><i class="icon-star"></i>
                        {{ $k->nama_kategori }}</a></li>
                        @endforeach
                        </ul>
                    </div> --}}
                    </div>
                    {{-- <a class="ps-logo" href="{{ route('welcome') }}"><img
                            src="{{ asset('img/') . '/' . $logo_horizontal }}" alt="" width="170px"></a> --}}
                </div>
                <div class="header__center">
                    <form class="ps-form--quick-search" action="" method="get">
                        <div class="form-group--icon"><i class="icon-chevron-down"></i>
                            <select class="form-control" id="kat" name="kat">
                                <option value="" selected="selected">Semua</option>
                                {{-- @foreach ($semuakategori as $k)
                                    <option class="level-0" value="{{ $k->id_kategori }}"
                                        {{ Input::get('kat') == $k->id_kategori ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach --}}
                            </select>
                        </div>
                        <input class="form-control" name="q" type="text" placeholder="Aku mau belanja..."
                            value="">
                        <button>Cari</button>
                    </form>
                </div>
                <div class="header__right">
                    <div class="header__actions">
                        @if (Auth::user())
                            <div class="ps-cart--mini"><a class="header__extra" href="#"><i
                                        class="fa fa-bell-o"></i><span>
                                        {{ Auth::user()->unReadnotifications->whereIn('type', [
                                                'App\Notifications\NotifPembelian',
                                                'App\Notifications\NotifPembayaranPembeli',
                                                'App\Notifications\NotifProsesPemesanan',
                                                'App\Notifications\NotifKirimPemesanan',
                                                'App\Notifications\NotifDiskusi',
                                                'App\Notifications\NotifBalasDiskusi'
                                            ])->count() }}
                                    </span></a>
                                <div class="ps-cart__content">
                                    <div class="ps-cart__items border-bottom">
                                        <div class="ps-product--detail ps-product--fullwidth">
                                            <div class="ps-product__content ps-tab-root">
                                                <!-- Tab Navigation -->
                                                <ul class="ps-tab-list">
                                                    <li class="active">
                                                        <a href="#tab-pembelian" data-toggle="tab">Pembelian</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab-diskusi" data-toggle="tab">Diskusi</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Tab Content -->
                                        <div class="tab-content">
                                            <!-- Tab Pembelian -->
                                            <div class="tab-pane active" id="tab-pembelian">
                                                <div class="ps-product--cart-mobile">
                                                    <div class="ps-product__content">
                                                        <!-- <strong>Pembelian</strong>
                                                <hr> -->
                                                        <ul class="ps-custom-scrollbar ps-list--categories"
                                                            data-height="">
                                                            @forelse(Auth::user()->unReadnotifications->whereIn('type', [
                                                    'App\Notifications\NotifPembelian',
                                                    'App\Notifications\NotifPembayaranPembeli',
                                                    'App\Notifications\NotifProsesPemesanan',
                                                    'App\Notifications\NotifKirimPemesanan'
                                                    ]) as $notifpembelian)
                                                                <li>
                                                                    <a
                                                                        href="{{ route('baca-notifikasi', $notifpembelian->id) }}">
                                                                        {{ $notifpembelian->data['data']['keterangan'] }}
                                                                    </a>
                                                                </li>
                                                            @empty
                                                                <li>Anda belum memiliki notifikasi pembelian.</li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tab Diskusi -->
                                            <div class="tab-pane" id="tab-diskusi">
                                                <div class="ps-product--cart-mobile">
                                                    <div class="ps-product__content">
                                                        <!-- <strong>Diskusi</strong> -->
                                                        <!-- <hr> -->
                                                        <ul class="ps-custom-scrollbar ps-list--categories"
                                                            data-height="">
                                                            @forelse(Auth::user()->unReadnotifications->whereIn('type', [
                                                    'App\Notifications\NotifDiskusi',
                                                    'App\Notifications\NotifBalasDiskusi'
                                                    ]) as $notifdiskusi)
                                                                <li>
                                                                    <a
                                                                        href="{{ route('baca-notifikasi', ['id' => $notifdiskusi->id, 'diskusi' => 'true']) }}">
                                                                        {{ $notifdiskusi->data['data']['keterangan'] }}
                                                                    </a>
                                                                </li>
                                                            @empty
                                                                <li>Anda belum memiliki notifikasi diskusi.</li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="ps-cart--mini"><a class="header__extra" href="">
                                <i class="icon-bag2"></i>
                                @if (Auth::user())
                                    <span>
                                        <i id="countcart"
                                            class="countchart">{{ isset($keranjangsaya) ? $keranjangsaya->where('produk.is_active', true)->count() : '0' }}</i>
                                    </span>
                                @endif
                            </a>
                        </div>
                        <div class="ps-cart--mini">
                            {{-- <a class="header__extra" href="{{ route('chat-buyer.index') }}">
                                <i class="icon-bubble"></i>
                                @if (Auth::user()?->unreadChat()->where('data->data->type', 'pembeli')->count() > 0)
                                    <span id="count-chat">
                                        <i>{{ Auth::user()?->unreadChat()->where('data->data->type', 'pembeli')->count() }}</i>
                                    </span>
                                @endif
                            </a> --}}
                        </div>
                        @if (Auth::user())
                            <div class="ps-cart--mini">
                                <a class="header__extra" href="{{ route('wishlist') }}">
                                    <i class="icon-heart"></i>
                                    <span>
                                        <i
                                            id="countwish">{{ isset($favoritsaya) ? $favoritsaya->where('produk.is_active', true)->count() : '0' }}</i>
                                    </span>
                                </a>
                            </div>
                            <div class="ps-cart--mini"><a class="header__extra" href="#"><i
                                        class="icon-store"></i></a>
                                @if (empty($tokosaya) || $user->pengajuanToko()?->latest()->first()?->status == App\Enums\TokoStatusEnum::Ditolak)
                                    @if ($user->pengajuanToko()?->latest()->first()?->status == App\Enums\TokoStatusEnum::MenungguVerifikasi)
                                        <div class="ps-cart__content">
                                            <div class="ps-cart__items border-bottom">
                                                <div class="ps-product--cart-mobile border-bottom m-0">
                                                    <div class="ps-product__thumbnail">
                                                        @if (empty($tokosaya->foto_toko))
                                                            <a href="#"><img
                                                                    src="{{ URL::asset('img/store.png') }}"
                                                                    alt="" class="rounded img-thumbnail"></a>
                                                        @else
                                                            <a href="#"><img
                                                                    src="{{ URL::asset('img/foto-toko/' . $tokosaya->foto_toko) }}"
                                                                    alt="" class="rounded img-thumbnail"></a>
                                                        @endif
                                                    </div>
                                                    <div class="ps-product__content">
                                                        <a href="#">
                                                            <strong>{{ $user->pengajuanToko?->latest()?->first()?->nama_toko }}</strong>
                                                        </a>
                                                        <p><span class="badge badge-info">Toko anda masih dalam proses
                                                                verifikasi.</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="ps-cart__content border-bottom">
                                            <div class="ps-cart__items">
                                                <p>Anda belum memiliki toko.</p> <a
                                                    class="ps-btn ps-btn--fullwidth ps-btn--sm"
                                                    href="{{ route('mulai') }}">Buka Toko</a>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if (!empty($tokosaya))
                                    <div class="ps-cart__content">
                                        <div class="ps-cart__items border-bottom">
                                            <div class="ps-product--cart-mobile m-0">
                                                <div class="ps-product__thumbnail">
                                                    <a href="#">
                                                        @if (empty($tokosaya->foto_toko))
                                                            <img src="{{ URL::asset('img/store.png') }}"
                                                                alt="" class="rounded img-thumbnail" />
                                                        @else
                                                            <img src="{{ URL::asset('img/foto-toko/' . $tokosaya->foto_toko) }}"
                                                                alt="" class="rounded img-thumbnail" />
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="ps-product__content">
                                                    <a href="{{ route('halaman-toko', $tokosaya->domain) }}">
                                                        <strong>{{ $tokosaya->nama_toko }}</strong>
                                                    </a>
                                                    {{-- <p><strong>Saldo:</strong> Rp
                                            {{ number_format(Auth::user()->toko->saldo, 2) }}
                                        </p> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ps-cart__footer">
                                            <div class="ps-product__content">
                                                <figure>
                                                    {{-- <p>{{ $nama_marketplace }} Seller<br>Atur & pantau tokomu di satu
                                                        tempat</p> --}}
                                                    <a class="ps-btn ps-btn--sm" href="{{ route('seller') }}"
                                                        target="_blank"><i class="icon-cog"></i> Pengaturan Toko</a>
                                                </figure>
                                            </div>
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
                                            <div class="ps-product__thumbnail">
                                                @if (Auth::user()->avatar !== null)
                                                    <a href="#"><img
                                                            src="{{ URL::asset('img/avatar/' . Auth::user()->avatar) }}"
                                                            alt="" class="rounded img-thumbnail" /></a>
                                                @else
                                                    <a href="#"><img src="{{ URL::asset('img/avatar.jpg') }}"
                                                            alt="" class="rounded img-thumbnail" /></a>
                                                @endif
                                            </div>
                                            <div class="ps-product__content">
                                                <a
                                                    href="{{ route('user-akun', Auth::user()->username) }}"><strong>{{ Auth::user()->nama_lengkap }}</strong></a>
                                                @if (Auth::user()->email_verified_at !== null)
                                                    <p>Akun terverifikasi <i class="fa fa-check-circle"
                                                            style="color:#06c;"></i></p>
                                                @endif
                                                {{-- <p><strong>Saldo:</strong> Rp
                                            {{ number_format(Auth::user()->saldo, 2) }}
                                        </p> --}}
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
                                                <form action="{{ route('logout') }}" method="POST"
                                                    id="logout-form">
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
        {{-- <nav class="navigation">
            <div class="ps-container" style="height:50px;">
                <div class="navigation__left">
                    <div class="menu--product-categories">
                        <div class="menu__toggle"><i class="icon-menu"></i><span> Kategori</span></div>
                        <div class="menu__content">
                            <ul class="menu--dropdown">
                                @foreach ($semuakategori as $k)
                                    <li><a href="{{ route('shop', $k->slug) }}"><i class="icon-star"></i>
        {{ $k->nama_kategori }}</a></li>
        @endforeach

        </ul>
        </div>
        </div>
        </div>
        <div class="navigation__right">
            <ul class="menu">
                <!-- <li class="current-menu-item menu-item-has-children"><a href="index.html">Home</a><span class="sub-toggle"></span>
                <ul class="sub-menu">
                  <li><a href="index.html">Marketplace Full Width</a>
                  </li>
                  <li><a href="homepage-2.html">Home Auto Parts</a>
                  </li>
                  <li><a href="homepage-10.html">Home Technology</a>
                  </li>
                  <li><a href="homepage-9.html">Home Organic</a>
                  </li>
                  <li><a href="homepage-3.html">Home Marketplace V1</a>
                  </li>
                  <li><a href="homepage-4.html">Home Marketplace V2</a>
                  </li>
                  <li><a href="homepage-5.html">Home Marketplace V3</a>
                  </li>
                  <li><a href="homepage-6.html">Home Marketplace V4</a>
                  </li>
                  <li><a href="homepage-7.html">Home Electronic</a>
                  </li>
                  <li><a href="homepage-8.html">Home Furniture</a>
                  </li>
                </ul>
              </li>
              <li class="menu-item-has-children has-mega-menu"><a href="shop-default.html">Shop</a><span class="sub-toggle"></span>
                <div class="mega-menu">
                  <div class="mega-menu__column">
                    <h4>Catalog Pages<span class="sub-toggle"></span></h4>
                    <ul class="mega-menu__list">
                      <li><a href="shop-default.html">Shop Default</a>
                      </li>
                      <li><a href="shop-default.html">Shop Fullwidth</a>
                      </li>
                      <li><a href="shop-categories.html">Shop Categories</a>
                      </li>
                      <li><a href="shop-sidebar.html">Shop Sidebar</a>
                      </li>
                      <li><a href="shop-sidebar-without-banner.html">Shop Without Banner</a>
                      </li>
                      <li><a href="shop-carousel.html">Shop Carousel</a>
                      </li>
                    </ul>
                  </div>
                  <div class="mega-menu__column">
                    <h4>Product Layout<span class="sub-toggle"></span></h4>
                    <ul class="mega-menu__list">
                      <li><a href="product-default.html">Default</a>
                      </li>
                      <li><a href="product-extend.html">Extended</a>
                      </li>
                      <li><a href="product-full-content.html">Full Content</a>
                      </li>
                      <li><a href="product-box.html">Boxed</a>
                      </li>
                      <li><a href="product-sidebar.html">Sidebar</a>
                      </li>
                      <li><a href="product-default.html">Fullwidth</a>
                      </li>
                    </ul>
                  </div>
                  <div class="mega-menu__column">
                    <h4>Product Types<span class="sub-toggle"></span></h4>
                    <ul class="mega-menu__list">
                      <li><a href="product-default.html">Simple</a>
                      </li>
                      <li><a href="product-default.html">Color Swatches</a>
                      </li>
                      <li><a href="product-countdown.html">Countdown</a>
                      </li>
                      <li><a href="product-multi-vendor.html">Multi-Vendor</a>
                      </li>
                      <li><a href="product-instagram.html">Instagram</a>
                      </li>
                      <li><a href="product-affiliate.html">Affiliate</a>
                      </li>
                      <li><a href="product-on-sale.html">On sale</a>
                      </li>
                      <li><a href="product-video.html">Video Featured</a>
                      </li>
                      <li><a href="product-groupped.html">Grouped</a>
                      </li>
                      <li><a href="product-out-stock.html">Out Of Stock</a>
                      </li>
                    </ul>
                  </div>
                  <div class="mega-menu__column">
                    <h4>Woo Pages<span class="sub-toggle"></span></h4>
                    <ul class="mega-menu__list">
                      <li><a href="shopping-cart.html">Shopping Cart</a>
                      </li>
                      <li><a href="checkout.html">Checkout</a>
                      </li>
                      <li><a href="whishlist.html">Whishlist</a>
                      </li>
                      <li><a href="compare.html">Compare</a>
                      </li>
                      <li><a href="order-tracking.html">Order Tracking</a>
                      </li>
                      <li><a href="my-account.html">My Account</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </li>
              <li class="menu-item-has-children has-mega-menu"><a href="#">Pages</a><span class="sub-toggle"></span>
                <div class="mega-menu">
                  <div class="mega-menu__column">
                    <h4>Basic Page<span class="sub-toggle"></span></h4>
                    <ul class="mega-menu__list">
                      <li><a href="about-us.html">About Us</a>
                      </li>
                      <li><a href="contact-us.html">Contact</a>
                      </li>
                      <li><a href="faqs.html">Faqs</a>
                      </li>
                      <li><a href="comming-soon.html">Comming Soon</a>
                      </li>
                      <li><a href="404-page.html">404 Page</a>
                      </li>
                    </ul>
                  </div>
                  <div class="mega-menu__column">
                    <h4>Vendor Pages<span class="sub-toggle"></span></h4>
                    <ul class="mega-menu__list">
                      <li><a href="become-a-vendor.html">Become a Vendor</a>
                      </li>
                      <li><a href="vendor-store.html">Vendor Store</a>
                      </li>
                      <li><a href="vendor-dashboard-free.html">Vendor Dashboard Free</a>
                      </li>
                      <li><a href="vendor-dashboard-pro.html">Vendor Dashboard Pro</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </li>
              <li class="menu-item-has-children has-mega-menu"><a href="#">Blogs</a><span class="sub-toggle"></span>
                <div class="mega-menu">
                  <div class="mega-menu__column">
                    <h4>Blog Layout<span class="sub-toggle"></span></h4>
                    <ul class="mega-menu__list">
                      <li><a href="blog-grid.html">Grid</a>
                      </li>
                      <li><a href="blog-list.html">Listing</a>
                      </li>
                      <li><a href="blog-small-thumb.html">Small Thumb</a>
                      </li>
                      <li><a href="blog-left-sidebar.html">Left Sidebar</a>
                      </li>
                      <li><a href="blog-right-sidebar.html">Right Sidebar</a>
                      </li>
                    </ul>
                  </div>
                  <div class="mega-menu__column">
                    <h4>Single Blog<span class="sub-toggle"></span></h4>
                    <ul class="mega-menu__list">
                      <li><a href="blog-detail.html">Single 1</a>
                      </li>
                      <li><a href="blog-detail-2.html">Single 2</a>
                      </li>
                      <li><a href="blog-detail-3.html">Single 3</a>
                      </li>
                      <li><a href="blog-detail-4.html">Single 4</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </li> -->
            </ul>
            <ul class="navigation__extra">
                @if (empty($tokosaya))
                <li><a href="{{ route('mulai') }}">Berjualan di {{ $nama_marketplace }}</a></li>
                @endif
                <!-- <li><a href="#">Tract your order</a></li>
              <li>
                <div class="ps-dropdown"><a href="#">US Dollar</a>
                  <ul class="ps-dropdown-menu">
                    <li><a href="#">Us Dollar</a></li>
                    <li><a href="#">Euro</a></li>
                  </ul>
                </div>
              </li>
              <li>
                <div class="ps-dropdown language"><a href="#"><img src="{{ URL::asset('img/flag/en.png') }}" alt="">English</a>
                  <ul class="ps-dropdown-menu">
                    <li><a href="#"><img src="{{ URL::asset('img/flag/germany.png') }}" alt=""> Germany</a></li>
                    <li><a href="#"><img src="{{ URL::asset('img/flag/fr.png') }}" alt=""> France</a></li>
                  </ul>
                </div>
              </li> -->
            </ul>
        </div>
        </div>
        </nav> --}}
    </header>
    <header class="header header--mobile" data-sticky="true" style="text-align:left;">
        <div class="header__top">
            {{-- <div class="header__left">
                <p>Selamat datang di {{ $nama_marketplace }} !</p>
            </div> --}}
            <div class="header__right">
                <ul class="navigation__extra">
                    {{-- @if (empty($tokosaya))
                        <li><a href="{{ route('mulai') }}">Berjualan di {{ $nama_marketplace }}</a></li>
                    @endif --}}
                    <!-- <li><a href="#">Tract your order</a></li>
            <li>
              <div class="ps-dropdown"><a href="#">US Dollar</a>
                <ul class="ps-dropdown-menu">
                  <li><a href="#">Us Dollar</a></li>
                  <li><a href="#">Euro</a></li>
                </ul>
              </div>
            </li>
            <li>
              <div class="ps-dropdown language"><a href="#"><img src="{{ URL::asset('img/flag/en.png') }}" alt="">English</a>
                <ul class="ps-dropdown-menu">
                  <li><a href="#"><img src="{{ URL::asset('img/flag/germany.png') }}" alt=""> Germany</a></li>
                  <li><a href="#"><img src="{{ URL::asset('img/flag/fr.png') }}" alt=""> France</a></li>
                </ul>
              </div>
            </li> -->
                </ul>
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
                        <div class="ps-cart--mini"><a class="header__extra" href="#"><i class="icon-store"
                                    style="font-size: 28px"></i></a>
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
                                        <div class="ps-product--cart-mobile m-0">
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
                                                    {{ number_format(Auth::user()->toko->saldo, 2) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ps-cart__footer">
                                        <figure>
                                            {{-- <p>{{ $nama_marketplace }} Seller<br>Atur & pantau tokomu di satu tempat --}}
                                            </p>
                                            <a class="ps-btn ps-btn--sm" href="{{ route('seller') }}"
                                                target="_blank"><i class="icon-cog"></i> Pengaturan Toko</a>
                                        </figure>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    @if (Auth::user())
                        <div class="ps-cart--mini"><a class="header__extra" href="">
                                <i class="icon-bag2"></i>
                                @if (Auth::user())
                                    <span>
                                        <i id="countcart"
                                            class="countcart-mobile">{{ isset($keranjangsaya) ? $keranjangsaya->where('produk.is_active', true)->count() : '0' }}</i>
                                    </span>
                                @endif
                            </a>
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
                            <div class="ps-block__left ps-cart--mini">
                                <a href="#" id="dropdownMenuButton" data-toggle="dropdown"><i
                                        class="icon-user"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('login') }}"><i class="fa fa-sign-in"
                                            aria-hidden="true"></i> Masuk</a>
                                    <a class="dropdown-item" href="{{ route('register') }}"><i
                                            class="fa fa-user-plus" aria-hidden="true"></i> Daftar</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="ps-search--mobile">
            <!-- <form class="ps-form--search-mobile" action="index.html" method="get">
          <div class="form-group--nest">
            <input class="form-control" type="text" placeholder="Search something...">
            <button><i class="icon-magnifier"></i></button>
          </div>
        </form> -->
            <form class="ps-form--quick-search" action="" method="get">
                <input class="form-control" name="q" type="text" placeholder="Aku mau belanja..."
                    value="">
                <button><i class="icon-magnifier"></i></button>
            </form>
        </div>
    </header>
    <!-- <div class="ps-panel--sidebar" id="cart-mobile">
      <div class="ps-panel__header">
        <h3>Shopping Cart</h3>
      </div>
      <div class="navigation__content">
        <div class="ps-cart--mobile">
          <div class="ps-cart__content">
            <div class="ps-product--cart-mobile">
              <div class="ps-product__thumbnail"><a href="#"><img src="{{ URL::asset('img/products/clothing/7.jpg') }}" alt=""></a></div>
              <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                <p><strong>Sold by:</strong>  YOUNG SHOP</p><small>1 x $59.99</small>
              </div>
            </div>
          </div>
          <div class="ps-cart__footer">
            <h3>Sub Total:<strong>$59.99</strong></h3>
            <figure><a class="ps-btn" href="shopping-cart.html">View Cart</a><a class="ps-btn" href="checkout.html">Checkout</a></figure>
          </div>
        </div>
      </div>
    </div> -->
    <div class="ps-panel--sidebar" id="navigation-mobile">
        <div class="ps-panel__header">
            <h3>Kategori</h3>
        </div>
        <div class="ps-panel__content">
            <ul class="menu--mobile">
                {{-- @foreach ($semuakategori as $k)
                    <li><a href="{{ route('shop', $k->slug) }}">{{ $k->nama_kategori }}</a></li>
                @endforeach --}}
                <!-- <li><a href="#">Hot Promotions</a>
          </li>
          <li class="menu-item-has-children has-mega-menu"><a href="#">Consumer Electronic</a><span class="sub-toggle"></span>
            <div class="mega-menu">
              <div class="mega-menu__column">
                <h4>Electronic<span class="sub-toggle"></span></h4>
                <ul class="mega-menu__list">
                  <li><a href="#">Home Audio &amp; Theathers</a>
                  </li>
                  <li><a href="#">TV &amp; Videos</a>
                  </li>
                  <li><a href="#">Camera, Photos &amp; Videos</a>
                  </li>
                  <li><a href="#">Cellphones &amp; Accessories</a>
                  </li>
                  <li><a href="#">Headphones</a>
                  </li>
                  <li><a href="#">Videosgames</a>
                  </li>
                  <li><a href="#">Wireless Speakers</a>
                  </li>
                  <li><a href="#">Office Electronic</a>
                  </li>
                </ul>
              </div>
              <div class="mega-menu__column">
                <h4>Accessories &amp; Parts<span class="sub-toggle"></span></h4>
                <ul class="mega-menu__list">
                  <li><a href="#">Digital Cables</a>
                  </li>
                  <li><a href="#">Audio &amp; Video Cables</a>
                  </li>
                  <li><a href="#">Batteries</a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li><a href="#">Clothing &amp; Apparel</a>
          </li>
          <li><a href="#">Home, Garden &amp; Kitchen</a>
          </li>
          <li><a href="#">Health &amp; Beauty</a>
          </li>
          <li><a href="#">Yewelry &amp; Watches</a>
          </li>
          <li class="menu-item-has-children has-mega-menu"><a href="#">Computer &amp; Technology</a><span class="sub-toggle"></span>
            <div class="mega-menu">
              <div class="mega-menu__column">
                <h4>Computer &amp; Technologies<span class="sub-toggle"></span></h4>
                <ul class="mega-menu__list">
                  <li><a href="#">Computer &amp; Tablets</a>
                  </li>
                  <li><a href="#">Laptop</a>
                  </li>
                  <li><a href="#">Monitors</a>
                  </li>
                  <li><a href="#">Networking</a>
                  </li>
                  <li><a href="#">Drive &amp; Storages</a>
                  </li>
                  <li><a href="#">Computer Components</a>
                  </li>
                  <li><a href="#">Security &amp; Protection</a>
                  </li>
                  <li><a href="#">Gaming Laptop</a>
                  </li>
                  <li><a href="#">Accessories</a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li><a href="#">Babies &amp; Moms</a>
          </li>
          <li><a href="#">Sport &amp; Outdoor</a>
          </li>
          <li><a href="#">Phones &amp; Accessories</a>
          </li>
          <li><a href="#">Books &amp; Office</a>
          </li>
          <li><a href="#">Cars &amp; Motocycles</a>
          </li>
          <li><a href="#">Home Improments</a>
          </li>
          <li><a href="#">Vouchers &amp; Services</a>
          </li> -->
            </ul>
        </div>
    </div>
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
            <!-- <a class="navigation__item ps-toggle--sidebar" href="#cart-mobile">
          <i class="icon-bag2"></i><span> Cart</span>
        </a> -->
        </div>
    </div>
    <div class="ps-panel--sidebar" id="search-sidebar">
        <div class="ps-panel__header">
            <form class="ps-form--quick-search" action="" method="get">
                <input class="form-control" name="q" type="text" placeholder="Aku mau belanja..."
                    value="">
                <button><i class="icon-magnifier"></i></button>
            </form>
        </div>
        <div class="navigation__content"></div>
    </div>
