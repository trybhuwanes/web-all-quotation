<x-auth-layout>
    @slot('title')
    {{ __('Dashboard') }}
    @endslot
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            

<!--begin::Contact-->
<div class="card ">     
    
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Heading-->
            <div class="card-px text-center pt-10 pb-10">
                <!--begin::Title-->
                <h2 class="fs-2x fw-bold mb-0">Versi 1.0</h2>
                <!--end::Title-->

                <!--begin::Description-->
                <p class="text-gray-500 fs-4 fw-semibold py-7">
                    Term & Privasi</p>
                <!--end::Description-->

                <!--begin::Action-->
                <a href="mailto:webmaster@grinvirobiotekno.com" class="btn btn-primary er fs-6 px-8 py-4"> 
                    Support System
                </a>
                <!--end::Action-->
            </div>
            <!--end::Heading-->

            {{-- <!--begin::Illustration-->
            <div class="text-center pb-15 px-5">
                <img src="/template/assets/media/illustrations/sketchy-1/9.png" alt="" class="mw-100 h-200px h-sm-325px"/>          
            </div>
            <!--end::Illustration--> --}}
        

            <!--begin::Row-->
            <div class="row g-5 mb-5 mb-lg-15 ">     
                <!--begin::Col-->
                <div class="col-sm-6 pe-lg-10">
                    <!--begin::Phone-->
                    <div class="bg-light card-rounded d-flex flex-column flex-center flex-center p-10 h-100">     
                        <!--begin::Icon-->
                        <i class="fa-solid fa-phone fs-3tx text-primary"><span class="path1"></span><span class="path2"></span></i>            <!--end::Icon-->

                        <!--begin::Subtitle-->
                        <h1 class="text-gray-900 fw-bold my-5">
                            Call Us
                        </h1>
                        <!--end::Subtitle-->

                        <!--begin::Number-->
                        <div class="text-gray-700 fw-semibold fs-2">
                            +6282348114479
                        </div>
                        <!--end::Number-->
                    </div>
                    <!--end::Phone--> 
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-sm-6 ps-lg-10">
                    <!--begin::Address-->
                    <div class="text-center bg-light card-rounded d-flex flex-column flex-center p-10 h-100">     
                        <!--begin::Icon-->
                        <i class="fa-solid fa-location-dot fs-3tx text-primary"><span class="path1"></span><span class="path2"></span>
                        </i><!--end::Icon-->

                        <!--begin::Subtitle-->
                        <h1 class="text-gray-900 fw-bold my-5">
                            Our Head Office
                        </h1>
                        <!--end::Subtitle-->

                        <!--begin::Description-->
                        <div class="text-gray-700 fs-3 fw-semibold">
                            Pergudangan Kosambi II Blok A9 No.11, Tangerang
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Address--> 
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Card body-->
</div>
<!--end::Card--> 

        <!--begin::Card-->
        <div class="card mb-4 bg-light text-center ">
            <!--begin::Body-->
            <div class="card-body py-6">
                <!--begin::Icon-->
                <a href="https://web.facebook.com/people/Grinviro-Biotekno-Indonesia/61550863517313" class="mx-4">
                    <img src="/template/assets/media/svg/brand-logos/facebook-4.svg" class="h-30px my-2" alt=""/>  
                </a>
                <!--end::Icon-->  

                <!--begin::Icon-->
                <a href="https://www.instagram.com/grinvirobiotekno" class="mx-4">
                    <img src="/template/assets/media/svg/brand-logos/instagram-2-1.svg" class="h-30px my-2" alt=""/>  
                </a>
                <!--end::Icon-->  

                <!--begin::Icon-->
                <a href="https://www.tiktok.com/@grinvirobiotekno" class="mx-4">
                    <img src="/template/assets/media/svg/social-logos/tiktok.svg" class="h-30px my-2" alt=""/>  
                </a>
                <!--end::Icon-->  

                <!--begin::Icon-->
                <a href="https://www.youtube.com/channel/UCk2Wqi_IPMj1eo_c9JYDbNg/videos" class="mx-4">
                    <img src="/template/assets/media/svg/social-logos/youtube.svg" class="h-30px my-2" alt=""/>  
                </a>
                <!--end::Icon-->  

                <!--begin::Icon-->
                <a href="https://www.linkedin.com/company/pt-grinviro-biotekno-indonesia-grinviro-group?trk=similar-pages" class="mx-4">
                    <img src="/template/assets/media/svg/social-logos/linkedin.svg" class="h-30px my-2" alt=""/>  
                </a>
                <!--end::Icon-->                
            </div>
            <!--end::Body-->     
        </div>
        <!--end::Card-->       

        </div>
        <!--end::Contact-->
</div>
<!--end::Content wrapper-->
        
    </div>
    <!--end:::Main-->
    
</x-auth-layout>