<x-app-layout>
    
    @slot('title')
        {{ __('Edit Pengguna') }}
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
                        <a href="{{ route('alluser.index') }}" class="btn btn-icon btn-light btn-active-light-primary">
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
                        <form id="kt_create_product_form" class="form d-flex flex-column flex-lg-row" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!--begin::Aside column-->
                            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-5 me-lg-5">
                                <!--begin::Thumbnail settings-->
                                <div class="card card-flush py-2">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Detail Pengguna</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    
                                     <!--begin::Card body-->
                                    <div class="card-body p-5">
                                        <!--begin::Row-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-lg-6 fw-semibold text-muted">Peranan</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">                    
                                                <span class="badge badge-light-success text-uppercase">: {{$us->role}}</span>              
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->

                                        <!--begin::Row-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-lg-6 fw-semibold text-muted">Terdaftar</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">:
                                                {{  App\Helpers\Helper::dateFormat($us->created_at, 'd-m-Y H:i') }}              
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                        
                                        <!--begin::Row-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-lg-6 fw-semibold text-muted">Diperbarui</label>
                                            <!--end::Label-->
                                            
                                            <!--begin::Col-->
                                            <div class="col-lg-6">:
                                                {{  App\Helpers\Helper::dateFormat($us->updated_at, 'd-m-Y H:i') }}              
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->

                                        <div class="py-10 text-center">
                                            <img src="/template/assets/media/svg/illustrations/easy/1.svg" class="theme-light-show w-200px" alt="">
                                            <img src="/template/assets/media/svg/illustrations/easy/1-dark.svg" class="theme-dark-show w-200px" alt="">
                                    </div>
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
                                                        <h2>{{ __('Form Ubah Data Pengguna') }}</h2>
                                                    </div>
                                                </div>
                                                <!--end::Card header-->
                                                <!--begin::Card body-->
                                                <div class="card-body border-top p-9">

                                                    <!--begin::Input group-->
                                                    <div class="row mb-1">
                                                        <!--begin::Label-->
                                                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">Nama Lengkap</label>
                                                        <!--end::Label-->
                                                        <!--begin::Col-->
                                                        <div class="col-lg-9 fv-row">
                                                            <input id="nama" type="text" name="nama" class="form-control form-control-sm form-control-solid" placeholder="Masukan nama lengkap" value="{{$us->name}}" />
                                                            <span id="nama-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
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
                                                            <input type="text" id="email" name="email" class="form-control form-control-sm form-control-solid" placeholder="Masukan email" value="{{$us->email}}" autocomplete="off"/>
                                                            <span id="email-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                     <!--begin::Input group-->
                                                     <div class="row mb-1">
                                                        <!--begin::Label-->
                                                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">Nomer Telpon</label>
                                                        <!--end::Label-->
                                                        <!--begin::Col-->
                                                        <div class="col-lg-9 fv-row">
                                                            <input type="text" id="notelpon" name="notelpon" class="form-control form-control-sm form-control-solid" placeholder="Masukan nomer telpon" value="{{$us->phone}}" />
                                                            <span id="notelpon-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row mb-1">
                                                        <!--begin::Label-->
                                                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">Jabatan</label>
                                                        <!--end::Label-->
                                                        <!--begin::Col-->
                                                        <div class="col-lg-9 fv-row">
                                                            <input type="text" id="job_title" name="job_title" class="form-control form-control-sm form-control-solid" placeholder="Masukan jabatan" value="{{$us->job_title}}" />
                                                            <span id="job-title-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    
                                                    <!--begin::Input group-->
                                                    <div class="row mb-1">
                                                        <!--begin::Label-->
                                                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">Perusahaan</label>
                                                        <!--end::Label-->
                                                        <!--begin::Col-->
                                                        <div class="col-lg-9 fv-row">
                                                            <input type="text" id="company" name="company" class="form-control form-control-sm form-control-solid" placeholder="Masukan perusahaan" value="{{$us->company}}" />
                                                            <span id="company-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
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
                                                            <input type="text" id="location_company" name="location_company" class="form-control form-control-sm form-control-solid" placeholder="Masukan lokasi perusahaan" value="{{$us->location_company}}" />
                                                            <span id="location-company-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row mb-1">
                                                        <!--begin::Label-->
                                                        <label class="col-lg-3 col-form-label fw-semibold fs-6">Bidang Perusahaan</label>
                                                        <!--end::Label-->
                                                        <!--begin::Col-->
                                                        <div class="col-lg-9 fv-row">
                                                            <select name="field_company" id="field_company" data-control="select2" data-placeholder="Pilih bidang.." class="form-control form-control-sm form-control-solid">
                                                                <option value="">Pilih...</option>
                                                                <option value="Pertanian, Kehutanan, Perikanan">Pertanian, Kehutanan, Perikanan</option>
                                                                <option value="Pertambangan dan Penggalian">Pertambangan dan Penggalian</option>
                                                                <option value="Industri Pengolahan">Industri Pengolahan</option>
                                                                <option value="Treatment Air/Limbah">Treatment Air/Limbah</option>
                                                                <option value="Konstruksi">Konstruksi</option>
                                                                <option value="Pedagang Besar dan Eceran (Supplier)">Pedagang Besar dan Eceran (Supplier)</option>
                                                                <option value="Real Estate">Real Estate</option>
                                                                <option value="Pendidikan">Pendidikan</option>
                                                                <option value="Aktivitas Kesehatan">Aktivitas Kesehatan</option>
                                                                <option value="Asosiasi/NGO">Asosiasi/NGO</option>
                                                            </select>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row mb-1">
                                                        <!--begin::Label-->
                                                        <label class="col-lg-3 col-form-label fw-semibold fs-6">Detail Perusahaan</label>
                                                        <!--end::Label-->
                                                        <!--begin::Col-->
                                                        <div class="col-lg-9 fv-row">
                                                            <input type="text" id="detail_company" name="detail_company" class="form-control form-control-sm form-control-solid" placeholder="Masukan detil perusahaan" value="" autocomplete="off"/>
                                                            <span id="detail-company-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
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

                    <!--begin::Sign-in Method-->
                    <div class="card  mb-5 mb-xl-10"   >
                        <!--begin::Card header-->
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">{{__('Akun Masuk')}}</h3>
                            </div>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Content-->
                        <div id="kt_account_settings_signin_method" class="collapse show">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Email Address-->
                                <div class="d-flex flex-wrap align-items-center">
                                    <!--begin::Label-->
                                    <div id="kt_signin_email">
                                        <div class="fs-6 fw-bold mb-1">{{__('Email')}}</div>
                                        <div class="fw-semibold text-gray-600">{{$us->email}}</div>
                                    </div>
                                    <!--end::Label-->

                                    <!--begin::Edit-->
                                    <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                        <!--begin::Form-->
                                        <form id="kt_signin_change_email" class="form" novalidate="novalidate">
                                            <div class="row mb-6">
                                                <div class="col-lg-6 mb-4 mb-lg-0">
                                                    <div class="fv-row mb-0">
                                                        <label for="emailaddress" class="form-label fs-6 fw-bold mb-3">Masukan Alamat Email Baru</label>
                                                        <input type="email" class="form-control form-control-lg form-control-solid" id="emailaddress" placeholder="Email Address" name="emailaddress" value="{{$us->email}}" />
                                                        <span id="emailaddress-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="fv-row mb-0">
                                                        <label for="confirmemailpassword" class="form-label fs-6 fw-bold mb-3">Konfirmasi Kata Sandi</label>
                                                        <input type="password" class="form-control form-control-lg form-control-solid" name="confirmemailpassword" id="confirmemailpassword" />
                                                        <span id="confirmemailpassword-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <button id="kt_signin_submit" type="button" class="btn btn-primary  me-2 px-6">{{__('Update Email')}}</button>
                                                <button id="kt_signin_cancel" type="button" class="btn btn-color-gray-500 btn-active-light-primary px-6">{{__('Batal')}}</button>
                                            </div>
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Edit-->

                                    <!--begin::Action-->
                                    <div id="kt_signin_email_button" class="ms-auto">
                                        <button class="btn btn-light btn-active-light-primary">{{__('Ganti Email')}}</button>
                                    </div>
                                    <!--end::Action-->
                                </div>
                                <!--end::Email Address-->

                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-6"></div>
                                <!--end::Separator-->

                                <!--begin::Password-->
                                <div class="d-flex flex-wrap align-items-center mb-10">
                                    <!--begin::Label-->
                                    <div id="kt_signin_password">
                                        <div class="fs-6 fw-bold mb-1">{{__('Kata Sandi')}}</div>
                                        <div class="fw-semibold text-gray-600">************</div>
                                    </div>
                                    <!--end::Label-->

                                    <!--begin::Edit-->
                                    <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                        <!--begin::Form-->
                                        <form id="kt_signin_change_password" class="form" novalidate="novalidate">
                                            <div class="row mb-1">

                                                <div class="col-lg-6">
                                                    <input id="user-id" type="hidden" name="id" value="{{$us->id}}">
                                                    <div class="fv-row mb-0">
                                                        <label for="newpassword" class="form-label fs-6 fw-bold mb-3">{{__('Kata Sandi Baru')}}</label>
                                                        <input type="password" class="form-control form-control-lg form-control-solid " name="newpassword" id="newpassword" />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-6">
                                                    <div class="fv-row mb-0">
                                                        <label for="confirmpassword" class="form-label fs-6 fw-bold mb-3">{{__('Ulangi Kata Sandi Baru')}}</label>
                                                        <input type="password" class="form-control form-control-lg form-control-solid " name="confirmpassword" id="confirmpassword" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-text mb-5">Kata sandi harus minimal 8 karakter dan mengandung simbol</div>

                                            <div class="d-flex">
                                                <button id="kt_password_submit" type="button" class="btn btn-primary me-2 px-6">{{__('Update Password')}}</button>
                                                <button id="kt_password_cancel" type="button" class="btn btn-color-gray-500 btn-active-light-primary px-6">{{__('Batal')}}</button>
                                            </div>
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Edit-->

                                    <!--begin::Action-->
                                    <div id="kt_signin_password_button" class="ms-auto">
                                        <button class="btn btn-light btn-active-light-primary">Reset Password</button>
                                    </div>
                                    <!--end::Action-->
                                </div>
                                <!--end::Password-->

                                
                    <!--begin::Notice-->
                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed  p-6">
                                <!--begin::Icon-->
                            <i class="ki-duotone ki-shield-tick fs-2tx text-primary me-4"><span class="path1"></span><span class="path2"></span></i>        <!--end::Icon-->
                        
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                <!--begin::Content-->
                                <div class="mb-3 mb-md-0 fw-semibold">
                                    <h4 class="text-gray-900 fw-bold">Amankan Akun Anda!</h4>
                                    <div class="fs-6 text-gray-700 pe-7">Lindungi akun Anda dari akses tidak sah dengan memperbarui kata sandi secara berkala, dan menghindari penggunaan kata sandi yang mudah ditebak.</div>
                                </div>
                                <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->  
                    </div>
                    <!--end::Notice-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Sign-in Method-->
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
        <script src="{{ url('pages/js/user_manage/form-update.js') }}"></script>
        <script src="{{ url('pages/js/user_manage/signin-methods.js') }}"></script>
        <!--end::Cust Javascript-->
    
    @endpush
</x-app-layout>

