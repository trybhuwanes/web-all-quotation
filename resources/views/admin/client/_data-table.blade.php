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
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Sync button-->
                    <button type="button" class="btn btn-light-success me-3" id="sync-btn">
                        <i class="fa-solid fa-arrows-rotate fs-2"></i>
                        Sync ke Database
                    </button>
                    <!--end::Sync button-->
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
                            <th class="min-w-150px text-center">Company</th>
                            <th class="min-w-100px text-center">Status Step</th>
                            <th class="min-w-100px text-center">Business Opportunity</th>
                            <th class="min-w-100px text-center">PIC</th>
                            <th class="min-w-120px text-center">Office Location</th>
                            <th class="min-w-120px text-center">Project Location</th>
                            <th class="min-w-150px text-center">Date Inquiry</th>
                            <th class="min-w-100px text-center">Aksi</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-semibold" id="table-body">
                        @if(isset($clients) && count($clients) > 0)
                            @foreach ($clients as $index => $client)
                                <tr id="row-{{ $client['record_id'] ?? $index }}">
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
                                        </div>
                                    </td>
                                    <!--end::Company-->
                                    <!--begin::Status Step-->
                                    <td class="text-center fs-7">
                                        <span class="badge badge-light-primary">
                                            {{ $client['Status Step Client'] ?? '-' }}
                                        </span>
                                    </td>
                                    <!--end::Status Step-->
                                    <!--begin::Business-->
                                    {{-- <td class="text-center fs-7">
                                        @php
                                            $business = $client['Business'] ?? '-';
                                            $badgeClass = 'badge-light-secondary';
                                            if (str_contains($business, 'A')) {
                                                $badgeClass = 'badge-light-success';
                                            } elseif (str_contains($business, 'B')) {
                                                $badgeClass = 'badge-light-info';
                                            } elseif (str_contains($business, 'C')) {
                                                $badgeClass = 'badge-light-warning';
                                            } elseif (str_contains($business, 'D')) {
                                                $badgeClass = 'badge-light-danger';
                                            } elseif (str_contains($business, 'E')) {
                                                $badgeClass = 'badge-light-dark';
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $business }}
                                        </span>
                                    </td> --}}
                                    <!--end::Business-->
                                    <!--begin::Industry-->
                                    <td class="text-center fs-7">
                                        <span class="text-gray-800">
                                            {{ Str::limit($client['Business Opportunity'] ?? '-', 30) }}
                                        </span>
                                    </td>
                                    <!--end::Industry-->
                                    <!--begin::Phone-->
                                    <td class="text-center fs-7">
                                        <div class="d-flex flex-column">
                                        <span class="text-gray-800">
                                            {{ Str::limit($client['PIC'] ?? '-', 30) }}
                                        </span>
                                        </div>
                                    </td>
                                    <!--end::Phone-->
                                    <!--begin::Office Location-->
                                    <td class="text-center fs-7">
                                        <span class="text-gray-800">
                                            {{ $client['City, Province (Office)'] ?? '-' }}
                                        </span>
                                    </td>
                                    <!--end::Office Location-->
                                    <!--begin::Project Location-->
                                    <td class="text-center fs-7">
                                        <span class="text-gray-800">
                                            {{ $client['City, Province (Project)'] ?? '-' }}
                                        </span>
                                    </td>
                                    <!--end::Project Location-->
                                    <!--begin::Project Location-->
                                    <td class="text-center fs-7">
                                        <span class="text-gray-800">
                                            <time datetime="{{ isset($client['Date Inquiry']) ? \Carbon\Carbon::parse($client['Date Inquiry'])->toIso8601String() : '' }}">
                                            {{-- {{ $client['Date Inquiry'] ?? '-' }} --}}
                                        </span>
                                    </td>
                                    <!--end::Project Location-->
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
                                                   data-client-company="{{ $client['Company'] ?? '' }}"
                                                   data-client-status="{{ $client['Status Step Client'] ?? '' }}"
                                                   data-client-business="{{ $client['Business'] ?? '' }}"
                                                   data-client-industry="{{ $client['Industry'] ?? '' }}"
                                                   data-client-phone="{{ $client['Phone number (Office)'] ?? '' }}"
                                                   data-client-location-office="{{ $client['City, Province (Office)'] ?? '' }}"
                                                   data-client-location-project="{{ $client['City, Province (Project)'] ?? '' }}">
                                                    <i class="fa-solid fa-eye me-2"></i>
                                                    Lihat Detail
                                                </a>
                                            </div>
                                            <!--end::Menu item View Detail-->
                                            <!--begin::Menu item Contact-->
                                            <div class="menu-item px-3">
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $client['Phone number (Office)'] ?? '') }}" 
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
                                                   data-client-info="{{ $client['Company'] ?? '' }} - {{ $client['Phone number (Office)'] ?? '' }}">
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
                                <td colspan="9" class="text-center py-10">
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
    <div class="modal-dialog modal-dialog-centered modal-xl">
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
                        <!--begin::Status Step-->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Status Step Client</label>
                            <input type="text" class="form-control form-control-solid" id="edit-status" name="Status Step Client">
                            <div class="invalid-feedback"></div>
                        </div>
                        <!--end::Status Step-->
                        <!--begin::Business-->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Business Opportunity</label>
                            <select class="form-select form-select-solid" id="edit-business" name="Business">
                                <option value="">Pilih Business</option>
                                <option value="EPC WWTP">EPC WWTP</option>
                                <option value="EPC WTP">EPC WTP</option>
                                <option value="EPC STP">EPC STP</option>
                                <option value="EPC SRP">EPC SRP</option>
                                <option value="Operation & Maintenance">Operation & Maintenance</option>
                                <option value="BOT / BOO">BOT / BOO</option>
                                <option value="After Sales">After Sales</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <!--end::Business-->
                        <!--begin::Industry-->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Industry</label>
                            <select class="form-select form-select-solid" id="edit-industry" name="Industry">
                                <option value="">Pilih Industry</option>
                                <option value="Palm Oil - CPO">Palm Oil - CPO</option>
                                <option value="Palm Oil - CPKO">Palm Oil - CPKO</option>
                                <option value="Palm Oil - EFB">Palm Oil - EFB</option>
                                <option value="Palm Oil - Plantation">Palm Oil - Plantation</option>
                                <option value="Mining - Coal">Mining - Coal</option>
                                <option value="Mining - Gold">Mining - Gold</option>
                                <option value="Mining - Nickel">Mining - Nickel</option>
                                <option value="Mining - Tin">Mining - Tin</option>
                                <option value="Mining - Bauxite">Mining - Bauxite</option>
                                <option value="O&G - Upstream">O&G - Upstream</option>
                                <option value="O&G - Midstream">O&G - Midstream</option>
                                <option value="O&G - Downstream">O&G - Downstream</option>
                                <option value="Non Food - Manufacturing / Heavy">Non Food - Manufacturing / Heavy</option>
                                <option value="Non Food - Tech & Telecom">Non Food - Tech & Telecom</option>
                                <option value="Non Food - Transport & Log">Non Food - Transport & Log</option>
                                <option value="F&B - Processed Food">F&B - Processed Food</option>
                                <option value="F&B - Beverages">F&B - Beverages</option>
                                <option value="F&B - Dairy Product">F&B - Dairy Product</option>
                                <option value="F&B - Confectionery">F&B - Confectionery</option>
                                <option value="F&B - Meat Processing">F&B - Meat Processing</option>
                                <option value="F&B - Seasoning">F&B - Seasoning</option>
                                <option value="Agroindustry - Fishery & Aquaculture">Agroindustry - Fishery & Aquaculture</option>
                                <option value="Agroindustry - Food Crops">Agroindustry - Food Crops</option>
                                <option value="Agroindustry - Tobacco">Agroindustry - Tobacco</option>
                                <option value="Agroindustry - Sugar">Agroindustry - Sugar</option>
                                <option value="Agroindustry - Livestock & Poultry">Agroindustry - Livestock & Poultry</option>
                                <option value="Agroindustry - Pulp & Paper">Agroindustry - Pulp & Paper</option>
                                <option value="Non Food - Tourism & Hospitality">Non Food - Tourism & Hospitality</option>
                                <option value="Non Food - Residential">Non Food - Residential</option>
                                <option value="Non Food - Constraction & Real Estate">Non Food - Constraction & Real Estate</option>
                                <option value="Non Food - PDAM/SPAM">Non Food - PDAM/SPAM</option>
                                <option value="Non Food - Pharmaceutical">Non Food - Pharmaceutical</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <!--end::Industry-->
                        <!--begin::Phone-->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Phone Number</label>
                            <input type="text" class="form-control form-control-solid" id="edit-phone" name="Phone number" placeholder="+62...">
                            <div class="invalid-feedback"></div>
                        </div>
                        <!--end::Phone-->
                        <!--begin::Location Office-->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">City, Province (Office)</label>
                            <input type="text" class="form-control form-control-solid" id="edit-location-office" name="City, Province (Office)" placeholder="Contoh: Surabaya, Jawa Timur">
                            <div class="invalid-feedback"></div>
                        </div>
                        <!--end::Location Office-->
                        <!--begin::Location Project-->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">City, Province (Project)</label>
                            <input type="text" class="form-control form-control-solid" id="edit-location-project" name="City, Province (Project)" placeholder="Contoh: Jakarta, DKI Jakarta">
                            <div class="invalid-feedback"></div>
                        </div>
                        <!--end::Location Project-->
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
                            <label class="form-label fw-bold text-gray-700">Status Step Client</label>
                            <div class="text-gray-800" id="detail-status">-</div>
                        </div>
                        <div class="mb-5">
                            <label class="form-label fw-bold text-gray-700">Business Opportunity</label>
                            <div id="detail-business">-</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="form-label fw-bold text-gray-700">Industry</label>
                            <div class="text-gray-800" id="detail-industry">-</div>
                        </div>
                        <div class="mb-5">
                            <label class="form-label fw-bold text-gray-700">Contact</label>
                            <div class="text-gray-800" id="detail-contact">-</div>
                        </div>
                        <div class="mb-5">
                            <label class="form-label fw-bold text-gray-700">Phone Number</label>
                            <div class="text-gray-800" id="detail-phone">-</div>
                        </div>
                        <div class="mb-5">
                            <label class="form-label fw-bold text-gray-700">Job Title</label>
                            <div class="text-gray-800" id="detail-job">-</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="form-label fw-bold text-gray-700">Office Location</label>
                            <div class="text-gray-800" id="detail-location-office">-</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="form-label fw-bold text-gray-700">Project Location</label>
                            <div class="text-gray-800" id="detail-location-project">-</div>
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