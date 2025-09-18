<!--begin::Form-->
<form id="kt_report_setting_form" class="form" action="">
    <!--begin::Table-->
    <table class="table table-striped align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <!--begin::Table head-->
        <thead>
            <!--begin::Table row-->
            <tr class="text-center fw-bold fs-7 text-uppercase gs-0">
                <th class="w-10px ps-2 text-center">No.</th>
                <th class="min-w-100px text-center">Nama & Perusahaan</th>
                <th class="min-w-100px text-center">Peran</th>
                <th class="min-w-100px text-center">Tgl Masuk</th>
                <th class="min-w-100px text-center">Status Akun</th>
                <th class="min-w-100px text-center">Aksi</th>
            </tr>
            <!--end::Table row-->
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="text-gray-600 fw-semibold">
            <!--begin::Table row-->
            @foreach ($alluser as $user)
                <tr id="row-{{ str_replace(' ', '-', $user->key) }}">

                    <!--begin::Iteration-->
                    <td>
                        <div class="text-center">
                            <span class="text-gray-800 text-hover-primary mb-1 text-center">
                                {{ $loop->iteration }}.
                            </span>
                        </div>
                    </td>
                    <!--end::Iteration-->

                    <!--begin::Name-->
                    <td>
                        <div class="d-flex justify-content-start flex-column">
                            <span class="text-gray-900 fw-bold mb-1 fs-7">{{ $user->name}}</span>
                            <span class="text-muted fw-semibold text-muted d-block fs-7">
                                <span class="text-gray-900">Perusahaan</span>: {{ $user->company }}
                            </span>
                        </div>
                    </td>
                    <!--end::Name-->

                    <td class="text-center fs-7">
                        <span class="text-gray-800 text-uppercase">
                            {{ $user->role }}
                        </span>
                    </td>

                    <td class="text-center fs-7">
                        <span class="text-gray-800">
                            {{  App\Helpers\Helper::dateFormat($user->created_at, 'd/m/Y') }}
                        </span>
                    </td>


                    <!--begin::Contact-->
                    <td class="text-center">
                        {!! \App\Enums\AccountStatusEnum::badge($user->status) !!}
                    </td>
                    <!--end::Contact-->

                    <!--begin::Button value-->
                    <td class="text-end">
                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            Actions
                            <i class="fa-solid fa-caret-down fs-5 ms-1"></i>
                        </a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
                            <!--begin::Menu item Button Ubah Status-->
                            <div class="menu-item px-3">
                                <a href="javascript:;" class="edit menu-link px-3" 
                                data-kt-user-id="{{ $user->id }}"
                                data-kt-user-photo="{{ $user->photo }}" 
                                data-kt-user-name="{{ $user->name }}" 
                                data-kt-user-email="{{ $user->email }}" 
                                data-kt-user-phone="{{ $user->phone }}" 
                                data-kt-user-status="{{ $user->status }}" 
                                data-kt-user-job_title="{{ $user->job_title }}" 
                                data-kt-user-company="{{ $user->company }}" 
                                data-kt-user-location_company="{{ $user->location_company }}" 
                                data-kt-user-field_company="{{ $user->field_company }}" 
                                {{-- data-kt-user-deskripsi="{{ $user->deskripsi }}"> --}}
                                data-kt-user-detail_company="{{ $user->detail_company }}" >
                                    {{ __('common.btn_edit') }} Status
                                </a>
                            </div>
                            <!--begin::Menu item Button Ubah Status-->

                            <!--begin::Menu item Button Tampilkan Data-->
                            <div class="menu-item px-3">
                                <a href="{{ route('alluser.show', $user->id) }}" class="menu-link px-3" 
                                data-kt-user-id="{{ $user->id }}"
                                data-kt-user-photo="{{ $user->photo }}" 
                                data-kt-user-name="{{ $user->name }}" 
                                data-kt-user-email="{{ $user->email }}" 
                                data-kt-user-phone="{{ $user->phone }}" 
                                data-kt-user-status="{{ $user->status }}" 
                                data-kt-user-job_title="{{ $user->job_title }}" 
                                data-kt-user-company="{{ $user->company }}" 
                                data-kt-user-location_company="{{ $user->location_company }}" 
                                data-kt-user-field_company="{{ $user->field_company }}" 
                                {{-- data-kt-user-deskripsi="{{ $user->deskripsi }}"> --}}
                                data-kt-user-detail_company="{{ $user->detail_company }}" >
                                    {{ __('common.btn_show') }} Data
                                </a>
                            </div>
                            <!--end::Menu item Button Tampilkan Data-->

                            <!--begin::Menu item Button Ubah Data-->
                            <div class="menu-item px-3">
                                <a href="{{ route('alluser.edit', $user->id) }}" class="menu-link px-3" 
                                data-kt-user-id="{{ $user->id }}"
                                data-kt-user-photo="{{ $user->photo }}" 
                                data-kt-user-name="{{ $user->name }}" 
                                data-kt-user-email="{{ $user->email }}" 
                                data-kt-user-phone="{{ $user->phone }}" 
                                data-kt-user-status="{{ $user->status }}" 
                                data-kt-user-job_title="{{ $user->job_title }}" 
                                data-kt-user-company="{{ $user->company }}" 
                                data-kt-user-location_company="{{ $user->location_company }}" 
                                data-kt-user-field_company="{{ $user->field_company }}" 
                                {{-- data-kt-user-deskripsi="{{ $user->deskripsi }}"> --}}
                                data-kt-user-detail_company="{{ $user->detail_company }}" >
                                    {{ __('common.btn_edit') }} Data
                                </a>
                            </div>
                            <!--end::Menu item Button Ubah Data-->
                            
                            <!--begin::Menu item Button Delete-->
                            {{-- <div class="menu-item px-3">
                                <a href="javascript:;" class="delete menu-link px-3" 
                                data-kt-user-id="{{ $user->id }}" 
                                data-kt-user-name="{{ $user->nama_kategori }}" 
                                data-kt-users-table-filter="delete_row">
                                    {{ __('common.btn_delete') }}
                                </a>
                            </div> --}}
                            <!--begin::Menu item Button Delete-->

                            <!--begin::Menu item Button Show-->
                            {{-- <div class="menu-item px-3">
                                <a href="javascript:;" class="detail menu-link px-3" 
                                data-kt-user-id="{{ $user->id }}" 
                                data-kt-user-name="{{ $user->nama_kategori }}" 
                                data-kt-user-logo="{{ $user->logo }}" 
                                data-kt-user-deskripsi="{{ $user->deskripsi }}">
                                    {{ __('common.btn_show') }}
                                </a>
                            </div> --}}
                            <!--begin::Menu item Button Show-->

                            
                        </div>
                        <!--end::Menu-->
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
{{ $alluser->links('components.pagination.bootstrap-5') }}
<!--end::Pagination-->

