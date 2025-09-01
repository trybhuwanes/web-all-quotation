<x-app-layout>
    @slot('title')
    {{ __('Detail Presensi') }}
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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">PRESENSI</h1>
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
                                    Presensi
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    Detail Presensi
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

<!--begin::Invoice 2 main-->
<div class="card">     
    <!--begin::Body-->
    <div class="card-body p-lg-20">
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-xl-row">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
                    <!--begin::Invoice 2 content-->
    <div class="mt-1">                                    
        <!--begin::Top-->
        <div class="d-flex flex-stack pb-10">
            <!--begin::Logo-->
            <a href="#">
                <img alt="Logo"  src="/template/assets/media/logos/logo-grinviro-global-black.webp" width="100px">
            </a>
            <!--end::Logo-->
            
            {{-- @if ($findpresensi->status_pic === false) --}}
            <!--begin::Action-->            
            <a href="{{ route('presensi.index') }}" class="btn btn-sm btn-light btn-active-light-primary">Kembali</a>                 
            <!--end::Action-->
            {{-- @endif --}}
        </div>                
        <!--end::Top-->                

        <!--begin::Wrapper-->
        <div class="m-0"> 
            {{-- <!--begin::Label-->              
            <!--end::Label-->   --}}

            <!--begin::Row-->
            <div class="row g-5 mb-11">
                <!--end::Col-->
                <div class="col-sm-6">
                    <!--end::Label-->
                    <div class="fs-6 fw-bold text-muted mb-1">Nama Client:</div>                
                    <!--end::Label-->  

                    <!--end::Col-->
                    <div class="fw-bold fs-6 text-gray-800">{{ $findpresensi->nama }} - {{ $findpresensi->jabatan }}</div>                
                    <!--end::Col-->  
                </div>                
                <!--end::Col-->  

                <!--end::Col-->
                <div class="col-sm-3">
                    <!--end::Label-->
                    <div class="fs-6 fw-bold text-muted mb-1">Tanggal Pengisian:</div>                
                    <!--end::Label-->  

                    <!--end::Info-->
                    <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center flex-wrap">
                        <span class="fs-6 text-info d-flex align-items-center">
                            {{  App\Helpers\Helper::dateFormat($findpresensi['created_at'], 'd F Y') }}
                        </span>
                    </div>                
                    <!--end::Info-->  
                </div>                
                <!--end::Col-->

                <!--end::Col-->
                <div class="col-sm-3">
                    @if ($findpresensi->status_pic === false)
                    <!--end::Label-->
                    <div class="fs-6 fw-bold text-muted mb-1">PIC:</div>                
                    <!--end::Label-->  

                            <!--end::Info-->
                            <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center flex-wrap">
                                <span class="fs-6 text-danger d-flex align-items-center">
                                    <span class="bullet bullet-dot bg-danger me-2"></span> 
                                    Belum Ditentukan
                                </span>
                            </div>                
                            <!--end::Info-->
                        <!--begin::Action-->            
                        <a href="{{ route('presensi.edit', $findpresensi->id) }}" class="btn btn-sm btn-info">Tentukan PIC</a>                 
                        <!--end::Action-->
                    @endif
                    
                </div>                
                <!--end::Col-->


            </div>                
            <!--end::Row-->   

            <!--begin::Row-->
            <div class="row g-5 mb-12">
                <!--end::Col-->
                <div class="col-sm-6">
                    <!--end::Label-->
                    <div class="fs-6 fw-bold text-muted mb-1">Detail Contact:</div>                
                    <!--end::Label-->  

                    <!--end::Text-->
                    <div class="fw-bold fs-6 text-gray-800">{{ $findpresensi->telpon }}</div>                
                    <!--end::Text-->  

                     <!--end::Description-->
                     <div class="fw-semibold fs-7 text-gray-600">
                        {{ $findpresensi->email }}
                    </div>                
                    <!--end::Description-->  
                </div>                
                <!--end::Col-->  

                <!--end::Col-->
                <div class="col-sm-3">
                    <!--end::Label-->
                    <div class="fs-6 fw-bold text-muted mb-1">Institusi:</div>                
                    <!--end::Label-->  

                    <!--end::Text-->
                    <div class="fw-bold fs-6 text-gray-800">{{ $findpresensi->institusi }}</div>                
                    <!--end::Text-->  

                     <!--end::Description-->
                     <div class="fw-semibold fs-7 text-gray-600">                      
                        {{ $findpresensi->lokasi_institusi }}<br/>
                        {{ $findpresensi->bidang_institusi }}<br/>
                        {{ $findpresensi->detail_institusi }}<br/>                         
                    </div>                
                    <!--end::Description-->   
                </div>                
                <!--end::Col-->
                
                <!--end::Col-->
                <div class="col-sm-3">
                    <!--end::Label-->
                    <div class="fs-6 fw-bold text-muted mb-1">Tanggal Ke Exhibition:</div>                
                    <!--end::Label-->  

                    <!--end::Info-->
                    <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center flex-wrap">
                        
                        @foreach ($findpresensi->tgl_hadir as $item)
                        <span class="fs-6 text-info d-flex align-items-center">
                            <span class="bullet bullet-dot bg-danger me-2"></span> 
                            {{ $item }}
                        </span>
                        @endforeach

                    </div>                
                    <!--end::Info-->  
                </div>                
                <!--end::Col-->
            </div>                
            <!--end::Row-->   


            <!--begin::Content-->
            <div class="flex-grow-1">
                <!--begin::Table-->
                <div class="table-responsive mb-1">
                    <table class="table mb-1">
                        <thead>
                            <tr class="border-bottom fs-6 fw-bold text-muted">
                                <th class="min-w-175px pb-2">Kebutuhan Diskusi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($findpresensi->kebutuhan as $item)
                            <tr class="fw-bold text-gray-700 fs-5 text-end">
                                <td class="d-flex align-items-center pt-6">                                            
                                    <i class="fa fa-genderless text-success fs-2 me-2"></i>                                           
                                    
                                    <span class="badge badge-light-info">{{ $item }}</span>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>  
                <!--end::Table-->

                {{--  --}}
                @if ($findpresensi->kebutuhan_lain != null )
                <div class="d-flex align-items-center border-1 border-dashed card-rounded p-3 mb-10">            
                    <!--begin::Text-->
                    <div class="mb-0 fs-7"> 
                        <div class="fw-semibold lh-lg mb-2">
                            {{ $findpresensi->kebutuhan_lain }}
                        </div>             
                    </div>
                    <!--end::Text-->
                </div>
                @endif
                {{--  --}}

                
                

             
            </div>
            <!--end::Content-->          
        </div>
        <!--end::Wrapper-->           
    </div>     
    <!--end::Invoice 2 content-->

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
<script src="{{ url('pages/js/master_presensi/data-table.js') }}"></script>
<script src="{{ url('template/assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
@endpush
</x-app-layout>