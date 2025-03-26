@include('layouts.front.com_header')

<body>
@include('layouts.front.com_links')
  <!-- cursor start -->
  <div class="cursor js-cursor">
    <div class="cursor__wrapper">
      <div class="cursor__follower js-follower"></div>
      <div class="cursor__label js-label"></div>
      <div class="cursor__icon js-icon"></div>
    </div>
  </div>
  <!-- cursor end -->
  <main class="">
    <header class="header -h-110 -blur js-header" data-add-bg="bg-accent-2" data-x="header" data-x-toggle="-is-menu-opened">
      <div class="container">
        <div class="header__container h-full items-center">
          <div class="header__left d-flex items-center">
            <div class="d-flex items-center js-menuFullScreen-toggle">
              <i class="icon-menu text-9"></i>
              <div class="text-15 uppercase ml-30 sm:d-none">Menu</div>
            </div>
            <div class="d-flex items-center ml-60 xl:d-none">
              <i class="icon-phone text-20 mr-20"></i>
              <div class="text-15 uppercase"><a href="tel:+94123456789">+94 123 456 789</a></div>
            </div>
          </div>
          <div class="header__center">
            <div class="header__logo">
              <a href="{{ route('home') }}"><img src="{{ URL::to('assets/front/img/logo.png') }}" alt="PMS"></a>
            </div>
          </div>
          <div class="header__right d-flex items-center h-full">
            <a href="{{ route('contact') }}" class="button -md -accent-1 bg-white rounded-16 xl:d-none">
              GET IN TOUCH
            </a>
          </div>
        </div>
      </div>
    </header>

    @yield('content')
    @include('layouts.front.toaster')
    <!-- hero end -->
    <!-- footer start -->
    @include('layouts.front.com_footer')
    <!-- footer end -->
  </main>
  <!-- JavaScript -->
  <script src="{{ URL::to('assets/admin/js/jquery.min.js') }}"></script>
  <script src="{{ URL::to('assets/front/js/map.js') }}"></script>
  <script src="{{ URL::to('assets/front/js/vendors.js') }}"></script>
  <script src="{{ URL::to('assets/front/js/main.js') }}"></script>

  <script src="{{ URL::to('assets/admin/vendor/toaster/toastr.min.js') }}"></script>

  <script>
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
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
  @stack('scripts')
</body>

</html>