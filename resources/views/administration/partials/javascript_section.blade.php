<!--   Core JS Files   -->
<script src="{{ asset('administration/assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('administration/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('administration/assets/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('administration/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('administration/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('administration/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- Kaiadmin JS -->
<script src="{{ asset('administration/assets/js/kaiadmin.min.js') }}"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="{{ asset(path: 'administration/assets/js/setting-demo.js') }}"></script>

@stack('scripts')
