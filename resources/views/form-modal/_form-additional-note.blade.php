<x-app-layout>
    
    @slot('title')
        {{ __('Kategori Produk') }}
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
                            
                            {{--  --}}
                            <!--begin::Aside column-->
                            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-5 me-lg-5">
                                <!--begin::Thumbnail settings-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Contoh</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    
                                    <!--begin::Card body-->
                                    <div class="card-body text-center p-1">
                                        <img src="{{ url('/images/example-notes.webp') }}" alt="Form Tutorial" class="img-fluid rounded">
                                        <p class="mt-1">Catatan penawaran yang ditulis akan masuk pada bagian daftar Harga di penawaran, seperti gambar di atas.</p>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Thumbnail settings-->
                            </div>
                            <!--end::Aside column-->
                            {{--  --}}
                            
                    
                            <!--begin::Main column-->
                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                <!--begin::Tab content-->
                                <div class="tab-content">
                                    <!--begin::Tab pane-->
                                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                            <input id="termid" type="hidden" name="id" value="{{$note->id}}" />
                                             <!--begin::Spesifikasi Deskripsi-->
                                             <div class="card card-flush py-4">
                                                <!--begin::Card header-->
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h2>{{ __('Catatan Penawaran') }}</h2>
                                                    </div>
                                                </div>
                                                <!--end::Card header-->
                                                {{-- <input type="hidden" name="spesifikasi_deskripsi" value="" id="spesifikasiContent">
                                                <div id="spesifikasi_editor" class="bg-transparent border-0 h-350px px-3"></div> --}}
                                                <div id="kt_create_form_editor" class="bg-transparent border-0 h-350px px-3">
                                                </div>
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
        <script src="{{ url('pages/js/note_commersil_pic/form-update.js') }}"></script>

        <script>
            "use strict";
            
            var KTAppInboxCompose = function() {
                const n = (e, diskusiContent) => {
                    var quill = new Quill("#kt_create_form_editor", {
                        modules: {
                            toolbar: [
                                [{ list: "ordered" }, { list: "bullet" }]
                            ]
                        },
                        placeholder: "Tulis disini...",
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
                        const r = document.querySelector("#kt_create_product_form");
                        const diskusiContent = {!! json_encode($note->notes_description) !!};
                        console.log(diskusiContent);
                        n(r, diskusiContent);
                    }
                }
            }();
            
            KTUtil.onDOMContentLoaded((function() {
                KTAppInboxCompose.init()
            }));
            
            </script>
        <!--end::Cust Javascript-->

    @endpush
</x-app-layout>

