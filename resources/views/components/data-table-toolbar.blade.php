<!--begin::Card toolbar-->
<div class="card-toolbar">
    <!--begin::Toolbar-->
    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
        @if (in_array('filter', $buttons) && $canRead)
            <x-data-table-toolbar-filter>
                @isset($filterOptions)
                    @slot('filterOptions')
                        {{ $filterOptions }}
                    @endslot
                @endisset
            </x-data-table-toolbar-filter>
        @endif
        @if (in_array('export', $buttons))
            <x-data-table-toolbar-export>
                @isset($exportOptions)
                    @slot('exportOptions')
                        {{ $exportOptions }}
                    @endslot
                @endisset
            </x-data-table-toolbar-export>
        @endif
        @if (in_array('reset_filter', $buttons) && $canRead)
            <x-reset-filter-button :route="$route" :btnAddLabel="$btnAddLabel" />
        @endif
        @if (in_array('print', $buttons) && $canCreate)
            <x-print-button :route="$route" :btnAddLabel="$btnAddLabel" />
        @endif
        @if (in_array('add', $buttons) && $canCreate)
            @include('datatable.toolbar._add-button')
        @endif
        @if (in_array('add_link', $buttons) && $canCreate)
            @include('datatable.toolbar._add-button', ['type' => 'link'])
        @endif
        @if (in_array('add_new_page', $buttons) && $canCreate)
            <x-add-button-new-page :route="$route" :btnAddLabel="$btnAddLabel" />
        @endif
        @if (in_array('export_csv', $buttons) && $canCreate)
            <x-data-table-toolbar-export-csv>
                @isset($exportCsvOptions)
                    @slot('exportCsvOptions')
                        {{ $exportCsvOptions }}
                    @endslot
                @endisset
            </x-data-table-toolbar-export-csv>
        @endif
        @if (in_array('custom_add', $buttons) && $canCreate)
            @if (isset($customAddButton))
                {{ $customAddButton }}
            @endif
        @endif
        @if (in_array('button_intro_js', $buttons) && $canCreate)
            @include('datatable.toolbar._intro-button')
        @endif
    </div>
    <!--end::Toolbar-->
    <!--begin::Group actions-->
    <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
        <div class="fw-bold me-5">
            <span class="me-2" data-kt-user-table-select="selected_count"></span>{{ __('common.selected') }}
        </div>
        <button type="button" class="btn btn-danger @if (!$canDelete) d-none @endif"
            data-kt-user-table-select="delete_selected">
            {{ __('common.btn_delete_selected') }}
        </button>
    </div>
    <!--end::Group actions-->
    @if (isset($exportOptions))
        {{ $exportOptions }}
    @endif
    @if (isset($formCreate))
        {{ $formCreate }}
    @endif
</div>
<!--end::Card toolbar-->
