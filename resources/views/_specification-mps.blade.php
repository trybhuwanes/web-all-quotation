<h2 class="fw-bold mb-5 text-dark">MPS TIPE & MODEL</h2>
                        <table class="table table-bordered fs-base text-dark fw-semibold">
                            <thead>
                              <tr class="bg-green">
                                <th rowspan="2" class="align-middle">Model</th>
                                <th colspan="2" class="text-center">Dry Solids<br>Capacity<br>(kg-DS/hr)</th>
                                <th colspan="3" class="text-center">DIMENSION<br>(mm)</th>
                                <th rowspan="2" class="align-middle text-center">Net<br>Weight</th>
                                <th rowspan="2" class="align-middle text-center">Power<br>(kW)</th>
                                <th colspan="2" class="text-center">OPEX<br>Chemical<br>(kg/hr)</th>
                                <th colspan="2" class="text-center">OPEX<br>Electrical<br>(kWh/kg.DS)</th>
                              </tr>
                              <tr class="bg-green">
                                <th class="text-center">Min</th>
                                <th class="text-center">Max</th>
                                <th class="text-center">L</th>
                                <th class="text-center">W</th>
                                <th class="text-center">H</th>
                                <th class="text-center">Min</th>
                                <th class="text-center">Max</th>
                                <th class="text-center">Min</th>
                                <th class="text-center">Max</th>
                              </tr>
                            </thead>
                            <tbody>
                                    @foreach($productShow->specificationFmp as $index => $spec)
                                        <tr class="{{ $index % 2 == 0 ? 'bg-light' : 'bg-light-success' }}">
                                            <td>{{ $spec->type_name }}</td>
                                            <td>{{ $spec->dry_solids_min }}</td>
                                            <td>{{ $spec->dry_solids_max }}</td>
                                            <td>{{ $spec->dimension_l }}</td>
                                            <td>{{ $spec->dimension_w }}</td>
                                            <td>{{ $spec->dimension_h }}</td>
                                            <td>{{ $spec->net_weight }}</td>
                                            <td>@formatNumberDecimal($spec->power_kw)</td>
                                            <td>@formatNumberDecimal($spec->opex_chemical_min)</td>
                                            <td>@formatNumberDecimal($spec->opex_chemical_max)</td>
                                            <td>@formatNumberDecimal($spec->opex_electrical_min)</td>
                                            <td>@formatNumberDecimal($spec->opex_electrical_max)</td>
                                        </tr>
                                    @endforeach
                              
                            </tbody>
                        </table>

                        <h2 class="fw-bold mb-5 text-dark">Keterangan</h2>
                        <p>
                            Dengan spesifikasi dari FLOWREX® Multi Plate Screw Press
                            (MPS) yang telah dijabarkan, produk screw press ini dapat
                            digunakan pada berbagai jenis industri serta
                            memperhitungkan biaya operasional yang akan dikeluarkan.
                        </p>