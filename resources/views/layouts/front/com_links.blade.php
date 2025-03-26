<div class="menuFullScreen js-menuFullScreen">
    <div class="menuFullScreen__topMobile js-menuFullScreen-topMobile">
      <div class="d-flex items-center text-white js-menuFullScreen-toggle">
        <i class="icon-menu text-9"></i>
        <div class="text-15 uppercase ml-30 sm:d-none">Menu</div>
      </div>
      <div class="">
        <img src="{{ URL::to('assets/front/img/logo.png') }}" alt="logo">
      </div>
      <button class="button text-white mr-30 lg:mr-0">
        EN <i class="icon-chevron-down ml-15"></i>
      </button>
    </div>
    <div class="menuFullScreen__mobile__bg js-menuFullScreen-mobile-bg"></div>
    <div class="menuFullScreen__left">
      <div class="menuFullScreen__bg js-menuFullScreen-bg">
        <img src="{{ URL::to('assets/front/img/menu/bg.png') }}" alt="image">
      </div>
      <button class="menuFullScreen__close js-menuFullScreen-toggle js-menuFullScreen-close-btn">
        <span class="icon">
          <span></span>
          <span></span>
        </span>
        CLOSE
      </button>
      <div class="menuFullScreen-links js-menuFullScreen-links">
        <div class="menuFullScreen-links__item js-menuFullScreen-has-children">
          <a href="{{ route('home') }}">
            Home
          </a>
        </div>
        <div class="menuFullScreen-links__item">
          <a href="{{ route('contact') }}">
            Contact
          </a>
        </div>
      </div>
    </div>
  </div>