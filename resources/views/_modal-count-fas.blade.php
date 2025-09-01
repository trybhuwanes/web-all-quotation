<!--begin::Modal - New Address-->
<div class="modal fade" id="kt_modal_fas" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            
            <form method="POST" class="form" action="/count" id="kt_modal_new_fas_form" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_new_address_header">
                    <!--begin::Modal title-->
                    <h2>Masukkan Nilai yang di Butuhkan</h2>
                    <!--end::Modal title-->

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->

                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div
                        class="scroll-y me-n7 pe-7"
                        id="kt_modal_new_address_scroll"
                        data-kt-scroll="true"     
                        data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_new_address_header" 
                        data-kt-scroll-wrappers="#kt_modal_new_address_scroll" 
                        data-kt-scroll-offset="300px">
                        <input type="hidden" id="system_name" name="system_name" value="">
                        <input type="hidden" id="uid" name="uid" value="">

                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="required fs-5 fw-semibold mb-2">Kedalaman (m)</label>
                            <input id="kedalaman" class="form-control form-control-solid numeric-field required-field" type="number" name="kedalaman" min="1" max="99999" placeholder="Masukkan nilai Kedalaman Kolam"/>
                            <div id="error-kedalaman" class="text-danger mt-2" style="display:none;"></div>
                        </div>
                        
                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="required fs-5 fw-semibold mb-2">Panjang (m)</label>
                            <input id="panjang" class="form-control form-control-solid numeric-field required-field" type="number" name="panjang" min="1" max="99999" placeholder="Masukkan nilai Diameter Zona"/>
                            <div id="error-panjang" class="text-danger mt-2" style="display:none;"></div>
                        </div>
                        
                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="required fs-5 fw-semibold mb-2">Lebar (m)</label>
                            <input id="lebar" class="form-control form-control-solid numeric-field required-field" type="number" name="lebar" min="1" max="99999" placeholder="Masukkan nilai Lebar"/>
                            <div id="error-lebar" class="text-danger mt-2" style="display:none;"></div>
                        </div>
                    </div>

                    <!-- Tempat tampilkan hasil -->
                    <div id="calculation-results-fas" class="mt-5">
                        <!-- Akan diisi lewat JS -->
                    </div>
                    <!--begin::Form-->
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="submit" id="kt_modal_new_fas_submit" class="btn btn-primary">
                        <span class="indicator-label">
                            Submit
                        </span>
                        <span class="indicator-progress">
                            Silakan tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <!--end::Button-->

                    
                </div>
                <!--end::Modal footer-->

                
                
            </form>
            <!--end::Form-->
        </div>

        
    </div>

    
</div>
<!--end::Modal - New Address-->

<!--end::Modal - Create Campaign-->


@push('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ url('pages/js/countfas.js') }}"></script>
@endpush
