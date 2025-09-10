<x-guest-layout>
    <!--begin::Header-->
    @include('layouts.guest.header')
    <style>
        /* Jika jumlah item ganjil, item terakhir center */
        #gallery-wrapper .col-md-6:last-child {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <!--end::Header-->

    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">

        <x-product-detail-header :productShow="$productShow" :productType="$productType" />

        <!--begin::Project Section-->
        <div class="row mt-10">
            <!-- Sidebar Nama Perusahaan -->
            <div class="col-lg-3 mb-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4 text-center">Perusahaan</h5>
                        <div class="d-flex flex-column gap-3">
                            @foreach($productShow->projects as $index => $project)
                                <button 
                                    class="btn btn-light text-start company-btn {{ $index === 0 ? 'active' : '' }}" 
                                    data-project="{{ $project->id }}">
                                    {{ $project->company_name }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Galeri + Deskripsi -->
            <div class="col-lg-9 mb-5">
                <div id="project-content">
                    @if($productShow->projects->isNotEmpty())
                        @php $firstProject = $productShow->projects->first(); @endphp

                        <!-- Galeri -->
                        <div class="row g-5 mb-5" id="gallery-wrapper">
                            @foreach($firstProject->getMedia('project-gallery') as $gallery)
                                <div class="col-md-6">
                                    <a data-fslightbox="lightbox-projects" href="{{ $gallery->getUrl() }}">
                                        <div class="card card-bordered">
                                            <div class="card-body p-0 ratio ratio-4x3">
                                                <img src="{{ $gallery->getUrl() }}" class="rounded w-100 mx-auto d-block" style="object-fit: cover;">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!-- Deskripsi -->
                        <div class="fs-6 text-gray-700\" id="project-description" style="text-align: justify;">
                            {!! $firstProject->description ?? 'Deskripsi proyek belum tersedia.' !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!--end::Project Section-->
    </div>
    <!--end::Content container-->

    @php
        $projectsData = $productShow->projects->map(function($p) {
            return [
                'id' => $p->id,
                'company_name' => $p->company_name,
                'description' => $p->description ?? $p->deskripsi_project,
                'gallery' => $p->getMedia('project-gallery')->map(function($g) {
                    return ['url' => $g->getUrl()];
                })->toArray(),
            ];
        })->toArray();
    @endphp

    <!--begin::Footer-->
    @include('layouts.guest.footer')
    <!--end::Footer-->

    @push('js')
    <script>
        const projects = @json($projectsData);

        document.querySelectorAll('.company-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // aktifkan tombol yg diklik
                document.querySelectorAll('.company-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                let projectId = this.dataset.project;
                let project = projects.find(p => p.id == projectId);

                if (!project) return;

                // Update gallery
                let galleryWrapper = document.getElementById('gallery-wrapper');
                galleryWrapper.innerHTML = '';
                project.gallery.forEach(g => {
                    galleryWrapper.innerHTML += `
                        <div class="col-md-6">
                            <a data-fslightbox="lightbox-projects" href="${g.url}">
                                <div class="card card-bordered">
                                    <div class="card-body p-0 ratio ratio-4x3">
                                        <img src="${g.url}" class="img-fluid rounded w-100" style="object-fit: cover;">
                                    </div>
                                </div>
                            </a>
                        </div>
                    `;
                });

                // Update deskripsi
                const descEl = document.getElementById('project-description');
                descEl.innerHTML = project.description && project.description.trim() !== ""
                    ? project.description
                    : 'Deskripsi proyek belum tersedia.';

                // Refresh fslightbox
                refreshFsLightbox();
            });
        });
    </script>

    <!--begin::Vendors Javascript-->
    <script src="/template/assets/plugins/custom/fslightbox/fslightbox.bundle.js"></script>
    <script src="/template/assets/plugins/custom/typedjs/typedjs.bundle.js"></script>
    <!--end::Vendors Javascript-->
    @endpush
</x-guest-layout>
