<!--begin::Form-->
<form id="kt_report_setting_form" class="form" action="">
    <!--begin::Table-->
    <table class="table table-striped align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <!--begin::Table head-->
        <thead>
            <!--begin::Table row-->
            <tr class="text-center fw-bold fs-7 text-uppercase gs-0">
                <th class="w-10px ps-2">No.</th>
                <th class="min-w-100px">Bulan</th>
                <th class="min-w-100px">Tahun</th>
                <th class="min-w-100px">Target</th>
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
                    <td>
                        <div class="text-center ms-2">
                            <span class="text-gray-800 text-hover-primary mb-1">
                                {{ $loop->iteration }}.
                            </span>
                        </div>
                    </td>
                    <!--end::Iteration-->

                    <!--begin::Name kategori-->
                    <td>
                        <div class="text-center"> 
                            {{ \Carbon\Carbon::create()->month($target->month)->translatedFormat('F') }}
                        </div>
                    </td>
                    <!--end::Name kategori-->
                    
                    <!--begin::Name kategori-->
                    <td>
                        <div class="text-center"> 
                            {{ $target->year }}
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
                                    {{ __('common.btn_edit') }} Target
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
{{ $targets->links('components.pagination.bootstrap-5') }}
<!--end::Pagination-->


