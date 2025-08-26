@php
    $buttons = '';
    if (isset($additionalButtons)) {
        $buttons .= ',' . $additionalButtons;
    }
    $buttons = explode(',', $buttons);
@endphp
@props([
    'search' => true,
    'canCreate' => true,
    'canRead' => true,
    'canDelete' => true,
    'search' => true,
    'title' => null,
    'route' => null,
    'btnAddLabel' => '',
])
<!--begin::Card-->
<div class="card" {{ $attributes['id'] ? 'id='.$attributes['id'] : '' }} style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 0.375rem;" id="table-global">
    <!--begin::Card header-->
    <div class="@if ($title || $search) card-header @endif border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            @if ($title)
                <h2>{{ $title }}</h2>
            @endif
            @if ($search)
                @include('datatable._search')
            @endif
        </div>
        <!--begin::Card title-->
        <x-data-table-toolbar :buttons="$buttons" :canCreate="$canCreate" :canRead="$canRead" :canDelete="$canDelete" :route="$route"
            :btnAddLabel="$btnAddLabel">
            @if (isset($filterOptions))
                @slot('filterOptions')
                    {{ $filterOptions }}
                @endslot
            @endif
            @if (isset($exportOptions))
                @slot('exportOptions')
                    {{ $exportOptions }}
                @endslot
            @endif
            @if (isset($exportCsvOptions))
                @slot('exportCsvOptions')
                    {{ $exportCsvOptions }}
                @endslot
            @endif
            @if (isset($formCreate))
                @slot('formCreate')
                    {{ $formCreate }}
                @endslot
            @endif
            @if (isset($customAddButton))
                @slot('customAddButton')
                    {{ $customAddButton }}
                @endslot
            @endif
            @if (isset($introJsOptions))
                @slot('introJsOptions')
                    {{ $introJsOptions }}
                @endslot
            @endif
        </x-data-table-toolbar>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">
        @if (isset($data))
            {{ $data }}
        @endif
    </div>
    <!--end::Card body-->
    @isset($footer)
        <div class="card-footer d-flex justify-content-between">
            {{ $footer }}
        </div>
    @endisset
</div>
<!--end::Card-->
