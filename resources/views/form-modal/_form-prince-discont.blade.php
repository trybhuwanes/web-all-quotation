<!--begin::Modal - New Target-->
<div class="modal fade" id="kt_modal_discount" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-kt-discount-modal-action-type="close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin:Form-->
                <form id="kt_modal_discount_form" class="form" action="#">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Diskon</h1>
                        <!--end::Title-->

                        <!--begin::Description-->
                        <div class="text-muted fw-semibold fs-5">
                            Masukan <span class="fw-bold link-primary">Diskon</span> dalam bentuk nominal.
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->

                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Diskon (Rp)</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Diskon ini akan di informasikan pada customer.">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            </span>
                        </label>
                        <!--end::Label-->

                        <!--begin::Bid options-->
                        <input id="o-id" type="hidden" name="id">
                        <div class="d-flex flex-stack gap-5 mb-3">
                            <button type="button" class="btn btn-light-primary w-100" data-kt-modal-discount="option">1.000.000</button>
                            <button type="button" class="btn btn-light-primary w-100" data-kt-modal-discount="option">2.000.000</button>
                            <button type="button" class="btn btn-light-primary w-100" data-kt-modal-discount="option">3.000.000</button>
                        </div>
                        <!--begin::Bid options-->
                        <input id="discount" type="number" class="form-control form-control-solid" placeholder="Masukan diskon" name="discount_amount" />
                    </div>
                    <!--end::Input group-->

                    <!--begin::Notice-->
                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                        <!--begin::Icon-->
                        <i class="ki-duotone ki-discount fs-2tx text-primary me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i> <!--end::Icon-->

                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-grow-1 ">
                            <!--begin::Content-->
                            <div class=" fw-semibold">
                                <h4 class="text-gray-900 fw-bold">Diskon Harga</h4>
                                <div class="fs-6 text-gray-700 ">Pastikan diskon yang dimasukan sudah benar.</div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Notice-->

                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3" data-kt-discount-modal-action-type="cancel">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-primary" data-kt-discount-modal-action-type="submit">
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