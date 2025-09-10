<x-app-layout>
    
    @slot('title')
        {{ __('Edit Projek') }}
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
                            <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Edit Projek</h1>
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
                                        Edit Projek
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
                    {{-- @slot('formCreate') --}}
                        @include('admin.projects._form-update')
                    {{-- @endslot   --}}
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
        <script src="{{ url('pages/js/project/form-update.js') }}"></script>
        <script>
            new Dropzone("#kt_modal_create_project_galery", {
            url: route('storage-dropzone-img'), // URL untuk upload file baru
            autoProcessQueue: false,
            paramName: "file",
            maxFiles: 4,
            addRemoveLinks: true,
            // acceptedFiles: "image/jpeg,image/png,image/gif,image/jpg",
            chunking: true, // Mengaktifkan chunking
            chunkSize: 1000000, // Ukuran chunk dalam bytes (misalnya 1MB)
            retryChunks: true, // Menyediakan opsi retry
            retryChunksLimit: 3, // Jumlah maksimal percobaan ulang
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            init: function () {
                let myDropzone = this;
                
                // Menambahkan gambar yang sudah ada
                @foreach($projects->getMedia('project-gallery') as $gallery)
                    var mockFile = { 
                        name: "{{ $gallery->file_name }}",
                        size: {{ $gallery->size }},
                        type: 'image/*',
                        data_id: {{ $gallery->id }}
                    };
                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, "{{ $gallery->getUrl() }}" );
                    myDropzone.files.push(mockFile);
                @endforeach

                // kalau user hapus file lama → catat id
                myDropzone.on("removedfile", function(file) {
                    if (file.data_id) {
                        // buat hidden input untuk dikirim ke server
                        let input = document.createElement("input");
                        input.type = "hidden";
                        input.name = "deleted_files[]";
                        input.value = file.data_id;
                        document.querySelector("#kt_create_project_form").appendChild(input);
                    }
                });

            }
        });
        </script>

        <script>
            var KTAppInboxCompose = function() {
                const initQuill = (selector, content) => {
                    var quill = new Quill(selector, {
                        modules: {
                            toolbar: [
                                [{ header: [1, 2, false] }],
                                ["bold", "italic", "underline", "image"],
                                [{ list: "ordered" }, { list: "bullet" }]
                            ]
                        },
                        placeholder: "Tulis deskripsi disini...",
                        theme: "snow"
                    });

                    quill.root.innerHTML = content;
                };

                return {
                    init: function() {
                        const deskripsiContent = {!! json_encode($projects->description ?? '') !!};

                        initQuill("#deskripsi_editor", deskripsiContent);
                    }
                };
            }();

            KTUtil.onDOMContentLoaded(function() {
                KTAppInboxCompose.init();
            });
        </script>
        <!--end::Cust Javascript-->

    @endpush
</x-app-layout>

