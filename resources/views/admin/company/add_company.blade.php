<x-app-layout>
    
    @slot('title')
        {{ __('Tambah Perusahaan') }}
    @endslot
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            
            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar pb-3 pt-8">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                    <!--begin::Toolbar wrapper-->
                    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                        <!--begin::Back Button-->
                        <a href="{{ route('company.index') }}" class="btn btn-icon btn-light btn-active-light-primary">
                            <i class="ki-duotone ki-left-square fs-3x">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>
                        <!--end::Back Button-->

                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        </div>
                        <!--end::Page title-->
                    </div>
                    <!--end::Toolbar wrapper-->
                </div>
                <!--end::Toolbar container-->
            </div>
            <!--end::Toolbar-->

            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <x-auth-session-status :status="session('status')" />
                    <div id="kt_form_create_product">
                        <form id="kt_create_product_form" class="form d-flex flex-column flex-lg-row" action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!--begin::Aside column-->
                            <div class="gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                                <!--begin::Thumbnail settings-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Logo</h2>
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
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Upload logo">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <!--begin::Inputs-->
                                                <input id="file-thumb" type="file" name="logo" accept=".png, .jpg, .jpeg .webp"/>
                                                <input type="hidden" name="avatar_remove" />
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Cancel-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel logo">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::Cancel-->

                                            <!--begin::Remove-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove logo">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <!--end::Remove-->
                                        </div>
                                        <!--end::Image input-->

                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Tetapkan gambar mini produk. Hanya file gambar .webp .png, .jpg dan .jpeg
                                            yang diterima</div>
                                        <!--end::Description-->
                                        <span id="error-file-thumb" class="fv-plugins-message-container invalid-feedback"></span>
                                        <!-- error message untuk price -->
                                        @error('logo')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Thumbnail settings-->
                            </div>
                            <!--end::Aside column-->
                            
                            <!--begin::Main column-->
                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                <!--begin::Tab content-->
                                <div class="tab-content">
                                    <!--begin::Tab pane-->
                                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                             <!--begin::Spesifikasi Deskripsi-->
                                             <div class="card card-flush py-4">
                                                <!--begin::Card header-->
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h2>{{ __('Form Tambah Perusahaan') }}</h2>
                                                    </div>
                                                </div>
                                                <!--end::Card header-->
                                                <!--begin::Card body-->
                                                <div class="card-body border-top p-9">
                                                    <!--begin::Input group-->
                                                    <div class="row mb-1">
                                                        <!--begin::Label-->
                                                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">Nama Perusahaan</label>
                                                        <!--end::Label-->
                                                        <!--begin::Col-->
                                                        <div class="col-lg-9 fv-row">
                                                            <input type="text" id="company" name="company" class="form-control form-control-sm form-control-solid" placeholder="Masukan nama perusahaan" 
                                                            {{-- value="{{$us->company}}"  --}}
                                                            />
                                                            <span id="company-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
                                                            <!-- error message untuk price -->
                                                            @error('company')
                                                                <div class="alert alert-danger mt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row mb-1">
                                                        <!--begin::Label-->
                                                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">Email</label>
                                                        <!--end::Label-->
                                                        <!--begin::Col-->
                                                        <div class="col-lg-9 fv-row">
                                                            <input type="text" id="email" name="email" class="form-control form-control-sm form-control-solid" placeholder="Masukan email" 
                                                            {{-- value="{{$us->email}}"  --}}
                                                            autocomplete="off"/>
                                                            <span id="email-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
                                                            <!-- error message untuk price -->
                                                            @error('email')
                                                                <div class="alert alert-danger mt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                     <!--begin::Input group-->
                                                     <div class="row mb-1">
                                                        <!--begin::Label-->
                                                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">Nomer Telepon</label>
                                                        <!--end::Label-->
                                                        <!--begin::Col-->
                                                        <div class="col-lg-9 fv-row">
                                                            <input type="text" id="notelpon" name="phone" class="form-control form-control-sm form-control-solid" placeholder="Masukan nomer telepon" 
                                                            {{-- value="{{$us->phone}}"  --}}
                                                            />
                                                            <span id="notelpon-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>

                                                            <!-- error message untuk price -->
                                                            @error('phone')
                                                                <div class="alert alert-danger mt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <!--end::Col-->

                                                        
                                                    </div>
                                                    <!--end::Input group-->
                                                    
                                                    

                                                    <!--begin::Input group-->
                                                    <div class="row mb-1">
                                                        <!--begin::Label-->
                                                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">Lokasi Perusahaan</label>
                                                        <!--end::Label-->
                                                        <!--begin::Col-->
                                                        <div class="col-lg-9 fv-row">
                                                            <input type="text" id="location_company" name="address" class="form-control form-control-sm form-control-solid" placeholder="Masukan lokasi perusahaan" 
                                                            {{-- value="{{$us->location_company}}"  --}}
                                                            />
                                                            <span id="location-company-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
                                                            <!-- error message untuk price -->
                                                            @error('address')
                                                                <div class="alert alert-danger mt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Card body-->
                                            </div>
                                            <!--end::Spesifikasi Deskripsi-->
                                        </div>
                                    </div>
                                    <!--end::Tab pane-->
                                </div>
                                <!--end::Tab content-->
                    
                                <div class="d-flex justify-content-end">
                                    <!--begin::Button-->
                                    <a href="" id="kt_ecommerce_add_product_cancel"
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

                    
                </div>
                <!--end::Content container-->

            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
        <!--begin::Footer-->
        @include('layouts._footer')
    </div>
    <!--end:::Main-->

    @push('js')        
        <!--begin::Cust Javascript-->
        {{-- <script src="{{ url('pages/js/user_manage/form-update.js') }}"></script> --}}
        {{-- <script src="{{ url('pages/js/user_manage/signin-methods.js') }}"></script> --}}
        <!--end::Cust Javascript-->
    
    @endpush
</x-app-layout>

