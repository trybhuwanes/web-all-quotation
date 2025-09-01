<table style="width:100%;border:1px solid">
    <thead>
        <tr>
            <th colspan="12" rowspan="2"
                style="text-align:center;vertical-align: middle;width: 50%;margin: auto;">
                <span>LAPORAN PESANAN</span>
            </th>
        </tr>
    </thead>
    <tr></tr>
    <thead>
        {{-- <tr>
            <th>Periode:</th>
            <th colspan="9"></th>
        </tr> --}}
        <tr>
            <th style="font-weight: bold;background-color: green;">Nomer Order</th>
            <th style="font-weight: bold;background-color: green;">Contact Person</th>
            <th style="font-weight: bold;background-color: green;">Telpon</th>
            <th style="font-weight: bold;background-color: green;">Email</th>
            <th style="font-weight: bold;background-color: green;">Company</th>
            <th style="font-weight: bold;background-color: green;">Jabatan</th>
            <th style="font-weight: bold;background-color: green;">Industry</th>
            <th style="font-weight: bold;background-color: green;">Lokasi Company</th>
            <th style="font-weight: bold;background-color: green;">PIC</th>
            <th style="font-weight: bold;background-color: green;">Dibuat</th>
            <th style="font-weight: bold;background-color: green;">Product</th>
            <th style="font-weight: bold;background-color: green;">Total Harga</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($data as $key => $order)
        @foreach ($order->items as $itemIndex => $item)
            <tr>
                @if($itemIndex === 0)
                    <td rowspan="{{ $order->items->count() }}">
                        {{ $order->trx_code }}
                    </td>
                    <td rowspan="{{ $order->items->count() }}">
                        {{ $order->user->name }}
                    </td>
                    <td rowspan="{{ $order->items->count() }}">
                        {{ $order->user->phone }}
                    </td>
                    <td rowspan="{{ $order->items->count() }}">
                        {{ $order->user->email }}
                    </td>
                    <td rowspan="{{ $order->items->count() }}">
                        {{ $order->user->company }}
                    </td>
                    <td rowspan="{{ $order->items->count() }}">
                        {{ $order->user->job_title }}
                    </td>
                    <td rowspan="{{ $order->items->count() }}">
                        {{ $order->user->field_company }}
                    </td>
                    <td rowspan="{{ $order->items->count() }}">
                        {{ $order->user->location_company }}
                    </td>
                    <td rowspan="{{ $order->items->count() }}">
                        {{-- PIC logic here if necessary --}}
                    </td>
                    <td rowspan="{{ $order->items->count() }}">
                        {{ App\Helpers\Helper::dateFormat($order->created_at, 'd F Y') }}
                    </td>
                @endif
                {{-- Untuk setiap item --}}
                <td>
                    @if ($item->productadd)
                        <div class="fw-bold text-gray-900">{{ $item->productadd->nama_produk_tambahan }}</div> 
                    @else
                        <div class="fw-bold text-gray-900">{{ $item->product->nama_produk }}</div> 
                    @endif
                </td>
                @if($itemIndex === 0)
                    <td rowspan="{{ $order->items->count() }}" class="text-end">
                        <span>@idr($order->total_price)</span>
                    </td>
                @endif
            </tr>
        @endforeach
    @empty
        <tr>
            <td colspan="11" class="text-center text-muted">
                Data Tidak Tersedia
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
