<!--begin::Add user-->
<a type="button" class="btn btn-primary" id="btn-modal-add"
    @if (isset($type) && $type == 'link') href="{{ Request::url() . '/create' }}" @else data-bs-toggle="modal" data-bs-target="#kt_modal_add_user" @endif>
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
    <span class="svg-icon svg-icon-2">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                transform="rotate(-90 11.364 20.364)" fill="currentColor" />
            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
        </svg>
    </span>
    @if (! empty($btnAddLabel))
        {{ __('common.btn_add_x', ['x' => $btnAddLabel]) }}
    @else
        {{ __('common.btn_add') }}
    @endif
    <!--end::Svg Icon-->
</a>
<!--end::Add user-->
