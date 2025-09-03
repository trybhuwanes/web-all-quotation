<!--begin::Form-->
<form id="kt_report_setting_form" class="form" action="">
    <!--begin::Table-->
    <table class="table table-striped align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <!--begin::Table head-->
        <thead>
            <!--begin::Table row-->
            <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                <th class="w-10px pe-2 text-center">No.</th>
                <th class="min-w-100px text-center">Order ID</th>
                <th class="min-w-100px text-center">PIC</th>
                <th class="min-w-100px text-center">Customer</th>
                <th class="min-w-150px text-center">Perusahaan</th>
                <th class="min-w-150px text-center">Pengiriman</th>
                <th class="min-w-50px text-center">Status</th>
                <th class="min-w-50px text-center">Tgl Order</th>
                <th class="min-w-100px text-center">Aksi</th>
            </tr>
            <!--end::Table row-->
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="text-gray-600 fw-semibold">
            <!--begin::Table row-->
            @foreach ($orderall as $order)
                <tr id="row-{{ str_replace(' ', '-', $order->key) }}">

                    <!--begin::Iteration-->
                    <td>
                        <span class="text-gray-800 text-hover-primary mb-1">
                            {{ $loop->iteration }}.
                        </span>
                    </td>
                    <!--end::Iteration-->

                    <!--begin::Trx Code-->
                    <td>
                        <div class="d-flex justify-content-start flex-column">
                            <a href="#" class="text-gray-900 fw-bold mb-1 fs-7">{{ $order->trx_code}}</a>
                        </div>
                    </td>
                    <!--end::Trx Code-->

                    <!--begin::PIC-->
                    <td>
                        <div class="d-flex align-items-center">
                            <!--begin::Title-->
                            <span class="text-gray-800 fs-7 fw-bold">{{ optional($order->pic)->name ?? '-' }}</span>
                            <!--end::Title-->
                        </div>
                    </td>
                    <!--end::PIC-->

                    <!--begin::Customer Name-->
                    <td>
                        <div class="d-flex align-items-center">
                            <!--begin::Title-->
                            <span class="text-gray-800 fs-7 fw-bold">{{$order->user->name}}</span>
                            <!--end::Title-->
                        </div>
                    </td>
                    <!--end::Customer Name-->

                    <!--begin::Company-->
                    <td>
                        <div class="d-flex align-items-center">
                            <!--begin::Title-->
                            <span class="text-gray-800 fs-7 fw-bold">{{$order->user->company}}</span>
                            <!--end::Title-->
                        </div>
                    </td>
                    <!--end::Company-->

                    <!--begin::Company Destination-->
                    <td>
                        <div class="d-flex align-items-center">
                            <!--begin::Title-->
                            @if ($order->shipping->company_destination)
                                <span class="text-gray-800 fs-7 fw-bold">{{$order->shipping->company_destination}}
                                    <p style="font-size: 11px">{{$order->shipping->country_destination}}, {{$order->shipping->state_destination}}</p>
                                </span>
                            @else
                                <span class="text-gray-800 fs-7 fw-bold">{{$order->user->company}}
                                    <p style="font-size: 11px">{{$order->shipping->country_destination}}, {{$order->shipping->state_destination}}</p>
                                </span>
                            @endif
                            <!--end::Title-->
                        </div>
                    </td>
                    <!--end::Company Destination-->

                    <!--begin::Status-->
                    <td>
                        <div class="d-flex justify-content-start flex-column">
                            <span class="text-gray-800 fs-5 fw-bold">{!! \App\Enums\OrderStatusEnum::badge($order->status) !!}</span>
                        </div>
                    </td>
                    <!--end::Status-->

                    <!--begin::Created At-->
                    <td>
                        <div class="d-flex justify-content-start flex-column">
                            <span class="text-gray-800 fs-7 fw-bold">{{  App\Helpers\Helper::dateFormat($order->created_at, 'd/m/Y') }}</span>
                        </div>
                    </td>
                    <!--end::Created At-->

                    <!--begin::Button value-->
                    <td class="text-end">
                        {{-- @if (!$order->pic_id) --}}
                        <a href="javascript:;" class="pic btn btn-sm btn-light btn-flex btn-center btn-active-light-primary px-4 me-2" 
                            data-kt-o-id="{{ $order->id }}"
                            data-kt-o-picid="{{ $order->pic_id }}"
                            data-kt-o-no="{{ $order->trx_code }}" 
                            data-kt-o-pname="{{ $order->pic_id ? $order->pic->name : '' }}"
                            data-kt-o-name="{{ $order->user->name }}"
                            data-kt-o-company="{{ $order->company }}" >
                                {{ __('Tentukan PIC') }}
                        </a>
                        {{-- @endif --}}

                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            Actions
                            <i class="fa-solid fa-caret-down fs-5 ms-1"></i>
                        </a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item Button Edit-->
                            <div class="menu-item px-3">
                                <a href="javascript:;" class="edit menu-link px-3" 
                                data-kt-user-id="{{ $order->id }}"
                                data-kt-user-photo="{{ $order->photo }}" 
                                data-kt-user-name="{{ $order->name }}" 
                                data-kt-user-email="{{ $order->email }}" 
                                data-kt-user-phone="{{ $order->phone }}" 
                                data-kt-user-status="{{ $order->status }}" 
                                data-kt-user-job_title="{{ $order->job_title }}" 
                                data-kt-user-company="{{ $order->company }}" 
                                data-kt-user-location_company="{{ $order->location_company }}" 
                                data-kt-user-field_company="{{ $order->field_company }}" 
                                {{-- data-kt-user-deskripsi="{{ $order->deskripsi }}"> --}}
                                data-kt-user-detail_company="{{ $order->detail_company }}" >
                                    {{ __('Ubah Status') }}
                                </a>
                            </div>

                            <!--begin::Menu item Button Show-->
                            <div class="menu-item px-3">
                                <a href="{{ route('order-admin.show', $order->id) }}" class="detail menu-link px-3">
                                    {{ __('Detail Order') }}
                                </a>
                            </div>
                            <!--begin::Menu item Button Show-->

                            <!--begin::Menu item PDF-->
                            {{-- <a href="{{ route('order-admin.export-pdf', $order->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                <i class="fa-solid fa-file-pdf fs-2"></i>
                            </a> --}}
                            <!--begin::Menu item PDF-->


                            <!--begin::Menu item PDF-->
                            <div class="menu-item px-3 text-center">
                                <a href="{{ route('order-admin.export-quot-pdf', $order->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                    <i class="fa-solid fa-file-pdf fs-2"> </i> Quotation
                                </a>
                            </div>
                            <!--begin::Menu item PDF-->
                            <!--begin::Menu item Button Edit-->
                            
                            <!--begin::Menu item Button Delete-->
                            {{-- <div class="menu-item px-3">
                                <a href="javascript:;" class="delete menu-link px-3" 
                                data-kt-user-id="{{ $order->id }}" 
                                data-kt-user-name="{{ $order->nama_kategori }}" 
                                data-kt-users-table-filter="delete_row">
                                    {{ __('common.btn_delete') }}
                                </a>
                            </div> --}}
                            <!--begin::Menu item Button Delete-->

                            <!--begin::Menu item Button Show-->
                            {{-- <div class="menu-item px-3">
                                <a href="javascript:;" class="detail menu-link px-3" 
                                data-kt-user-id="{{ $order->id }}" 
                                data-kt-user-name="{{ $order->nama_kategori }}" 
                                data-kt-user-logo="{{ $order->logo }}" 
                                data-kt-user-deskripsi="{{ $order->deskripsi }}">
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
{{ $orderall->links('components.pagination.bootstrap-5') }}
<!--end::Pagination-->

