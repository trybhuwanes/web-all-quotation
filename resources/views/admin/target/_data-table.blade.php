<!--begin::Form-->
<form id="kt_report_setting_form" class="form" action="">
    <!--begin::Table-->
    <table class="table table-striped align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <!--begin::Table head-->
        <thead>
            <!--begin::Table row-->
            <tr class="text-center fw-bold fs-7 text-uppercase">
                <th class="w-10px ps-2">No.</th>
                <th class="min-w-100px">PIC</th>
                <th class="min-w-100px">Target Omzet 1 Tahun</th>
                <th class="min-w-100px">Aksi</th>
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
                    <td class="text-center">
                        <div class="text-center">
                            <span class="text-gray-800 text-hover-primary mb-1 text-center">
                                {{ $loop->iteration }}.
                            </span>
                        </div>
                        
                    </td>
                    <!--end::Iteration-->

                    <!--begin::Nama-->
                    <td>
                        <div class="d-flex justify-content-start flex-column"> 
                            <a href="#" class="text-gray-900 fw-bold mb-1 fs-6">{{ $target->name}}</a>
                        </div>
                    </td>
                    <!--end::Nama-->

                    <!--begin::Target-->
                    <td>
                        <div class="text-center"> 
                            <div class="fw-bold text-gray-800">@idr($target->targets->sum('target'))</div> 
                        </div>
                    </td>
                    <!--end::Target-->

                    <!--begin::Button value-->
                    <td class="text-center">
                        
                        <div class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary menu-item px-3">
                            <a href="{{ route('targets.show', $target->id) }}" class="detail menu-link px-3">
                                {{ __('Daftar Target') }}
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
