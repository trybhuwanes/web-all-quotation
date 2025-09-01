<x-app-layout>
    @slot('title')
    {{ __('Detail Laporan Diskusi') }}
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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">LAPORAN</h1>
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
                                    Laporan
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    Detail Laporan
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

                        <!--begin::Sidebar-->
                        <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                            <!--begin::Card-->
                            <div class="card mb-5 mb-xl-8">
                                <!--begin::Card body-->
                                <div class="card-body pt-5">
                                    <!--begin::Summary-->
                                    <div class="d-flex flex-center flex-column mb-5">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-100px symbol-circle mb-7">
                                            <img src="/template/assets/media/avatars/blank.png" alt="image">
                                        </div>
                                        <!--end::Avatar-->

                                        <!--begin::Name-->
                                        <a href="" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                                            {{ $findreport->nama }}            
                                        </a>
                                        <!--end::Name-->

                                        <!--begin::Position-->
                                        <div class="fs-5 fw-semibold text-muted mb-6">
                                            {{ $findreport->jabatan }}
                                        </div>
                                        <!--end::Position-->

                                        <!--begin::Info-->
                                        <div class="d-flex flex-wrap flex-center">
                                            <!--begin::Stats-->
                                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                                {{-- <div class="fs-4 fw-bold text-gray-700">

                                                    <i class="ki-duotone ki-arrow-up fs-3 text-success"><span class="path1"></span><span class="path2"></span></i>                    
                                                </div> --}}
                                                <div class="fw-semibold text-muted">{{ $findreport->institusi }}</div>
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Summary-->

                                    <!--begin::Details toggle-->
                                    <div class="d-flex flex-stack fs-4 py-3">
                                        <div class="fw-bold rotate collapsible collapsed" data-bs-toggle="collapse" href="#kt_customer_view_details" role="button" aria-expanded="false" aria-controls="kt_customer_view_details">
                                            Details Kontak
                                            <span class="ms-2 rotate-180">
                                                <i class="fa fa-caret-down fs-3"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Details toggle-->

                                    <div class="separator separator-dashed my-3"></div>

                                    <!--begin::Details content-->
                                    <div id="kt_customer_view_details" class="collapse" style="">
                                        <div class="py-5 fs-6">

                                                <!--begin::Details item-->
                                                <div class="fw-bold mt-3">Nomer Telpon:</div>
                                                <div class="text-gray-600">{{ $findreport->telpon }}</div>
                                                <!--begin::Details item-->

                                                <!--begin::Details item-->
                                                <div class="fw-bold mt-3">Email:</div>
                                                <div class="text-gray-600">{{ $findreport->email }}</div>
                                                <!--begin::Details item-->

                                                <!--begin::Details item-->
                                                <div class="fw-bold mt-3">Lokasi Institusi:</div>
                                                <div class="text-gray-600">{{ $findreport->lokasi_institusi }}</div>
                                                <!--begin::Details item-->

                                                <!--begin::Details item-->
                                                <div class="fw-bold mt-3">Bidang Institusi:</div>
                                                <div class="text-gray-600">{{ $findreport->bidang_institusi }}</div>
                                                <!--begin::Details item-->

                                                <!--begin::Details item-->
                                                <div class="fw-bold mt-3">Detail Institusi:</div>
                                                <div class="text-gray-600">{{ $findreport->detail_institusi }}</div>
                                                <!--begin::Details item-->
                                                
                                                <div class="fw-bold mt-3">Tanggal Ke Exhibition:</div>
                                                @foreach ($findreport->tgl_hadir as $item)
                                                    <span class="fs-6 text-info d-flex align-items-center">
                                                        <span class="bullet bullet-dot bg-danger me-2"></span> 
                                                        {{ $item }}
                                                    </span>
                                                @endforeach
                                                
                                        </div>
                                    </div>
                                    <!--end::Details content-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Sidebar-->

                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid ms-lg-15">
            
                            <!--begin::Card-->
                            <div class="card">
                                <div class="card-header align-items-center py-5 gap-5">
                                    <!--begin::Actions-->
                                    <div class="d-flex">
                                        <!--begin::Back-->
                                        <a href="{{ route('laporan.index')}}" class="btn btn-sm btn-icon btn-light btn-active-light-primary me-3" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Back" data-bs-original-title="Back" data-kt-initialized="1">
                                            <i class="fa fa-arrow-left fs-1 m-0"><span class="path1"></span><span class="path2"></span></i>    </a>
                                        <!--end::Back-->
                                    </div>
                                    <!--end::Actions-->                               
                                </div>
                                <!--end::Card Header-->

                                <div class="card-body">
                                    <!--begin::Title-->
                                    <div class="d-flex flex-wrap gap-2 justify-content-between mb-2">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <!--begin::Heading-->
                                            <h2 class="fw-semibold me-3 my-1">KEBUTUHAN: </h2>
                                            <!--begin::Heading-->
                                            <!--begin::Badges-->
                                            @foreach ($findreport->kebutuhan as $item)
                                                <span class="badge badge-light-primary my-1 me-2 text-uppercase">{{ $item }}</span>
                                            @endforeach
                                            <!--end::Badges-->
                                        </div>
                                    </div>
                                    <!--end::Title-->

                                    <!--begin::Sub-Title-->
                                    <div class="d-flex flex-wrap gap-2 justify-content-between mb-2">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <!--begin::Heading-->
                                            <p class="fw-semibold me-3 my-1">Kebutuhan Lainya:
                                            <span class="me-3 my-1 text-muted">
                                                @if ($findreport->kebutuhan_lain != null)
                                                    {{ $findreport->kebutuhan_lain }}
                                                @else
                                                    -
                                                @endif
                                            </span>
                                            </p>
                                            <!--begin::Heading-->
                                        </div>
                                    </div>
                                    <!--begin::Sub-Title-->
                                
                                    {{-- HASIL DISKUSI --}}
                                    <!--begin::Message accordion-->
                                    <div data-kt-inbox-message="message_wrapper">
                                        <!--begin::Message header-->
                                        <div class="d-flex flex-wrap gap-2 flex-stack cursor-pointer" data-kt-inbox-message="header">
                                                <!--begin::Author-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-50 me-4">
                                                        <span class="symbol-label" style="background-image:url(/template/assets/media/avatars/300-5.jpg);"></span>
                                                    </div>
                                                    <!--end::Avatar-->
                                        
                                                    <div class="pe-5">
                                                        <!--begin::Author details-->
                                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                                            <a href="" class="fw-bold text-gray-900 text-hover-primary text-uppercase">
                                                                @foreach ($findreport->users as $user)
                                                                {{ $user->name }}
                                                                @endforeach
                                                            </a>
                                                            <i class="fa fa-genderless fs-7 text-success mx-3"><span class="path1"></span><span class="path2"></span></i>

                                                            <span class="text-muted fw-bold">
                                                                @if (isset($findreport->reportPresensis->first()->detailReport))
                                                                    {{  App\Helpers\Helper::dateFormat($findreport->reportPresensis->first()->detailReport->created_at, 'd F Y') }}
                                                                @endif
                                                            </span>

                                                        </div>
                                                        <!--end::Author details-->
                                        
                                                        <!--begin::Message details-->
                                                        <div data-kt-inbox-message="details" class="">
                                                            <span class="text-muted fw-semibold text-uppercase">
                                                                @foreach ($findreport->users as $user)
                                                                    {{ $user->role }}
                                                                @endforeach
                                                            </span>  
                                                        </div>
                                                        <!--end::Message details-->
                                        
                                                        <!--begin::Preview message-->
                                                        {{-- <div class="text-muted fw-semibold mw-450px d-none" data-kt-inbox-message="preview">
                                                            With resrpect, i must disagree with Mr.Zinsser. We all know the most part of important part....
                                                        </div> --}}
                                                        <!--end::Preview message-->
                                                    </div>
                                                </div>
                                                <!--end::Author-->
                                    
                                                <!--begin::Actions-->
                                                <div class="d-flex align-items-center flex-wrap gap-2">
                                                    <!--begin::Date-->
                                                    <span class="fw-semibold text-muted text-end me-3">
                                                        @if (isset($findreport->reportPresensis->first()->detailReport))
                                                            <span class="badge badge-light-info my-1 me-2 text-uppercase">{{ $findreport->reportPresensis->first()->detailReport->next_todo }}</span>
                                                        @endif
                                                    </span>
                                                    <!--end::Date-->
                                                </div>
                                                <!--end::Actions-->
                                            </div>
                                            <!--end::Message header-->
                                        </div>
                                        <!--end::Message header-->
                                    
                                        <!--begin::Message content-->
                                        <div class="fade collapse show" data-kt-inbox-message="message" style="">
                                            <div class="py-5">
                                                {{-- @foreach ($findreport->reportPresensis as $report) --}}

                                                    @if (isset($findreport->reportPresensis->first()->detailReport))
                                                        <p>
                                                            {!! $findreport->reportPresensis->first()->detailReport->diskusi !!}
                                                        </p>
                                                    @else
                                                        {{-- <p>PIC Belum mengisi hasil Diskusi</p> --}}
                                                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6">
                                                                <!--begin::Icon-->
                                                                <i class="fa fa-exclamation-triangle fs-2tx text-warning me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                                                </i>
                                                                <!--end::Icon-->
                                                            
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex flex-stack flex-grow-1 ">
                                                                    <!--begin::Content-->
                                                                    <div class=" fw-semibold">
                                                                        <h4 class="text-gray-900 fw-bold">Maaf !</h4>
                                                                        
                                                                        <div class="fs-6 text-gray-700 ">PIC Belum mengisi hasil diskusi dengan Client 
                                                                            <a class="fw-bold" href="#"></a>.
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Content-->
                                                                
                                                                    </div>
                                                            <!--end::Wrapper-->  
                                                        </div>
                                                    @endif
                                                {{-- @endforeach --}}
                                                
                                            </div>
                                        </div>
                                        <!--end::Message content-->
                                    </div>
                                    <!--end::Message accordion-->
                                </div>
                                <!--end::Card Body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Content-->
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