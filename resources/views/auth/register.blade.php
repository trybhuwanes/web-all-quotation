<x-guest-layout>
    @slot('title')
        {{ __('Login Guna Hijau') }}
    @endslot
    <style>
        .position-relative {
            position: relative;
        }
 
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
    
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">    
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">
                        
                        <!--begin::Form-->
                        <form class="form w-150" novalidate="novalidate" id="kt_sign_in_form" method="POST" action="{{ route('register') }}">@csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-gray-900 fw-bolder mb-3">
                                    GUNA HIJAU INOVASI
                                </h1>
                                <!--end::Title-->
                        
                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">
                                    {{ __('common.please_register_an_account') }}
                                </div>
                                <!--end::Subtitle--->
                            </div>
                            <!--begin::Heading-->
                        
                            <!--begin::Separator-->
                            <div class="separator separator-content my-10">
                            </div>
                            <!--end::Separator-->

                            <!--begin::Input group--->
                            <div class="fv-row mb-3">
                                <!--begin::Nama-->
                                <input type="text" placeholder="Nama Lengkap" id="name" name="name" required autocomplete="off" class="form-control bg-transparent"/>
                                <x-input-error :messages="$errors->get('name')" class="text-danger"/>
                                <!--end::Nama-->
                            </div>
                            <!--end::Input group--->

                            <!--begin::Input group--->
                            <div class="fv-row mb-3">
                                <!--begin::Telpon-->
                                <input type="number" placeholder="Nomer Telpon" id="phone" name="phone" required autocomplete="off" class="form-control bg-transparent"/>
                                <x-input-error :messages="$errors->get('phone')" class="text-danger"/>
                                <!--end::Telpon-->
                            </div>
                            <!--end::Input group--->

                            <!--begin::Input group--->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <!--begin::Col-->
                                <div class="col-xl-6 mt-1">              
                                <!--begin::Telpon-->
                                <input class="form-control bg-transparent" type="text" placeholder="Jabatan" name="job_title" autocomplete="off" data-kt-translate="sign-up-input-first-name"/>
                                <x-input-error :messages="$errors->get('job_title')" class="text-danger"/>
                                <!--end::Telpon-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-6 mt-1">              
                                    <input class="form-control bg-transparent" type="text" placeholder="Asal Institusi (PT/CV)" name="company" autocomplete="off" data-kt-translate="sign-up-input-first-name"/>
                                    <x-input-error :messages="$errors->get('company')" class="text-danger"/>
                                </div>
                                <!--end::Col-->
                            </div>


                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <!-- Select Provinsi -->
                                <div class="col-xl-6 mt-1">              
                                    <select name="location_company" id="lokasi_institusi" data-control="select2" data-placeholder="Pilih provinsi..." class="form-select form-select-solid provinsi">
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
                                </div>

                                <!-- Select Kota -->
                                <div class="col-xl-6 mt-1">
                                    <select name="location_city" id="kota" data-control="select2" data-placeholder="Pilih kota..." class="form-select form-select-solid kota">
                                        <option value="">Pilih kota...</option>
                                    </select>
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <!--begin::Col-->
                                <div class="col-xl-6 mt-1">              
                                    {{-- <input class="form-control bg-transparent" type="text" placeholder="Bidang Institusi" name="field_company" autocomplete="off" data-kt-translate="sign-up-input-first-name"/> --}}
                                    <!--begin::Select-->
                                    <select name="field_company" id="bidang_institusi" data-control="select2" data-placeholder="Pilih bidang..." class="form-select form-select-solid">
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
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-xl-6 mt-1">            
                                    <input class="form-control bg-transparent" type="text" placeholder="Detail Institusi" name="detail_company" autocomplete="off" data-kt-translate="sign-up-input-last-name"/>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        
                            <!--begin::Input group--->
                            <div class="fv-row mb-3">
                                <!--begin::Email-->
                                <input type="email" placeholder="Email" id="email" name="email" required autocomplete="off" class="form-control bg-transparent"/>
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
                                        <input class="form-control bg-transparent" id="password" type="password" placeholder="Password" name="password" autocomplete="off"/>
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
                                <input type="password" placeholder="Ulangi Password" id="password_confirmation" name="password_confirmation" required autocomplete="off" class="form-control bg-transparent"/>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger" />
                                <!--end::Password-->
                            </div>
                            <!--end::Input group--->

                            <!--begin::Accept-->
                            <div class="fv-row mb-8">
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="terms"/>
                                    <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">
                                        {{ __('common.i_accept_the_terms') }}
                                    </span>
                                    <x-input-error :messages="$errors->get('terms')" class="text-danger" />
                                </label>
                            </div>
                            <!--end::Accept-->

                            <!--begin::Cap-->
                            <div class="d-flex justify-content-center mb-10">
                                {!! NoCaptcha::renderJs() !!}
                                <div>
                                    {!! NoCaptcha::display() !!}
                                    <x-input-error :messages="$errors->get('g-recaptcha-response')" class="text-danger" />
                                </div>
                            </div>
                            <!--end::Cap-->

                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label text-uppercase">
                                    {{ __('common.sign_up') }}</span>
                                    <!--end::Indicator label-->
                                    
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">
                                        Please wait...    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                    <!--end::Indicator progress-->        
                                </button>
                            </div>
                            <!--end::Submit button-->
                        
                            <!--begin::Sign up-->
                            <div class="text-gray-500 text-center fw-semibold fs-6">
                                {{ __('common.already_have_an_account') }}
                                <a href="{{ route('login') }}" class="link-primary" title="" rel="">{{ __('common.sign_in') }}</a>
                            </div>
                            <!--end::Sign up-->
                        </form>
                        <!--end::Form--> 
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->       
        
                <!--begin::Footer-->  
                <div class="w-lg-500px d-flex flex-stack px-10 mx-auto">
                    <x-add-link-footer/>
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Body-->
            
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(/template/assets/media/misc/auth-bg.png)">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">          
                    <!--begin::Logo-->
                    <a href="/home" class="mb-0 mb-lg-12">
                        <img alt="Logo" src="{{ url('template/assets/media/logos/logo-ghi.webp') }}" class="h-60px h-lg-75px"/>
                    </a>    
                    <!--end::Logo-->
        
                    <!--begin::Image-->                
                    <img class="d-none d-lg-block mx-auto w-75px w-md-50 w-xl-250px mb-10 mb-lg-20" src="{{ url('template/assets/media/logos/maskot-grinviro.webp') }}" alt="maskot grinviro"/>                 
                    <!--end::Image-->
        
                    <!--begin::Title-->
                    <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7"> 
                        {{__('Manufacturing for Water, Wastewater & Energy')}}
                    </h1>  
                    <!--end::Title-->
        
                    <!--begin::Text-->
                    <div class="d-none d-lg-block text-white fs-base text-center">
                        Autonomous <a href="#" class="opacity-75-hover text-warning fw-bold me-1" title="" rel="">{{ __('Water Loop') }}</a>Closure<br>
                        Unlocking the Potential of Waste for Green Energy
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Authentication - Sign-in-->
        
    </div>
    <!--end::Root-->

    @push('js')
    <script src="{{ url('pages/js/auth/register.js') }}"> </script>
    <script src="{{ url('pages/js/auth/provinsi.js') }}"> </script>
    @endpush
</x-guest-layout>