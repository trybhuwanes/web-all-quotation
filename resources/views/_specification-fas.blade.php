<h2 class="fw-bold mb-5 text-dark">FLOWREX Surface Aerator (FAS) Tipe & Model</h2>
<table class="table table-bordered fs-base text-dark fw-semibold p-5">
    <thead>
      <tr class="bg-green">
        <th rowspan="2">Type</th>
        <th colspan="2" class="text-center">Power</th>
        <th colspan="5" class="text-center">Aerator</th>
      </tr>
      <tr class="bg-green">
        <th>HP</th>
        <th>KW</th>
        <th>SOTR (kg/h)</th>
        <th>MD (m)</th>
        <th>MZ (m)</th>
        <th>D (m)</th>
        <th>PR (m3/min)</th>
      </tr>
    </thead>
    <tbody>
            @foreach($productShow->specificationFas as $index => $spec)
                <tr class="{{ $index % 2 == 0 ? 'bg-light' : 'bg-light-success' }}">
                    <td>{{ $spec->type_name }}</td>
                    <td>{{ $spec->power_hp }}</td>
                    <td>{{ $spec->power_kw }}</td>
                    <td>{{ $spec->aerator_sotr }}</td>
                    <td>{{ $spec->aerator_md }}</td>
                    <td>{{ $spec->aerator_mz }}</td>
                    <td>{{ $spec->aerator_d }}</td>
                    <td>{{ $spec->aerator_pr }}</td>
                </tr>
            @endforeach
    <tbody>
</table>

                        
<h2 class="fw-bold mb-5 text-dark">Keterangan</h2>
<table class="table table-borderless fs-base text-dark fw-semibold p-0 fs-7">
    <tbody>
        <tr>
            <td class="ps-0 pt-0 pb-4 align-middle border-bottom border-dashed text-muted fw-bold">
            SOTR:
            </td>
            <td class="align-middle pr-0 pt-0 pb-4 border-bottom border-dashed">
                Kg Kapasitas Oksigenasi per Jam (kg/jam)
            </td>
        </tr>
        <tr>
            <td class="ps-0 pt-0 pb-4 align-middle border-bottom border-dashed text-muted fw-bold">
                D:
            </td>
            <td class="align-middle pr-0 pt-0 pb-4 border-bottom border-dashed">
                Kedalaman dalam Pencampuran Sempurna
            </td>
        </tr>
        <tr>
            <td class="ps-0 pt-0 pb-4 align-middle border-bottom border-dashed text-muted fw-bold">
                PR:
            </td>
            <td class="align-middle pr-0 pt-0 pb-4 border-bottom border-dashed">
                Kecepatan Pemompaan, m3 per Menit
            </td>
        </tr>
        <tr>
            <td class="ps-0 pt-0 pb-4 align-middle border-bottom border-dashed text-muted fw-bold">
                MD:
            </td>
            <td class="align-middle pr-0 pt-0 pb-4 border-bottom border-dashed">
                Diameter Pencampuran Lengkap dalam Meter pada Kecepatan Rata-Rata Minimum 1,2 meter per detik (kira-kira) (m)
            </td>
        </tr>
        <tr>
            <td class="ps-0 pt-0 pb-4 align-middle border-bottom border-dashed text-muted fw-bold">
                MZ:
            </td>
            <td class="align-middle pr-0 pt-0 pb-4 border-bottom border-dashed">
                Diameter Zona Pencampuran (m)
            </td>
        </tr>
    </tbody>
</table>