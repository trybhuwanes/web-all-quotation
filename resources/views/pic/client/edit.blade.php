<x-app-layout>
    @slot('title')
    {{ __('Edit Diskusi') }}
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
                                    Ubah Diskusi
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
                        <div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
                            <!--begin::Customer-->
                            <div class="card card-flush pt-3 mb-5 mb-lg-10">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="fw-bold">Data Client</h2>
                                    </div>
                                    <!--begin::Card title-->
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Description-->
                                    <div class="text-gray-500 fw-semibold fs-5 mb-5">
                                        Data ini bersifat rahasia:
                                    </div>
                                    <!--end::Description-->

                                    <!--begin::Selected customer-->
                                    <div class="d-flex align-items-center p-3 mb-2">
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

                                            <!--begin::Institusi-->
                                            <a href="" class="fw-semibold text-gray-600 text-hover-primary">{{ $findclient->institusi }} - {{ $findclient->jabatan }}</a>
                                            <!--end::Institusi-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Selected customer-->

                                    

                                    <!--begin::Option-->
                                    <div class="py-1">
                                        <!--begin::Header-->
                                        <div class="py-3 d-flex flex-stack flex-wrap">
                                            <!--begin::Toggle-->
                                            <div class="d-flex align-items-center collapsible toggle " data-bs-toggle="collapse" data-bs-target="#kt_create_new_payment_method_1">
                                                <!--begin::Arrow-->
                                                <div class="btn btn-sm btn-icon btn-active-color-primary ms-n3 me-2">
                                                    <i class="fa fa-caret-right toggle-on text-primary fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                    <i class="fa fa-caret-down toggle-off fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                            </div>
                                                <!--end::Arrow-->

                                                

                                                <!--begin::Summary-->
                                                <div class="me-3">
                                                    <div class="d-flex align-items-center fw-bold">Detail Kontak</div>
                                                    <div class="text-muted"></div>
                                                </div>
                                                <!--end::Summary-->
                                            </div>
                                            <!--end::Toggle-->  
                                        </div>
                                        <!--end::Header-->

                                        <!--begin::Body-->
                                        <div id="kt_create_new_payment_method_1" class="collapse show fs-7 ps-6">
                                            <!--begin::Details-->
                                            <div class="d-flex flex-wrap py-3">
                                                    <!--begin::Col-->
                                                    <div class="flex-equal me-3">
                                                        <table class="table table-flush fw-semibold gy-1">
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">No. Telpon</td>
                                                                <td class="text-gray-800">{{ $findclient->telpon }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">Email</td>
                                                                <td class="text-gray-800"><a href="#" class="text-gray-900 text-hover-primary">{{ $findclient->email }}</a></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <!--end::Col-->

                                                    <!--begin::Col-->
                                                    <div class="flex-equal ">
                                                        
                                                        <table class="table table-flush fw-semibold gy-1">
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">Asal Instansi</td>
                                                                <td class="text-gray-800">{{ $findclient->institusi }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">Lokasi</td>
                                                                <td class="text-gray-800">{{ $findclient->lokasi_institusi }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">Bidang</td>
                                                                <td class="text-gray-800">{{ $findclient->bidang_institusi }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted min-w-125px w-125px">Detail</td>
                                                                <td class="text-gray-800">{{ $findclient->detail_institusi }}</td>
                                                            </tr>
                                                            
                                                        </table>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Option-->

                                    
                                <!--begin::Notice-->
                                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed rounded-3 p-6">
                                    
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-grow-1 ">
                                            <!--begin::Content-->
                                            <div class=" fw-semibold">
                                                <h4 class="text-gray-900 fw-bold">Kebutuhan</h4>
                                                
                                                <div class="fs-6 text-gray-700 text-uppercase">

                                                    @foreach ($findclient->kebutuhan as $item) 
                                                    <span class="fs-6 text-info d-flex align-items-center">
                                                        <span class="bullet bullet-dot bg-success me-2"></span> 
                                                        {{ $item }}
                                                    </span> 
                                                    @endforeach

                                                    
                                                    {{-- <a href="#" class="fw-bold">Learn more</a>. --}}
                                                </div>
                                                @if ($findclient->kebutuhan_lain != null )
                                                Kebutuhan lainnya: {{ $findclient->kebutuhan_lain }}
                                                @endif
                                            </div>
                                            <!--end::Content-->
                                        
                                            </div>
                                    <!--end::Wrapper-->  
                                </div>
                                <!--end::Notice-->

                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Customer-->


                        </div>
                        <!--end::Sidebar-->

                        {{-- ============================================================================================================= --}}
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                            
                            <!--begin::Card-->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between py-3">
            <h2 class="card-title m-0">
                Hasil Diskusi
            </h2>  

            <!--begin::Toggle-->
            <a href="#" class="btn btn-sm btn-icon btn-color-primary btn-light btn-active-light-primary d-lg-none" data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-placement="top" title="Toggle inbox menu" id="kt_inbox_aside_toggle">
                <i class="ki-duotone ki-burger-menu-2 fs-3 m-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></i>            </a>
            <!--end::Toggle-->
        </div>

        <div class="card-body p-0 py-3">
            <!--begin::Form-->
            <form id="kt_inbox_compose_form" class="form" action="{{ route('client.store') }}" method="POST">
                @csrf 
                <input type="hidden" name="report_id" value="{{ $findclient->reportPresensis->first()->id }}">
                <input type="hidden" name="detail_report_id" value="{{ $findclient->reportPresensis->first()->detailReport->id }}">
                <!--begin::Body-->
                <div class="d-block ps-10">

                    <!--begin::Message-->
                    <div id="kt_inbox_form_editor" class="bg-transparent border-0 h-350px px-3">
                    </div>
                    <!--end::Message-->

                    <div class='separator separator-dashed my-5'></div>
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-5">Next to do</label>
                    <!--end::Label-->

                    <!--begin::Roles-->
                        <!--begin::Input row-->
                        <div class="d-flex fv-row pb-2">
                            <!--begin::Radio-->
                            <div class="form-check form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input class="form-check-input me-3" name="next_todo" type="radio" value="Sales Follow Up" id="kt_modal_update_role_option_0"
                                {{ $findclient->reportPresensis->first()->detailReport->next_todo == 'Sales Follow Up' ? 'checked' : '' }} />
                                <!--end::Input-->

                                <!--begin::Label-->
                                <label class="form-check-label" for="kt_modal_update_role_option_0">
                                    <div class="fw-bold text-gray-800">Sales Follow Up</div>
                                    <div class="text-gray-600">Best for business owners</div>
                                </label>
                                <!--end::Label-->
                            </div>
                            <!--end::Radio-->
                        </div>
                        <!--end::Input row-->

                        

                        <!--begin::Input row-->
                        <div class="d-flex fv-row pb-2">
                            <!--begin::Radio-->
                            <div class="form-check form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input class="form-check-input me-3" name="next_todo" type="radio" value="Survey" id="kt_modal_update_role_option_3"
                                {{ $findclient->reportPresensis->first()->detailReport->next_todo == 'Survey' ? 'checked' : '' }}/>
                                <!--end::Input-->

                                <!--begin::Label-->
                                <label class="form-check-label" for="kt_modal_update_role_option_3">
                                    <div class="fw-bold text-gray-800">Survey</div>
                                    <div class="text-gray-600">Payments and respond to disputes</div>
                                </label>
                                <!--end::Label-->
                            </div>
                            <!--end::Radio-->
                        </div>
                        <!--end::Input row-->

                        <!--begin::Input row-->
                        <div class="d-flex fv-row pb-2">
                            <!--begin::Radio-->
                            <div class="form-check form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input class="form-check-input me-3" name="next_todo" type="radio" value="Quotation" id="kt_modal_update_role_option_3"
                                {{ $findclient->reportPresensis->first()->detailReport->next_todo == 'Quotation' ? 'checked' : '' }}  />
                                <!--end::Input-->

                                <!--begin::Label-->
                                <label class="form-check-label" for="kt_modal_update_role_option_3">
                                    <div class="fw-bold text-gray-800">Quotation</div>
                                    <div class="text-gray-600">Testing and pentesting to disputes</div>
                                </label>
                                <!--end::Label-->
                            </div>
                            <!--end::Radio-->
                        </div>
                        <!--end::Input row-->
                    
                </div>
                <!--end::Body-->

                <!--begin::Footer-->
                <div class="d-flex flex-stack flex-wrap gap-2 py-5 ps-8 pe-5 border-top">
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center me-3">
                        <!--begin::Send-->
                        <a href="{{ route('client.index') }}" class="btn btn-light btn-active-light-primary m-3">Cancel</a>
                        <div class="btn-group me-4">
                            <!--begin::Submit-->
                            <button type="submit" id="kt_diskusi_submit" class="btn btn-primary m-3">
                                <span class="indicator-label">
                                    Submit
                                </span>
                                <span class="indicator-progress">
                                    Silakan tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>

                            <!--end::Submit-->
                        </div>
                        <!--end::Send-->
                    </div>
                    <!--end::Actions-->

                    
                </div>
                <!--end::Footer-->
            </form>
            <!--end::Form-->        
        </div>
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ url('pages/js/my_client/update-report.js') }}"></script>
<script>
"use strict";

var KTAppInboxCompose = function() {
    const n = (e, diskusiContent) => {
        var quill = new Quill("#kt_inbox_form_editor", {
            modules: {
                toolbar: [
                    [{ header: [1, 2, !1] }],
                    ["bold", "italic", "underline"],
                    [{ list: "ordered" }, { list: "bullet" }]
                ]
            },
            placeholder: "Tulis hasil diskusi disini...",
            theme: "snow"
        });

        quill.root.innerHTML = diskusiContent;

        const t = e.querySelector(".ql-toolbar");
        if (t) {
            const e = ["px-5", "border-top-0", "border-start-0", "border-end-0"];
            t.classList.add(...e);
        }
    };

    return {
        init: function() {
            const r = document.querySelector("#kt_inbox_compose_form");
            const diskusiContent = {!! json_encode($findclient->reportPresensis->first()->detailReport->diskusi) !!}; // Pastikan data yang benar
            
            // Inisialisasi Quill dengan konten diskusi
            n(r, diskusiContent);
        }
    }
}();

KTUtil.onDOMContentLoaded((function() {
    KTAppInboxCompose.init()
}));

</script>
@endpush
</x-app-layout>