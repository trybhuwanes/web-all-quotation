@if (! request()->is(['myshop', 'myshop/*']))
    <footer class="ps-footer border-top">
        <div class="ps-container">
            <div class="ps-footer__widgets">
                <aside class="widget widget_footer widget_contact-us">
                    <h4 class="widget-title">Kontak Kami</h4>
                    
                </aside>
                <aside class="widget widget_footer">
                    <h4 class="widget-title">Belanjar</h4>
                    <ul class="ps-list--link text-capitalize">
                        {{-- @foreach ($kontens->where('tab', 'belanjar') as $konten)
                            <li><a href="{{ URL::to($konten->link) }}">{{ $konten->nama_konten }}</a></li>
                        @endforeach --}}
                        <!-- <li><a href="#">Tentang Belanjar</a></li>
                <li><a href="#">Aturan Penggunaan</a></li>
                <li><a href="#">Kebijakan Privasi</a></li>
                <li><a href="#">Informasi Belanja</a></li>
                <li><a href="#">FAQ (Tanya Jawab)</a></li> -->
                    </ul>
                </aside>
                <aside class="widget widget_footer">
                    <h4 class="widget-title">Pembeli</h4>
                    <ul class="ps-list--link text-capitalize">
                        {{-- @foreach ($kontens->where('tab', 'pembeli') as $konten)
                            <li><a href="{{ URL::to($konten->link) }}">{{ $konten->nama_konten }}</a></li>
                        @endforeach --}}
                        <!-- <li><a href="#">Cara Belanja</a></li>
                <li><a href="#">Pembayaran</a></li> -->
                    </ul>
                </aside>
                <aside class="widget widget_footer">
                    <h4 class="widget-title">Penjual</h4>
                    <ul class="ps-list--link text-capitalize">
                        {{-- @foreach ($kontens->where('tab', 'penjual') as $konten)
                            <li><a href="{{ URL::to($konten->link) }}">{{ $konten->nama_konten }}</a></li>
                        @endforeach --}}
                        <!-- <li><a href="#">Cara Berjualan</a></li>
                <li><a href="#">Keuntungan Berjualan</a></li> -->
                    </ul>
                </aside>
            </div>
            <div class="ps-footer__links">
                <h4 style="font-size: 16px; color: #000; font-weight: 600; margin-bottom: 30px;">Supported By:</h4>
                <a target="_blank" href="https://dinamika.ac.id">
                    <img src="{{ URL::asset('img/undika.png') }}" alt="" width="150px">
                </a>
                <a target="_blank" href="https://ssi.dinamika.ac.id">
                    <img src="{{ URL::asset('img/logo_ssi.jpg') }}" alt="" width="100px">
                </a>
                <!-- <p><strong>Consumer Electric:</strong><a href="#">Air Conditioners</a><a href="#">Audios &amp; Theaters</a><a href="#">Car Electronics</a><a href="#">Office Electronics</a><a href="#">TV Televisions</a><a href="#">Washing Machines</a>
            </p>
            <p><strong>Clothing &amp; Apparel:</strong><a href="#">Printers</a><a href="#">Projectors</a><a href="#">Scanners</a><a href="#">Store &amp; Business</a><a href="#">4K Ultra HD TVs</a><a href="#">LED TVs</a><a href="#">OLED TVs</a>
            </p>
            <p><strong>Home, Garden &amp; Kitchen:</strong><a href="#">Cookware</a><a href="#">Decoration</a><a href="#">Furniture</a><a href="#">Garden Tools</a><a href="#">Garden Equipments</a><a href="#">Powers And Hand Tools</a><a href="#">Utensil &amp; Gadget</a>
            </p>
            <p><strong>Health &amp; Beauty:</strong><a href="#">Hair Care</a><a href="#">Decoration</a><a href="#">Hair Care</a><a href="#">Makeup</a><a href="#">Body Shower</a><a href="#">Skin Care</a><a href="#">Cologine</a><a href="#">Perfume</a>
            </p>
            <p><strong>Jewelry &amp; Watches:</strong><a href="#">Necklace</a><a href="#">Pendant</a><a href="#">Diamond Ring</a><a href="#">Sliver Earing</a><a href="#">Leather Watcher</a><a href="#">Gucci</a>
            </p>
            <p><strong>Computer &amp; Technologies:</strong><a href="#">Desktop PC</a><a href="#">Laptop</a><a href="#">Smartphones</a><a href="#">Tablet</a><a href="#">Game Controller</a><a href="#">Audio &amp; Video</a><a href="#">Wireless Speaker</a><a href="#">Done</a>
            </p> -->
            </div>
            <div class="ps-footer__copyright">
                {{-- <p style="color: #666;">© {{ date('Y') }} {{ $nama_marketplace }}. All Rights Reserved</p> --}}
                <!-- <p><span>We Using Safe Payment For:</span>
                <a href="#"><img src="{{ URL::asset('img/payment-method/1.jpg') }}" alt=""></a>
                <a href="#"><img src="{{ URL::asset('img/payment-method/2.jpg') }}" alt=""></a>
                <a href="#"><img src="{{ URL::asset('img/payment-method/3.jpg') }}" alt=""></a>
                <a href="#"><img src="{{ URL::asset('img/payment-method/4.jpg') }}" alt=""></a>
                <a href="#"><img src="{{ URL::asset('img/payment-method/5.jpg') }}" alt=""></a></p> -->
            </div>
        </div>
    </footer>
@endif
<!-- <div class="ps-popup" id="subscribe" data-time="500">
      <div class="ps-popup__content bg--cover" data-background="img/bg/subscribe.jpg"><a class="ps-popup__close" href="#"><i class="icon-cross"></i></a>
        <form class="ps-form--subscribe-popup" action="index.html" method="get">
          <div class="ps-form__content">
            <h4>Get <strong>25%</strong> Discount</h4>
            <p>Subscribe to the Martfury mailing list <br /> to receive updates on new arrivals, special offers <br /> and our promotions.</p>
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Email Address" required>
              <button class="ps-btn">Subscribe</button>
            </div>
            <div class="ps-checkbox">
              <input class="form-control" type="checkbox" id="not-show" name="not-show"/>
              <label for="not-show">Don't show this popup again</label>
            </div>
          </div>
        </form>
      </div>
    </div> -->
<div id="back2top"><i class="pe-7s-angle-up"></i></div>
<div class="ps-site-overlay"></div>
<div id="loader-wrapper">
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
    <div class="ps-search__content">
        <form class="ps-form--primary-search" action="do_action" method="post">
            <input class="form-control" type="text" placeholder="Search for...">
            <button><i class="aroma-magnifying-glass"></i></button>
        </form>
    </div>
</div>
<!--include shared/cart-sidebar-->
<!-- Plugins-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
</script>
{{-- @if (app()->isProduction())
    <script defer src="https://analytics.ssidev.biz/script.js" data-website-id="5c4e4334-f694-46ba-a24c-483b1be7a53f"></script>
@endif --}}
<!-- <script src="{{ asset('plugins/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap4/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/imagesloaded.pkgd.js') }}"></script>
    <script src="{{ asset('plugins/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('plugins/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery.matchHeight-min.js') }}"></script>
    <script src="{{ asset('plugins/slick/slick/slick.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('plugins/slick-animation.min.js') }}"></script>
    <script src="{{ asset('plugins/lightGallery-master/dist/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/sticky-sidebar/dist/sticky-sidebar.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/gmap3.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script> -->
<script src="{{ asset('frond-end/js/all.js') }}"></script>
<script>
    $(document).ready(function() {
        Echo.private('App.Models.User.' + "{{ Auth::user()?->username }}")
            .notification((notification) => {
                console.log(notification.type);
            });
    })
    
    function showLoading(element = null) {
        if (element == null) {
            return Swal.fire({
                title: 'Loading . . .',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                }
            })
        } else {
            var form = $(element).parents('form');
            if (form != null) {
                form.on('submit', function(e) {
                    return Swal.fire({
                        title: 'Loading . . .',
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    })
                })
            }
        }
    }

    function hideLoading() {
        return Swal.close();
    }
</script>
@stack('script')
</body>

</html>
