<x-app-layout>
    @slot('title')
    {{ __('Target PIC') }}
@endslot
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pb-3 pt-8">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <!--begin::Back Button-->
                    <a href="{{ route('targets.index') }}" class="btn btn-icon btn-light btn-active-light-primary me-3">
                        <i class="ki-duotone ki-left-square fs-3x">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </a>
                <!--end::Back Button-->
                
                <!--begin::Toolbar wrapper-->
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Daftar Target Omzet PIC</h1>
                        <!--end::Title-->

                         <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary"><span class="menu-icon"><i class="fa-solid fa-home fs-7"></i></span></a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    Target Omzet PIC
                                </li>
                                <!--end::Item--> 
                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    Daftar Target Omzet PIC
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
            <div id="kt_app_content_container" class="app-container container-xxl">

                {{-- CONTEN --}}
                <!--begin::Layout-->
                <!--begin::Order summary-->
                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10 mb-5">
                    <!--begin::Order details-->
                    <div class="card card-flush py-4 flex-row-fluid bg-primary">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2 class="text-white">Data PIC</h2>
                            </div>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center text-white">
                                                    <i class="ki-duotone ki-profile-circle fs-2 me-2 text-white"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                    Nama PIC
                                                </div>
                                            </td>

                                            <td class="fw-bold text-end">
                                                <div class="d-flex align-items-center justify-content-end text-white">
                                                    {{ $detailuser->name}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center text-white">
                                                    <i class="ki-duotone ki-sms fs-2 me-2 text-white"><span class="path1"></span><span class="path2"></span></i>Email
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end text-white">
                                                <a href="mailto:{{ $detailuser->email}}" class="text-white text-hover-secondary">
                                                    {{ $detailuser->email}}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center text-white">
                                                    <i class="ki-duotone ki-phone fs-2 me-2 text-white"><span class="path1"></span><span class="path2"></span></i>Phone
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end text-white">{{ $detailuser->phone}}</td>
                                        </tr>

                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center text-white">
                                                    <i class="ki-duotone ki-phone fs-2 me-2 text-white"><span class="path1"></span><span class="path2"></span></i>
                                                    Jabatan
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end text-white">
                                                @if (!$detailuser->job_title)
                                                    Jabatan Kosong
                                                @else
                                                    {{ $detailuser->job_title}}
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Order details-->
{{-- 
                    <!--begin::Customer details-->
                    <div class="card  bg-primary card-flush py-4  flex-row-fluid" data-bs-theme="light" >
                        <!--begin::Engage widget 3-->
                         
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column pt-6">  
                                <!--begin::Heading-->
                                <div class="m-0">
                                    <!--begin::Title-->
                                    <h1 class="fw-semibold text-white text-center lh-lg mb-9">
                                        <span class="fw-bolder">{{__('Manufacturing for Water, Wastewater & Energy')}}</span>
                                    </h1>
                                    <!--end::Title-->  
                                    
                                    <!--begin::Illustration-->
                                    <div 
                                        class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center card-rounded-bottom h-200px mh-200px my-5 mb-lg-12" 
                                        style="background-image: url('/template/assets/media/logos/maskot-grinviro.webp')">
                                    </div>
                                    <!--end::Illustration-->
                                </div>
                                <!--end::Heading-->
                                </div>
                                <!--end::Links-->
                            </div>
                            <!--end::Body-->
                        
                        <!--end::Engage widget 3--> 
                    </div>
                    <!--end::Customer details-->
                     --}}
                </div>
                <!--end::Order summary-->

                {{-- REVISION CONTENT --}}
                
                @php
                    if ($lastTarget) {
                        $nextMonth = $lastTarget->month + 1;
                        $nextYear = $lastTarget->year;

                        if ($nextMonth > 12) {
                            $nextMonth = 1;
                            $nextYear++;
                        }
                    } else {
                        // kalau belum ada target, default bulan sekarang
                        $nextMonth = now()->month;
                        $nextYear = now()->year;
                    }
                @endphp
                @include('admin.target._form-create')
                <!--begin::Histori Revisi Tab content-->
                <div class="tab-content mb-5">
                    <x-data-table-card additionalButtons="add">

                         @slot('data')
                            @include('admin.target._data-table-target')
                        @endslot
                    </x-data-table-card>

                </div>
                
                <!--end::Histori Revisi Tab content-->

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

<script src="{{ url('pages/js/targets/data-table.js') }}"></script>
<script src="{{ url('pages/js/targets/form-create.js') }}"></script>

@endpush
</x-app-layout>