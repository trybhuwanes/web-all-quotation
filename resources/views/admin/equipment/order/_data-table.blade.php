<!--begin::Form-->
<form id="kt_report_setting_form" class="form" action="">
    <table class="table table-striped align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <thead>
                <!--begin::Table row-->
                <tr class="text-center fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-10px ps-2 text-center">No.</th>
                    <th class="min-w-100px text-center">Order ID</th>
                    <th class="min-w-80px text-center">PIC</th>
                    <th class="max-w-80px text-center">Customer</th>
                    <th class="min-w-100px text-center">Perusahaan</th>
                    <th class="min-w-150px text-center">Pengiriman</th>
                    <th class="min-w-50px text-center">Status</th>
                    <th class="max-w-50px text-center">Tgl Order</th>
                    <th class="max-w-50px text-center">Aksi</th>
                </tr>
                <!--end::Table row-->
            </thead>
            <tbody class="text-gray-800 fw-semibold">
                @foreach ($orderall as $order)
                    <tr id="row-{{ str_replace(' ', '-', $order->key) }}">
                        <td>
                            <div class="text-center">
                                <span class="text-hover-primary mb-1">
                                    {{ $loop->iteration }}.
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-start flex-column">
                                <a href="#" class="text-gray-900 fw-bold mb-1 fs-7">{{ $order->trx_code}}</a>
                            </div>
                        </td>
                        <td>
                           <div class="d-flex align-items-center">
                                <span class="text-gray-800 fs-7 fw-bold">{{ optional($order->pic)->name ?? '-' }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="text-gray-800 fs-7 fw-bold">{{$order->user->name}}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="text-gray-800 fs-7 fw-bold">{{$order->user->company}}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if ($order->shipping->company_destination)
                                    <span class="text-gray-800 fs-7 fw-bold">{{$order->shipping->company_destination}}
                                        <p style="font-size: 11px">{{$order->shipping->country_destination}}, {{$order->shipping->state_destination}}</p>
                                    </span>
                                @else
                                    <span class="text-gray-800 fs-7 fw-bold">{{$order->user->company}}
                                        <p style="font-size: 11px">{{$order->shipping->country_destination}}, {{$order->shipping->state_destination}}</p>
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-start flex-column">
                                <span class="text-gray-800 fs-5 fw-bold">{!! \App\Enums\OrderStatusEnum::badge($order->status) !!}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-start flex-column">
                                <span class="text-gray-800 fs-7 fw-bold">{{  App\Helpers\Helper::dateFormat($order->created_at, 'd/m/Y') }}</span>
                            </div>
                        </td>
                        <td>
                            {{-- @if (!$order->pic_id) --}}
                            <a href="javascript:;" class="pic btn btn-sm btn-light btn-flex btn-center btn-active-light-primary px-4 me-2" 
                                data-kt-o-id="{{ $order->id }}"
                                data-kt-o-picid="{{ $order->pic_id }}"
                                data-kt-o-no="{{ $order->trx_code }}" 
                                data-kt-o-pname="{{ $order->pic_id ? $order->pic->name : '' }}"
                                data-kt-o-name="{{ $order->user->name }}"
                                {{-- data-kt-o-company="{{ $order->company }}"  --}}
                                >
                                    {{ __('Pilih PIC') }}
                            </a>
                            {{-- @endif --}}
                            <br>
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary me-2 mt-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                Actions
                                <i class="fa-solid fa-caret-down fs-5 ms-1"></i>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
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
                                    {{-- data-kt-user-company="{{ $order->company }}"  --}}
                                    data-kt-user-location_company="{{ $order->location_company }}" 
                                    data-kt-user-field_company="{{ $order->field_company }}" 
                                    {{-- data-kt-user-deskripsi="{{ $order->deskripsi }}"> --}}
                                    data-kt-user-detail_company="{{ $order->detail_company }}" >
                                        {{ __('Ubah Status') }}
                                    </a>
                                </div>

                                <!--begin::Menu item Button Show-->
                                <div class="menu-item px-3">
                                    <a href="{{ route('equipment.order.show', $order->id) }}" class="detail menu-link px-3">
                                        {{ __('Detail Order') }}
                                    </a>
                                </div>
                                <!--begin::Menu item Button Show-->

                                <!--begin::Menu item PDF-->
                                {{-- <a href="{{ route('order-admin.export-pdf', $order->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                    <i class="fa-solid fa-file-pdf fs-2"></i>
                                </a> --}}
                                <!--begin::Menu item PDF-->

                                <!--begin::Menu item PDF Owner-->
                                <div class="menu-item px-3 text-start">
                                    <a href="{{ route('order-admin.export-quot-pdf', ['laporan' => $order->id, 'type' => 'owner', 'filename' => 'Quotation_Owner_' . $order->user->company . '_' . now()->format('Ymd') . '.pdf']) }}"  target="_blank" class="detail menu-link px-3">
                                        <i class="fa-solid fa-file-pdf fs-3 me-1"></i> {{ __('Owner') }}
                                    </a>
                                </div>
                                <!--begin::Menu item PDF Owner-->

                                <!--begin::Menu item PDF Shipping-->
                                <div class="menu-item px-3 text-start">
                                    <a href="{{ route('order-admin.export-quot-pdf', ['laporan' => $order->id, 'type' => 'shipping', 'filename' => 'Quotation_Shipping_' . ($order->shipping->company_destination ?? $order->user->company) . '_' . now()->format('Ymd') . '.pdf']) }}"  target="_blank" class="detail menu-link px-3">
                                        <i class="fa-solid fa-file-pdf fs-3 me-1"></i> {{ __('Shipping') }}
                                    </a>
                                </div>
                                <!--begin::Menu item PDF Shipping-->
                            </div>
                            <!--end::Menu-->
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </table>
</form>
<!--end::Form-->
<!--begin::Pagination-->
{{ $orderall->links('components.pagination.bootstrap-5') }}
<!--end::Pagination-->

