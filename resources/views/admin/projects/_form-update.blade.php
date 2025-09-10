<div id="kt_form_create_project">
    <form id="kt_create_project_form" class="form d-flex flex-column flex-lg-row" action="" method="POST" enctype="multipart/form-data" class="form">
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade show active" id="kt_ecommerce_add_project_general" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">

                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Edit Projek</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body pilih produk-->
                            <div class="card-body pt-0">
                                <!--begin::Select store template-->
                                <label for="kt_ecommerce_add_project_store_template" class="form-label">Pilih Produk</label>
                                <!--end::Select store template-->

                                <!--begin::Select2-->
                                <input type="hidden" id="current-category" value="{{ $projects->product_id ? json_encode(App\Models\Product::find($projects->product_id)) : '' }}">
                                <select id="product" name="product_id" class="form-select mb-2" data-control="select2" data-hide-search="true">
                                    <option value="{{ $projects->product->id }}" selected>
                                        {{ $projects->product->nama_produk }}
                                    </option>
                                </select>
                                <span id="error-project-category" class="fv-plugins-message-container invalid-feedback"></span>
                                <!--end::Select2-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7">Tentukan tipe project tersebut.</div>
                                <!--end::Description-->
                                <span id="error-project-category" class="fv-plugins-message-container invalid-feedback"></span>
                            </div>
                            <!--end::Card body pilih produk-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">Nama Perusahaan</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" id="company-name" name="company_name" class="form-control mb-2"
                                        placeholder="Company name" value="{{$projects->company_name }}" />
                                    <input type="hidden"  id="projectid" value="{{$projects->id}}"/>
                                    <!--end::Input-->

                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Nama perusahaan wajib diisi</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Label-->
                                <label class="form-label">{{ __('Deskripsi') }}</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <span id="error-project-description"
                                        class="fv-plugins-message-container invalid-feedback"></span>
                                <input type="hidden" name="description" value="" id="deskripsiContent">
                                <div id="deskripsi_editor" class="bg-transparent border-0 h-250px px-3"></div>
                                <!--end::Input-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7">Deskripsi projek tidak wajib diisi</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::General options-->

                        <!--begin::Media-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Galery Project</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="fv-row mb-2">
                                    <!--begin::Dropzone-->
                                    {{-- <input type="file" name="files[]" multiple> --}}
                                    <div class="dropzone" id="kt_modal_create_project_galery">
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
                                <div class="text-muted fs-7">Atur galeri media projek.</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Card header-->
                            <span id="error-upload-photo" class="fv-plugins-message-container invalid-feedback"></span>
                        </div>
                        <!--end::Media-->

                        
                    </div>
                </div>
                <!--end::Tab pane-->

            </div>
            <!--end::Tab content-->

            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                <a href="{{route('admin.dashboard')}}" id="kt_ecommerce_add_project_cancel"
                    class="btn btn-danger me-5">
                    Batal
                </a>
                <!--end::Button-->

                <!--begin::Button-->
                <button type="submit" data-kt-project-action="submit" class="btn btn-primary" >
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
