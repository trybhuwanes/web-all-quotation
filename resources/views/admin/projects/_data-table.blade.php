<!--begin::Form-->
<form id="kt_report_setting_form" class="form" action="">
    <!--begin::Table-->
    <table class="table table-striped align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <!--begin::Table head-->
        <thead>
            <!--begin::Table row-->
            <tr class="text-center fw-bold fs-7 text-uppercase gs-0">
                <th class="w-10px ps-2 text-center">No.</th>
                <th class="min-w-100px text-center">Foto</th>
                <th class="min-w-100px text-center">Produk</th>
                <th class="min-w-100px text-center">Perusahaan</th>
                <th class="max-w-50px text-center">Aksi</th>
            </tr>
            <!--end::Table row-->
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="text-gray-600 fw-semibold">
            <!--begin::Table row-->
            @foreach ($projects as $project)
                <tr id="row-{{ str_replace(' ', '-', $project->key) }}">

                    <!--begin::Iteration-->
                    <td>
                        <div class="text-center">
                            <span class="text-gray-800 text-hover-primary mb-1">
                                {{ $loop->iteration }}.
                            </span>
                        </div>
                    </td>
                    <!--end::Iteration-->

                    <!--begin::Foto-->
                    <td class="text-center">
                        <div class="d-flex justify-content-start flex-column">
                            <div class="d-flex align-items-center">
                                <!--begin::Galery-->
                                @if ($project->getMedia('project-gallery') != null)
                                    <a href="" class="symbol symbol-50px">
                                        @foreach($project->getMedia('project-gallery') as $gallery)
                                            <img class="symbol-label" src="{{ $gallery->getUrl() }}" alt="{{ $gallery->name }}">
                                        @endforeach
                                    </a>
                                @else
                                    <p>-</p>
                                @endif
                                <!--end::Galery-->
                            </div>
                        </div>
                    </td>
                    <!--end::Foto-->

                    <!--begin::Produk-->
                    <td>
                        <div class="d-flex align-items-center">
                            <!--begin::Title-->
                            <span class="text-gray-800 fs-7 fw-bold">{{ $project->product->nama_produk }}</span>
                            <!--end::Title-->
                        </div>
                    </td>
                    <!--end::Produk-->

                    <!--begin::Perusahaan-->
                    <td>
                        <div class="d-flex align-items-center">
                            <!--begin::Title-->
                            <span class="text-gray-800 fs-7 fw-bold">{{ $project->company_name }}</span>
                            <!--end::Title-->
                        </div>
                    </td>
                    <!--end::Perusahaan-->

                    <!--begin::Created At-->
                    {{-- <td>
                        <div class="d-flex justify-content-start flex-column">
                            <span class="text-gray-800 fs-7 fw-bold">{{  App\Helpers\Helper::dateFormat($order->created_at, 'd/m/Y') }}</span>
                        </div>
                    </td> --}}
                    <!--end::Created At-->

                    <!--begin::Button value-->
                    <td class="text-end">
                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            Actions
                            <i class="fa-solid fa-caret-down fs-5 ms-1"></i>
                        </a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item Button Edit-->
                            <div class="menu-item px-3">
                                <a href="{{ route('projects.edit', $project->id) }}" class="edit menu-link px-3" 
                                data-kt-user-id="{{ $project->id }}" 
                                data-kt-user-name="{{ $project->company_name }}" 
                                data-kt-user-categori="{{ $project->product_id }}" 
                                data-kt-user-deskripsi="{{ $project->description }}">
                                    {{ __('common.btn_edit') }}
                                </a>
                            </div>
                            <!--begin::Menu item Button Edit-->
                            
                            <!--begin::Menu item Button Detail-->
                            <div class="menu-item px-3">
                                <a href="{{ route('projects.show', $project->id) }}" class="show menu-link px-3" 
                                data-kt-user-id="{{ $project->id }}" 
                                data-kt-user-name="{{ $project->company_name }}" 
                                data-kt-user-categori="{{ $project->product_id }}" 
                                data-kt-user-deskripsi="{{ $project->description }}">
                                    {{ __('common.btn_detail') }}
                                </a>
                            </div>
                            <!--begin::Menu item Button Detail-->

                            <!--begin::Menu item Button Delete-->
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" 
                                    class="menu-link px-3 text-danger delete-project" 
                                    data-id="{{ $project->id }}">
                                        {{ __('common.btn_delete') }}
                                </a>
                            </div>
                            <!--begin::Menu item Button Delete-->
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
{{ $projects->links('components.pagination.bootstrap-5') }}
<!--end::Pagination-->

