<footer class="footer -type-1 -bg-1 relative text-white">
    <div class="footer__bg -type-1">
        <div class="bg-accent-2"></div>
        <div class="bg-accent-1"></div>
    </div>
    <div class="footer__main">
        <div class="container">
            <div class="footer__grid">
                <div class="">
                    <h4 class="text-30 fw-500 text-white">About Us</h4>
                    <div class="text-white-60 text-15 lh-17 mt-60 md:mt-20">
                        Products Managment Sysytem
                    </div>
                </div>
                <div class="">
                    <h4 class="text-30 fw-500 text-white">Contact</h4>
                    <div class="d-flex flex-column mt-60 md:mt-20">
                        <div class="">
                            <a class="d-block text-15 text-white-60 lh-17" href="#">
                                Maharagama, Colombo, Sri Lanka.
                            </a>
                        </div>
                        <div class="mt-25">
                            <a class="d-block text-15 text-white-60" href="mailto:info@pms.lk;">
                                info@pms.lk
                            </a>
                        </div>
                        <div class="mt-10">
                            <a class="d-block text-15 text-white-60" href="tel:+94312259374">
                                +94 123456789
                            </a>
                            <a class="d-block text-15 text-white-60" href="tel:+94317401076">
                                +94 123 456 789
                            </a>
                        </div>
                    </div>

                </div>
                <div class="">
                    <h4 class="text-30 fw-500 text-white">Links</h4>
                    <div class="row x-gap-50 y-gap-15">
                        <div class="col-sm-6">
                            <div class="y-gap-15 text-15 text-white-60 mt-60 md:mt-20">
                                <a class="d-block" href="{{ route('home') }}">
                                    Home
                                </a>
                                <a class="d-block" href="{{ route('contact') }}">
                                    Contact Us
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <h4 class="text-30 fw-500 text-white">Newsletter</h4>
                    <p class="text-15 text-white-60 mt-60 md:mt-20">Sign up and get our news and deals.</p>
                    <div class="footer__newsletter mt-30">
                        <input type="Email" placeholder="Your email address">
                        <button><i class="icon-arrow-right text-white text-20"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <div class="row y-gap-30 justify-between md:justify-center items-center">
                    <div class="col-sm-auto">
                        <div class="text-15 text-center text-white-60">Copyright © 2025 by <a href="https://pms.lk" target="_blank" title="ePartner Sri Lanka">pms.lk</a></div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="footer__bottom_center">
                            <div class="d-flex justify-center">
                                <img src="{{ URL::to('assets/front/img/logo.png') }}" alt="logo">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="row x-gap-25 y-gap-10 items-center justify-center">
                            <div class="col-auto">
                                <a href="#" class="d-block text-white-60">
                                    <i class="icon-facebook text-11"></i>
                                </a>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="d-block text-white-60">
                                    <i class="icon-twitter text-11"></i>
                                </a>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="d-block text-white-60">
                                    <i class="icon-instagram text-11"></i>
                                </a>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="d-block text-white-60">
                                    <i class="icon-linkedin text-11"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</footer>