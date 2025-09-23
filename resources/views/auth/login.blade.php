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

        .login-aside {
            background: url('/images/banner-login.webp') no-repeat center center;
        }

        /* Hanya untuk layar ≥ 992px (desktop) */
        @media (min-width: 992px) {
            .login-aside {
                background-size: cover;
                min-height: 100vh;
            }
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
                    <!--begin::Image-->                
                    <img 
                        class="mx-auto mb-6 d-block d-lg-none w-100px" 
                        src="{{ url('template/assets/media/logos/maskot-ghi.webp') }}" 
                        alt="Maskot Guna Hijau Inovasi"/>

                    <img 
                        class="d-none d-lg-block mx-auto w-100px mb-5 mb-lg-2" 
                        src="{{ url('template/assets/media/logos/maskot-ghi.webp') }}" 
                        alt="Maskot Guna Hijau Inovasi"/>                 
                    <!--end::Image-->

                    <!--begin::Wrapper-->
                    <div class="w-lg-500px px-10">

                         <!-- Display success message -->
                        @if(session('success'))
                            <div class="x alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" action="{{ route('login') }}">@csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-8">
                                <!--begin::Title-->
                                <h1 class="text-gray-900 fw-bolder fs-3 mb-3">
                                    {{ __('common.login') }}
                                </h1>
                                <!--end::Title-->
                        
                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">
                                    {{ __('common.please_login') }}
                                </div>
                                <!--end::Subtitle--->
                            </div>
                            <!--begin::Heading-->
                        
                            <!--begin::Input group--->
                            <div class="fv-row mb-4">
                                <!--begin::Email-->
                                <input type="email" placeholder="Email" id="email" name="email" autocomplete="off" class="form-control bg-transparent"/>
                                <x-input-error :messages="$errors->get('email')" class="text-danger"/>
                                <!--end::Email-->
                            </div>
                        
                            <!--end::Input group--->
                            <div class="fv-row mb-3 position-relative">    
                                <!--begin::Password-->
                                <input type="password" placeholder="Password" id="password" name="password" autocomplete="off" class="form-control bg-transparent"/>
                                <i class="fas fa-eye toggle-password"></i>
                                <x-input-error :messages="$errors->get('password')" class="text-danger" />
                                <!--end::Password-->
                            </div>
                            <!--end::Input group--->
                        
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-4">
                                <div></div>
                        
                                <!--begin::Link-->
                                <a href="{{ route('password.request') }}" class="link-primary">
                                    {{ __('common.forgot_password') }}
                                </a>
                                <!--end::Link-->
                            </div>
                            <!--end::Wrapper-->    

                            <!--begin::Cap-->
                            <div class="d-flex justify-content-center mb-4">
                                {!! NoCaptcha::renderJs() !!}
                                <div>
                                    {!! NoCaptcha::display() !!}
                                    <x-input-error :messages="$errors->get('g-recaptcha-response')" class="text-danger" />
                                </div>
                            </div>
                            <!--end::Cap-->

                            <!--begin::Submit button-->
                            <div class="d-grid mb-6">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label text-uppercase">
                                    {{ __('common.sign_in') }}</span>
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
                                Belum memiliki akun ?    
                                <a href="{{ route('register') }}" class="link-primary" title="" rel="">{{ __('common.sign_up') }}</a>
                            </div>
                            <!--end::Sign up-->
                        </form>
                        <!--end::Form--> 
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->       
        
                <!--begin::Footer-->  
                <div class="d-flex flex-stack px-10 mx-auto text-center">
                    <x-add-link-footer/>
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Body-->

            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 order-1 order-lg-2 login-aside">
                <div class="d-flex flex-column flex-center w-100 text-center text-white">
                    <!-- Logo (tampil di semua device) -->
                    <a href="/home" class="my-6">
                        <img alt="Logo" src="{{ url('template/assets/media/logos/logo-ghi-putih.webp') }}" 
                            class="h-50px h-lg-75px"/>
                    </a>  

                    <!-- Desktop only text -->
                    <div class="d-none d-lg-block">
                        <h1 class="fs-2qx fw-bolder mb-4 text-white px-4">
                            {{__('PT Guna Hijau Inovasi')}}
                        </h1>  
                        <h1 class="fs-2 fw-bolder mb-4 text-white px-4">
                            {{__('Manufacturing for Water, Wastewater & Energy')}}
                        </h1>  
                        <div>
                            Autonomous <span class="text-warning fw-bold">{{ __('Water Loop') }}</span> Closure<br>
                            Unlocking the Potential of Waste for Green Energy
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Authentication - Sign-in-->
        
    </div>
    <!--end::Root-->

    @push('js')
    <script src="{{ url('pages/js/auth/hidevisibility.js') }}"></script>
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