<!--footer section start-->
        <footer class="footer-section">
            <div class="footer-wrapper pt-50 position-relative z-1 overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/texture-bg.png">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-5 col-lg-5">
                            <div class="footer-widget widget-basic">
                                <h3 class="widget-title-large mb-4 text-white">Have a Question? Feel Free to Ask..Feedback</h3>
                                <p class="mb-40"></p>
                                <div class="phone-box d-flex align-items-center">
                                    <span class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white"><i class="flaticon-phone-call"></i></span>
                                    <h4 class="text-white ms-3 mb-0">+91-9980318883</h4>
                                </div>
                                <div class="sb-form mt-40">
                                    <h5 class="text-white mb-4">Get latest updates & offers</h5>
                                    <form class="footer-sb-form position-relative">
                                        <input type="email" placeholder="Enter your email..." class="bg-white w-100">
                                        <button type="submit" class="btn btn-primary">Subscribe</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7">
                            <div class="ms-lg-5 ms-xl-0 mt-5 mt-lg-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <a href="<?=base_url()?>" class="footer-logo d-inline-block"><img style="width:190px" src="logo/logo2.png" alt="logo"></a>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-end">
                                            <div class="footer-social d-inline-block text-start">
                                                <h6 class="text-white">Follow us on</h6>
                                                <ul class="footer-social-list">
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>                                          
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-30">
                                    <div class="col-sm-4">
                                        <div class="footer-widget footer-nav-widget mb-5 mb-sm-0">
                                            <h6 class="widget-title text-white mb-3">About Company</h6>
                                            <ul class="footer-nav">
                                                <li><a href="<?=base_url('About')?>">About Us</a></li>
                                                <li><a href="<?=base_url('Contact')?>">Contact Us</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="footer-widget footer-nav-widget mb-5 mb-sm-0">
                                            <h6 class="widget-title text-white mb-3">Book a Ride</h6>
                                            <ul class="footer-nav">
                                                <li><a href="<?=base_url('Tariff')?>">Tariff</a></li>
                                                <li><a href="<?=base_url('Bookaride')?>">Book a Ride</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="footer-widget footer-nav-widget mb-5 mb-sm-0">
                                            <h6 class="widget-title text-white mb-3">Quick links</h6>
                                            <ul class="footer-nav">
                                                <li><a href="<?=base_url('Terms')?>">Terms</a></li>
                                                <li><a href="<?=base_url('Privacy')?>">Privacy</a></li>
                                                <li><a href="<?=base_url('Refund')?>">Refund & Cancellation</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-sm-7">
                                <div class="copyright-text">
                                    <p class="mb-0">&copy; All rights reserved. By <a href="rocknrollrental.com">RockNRollRental.com</a></p>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="copyright-text text-end text-sm-end mt-1 mt-sm-0">
                                    <p class="mb-0">
                                        &nbsp;Designed &amp; Developed By : <a  href="https://www.jvmtech.in">JVM TECH SOLUTIONS</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content wrapper ends -->


    <!-- Modal -->
    <div class="modal fade" id="at_product_view">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content product_modal shadow">
                <div class="at_product_view">
                    <div class="card w-100" style="max-width: 480px;">
                        <div class="card-body">
                            <div class="text-center">
                                <h1 class="card-title h3">Sign in</h1>
                                <p class="card-text text-muted">Sign in below to access your account</p>
                            </div>
                            <div class="mt-4">
                                <form action="">
                                    <div class="mb-4">
                                        <input type="tel" class="form-control" id="phone" placeholder="Phone" required>
                                    </div>
                                    <div class="mb-2">
                                        <input type="password" class="form-control" id="password" placeholder="Password" required>
                                    </div>
                                    <div class="d-flex mb-2 justify-content-between">
                                        <a href="javascript:void(0)" id="OTP-Login" class="forgot_pass_inside">Login with OTP</a>
                                        <a href="javascript:void(0)" id="forgot-pass" class="forgot_pass_inside">Forgot password?</a>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
                                    </div>
                                    <p class="text-center text-muted mt-4">Don't have an account yet?
                                        <a data-bs-toggle="modal" data-bs-target="#at_signup" href="javascript:void(0)" class="text-decoration-none">Sign up</a>.
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="at_signup">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content product_modal shadow">
                <div class="at_product_view">
                    <div class="card w-100" style="max-width: 480px;">
                        <div class="card-body">
                            <div class="text-center">
                                <h1 class="card-title h3">Sign Up</h1>
                                <p class="card-text text-muted">Sign up for New Account</p>
                            </div>
                            <div class="mt-4">
                                <form class="login-form">
                                    <div class="mb-4">
                                        <input type="name" placeholder="Name" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <input type="email" placeholder="Email" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <input type="tel" maxlength="10" placeholder="Phone" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <input type="password" placeholder="Password" class="form-control">
                                    </div>
                                    <div class="cookies-area d-flex align-items-center flex-wrap justify-content-between mt-3">
                                        <label><input type="checkbox" checked class="me-1">Get Updates on Whatsapp</label>
                                    </div>
                                    <div class="d-grid mt-2">
                                        <button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
                                        <p class="mt-2 text-center" style="font-size:12px;font-weight:600;width: 100%;">By clicking through, I agree with the <a href="<?=base_url('Terms')?>">Terms & Conditions</a> and <a  href="<?=base_url('Privacy')?>">Privacy Policy</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--scrolltop button-->
    <button class="theme-scrolltop-btn"><i class="fa-regular fa-hand-pointer"></i></button>
    <!--scrolltop button end-->

    <!--build:js-->
    <script src="<?=base_url()?>/assets/js/vendors/jquery.min.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/jquery-ui.min.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/appear.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/popper.min.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/bootstrap.min.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/easing.min.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/swiper.min.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/massonry.min.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/bootstrap-slider.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/magnific-popup.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/waypoints.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/counterup.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/isotop.pkgd.min.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/moment.min.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/date-picker.min.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/progressbar.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/slick.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/countdown.min.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/custom-scrollbar.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/price-range.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/image-rotate.min.js"></script>
    <script src="<?=base_url()?>/assets/js/vendors/typeit.js"></script>
    <script src="<?=base_url()?>/assets/js/app.js"></script>
    <!--endbuild-->
</body>
</html>