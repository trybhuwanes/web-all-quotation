<!--begin::Modal - New Target-->
<div class="modal fade" id="kt_modal_addproduct" tabindex="-1" aria-hidden="true">
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
                <span id="kt_modal_addproduct_form" class="form">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Daftar Additional Produk</h1>
                        <!--end::Title-->

                        <!--begin::Description-->
                        <div class="text-muted fw-semibold fs-5">
                            Pilih <span class="fw-bold link-primary">Produk Tambahan</span> yang ingin dimasukan.
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->

                    <!--begin::Input group-->
                    <div class="mh-475px scroll-y me-n7 pe-7">
                        @foreach ($availableProductAdds as $productAdd)
                            @if (strtolower($productAdd->nama_produk_tambahan) !== 'panel control for aerator')
                                <!--begin::User-->
                                <div class="border border-hover-primary p-7 rounded mb-7">
                                    <!--begin::Wrapper-->
                                    <div class="p-0">
                                        <!--begin::Footer-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Action-->
                                            <div class="d-flex flex-stack">
                                                <!--begin::Progress-->
                                                <div class="d-flex flex-column mw-200px">
                                                    <span class="text-gray-900 fw-bold fs-5">{{ $productAdd->nama_produk_tambahan }}</span>
                                                </div>
                                                <!--end::Progress-->

                                                <!--begin::Button-->
                                                <form action="{{ route('pic.cart.addAdditionalProduct') }}" method="POST" id="form-{{ $productAdd->id }}">
                                                    @csrf
                                                    <input type="hidden" name="o_id" value="{{ $orderdetail->id }}">
                                                    <input type="hidden" name="productadd_id" value="{{ $productAdd->id }}">
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="ki-duotone ki-handcart fs-4"></i> Pilih
                                                    </button>
                                                </form>
                                                <!--end::Button-->
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Footer-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::User-->
                            @endif
                        @endforeach
          
                    </div>
                    <!--end::Input group-->



                    <!--begin::Notice-->
                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                        <!--begin::Icon-->
                        <i class="ki-duotone ki-shop fs-2tx text-primary me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i> <!--end::Icon-->

                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-grow-1 ">
                            <!--begin::Content-->
                            <div class=" fw-semibold">
                                <h4 class="text-gray-900 fw-bold">Produk Tambahan</h4>
                                <div class="fs-6 text-gray-700 ">Pastikan produk tambahan yang dipilih sudah benar.</div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Notice-->

                    {{-- <!--begin::Actions-->
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
                    <!--end::Actions--> --}}
                </span>
                <!--end:Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - New Target-->