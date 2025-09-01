<div id="kt_form_create_product">
    <form id="kt_create_product_form" class="form d-flex flex-column flex-lg-row" action="{{ route('picproduct.type.update', ['productId' => $productFind->uuid, 'typeId' => $productTypeField->id]) }}" enctype="multipart/form-data" class="form" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="product_id" value="{{ $productFind->id }}">
        <!--begin::Aside column-->
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
            <!--begin::Thumbnail settings-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>Detail Produk Utama</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="mb-7">
                        <!--begin::Title-->
                        <h5 class="mb-4">Produk Main</h5>
                        <!--end::Title-->
            
                        <!--begin::Details-->
                        <div class="mb-0">
                            <!--begin::Price-->
                            <span class="fw-semibold text-gray-600">{{$productFind->nama_produk}}</span>
                            <!--end::Price-->
                        </div>
                        <!--end::Details-->
                        <div class="separator separator-dashed mb-7"></div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Thumbnail settings-->




            
        </div>
        <!--end::Aside column-->

        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">

                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Edit Tipe Produk</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">Nama Tipe Produk</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" id="type_name" name="type_name" class="form-control mb-2"
                                        placeholder="Type Product name" value="{{$productTypeField->type_name}}" />
                                    <!--end::Input-->

                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Nama produk wajib diisi, dan sebaiknya bersifat unik.</div>
                                    <!--end::Description-->
                                    <span id="error-type-product-name" class="fv-plugins-message-container invalid-feedback"></span>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">Harga (Rp.)</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" id="harga" name="harga" class="form-control mb-2"
                                        placeholder="Harga tipe produk" value="{{$productTypeField->harga}}" />
                                    <!--end::Input-->

                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Tetapkan harga produk pada tipe ini.</div>
                                    <!--end::Description-->
                                    <span id="error-harga" class="fv-plugins-message-container invalid-feedback"></span>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                {{-- <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ __('Deskripsi Singkat') }}</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <textarea id="product-description" class="form-control mb-2" rows="3" name="description"
                                        placeholder="Deskripsi Singkat Product">{{$productTypeField->description}}</textarea>
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Tetapkan deskripsi produk untuk visibilitas yang lebih
                                        baik.
                                    </div>
                                    <!--end::Description-->
                                    <span id="error-product-description"
                                        class="fv-plugins-message-container invalid-feedback"></span>
                                </div> --}}
                                <!--end::Input group-->

                                @foreach ($spesificationColumnsField as $field)
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        @php
                                            $units = [
                                                'sotr' => '(kg/h)',
                                                'md' => '(m)',
                                                'mz' => '(m)',
                                                'd' => '(m)',
                                                'pr' => '(m3/min)',
                                                'kubikasi' => '(m3)',
                                                'kg' => '(kg)',
                                            ];
                                        
                                            // Ganti underscore dengan spasi dan ubah menjadi huruf besar
                                            $formattedField = ucwords(str_replace('_', ' ', $field));
                                        
                                            // Cek dan tambahkan satuan berdasarkan field
                                            if (in_array($field, ["floater_kubikasi", "motor_kubikasi", "floater_kg", "motor_kg"])) {
                                                if (strpos($field, 'kubikasi') !== false) {
                                                    $formattedField .= ' ' . $units['kubikasi'];
                                                } elseif (strpos($field, 'kg') !== false) {
                                                    $formattedField .= ' ' . $units['kg'];
                                                }
                                            } else {
                                                $parts = explode('_', $field);
                                                $unit = isset($units[strtolower($parts[1])]) ? ' ' . $units[strtolower($parts[1])] : '';
                                                $formattedField = isset($parts[1]) ? strtoupper($parts[1]) . $unit : $formattedField;
                                            }
                                        @endphp
                                        <label for="{{ $field }}" class="required form-label">{{ $formattedField }}</label>
                                        
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        @if ($fieldTypes[$field] != 'decimal')
                                            <input type="text" id="{{ $field }}" name="{{ $field }}" class="form-control mb-2" placeholder="Masukan nilai {{ ucwords(str_replace('_', ' ', $field)) }}" value="{{ old($field, $productTypeField->$field) }}"/>
                                        @else
                                            <input type="number" step="0.1" id="{{ $field }}" name="{{ $field }}" class="form-control mb-2" placeholder="Masukan nilai {{ ucwords(str_replace('_', ' ', $field)) }}" value="{{ old($field, $productTypeField->$field) }}"/>
                                        @endif
                                        <!--end::Input-->

                                        <span id="error-{{ $field }}" class="fv-plugins-message-container invalid-feedback"></span>
                                    </div>
                                    <!--end::Input group-->
                                @endforeach

                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::General options-->


                        {{-- <!--begin::Media-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Gambar untuk Deskripsi Product</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="fv-row mb-2">
                                    <!--begin::Dropzone-->
                                    <div class="dropzone" id="kt_modal_create_product_galery">
                                        <!--begin::Message-->
                                        <div class="dz-message needsclick align-items-center">
                                            <!--begin::Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/files/fil010.svg-->
                                            <span class="svg-icon svg-icon-3hx svg-icon-primary">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z" fill="currentColor" />
                                                    <path d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z" fill="currentColor" />
                                                    <path d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z" fill="currentColor" />
                                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <!--end::Icon-->
                                            <!--begin::Info-->
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bold text-gray-900 mb-1">{{ __('fields.click_upload_photo') }}.</h3>
                                                <span class="fw-semibold fs-7 text-gray-400">{{ __('fields.upload_3_files') }}</span>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                    </div>
                                    <!--end::Dropzone-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7">Atur galeri media produk.</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Card header-->
                            <span id="error-upload-photo" class="fv-plugins-message-container invalid-feedback"></span>
                        </div>
                        <!--end::Media-->

                        <!--begin::Deskripsi-->
                        <div class="card card-flush py-4">
                            <input type="hidden" name="desc" value="" id="descriptionContent">
                            <div id="kt_inbox_form_editor" class="bg-transparent border-0 h-350px px-3"></div>
                        </div>
                        <!--end::Deskripsi--> --}}


                    </div>
                </div>
                <!--end::Tab pane-->



            </div>
            <!--end::Tab content-->

            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                <a href="{{ route('product.index') }}" id="kt_ecommerce_add_product_cancel"
                    class="btn btn-danger me-5">
                    Batal
                </a>
                <!--end::Button-->

                <!--begin::Button-->
                <button type="submit" data-kt-product-action="submit" class="btn btn-primary" >
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
        <!--end::Main column-->

    </form>
</div>
<!--end::Form-->
