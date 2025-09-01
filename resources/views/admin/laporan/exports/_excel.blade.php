<table style="width:100%;border:1px solid">
    <thead>
        <tr>
            <th colspan="13" rowspan="2"
                style="text-align:center;vertical-align: middle;width: 50%;margin: auto;">
                <span>LAPORAN </span>
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
            <th style="font-weight: bold;background-color: yellow;">Nama</th>
            <th style="font-weight: bold;background-color: yellow">Telpon</th>
            <th style="font-weight: bold;background-color: yellow">Email</th>
            <th style="font-weight: bold;background-color: yellow">Jabatan</th>
            <th style="font-weight: bold;background-color: yellow">Institusi</th>
            <th style="font-weight: bold;background-color: yellow">Lokasi Ins</th>
            <th style="font-weight: bold;background-color: yellow">Bidang Ins</th>
            <th style="font-weight: bold;background-color: yellow">Detail Ins</th>
            <th style="font-weight: bold;background-color: yellow">PIC</th>
            <th style="font-weight: bold;background-color: yellow">Next Todo</th>
            <th style="font-weight: bold;background-color: yellow">Tanggal</th>
            <th style="font-weight: bold;background-color: yellow">Kebutuhan</th>
            <th style="font-weight: bold;background-color: yellow">Kebutuhan Lainnya</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $key => $item)
                <tr>
                    <td>
                        {{ $item->nama }}
                    </td>
                    <td>
                        {{ $item->telpon }}
                    </td>
                    <td class="text-end">
                        <span>{{ $item->email }}</span>
                    </td>
                    <td class="text-end">
                        <span>{{ $item->jabatan }}</span>
                    </td>
                    <td class="text-end">
                        <span>{{ $item->institusi }}</span>
                    </td>
                    <td class="text-end">
                        <span>{{ $item->lokasi_institusi }}</span>
                    </td>
                    <td class="text-end">
                        <span>{{ $item->bidang_institusi }}</span>
                    </td>
                    <td class="text-end">
                        <span>{{ $item->detail_institusi }}</span>
                    </td>
                    <td class="text-end">
                        <span>{{ $item->users->first()->name ?? '-' }}</span>
                    </td>
                    <td class="text-end">
                        <span>{{ $item->reportPresensis->first()->detailReport->next_todo ?? '-' }}</span>
                    </td>
                    <td class="text-end">
                        <span>{{ is_array($item->tgl_hadir) ? implode(', ', $item->tgl_hadir) : $item->tgl_hadir }}</span>
                    </td>

                    <td class="text-end text-uppercase">
                        <span>{{ is_array($item->kebutuhan) ? implode(', ', $item->kebutuhan) : $item->kebutuhan }}</span>
                    </td>
                    <td class="text-end">
                        <span>{{ $item->kebutuhan_lain ?? '-' }}</span>
                    </td>
                    
                </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-muted">
                    Data Tidak Tersedia
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
