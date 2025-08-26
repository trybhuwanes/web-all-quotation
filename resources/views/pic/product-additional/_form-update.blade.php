<div id="kt_form_create_product">
    <form id="kt_create_product_form" class="form d-flex flex-column flex-lg-row" action="" method="POST" enctype="multipart/form-data" class="form">
        <!--begin::Aside column-->
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
            <!--begin::Thumbnail settings-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h5>Thumbnail Product additional</h5>
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
                        <div id="change-file-thumb" class="image-input-wrapper w-150px h-150px" style="background-image: url('{{ $additionalproducts->getFirstMediaUrl('additional-product-thumbnail') }}')"></div>
                        <!--end::Preview existing avatar-->

                        <!--begin::Label-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Upload thumbnail" style="display: none;">
                            <i class="bi bi-pencil-fill fs-7" ></i>
                            <!--begin::Inputs-->
                            <input id="file-thumb" type="file" name="avatar" accept=".png, .jpg, .jpeg .webp" disabled/>
                            <input type="hidden" name="avatar_remove" />
                            <!--end::Inputs-->
                        </label>
                        <!--end::Label-->

                        <!--begin::Cancel-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel thumbnail">
                            <i class="bi bi-x fs-2"></i>
                        </span>
                        <!--end::Cancel-->

                        <!--begin::Remove-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove thumbnail">
                            <i class="bi bi-x fs-2"></i>
                        </span>
                        <!--end::Remove-->
                    </div>
                    <!--end::Image input-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Tetapkan gambar mini produk tambahan. Hanya file gambar .webp .png, .jpg dan .jpeg yang diterima</div>
                    <!--end::Description-->
                    <span id="error-logo" class="fv-plugins-message-container invalid-feedback"></span>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Thumbnail settings-->

            <!--begin::Template settings-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>Product Category</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Select store template-->
                    <label for="kt_ecommerce_add_product_store_template" class="form-label">Pilih kategori Produk</label>
                    <!--end::Select store template-->
                    
                    <!--begin::Select2-->
                    <input type="hidden" id="current-product" value="{{ $additionalproducts->product_id ? json_encode(App\Models\Product::find($additionalproducts->product_id)) : '' }}">
                    <select id="product-main" name="product_main" class="form-select mb-2" data-control="select2" data-hide-search="true"
                    data-placeholder="Select an option" disabled>
                    <option></option>
                    </select>
                    <span id="error-product-main" class="fv-plugins-message-container invalid-feedback"></span>
                    <!--end::Select2-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Tentukan kategori product tersebut.</div>
                    <!--end::Description-->
                    <span id="error-product-main" class="fv-plugins-message-container invalid-feedback"></span>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Template settings-->

        </div>
        <!--end::Aside column-->

        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">



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
                                    <h2>Form Edit Produk Tambahan</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">Nama Produk Tambahan</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" id="product-additional-name" name="product-name" class="form-control mb-2"
                                        placeholder="Product name" value="{{$additionalproducts->nama_produk_tambahan}}" disabled/>
                                    <input type="hidden"  id="additionalproductid" value="{{$additionalproducts->id}}"/>
                                    <!--end::Input-->

                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Nama produk wajib diisi, dan sebaiknya bersifat unik.</div>
                                    <!--end::Description-->
                                    <span id="error-product-additional-name" class="fv-plugins-message-container invalid-feedback"></span>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">Harga Produk Tambahan (Rp.)</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" id="product-additional-price" name="product-price" class="form-control mb-2"
                                        placeholder="Harga produk" value="{{$additionalproducts->harga_produk_tambahan}}" />
                                    <!--end::Input-->

                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Tetapkan harga produk.</div>
                                    <!--end::Description-->
                                    <span id="error-product-additional-price" class="fv-plugins-message-container invalid-feedback"></span>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ __('Deskripsi') }}</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <textarea id="product-additional-description" class="form-control mb-2" rows="3" name="description"
                                        placeholder="Deskripsi Product">{{$additionalproducts->deskripsi_produk_tambahan}}</textarea>
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Tetapkan deskripsi produk untuk visibilitas yang lebih
                                        baik.
                                    </div>
                                    <!--end::Description-->
                                    <span id="error-product-additional-description" class="fv-plugins-message-container invalid-feedback"></span>
                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::General options-->
                        
                    </div>
                </div>
                <!--end::Tab pane-->
            </div>
            <!--end::Tab content-->

            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                <a href="{{ route('product-additional.index') }}" id="kt_ecommerce_add_product_cancel"
                    class="btn btn-danger me-5">
                    Batal
                </a>
                <!--end::Button-->

                <!--begin::Button-->
                <button type="submit" data-kt-product-action="submit" class="btn btn-primary" >
                    <span class="indicator-label">
                        Simpan
                    </span>
                    <span class="indicator-progress">
                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
                <!--end::Button-->
            </div>
        </div>
        <!--end::Main column-->

    </form>
</div>



<!--end::Form-->
