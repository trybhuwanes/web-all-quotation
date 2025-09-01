@push('head')
    <style>
        @media (min-width: 576px) {
            .sm-flex-row {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: wrap !important;
            }
        }
    </style>
@endpush
<div class="ps-product-list ps-new-arrivals mt-5 mt-md-0">
    <div class="ps-container p-0">
        <div class="card-list-produk">
            <div id="showProduk">

            </div>
            {{-- <div class="row" id="showProduk">

            </div> --}}
        </div>
    </div>
</div>
