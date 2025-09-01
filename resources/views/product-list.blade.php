@foreach ($products as $item)
    <div data-kt-grid-col="true" class="card col-md-2 col-md-4 shadow-sm hover-elevate card-rounded mb-3">
        <a class="d-block card-rounded" href="#">
            <div class="card-xl-stretch">
                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-200px"
                    style="background-image:url('{{ $item->getFirstMediaUrl('product-thumbnail') }}')">
                </div>
                <div class="my-3">
                    <a href="#"
                        class="fs-3 text-gray-900 fw-bold text-hover-primary lh-base text-center d-block mb-3">
                        {{ $item->nama_produk}} 
                    </a>
                    <div class="fs-7 text-center">
                        {{ substr($item->deskripsi_produk, 0, 70) }}...
                    </div>
                    <div class="fs-6 fw-bold mt-5 d-flex justify-content-between align-items-center">
                        <span class="badge bg-light-primary fs-4 fw-bold text-gray-900 p-2">
                            <span class="fs-6 fw-semibold text-gray-500">Rp</span> {{ $item->harga}}
                        </span>
                        <a href="#" class="btn btn-sm btn-primary">+ Cart</a>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endforeach
