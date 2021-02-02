<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script defer src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script defer src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
<script defer src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

@stack('footer-scripts')

<script>
$(".alert").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert").slideUp(500);
});
</script>