<!--begin::Form-->
<form id="kt_report_setting_form" class="form" action="">
    <!--begin::Table-->
    <table class="table table-striped align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <!--begin::Table head-->
        <thead>
            <!--begin::Table row-->
            <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                <th class="w-10px pe-2 text-center">No.</th>
                <th class="min-w-100px text-center">Bulan</th>
                <th class="min-w-100px text-center">Target</th>
                <th class="min-w-100px text-center">Aksi</th>
            </tr>
            <!--end::Table row-->
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="text-gray-600 fw-semibold">
            <!--begin::Table row-->
            @foreach ($targets as $target)
                <tr id="row-{{ str_replace(' ', '-', $target->key) }}">

                    <!--begin::Iteration-->
                    <td>
                        <span class="text-gray-800 text-hover-primary mb-1">
                            {{ $loop->iteration }}.
                        </span>
                    </td>
                    <!--end::Iteration-->

                    <!--begin::Name kategori-->
                    <td>
                        <div class="text-center"> 
                            <a href="#" class="text-gray-900 fw-bold mb-1 fs-6">{{ $target->month}}</a>
                        </div>
                    </td>
                    <!--end::Name kategori-->

                    <!--begin::Logo-->
                    <td>
                        <div class="text-center"> 
                            <div class="fw-bold text-gray-800">@idr($target->target)</div> 
                        </div>
                    </td>
                    <!--end::Logo-->

                    <!--begin::Button value-->
                    <td class="text-center">
                        
                        <div class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary menu-item px-3">
                                <a href="javascript:;" class="edit menu-link px-3" 
                                data-kt-id="{{ $target->id }}" 
                                data-kt-target-month="{{ $target->month }}" 
                                data-kt-target-amount="{{ $target->target }}" 
                                data-kt-target-year="{{ $target->year }}">
                                    {{ __('common.btn_edit') }}
                                </a>
                            </div>
                    </td>
                    <!--end::Button value-->
                </tr>
            @endforeach
            <!--end::Table row-->
        </tbody>
        <!--end::Table body-->
        <tfoot>
            {{-- <tr>
                <th colspan="4">
                    <button type="submit" class="btn btn-primary float-end" data-kt-settings-action="submit">
                        <span class="indicator-label">{{ __('common.btn_save_x', ['x' => __('fields.pengaturan')]) }}</span>
                        <span class="indicator-progress">
                            {{ __('common.please_wait') }}...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </th>
            </tr> --}}
        </tfoot>
    </table>
    <!--end::Table-->
</form>
<!--end::Form-->
<!--begin::Pagination-->
{{-- {{ $targets->links('components.pagination.bootstrap-5') }} --}}
<!--end::Pagination-->


{{-- @push('js')
    <script>
        $(document).ready(function() {
            var jabatan = document.querySelectorAll('[data-kt-group="position_id"]');;
            jabatan.forEach(function(value, key) {
                $(value).select2({
                    ajax: {
                        url: route('select2.management-position'),
                        dataType: "json",
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term, // search term
                                page: params.page,
                            };
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;

                            return {
                                results: data,
                                pagination: {
                                    more: params.page * 10 < data.total_count,
                                },
                            };
                        },
                        cache: true,
                    },
                    dropdownParent: "#kt_add_setting_form",
                })
            })
        })
    </script>
@endpush --}}
