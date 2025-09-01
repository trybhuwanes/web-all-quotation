<div id="kt_form_create_product">
    <form id="kt_create_product_form" class="form d-flex flex-column flex-lg-row" action="javascript:;" enctype="multipart/form-data" class="form">
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
                        <div class="image-input-wrapper w-150px h-150px"></div>
                        <!--end::Preview existing avatar-->

                        <!--begin::Label-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Upload thumbnail">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            <!--begin::Inputs-->
                            <input id="file-thumb" type="file" name="avatar" accept=".png, .jpg, .jpeg .webp"/>
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
                    <div class="text-muted fs-7">Tetapkan gambar mini produk tambahan. Hanya file gambar .webp .png, .jpg dan .jpeg
                        yang diterima</div>
                    <!--end::Description-->
                    <span id="error-file-thumb" class="fv-plugins-message-container invalid-feedback"></span>
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
                        <h2>Product Main</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Select store template-->
                    <label for="kt_ecommerce_add_product_store_template" class="form-label">Pilih Produk Utama/Main</label>
                    <!--end::Select store template-->

                    <!--begin::Select2-->
                    {{-- <input type="hidden" id="kategori-barang" value="{{ $product->category_id ? json_encode(App\Models\Category_product::find($product->category_id)) : '' }}"> --}}
                    <select id="product-main" name="kategori_barang" class="form-select mb-2" data-control="select2" data-hide-search="true"
                    data-placeholder="Select an option">
                    <option></option>
                    </select>
                    <!--end::Select2-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Tentukan product tersebut.</div>
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
                                    <h2>Form Produk Tambahan</h2>
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
                                        placeholder="Product name" value="" />
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
                                        placeholder="Harga produk" value="" />
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
                                        placeholder="Deskripsi Product"></textarea>
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Tetapkan deskripsi produk untuk visibilitas yang lebih baik.
                                    </div>
                                    <!--end::Description-->
                                    <span id="error-product-additional-description" class="fv-plugins-message-container invalid-feedback"></span>
                                </div>
                                <!--end::Input group-->
                                
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::General options-->
                        
                        {{-- <!--begin::Media-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Galery Product</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="fv-row mb-2">
                                    <!--begin::Dropzone-->
                                    <div class="dropzone" id="kt_modal_create_product_galery">
                                        <!--begin::Message-->
                                        <div class="dz-message needsclick align-items-center">
                                            <!--begin::Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/files/fil010.svg-->
                                            <span class="svg-icon svg-icon-3hx svg-icon-primary">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z" fill="currentColor" />
                                                    <path d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z" fill="currentColor" />
                                                    <path d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z" fill="currentColor" />
                                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <!--end::Icon-->
                                            <!--begin::Info-->
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bold text-gray-900 mb-1">{{ __('fields.click_upload_photo') }}.</h3>
                                                <span class="fw-semibold fs-7 text-gray-400">{{ __('fields.upload_3_files') }}</span>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                    </div>
                                    <!--end::Dropzone-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7">Atur galeri media produk.</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Card header-->
                            <span id="error-upload-photo" class="fv-plugins-message-container invalid-feedback"></span>
                        </div>
                        <!--end::Media--> --}}

                    </div>
                </div>
                <!--end::Tab pane-->



            </div>
            <!--end::Tab content-->

            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                <a href="/metronic8/demo1/apps/ecommerce/catalog/products.html" id="kt_ecommerce_add_product_cancel"
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
