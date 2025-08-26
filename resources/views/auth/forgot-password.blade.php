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
                        <form class="form w-100" novalidate="novalidate" id="kt_password_reset_form" data-kt-redirect-url="" method="POST" action="{{ route('password.email') }}" >
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-10">
                                <!--begin::Title-->
                                <h1 class="text-gray-900 fw-bolder mb-3">
                                    {{ __('common.forgot_password') }}
                                </h1>
                                <!--end::Title-->

                                <!--begin::Link-->
                                <div class="text-gray-500 fw-semibold fs-6">
                                    {{ __('common.enter_your_email_to_reset_password') }}
                                </div>
                                <!--end::Link-->
                            </div>
                            <!--begin::Heading-->

                            <!--begin::Input group--->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" :value="old('email')" required autofocus/> 
                                <!--end::Email-->
                                <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
                            </div>

                            <!--begin::Cap-->
                            <div class="d-flex justify-content-center mb-10">
                                {!! NoCaptcha::renderJs() !!}
                                <div>
                                    {!! NoCaptcha::display() !!}
                                    <x-input-error :messages="$errors->get('g-recaptcha-response')" class="text-danger" />
                                </div>
                            </div>
                            <!--end::Cap-->
                            
                            <!--begin::Actions-->
                            <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                                <button type="submit" id="kt_password_reset_submit" class="btn btn-primary me-4">
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
                                <a href="{{ route('login') }}" class="btn btn-light">Cancel</a>
                            </div>
                            <!--end::Actions-->
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