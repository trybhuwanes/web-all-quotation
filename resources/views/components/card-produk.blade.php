@props(['produk', 'kategori' =>  false])

@if ($kategori == true)
    <div class="card card-produk border" style="width: 100%; height: 100%;">
        <!--begin::produk image-->
        <a href="{{ route(('detil-produk'), [$produk->slug, $produk->id_produk]) }}">
        {{-- <img class="card-img-top border-bottom h-auto" style="aspect-ratio: 1" src="{{ $produk->getFirstMediaUrl('produk') }}" alt="{{ $produk->getFirstMediaUrl('produk') }}" onerror="this.src='{{ URL::asset('img/gambar-produk.jpg') }}';"/> --}}
        </a>
        <!--end::produk image-->
        <div class="card-body d-flex flex-column justify-content-between">
        <!--begin::deskripsi produk-->
        <div class="d-flex flex-column" style="gap:2px;">
            <p class="card-title mb-0 font-weight-normal" style="font-size: 16px; color: #000;">
            <a href="{{ route(('detil-produk'), [$produk->slug, $produk->id_produk]) }}" class="font-weight-normal">
                @if (strlen($produk->nama_produk) > 26)
                {{ substr($produk->nama_produk,0,24) }}..
                @else
                {{ $produk->nama_produk }}
                @endif
            </a>
            </p>
            <p class="card-text mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M4.423 5.5v-1h15.154v1zm.077 14v-6H3.27v-1l1.153-5h15.154l1.154 5v1H19.5v6h-1v-6h-5v6zm1-1h7v-5h-7z"/></svg> 
                <a href="{{ route('halaman-toko', $produk->toko->domain) }}">{{ $produk->toko->nama_toko }}</a>
            </p>
            @if ($produk->toko->pengelolaCluster != null)    
            <p class="card-text mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M9.462 12.654h1.692v-2.365h1.692v2.365h1.692V8.596L12 6.904L9.461 8.596zM12 21.019q-3.525-3.117-5.31-5.814q-1.786-2.697-1.786-4.909q0-3.173 2.066-5.234Q9.037 3 12 3t5.03 2.062q2.066 2.061 2.066 5.234q0 2.212-1.785 4.909q-1.786 2.697-5.311 5.814"/></svg>
                <a>Cluster : 
                    @if (strlen($produk->toko->pengelolaCluster->nama_cluster) > 16)
                        {{ substr($produk->toko->pengelolaCluster->nama_cluster,0,16) }}...
                    @else
                        {{ $produk->toko->pengelolaCluster->nama_cluster }}
                    @endif
                </a>
            </p>
        @endif
            <p class="font-weight-bold mb-0" style="font-size: 16px; color: #000;">Rp{{ number_format($produk->harga) }}</p>
            <div class="ps-product__rating d-flex" style="gap: 4px;">
                @if ($produk->detailpenjualan->where('tgl_ulasan', '!=', '')->count() > 0)
                    <select class="ps-rating" data-read-only="true">
                    @if($produk->detailpenjualan->where('tgl_ulasan', '!=', '')->count() == 0 )
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    @else
                        @for($i=1; $i<=$produk->detailpenjualan->where('tgl_ulasan', '!=', '')->avg('rating'); $i++)
                        <option value="1">1</option>
                        @endfor
                        @php
                        $totrat = 5;
                        $rat = $produk->detailpenjualan->where('tgl_ulasan', '!=', '')->avg('rating');
                        $selisih = $totrat - $rat;
                        @endphp
                        @for($j=1; $j<=$selisih; $j++)
                        <option value="5">5</option>
                        @endfor
                    @endif
                    </select>
                    @if ($produk->quantity_sold > 0)
                        <span class="title-star">@if ($produk->detailpenjualan->where('tgl_ulasan', '!=', '')->count() > 0)| @endif  @if ($produk->quantity_sold > 100) 100+ @else {{ $produk->quantity_sold }} @endif Terjual</span>
                    @endif
                @else
                    @if ($produk->quantity_sold > 0)
                        <span> @if ($produk->quantity_sold > 100) 100+ @else {{ $produk->quantity_sold }} @endif Terjual</p>
                    @endif
                @endif
            </div>
        </div>
        <!--end::deskripsi produk-->
        <!--begin::button love and cart-->
        <div class="d-flex mt-2" style="display:none!important;">
            @if (isset($tokosaya->id_toko) ? Auth::user() && $tokosaya->id_toko != $produk->toko->id_toko : Auth::user())
            <form class="w-100 mr-3">
                @csrf
                <button type="button" class="btn btn-cart btn-block py-1 mr-3 keranjang h-100" id="{{ $produk->id_produk }}" data-toko="{{ $produk->toko->id_toko }}" data-produk="{{ $produk->nama_produk }}" data-harga="{{ $produk->harga }}" data-minbeli="{{ $produk->min_beli }}" data-username="{{ Auth::user()->username }}" data-gambar="{{ $produk->getFirstMediaUrl('produk') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6z"/></svg>
                Keranjang
                </button>
            </form>

            <form>
                @csrf
                <button type="button" name="button" class="btn-like border wishlist h-100 @if($favoritsaya->where('id_produk', $produk->id_produk)->count() == 0) isi @else nonisi @endif" data-harga="{{ $produk->harga }}" data-username="{{ Auth::user()->username }}">

                @if($favoritsaya->where('id_produk', $produk->id_produk)->count() > 0)
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#FF0000" d="M21.81 10.89q.16.147.16.348t-.16.366l-3.32 3.313q-.217.224-.555.224t-.575-.224l-1.214-1.207Q16 13.563 16 13.362t.166-.346q.146-.16.347-.16t.347.16l1.065 1.046l3.19-3.171q.147-.16.348-.16t.347.16m-11.37 8.284l-.596-.563q-2.28-2.087-3.799-3.593T3.632 12.34q-.896-1.173-1.264-2.146T2 8.225q0-1.908 1.296-3.201T6.5 3.731q1.32 0 2.475.672T11 6.363q.87-1.288 2.025-1.96q1.156-.672 2.475-.672q1.817 0 3.063 1.172q1.245 1.172 1.403 2.878q-.424-.143-.878-.202t-.913-.06q-2.183 0-3.813 1.52t-1.631 3.942q0 .988.361 1.966q.362.978 1.12 1.772q-.533.483-1.17 1.069t-1.284 1.181l-.223.206q-.237.212-.547.212t-.547-.212"/></svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#4AB3D3" d="M21.81 10.89q.16.147.16.348t-.16.366l-3.32 3.313q-.217.224-.555.224t-.575-.224l-1.214-1.207Q16 13.563 16 13.362t.166-.346q.146-.16.347-.16t.347.16l1.065 1.046l3.19-3.171q.147-.16.348-.16t.347.16m-11.37 8.284l-.596-.563q-2.28-2.087-3.799-3.593T3.632 12.34q-.896-1.173-1.264-2.146T2 8.225q0-1.908 1.296-3.201T6.5 3.731q1.32 0 2.475.672T11 6.363q.87-1.288 2.025-1.96q1.156-.672 2.475-.672q1.817 0 3.063 1.172q1.245 1.172 1.403 2.878q-.424-.143-.878-.202t-.913-.06q-2.183 0-3.813 1.52t-1.631 3.942q0 .988.361 1.966q.362.978 1.12 1.772q-.533.483-1.17 1.069t-1.284 1.181l-.223.206q-.237.212-.547.212t-.547-.212"/></svg>
                @endif

                </button>
            </form>
            @endif
        </div>
        <!--end::button love and cart-->
        </div>
    </div>
@else
    <div class="card card-produk" style="width: 100%; height: 100%;">
        <!--begin::produk image-->
        <a href="{{ route(('detil-produk'), [$produk->slug, $produk->id_produk]) }}">
        {{-- <img class="card-img-top border-bottom h-auto" style="aspect-ratio: 1" src="{{ $produk->getFirstMediaUrl('produk') }}" alt="{{ $produk->getFirstMediaUrl('produk') }}" onerror="this.src='{{ URL::asset('img/gambar-produk.jpg') }}';"/> --}}
        </a>
        <!--end::produk image-->
        <div class="card-body d-flex flex-column justify-content-between">
        <!--begin::deskripsi produk-->
        <div class="d-flex flex-column" style="gap:2px;">
            <p class="card-title mb-0 font-weight-normal" style="font-size: 16px; color: #000;">
            <a href="{{ route(('detil-produk'), [$produk->slug, $produk->id_produk]) }}" class="font-weight-normal">
                @if (strlen($produk->nama_produk) > 26)
                {{ substr($produk->nama_produk,0,24) }}..
                @else
                {{ $produk->nama_produk }}
                @endif
            </a>
            </p>
            <p class="card-text mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M4.423 5.5v-1h15.154v1zm.077 14v-6H3.27v-1l1.153-5h15.154l1.154 5v1H19.5v6h-1v-6h-5v6zm1-1h7v-5h-7z"/></svg> 
                <a href="{{ route('halaman-toko', $produk->toko->domain) }}">{{ $produk->toko->nama_toko }}</a>
            </p>
            @if ($produk->toko->pengelolaCluster != null)    
                <p class="card-text mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M9.462 12.654h1.692v-2.365h1.692v2.365h1.692V8.596L12 6.904L9.461 8.596zM12 21.019q-3.525-3.117-5.31-5.814q-1.786-2.697-1.786-4.909q0-3.173 2.066-5.234Q9.037 3 12 3t5.03 2.062q2.066 2.061 2.066 5.234q0 2.212-1.785 4.909q-1.786 2.697-5.311 5.814"/></svg>
                    <a>Cluster : 
                        @if (strlen($produk->toko->pengelolaCluster->nama_cluster) > 16)
                            {{ substr($produk->toko->pengelolaCluster->nama_cluster,0,16) }}...
                        @else
                            {{ $produk->toko->pengelolaCluster->nama_cluster }}
                        @endif
                    </a>
                </p>
            @endif
            <p class="font-weight-bold mb-0" style="font-size: 16px; color: #000;">Rp{{ number_format($produk->harga) }}</p>
            <div class="ps-product__rating d-flex" style="gap: 4px;">
                @if ($produk->detailpenjualan->where('tgl_ulasan', '!=', '')->count() > 0)
                    <select class="ps-rating" data-read-only="true">
                    @if($produk->detailpenjualan->where('tgl_ulasan', '!=', '')->count() == 0 )
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    @else
                        @for($i=1; $i<=$produk->detailpenjualan->where('tgl_ulasan', '!=', '')->avg('rating'); $i++)
                        <option value="1">1</option>
                        @endfor
                        @php
                        $totrat = 5;
                        $rat = $produk->detailpenjualan->where('tgl_ulasan', '!=', '')->avg('rating');
                        $selisih = $totrat - $rat;
                        @endphp
                        @for($j=1; $j<=$selisih; $j++)
                        <option value="5">5</option>
                        @endfor
                    @endif
                    </select>
                    @if ($produk->quantity_sold > 0)
                        <span class="title-star">@if ($produk->detailpenjualan->where('tgl_ulasan', '!=', '')->count() > 0)| @endif @if ($produk->quantity_sold > 100) 100+ @else {{ $produk->quantity_sold }} @endif Terjual</span>
                    @endif
                @else
                    @if ($produk->quantity_sold > 0)
                        <span> @if ($produk->quantity_sold > 100) 100+ @else {{ $produk->quantity_sold }} @endif Terjual</p>
                    @endif
                @endif
            </div>
        </div>
        <!--end::deskripsi produk-->
        <!--begin::button love and cart-->
        <div class="d-flex mt-2" style="display:none!important;">
            @if (isset($tokosaya->id_toko) ? Auth::user() && $tokosaya->id_toko != $produk->toko->id_toko : Auth::user())
            <form class="w-100 mr-3">
                @csrf
                <button type="button" class="btn btn-cart btn-block py-1 mr-3 keranjang h-100" id="{{ $produk->id_produk }}" data-toko="{{ $produk->toko->id_toko }}" data-produk="{{ $produk->nama_produk }}" data-harga="{{ $produk->harga }}" data-minbeli="{{ $produk->min_beli }}" data-username="{{ Auth::user()->username }}" data-gambar="{{ $produk->getFirstMediaUrl('produk') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6z"/></svg>
                Keranjang
                </button>
            </form>

            <form>
                @csrf
                <button type="button" name="button" class="btn-like border wishlist h-100 @if($favoritsaya->where('id_produk', $produk->id_produk)->count() == 0) isi @else nonisi @endif" data-harga="{{ $produk->harga }}" data-username="{{ Auth::user()->username }}">

                @if($favoritsaya->where('id_produk', $produk->id_produk)->count() > 0)
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#FF0000" d="M21.81 10.89q.16.147.16.348t-.16.366l-3.32 3.313q-.217.224-.555.224t-.575-.224l-1.214-1.207Q16 13.563 16 13.362t.166-.346q.146-.16.347-.16t.347.16l1.065 1.046l3.19-3.171q.147-.16.348-.16t.347.16m-11.37 8.284l-.596-.563q-2.28-2.087-3.799-3.593T3.632 12.34q-.896-1.173-1.264-2.146T2 8.225q0-1.908 1.296-3.201T6.5 3.731q1.32 0 2.475.672T11 6.363q.87-1.288 2.025-1.96q1.156-.672 2.475-.672q1.817 0 3.063 1.172q1.245 1.172 1.403 2.878q-.424-.143-.878-.202t-.913-.06q-2.183 0-3.813 1.52t-1.631 3.942q0 .988.361 1.966q.362.978 1.12 1.772q-.533.483-1.17 1.069t-1.284 1.181l-.223.206q-.237.212-.547.212t-.547-.212"/></svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#4AB3D3" d="M21.81 10.89q.16.147.16.348t-.16.366l-3.32 3.313q-.217.224-.555.224t-.575-.224l-1.214-1.207Q16 13.563 16 13.362t.166-.346q.146-.16.347-.16t.347.16l1.065 1.046l3.19-3.171q.147-.16.348-.16t.347.16m-11.37 8.284l-.596-.563q-2.28-2.087-3.799-3.593T3.632 12.34q-.896-1.173-1.264-2.146T2 8.225q0-1.908 1.296-3.201T6.5 3.731q1.32 0 2.475.672T11 6.363q.87-1.288 2.025-1.96q1.156-.672 2.475-.672q1.817 0 3.063 1.172q1.245 1.172 1.403 2.878q-.424-.143-.878-.202t-.913-.06q-2.183 0-3.813 1.52t-1.631 3.942q0 .988.361 1.966q.362.978 1.12 1.772q-.533.483-1.17 1.069t-1.284 1.181l-.223.206q-.237.212-.547.212t-.547-.212"/></svg>
                @endif

                </button>
            </form>
            @endif
        </div>
        <!--end::button love and cart-->
        </div>
    </div>
@endif