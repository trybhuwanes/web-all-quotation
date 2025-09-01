@props([
    'title' => null,
    'containerType' => 'xxxl',
])
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-{{ $containerType }} d-flex flex-stack">
        <!--begin::Page title-->
        <div id="breadcrumbs-container" class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                {{ $title }}
            </h1>
            <!--end::Title-->
            {{-- @if (Breadcrumbs::exists())
                {{ Breadcrumbs::render() }}
            @endif --}}
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
