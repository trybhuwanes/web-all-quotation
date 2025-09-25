<div id="spec-form-fas" class="spec-form d-none">
    <h2 class="my-5">{{ __('Spesifikasi FAS') }}</h2>

    <div class="table-responsive">
        <table class="table table-bordered fs-7" id="fas-table">
            <thead class="text-center fw-bold align-middle">
                <tr>
                    <th rowspan="2" class="min-w-100px">Type Name</th>
                    <th rowspan="2" class="min-w-200px">Harga</th>
                    <th colspan="2">Power</th>
                    <th colspan="5">Aerator</th>
                    <th rowspan="2">Net Weight</th>
                    
                    <th rowspan="2">Aksi</th>
                </tr>
                <tr>
                    <th class="min-w-75px">HP</th>
                    <th class="min-w-75px">KW</th>
                    <th class="min-w-75px">SOTR</th>
                    <th class="min-w-75px">MD</th>
                    <th class="min-w-75px">MZ</th>
                    <th class="min-w-75px">D</th>
                    <th class="min-w-75px">PR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="type_name" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.01" name="harga" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.1" name="power_hp" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.1" name="power_kw" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.1" name="aerator_sotr" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.1" name="aerator_md" class="form-control form-control-sm"></td>
                    <td><input type="number" step="1" name="aerator_mz" class="form-control form-control-sm"></td>
                    <td><input type="text" step="0.1" name="aerator_d" class="form-control form-control-sm"></td>
                    <td><input type="number" step="1" name="aerator_pr" class="form-control form-control-sm"></td>
                    <td><input type="number" step="1" name="net_weight" class="form-control form-control-sm"></td>
                    <td><button type="button" class="btn btn-sm btn-danger remove-row">Hapus</button></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <button type="button" class="btn btn-sm btn-primary add-row" data-target="#fas-table">+ Tambah Row</button>
</div>