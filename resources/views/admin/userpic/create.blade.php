<x-app-layout>
    @slot('title')
    {{ __('Tambah PIC') }}
@endslot
@push('css')
<style>
    .select2-container--bootstrap5 .select2-dropdown {
        border: 0 !important;
        box-shadow: 0px 0px 50px 0px rgba(82, 63, 105, 0.15) !important;
        border-radius: .475rem !important;
        padding: 1rem 0 !important;
        background-color: #ffffff !important;
    }
</style>
@endpush
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
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Person In Charge</h1>
                        <!--end::Title-->

                         <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    PIC Baru
                                </li>
                                <!--end::Item-->           
                            </ul>
                            <!--end::Breadcrumb-->

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


<!--begin::Basic info-->
<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Form Data User PIC</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_account_settings_profile_details" class="collapse show">
        <!--begin::Form-->
        <form id="kt_account_profile_details_form" class="form" action="{{ route('user-pic.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <!--begin::Card body-->
            <div class="card-body border-top p-9">

                <!--begin::Input group-->
                <div class="row mb-1">
                    <!--begin::Label-->
                    <label class="required col-lg-4 col-form-label fw-semibold fs-6">Nama Lengkap</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nama" class="form-control form-control-sm form-control-solid" placeholder="Masukan nama lengkap" value="" />
                        <span id="nama-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                
                <!--begin::Input group-->
                <div class="row mb-1">
                    <!--begin::Label-->
                    <label class="required col-lg-4 col-form-label fw-semibold fs-6">Jabatan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="job_title" class="form-control form-control-sm form-control-solid" placeholder="Masukan jabatan" value="" />
                        <span id="job-title-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                
                <!--begin::Input group-->
                <div class="row mb-1">
                    <!--begin::Label-->
                    <label class="required col-lg-4 col-form-label fw-semibold fs-6">Perusahaan</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="company" class="form-control form-control-sm form-control-solid" placeholder="Masukan perusahaan" value="" />
                        <span id="company-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-1">
                    <!--begin::Label-->
                    <label class="required col-lg-4 col-form-label fw-semibold fs-6">Nomer Telpon</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="notelpon" class="form-control form-control-sm form-control-solid" placeholder="Masukan nomer telpon" value="" />
                        <span id="notelpon-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-1">
                    <!--begin::Label-->
                    <label class="required col-lg-4 col-form-label fw-semibold fs-6">Email</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="email" class="form-control form-control-sm form-control-solid" placeholder="Masukan email" value="" autocomplete="off"/>
                        <span id="email-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-1">
                    <!--begin::Label-->
                    <label class="required col-lg-4 col-form-label fw-semibold fs-6">Password</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row position-relative">
                        <input type="password" id="password" name="password" class="form-control form-control-sm form-control-solid" placeholder="Masukan password" value="" autocomplete="off"/>
                        <i class="fas fa-eye toggle-password" style="position: absolute; right: 30px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                        <span id="password-error" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-1">
                    <!--begin::Label-->
                    <label class="required col-lg-4 col-form-label fw-semibold fs-6">Ulangi Password</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row position-relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-sm form-control-solid" placeholder="Ulangi password" value="" autocomplete="off" />
                        <span id="password-confirmation-errors" class="fv-plugins-message-container invalid-feedback invalid-feedback"></span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->    
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Cancel</button>
                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Simpan</button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->


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
<!--begin::Vendors Javascript(used by this page)-->
<script src="{{ url('template/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ url('pages/js/auth/hidevisibility.js') }}"></script>
<script src="{{ url('pages/js/master_pic/create-pic.js') }}"></script>
@endpush
</x-app-layout>