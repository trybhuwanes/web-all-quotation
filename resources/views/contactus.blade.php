<x-guest-layout>
    <!--begin::Header-->
    @include('layouts.guest.header')
    <!--end::Header-->

    <section class="bg-light">
        <div class="position-relative overflow-hidden">

            <div
                class="app-container container-xxl position-relative d-flex align-items-center flex-wrap pt-lg-18 pt-10 pb-20">

                <div class="d-flex flex-column flex-grow-1 me-5">

                    <h3 class="fs-2x fs-lg-3x text-gray-900 fw-bolder">
                        {{__('Mari Berdiskusi')}}
                    </h3>
                    <a href="https://web.whatsapp.com/send?phone=6282348114479&text=Halo!" class="text-primary fs-2 fw-bold">
                        {{__('+6282348114479')}}
                    </a>
                    <a href="mailto:gunahijauinovasi2024@gmail.com" class="text-primary fs-2 fw-bold">
                        {{__('gunahijauinovasi2024@gmail.com')}}
                    </a>
                </div>



                <div class="text-lg-end py-lg-0 py-5">
                    <h3 class="fs-3 text-dark fw-bold">{{__('Guna Hijau Inovasi')}}</h3>
                    <span class="d-block fs-5 text-gray-700 fw-semibold pt-1">
                        Prominence Office Tower Level 28 Unit C,<br/>Jl. Jalur Sutera Barat No.15, Tangerang
                    </span>
                </div>

            </div>

        </div>
    </section>

    <!--begin::Content container-->
    <div id="kt_app_content_container"
        class="app-container  container-xxl app-container container-xxl pt-10 mb-5 mb-lg-10">
        <!--begin::About card-->
        <div class="card bg-body border shadow-sm rounded-4 px-lg-18 pt-lg-15 pb-lg-16 p-5 mb-10">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6">

                    <div>
                        <h3 class="text-dark fw-bold fs-2x">Butuh Bantuan untuk Proyek Anda ? </h3>
                        <p class="text-gray-600 fw-semibold fs-5 d-block pt-3 pb-10 m-0">
                            Hubungi kami, dan tim kami yang terdiri dari individu-individu yang sangat terampil
                            dalam teknologi ini akan segera menghubungi Anda.
                        </p>

                    </div>


                    <div>

                        <div class="d-flex gap-5 text-gray-600 fw-bold fs-5">

                            <div class="">

                                <div class="d-flex align-items-center pb-4 gap-2">
                                    <i class="ki-duotone ki-arrow-right text-muted fs-5"><span
                                            class="path1"></span><span class="path2"></span></i>

                                    <span class="">Equipment</span>
                                </div>


                                <div class="d-flex align-items-center pb-4 gap-2">
                                    <i class="ki-duotone ki-arrow-right text-muted fs-5"><span
                                            class="path1"></span><span class="path2"></span></i>
                                    <span class="">Chemical Dosing</span>
                                </div>


                                <div class="d-flex align-items-center pb-4 gap-2">
                                    <i class="ki-duotone ki-arrow-right text-muted fs-5"><span
                                            class="path1"></span><span class="path2"></span></i>

                                    <span class="">Tank</span>
                                </div>



                                <div class="d-flex align-items-center pb-4 gap-2">
                                    <i class="ki-duotone ki-arrow-right text-muted fs-5"><span
                                            class="path1"></span><span class="path2"></span></i>

                                    <span class="">Interconnection</span>
                                </div>
                            </div>


                            <div>

                                <div class="d-flex align-items-center pb-4 gap-2">
                                    <i class="ki-duotone ki-arrow-right text-muted fs-5"><span
                                            class="path1"></span><span class="path2"></span></i>

                                    <span class="">Civil and Structural Works</span>
                                </div>


                                <div class="d-flex align-items-center pb-4 gap-2">
                                    <i class="ki-duotone ki-arrow-right text-muted fs-5"><span
                                            class="path1"></span><span class="path2"></span></i>

                                    <span class="">Testing and Commisioning</span>
                                </div>


                                <div class="d-flex align-items-center pb-4 gap-2">
                                    <i class="ki-duotone ki-arrow-right text-muted fs-5"><span
                                            class="path1"></span><span class="path2"></span></i>
                                    <span class="">Document</span>
                                </div>


                                <div class="d-flex align-items-center pb-4 gap-2">
                                    <span class="text-muted fw-semibold fs-6 ms-2">And many more..</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-10 pb-lg-0 pb-8">

                            <h3 class="text-dark fw-bold fs-2x">{{__(('Mari Cek "Project References" Kami'))}}</h3a>
                                <p class="text-gray-600 fw-semibold fs-5 d-block pt-5">
                                    Sejak tahun 2015, kami telah membantu banyak perusahaan dan lembaga pemerintah di bidang Water, Waste, Air, and Energy.
                                    Silahkan mengisi form untuk mendapatkan informasi lebih detail terkait proyek kami yang telah berjalan.
                                </p>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    @if (session('success'))
                        <div class="x alert alert-success text-center">
                            <h4>{{ session('success') }}</h4>
                        </div>
                    @else
                        <form method="POST" action="{{ route('contact-us-send') }}" class="form form-input pt-3" id="page_hire_form">
                            @csrf
                            <div class="form-group pb-1">
                                <input type="text" name="name" value="" class="form-control from-control-custom" placeholder="Nama">
                                <x-input-error :messages="$errors->get('name')" class="text-danger" />
                            </div>

                            <div class="form-group pb-1">
                                <input type="email" name="email" value="" class="form-control from-control-custom" placeholder="Email">
                                <x-input-error :messages="$errors->get('email')" class="text-danger" />
                            </div>

                            <div class="form-group pb-1">
                                <input type="text" name="phone" class="form-control from-control-custom" placeholder="No. Telpon">
                                <x-input-error :messages="$errors->get('phone')" class="text-danger" />
                            </div>

                            <div class="form-group pb-1">
                                <textarea name="description" class="form-control from-control-custom min-h-150px" id="exampleTextarea"
                                    placeholder="Pesan"></textarea>
                                <x-input-error :messages="$errors->get('description')" class="text-danger" />
                            </div>

                            <!--begin::Captcha-->
                            <div class="form-group">
                                <div id="hire_captcha_container">
                                    {!! NoCaptcha::renderJs() !!}
                                    <div>
                                        {!! NoCaptcha::display() !!}
                                        <x-input-error :messages="$errors->get('g-recaptcha-response')" class="text-danger" />
                                    </div>
                                </div>
                            </div>
                            <!--end::Captcha-->

                            <button id="page_hire_form_submit_btn" type="submit" class="btn btn-ghi fw-bold fs-2"
                                data-kt-action="submit">
                                <!--begin::Indicator-->
                                <span class="indicator-label">
                                    Kirim
                                </span>
                                <span class="indicator-progress">
                                    Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                                <!--end::Indicator-->
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="app-container container-xxl pt-10 mb-5 mb-lg-10">
        <div class="card border-0 rounded-3 px-10 px-lg-20 pt-10 pt-lg-15 pb-5 pb-lg-10"
            style="background-color:#F5F8FA;">

            <h1 class="text-center text-dark lh-lg fw-bold fs-2hx fs-lg-15 mb-5 mb-lg-15">
                {{__('Frequently Asked Questions')}}
            </h1>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-15  me-lg-15 ">

                        <a href="#general"></a>
                        <h2 class="fw-bold text-dark fs-4 mb-8" id="general">{{__('General')}}</h2>
                        <div class="accordion" id="general-posts">

                            <div class="mb-5" id="general66e0fe3a8b99f">

                                <a class="d-flex toggle collapsible collapsed pb-2"
                                    href="#what-are-included-in-the-purchased-package" data-bs-toggle="collapse"
                                    data-bs-target="#what-are-included-in-the-purchased-package-collapse">
                                    <div class="accordion-icon">

                                        <div class="toggle-off">
                                            <x-icons.minus />
                                        </div>
                                        <div class="toggle-on">
                                            <x-icons.plus />
                                        </div>

                                    </div>
                                    <h3 class="ps-3 fw-semibold fs-5 m-0">
                                        Apa itu Guna Hijau Inovasi?
                                    </h3>
                                </a>
                                <div id="what-are-included-in-the-purchased-package-collapse"
                                    class="collapse fw-semibold text-gray-700 ps-9 pb-3 fs-6"
                                    data-bs-parent="#general-posts">
                                    <p>Guna Hijau Inovasi merupakan perusahaan manufaktur peralatan pengolahan air dan air limbah yang merupakan salah satu anak perusahaan dari Grinviro Global.</p>
                                </div>
                            </div>

                            <div class="mb-5" id="general66e0fe3a8bbew">
                                <a class="d-flex toggle collapsible collapsed pb-2"
                                    href="#general-title-uniques-id"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#general-title-uniques-id-collapse">
                                    <div class="accordion-icon">
                                        <div class="toggle-off">
                                            <x-icons.minus />
                                        </div>
                                        <div class="toggle-on">
                                            <x-icons.plus />
                                        </div>
                                    </div>
                                    <h3 class="ps-3 fw-semibold fs-5 m-0">
                                        Apa perbedaan Guna Hijau Inovasi dengan perusahaan lainnya?
                                    </h3>
                                </a>
                                <div id="general-title-uniques-id-collapse"
                                    class="collapse fw-semibold text-gray-700 ps-9 pb-3 fs-6"
                                    data-bs-parent="#general-posts">
                                    <p>Produk kami memiliki standar High Technology sesuai dengan proses Research & Development yang dilakukan secara mendetail oleh tim internal. Setiap produk yang dikirimkan juga dilakukan Testing proses dan hasil sebelum dikirimkan kepada client.
                                    </p>
                                </div>
                            </div>

                            <div class="mb-5" id="general66e0fe3a8bded">

                                <a class="d-flex toggle collapsible collapsed pb-2"
                                    href="#what-are-the-minimal-requirements-to-use-admin-themes"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#what-are-the-minimal-requirements-to-use-admin-themes-collapse">
                                    <div class="accordion-icon">
                                        <div class="toggle-off">
                                            <x-icons.minus />
                                        </div>
                                        <div class="toggle-on">
                                            <x-icons.plus />
                                        </div>
                                    </div>
                                    <h3 class="ps-3 fw-semibold fs-5 m-0">
                                        Apakah Guna Hijau Inovasi melayani pengiriman ke seluruh Indonesia?
                                    </h3>
                                </a>

                                <div id="what-are-the-minimal-requirements-to-use-admin-themes-collapse"
                                    class="collapse fw-semibold text-gray-700 ps-9 pb-3 fs-6"
                                    data-bs-parent="#general-posts">
                                    <p>Ya, kami melayani pengiriman ke seluruh wilayah Indonesia.</p>
                                </div>

                            </div>

                            <div class="mb-5" id="general66e0fe3a8bweb">
                                <a class="d-flex toggle collapsible collapsed pb-2"
                                    href="#general-title-unique-id"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#general-title-unique-id-collapse">
                                    <div class="accordion-icon">
                                        <div class="toggle-off">
                                            <x-icons.minus />
                                        </div>
                                        <div class="toggle-on">
                                            <x-icons.plus />
                                        </div>
                                    </div>
                                    <h3 class="ps-3 fw-semibold fs-5 m-0">
                                        Apakah Guna Hijau Inovasi melayani konsultasi untuk custom inquiry?
                                    </h3>
                                </a>
                                <div id="general-title-unique-id-collapse"
                                    class="collapse fw-semibold text-gray-700 ps-9 pb-3 fs-6"
                                    data-bs-parent="#general-posts">
                                    <p>Ya, kami menyediakan layanan konsultasi untuk membantu pelanggan menentukan solusi dan produk terbaik sesuai kebutuhan.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-15 ">

                        <a href="#payment"></a>
                        <h2 class="fw-bold text-dark fs-4 mb-8" id="payment">Order & Payment</h2>
                        <div class="accordion" id="payment-posts">

                            <div class="mb-5" id="payment66e0fe3a8c032">

                                <a class="d-flex toggle collapsible collapsed pb-2"
                                    href="#what-are-the-available-payment-options" data-bs-toggle="collapse"
                                    data-bs-target="#what-are-the-available-payment-options-collapse">
                                    <div class="accordion-icon">
                                        <div class="toggle-off">
                                            <x-icons.minus />
                                        </div>
                                        <div class="toggle-on">
                                            <x-icons.plus />
                                        </div>
                                    </div>
                                    <h3 class="ps-3 fw-semibold fs-5 m-0">
                                        Bagaimana cara melakukan pemesanan ?
                                    </h3>

                                </a>



                                <div id="what-are-the-available-payment-options-collapse"
                                    class="collapse fw-semibold text-gray-700 ps-9 pb-3 fs-6"
                                    data-bs-parent="#payment-posts">
                                    <p>Ikuti langkah-langkah berikut:</p>
                                    <ul>
                                        <li>Telusuri katalog produk yang sesuai dengan kebutuhan Anda.</li>
                                        <li>Pilih Produk</li>
                                        <li>Masuk ke akun anda</li>  
                                        <li>Klik Bagian "Produk"</li>
                                        <li>Pilih produk yang ingin dibeli</li>
                                        <li>Klik "Beli Sekarang", lalu pilih type produk yang dipilih.</li>
                                        <li>Klik "Masukkan Keranjang"</li>
                                        <li>Pilih Additional Produk yang dapat disesuaikan dengan kebutuhan.</li>
                                        <li>Klik "Shipping to Onsite", pilih provinsi dan alamat pengiriman produk</li>
                                        <li>Klik "Buat Pesanan", kemudian klik "Yes, Proses"</li>
                                        <li>Tunggu Konfirmasi dari Tim Technical yang akan menghubungi Anda.</li>
                                    </ul>
                                </div>

                            </div>

                            <div class="mb-5" id="payment66e0fe3a8c247">
                                <a class="d-flex toggle collapsible collapsed pb-2" href="#will-i-receive-an-invoice"
                                    data-bs-toggle="collapse" data-bs-target="#will-i-receive-an-invoice-collapse">
                                    <div class="accordion-icon">
                                        <div class="toggle-off">
                                            <x-icons.minus />
                                        </div>
                                        <div class="toggle-on">
                                            <x-icons.plus />
                                        </div>
                                    </div>
                                    <h3 class="ps-3 fw-semibold fs-5 m-0">
                                        Kenapa saya tidak bisa melakukan pemesanan?
                                    </h3>
                                </a>

                                <div id="will-i-receive-an-invoice-collapse"
                                    class="collapse fw-semibold text-gray-700 ps-9 pb-3 fs-6"
                                    data-bs-parent="#payment-posts">
                                    <p>Hal ini disebabkan karena akun Anda memiliki pemesanan sebelumnya yang masih dalam proses. Setiap akun hanya dapat melakukan pemesanan baru jika tidak ada pemesanan lain yang sedang diproses.</p>
                                </div>
                            </div>

                            <div class="mb-5" id="payment66e0fe3a8c248">
                                <a class="d-flex toggle collapsible collapsed pb-2" href="#will-i-receive"
                                    data-bs-toggle="collapse" data-bs-target="#will-i-receive-collapse">
                                    <div class="accordion-icon">
                                        <div class="toggle-off">
                                            <x-icons.minus />
                                        </div>
                                        <div class="toggle-on">
                                            <x-icons.plus />
                                        </div>
                                    </div>
                                    <h3 class="ps-3 fw-semibold fs-5 m-0">
                                        Apakah pemesanan langsung dikirim?
                                    </h3>
                                </a>

                                <div id="will-i-receive-collapse"
                                    class="collapse fw-semibold text-gray-700 ps-9 pb-3 fs-6"
                                    data-bs-parent="#payment-posts">
                                    <p>Tidak, kami akan menghubungi Anda untuk melakukan konfirmasi dan proses penawaran jika diperlukan. Jika terdapat kendala atau Anda membutuhkan informasi lebih lanjut, silakan hubungi kami melalui kontak yang tersedia.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-15  me-lg-15 ">
                        <a href="#support"></a>
                        <h2 class="fw-bold text-dark fs-4 mb-8" id="support">Account Management</h2>

                        <div class="accordion" id="support-posts">

                            <div class="mb-5" id="support66e0fe3a8c733">
                                <a class="d-flex toggle collapsible collapsed pb-2"
                                    href="#what-is-not-covered-by-your-support" data-bs-toggle="collapse"
                                    data-bs-target="#what-is-not-covered-by-your-support-collapse">
                                    <div class="accordion-icon">
                                        <div class="toggle-off">
                                            <x-icons.minus />
                                        </div>
                                        <div class="toggle-on">
                                            <x-icons.plus />
                                        </div>
                                    </div>
                                    <h3 class="ps-3 fw-semibold fs-5 m-0">
                                        Bagaimana cara daftar atau buat akun baru di Guna Hijau Inovasi?
                                    </h3>

                                </a>
                                <div id="what-is-not-covered-by-your-support-collapse"
                                    class="collapse fw-semibold text-gray-700 ps-9 pb-3 fs-6"
                                    data-bs-parent="#support-posts">
                                    <p>Ikuti langkah-langkah berikut untuk daftar atau buat akun baru:</p>
                                    <ul>
                                        <li>Mulai registrasi dengan klik “Daftar”. atau buka link berikut https://gunahijauinovasi.com/register</li>
                                        <li>Lengkapi detail akun anda</li>
                                        <li>Email: Masukkan alamat email Anda.</li>
                                        <li>Kata Sandi: Pilih kata sandi yang kuat untuk melindungi akun Anda.</li>
                                        <li>Lengkapi detail Instansi/Perusahaan anda</li>
                                        <li>Masukan data Instansi/Perusahaan dengan lengkap.</li>
                                        <li>Setelah lengkap, lalu klik “Daftar”.</li>
                                    </ul>
                                    <p>Note: Saat anda mendaftarkan akun, Akunnya akan menunggu konfirmasi dan diaktifkan oleh tim Guna Hijau Inovasi</p>
                                </div>

                            </div>

                            <div class="mb-5" id="support66e0fe3a8c935">
                                <a class="d-flex toggle collapsible collapsed pb-2"
                                    href="#what-kind-of-support-is-available" data-bs-toggle="collapse"
                                    data-bs-target="#what-kind-of-support-is-available-collapse">
                                    <div class="accordion-icon">
                                        <div class="toggle-off">
                                            <x-icons.minus />
                                        </div>
                                        <div class="toggle-on">
                                            <x-icons.plus />
                                        </div>
                                    </div>

                                    <h3 class="ps-3 fw-semibold fs-5 m-0">
                                        Kapan akun baru dapat digunakan login, serta dapat untuk melakukan pemesanan?
                                    </h3>
                                </a>

                                <div id="what-kind-of-support-is-available-collapse"
                                    class="collapse fw-semibold text-gray-700 ps-9 pb-3 fs-6"
                                    data-bs-parent="#support-posts">
                                    <p>Akun baru dapat digunakan untuk melakukan pemesanan atau login setelah akun tersebut diaktifkan dan data yang dimasukkan telah diverifikasi oleh tim kami. Pastikan data yang Anda berikan sesuai dengan informasi perusahaan Anda.
                                        Untuk mempercepat proses aktivasi, Anda dapat menghubungi kami melalui email di: <strong>info@gunahijauinovasi.com</strong>
                                    </p>
                                </div>

                            </div>

                            <div class="mb-5" id="support66e0fe3a8c4c1">
                                <a class="d-flex toggle collapsible collapsed pb-2"
                                    href="#how-long-is-support-valid-for" data-bs-toggle="collapse"
                                    data-bs-target="#how-long-is-support-valid-for-collapse">
                                    <div class="accordion-icon">
                                        <div class="toggle-off">
                                            <x-icons.minus />
                                        </div>
                                        <div class="toggle-on">
                                            <x-icons.plus />
                                        </div>
                                    </div>
                                    <h3 class="ps-3 fw-semibold fs-5 m-0">
                                        Bagaimana cara masuk akun guna hijau inovasi?
                                    </h3>
                                </a>
                                <div id="how-long-is-support-valid-for-collapse"
                                    class="collapse fw-semibold text-gray-700 ps-9 pb-3 fs-6"
                                    data-bs-parent="#support-posts">
                                    <p>Ikuti langkah-langkah berikut untuk masuk atau login ke akun Blibli kamu:</p>
                                    <ul>
                                        <li>Buka website Guna Hijau Inovasi di www.gunahijauinovasi.com atau https://gunahijauinovasi.com/</li>
                                        <li>Pilih “Masuk“. Dibagian atas Navbar</li>
                                        <li>Masukkan alamat email anda, serta kata sandi yang telah terdaftar di Guna Hijau Inovasi, lalu klik “Masuk“.</li>
                                    </ul>
                                </div>

                            </div>
                            
                            <div class="mb-5" id="support66e0fe3a8c1O1">
                                <a class="d-flex toggle collapsible collapsed pb-2"
                                    href="#support-valid" data-bs-toggle="collapse"
                                    data-bs-target="#support-valid-collapse">
                                    <div class="accordion-icon">
                                        <div class="toggle-off">
                                            <x-icons.minus />
                                        </div>
                                        <div class="toggle-on">
                                            <x-icons.plus />
                                        </div>
                                    </div>
                                    <h3 class="ps-3 fw-semibold fs-5 m-0">
                                        Saya lupa kata sandi akun saya. Bagaimana cara membuat kata sandi baru?
                                    </h3>
                                </a>
                                <div id="support-valid-collapse"
                                    class="collapse fw-semibold text-gray-700 ps-9 pb-3 fs-6"
                                    data-bs-parent="#support-posts">
                                    <p>Ikuti langkah-langkah berikut untuk membuat kata sandi atau password baru:</p>
                                    <ul>
                                        <li>Klik “Lupa Kata Sandi?” di halaman Masuk.</li>
                                        <li>Masukkan email akun anda yang terdaftar, pastikan email masih aktif.</li>
                                        <li>Silakan chek pesan email, lalu klik link yang dikirim melalui email anda.</li>
                                        <li>Selanjutnya diarahkan pada halaman baru, dan masukkan password baru untuk akun anda.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-15 ">

                        <a href="#license"></a>
                        <h2 class="fw-bold text-dark fs-4 mb-8" id="license">Product</h2>
                        <div class="accordion" id="license-posts">
                            <div class="mb-5" id="license66e0fe3a8cbd4">
                                <a class="d-flex toggle collapsible collapsed pb-2"
                                    href="#how-long-are-licenses-valid-for" data-bs-toggle="collapse"
                                    data-bs-target="#how-long-are-licenses-valid-for-collapse">
                                    <div class="accordion-icon">
                                        <div class="toggle-off">
                                            <x-icons.minus />
                                        </div>
                                        <div class="toggle-on">
                                            <x-icons.plus />
                                        </div>
                                    </div>
                                    <h3 class="ps-3 fw-semibold fs-5 m-0">
                                        Produk apa saja yang ditawarkan oleh Guna Hijau Inovasi?
                                    </h3>
                                </a>

                                <div id="how-long-are-licenses-valid-for-collapse"
                                    class="collapse fw-semibold text-gray-700 ps-9 pb-3 fs-6"
                                    data-bs-parent="#license-posts">
                                    <p>Kami menawarkan berbagai produk peralatan untuk pengolahan air dan air limbah, termasuk FLOWREX Surface Aerator, FLOWREX Screw Press, FLOWREX Dissolved Air Flotation, dan teknologi lainnya yang dirancang untuk kebutuhan pengolahan air di industri.</p>
                                </div>
                            </div>

                            <div class="mb-5" id="license66e0fe3a8cxy1">
                                <a class="d-flex toggle collapsible collapsed pb-2"
                                    href="#how-long-are-licenses-valid" data-bs-toggle="collapse"
                                    data-bs-target="#how-long-are-licenses-valid-collapse">
                                    <div class="accordion-icon">
                                        <div class="toggle-off">
                                            <x-icons.minus />
                                        </div>
                                        <div class="toggle-on">
                                            <x-icons.plus />
                                        </div>
                                    </div>
                                    <h3 class="ps-3 fw-semibold fs-5 m-0">
                                        Bagaimana cara mendapatkan informasi lebih lanjut mengenai produk?
                                    </h3>
                                </a>

                                <div id="how-long-are-licenses-valid-collapse"
                                    class="collapse fw-semibold text-gray-700 ps-9 pb-3 fs-6"
                                    data-bs-parent="#license-posts">
                                    <p>Anda dapat menghubungi kami melalui halaman Contact Us atau mengisi formulir di website untuk meminta brosur atau jadwal konsultasi.</p>
                                </div>
                            </div>

                            <div class="mb-5" id="license66e0fe3a8cxy1">
                                <a class="d-flex toggle collapsible collapsed pb-2"
                                    href="#how-long-are-product-valid" data-bs-toggle="collapse"
                                    data-bs-target="#how-long-are-product-valid-collapse">
                                    <div class="accordion-icon">
                                        <div class="toggle-off">
                                            <x-icons.minus />
                                        </div>
                                        <div class="toggle-on">
                                            <x-icons.plus />
                                        </div>
                                    </div>
                                    <h3 class="ps-3 fw-semibold fs-5 m-0">
                                        Apakah ada warranty pada setiap produk yang dibeli?
                                    </h3>
                                </a>

                                <div id="how-long-are-product-valid-collapse"
                                    class="collapse fw-semibold text-gray-700 ps-9 pb-3 fs-6"
                                    data-bs-parent="#license-posts">
                                    <p>Tentu, setiap produk dari Guna Hijau Inovasi akan mendapatkan warranty sebagai wujud tanggung jawab kami dalam memberikan teknologi tepat guna untuk setiap pelanggan.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <!--end::About card-->

    </div>
    <!--end::Content container-->

    <!--begin::Footer-->
    @include('layouts.guest.footer')
    <!--end::Footer-->
</x-guest-layout>
