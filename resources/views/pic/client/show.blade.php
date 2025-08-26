<x-app-layout>
    @slot('title')
    {{ __('Detail Client') }}
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
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">CLIENT</h1>
                        <!--end::Title-->

                         <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ route('pic.dashboard') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    Client
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    Detail Client
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
            <div id="kt_app_content_container" class="app-container  container-xxl">

                {{-- CONTEN --}}
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-xl-row">

                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
                            <!--begin::Card-->
                            <div class="card card-flush pt-3 mb-5 mb-xl-10">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="fw-bold">Detail Kontak</h2>
                                    </div>
                                    <!--begin::Card title-->
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-1">
                                    <!--begin::Section-->
                                    <div class="mb-10">

                                        <!--begin::Details-->
                                        <div class="d-flex flex-wrap py-1">
                                            <!--begin::Row-->
                                            <div class="flex-equal me-5">
                                                <!--begin::Details-->
                                                <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">                                                    
                                                    <!--begin::Row-->
                                                    <tr>
                                                        <td class="text-gray-500 min-w-175px w-175px">Institusi:</td>
                                                        <td class="text-gray-800">{{ $findclient->institusi }}</td>
                                                    </tr>
                                                    <!--end::Row-->

                                                    <!--begin::Row-->
                                                    <tr>
                                                        <td class="text-gray-500 min-w-175px w-175px">Lokasi Institusi:</td>
                                                        <td class="text-gray-800">{{ $findclient->lokasi_institusi }}</td>
                                                    </tr>
                                                    <!--end::Row-->

                                                    <!--begin::Row-->
                                                    <tr>
                                                        <td class="text-gray-500 min-w-175px w-175px">Bidang Institusi:</td>
                                                        <td class="text-gray-800">{{ $findclient->bidang_institusi }}</td>
                                                    </tr>
                                                    <!--end::Row-->

                                                    <!--begin::Row-->
                                                    <tr>
                                                        <td class="text-gray-500 min-w-175px w-175px">Detail Institusi:</td>
                                                        <td class="text-gray-800">{{ $findclient->detail_institusi }}</td>
                                                    </tr>
                                                    <!--end::Row-->

                                                    
                                                </table>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Row-->

                                            <!--begin::Row-->
                                            <div class="flex-equal">
                                                <!--begin::Details-->
                                                <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                                                    <!--begin::Row-->
                                                    <tr>
                                                        <td class="text-gray-500 min-w-175px w-175px">No. Telpon:</td>
                                                        <td class="text-gray-800 min-w-200px">
                                                            <a href="" class="text-gray-800 text-hover-primary">{{ $findclient->telpon }}</a>
                                                        </td>
                                                    </tr>
                                                    <!--end::Row-->

                                                    <!--begin::Row-->
                                                    <tr>
                                                        <td class="text-gray-500 min-w-175px w-175px">Email:</td>
                                                        <td class="text-gray-800 min-w-200px">
                                                            <a href="" class="text-gray-800 text-hover-primary">{{ $findclient->email }}</a>
                                                        </td>
                                                    </tr>
                                                    <!--end::Row-->
                                                </table>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Section-->

                                     <!--begin::Section-->
                                    <div class="mb-0">
                                            <!--begin::Title-->
                                            <h5 class="mb-4">Kebutuhan & Diskusi:</h5>
                                            <!--end::Title-->

                                            <!--begin::Row-->
                                            <div class="flex-equal me-5">
                                                <ul>
                                                    @foreach ($findclient->kebutuhan as $item)
                                                    <li>
                                                        <span class="badge badge-light-primary my-1 me-2 text-uppercase">{{ $item }}</span>
                                                    </li>
                                                    @endforeach
                                                    
                                                    @if ($findclient->kebutuhan_lain != null)
                                                    <p class="p-1">
                                                        {{ $findclient->kebutuhan_lain }}
                                                    </p>
                                                    @endif
                                                </ul>
                                            </div>
                                            <!--end::Section-->
                                    </div>
                                    <!--end::Section-->

                                
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->

                            <!--begin::Card-->
                            <div class="card card-flush pt-3 mb-5 mb-xl-10">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Hasil Diskusi</h2>
                                        @if (isset($findclient->reportPresensis->first()->detailReport))
                                            <span class="badge badge-light-info fw-bold m-3  px-4 py-3">{{ $findclient->reportPresensis->first()->detailReport->next_todo }}</span>
                                        @endif
                                    </div>
                                    <!--end::Card title-->

                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        {{-- <a href="#" class="btn btn-light-primary">Ubah Diskusi</a> --}}
                                        <!--begin::Button Edit-->
                                            <a href="{{ route('client.edit', $findclient->id) }}" class="btn btn-sm btn-flex btn-light-primary px-4">
                                                <i class="fa-solid fa-pencil fs-3"><span class="path1"></span><span class="path2"></span></i>Edit Diskusi
                                            </a>
                                        <!--end::Button Edit--> 
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="text-gray-800 mb-5">
                                        @if (isset($findclient->reportPresensis->first()->detailReport))
                                            {!! $findclient->reportPresensis->first()->detailReport->diskusi !!}
                                        @endif
                                    </div>
                                </div>
                                <!--end::Card Body-->


                            </div>
                            <!--end::Card-->
                        </div>  
                        <!--end::Content-->

                        

                        <!--begin::Sidebar-->
                        <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-300px mb-10 order-1 order-lg-2">
                            <!--begin::Card-->
                            <div class="card card-flush mb-0"
                                data-kt-sticky="true"
                                data-kt-sticky-name="subscription-summary"
                                data-kt-sticky-offset="{default: false, lg: '200px'}"
                                data-kt-sticky-width="{lg: '250px', xl: '300px'}"
                                data-kt-sticky-left="auto"
                                data-kt-sticky-top="150px"
                                data-kt-sticky-animation="false"
                                data-kt-sticky-zindex="95"
                                >
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Summary</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0 fs-6">
                                    <!--begin::Section-->
                                    <div class="mb-7">
                                                    
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-60px symbol-circle me-3">
                                                <img alt="Pic" src="/template/assets/media/avatars/blank.png" />
                                            </div>
                                            <!--end::Avatar-->

                                            <!--begin::Info-->
                                            <div class="d-flex flex-column">
                                                <!--begin::Name-->
                                                <a href="" class="fs-4 fw-bold text-gray-900 text-hover-primary me-2">{{ $findclient->nama }}</a>
                                                <!--end::Name-->

                                                <!--begin::Email-->
                                                <h6 class="fw-semibold text-gray-600">{{ $findclient->jabatan }}</h6>
                                                <!--end::Email-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Section-->

                                    

                                    <!--begin::Seperator-->
                                    <div class="separator separator-dashed mb-7"></div>
                                    <!--end::Seperator-->

                                    <!--begin::Section-->
                                    <div class="mb-10">
                                        <!--begin::Title-->
                                        <h5 class="mb-4">Information</h5>
                                        <!--end::Title-->

                                        <!--begin::Details-->
                                        <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2">
                                        
                                            <!--begin::Row-->
                                            <tr class="">
                                                <td class="text-gray-500">Tgl ke Exhibition:</td>
                                                @foreach ($findclient->tgl_hadir as $item)
                                                    <td class="text-gray-800">{{ $item }}</td>
                                                @endforeach
                                            </tr>
                                            <!--end::Row-->

                                            <!--begin::Row-->
                                            <tr class="">
                                                <td class="text-gray-500">Status Diskusi:</td>
                                                <td><span class="badge badge-light-success">Sudah</span></td>
                                            </tr>
                                            <!--end::Row-->

                                            
                                        </table>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Section-->

                                    <!--begin::Actions-->
                                    <div class="mb-0">
                                        <a href="{{route('client.index')}}"  class="btn btn-primary" id="kt_subscriptions_create_button">                
                                            Kembali
                                        </a>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card--> 
                        </div>
                        <!--end::Sidebar-->
                </div>
                <!--end::Layout-->
                {{-- END CONTEN --}}

            </div>
            <!--end::Content-->
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
<script src="{{ url('pages/js/master_presensi/data-table.js') }}"></script>
<script src="{{ url('template/assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
@endpush
</x-app-layout>