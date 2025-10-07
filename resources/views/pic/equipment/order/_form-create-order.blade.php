<div id="kt_form_create_quotation">
    <form id="kt_create_quotation_form" class="form d-flex flex-column flex-lg-row" action="javascript:;">
        <div class="flex-row-fluid gap-7 gap-lg-10">
            <div class="tab-content">
                <div class="fade show active" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!-- Items Table -->
                        <div id="kt_form_create_quotation">
                            <form id="kt_create_quotation_form" class="form d-flex flex-column flex-lg-row" action="javascript:;">
                                <div class="flex-row-fluid gap-7 gap-lg-10">
                                    <div class="tab-content">
                                        <div class="fade show active" role="tab-panel">
                                            <div class="d-flex flex-column gap-7">
                                                <!-- Quotation Parties -->
                                                <div class="card card-flush py-4">
                                                    <div class="card-body pt-0 row">
                                                        <div class="col-md-6">
                                                            <!--begin::Header-->
                                                            <h3 class="card-title align-items-start flex-column my-5">
                                                                <span class="card-label fw-bold fs-3">{{__('Quotation From')}}</span>
                                                                <span class="text-muted mt-1 fw-semibold fs-7">Masukkan data perusahaan</span>
                                                            </h3>
                                                            <!--end::Header-->

                                                            <!--begin::Input-->
                                                            <label class="form-label">Pilih Perusahaan</label>
                                                            <select id="company-select" name="company_id" 
                                                                class="form-select" data-control="select2" 
                                                                data-placeholder="Cari perusahaan...">
                                                                <option></option>
                                                            </select>
                                                            <label class="form-label mt-3">Company Name</label>
                                                            <input type="text" name="from_business" class="form-control mb-2" placeholder="Company Name" readonly/>

                                                            <label class="form-label">Address</label>
                                                            <textarea name="from_address" class="form-control mb-2" rows="3" placeholder="Company Address" readonly></textarea>

                                                            <input type="hidden" name="from_contact" class="form-control mb-2"/>
                                                            <!--end::Input-->
                                                        </div>

                                                        <div class="col-md-6">
                                                            <!--begin::Header-->
                                                            <h3 class="card-title align-items-start flex-column mb-4 my-5">
                                                                <span class="card-label fw-bold fs-3">{{__('Quotation For')}}</span>
                                                                <span class="text-muted mt-1 fw-semibold fs-7">Masukkan data klien</span>
                                                            </h3>
                                                            <!--end::Header-->

                                                            <!--begin::Input-->
                                                            <label class="form-label">Pilih Client</label>
                                                            <select id="client-select" name="client_id" 
                                                                class="form-select" data-control="select2" 
                                                                data-placeholder="Cari client...">
                                                                <option></option>
                                                            </select>

                                                            <label class="form-label mt-3">Business Name</label>
                                                            <input type="text" name="to_business" class="form-control mb-2" placeholder="Client Business Name" readonly/>

                                                            <label class="form-label">Address</label>
                                                            <textarea name="to_address" class="form-control mb-2" rows="3" placeholder="Client Address" readonly></textarea>
                                                            
                                                            <input type="hidden" name="to_contact" class="form-control mb-2"/>
                                                            <!--end::Input-->

                                                                <a 
                                                                    class="btn btn-sm btn-info btn-active-primary mt-3"
                                                                    data-bs-toggle="modal" 
                                                                    data-bs-target="#modal-add-client">
                                                                    <i class="ki-duotone ki-pencil fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                                    {{__('Tambah Client')}}
                                                                </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Checkbox Tambah Shipping -->
                                                <div class="card card-flush py-4 mt-3">
                                                    <div class="my-5 mx-9">
                                                        <label class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" name="use_shipping_to_onsite" id="toggle-shipping" />
                                                            <span class="form-check-label">Tambah Detail Shipping</span>
                                                        </label>
                                                    </div>
                                                    <div class="card-body d-none" id="shipping-section">
                                                        <div class="row">
                                                            <!-- Shipping From -->
                                                            <div class="col-md-6">
                                                                <!--begin::Header-->
                                                                <h3 class="card-title align-items-start flex-column mb-4">
                                                                    <span class="card-label fw-bold fs-3">{{__('Shipping From')}}</span>
                                                                    <span class="text-muted mt-1 fw-semibold fs-7">Masukkan data pengirim</span>
                                                                </h3>
                                                                <!--end::Header-->

                                                                <!--begin::Input-->
                                                                <label class="form-check mb-4">
                                                                    <input type="checkbox" id="copy-from-quotation" class="form-check-input mb-3" />
                                                                    <span class="form-check-label">Sama dengan Quotation From</span>
                                                                </label>
                                                                <div id="shipping-from-fields">
                                                                    <input type="text" name="shipping_from_company" class="form-control mb-2" placeholder="Company" />
                                                                    <textarea name="shipping_from_address" class="form-control mb-2" rows="3" placeholder="Address"></textarea>
                                                                    <input type="text" name="shipping_from_contact" class="form-control mb-2" placeholder="Contact Person" />
                                                                </div>
                                                                <!--end::Input-->
                                                            </div>

                                                            <!-- Shipping For -->
                                                            <div class="col-md-6">
                                                                <!--begin::Header-->
                                                                <h3 class="card-title align-items-start flex-column mb-4">
                                                                    <span class="card-label fw-bold fs-3">{{__('Shipping For')}}</span>
                                                                    <span class="text-muted mt-1 fw-semibold fs-7">Masukkan data penerima</span>
                                                                </h3>
                                                                <!--end::Header-->

                                                                <!--begin::Input-->
                                                                <label class="form-check mb-4">
                                                                    <input type="checkbox" id="copy-for-quotation" class="form-check-input mb-3" />
                                                                    <span class="form-check-label">Sama dengan Quotation For</span>
                                                                </label>
                                                                <div id="shipping-for-fields">
                                                                    <input type="text" name="shipping_to_company" class="form-control mb-2" placeholder="Company" />
                                                                    <textarea name="shipping_to_address" class="form-control mb-2" rows="3" placeholder="Address"></textarea>
                                                                    <input type="text" name="shipping_to_contact" class="form-control mb-2" placeholder="Contact Person" />
                                                                    <input type="text" name="shipping_state" class="form-control mb-2" placeholder="Province" />
                                                                    <input type="text" name="shipping_country" class="form-control mb-2" placeholder="City" />
                                                                    <input type="text" name="shipping_district" class="form-control mb-2" placeholder="District" />
                                                                </div>
                                                                <!--end::Input-->
                                                            </div>
                                                        </div>

                                                        <!-- begin:Shipping cost -->
                                                        <div class="row mt-4">
                                                            <div class="col-md-2">
                                                                <label class="form-label">Berat (Kg)</label>
                                                                <input type="number" step="0.01" name="weight_kg" class="form-control" />
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label">Volume (m³)</label>
                                                                <input type="number" step="0.01" name="volume_m3" class="form-control" />
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label">Biaya Shipping</label>
                                                                <input type="number" step="1" name="shipping_cost" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <!-- end:Shipping cost -->
                                                    </div>
                                                </div>

                                                <!-- Item Utama -->
                                                <div class="card card-flush py-3" id="main-item">
                                                    <!--begin::Header-->
                                                    <div class="card mb-5 mb-xl-8">
                                                        <div class="card-header border-0 pt-5">
                                                            <h3 class="card-title align-items-start flex-column">
                                                                <span class="card-label fw-bold fs-3 mb-1">{{__('Produk Utama')}}</span>

                                                                <span class="text-muted mt-1 fw-semibold fs-7">Pilh produk utama, masukkan tipe, dan kuantitas sesuai kebutuhan.</span>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                    <!--end::Header-->

                                                    <!-- begin:Input -->
                                                    <div class="card-body pt-0">
                                                        <div class="row mb-5">
                                                            <div class="col-md-4">
                                                                <label class="form-label">Produk Utama</label>
                                                                <select name="main_product_id" id="main-product"
                                                                        class="form-select product-select"
                                                                        data-control="select2" data-placeholder="Pilih produk utama">
                                                                    <option></option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-label">Kuantitas</label>
                                                                <input type="number" name="main_qty"
                                                                    class="form-control qty" value="1" min="1">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Harga</label>
                                                                <input type="number" name="main_rate"
                                                                    class="form-control rate" value="0" readonly>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Jumlah</label>
                                                                <input type="number" name="main_amount"
                                                                    class="form-control amount" value="0" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mt-4">
                                                            <label class="form-label">Pilih Tipe Produk</label>
                                                            <div class="row" id="main-product-types">
                                                                {{-- tipe produk dimuat via ajax --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end:Input -->
                                                </div>

                                                <!-- Begin::Item Tambahan -->
                                                <div class="card card-flush py-3">
                                                    <!--begin::Header-->
                                                    <div class="card mb-5 mb-xl-8">
                                                        <div class="card-header border-0 pt-5">
                                                            <h3 class="card-title align-items-start flex-column">
                                                                <span class="card-label fw-bold fs-3 mb-1">{{__('Produk Tambahan')}}</span>

                                                                <span class="text-muted mt-1 fw-semibold fs-7">Pilh produk tambahan, masukkan kuantitas, dan harga sesuai kebutuhan.</span>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                    <!--end::Header-->

                                                    <!-- begin:Input -->
                                                    <div class="card-body pt-0">
                                                        <div class="table-responsive">
                                                            <table class="table align-middle" id="additional-items">
                                                                <thead class="bg-light">
                                                                    <tr>
                                                                        <th style="width: 30%">Produk Tambahan</th>
                                                                        <th style="width: 10%">Kuantitas</th>
                                                                        <th style="width: 15%">Harga</th>
                                                                        <th style="width: 15%">Jumlah</th>
                                                                        <th class="text-end" style="width: 10%">Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <select name="additional_items[0][product_id]"
                                                                                class="form-select additional-product-select"
                                                                                data-control="select2"
                                                                                data-placeholder="Pilih produk tambahan">
                                                                                <option></option>
                                                                            </select>
                                                                        </td>
                                                                        <td><input type="number" name="additional_items[0][qty]" class="form-control qty" value="1"></td>
                                                                        <td><input type="number" name="additional_items[0][rate]" class="form-control rate" value="0"></td>
                                                                        <td><input type="text" name="additional_items[0][amount]" class="form-control amount" readonly></td>
                                                                        <td class="text-end"><button type="button" class="btn btn-sm btn-danger remove-row">Hapus</button></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="mt-3 text-end">
                                                            <h3>Total: <span id="quotation-total">@idr(0)</span></h3>
                                                        </div>
                                                    </div>
                                                    <!-- end:Input -->
                                                </div>
                                                <!-- End::Item Tambahan -->

                                                <div class="tab-content mb-5">
                                                    <div class="card mb-5 mb-xl-8">
                                                    <!--begin::Header-->
                                                    <div class="card-header border-0 pt-5">
                                                        <h3 class="card-title flex-column">
                                                            <span class="card-label fw-bold fs-3 mb-1">{{__('Histori Revisi')}}</span>
                                                            <span class="text-muted mt-1 fw-semibold fs-7">Histori Revisi ini digukan untuk dokumen penawaran</span>
                                                        </h3>
                                                    </div>
                                                    <!--end::Header-->

                                                    <!--begin::Body-->
                                                    <div class="card-body py-3">
                                                        <!--begin::Table container-->
                                                        <div class="table-responsive">
                                                            <!--begin::Table-->
                                                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="kt_modal_add_user">
                                                                <!--begin::Table head-->
                                                                <thead style="background-color: white;">
                                                                    <tr class="text-gray-500 fw-bold fs-7 text-uppercase">
                                                                        <th class="w-25px">No.</th>
                                                                        <th class="min-w-25px">Revisi Nomer</th>
                                                                        <th class="min-w-350px">Deskripsi</th>
                                                                        <th class="min-w-150px text-end">Di buat</th>
                                                                    </tr>
                                                                </thead>
                                                                <!--end::Table head-->

                                                                <!--begin::Table body-->
                                                                <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <span class="fw-bold d-block fs-6">1.</span>                           
                                                                            </td>
                                                                            <td>
                                                                                <span class="fw-bold d-block fs-6">Rev.0</span>
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex justify-content-start flex-shrink-0">
                                                                                    <span class="fw-bold d-block fs-7">Quotation First Issue</span>
                                                                                </div>
                                                                            </td>
                                                                            <td class="d-flex justify-content-end flex-shrink-0">
                                                                                <span id="datetime" class="fw-bold d-block fs-7 me-4 pt-3"></span>
                                                                            </td>
                                                                        </tr>
                                                                </tbody>
                                                                <!--end::Table body-->
                                                            </table>
                                                            <!--end::Table-->
                                                        </div>
                                                        <!--end::Table container-->
                                                    </div>
                                                    <!--begin::Body-->

                                                </div>
                                                
                                                <!--end::Histori Revisi Tab content-->
                                                <!-- Begin::Term Payment -->
                                                <div class="card card-flush py-3">
                                                    <div class="card mb-5 mb-xl-8">
                                                        <!--begin::Header-->
                                                        <div class="card-header border-0 pt-5">
                                                            <h3 class="card-title align-items-start flex-column">
                                                                <span class="card-label fw-bold fs-3 mb-1">{{__('Syarat & Ketentuan Pembayaran')}}</span>

                                                                <span class="text-muted mt-1 fw-semibold fs-7">Syarat & Ketentuan Pembayaran digukan untuk dokumen penawaran</span>
                                                            </h3>
                                                        </div>
                                                        <!--end::Header-->

                                                        <!--begin::Body-->
                                                        <div class="card-body py-3">
                                                            <!--begin::Table container-->
                                                            <div class="">
                                                                <!--begin::Input-->
                                                                <div id="kt_create_form_editor" class="bg-transparent border-0 h-75px px-3">
                                                                </div>
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Table container-->
                                                        </div>
                                                    </div>
                                                    <!--End::Body-->
                                                </div>
                                                <!-- End::Term Payment -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{ route('quot-equipment.index') }}" id="kt_ecommerce_add_project_cancel"
                                class="btn btn-danger me-5">
                                Batal
                            </a>
                            <!--end::Button-->

                            <!--begin::Button-->
                            <button type="submit" data-kt-project-action="submit" class="btn btn-primary" >
                                <span class="indicator-label">
                                    Simpan
                                </span>
                                <span class="indicator-progress">
                                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal Tambah Client -->
<div class="modal fade" id="modal-add-client" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-10">
        <h3 class="modal-title mb-5">Tambah Client Baru</h3>
        <!--begin::Form-->
        <form class="form w-150" novalidate="novalidate" id="form-add-client" method="POST" action="{{ route('client.store') }}">
            @csrf
            <!--begin::Input group--->
            <div class="fv-row mb-3">
                <!--begin::Nama-->
                <input type="text" placeholder="Nama Lengkap*" id="name" name="name" required autocomplete="off" class="form-control bg-transparent"/>
                <x-input-error :messages="$errors->get('name')" class="text-danger"/>
                <!--end::Nama-->
            </div>
            <!--end::Input group--->

            <!--begin::Input group--->
            <div class="fv-row mb-3">
                <!--begin::Telpon-->
                <input type="number" placeholder="Nomer Telepon*" id="phone" name="phone" required autocomplete="off" class="form-control bg-transparent"/>
                <x-input-error :messages="$errors->get('phone')" class="text-danger"/>
                <!--end::Telpon-->
            </div>
            <!--end::Input group--->

            <!--begin::Input group-->
            <div class="row fv-row mb-2">
                <!--begin::Col-->
                <div class="col-xl-6 mt-1">              
                    <!--begin::Telpon-->
                    <input class="form-control bg-transparent" type="text" placeholder="Jabatan*" name="job_title" required autocomplete="off" data-kt-translate="sign-up-input-first-name"/>
                    <x-input-error :messages="$errors->get('job_title')" class="text-danger"/>
                    <!--end::Telpon-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-6 mt-1">              
                    <input class="form-control bg-transparent" type="text" placeholder="Asal Institusi (PT/CV)*" required name="company" autocomplete="off" data-kt-translate="sign-up-input-first-name"/>
                    <x-input-error :messages="$errors->get('company')" class="text-danger"/>
                </div>
                <!--end::Col-->
            </div>

            <!--begin::Input group-->
            <div class="row fv-row mb-2">
                <!-- Select Provinsi -->
                    <div class="col-xl-6 mt-1">              
                        <select name="location_company" id="lokasi_institusi" data-control="select2" required data-placeholder="Pilih provinsi*" class="form-select form-select-solid provinsi">
                            <option value="">Pilih provinsi...</option>
                            <option value="Nanggroe Aceh Darussalam">Nanggroe Aceh Darussalam</option>
                                        <option value="Sumatera Utara">Sumatera Utara</option>
                                        <option value="Sumatera Selatan">Sumatera Selatan</option>
                                        <option value="Sumatera Barat">Sumatera Barat</option>
                                        <option value="Bengkulu">Bengkulu</option>
                                        <option value="Riau">Riau</option>
                                        <option value="Kepulauan Riau">Kepulauan Riau</option>
                                        <option value="Jambi">Jambi</option>
                                        <option value="Lampung">Lampung</option>
                                        <option value="Bangka Belitung">Bangka Belitung</option>
                                        <option value="Kalimantan Barat">Kalimantan Barat</option>
                                        <option value="Kalimantan Timur">Kalimantan Timur</option>
                                        <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                        <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                        <option value="Kalimantan Utara">Kalimantan Utara</option>
                                        <option value="Banten">Banten</option>
                                        <option value="DKI Jakarta">DKI Jakarta</option>
                                        <option value="Jawa Barat">Jawa Barat</option>
                                        <option value="Jawa Tengah">Jawa Tengah</option>
                                        <option value="Daerah Istimewa Yogyakarta">Daerah Istimewa Yogyakarta</option>
                                        <option value="Jawa Timur">Jawa Timur</option>
                                        <option value="Bali">Bali</option>
                                        <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                        <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                        <option value="Gorontalo">Gorontalo</option>
                                        <option value="Sulawesi Barat">Sulawesi Barat</option>
                                        <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                        <option value="Sulawesi Utara">Sulawesi Utara</option>
                                        <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                        <option value="Maluku Utara">Maluku Utara</option>
                                        <option value="Maluku">Maluku</option>
                                        <option value="Papua Barat">Papua Barat</option>
                                        <option value="Papua">Papua</option>
                                        <option value="Papua Tengah">Papua Tengah</option>
                                        <option value="Papua Pegunungan">Papua Pegunungan</option>
                                        <option value="Papua Selatan">Papua Selatan</option>
                                        <option value="Papua Barat Daya">Papua Barat Daya</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('location_company')" class="text-danger"/>
                                </div>

                                <!-- Select Kota -->
                                <div class="col-xl-6 mt-1">
                                    <select name="location_city" id="kota" data-control="select2" data-placeholder="Pilih kota*" required class="form-select form-select-solid kota">
                                        <option value="">Pilih kota...</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('location_city')" class="text-danger"/>
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <!--begin::Col-->
                                <div class="col-xl-6 mt-1">              
                                    <!--begin::Select-->
                                    <select name="field_company" id="bidang_institusi" required data-control="select2" data-placeholder="Pilih bidang*" class="form-select form-select-solid">
                                        <option value="">Pilih...</option>
                                        <option value="Pertanian, Kehutanan, Perikanan">Pertanian, Kehutanan, Perikanan</option>
                                        <option value="Pertambangan dan Penggalian">Pertambangan dan Penggalian</option>
                                        <option value="Industri Pengolahan">Industri Pengolahan</option>
                                        <option value="Treatment Air/Limbah">Treatment Air/Limbah</option>
                                        <option value="Konstruksi">Konstruksi</option>
                                        <option value="Pedagang Besar dan Eceran (Supplier)">Pedagang Besar dan Eceran (Supplier)</option>
                                        <option value="Real Estate">Real Estate</option>
                                        <option value="Pendidikan">Pendidikan</option>
                                        <option value="Aktivitas Kesehatan">Aktivitas Kesehatan</option>
                                        <option value="Asosiasi/NGO">Asosiasi/NGO</option>
                                    </select>
                                    <!--end::Select-->
                                    <x-input-error :messages="$errors->get('field_company')" class="text-danger"/>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-xl-6 mt-1">            
                                    <input class="form-control bg-transparent" type="text" placeholder="Detail Institusi*" required name="detail_company" autocomplete="off" data-kt-translate="sign-up-input-last-name"/>
                                    <x-input-error :messages="$errors->get('detail_company')" class="text-danger"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        
                            <!--begin::Input group--->
                            <div class="fv-row mb-3">
                                <!--begin::Email-->
                                <input type="email" placeholder="Email*" id="email" name="email" required autocomplete="off" class="form-control bg-transparent"/>
                                <x-input-error :messages="$errors->get('email')" class="text-danger"/>
                                <!--end::Email-->
                            </div>
                            <!--end::Input group--->

                            <!--begin::Input group-->
                            <div class="fv-row mb-3" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">    
                                        <input class="form-control bg-transparent" id="password" type="password" placeholder="Password*" name="password" autocomplete="off"/>
                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                            <i class="fas fa-eye-slash fs-2"></i><i class="fas fa-eye fs-2 d-none"></i>
                                        </span>
                                        
                                    </div>
                                    <!--end::Input wrapper-->

                                    <!--begin::Meter-->
                                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                    <!--end::Meter-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Hint-->
                                <div class="fs-7 text-muted">
                                    Gunakan minimal 8 karakter dengan huruf, angka, dan simbol.
                                </div>
                                <!--end::Hint-->
                                <x-input-error :messages="$errors->get('password')" class="text-danger" />
                            </div>
                            <!--end::Input group--->                        

                            <!--begin::Input group--->
                            <div class="fv-row mb-8 position-relative">    
                                <!--begin::Password-->
                                <input type="password" placeholder="Ulangi Password*" id="password_confirmation" name="password_confirmation" required autocomplete="off" class="form-control bg-transparent"/>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger" />
                                <!--end::Password-->
                            </div>
                            <!--end::Input group--->

                            <!--begin::Submit button-->
                            <div class="mb-10 d-flex justify-content-end">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label text-uppercase">
                                    {{ 'SIMPAN' }}</span>
                                    <!--end::Indicator label-->
                                    
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">
                                        Please wait...    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                    <!--end::Indicator progress-->        
                                </button>
                            </div>
                            <!--end::Submit button-->
                        </form>
    </div>
  </div>
</div>