<div id="kt_form_create_product">
    <div id="kt_create_product_form" class="d-flex flex-column flex-lg-row">
        <!--begin::Aside column-->
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
            <!--begin::Thumbnail settings-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>{{ $product->nama_produk }}</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body text-center pt-0">
                    <!--begin::Image input-->
                    <!--begin::Image input placeholder-->
                    <style>
                        .image-input-placeholder {
                            background-image: url('/template/assets/media/svg/files/blank-image.svg');
                        }

                        [data-bs-theme="dark"] .image-input-placeholder {
                            background-image: url('/template/assets/media/svg/files/blank-image-dark.svg');
                        }
                    </style>
                    <!--end::Image input placeholder-->

                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                        data-kt-image-input="true">
                        <!--begin::Preview existing avatar-->
                        <div id="change-file-thumb" class="image-input-wrapper w-200px h-200px"
                            style="background-image: url('{{ $product->getFirstMediaUrl('product-thumbnail') }}')">
                        </div>
                        <!--end::Preview existing avatar-->
                    </div>
                    <!--end::Image input-->


                    <span id="error-logo" class="fv-plugins-message-container invalid-feedback"></span>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Thumbnail settings-->
        </div>
        <!--end::Aside column-->




        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

            <!--begin:::Tabs-->
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                {{-- <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                        href="#kt_ecommerce_add_product_general">Detail</a>
                </li>
                <!--end:::Tab item--> --}}

                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                        href="#kt_ecommerce_add_product_general">Detail</a>
                </li>
                <!--end:::Tab item-->

                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                        href="#kt_ecommerce_add_product_advanced">Foto Project</a>
                </li>
                <!--end:::Tab item-->

                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                        href="#kt_ecommerce_add_product_type">Semua Tipe</a>
                </li>
                <!--end:::Tab item-->
            </ul>
            <!--end:::Tabs-->


            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">

                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Detail</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">

                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-2 fw-semibold text-muted">
                                        Kategori Produk
                                        <span class="ms-1" data-bs-toggle="tooltip" title="">
                                            <i class="fa-solid fa-info fs-7"></i>
                                        </span>
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-10 d-flex align-items-center">
                                        <span
                                            class="badge badge-success">{{ $product->categoryProducts->nama_kategori }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                {{-- <!--begin::Row-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-2 fw-semibold text-muted">Harga</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-10">
                                        <span class="fw-bold fs-6 text-gray-800">@idr($product->harga)</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row--> --}}





                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-2 fw-semibold text-muted">Deskripsi</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-10 fv-row">
                                        <span
                                            class="fw-semibold text-gray-800 fs-6">{{ $product->deskripsi_produk }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->




                                <!--begin::Notice-->
                                <div
                                    class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6">
                                    <!--begin::Icon-->
                                    <i class="fa-solid fa-info fs-2tx text-warning me-4"></i>
                                    <!--end::Icon-->

                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-grow-1 ">
                                        <!--begin::Content-->
                                        <div class=" fw-semibold">
                                            <h4 class="text-gray-900 fw-bold">Catatan!</h4>

                                            <div class="fs-6 text-gray-700 ">
                                                Silakan tinjau perubahan untuk memastikan semua informasi sesuai dengan yang diharapkan. Jika ada kesalahan atau perubahan lebih lanjut yang diperlukan, Admin dapat mengedit produk kapan saja melalui halaman manajemen produk.<a class="fw-bold"
                                                    href="/metronic8/demo39/account/billing.html"> Perlu Bantuan</a>.</div>
                                        </div>
                                        <!--end::Content-->

                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Notice-->



                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::General options-->


                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Ringkasan</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="row mb-5">
                                    <!--begin::Col-->
                                    <div class="col-lg-12">
                                        {!! $product->ringkasan_deskripsi !!}
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::General options-->

                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Spesifikasi</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="row mb-5">
                                    <!--begin::Col-->
                                    <div class="col-lg-12">
                                        {!! $product->spesifikasi_deskripsi !!}
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::General options-->



                    </div>
                </div>
                <!--end::Tab pane-->

                <!--begin::Tab pane-->
                <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">

                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Image Product</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">

                                <!--begin::Row-->
                                <div class="row g-10">
                                    <!-- Looping untuk setiap gambar dari gallery -->
                                    @foreach($product->getMedia('product-gallery') as $gallery)
                                        <!--begin::Col-->
                                        <div class="col-lg-6">
                                            <!--begin::Item-->
                                            <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="{{ $gallery->getUrl() }}">
                                                <!--begin::Image-->
                                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px"
                                                    style="background-image:url('{{ $gallery->getUrl() }}')">
                                                </div>
                                                <!--end::Image-->

                                                <!--begin::Action-->
                                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                    <i class="ki-duotone ki-eye fs-3x text-white"><span class="path1"></span><span
                                                            class="path2"></span><span class="path3"></span></i>
                                                </div>
                                                <!--end::Action-->
                                            </a>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Col-->
                                    @endforeach
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::General options-->



                    </div>
                </div>
                <!--end::Tab pane-->


                <!--begin::Tab pane-->
                <div class="tab-pane fade" id="kt_ecommerce_add_product_type" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">

                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Heading-->
                                <div class="card-title">
                                    <h3>Semua Tipe</h3>
                                </div>
                                <!--end::Heading-->
                        
                                <!--begin::Toolbar-->
                                <div class="card-toolbar">
                                    <a href="javascript:;" class="new btn btn-sm btn-primary my-1" data-kt-user-id="{{ $product->uuid }}"> +
                                        Tipe Baru
                                    </a>
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Card header-->
                        
                            <!--begin::Card body-->
                            <div class="card-body">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <form id="kt_report_setting_form" class="card form" action="">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 " id="kt_table_users">
                                            <!--begin::Table head-->
                                            <thead>
                                                <!--begin::Table row-->
                                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="w-10px pe-2">No.</th>
                                                    <th class="min-w-100px">Tipe</th>
                                                    <th class="min-w-100px">Harga</th>
                                                    <th class="min-w-100px text-end">Aksi</th>
                                                </tr>
                                                <!--end::Table row-->
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody class="text-gray-600 fw-semibold">
                                                <!--begin::Table row-->
                                                @foreach ($productType as $item)
                                                    <tr id="row-{{ str_replace(' ', '-', $item->key) }}">
                                    
                                                        <!--begin::Iteration-->
                                                        <td>
                                                            <span class="text-gray-800 text-hover-primary mb-1">
                                                                {{ $loop->iteration }}.
                                                            </span>
                                                        </td>
                                                        <!--end::Iteration-->
                                    
                                                        <!--begin::Name kategori-->
                                                        <td>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#" class="text-gray-900 fw-bold mb-1 fs-6">{{ $item->type_name}}</a>
                                                            </div>
                                                        </td>
                                                        <!--end::Name kategori-->
                                    
                                                        <!--begin::Logo-->
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <span class="text-gray-900 fw-bold mb-1 fs-6">@idr($item->harga)</span>
                                                                <!--begin::Thumbnail-->
                                                                {{-- @if($kategoriproduct->getFirstMediaUrl('category-product-logo') != null)
                                                                    <a href="" class="symbol symbol-50px">
                                                                        <img class="symbol-label" src="{{$kategoriproduct->getFirstMediaUrl('category-product-logo') }}" alt="logo-product-kategori">
                                                                    </a>
                                                                @else
                                                                    <p>No Images</p>
                                                                @endif --}}
                                                                <!--end::Thumbnail-->
                                                            </div>
                                                        </td>
                                                        <!--end::Logo-->
                                    
                                                        <!--begin::Button value-->
                                                        <td class="text-end">
                                                            <a href="javascript:;" class="edit menu-link px-3 btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" 
                                                                data-kt-user-id="{{ $product->uuid }}"
                                                                data-kt-tipe-id="{{ $item->id }}"
                                                                data-kt-user-deskripsi="{{ $item->deskripsi }}">
                                                                {{ __('common.btn_edit') }} Tipe
                                                            </a>
                                                                
                                                            
                                                            <!--begin::Menu-->
                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                                
                                                                <!--begin::Menu item Button Edit-->
                                                                {{-- <div class="menu-item px-3">
                                                                    
                                                                </div> --}}
                                                                <!--begin::Menu item Button Edit-->
                                                                
                                                                <!--begin::Menu item Button Delete-->
                                                                {{-- <div class="menu-item px-3">
                                                                    
                                                                </div> --}}
                                                                <!--begin::Menu item Button Delete-->
                                    
                                                                <!--begin::Menu item Button Show-->
                                                                {{-- <div class="menu-item px-3">
                                                                    
                                                                </div> --}}
                                                                <!--begin::Menu item Button Show-->
                                    
                                                                
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

                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Card body-->
                        </div>




                        <!--begin::Form-->

<!--end::Form-->
<!--begin::Pagination-->
{{-- {{ $kategori->links('components.pagination.bootstrap-5') }} --}}
<!--end::Pagination-->







                    </div>
                </div>
                <!--end::Tab pane-->
            </div>
            <!--end::Tab content-->

            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                {{-- <a href="/template/apps/ecommerce/catalog/products.html" id="kt_ecommerce_add_product_cancel"
                    class="btn btn-danger me-5">
                    Kembali
                </a> --}}
                <!--end::Button-->
            </div>
        </div>
        <!--end::Main column-->



        <!--end::Form-->
