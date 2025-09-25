<div id="spec-form-bf" class="spec-form d-none">
    <h2 class="my-5">{{ __('Spesifikasi BF') }}</h2>
    
    <div class="table-responsive">
        <table class="table table-bordered fs-7" id="bf-table">
            <thead class="text-center fw-bold align-middle">
                <tr>
                    <th rowspan="2" class="min-w-100px">Type Name</th>
                    <th rowspan="2" class="min-w-200px">Harga</th>
                    <th rowspan="2" class="min-w-200px">Capacity</th>
                    <th colspan="3" class="min-w-300px">Dimension<br><small>(mm)</small></th>
                    <th rowspan="2">Aksi</th>
                </tr>
                <tr>
                    <th>L</th>
                    <th>W</th>
                    <th>H</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="type_name" class="form-control form-control-sm"></td>
                    <td><input type="number" step="1" name="harga" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.01" name="capacity" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.01" name="dimension_l" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.01" name="dimension_w" class="form-control form-control-sm"></td>
                    <td><input type="number" step="0.01" name="dimension_h" class="form-control form-control-sm"></td>
                    <td><button type="button" class="btn btn-sm btn-danger remove-row">Hapus</button></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <button type="button" class="btn btn-sm btn-primary add-row" data-target="#bf-table">+ Tambah Row</button>
</div>