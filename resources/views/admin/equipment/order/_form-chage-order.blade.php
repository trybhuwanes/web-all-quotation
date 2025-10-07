<!--begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-850px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold" id="modal-title"> {{ __('Status Order') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor" />
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
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_user_form" class="form" action="#">
                    <!--begin::Alert-->
                    <div id="form-error"
                        class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10 d-none">
                        <!--begin::Icon-->
                        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4 mb-5 mb-sm-0">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                    fill="currentColor" />
                                <rect x="9" y="13.0283" width="7.3536" height="1.2256" rx="0.6128"
                                    transform="rotate(-45 9 13.0283)" fill="currentColor" />
                                <rect x="9.86664" y="7.93359" width="7.3536" height="1.2256" rx="0.6128"
                                    transform="rotate(45 9.86664 7.93359)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Icon-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column pe-0 pe-sm-10">
                            <!--begin::Title-->
                            <h4 class="fw-semibold">{{ __('Oops!') }}</h4>
                            <!--end::Title-->
                            <!--begin::Content-->
                            <span id="form-error-message" class="text-gray-800"></span>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Close-->
                        <button type="button"
                            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                            data-bs-dismiss="alert">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-danger">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--end::Close-->
                    </div>
                    <!--end::Alert-->
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                        {{-- <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">
                                {{ __('Nama Lengkap') }}
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            
                            <input id="user-name" type="text" name="name"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Name" />
                            <span id="error-user-name" class="fv-plugins-message-container invalid-feedback"></span>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group--> --}}

                        <div class="pb-1 pb-lg-4">
                            <!--begin::Title-->
                            <h2 class="fw-bold d-flex align-items-center text-gray-900">Pilih Status pesanan
                                <span class="ms-1" data-bs-toggle="tooltip"
                                    aria-label="Penagihan dikeluarkan berdasarkan jenis akun yang Anda pilih"
                                    data-bs-original-title="Billing is issued based on your selected account typ"
                                    data-kt-initialized="1">
                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span
                                            class="path1"></span><span class="path2"></span><span
                                            class="path3"></span></i></span>
                            </h2>
                            <!--end::Title-->

                            <!--begin::Notice-->
                            <div class="text-muted fw-semibold fs-6">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        Informasi Status order membantu pelanggan mengetahui posisi atau tahapan pesanan mereka.
                                    </font>
                                </font>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;"> .
                                    </font>
                                </font>
                                <input id="soid" type="hidden" name="id">
                            </div>
                            <!--end::Notice-->
                        </div>

                        <!--begin::Aktivasi akun-->
                        <div class="fv-row fv-plugins-icon-container">
                            <!--begin::Row-->
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-lg-4 mb-1">
                                    <!--begin::Option-->
                                    <input type="radio" class="btn-check" name="so" value="{{ App\Enums\OrderStatusEnum::pending->value }}"
                                        id="kt_create_account_form_so_{{ App\Enums\OrderStatusEnum::pending->value }}">
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-warning p-2 d-flex align-items-center"
                                        for="kt_create_account_form_so_{{ App\Enums\OrderStatusEnum::pending->value }}">
                                        <i class="ki-duotone ki-timer fs-3x me-5"><span class="path1"></span><span class="path2"></span><span
                                                class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                        <!--begin::Info-->
                                        <span class="d-block fw-semibold text-start">
                                            <span class="text-gray-900 fw-bold d-block fs-6 mb-2">{{ __('Pending') }}</span>
                                        </span>
                                        <!--end::Info-->
                                    </label>
                                    <!--end::Option-->
                                    {{-- <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div> --}}
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-lg-4 mb-1">
                                    <!--begin::Option-->
                                    <input type="radio" class="btn-check" name="so" value="{{ App\Enums\OrderStatusEnum::processing->value }}"
                                        id="kt_create_account_form_so_{{ App\Enums\OrderStatusEnum::processing->value }}">
                                    <label
                                        class="btn btn-outline btn-outline-dashed btn-active-light-dark p-2 d-flex align-items-center"
                                        for="kt_create_account_form_so_{{ App\Enums\OrderStatusEnum::processing->value }}">
                                        <i class="ki-duotone ki-abstract-18 fs-3x me-5"><span class="path1"></span><span class="path2"></span></i>
                                        <!--begin::Info-->
                                        <span class="d-block fw-semibold text-start">
                                            <span class="text-gray-900 fw-bold d-block fs-6 mb-2">{{ __('Processing') }}</span>
                                        </span>
                                        <!--end::Info-->
                                    </label>
                                    <!--end::Option-->
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-lg-4 mb-1">
                                    <!--begin::Option-->
                                    <input type="radio" class="btn-check" name="so" value="{{ App\Enums\OrderStatusEnum::submission->value }}"
                                        id="kt_create_account_form_so_{{ App\Enums\OrderStatusEnum::submission->value }}">
                                    <label
                                        class="btn btn-outline btn-outline-dashed btn-active-light-info p-2 d-flex align-items-center"
                                        for="kt_create_account_form_so_{{ App\Enums\OrderStatusEnum::submission->value }}">
                                        <i class="ki-duotone ki-file-right fs-3x me-5"><span class="path1"></span><span class="path2"></span></i>
                                        <!--begin::Info-->
                                        <span class="d-block fw-semibold text-start">
                                            <span class="text-gray-900 fw-bold d-block fs-6 mb-2">{{ __('Submission') }}</span>
                                        </span>
                                        <!--end::Info-->
                                    </label>
                                    <!--end::Option-->
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-lg-4 mb-1">
                                    <!--begin::Option-->
                                    <input type="radio" class="btn-check" name="so" value="{{ App\Enums\OrderStatusEnum::completed->value }}"
                                        id="kt_create_account_form_so_{{ App\Enums\OrderStatusEnum::completed->value }}">
                                    <label
                                        class="btn btn-outline btn-outline-dashed btn-active-light-success p-2 d-flex align-items-center"
                                        for="kt_create_account_form_so_{{ App\Enums\OrderStatusEnum::completed->value }}">
                                        <i class="ki-duotone ki-shield-tick fs-3x me-5"><span class="path1"></span><span class="path2"></span></i>
                                        <!--begin::Info-->
                                        <span class="d-block fw-semibold text-start">
                                            <span class="text-gray-900 fw-bold d-block fs-6 mb-2">{{ __('Completed') }}</span>
                                        </span>
                                        <!--end::Info-->
                                    </label>
                                    <!--end::Option-->
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-lg-4 mb-1">
                                    <!--begin::Option-->
                                    <input type="radio" class="btn-check" name="so" value="{{ App\Enums\OrderStatusEnum::cancelled->value }}"
                                        id="kt_create_account_form_so_{{ App\Enums\OrderStatusEnum::cancelled->value }}">
                                    <label
                                        class="btn btn-outline btn-outline-dashed btn-active-light-danger p-2 d-flex align-items-center"
                                        for="kt_create_account_form_so_{{ App\Enums\OrderStatusEnum::cancelled->value }}">
                                        <i class="ki-duotone ki-shield-cross fs-3x me-5"><span class="path1"></span><span class="path2"></span></i>
                                        <!--begin::Info-->
                                        <span class="d-block fw-semibold text-start">
                                            <span class="text-gray-900 fw-bold d-block fs-6 mb-2">{{ __('Cancelled') }}</span>
                                        </span>
                                        <!--end::Info-->
                                    </label>
                                    <!--end::Option-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Aktivasi akun-->





                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3"
                            data-kt-users-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">{{ __('common.please_wait') }}...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add task-->
