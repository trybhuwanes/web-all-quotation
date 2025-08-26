<!--begin::Form-->
<form id="kt_add_setting_form" class="form" action="#">
    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <!--begin::Table head-->
        <thead>
            <!--begin::Table row-->
            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                <th class="w-10px pe-2">No.</th>
                <th class="min-w-100px">Asal Institusi</th>
                <th class="min-w-100px">Nama</th>
                <th class="min-w-100px">Kontak</th>
                <th class="min-w-100px">Kebutuhan</th>
                <th class="min-w-100px">Aksi</th>
            </tr>
            <!--end::Table row-->
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="text-gray-600 fw-semibold">
            <!--begin::Table row-->
            @foreach ($allpresensi as $presensi)
                <tr id="row-{{ str_replace(' ', '-', $presensi->key) }}">

                    <!--begin::Iteration-->
                    <td>
                        <span class="text-gray-800 text-hover-primary mb-1">
                            {{ $loop->iteration }}.
                        </span>
                    </td>
                    <!--end::Iteration-->

                    <!--begin::Name-->
                    <td>
                        <div class="d-flex justify-content-start flex-column">
                            <a href="#" class="text-gray-900 fw-bold mb-1 fs-6">{{ $presensi->institusi }}</a>
                            <a href="#" class="text-muted fw-semibold text-muted d-block fs-7">
                                <span class="text-gray-900">Lokasi</span>: {{ $presensi->lokasi_institusi }}</a>
                        </div>
                    </td>
                    <!--end::Name-->

                    <!--begin::Name-->
                    <td>
                        <div class="d-flex justify-content-start flex-column">
                            <a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">{{ $presensi->nama }}</a>
                            
                            <a href="#" class="text-muted text-hover-primary fw-semibold text-muted d-block fs-7">
                                <span class="text-gray-900">Jabatan</span>: {{ $presensi->jabatan }}</a>
                        </div>
                    </td>
                    <!--end::Name-->

                    <!--begin::Name-->
                    <td>
                        <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">{{ $presensi->telpon }}</a>
                        <span class="text-muted fw-semibold text-muted d-block fs-7">{{ $presensi->email }}</span>
                    </td>
                    <!--begin::Name-->

                    <!--begin::Name-->
                    <td>
                        @foreach ($presensi->kebutuhan as $item)
                        <span class="badge badge-light-info">{{ $item }}</span><br>
                        @endforeach
                    </td>
                    <!--begin::Name-->
                    

                    <!--begin::Button value-->
                        <td>
                            
                            <!--begin::Menu item-->
                            <a href="{{ route('presensi.show', $presensi->id) }}" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4 me-2">
                                Detail
                            </a>
                            <!--end::Menu item-->

                            @if ($presensi->status_pic === false)
                            <a href="{{ route('presensi.edit', $presensi->id) }}" class="btn btn-bg-info btn-color-muted btn-active-color-primary btn-sm px-4">
                                Tentukan PIC
                            </a>
                            @endif
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
{{ $allpresensi->links('components.pagination.bootstrap-5') }}
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
