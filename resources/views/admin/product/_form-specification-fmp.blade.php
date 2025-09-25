<div id="spec-form-fmp" class="spec-form d-none">
    <h2 class="my-5">{{ __('Spesifikasi FMP') }}</h2>

    <div class="table-responsive">
        <table class="table table-bordered fs-7" id="fmp-table">
            <thead class="text-center fw-bold align-middle">
                <tr>
                    <th rowspan="2" class="min-w-100px">Type Name</th>
                    <th rowspan="2" class="min-w-200px">Harga</th>
                    <th colspan="2" class="min-w-175px">Dry Solids Capacity<br><small>(kg-DS/hr)</small></th>
                    <th colspan="3" class="min-w-300px">Dimension<br><small>(mm)</small></th>
                    <th rowspan="2" class="min-w-75px">Net Weight<br><small>(kg)</small></th>
                    <th rowspan="2" class="min-w-100px">Power<br><small>(kW)</small></th>
                    <th colspan="2" class="min-w-200px">OPEX Chemical<br><small>(kg/hr)</small></th>
                    <th colspan="2" class="min-w-200px">OPEX Electrical<br><small>(kWh/kg.DS)</small></th>
                    <th rowspan="2" class="min-w-100px">Flush Water</th>
                    <th rowspan="2" class="min-w-175px">Spec x Length</th>
                    <th rowspan="2" class="min-w-75px">Quantity</th>
                    <th rowspan="2" class="min-w-125px">Motor Power</th>
                    <th colspan="3" class="min-w-425px">Flocculated Mix Tank</th>
                    <th rowspan="2" class="min-w-100px">Equipment Weight</th>
                    <th rowspan="2" class="min-w-100px">Operating Weight</th>
                    <th rowspan="2" class="min-w-75px">Work Time (Month)</th>
                    <th rowspan="2">Aksi</th>
                </tr>
                <tr>
                    <th>Min</th>
                    <th>Max</th>
                    <th>L</th>
                    <th>W</th>
                    <th>H</th>
                    <th>Min</th>
                    <th>Max</th>
                    <th>Min</th>
                    <th>Max</th>
                    <th class="min-w-200px">Dimension</th>
                    <th class="min-w-150px">Volume</th>
                    <th>Motorpower</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="type_name" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.01" name="harga" class="form-control form-control-sm"></td>
                    <td><input type="number" name="dry_solids_min" class="form-control form-control-sm"></td>
                    <td><input type="number" name="dry_solids_max" class="form-control form-control-sm"></td>
                    <td><input type="number" name="dimension_l" class="form-control form-control-sm"></td>
                    <td><input type="number" name="dimension_w" class="form-control form-control-sm"></td>
                    <td><input type="number" name="dimension_h" class="form-control form-control-sm"></td>
                    <td><input type="number" name="net_weight" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.01" name="power_kw" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.01" name="opex_chemical_min" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.01" name="opex_chemical_max" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.01" name="opex_electrical_min" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.01" name="opex_electrical_max" class="form-control form-control-sm"></td>
                    <td><input type="text" step="0.01" name="quot_pd_flush_water" class="form-control form-control-sm"></td>
                    <td><input type="text" step="0.01" name="quot_sc_specification_length" class="form-control form-control-sm"></td>
                    <td><input type="text" step="0.01" name="quot_sc_quantity" class="form-control form-control-sm"></td>
                    <td><input type="text" step="0.01" name="quot_sc_motorpower" class="form-control form-control-sm"></td>
                    <td><input type="text" step="0.01" name="quot_fmt_dimension" class="form-control form-control-sm"></td>
                    <td><input type="text" step="0.01" name="quot_fmt_volume" class="form-control form-control-sm"></td>
                    <td><input type="text" step="0.01" name="quot_fmt_motorpower" class="form-control form-control-sm"></td>
                    <td><input type="text" step="1" name="quot_equipment_weight" class="form-control form-control-sm"></td>
                    <td><input type="text" step="1" name="quot_operating_weight" class="form-control form-control-sm"></td>
                    <td><input type="text" step="1" name="quot_work_time" class="form-control form-control-sm"></td>
                    <td><button type="button" class="btn btn-sm btn-danger remove-row">Hapus</button></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <button type="button" class="btn btn-sm btn-primary add-row" data-target="#fmp-table">+ Tambah Row</button>
</div>