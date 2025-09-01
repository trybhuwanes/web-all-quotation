<x-guest-layout>
    <!--begin::Header-->
    @include('layouts.guest.header')
    <!--end::Header-->

    <section class="bg-light">
        <div class="app-container container-xxl position-relative d-flex align-items-center flex-wrap pt-lg-18">
            {{-- <section class="mt-5"> --}}
            <ol class="breadcrumb breadcrumb-dot text-muted fs-6 fw-semibold">
                <li class="breadcrumb-item"><a href="/" class="">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item text-muted">{{ __('Keranjang') }}</li>
            </ol>
            <div class="border-gray-300 border-bottom border-bottom-dashed"></div>
            {{-- </section> --}}

        </div>
    </section>

    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl pt-10 mb-5 mb-lg-10">

        <div class="d-flex flex-column flex-xl-row">
            <!--begin::Content-->
            <div class="d-flex flex-row-fluid me-xl-9 mb-10 mb-xl-0">

                <!--begin::Pos food-->
                <div class="card card-flush card-p-0 bg-transparent border-0">
                    <h3 class="card-title fw-bold">{{ __('Pilih Produk Tambahan/Aksesoris') }} </h3>
                     <!--begin::Card Header-->
                    <div class="card-header">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <input type="text" id="search-input" class="form-control" placeholder="Cari produk tambahan...">
                        </div>
                        <!--end::Search-->
                        <!--begin::Heading-->
                        
                        <!--end::Heading-->

                    </div>
                    <!--end::Card Header-->
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Tab Content-->
                        <div class="tab-content">
                            <!--begin::Tap pane-->
                            <div class="tab-pane fade show active" id="kt_pos_food_content_1" role="tabpanel">
                                <!--begin::Wrapper-->
                                <!-- Menampilkan produk dalam grid -->
                                <div class="row d-flex justify-content-start flex-wrap">
                                    @forelse ($additionalproducts as $product)
                                        @if (strtolower($product->nama_produk_tambahan) != 'shipping to onsite' &&
                                                !(strtolower($product->nama_produk_tambahan) == 'panel control for aerator' &&
                                                    strtolower($product->product->nama_produk ?? '') == 'flowrex surface aerator'
                                                )
                                            )
                                            
                                            <div class="col-6 col-sm-6 col-md-3 col-lg-3 productadd-item" data-product-name="{{ strtolower($product->nama_produk_tambahan) }}">

                                                <div class="card shadow-sm card-flush m-1 p-1 pb-5 mw-40">
                                                    <div class="card-body text-center">
                                                        <!-- Gambar Produk -->
                                                        
                                                        @if($product->getFirstMediaUrl('additional-product-thumbnail') != null)
                                                            <img src="{{ $product->getFirstMediaUrl('additional-product-thumbnail') }}" class="rounded-3 mb-4 w-150px h-150px" alt="thumbnail-additional-product">
                                                        @else
                                                            <img src="{{ url('/template/assets/media/product/no-image.jpg') }}" class="rounded-3 mb-4 w-150px h-150px" alt="thumbnail-additional-product">
                                                        @endif

                                                        <!-- Nama Produk -->
                                                        <div class="mb-2">
                                                            <div class="text-center">
                                                                <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-6">
                                                                    {{ $product->nama_produk_tambahan }}
                                                                </span>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            
                                                            <span class="text-success fs-7">-</span>
                                                            
                                                            <form action="{{ route('cart.addAdditionalProduct') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                <button type="submit" class="btn btn-sm btn-primary">
                                                                    <i class="ki-duotone ki-handcart fs-4"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                        @endif
                                    @empty
                                        <div class="col-md-12 text-center">
                                            <p>Tidak ada produk ditemukan.</p>
                                        </div>
                                    @endforelse
                                </div>

                                <!--end::Wrapper-->
                            </div>
                            <!--end::Tab pane-->
                        

                        </div>
                        <!--end::Tab Content-->
                    </div>
                    <!--end: Card Body-->

                    <!--begin::Pagination-->
                    <div class="card-footer mt-2">
                        {{ $additionalproducts->links('components.pagination.bootstrap-5') }}
                    </div>
                    <!--end::Pagination-->
                </div>
                <!--end::Pos food-->
            </div>
            <!--end::Content-->

            <!--begin::Sidebar-->
            <div class="flex-row-auto w-xl-500px">
                <!--begin::Pos order-->
                <div class="card shadow-sm card-flush bg-body" id="kt_pos_form">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <h3 class="card-title fw-bold text-gray-800 fs-3">Keranjang</h3>

                        <!--begin::Toolbar-->
                        @foreach ($carts as $cart)
                            <div class="card-toolbar" id="kt_delete_cart">
                                <button type="button" class="btn btn-icon-danger btn-sm btn-light-primary fs-7 fw-bold py-4 deletecart" data-kt-cart-id="{{ $cart->id }}" data-kt-element="remove-cart">
                                    <i class="ki-duotone ki-trash fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>Hapus semua
                                </button>
                            </div>
                        @endforeach
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="card-body pt-0">
                        <!--begin::Table container-->
                        <div class="table-responsive mb-5">
                            <!--begin::Table-->
                            <table id="kt_table_carts" class="table align-middle gs-0 gy-4 my-0">
                                <!--begin::Table head-->
                                <thead>
                                    <tr>
                                        <th class="min-w-175px"></th>
                                        <th class="w-125px"></th>
                                        <th class="w-60px"></th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->

                                <!--begin::Table body-->
                                <tbody>
                                    @php
                                        $grandTotal = 0;
                                    @endphp
                                    @foreach ($carts as $cart)
                                        
                                        @foreach ($cart->items as $item)
                                            @php
                                            
                                            $harga = 0;
                                            
                                            if ($item->product) {
                                                $harga = $specification->harga;
                                            } elseif ($item->productadd) {
                                                $harga = $item->productadd->harga_produk_tambahan;
                                            }

                                            $subtotal = $harga * ($item->quantity ?? 0);
                                                $grandTotal += $subtotal; 
                                            @endphp
                                            <tr data-kt-pos-element="item">
                                                <td class="pe-0">
                                                    <div class="d-flex align-items-center">
                                                        @if ($item->productadd)
                                                            <img src="{{  $item->productadd->getFirstMediaUrl('additional-product-thumbnail') }}" class="w-30px h-30px rounded-2 me-3" alt="product-grinviro">
                                                            <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-7 me-1">{{ $item->productadd->nama_produk_tambahan }}</span>
                                                        @else
                                                            <img src="{{  $item->product->getFirstMediaUrl('product-thumbnail') }}" class="w-30px h-30px rounded-2 me-3" alt="product-grinviro">
                                                            <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-7 me-1">{{ $item->product->nama_produk }} {{ $specification->type_name }} </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    <div class="position-relative d-flex align-items-center">
                                                        <button type="button" class="btn btn-icon btn-sm btn-light btn-icon-gray-500" data-kt-dialer-control="decrease">
                                                            <i class="ki-duotone ki-minus fs-2x"></i>
                                                        </button>
                                                        <input type="text" class="form-control border-0 text-center px-0 fs-3 fw-bold text-gray-800 w-30px" 
                                                               name="manageBudget" readonly="" value="{{ $item->quantity }}">
                                                        <button type="button" class="btn btn-icon btn-sm btn-light btn-icon-gray-500" data-kt-dialer-control="increase">
                                                            <i class="ki-duotone ki-plus fs-2x"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="pe-0">
                                                    -
                                                </td>
                                                <td class="text-end align-middle max-w-50px">
                                                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary delete" data-kt-detailcart-id="{{ $item->id }}" data-kt-element="remove-item">
                                                        <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    
                                </tbody>
                                
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->

                        <!--begin::Summary-->
                        <div class="d-flex flex-stack bg-success rounded-3 p-6 mb-5">
                            <!--begin::Content-->
                            <div class="text-white">
                                <span class="fw-bold d-block fs-5 lh-1">TOTAL HARGA</span>
                                <span class="d-block fs-7 lh-1">(Belum termasuk biaya pengiriman & Harga Produk Additional)</span>
                            </div>
                            <!--end::Content-->

                            <!--begin::Content-->
                            <div class="fs-6 fw-bold text-white text-end">
                                <span class="d-block fs-6 lh-1" data-kt-pos-element="grant-total"> - </span>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Summary-->

                        <div class="row d-flex flex-stack">
                            <!--begin::Option-->
                            <input type="checkbox" name="shipping_to_onsite" class="btn-check" id="use_shipping_checkbox" />
                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-5 d-flex align-items-center mb-1" for="use_shipping_checkbox">
                                <i class="ki-duotone ki-delivery fs-3x me-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                <span class="d-block fw-semibold text-start">                            
                                    <span class="text-gray-900 fw-bold d-block fs-5">Shipping to Onsite</span>
                                    <span class="text-muted fs-7">Pilih untuk Pengiriman</span>
                                </span>
                            </label>   
                            <!--end::Option-->
                        
                            
                            <!--begin::Shipping Details-->
                            <div id="shipping-details" class="rounded-3 p-6 mb-1 fs-6 fw-bold bg-dark text-white" style="display: none;">
                                <!--begin::Content-->
                                <div class="row mb-4">
                                    <div class="col-4">
                                        <span class="d-block lh-1 mb-1">Berat Kg:</span>
                                        <span class="d-block lh-1 mb-1">Berat Volume:</span>
                                        <span class="d-block lh-1 mb-1">Harga Pengiriman:</span>
                                    </div>
                                    <div class="col-8 text-end">
                                        <span class="d-block lh-1 mb-1" data-kt-pos-element="total">{{$totalKg}} Kg</span>
                                        <span class="d-block lh-1 mb-1" data-kt-pos-element="discount">{{$totalVolume}} M3</span>
                                        <span class="d-block lh-1 mb-1" data-kt-pos-element="tax">Ditampilkan saat penawaran.</span>
                                    </div>
                                </div>
                                <!--end::Content-->

                                <!--begin::Additional Inputs-->
                                <div class="additional-inputs">
                                    <!--begin::Nama Company-->
                                    <div class="form-group mb-3">
                                        <label for="desti_company" class="form-label text-white">Nama Perusahaan:</label>
                                        <input type="text" id="desti_company" name="desti_company" class="form-control" rows="3" placeholder="Masukkan nama perusahaan penerima">
                                        {{-- <textarea id="desti_company" name="desti_company" class="form-control" rows="3" placeholder="Masukkan nama perusahaan penerima"></textarea> --}}
                                    </div>
                                    <!--end::Nama Company-->

                                    <!--begin::Kabupaten-->
                                    <div class="form-group mb-3">
                                        <label for="kabupaten" class="form-label text-white">Provinsi:</label>

                                        <select name="provinsi" id="desti_state" data-control="select2" data-placeholder="Pilih provinsi..." class="form-select form-select-solid provinsi">
                                            <option value="">Pilih provinsi...</option>
                                            <option value="Nanggroe Aceh Darussalam">Nanggroe Aceh Darussalam</option>
                                            <option value="Sumatera Utara">Sumatera Utara</option>
                                            <option value="Sumatera Selatan">Sumatera Selatan</option>
                                            <option value="Sumatera Barat">Sumatera Barat</option>
                                            <option value="Bengkulu">Bengkulu</option>
                                            <option value="Riau">Riau</option>
                                            <option value="Kepulauan Riau">Kepulauan Riau</option>
                                            <option value="Jambi">Jambi</option>
                                            <option value="Lampung">Lampung</option>
                                            <option value="Bangka Belitung">Bangka Belitung</option>
                                            <option value="Kalimantan Barat">Kalimantan Barat</option>
                                            <option value="Kalimantan Timur">Kalimantan Timur</option>
                                            <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                            <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                            <option value="Kalimantan Utara">Kalimantan Utara</option>
                                            <option value="Banten">Banten</option>
                                            <option value="DKI Jakarta">DKI Jakarta</option>
                                            <option value="Jawa Barat">Jawa Barat</option>
                                            <option value="Jawa Tengah">Jawa Tengah</option>
                                            <option value="Daerah Istimewa Yogyakarta">Daerah Istimewa Yogyakarta</option>
                                            <option value="Jawa Timur">Jawa Timur</option>
                                            <option value="Bali">Bali</option>
                                            <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                            <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                            <option value="Gorontalo">Gorontalo</option>
                                            <option value="Sulawesi Barat">Sulawesi Barat</option>
                                            <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                            <option value="Sulawesi Utara">Sulawesi Utara</option>
                                            <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                                            <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                            <option value="Maluku Utara">Maluku Utara</option>
                                            <option value="Maluku">Maluku</option>
                                            <option value="Papua Barat">Papua Barat</option>
                                            <option value="Papua">Papua</option>
                                            <option value="Papua Tengah">Papua Tengah</option>
                                            <option value="Papua Pegunungan">Papua Pegunungan</option>
                                            <option value="Papua Selatan">Papua Selatan</option>
                                            <option value="Papua Barat Daya">Papua Barat Daya</option>
                                        </select>
                                    </div>
                                    <!--end::Kabupaten-->

                                    <!--begin::Kota-->
                                    <div class="form-group mb-3">
                                        <label for="kota" class="form-label text-white">Kota/Kabupaten:</label>
                                        <select name="kota" id="desti_city" data-control="select2" data-placeholder="Pilih kota..." class="form-select form-select-solid kota">
                                            <option value="">Pilih kota...</option>
                                        </select>
                                    </div>
                                    <!--end::Kota-->

                                    <!--begin::Alamat Detail-->
                                    <div class="form-group">
                                        <label for="desti_address" class="form-label text-white">Alamat Pengiriman:</label>
                                        <textarea id="desti_address" name="desti_address" class="form-control" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                                    </div>
                                    <!--end::Alamat Detail-->
                                </div>
                                <!--end::Additional Inputs-->
                            </div>
                            <!--end::Shipping Details-->
                            
                        </div>
                        <!--end::Col-->

                        <!--begin::Payment Method-->
                        @if($carts->isNotEmpty())
                            <div class="m-0" id="outcheck">
                                <!--begin::Actions-->
                                <button class="btn btn-primary fs-4 w-100 py-4 xtp">Buat Pesanan</button>
                                <!--end::Actions-->
                            </div>
                        @endif
                        <!--end::Payment Method-->
                    </div>
                    <!--end: Card Body-->
                </div>
                <!--end::Pos order-->
            </div>
            <!--end::Sidebar-->
        </div>

    </div>
    <!--end::Content container-->



    <!--begin::Footer-->
    @include('layouts.guest.footer')
    <!--end::Footer-->

    @push('js')
    <!--begin::(custome js))-->
    <script src="{{ url('pages/js/cart.js') }}"></script>
    <script src="{{ url('pages/js/onsite.js') }}"></script>
    <script>
        function toggleShippingDetails() {
            const useShippingCheckbox = document.getElementById('use_shipping_checkbox');
            const shippingDetails = document.getElementById('shipping-details');
    
            if (useShippingCheckbox.checked) {
                shippingDetails.style.display = '';
            } else {
                shippingDetails.style.display = 'none';
            }
        }
    
        document.addEventListener('DOMContentLoaded', function () {
            const useShippingCheckbox = document.getElementById('use_shipping_checkbox');
            if (useShippingCheckbox) {
                useShippingCheckbox.addEventListener('change', toggleShippingDetails);
                toggleShippingDetails();
            }
        });
    
        document.getElementById('search-input').addEventListener('keyup', function() {
            var searchQuery = this.value.toLowerCase();
            var products = document.querySelectorAll('.productadd-item');
    
            products.forEach(function(product) {
                var productName = product.getAttribute('data-product-name').toLowerCase();
                
                if (productName.includes(searchQuery)) {
                    product.style.display = ''; 
                } else {
                    product.style.display = 'none';
                }
            });
        });
    </script>
    
    <!--end::-->
    @endpush
</x-guest-layout>
