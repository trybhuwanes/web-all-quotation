<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="{{ asset('js/all.js') }}"></script>
<script src="{{ asset('js/jquery.masknumber.js') }}"></script>
<script src="{{ asset('plugins/Chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script>    
    $(function() {
        $('[data-toggle="popover"]').popover()
    })
    $(document).ready(function() {
        Echo.private('App.Models.User.' + "{{ Auth::user()?->username }}")
            .notification((notification) => {
                console.log(notification.type);
            });
    })
</script>
@stack('script')
</body>

</html>
