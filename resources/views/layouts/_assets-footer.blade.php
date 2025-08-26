<!--begin::Javascript-->
<script>
    var hostUrl = "{{ url('template/assets/') }}";
</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ url('template/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ url('template/assets/js/scripts.bundle.js') }}"></script>
<script src="{{ url('template/assets/js/autoNumeric.js') }}"></script>
<script src="{{ url('template/assets/js/pagination-js-2.5.0/pagination.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ url('template/assets/js/GrinviroJS.js') }}"></script>
<!--end::Global Javascript Bundle-->
<script>
    moment.locale('id')
    const target = document.querySelector("#kt_app_body");
    const blockUI = new KTBlockUI(target, {
        message: `<div class="blockui-message flex-wrap justify-content-center fs-2">
                    <span class="spinner-border text-primary"></span> Loading...
                    <span class="full-width text-center fs-5 text-gray-500 w-100" id="blockui-info"></div>
                </div>`,
    });

    document.addEventListener("toggleBlock", function(e) {
        if (blockUI.isBlocked()) {
            blockUI.release();
        } else {
            blockUI.block();
        }
    });
    document.addEventListener("loadingInfo", function(e) {
        $('#blockui-info').text(e.detail);
    });
    moment.locale('id')

    $(".autonumeric").autoNumeric('init', {
        aSep: '.',
        aDec: ',',
        aSign: 'Rp',
        mDec: '0'
    });

    $('.flatpickr-input').flatpickr({
        altInput: true,
        altFormat: 'd F Y',
        dateFormat: 'Y-m-d',
        static: false,
        wrap: false,
    })

    $('.flatpickr-wrapper').css({
        'display': 'contents',
    })

    function showLoading(initInfo = '') {
        document.dispatchEvent(
            new CustomEvent('toggleBlock')
        );
        if (initInfo) {
            setLoadingInfo(initInfo);
        }
    }

    function setLoadingInfo(info = '') {
        document.dispatchEvent(
            new CustomEvent('loadingInfo', {
                detail: info
            })
        );
    }

    function hideLoading() {
        blockUI.release();
    }

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toastr-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
</script>
<!--end::Javascript-->
