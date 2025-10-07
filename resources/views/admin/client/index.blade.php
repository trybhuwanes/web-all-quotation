<x-app-layout>
    
    @slot('title')
        {{ __('Klien') }}
    @endslot
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            
            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar pb-3 pt-8">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                    <!--begin::Toolbar wrapper-->
                    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                            <!--begin::Title-->
                            <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Klien</h1>
                            <!--end::Title-->

                             <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary"><span class="menu-icon"><i class="fa-solid fa-home fs-7"></i></span></a>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                        Semua Klien
                                    </li>
                                    <!--end::Item-->          
                                </ul>
                                <!--end::Breadcrumb-->

                        </div>
                        <!--end::Page title-->
                    </div>
                    <!--end::Toolbar wrapper-->
                </div>
                <!--end::Toolbar container-->
            </div>
            <!--end::Toolbar-->

            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
            
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <x-auth-session-status :status="session('status')" />

                    <x-data-table-card>
                        @slot('data')
                            <h3 class="d-none d-lg-block text-black fs-3 fw-bolder text-center mb-7"> 
                                {{__('common.table-user')}}
                            </h3> 
                            @include('admin.client._data-table')
                        @endslot
                    </x-data-table-card>
                </div>
                <!--end::Content container-->

            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
        <!--begin::Footer-->
        @include('layouts._footer')
    </div>

    <!-- Modal for client detail is provided inside the data-table partial to avoid duplicate IDs -->

    <!--end:::Main-->

    @push('js')
    <script src="{{ url('template/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ url('pages/js/user_manage/data-table.js') }}"></script>
    <script src="{{ url('pages/js/user_manage/form-create.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let autoRefreshInterval = setInterval(refreshData, 60000);

        const refreshBtn = document.getElementById('refresh-btn');
        if (refreshBtn) {
            refreshBtn.addEventListener('click', function() {
                refreshData();
            });
        }

        const syncBtn = document.getElementById('sync-btn');
        if (syncBtn) {
            syncBtn.addEventListener('click', function() {
                Swal.fire({
                    title: 'Sync Data ke Database?',
                    text: 'Semua data dari Lark akan disinkronkan ke database',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Sync!',
                    cancelButtonText: 'Batal',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-light'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        syncToDatabase();
                    }
                });
            });
        }

        const searchInput = document.getElementById('search-input');
        if (searchInput) {
            searchInput.addEventListener('keyup', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const rows = document.querySelectorAll('#table-body tr');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        }

        // Edit client
        document.addEventListener('click', function(e) {
            if (e.target.closest('.edit-client')) {
                e.preventDefault();
                const btn = e.target.closest('.edit-client');
                const recordId = btn.dataset.recordId;
                
                if (!recordId) {
                    Swal.fire({
                        text: 'Record ID tidak ditemukan',
                        icon: 'error',
                        buttonsStyling: false,
                        confirmButtonText: 'OK',
                        customClass: { confirmButton: 'btn btn-primary' }
                    });
                    return;
                }
                loadClientData(recordId);
            }
        });

        // View detail
        document.addEventListener('click', function(e) {
            if (e.target.closest('.view-detail')) {
                e.preventDefault();
                const btn = e.target.closest('.view-detail');
                
                document.getElementById('detail-company').textContent = btn.dataset.clientCompany || '-';
                document.getElementById('detail-status').textContent = btn.dataset.clientStatus || '-';
                
                const business = btn.dataset.clientBusiness || '-';
                let badgeClass = 'badge-light-secondary';
                if (business.includes('EPC WWTP')) badgeClass = 'badge-light-success';
                else if (business.includes('EPC WTP')) badgeClass = 'badge-light-info';
                else if (business.includes('EPC STP')) badgeClass = 'badge-light-warning';
                else if (business.includes('EPC SRP')) badgeClass = 'badge-light-danger';
                else if (business.includes('Operation & Maintenance')) badgeClass = 'badge-light-dark';
                else if (business.includes('BOT / BOO')) badgeClass = 'badge-light-warning';
                else if (business.includes('After Sales')) badgeClass = 'badge-light-danger';
                
                document.getElementById('detail-business').innerHTML = btn.dataset.clientBusiness || '-';
                document.getElementById('detail-industry').textContent = btn.dataset.clientIndustry || '-';
                document.getElementById('detail-phone').textContent = btn.dataset.clientPhone || '-';
                document.getElementById('detail-location-office').textContent = btn.dataset.clientLocationOffice || '-';
                document.getElementById('detail-location-project').textContent = btn.dataset.clientLocationProject || '-';
                
                const modal = new bootstrap.Modal(document.getElementById('modal_client_detail'));
                modal.show();
            }
        });

        // Copy info
        document.addEventListener('click', function(e) {
            if (e.target.closest('.copy-info')) {
                e.preventDefault();
                const btn = e.target.closest('.copy-info');
                const info = btn.dataset.clientInfo;
                
                navigator.clipboard.writeText(info).then(() => {
                    Swal.fire({
                        text: 'Informasi berhasil disalin!',
                        icon: 'success',
                        buttonsStyling: false,
                        confirmButtonText: 'OK',
                        customClass: { confirmButton: 'btn btn-primary' }
                    });
                });
            }
        });

        // Submit edit form
        const editForm = document.getElementById('form_edit_client');
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const recordId = document.getElementById('edit-record-id').value;
                const submitBtn = document.getElementById('btn-save-edit');
                
                submitBtn.setAttribute('data-kt-indicator', 'on');
                submitBtn.disabled = true;

                document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');

                const formData = {
                    'Company': document.getElementById('edit-company').value,
                    'Status Step Client': document.getElementById('edit-status').value,
                    'Business': document.getElementById('edit-business').value,
                    'Industry': document.getElementById('edit-industry').value,
                    'Phone number (Office)': document.getElementById('edit-phone').value,
                    'City, Province (Office)': document.getElementById('edit-location-office').value,
                    'City, Province (Project)': document.getElementById('edit-location-project').value,
                };

                axios.put(`admin/api/client/${recordId}`, formData)
                    .then(response => {
                        if (response.data.success) {
                            const modal = bootstrap.Modal.getInstance(document.getElementById('modal_edit_client'));
                            modal.hide();

                            Swal.fire({
                                text: 'Data berhasil diupdate di Lark Base!',
                                icon: 'success',
                                buttonsStyling: false,
                                confirmButtonText: 'OK',
                                customClass: { confirmButton: 'btn btn-primary' }
                            }).then(() => {
                                refreshData();
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error updating client:', error);
                        
                        if (error.response?.status === 422) {
                            const errors = error.response.data.errors;
                            for (const [field, messages] of Object.entries(errors)) {
                                let inputId = 'edit-';
                                if (field === 'Status Step Client') inputId += 'status';
                                else if (field === 'Phone number (Office)') inputId += 'phone';
                                else if (field === 'City, Province (Office)') inputId += 'location-office';
                                else if (field === 'City, Province (Project)') inputId += 'location-project';
                                else inputId += field.toLowerCase();
                                
                                const input = document.getElementById(inputId);
                                if (input) {
                                    input.classList.add('is-invalid');
                                    const feedback = input.nextElementSibling;
                                    if (feedback && feedback.classList.contains('invalid-feedback')) {
                                        feedback.textContent = messages[0];
                                    }
                                }
                            }
                        } else {
                            Swal.fire({
                                text: 'Gagal mengupdate data: ' + (error.response?.data?.message || error.message),
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: 'OK',
                                customClass: { confirmButton: 'btn btn-primary' }
                            });
                        }
                    })
                    .finally(() => {
                        submitBtn.removeAttribute('data-kt-indicator');
                        submitBtn.disabled = false;
                    });
            });
        }

        function loadClientData(recordId) {
            Swal.fire({
                text: 'Memuat data...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            axios.get(`admin/api/client/${recordId}/edit`)
                .then(response => {
                    Swal.close();
                    
                    if (response.data.success) {
                        const data = response.data.data;
                        const fields = data.fields;
                        
                        document.getElementById('edit-record-id').value = data.record_id;
                        document.getElementById('edit-company').value = fields['Company'] || '';
                        document.getElementById('edit-status').value = fields['Status Step Client'] || '';
                        document.getElementById('edit-business').value = fields['Business'] || '';
                        document.getElementById('edit-industry').value = fields['Industry'] || '';
                        document.getElementById('edit-phone').value = fields['Phone number (Office)'] || '';
                        document.getElementById('edit-location-office').value = fields['City, Province (Office)'] || '';
                        document.getElementById('edit-location-project').value = fields['City, Province (Project)'] || '';
                        
                        const modal = new bootstrap.Modal(document.getElementById('modal_edit_client'));
                        modal.show();
                    }
                })
                .catch(error => {
                    Swal.close();
                    console.error('Error loading client data:', error);
                    Swal.fire({
                        text: 'Gagal memuat data: ' + (error.response?.data?.message || error.message),
                        icon: 'error',
                        buttonsStyling: false,
                        confirmButtonText: 'OK',
                        customClass: { confirmButton: 'btn btn-primary' }
                    });
                });
        }

        function syncToDatabase() {
            Swal.fire({
                title: 'Syncing...',
                text: 'Mohon tunggu, data sedang disinkronkan',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            axios.post('{{ route('sync.all') }}')
                .then(response => {
                    if (response.data.success) {
                        const result = response.data.data;
                        Swal.fire({
                            title: 'Sync Berhasil!',
                            html: `
                                <div class="text-start">
                                    <p><strong>Total Records:</strong> ${result.total_records}</p>
                                    <p><strong>Created:</strong> ${result.created}</p>
                                    <p><strong>Updated:</strong> ${result.updated}</p>
                                    <p><strong>Skipped:</strong> ${result.skipped}</p>
                                    ${result.errors.length > 0 ? `<p class="text-danger"><strong>Errors:</strong> ${result.errors.length}</p>` : ''}
                                </div>
                            `,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Sync error:', error);
                    Swal.fire({
                        title: 'Sync Gagal',
                        text: error.response?.data?.message || error.message,
                        icon: 'error',
                        confirmButtonText: 'OK',
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    });
                });
}

        function refreshData() {
            const loadingIndicator = document.getElementById('loading-indicator');
            const tableBody = document.getElementById('table-body');
            const refreshBtn = document.getElementById('refresh-btn');
            
            if (loadingIndicator) loadingIndicator.style.display = 'block';
            if (tableBody) tableBody.style.opacity = '0.5';
            if (refreshBtn) refreshBtn.disabled = true;

            axios.get('{{ route('client.data') }}')
                .then(response => {
                    if (response.data.success) {
                        updateTable(response.data.data);
                        
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data berhasil diperbarui',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    Swal.fire({
                        text: 'Gagal memperbarui data: ' + (error.response?.data?.message || error.message),
                        icon: 'error',
                        buttonsStyling: false,
                        confirmButtonText: 'OK',
                        customClass: { confirmButton: 'btn btn-primary' }
                    });
                })
                .finally(() => {
                    if (loadingIndicator) loadingIndicator.style.display = 'none';
                    if (tableBody) tableBody.style.opacity = '1';
                    if (refreshBtn) refreshBtn.disabled = false;
                });
        }

        function updateTable(data) {
            const tbody = document.getElementById('table-body');
            
            if (!tbody) return;
            
            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center py-10">
                            <div class="d-flex flex-column align-items-center">
                                <i class="fa-solid fa-inbox fs-3x text-gray-400 mb-3"></i>
                                <span class="text-muted fs-5">Tidak ada data klien</span>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = '';

            data.forEach((client, index) => {
                const business = client['Business'] || '-';
                let businessBadgeClass = 'badge-light-secondary';
                if (business.includes('A')) businessBadgeClass = 'badge-light-success';
                else if (business.includes('B')) businessBadgeClass = 'badge-light-info';
                else if (business.includes('C')) businessBadgeClass = 'badge-light-warning';
                else if (business.includes('D')) businessBadgeClass = 'badge-light-danger';
                else if (business.includes('E')) businessBadgeClass = 'badge-light-dark';

                const industry = client['Industry'] || '-';
                const truncatedIndustry = industry.length > 30 ? industry.substring(0, 30) + '...' : industry;

                const phone = client['Phone number (Office)'] || '';
                const cleanPhone = phone.replace(/[^0-9]/g, '');
                const recordId = client['record_id'] || '';

                const row = `
                    <tr id="row-${recordId || index}">
                        <td>
                            <div class="text-center">
                                <span class="text-gray-800 text-hover-primary mb-1 text-center">
                                    ${index + 1}.
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-start flex-column">
                                <span class="text-gray-900 fw-bold mb-1 fs-7">
                                    ${client['Company'] || '-'}
                                </span>
                            </div>
                        </td>
                        <td class="text-center fs-7">
                            <span class="badge badge-light-primary">
                                ${client['Status Step Client'] || '-'}
                            </span>
                        </td>
                        <td class="text-center fs-7">
                            <span class="badge ${businessBadgeClass}">
                                ${business}
                            </span>
                        </td>
                        <td class="text-center fs-7">
                            <span class="text-gray-800">
                                ${truncatedIndustry}
                            </span>
                        </td>
                        <td class="text-center fs-7">
                            <div class="d-flex flex-column">
                                ${phone ? `
                                    <span class="text-gray-800 mb-1">
                                        <i class="fa-solid fa-phone text-primary"></i>
                                        ${phone}
                                    </span>
                                ` : '<span class="text-muted">-</span>'}
                            </div>
                        </td>
                        <td class="text-center fs-7">
                            <span class="text-gray-800">
                                ${client['City, Province (Office)'] || '-'}
                            </span>
                        </td>
                        <td class="text-center fs-7">
                            <span class="text-gray-800">
                                ${client['City, Province (Project)'] || '-'}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" 
                               data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                Actions
                                <i class="fa-solid fa-caret-down fs-5 ms-1"></i>
                            </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="javascript:;" class="edit-client menu-link px-3" 
                                       data-record-id="${recordId}">
                                        <i class="fa-solid fa-pen-to-square me-2"></i>
                                        Edit Data
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="javascript:;" class="view-detail menu-link px-3" 
                                       data-client-company="${client['Company'] || ''}"
                                       data-client-status="${client['Status Step Client'] || ''}"
                                       data-client-business="${business}"
                                       data-client-industry="${client['Industry'] || ''}"
                                       data-client-phone="${phone}"
                                       data-client-location-office="${client['City, Province (Office)'] || ''}"
                                       data-client-location-project="${client['City, Province (Project)'] || ''}">
                                        <i class="fa-solid fa-eye me-2"></i>
                                        Lihat Detail
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="https://wa.me/${cleanPhone}" 
                                       target="_blank" 
                                       class="menu-link px-3">
                                        <i class="fa-brands fa-whatsapp me-2 text-success"></i>
                                        Hubungi via WA
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="javascript:;" 
                                       class="copy-info menu-link px-3"
                                       data-client-info="${client['Company'] || ''} - ${phone}">
                                        <i class="fa-solid fa-copy me-2"></i>
                                        Copy Info
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;
                
                tbody.insertAdjacentHTML('beforeend', row);
            });

            if (typeof KTMenu !== 'undefined') {
                KTMenu.createInstances();
            }
        }
    });
    </script>
    @endpush


</x-app-layout>

