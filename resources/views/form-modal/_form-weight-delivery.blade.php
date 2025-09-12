<!--begin::Modal - New Target-->
<div class="modal fade" id="kt_modal_weight" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-kt-weight-modal-action-type="close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin:Form-->
                <form id="kt_modal_weight_form" class="form" action="#">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Berat & Volume Barang</h1>
                        <!--end::Title-->

                        <!--begin::Description-->
                        <div class="text-muted fw-semibold fs-5">
                            Masukan <span class="fw-bold link-primary"> Berat & Volume</span> yang benar.
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->

                    <!--begin::Input group weight-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Berat (kg)</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Data hanya akan ditampilkan di admin.">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            </span>
                        </label>
                        <!--end::Label-->

                        <!--begin::Bid options-->
                        {{-- <input id="shipping-id" type="hidden" name="id"> --}}
                        <div class="d-flex flex-stack gap-5 mb-3">
                            <button type="button" class="btn btn-light-primary w-100" data-kt-modal-weight="option">0</button>
                            <button type="button" class="btn btn-light-primary w-100" data-kt-modal-weight="option">10</button>
                            <button type="button" class="btn btn-light-primary w-100" data-kt-modal-weight="option">20</button>
                            <button type="button" class="btn btn-light-primary w-100" data-kt-modal-weight="option">30</button>
                        </div>
                        <!--begin::Bid options-->
                        <input id="weight-p" type="number" class="form-control form-control-solid" placeholder="Masukan Berat Barang" name="weight_amount" />
                    </div>
                    <!--end::Input group weight-->

                    <!--begin::Input group volume-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Volume (m3)</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Data hanya akan ditampilkan di admin.">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            </span>
                        </label>
                        <!--end::Label-->

                        <!--begin::Bid options-->
                        <input id="shipping-id" type="hidden" name="id">
                        <div class="d-flex flex-stack gap-5 mb-3">
                            <button type="button" class="btn btn-light-primary w-100" data-kt-modal-volume="option">0</button>
                            <button type="button" class="btn btn-light-primary w-100" data-kt-modal-volume="option">100</button>
                            <button type="button" class="btn btn-light-primary w-100" data-kt-modal-volume="option">200</button>
                            <button type="button" class="btn btn-light-primary w-100" data-kt-modal-volume="option">300</button>
                        </div>
                        <!--begin::Bid options-->
                        <input id="volume-p" type="number" class="form-control form-control-solid" placeholder="Masukan Volume" name="volume_amount" />
                    </div>
                    <!--end::Input group volume-->

                    <!--begin::Notice-->
                    <div class="notice d-flex bg-light-danger rounded border-primary border border-dashed mb-9 p-6">
                        <!--begin::Icon-->
                        <i class="ki-duotone ki-note fs-2tx text-danger me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i> <!--end::Icon-->

                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-grow-1 ">
                            <!--begin::Content-->
                            <div class=" fw-semibold">
                                <h4 class="text-gray-900 fw-bold">Catatan:</h4>
                                <div class="fs-6 text-gray-700 ">Pastikan harga yang dimasukan sudah dihitung dan sudah benar.</div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Notice-->

                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3" data-kt-weight-modal-action-type="cancel">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-primary" data-kt-weight-modal-action-type="submit">
                            <span class="indicator-label">
                                Submit
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end:Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - New Target-->