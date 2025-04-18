      <?php
    $social = getSocial(); 
    ?> 
    <div id="whatsapp-widget" class="d-block dsm-none">
      <a title="Whatsapp Us" href="https://api.whatsapp.com/send?phone=919980318883&amp;text=Hi!%20Can%20I%20get%20more%20information%20on%20this?" target="_blank">
        <img width="64" height="64" style="border-radius:25px;" src="<?=base_url('assets/images/whatsapp.png')?>" alt="whatsapp--v1">
      </a>
      <a title="Call Us"  class="call-widget" href="tel:+919980318883" target="_blank">
        <img width="64" height="64" src="<?=base_url('assets/images/call.png')?>" alt="call">
      </a>
    </div>
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
                                <h4 class="text-white ms-3 mb-0">+91 9980318883</h4>
                            </div>
                            <div class="sb-form mt-40">
                                <h5 class="text-white mb-4">Get latest updates & offers</h5>
                                <form method="POST" id="subscribe-form" action="<?=base_url('Contact/subscribe')?>" class="footer-sb-form position-relative">
                                    <input type="email" name="email" placeholder="Enter your email..." required maxlength="100" class="bg-white text-dark w-100 py-4">
                                    <button type="button" id="subscribe" class="btn btn-primary py-4">Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-7">
                        <div class="ms-lg-5 ms-xl-0 mt-5 mt-lg-0">
                            <div class="row align-items-center">
                                <div class="col-xl-9 col-md-9 col-sm-12">
                                    <div class="row">
                                        <div class="col-xl-4 col-md-4 col-sm-6">
                                            <img class="footerlogo img-fluid" src="<?=base_url()?>logo/logo2.png" alt="logo">
                                        </div>
                                        <div class="col-xl-6 col-md-8 col-sm-6">
                                            <div class="d-inline text-start m-1 p-1">
                                                <span class="h5 text-white w-75 mt-1 d-block">ROCK N ROLL</span>
                                                <span style="border-top: 2px dashed #fdfd06;" class="h5 text-white pt-1 d-block w-75">RENTALS</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3 col-sm-12">
                                    <div class="text-end">
                                        <div class="footer-social d-inline-block text-start">
                                            <h6 class="text-white">Follow us on</h6>
                                            <ul class="footer-social-list">
                                                <?php if( is_array($social) && $social['facebook'] != "" ){ ?>
                                                <li><a href="<?=$social['facebook']?>"><i class="fa fa-facebook-f"></i></a></li>
                                                <?php } ?>
                                                <?php if( is_array($social) && $social['twitter'] != "" ){ ?>
                                                <li><a href="<?=$social['twitter']?>"><i class="fa fa-twitter"></i></a></li>
                                                <?php } ?>
                                                <?php if( is_array($social) && $social['instagram'] != "" ){ ?>
                                                <li><a href="<?=$social['instagram']?>"><i class="fa fa-instagram"></i></a></li>
                                                <?php } ?>
                                                <?php if( is_array($social) && $social['youtube'] != "" ){ ?>
                                                <li><a href="<?=$social['youtube']?>"><i class="fa fa-youtube"></i></a></li>
                                                <?php } ?>                                      
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-links row mt-30">
                                <div class="col-xl-4 col-md-4 col-sm-12">
                                    <div class="footer-widget footer-nav-widget mb-5 mb-sm-0">
                                        <h6 class="widget-title text-white mb-3">About Company</h6>
                                        <ul class="footer-nav">
                                            <li><a href="<?=base_url('About')?>">About Us</a></li>
                                            <li><a href="<?=base_url('Contact')?>">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4 col-sm-12">
                                    <div class="footer-widget footer-nav-widget mb-5 mb-sm-0">
                                        <h6 class="widget-title text-white mb-3">Book a Ride</h6>
                                        <ul class="footer-nav">
                                            <li><a href="<?=base_url('Tariff')?>">Tariff</a></li>
                                            <li><a href="<?=base_url('Bookaride')?>">Book a Ride</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4 col-sm-12">
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

     <div class="d-none dsm-block" id="whatsapp-widget-mobile">
      <a title="Whatsapp Us" class="btn btn-warning" href="https://api.whatsapp.com/send?phone=919980318883&amp;text=Hi!%20Can%20I%20get%20more%20information%20on%20this?" target="_blank">
        <!-- <img width="30" height="30" src="<?=base_url('assets/images/whatsapp.png')?>" alt="whatsapp--v1"> -->
        <i class="fa fa-whatsapp"></i>
        &nbsp; Whatsapp Us
      </a>
      <a title="Call Us"  class="btn btn-warning call-widget" href="tel:+919980318883" target="_blank">
        <!-- <img width="30" height="30" src="<?=base_url('assets/images/call.png')?>" alt="call"> -->
        <i class="fa fa-phone"></i>
        &nbsp; Call Us
      </a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="bike_customize">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content product_modal px-2 py-2">
                <div class="close-btn-wrapper text-end">
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="at_product_view">
                    <div class="card w-100 bg-white border-0"  style="max-width: 480px;">
                        <div class="card-body p-1">
                            <div class="text-center">
                                <span class="d-block card-title fw-bold mb-1 fs-5"></span>
                            </div>
                            <div class="mt-1 mb-2 text-center border">
                                <form id="custom_bike" method="POST" action="<?=base_url('Cart/instant')?>" class="custom_bike row d-flex align-items-center mx-1 my-0">
                                    <input type="hidden" name="bike_type_id" value="">
                                    <input type="hidden" name="bike_type_name" value="">
                                    <div class="col-xl-12 border-bottom-primary">
                                        <div class="row">
                                            <div class="col-xl-6 col-sm-12">
                                                <label class="text-black font-md font-bold mb-1">PICKUP</label>
                                                <div class="row px-2">
                                                    <div class="col-xl-12 mb-1">
                                                        <input type="date" name="pickupdate" value="<?=date("Y-m-d", time())?>" id="pickupdate" class="w-60 px-2  text-dark border rounded" placeholder="">
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <select id="pickuptime" name="pickuptime" class="w-50 form-select">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="todivider d-none d-lg-block">TO</span>
                                            <div class="col-xl-6 col-sm-12">
                                                <label class="text-black font-md font-bold mb-1">DROPOFF</label>
                                                <div class="row px-2">
                                                    <div class="col-xl-12 mb-1">
                                                        <input type="date" name="dropoffdate" id="dropoffdate" value="<?=date("Y-m-d", time())?>" class="w-60 px-2 text-dark border rounded" placeholder="">
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <select id="dropofftime" name="dropofftime" class="w-50 form-select">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 border-bottom-primary">
                                        <div class="row">
                                            <div class="col-xl-12 col-sm-12 py-2">
                                                <p class="font-md mb-1"><span class="text-dark">LOCATION :</span>&nbsp;Near KSRTC bus stand Chikmagaluru, Karnataka 577101. <a target="_blank" href="https://maps.app.goo.gl/XkDwJyZ2tcNp9YUy6" class="text-success d-inline-block" title="View location on Map"><img style="width:25px;" src="<?=base_url('assets/img/icons/map-pin.svg')?>" class="img-fluid"/></a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 border-bottom-primary">
                                        <div class="row px-2">
                                            <div class="col-xl-4 col-sm-4 py-2">
                                                <div class="w-50 pt-1 text-dark float-left">Qty</div>
                                            </div>
                                            <div class="col-xl-4  col-sm-4 py-2">
                                                <div class="w-100 cart-count d-flex justify-content-center">
                                                    <span class="btn btn-sm cart-minus bg-primary text-white rounded-0 px-2 py-1"><i class="fa fa-minus"></i></span>
                                                    <input type="text" name="bikeqty" class="w-50 cart-input text-center border text-black rounded-0" value="1">
                                                    <span class="btn btn-sm cart-plus bg-primary text-white rounded-0 px-2 py-1"><i class="fa fa-plus"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-xl-4  col-sm-4 py-2">
                                                <span id="bike_availability" class="text-success m-1">Availability : <i class="fa fa-check"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 border-bottom-primary">
                                        <div class="row px-2">
                                            <div class="col-xl-4 col-sm-4 py-2">
                                                <div class="w-100 pt-1 text-dark float-left">Rental Price</div>
                                            </div>
                                            <div class="col-xl-4 col-sm-4 py-2">
                                                <div class="text-dark m-1"> <i class="fa fa-indian-rupee-sign me-1"></i><span class="d-inline" id="bike_price"></span> X <span class="d-inline" id="bike_qty"></span></div>
                                            </div>
                                            <div class="col-xl-4 col-sm-4 py-2">
                                                <div class="text-dark m-1"><i class="fa fa-indian-rupee-sign me-1"></i><span class="d-inline" id="bike_price_subtotal"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 border-bottom-primary">
                                        <div class="border-bottom-dotted-primary row px-2">
                                            <div class="col-xl-12 py-1 text-center">
                                                <b>Addons</b>
                                            </div>
                                        </div>
                                        <div class="border-bottom-dotted-primary row px-2">
                                            <div class="col-xl-8 col-sm-8 py-1">
                                                <div class="w-50 text-sm mt-1 pt-1 text-dark float-left"><input type="checkbox" style="width:20px;height:20px;margin-left:5px;vertical-align: middle;" id="free_helmet" name="free_helmet" value="1" class="me-2">1 Helmet is free per vehicle. </div>
                                            </div>
                                            <div class="col-xl-4  col-sm-4 py-1">
                                               <div class="text-dark m-1"> <i class="fa fa-indian-rupee-sign me-1"></i><span class="d-inline-block p-1">0</span></div>
                                            </div>
                                        </div>
                                        <div class="row px-2">
                                            <div class="col-xl-4 px-1 col-sm-4 py-1">
                                                <div class="w-100 text-sm text-dark mt-2">
                                                    Add extra for ₹50/day.
                                                </div>
                                            </div>
                                            <div class="col-xl-4  col-sm-4 py-1">
                                                <div class="cart-count w-100 d-flex justify-content-center">
                                                    <span class="btn btn-sm cart-hminus bg-primary text-white rounded-0 px-2 py-1"><i class="fa fa-minus"></i></span>
                                                    <input type="text" name="helmets_qty" class="w-50 cart-helmets text-center border text-black rounded-0" value="0">
                                                    <span class="btn btn-sm cart-hplus bg-primary text-white rounded-0 px-2 py-1"><i class="fa fa-plus"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-xl-4  col-sm-4 py-1">
                                                <div class="text-dark m-1"><i class="fa fa-indian-rupee-sign me-1"></i><span class="d-inline" id="helmets_total"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="early_pickup_div" style="display:none;" class="col-xl-12 border-bottom-primary">
                                        <div class="row px-2">
                                            <div class="col-xl-8  col-sm-8 py-2">
                                                    <label class="fa-md text-sm text-dark py-2 px-2"><input style="width:20px;height: 20px;vertical-align:middle;" type="checkbox" name="early_pickup" value="1" > Pickup early at 6:00 AM for  200 extra / bike.</label>
                                            </div>
                                            <div class="col-xl-4  col-sm-4 py-2">
                                                <div class="text-dark m-1"><i class="fa fa-indian-rupee-sign me-1"></i><span class="d-inline" id="early_pickup">0</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 border-bottom-primary">
                                        <div class="row px-2">
                                            <div class="col-xl-8  col-sm-8 py-2">
                                                <div class="w-25 pt-1 text-dark float-left">Total</div>
                                            </div>
                                            <div class="col-xl-4  col-sm-4 py-2">
                                                <div class="text-dark m-1"><i class="fa fa-indian-rupee-sign me-1"></i><span class="d-inline" id="cart_total"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="sumit_row" class="col-xl-12 mt-2 px-2 pt-2 mb-1">
                                        <div class="text-center">
                                            <button class="custom_bike_submit btn btn-sm btn-primary" type="button">Book Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="login_form">
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
                                <form id="signin" method="POST" action="<?=base_url('Auth/signin')?>">
                                    <div class="mb-4">
                                        <input type="tel" autocomplete="off" class="form-control" name="phone" placeholder="Phone" required>
                                    </div>
                                    <div class="mb-2">
                                        <input type="password" autocomplete="off" class="form-control" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="d-flex mb-2 justify-content-between">
                                        <a href="javascript:void(0)" id="otplogin" class="forgot_pass_inside">Login with OTP</a>
                                        <!-- <a href="javascript:void(0)" id="forgot-pass" class="forgot_pass_inside">Forgot password?</a> -->
                                    </div>
                                    <div class="d-grid">
                                        <button type="button" class="signin btn btn-primary btn-lg">Sign in</button>
                                    </div>
                                    <p class="text-center text-muted mt-4">Don't have an account yet?
                                        <a href="javascript:void(0)" class="signup_button text-decoration-none forgot_pass_inside">Sign up</a>
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
    <div class="modal fade" id="otp_form">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content product_modal shadow">
                <div class="container height-100 d-flex justify-content-center align-items-center">
                    <div class="position-relative">
                        <div class="card p-2 text-center">
                            <h6>Please enter the one time password <br> to verify your account</h6>
                            <div> <span>A code has been sent to</span> <small id="maskedNumber"></small> </div>
                            <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                                <input class="m-2 text-center form-control rounded" type="text" id="first" maxlength="1" />
                                <input class="m-2 text-center form-control rounded" type="text" id="second" maxlength="1" />
                                <input class="m-2 text-center form-control rounded" type="text" id="third" maxlength="1" />
                                <input class="m-2 text-center form-control rounded" type="text" id="fourth" maxlength="1" />
                                <input class="m-2 text-center form-control rounded" type="text" id="fifth" maxlength="1" />
                                <input class="m-2 text-center form-control rounded" type="text" id="sixth" maxlength="1" />
                            </div>
                            <div id="otp_div" class="mt-4"> 
                                <button id="validateBtn" class="btn btn-warning px-4 validate">Validate</button> 
                                <div class="row justify-content-center">
                                    <span style="display:inline-block;width:50px;font-size:20px;font-weight:bold;border-radius:50%;border:1px solid red;" class="mx-auto my-1 p-2" id="otp_counter"></span>
                                    <button id="resendOtp" style="display:none;position: absolute;text-decoration: underline;right: 18%;margin-top: 8px;width: 100px;" class="btn btn-sm btn-link text-info p-2 float-right">Resend OTP</button>
                                </div>
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
                                <form form id="signup" method="POST" action="<?=base_url('Auth/signup')?>" class="login-form">
                                    <div class="mb-4">
                                        <input type="text" name="name" autocomplete="off" placeholder="Name" class="form-control" required>
                                    </div>
                                    <div class="mb-4">
                                        <input type="email" name="email" autocomplete="off" placeholder="Email" class="form-control" required>
                                    </div>
                                    <div class="mb-4">
                                        <input type="tel" name="phone" autocomplete="off" maxlength="10" placeholder="Phone" class="form-control" required>
                                    </div>
                                    <div class="mb-4 position-relative">
                                        <input type="password" name="password" autocomplete="off" placeholder="Password" class="form-control" required>
                                        <a class="infoicon"><i class="fa fa-info"></i></a>
                                        <span class="tooltiptext">Password should contain alphanumberic with atleast 1 special character.</span>
                                    </div>
                                    <div otp-validated="0" id="signup_otp" style="display:none" class="position-relative">
                                        <div class="card p-2 text-center">
                                            <h6>Please enter the OTP to verify</h6>
                                            <div> <span>A code has been sent to</span> <small id="maskedNumber"></small> </div>
                                            <div id="otp1" class="inputs d-flex flex-row justify-content-center mt-2">
                                                <input class="m-2 text-center form-control rounded" type="text" id="first" maxlength="1" />
                                                <input class="m-2 text-center form-control rounded" type="text" id="second" maxlength="1" />
                                                <input class="m-2 text-center form-control rounded" type="text" id="third" maxlength="1" />
                                                <input class="m-2 text-center form-control rounded" type="text" id="fourth" maxlength="1" />
                                                <input class="m-2 text-center form-control rounded" type="text" id="fifth" maxlength="1" />
                                                <input class="m-2 text-center form-control rounded" type="text" id="sixth" maxlength="1" />
                                            </div>
                                            <div id="otp_div1" class="mt-4"> 
                                                <button id="validateSignupBtn" type="button" class="float-right btn btn-warning px-4 validate">Validate</button> 
                                                <div class="row justify-content-left">
                                                    <span style="display:inline-block;width:50px;font-size:20px;font-weight:bold;border-radius:50%;border:1px solid red;" class="mx-2 my-1 p-2" id="otp_counter1"></span>
                                                    <button  id="resendOtp1" style="display:none;position: absolute;text-decoration: underline;left: 18%;margin-top: 8px;width: 100px;" class="btn btn-sm btn-link text-info p-2 float-right">Resend OTP</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cookies-area d-flex align-items-center flex-wrap justify-content-between mt-3">
                                        <label><input type="checkbox" checked class="me-1">Get Updates on Whatsapp</label>
                                        <p class="text-center text-muted mt-4">Already have an account?
                                            <a href="javascript:void(0)" class="signin_button text-decoration-none forgot_pass_inside">Sign In</a>
                                        </p>
                                    </div>
                                    <div class="d-grid mt-2">
                                        <button type="button" class="signup btn btn-primary btn-lg">Sign Up</button>
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

    <!-- Terms and Conditions Modal -->
    <div class="modal fade" id="terms_view">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content product_modal shadow">
                <div class="terms_view">
                    <div class="card w-100" style="max-width: 480px;">
                        <div class="card-body">
                            <div class="text-center">
                                <h1 class="card-title h3">Terms & Conditions</h1>
                            </div>
                            <div class="mt-4">
                                <form id="payment_form" method="POST" action="<?=base_url('Payment')?>" class="payment-form">
                                    <div class="mb-4">
                                        <p>Following documents need to be provided:</p>
                                        <ul style="list-style-type: circle;margin-left: 50px;">
                                            <li>
                                                <p class="mb-2">Valid Driving License</p>
                                            </li>
                                            <li>
                                                <p class="mb-2">Any one of the IDs - Aadhar | PAN | Passport</p>
                                            </li>                                
                                        </ul>
                                    </div>
                                    <div class="mb-4">
                                        <p>A ride can not commence until and unless required documents are submitted and verified. Cancellation policy will apply if proper documents are not uploaded for verification.</p>
                                    </div>
                                    <div class="mb-4">
                                        <label><input type="checkbox" id="agree_tc" class="form-checkbox me-2" checked>I agree terms & conditions</label>
                                    </div>
                                    <div class="mb-4">
                                        <label><input type="checkbox" id="agree_id" class="form-checkbox me-2" checked>I agree to provide valid ID & DL before the ride starts</label>
                                    </div>
                                    <div class="d-grid mt-2">
                                        <button type="button" class="payment_proceed btn btn-primary btn-lg">Proceed</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Terms and Conditions Modal -->
    <div class="modal fade" id="cancellation_terms_view">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content product_modal shadow">
                <div class="terms_view">
                    <div class="card w-100" style="max-width: 480px;">
                        <div class="card-body">
                            <div class="text-center">
                                <h1 class="card-title h3">Booking Cancellation Terms</h1>
                            </div>
                            <div class="mt-4">
                                <form id="cancellation_form" method="POST" action="<?=base_url('Cancelbooking')?>" class="cancellation-form">
                                    <input type="hidden" name="booking_id" value=""> 
                                    <div class="mb-4">
                                        <p>You are about to cancel your booking.</p>
                                        <ul style="list-style-type: circle;margin-left: 50px;">
                                            <li>
                                                <p class="mb-2">Cancellation will be charged with fee of 50% of the booking amount.</p>
                                            </li>                                
                                        </ul>
                                    </div>
                                    <div class="mb-4">
                                        <p>Please check our cancellation terms and conditions here <a class="text-primary" href="<?=base_url('Refund')?>">Terms</a>.</p>
                                    </div>
                                    <div class="mb-4">
                                        <label><input type="checkbox" id="agree_cc" class="form-checkbox me-2" checked>I agree terms & conditions</label>
                                    </div>
                                    <div class="d-grid mt-2">
                                        <button type="button" class="cancel_proceed btn btn-primary btn-lg">Proceed</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="lightbox">
        
      <div class="box">
        <a href="#" class="close">X</a>
          <div class="offer_image">
            <img style="height:100%;width: 100%;" src="<?=base_url('assets/images/offer.jpeg')?>" class="img-fluid">
          </div>
          <div class="offer_expiry bg-warning">
            <h2>Before you go!</h2>
            <div class="offer_code">
                COUPON: <span class="cc_code">STAY50</span>
            </div>
            <p class="text-white m-2">50% OFF on All Rentals.</p>
            <p class="text-white m-2">Offer Expires in </p>
            <p class="offer_timer">10:00 MINUTES</p>
          </div>
      </div>
    </div>

    <!--scrolltop button-->
    <button class="theme-scrolltop-btn text-dark"><i class="fa fa-angle-up"></i></button>
    <!--scrolltop button end-->

    <!--build:js-->
    <script src="<?=base_url()?>assets/js/vendors/jquery-ui.min.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/appear.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/popper.min.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/easing.min.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/swiper.min.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/massonry.min.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/bootstrap-slider.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/magnific-popup.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/waypoints.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/counterup.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/isotop.pkgd.min.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/moment.min.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/date-picker.min.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/progressbar.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/slick.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/countdown.min.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/custom-scrollbar.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/price-range.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/image-rotate.min.js"></script>
    <script src="<?=base_url()?>assets/js/vendors/typeit.js"></script>
    <script src="<?=base_url()?>assets/js/app.js"></script>
    <script src="<?=base_url()?>assets/js/auth.js"></script>
    
    <script type="text/javascript">

        $(document).ready(function(){

            $('body').on('mouseover','.infoicon',function(){
               $(".tooltiptext").slideDown();
            });

            $('body').on('mouseleave','.infoicon',function(){
               $(".tooltiptext").slideUp();
            });
        });
    </script>
</body>
</html>