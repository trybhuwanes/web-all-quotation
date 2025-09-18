<!--begin::Form-->
<form id="kt_report_setting_form" class="form" action="">
    <!--begin::Table-->
    <table class="table table-striped align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <!--begin::Table head-->
        <thead>
            <!--begin::Table row-->
            <tr class="text-center fw-bold fs-7 text-uppercase gs-0">
                <th class="w-10px ps-2 text-center">No.</th>
                <th class="min-w-100px text-center">Produk</th>
                <th class="min-w-100px text-center">Img Product</th>
                <th class="min-w-100px text-center">Thumbnail</th>
                <th class="min-w-100px text-center">Kategori</th>
                <th class="min-w-100px text-center">Aksi</th>
            </tr>
            <!--end::Table row-->
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="text-gray-600 fw-semibold">
            <!--begin::Table row-->
            @foreach ($products as $product)
                <tr id="row-{{ str_replace(' ', '-', $product->key) }}">

                    <!--begin::Iteration-->
                    <td>
                        <div class="text-center">
                            <span class="text-gray-800 text-hover-primary mb-1">
                                {{ $loop->iteration }}.
                            </span>
                        </div>
                    </td>
                    <!--end::Iteration-->

                    <!--begin::Name Product-->
                    <td>
                        <div class="d-flex justify-content-start flex-column">
                            <a href="" class="text-gray-900 fw-bold mb-1 fs-6">{{ $product->nama_produk}}</a>
                        </div>
                    </td>
                    <!--end::Name Product-->

                    {{-- <!--begin::Prince-->
                    <td>
                        <div class="d-flex justify-content-start flex-column">
                            <a href="" class="text-gray-900 fw-bold mb-1 fs-6"> @idr($product->harga) </a>
                        </div>
                    </td>
                    <!--end::Prince--> --}}

                    <!--begin::Galery-->
                    <td>
                        <div class="d-flex align-items-center">
                            <!--begin::Galery-->
                            @if ($product->getMedia('product-gallery') != null)
                                <a href="" class="symbol symbol-50px">
                                    @foreach($product->getMedia('product-gallery') as $gallery)
                                        <img class="symbol-label" src="{{ $gallery->getUrl() }}" alt="{{ $gallery->name }}">
                                    @endforeach
                                </a>
                            @else
                                <p>-</p>
                            @endif
                            <!--end::Galery-->
                        </div>
                    </td>
                    <!--end::Galery-->

                    <!--begin::Thumbnail-->
                    <td>
                        <div class="d-flex align-items-center">
                            <!--begin::Thumbnail-->
                            @if($product->getFirstMediaUrl('product-thumbnail') != null)
                                <a href="" class="symbol symbol-50px">
                                    <img class="symbol-label" src="{{ $product->getFirstMediaUrl('product-thumbnail') }}" alt="thumbnail-product-grinviro">
                                </a>
                            @else
                                <p>No Images</p>
                            @endif
                            <!--end::Thumbnail-->
                        </div>
                    </td>
                    <!--end::Thumbnail-->

                    <!--begin::Kategori-->
                    <td>
                        <div class="d-flex justify-content-start flex-column">
                            <a href="#" class="text-gray-900 fw-bold mb-1 fs-6">{{ $product->categoryProducts->nama_kategori}}</a>                                </a>
                        </div>
                    </td>
                    <!--end::Kategori-->

                    <!--begin::Button value-->
                    <td class="text-end">
                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            Actions
                            <i class="fa-solid fa-caret-down fs-5 ms-1"></i>
                        </a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item Button Edit-->
                            <div class="menu-item px-3">
                                <a href="{{ route('product.edit', $product->uuid) }}" class="edit menu-link px-3" 
                                data-kt-user-id="{{ $product->id }}" 
                                data-kt-user-name="{{ $product->nama_produk }}" 
                                data-kt-user-logo="{{ $product->thumnail }}"
                                data-kt-user-harga="{{ $product->harga }}" 
                                data-kt-user-categori="{{ $product->category_id }}" 
                                data-kt-user-deskripsi="{{ $product->deskripsi_product }}">
                                    {{ __('common.btn_edit') }}
                                </a>
                            </div>
                            <!--begin::Menu item Button Edit-->
                            
                            <!--begin::Menu item Button Delete-->
                            <div class="menu-item px-3">
                                <a href="{{ route('product.show', $product->uuid) }}" class="show menu-link px-3" 
                                data-kt-user-id="{{ $product->id }}" 
                                data-kt-user-name="{{ $product->nama_produk }}" 
                                data-kt-user-logo="{{ $product->thumnail }}"
                                data-kt-user-harga="{{ $product->harga }}" 
                                data-kt-user-categori="{{ $product->category_id }}" 
                                data-kt-user-deskripsi="{{ $product->deskripsi_product }}">
                                    {{ __('common.btn_detail') }}
                                </a>
                            </div>
                            <!--begin::Menu item Button Delete-->

                            
                        </div>
                        <!--end::Menu-->
                    </td>
                    <!--end::Button value-->
                </tr>
            @endforeach
            <!--end::Table row-->
        </tbody>
        <!--end::Table body-->
        <tfoot>
            {{-- <tr>
                <th colspan="4">
                    <button type="submit" class="btn btn-primary float-end" data-kt-settings-action="submit">
                        <span class="indicator-label">{{ __('common.btn_save_x', ['x' => __('fields.pengaturan')]) }}</span>
                        <span class="indicator-progress">
                            {{ __('common.please_wait') }}...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </th>
            </tr> --}}
        </tfoot>
    </table>
    <!--end::Table-->
</form>
<!--end::Form-->
<!--begin::Pagination-->
{{ $products->links('components.pagination.bootstrap-5') }}
<!--end::Pagination-->


{{-- @push('js')
    <script>
        $(document).ready(function() {
            var jabatan = document.querySelectorAll('[data-kt-group="position_id"]');;
            jabatan.forEach(function(value, key) {
                $(value).select2({
                    ajax: {
                        url: route('select2.management-position'),
                        dataType: "json",
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term, // search term
                                page: params.page,
                            };
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;

                            return {
                                results: data,
                                pagination: {
                                    more: params.page * 10 < data.total_count,
                                },
                            };
                        },
                        cache: true,
                    },
                    dropdownParent: "#kt_add_setting_form",
                })
            })
        })
    </script>
@endpush --}}
