<div id="kt_form_create_product">
    <div id="kt_create_product_form" class="d-flex flex-column flex-lg-row">
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
                                        Jenis Produk
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-10 d-flex align-items-center">
                                        <span
                                            class="badge badge-success">{{ $projects->product->nama_produk }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Company name-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-2 fw-semibold text-muted">
                                        Nama Perusahaan
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-10 d-flex align-items-center">
                                        <span>{{ $projects->company_name }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Company name-->

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
                                                Silakan tinjau perubahan untuk memastikan semua informasi sesuai dengan yang diharapkan.</div>
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
                                    <h2>Deskripsi</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="row mb-5">
                                    <!--begin::Col-->
                                    <div class="col-lg-12">
                                        {!! $projects->description !!}
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
                                    @foreach($projects->getMedia('project-gallery') as $gallery)
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
