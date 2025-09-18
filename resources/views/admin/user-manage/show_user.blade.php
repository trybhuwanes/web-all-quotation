<x-app-layout>
    
    @slot('title')
        {{ __('Detail Pengguna') }}
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
                                            <div class="col-lg-6">:           
                                                <span class="badge badge-light-success text-uppercase">{{$us->role}}</span>              
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
                                                        <h2>{{ __('Form Detail Data Pengguna') }}</h2>
                                                    </div>
                                                </div>
                                                <!--end::Card header-->
                                                <!--begin::Card body-->
                                                <div class="px-9">
                                                    <!--begin::Input group-->
                                                    <div class="row mb-1">
                                                        <!--begin::Label-->
                                                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">Nama Lengkap</label>
                                                        <!--end::Label-->
                                                        <!--begin::Col-->
                                                        <div class="col-lg-9 fv-row mt-4">
                                                            <span>{{$us->name}}</span>
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
                                                        <div class="col-lg-9 fv-row mt-4">
                                                            {{$us->email}}
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                     <!--begin::Input group-->
                                                     <div class="row mb-1">
                                                        <!--begin::Label-->
                                                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">Nomor Telepon</label>
                                                        <!--end::Label-->
                                                        <!--begin::Col-->
                                                        <div class="col-lg-9 fv-row mt-4">
                                                            <span>{{$us->phone}}</span>
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
                                                        <div class="col-lg-9 fv-row mt-4">
                                                            <span>
                                                                @if (!$us->job_title)
                                                                    Jabatan Kosong
                                                                @else
                                                                    {{ $us->job_title }}
                                                                @endif
                                                            </span>
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
                                                        <div class="col-lg-9 fv-row mt-4">
                                                            <span>{{$us->company}}</span>
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
                                                        <div class="col-lg-9 fv-row mt-4">
                                                            @if (!$us->location_company)
                                                                Lokasi Perusahaan Kosong
                                                            @else
                                                                {{ $us->location_company }}
                                                            @endif
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
                                                        <div class="col-lg-9 fv-row mt-4">
                                                            @if (!$us->field_company)
                                                                Bidang Perusahaan Kosong
                                                            @else
                                                                {{ $us->field_company }}
                                                            @endif
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
                                                        <div class="col-lg-9 fv-row mt-4">
                                                            @if (!$us->detail_company)
                                                                Detail Perusahaan Kosong
                                                            @else
                                                                {{ $us->detail_company }}
                                                            @endif
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
        <script src="{{ url('pages/js/user_manage/form-update.js') }}"></script>
        <script src="{{ url('pages/js/user_manage/signin-methods.js') }}"></script>
        <!--end::Cust Javascript-->
    
    @endpush
</x-app-layout>

