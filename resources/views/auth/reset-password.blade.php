<x-guest-layout>
    @slot('title')
        {{ __('Lupa Password Guna Hijau') }}
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

                         <!-- Display success message -->
                        @if(session('success'))
                            <div class="x alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_new_password_form" data-kt-redirect-url="" method="POST" action="{{ route('password.store') }}">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-10">
                                <!--begin::Title-->
                                <h1 class="text-gray-900 fw-bolder mb-3">
                                    {{__('Siapkan Kata Sandi Baru')}}
                                </h1>
                                <!--end::Title-->

                                <!--begin::Link-->
                                <div class="text-gray-500 fw-semibold fs-6">
                                    {{__('Apakah Anda sudah mengatur ulang kata sandi?')}}

                                    <a href="{{ route('login') }}" class="link-primary fw-bold">
                                        {{__('Login')}}
                                    </a>
                                </div>
                                <!--end::Link-->
                            </div>
                            <!--begin::Heading-->
                            
                            <!--begin::Input group--->
                            <div class="fv-row mb-3">
                                <!--begin::Email-->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                <input type="email" placeholder="Email" id="email" name="email" required autocomplete="off" class="form-control bg-transparent" value="{{ old('email', $request->email) }}" readonly/>
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
                                        <input class="form-control bg-transparent" id="password" type="password" placeholder="New Password" name="password" autocomplete="off"/>
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
                                <input type="password" placeholder="Repeat Password" id="password_confirmation" name="password_confirmation" required autocomplete="off" class="form-control bg-transparent"/>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger" />
                                <!--end::Password-->
                            </div>
                            <!--end::Input group--->

                            <!--begin::Input group--->
                            <div class="fv-row mb-8">
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="terms" value="1"/>
                                    <span class="form-check-label fw-semibold text-gray-700 fs-6 ms-1">
                                        {{__('Setuju')}}
                                    </span>
                                </label>
                            </div>
                            <!--end::Input group--->

                            <!--begin::Action-->
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_new_password_submit" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">
                                        Submit</span>
                                    <!--end::Indicator label-->

                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">
                                        Please wait...    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                    <!--end::Indicator progress-->
                                </button>
                            </div>
                            <!--end::Action-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->       
        
                <!--begin::Footer-->  
                <div class="w-lg-500px d-flex flex-stack px-10 mx-auto">
                    <!--begin::Footer-->  
                        <div class="w-lg-500px d-flex flex-stack px-10 mx-auto">
                            <x-add-link-footer/>
                        </div>
                    <!--end::Footer-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Body-->
            
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(/template/assets/media/misc/auth-bg.png)">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">          
                    <!--begin::Logo-->
                    <a href="/metronic8/demo1/index.html" class="mb-0 mb-lg-12">
                        <img alt="Logo" src="{{ url('template/assets/media/logos/logo-ghi.webp') }}" class="h-60px h-lg-75px"/>
                    </a>    
                    <!--end::Logo-->
        
                    <!--begin::Image-->                
                    <img class="d-none d-lg-block mx-auto w-75px w-md-50 w-xl-250px mb-10 mb-lg-20" src="{{ url('template/assets/media/logos/maskot-grinviro.webp') }}" alt="maskot grinviro"/>                 
                    <!--end::Image-->
        
                    <!--begin::Title-->
                    <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7"> 
                        {{__('Water & Wastewater Equipment Provider')}}
                    </h1>  
                    <!--end::Title-->
        
                    <!--begin::Text-->
                    <div class="d-none d-lg-block text-white fs-base text-center">
                        Autonomous <a href="" class="opacity-75-hover text-warning fw-bold me-1" title="" rel="">{{ __('Water Loop') }}</a>Closure<br>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.querySelector('.x');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 3000);
            }
        });
    </script>
    @endpush

   </x-guest-layout>