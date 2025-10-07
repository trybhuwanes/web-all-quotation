<div class="container-fluid">
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="fa-solid fa-magnifying-glass fs-3 position-absolute ms-5"></i>
                    <input type="text" id="search-input" class="form-control form-control-solid w-250px ps-13" placeholder="Cari klien...">
                </div>
                <!--end::Search-->
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Refresh button-->
                    <button type="button" class="btn btn-light-primary me-3" id="refresh-btn">
                        <i class="fa-solid fa-rotate-right fs-2"></i>
                        Refresh Data
                    </button>
                    <!--end::Refresh button-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Alert-->
            @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                <i class="fa-solid fa-circle-exclamation fs-2hx text-danger me-4"></i>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-danger">Error</h4>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                <i class="fa-solid fa-circle-check fs-2hx text-success me-4"></i>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-success">Berhasil</h4>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif
            <!--end::Alert-->

            <!--begin::Loading indicator-->
            <div id="loading-indicator" class="text-center py-10" style="display: none;">
                <span class="spinner-border spinner-border-lg align-middle ms-2"></span>
                <p class="mt-3 text-muted">Memuat data dari Lark Base...</p>
            </div>
            <!--end::Loading indicator-->

            <!--begin::Form-->
            <form id="kt_clients_form" class="form">
                <!--begin::Table-->
                <table class="table table-striped align-middle table-row-dashed fs-6 gy-5" id="kt_table_clients">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-center fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px ps-2 text-center">No.</th>
                            <th class="min-w-100px text-center">Company</th>
                            <th class="min-w-100px text-center">Business</th>
                            <th class="max-w-100px text-center">Industry</th>
                            <th class="mw-100 text-center">Grade Client</th>
                            <th class="min-w-100px text-center">Contact</th>
                            <th class="min-w-100px text-center">Location</th>
                            <th class="min-w-100px text-center">Aksi</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-semibold" id="table-body">
                        @if(isset($clients) && count($clients) > 0)
                            @foreach ($clients as $index => $client)
                                <tr id="row-{{ $index }}">
                                    <!--begin::Iteration-->
                                    <td>
                                        <div class="text-center">
                                            <span class="text-gray-800 text-hover-primary mb-1 text-center">
                                                {{ $loop->iteration }}.
                                            </span>
                                        </div>
                                    </td>
                                    <!--end::Iteration-->
                                    <!--begin::Company-->
                                    <td>
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-gray-900 fw-bold mb-1 fs-7">
                                                {{ $client['Company'] ?? '-' }}
                                            </span>
                                            <span class="text-muted fw-semibold text-muted d-block fs-7">
                                                <span class="text-gray-900">Detail:</span> 
                                                {{ Str::limit($client['DetailCompany'] ?? '-', 50) }}
                                            </span>
                                        </div>
                                    </td>
                                    <!--end::Company-->
                                    <!--begin::Business-->
                                    <td class="text-center fs-7">
                                        <span class="badge badge-light-primary">
                                            {{ $client['Business'] ?? '-' }}
                                        </span>
                                    </td>
                                    <!--end::Business-->
                                    <!--begin::Industry-->
                                    <td class="text-center fs-7">
                                        <span class="badge badge-light-info">
                                            {{ $client['Industry'] ?? '-' }}
                                        </span>
                                    </td>
                                    <!--end::Industry-->
                                    <!--begin::Grade-->
                                    <td class="text-center">
                                        @php
                                            $grade = $client['Grade Client'] ?? '-';
                                            $badgeClass = 'badge-light-secondary';
                                            if (str_contains($grade, 'A')) {
                                                $badgeClass = 'badge-light-success';
                                            } elseif (str_contains($grade, 'B')) {
                                                $badgeClass = 'badge-light-warning';
                                            } elseif (str_contains($grade, 'C')) {
                                                $badgeClass = 'badge-light-danger';
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }} fs-7">
                                            {{ $grade }}
                                        </span>
                                    </td>
                                    <!--end::Grade-->
                                    <!--begin::Contact-->
                                    <td class="text-center fs-7">
                                        <div class="d-flex flex-column">
                                            @if(isset($client['Phone number (Office)']) && $client['Phone number (Office)'])
                                                <span class="text-gray-800 mb-1">
                                                    <i class="fa-solid fa-phone text-primary"></i>
                                                    {{ $client['Phone number (Office)'] }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <!--end::Contact-->
                                    <!--begin::Location-->
                                    <td class="text-center fs-7">
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 fw-bold">
                                                {{ $client['City (Office)'] ?? '-' }}
                                            </span>
                                            <span class="text-muted fs-8">
                                                {{ $client['Province (Office)'] ?? '-' }}
                                            </span>
                                        </div>
                                    </td>
                                    <!--end::Location-->
                                    <!--begin::Action-->
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" 
                                           data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="fa-solid fa-caret-down fs-5 ms-1"></i>
                                        </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
                                            <!--begin::Menu item Edit-->
                                            <div class="menu-item px-3">
                                                <a href="javascript:;" class="edit-client menu-link px-3" 
                                                   data-record-id="{{ $client['record_id'] ?? '' }}">
                                                    <i class="fa-solid fa-pen-to-square me-2"></i>
                                                    Edit Data
                                                </a>
                                            </div>
                                            <!--end::Menu item Edit-->
                                            <!--begin::Menu item View Detail-->
                                            <div class="menu-item px-3">
                                                <a href="javascript:;" class="view-detail menu-link px-3" 
                                                data-client-index="{{ $index }}"
                                                data-client-company="{{ $client['Company'] ?? '' }}"
                                                data-client-business="{{ $client['Business'] ?? '' }}"
                                                data-client-industry="{{ $client['Industry'] ?? '' }}"
                                                data-client-detail="{{ $client['DetailCompany'] ?? '' }}"
                                                data-client-grade="{{ $client['Grade Client'] ?? '' }}"
                                                data-client-phone="{{ $client['Phone number (Office)'] ?? '' }}"
                                                data-client-city="{{ $client['City (Office)'] ?? '' }}"
                                                data-client-province="{{ $client['Province (Office)'] ?? '' }}">
                                                    <i class="fa-solid fa-eye me-2"></i>
                                                    Lihat Detail
                                                </a>
                                            </div>
                                            <!--end::Menu item View Detail-->
                                            <!--begin::Menu item Contact-->
                                            <div class="menu-item px-3">
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $client['Phone number'] ?? '') }}" 
                                                   target="_blank" 
                                                   class="menu-link px-3">
                                                    <i class="fa-brands fa-whatsapp me-2 text-success"></i>
                                                    Hubungi via WA
                                                </a>
                                            </div>
                                            <!--end::Menu item Contact-->
                                            <!--begin::Menu item Copy Info-->
                                            <div class="menu-item px-3">
                                                <a href="javascript:;" 
                                                   class="copy-info menu-link px-3"
                                                   data-client-info="{{ $client['Company'] ?? '' }} - {{ $client['Phone number'] ?? '' }}">
                                                    <i class="fa-solid fa-copy me-2"></i>
                                                    Copy Info
                                                </a>
                                            </div>
                                            <!--end::Menu item Copy Info-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                    <!--end::Action-->
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center py-10">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fa-solid fa-inbox fs-3x text-gray-400 mb-3"></i>
                                        <span class="text-muted fs-5">Tidak ada data klien</span>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>


<!--begin::Modal Edit-->
                            <div class="modal fade" id="modal_edit_client" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Data Klien</h5>
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa-solid fa-xmark fs-2"></i>
                                            </div>
                                        </div>
                                        <form id="form_edit_client">
                                            <input type="hidden" id="edit-record-id" name="record_id">
                                            <div class="modal-body">
                                                <div class="row g-5">
                                                    <!--begin::Company-->
                                                    <div class="col-md-6">
                                                        <label class="required form-label fw-bold">Company</label>
                                                        <input type="text" class="form-control form-control-solid" id="edit-company" name="Company" required>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                    <!--end::Company-->
                                                    <!--begin::Business-->
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Business</label>
                                                        <input type="text" class="form-control form-control-solid" id="edit-business" name="Business">
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                    <!--end::Business-->
                                                    <!--begin::Industry-->
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Industry</label>
                                                        <input type="text" class="form-control form-control-solid" id="edit-industry" name="Industry">
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                    <!--end::Industry-->
                                                    <!--begin::Grade-->
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Grade Client</label>
                                                        <select class="form-select form-select-solid" id="edit-grade" name="Grade Client">
                                                            <option value="">Pilih Grade</option>
                                                            <option value="Grade A = Sangat potensial">Grade A = Sangat potensial</option>
                                                            <option value="Grade B = Potensial">Grade B = Potensial</option>
                                                            <option value="Grade C = Cukup layak">Grade C = Cukup layak</option>
                                                            <option value="Grade D = Kurang potensial">Grade D = Kurang potensial</option>
                                                            <option value="Grade E = Kurang potensial">Grade E = Kurang potensial</option>
                                                        </select>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                    <!--end::Grade-->
                                                    <!--begin::Phone-->
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Phone Number</label>
                                                        <input type="text" class="form-control form-control-solid" id="edit-phone" name="Phone number" placeholder="+62...">
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                    <!--end::Phone-->
                                                    <!--begin::City-->
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">City</label>
                                                        <input type="text" class="form-control form-control-solid" id="edit-city" name="City">
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                    <!--end::City-->
                                                    <!--begin::Province-->
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Province</label>
                                                        <input type="text" class="form-control form-control-solid" id="edit-province" name="Province">
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                    <!--end::Province-->
                                                    <!--begin::Detail Company-->
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold">Detail Company</label>
                                                        <textarea class="form-control form-control-solid" id="edit-detail" name="DetailCompany" rows="4"></textarea>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                    <!--end::Detail Company-->
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary" id="btn-save-edit">
                                                    <span class="indicator-label">Simpan Perubahan</span>
                                                    <span class="indicator-progress">
                                                        Menyimpan... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                    </span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--end::Modal Edit-->

                            <!--begin::Modal Detail-->
                            <div class="modal fade" id="modal_client_detail" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Klien</h5>
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa-solid fa-xmark fs-2"></i>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-5">
                                                <div class="col-md-6">
                                                    <div class="mb-5">
                                                        <label class="form-label fw-bold text-gray-700">Company</label>
                                                        <div class="text-gray-800" id="detail-company">-</div>
                                                    </div>
                                                    <div class="mb-5">
                                                        <label class="form-label fw-bold text-gray-700">Business</label>
                                                        <div class="text-gray-800" id="detail-business">-</div>
                                                    </div>
                                                    <div class="mb-5">
                                                        <label class="form-label fw-bold text-gray-700">Industry</label>
                                                        <div class="text-gray-800" id="detail-industry">-</div>
                                                    </div>
                                                    <div class="mb-5">
                                                        <label class="form-label fw-bold text-gray-700">Grade Client</label>
                                                        <div id="detail-grade">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-5">
                                                        <label class="form-label fw-bold text-gray-700">Phone Number</label>
                                                        <div class="text-gray-800" id="detail-phone">-</div>
                                                    </div>
                                                    <div class="mb-5">
                                                        <label class="form-label fw-bold text-gray-700">City</label>
                                                        <div class="text-gray-800" id="detail-city">-</div>
                                                    </div>
                                                    <div class="mb-5">
                                                        <label class="form-label fw-bold text-gray-700">Province</label>
                                                        <div class="text-gray-800" id="detail-province">-</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-5">
                                                        <label class="form-label fw-bold text-gray-700">Detail Company</label>
                                                        <div class="text-gray-800" id="detail-detail">-</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Modal Detail-->