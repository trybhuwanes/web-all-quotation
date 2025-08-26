@if (count($breadcrumbs))
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <!--begin::Item-->
        @foreach ($breadcrumbs as $breadcrumb)
            <li class="breadcrumb-item text-muted">
                <a href="{{ $breadcrumb->url }}">
                    {{ $breadcrumb->title }}
                </a>
            </li>
            @if (!$loop->last)
                <!--begin::Divider-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Divider-->
            @endif
        @endforeach
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endif