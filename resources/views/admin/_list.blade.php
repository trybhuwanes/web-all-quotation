@if($orders->count() > 0)
    <ul class="list-group">
        @foreach($orders as $order)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>#{{ $order->trx_code }}</strong> 
                    - {{ $order->user->company ?? 'Tanpa PT' }}
                </div>
                <div>
                    <span class="badge bg-success me-2">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </span>
                    <a href="{{ route('order-admin.show', $order->id) }}" 
                       class="btn btn-sm btn-primary"
                       target="_blank">
                        Detail
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <p class="text-muted">Tidak ada order di tanggal ini.</p>
@endif
