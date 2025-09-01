<!--begin::Modal - New Address-->
<div class="modal fade" id="kt_modal_mps" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            
            <form method="POST" class="form" action="/count" id="kt_modal_new_mps_form" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_new_mps_header">
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
                        id="kt_modal_new_mps_scroll"
                        data-kt-scroll="true"     
                        data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_new_mps_header" 
                        data-kt-scroll-wrappers="#kt_modal_new_mps_scroll" 
                        data-kt-scroll-offset="300px">
                        <input type="hidden" id="system_name" name="system_name" value="">
                        <input type="hidden" id="uid" name="uid" value="">
                        <!-- COD -->
                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="required fs-5 fw-semibold mb-2">COD (mg/L)</label>
                            <input id="cod" class="form-control form-control-solid numeric-field required-field" type="number" name="cod" min="1" max="99999" placeholder="Masukkan nilai COD"/>
                            <div id="error-cod" class="text-danger mt-2" style="display:none;"></div>
                        </div>

                        <!-- BOD -->
                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="required fs-5 fw-semibold mb-2">BOD (mg/L)</label>
                            <input id="bod" class="form-control form-control-solid numeric-field required-field" type="number" name="bod" min="1" max="99999" placeholder="Masukkan nilai BOD"/>
                            <div id="error-bod" class="text-danger mt-2" style="display:none;"></div>
                        </div>

                        <!-- TSS -->
                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="required fs-5 fw-semibold mb-2">TSS (mg/L)</label>
                            <input id="tss" class="form-control form-control-solid numeric-field required-field" type="number" name="tss" min="1" max="99999" placeholder="Masukkan nilai TSS"/>
                            <div class="text-muted fs-7">Nilai TSS adalah nilai kandungan lumpur yang masuk ke MPS</div>
                            <div id="error-tss" class="text-danger mt-2" style="display:none;"></div>


                        </div>

                        <!-- Q Flowrate -->
                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="required fs-5 fw-semibold mb-2">Flowrate (CMD)</label>
                            <input id="q_flowrate" class="form-control form-control-solid numeric-field required-field" type="number" name="q_flowrate" min="1" max="99999" placeholder="Masukkan nilai Flowrate"/>
                            <div id="error-q_flowrate" class="text-danger mt-2" style="display:none;"></div>
                        </div>
                    </div>

                    <!-- Tempat tampilkan hasil -->
                    <div id="calculation-results-mps" class="mt-5"></div>
                    <!--begin::Form-->
                    <!--end::Scroll-->

                    
                </div>
                <!--end::Modal body-->
                
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="submit" id="kt_modal_new_mps_submit" class="btn btn-primary">
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
@push('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ url('pages/js/count.js') }}"></script>
@endpush
