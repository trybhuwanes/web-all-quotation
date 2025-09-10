<x-app-layout>
    
    @slot('title')
        {{ __('Project Reference') }}
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
                            <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Daftar Pesanan</h1>
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
                                        Daftar project
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

                    <x-data-table-card additionalButtons="custom_add">
                        @slot('customAddButton')
                            <div class="me-0">
                                <a href="{{ route('projects.create') }}" class="btn btn-primary" id="add-row">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    {{ __('common.btn_add') }}
                                </a>
                            </div>
                        @endslot

                        @slot('data')
                            @include('admin.projects._data-table')
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


    <!--end:::Main-->
    @push('js')
        <!--begin::Vendors Javascript-->
        <script src="{{ url('template/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <!--end::Vendors Javascript-->
        
        <!--begin::Cust Javascript-->
        <script src="{{ url('pages/js/project/data-table.js') }}"></script>
        <!--end::Cust Javascript-->

        <script>
            $(document).ready(function () {
                $('#picFilter').on('change', function () {
                    $('#filterForm').submit();
                });

                $('#statusFilter').on('change', function () {
                    $('#filterForm').submit();
                });
            });

            document.querySelectorAll('.delete-project').forEach(btn => {
                btn.addEventListener('click', function () {
                    let projectId = this.dataset.id;

                    Swal.fire({
                        title: 'Yakin hapus project ini?',
                        text: "Data tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios.delete(route('projects.destroy', { project: projectId }))
                                .then(({data}) => {
                                    if (data.success) {
                                        Swal.fire('Terhapus!', data.message, 'success')
                                            .then(() => window.location.reload());
                                    }
                                })
                                .catch(err => {
                                    console.error(err);
                                    Swal.fire('Error!', 'Gagal menghapus project.', 'error');
                                });
                        }
                    });
                });
            });

        </script>
        
    @endpush
</x-app-layout>
