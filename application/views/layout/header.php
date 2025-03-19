<!DOCTYPE html>
<html lang="en">
<head>
    <!--required meta tags-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--twitter og-->
    <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="@Rocknrollrentals">
        <meta name="twitter:title" content="Rent bikes in Chikmagalur!">
        <meta name="twitter:description" content="Get a well maintained bike from the most trusted bike rentals in Chikmagalur!">
        <meta name="twitter:image:src" content="<?=base_url()?>/logo/logo2.png">
        <!-- Twitter Card data end -->

    <!--facebook og-->
     <meta property="og:title" content="Rent bikes in Chikmagalur!"/>
        <meta property="og:type" content="website" />
        <meta property="og:url" content="http://www.rocknrollrental.com/bike-rentals" />
        <meta property="og:image" content="<?=base_url()?>/logo/logo2.png" />
        <meta property="og:description" content="Get a well maintained bike from the most trusted bike rentals in Chikmagalur! " />
        <meta property="og:image:width" content="400px">
        <meta property="og:image:height" content="400px">

    <!--meta-->
    <meta name="description" content="We are RTO authorized bike rental company in Chikmagalur and we are the first company in Chikmagalur to hold the rental boards on the bike. Rock n Roll Rentals provides more option for visitors to explore new places on two wheels without the hassle of owning a vehicle">
	<meta name="keywords" content="Bike Rentals, Bikes in Chikmagalur, Bike rentals in Chikmagalur, Rent bikes in Chikmagalur, Rental Bikes, Chikmagalur BIke Rentals, RockNRoll, Rock N Roll Rentals, Rock N Roll Bikes">
    <meta name="turbolinks-cache-control" content="no-cache">
    <meta name="robots" content="noydir" />
    <meta name="robots" content="noodp" />
    <link rel="icon" href='logo/favicon-16x16.png' type="image/png" sizes="16x16">
    <link rel="canonical" href="http://www.rocknrollrental.com/bike-rentals" />
    <link rel="apple-touch-icon" href="<?=base_url()?>/logo/apple-touch-icon.png" />
    <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
    <!--favicon icon-->
    <link rel="icon" href="<?=base_url()?>/logo/favicon.ico" type="image/png" sizes="16x16" />

    <!--title-->
    <title><?=$page_title?></title>
    <!--build:css-->
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/main.css" />
    <!-- endbuild -->
    <!--custom css-->
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/custom.css" />
    <script src="<?=base_url()?>assets/js/vendors/jquery.min.js"></script>
    
</head>
<body>

    <div class="ring-preloader w-100 h-100 position-fixed start-0 top-0">
        <div class="lds-dual-ring"></div>
    </div>

    <!--main content wrapper start-->
    <div class="main-wrapper">

        <!--header area start-->
        <header class="rent-header position-relative z-2 header-sticky">
            <div class="rent-header-info position-relative z-2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-9 col-lg-4 col-6">
                            <div class="rent-hero-info-left d-flex align-items-center justify-content-between">
                                <div class="tp-info-wrapper d-flex align-items-center">
                                    <div class="d-none tp-info d-xl-inline-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                          <i class="flaticon-location"></i>
                                      </span>
                                        <p class="mb-0">Chikmagalur, Karnataka 577001</p>
                                    </div>
                                    <div class="tp-info d-inline-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                          <i class="flaticon-phone-call"></i>
                                      </span>
                                        <p class="mb-0"><a class="text-dark" href="tel:9980318883">+91-9980318883</a></p>
                                    </div>
                                    <div class="d-none tp-info d-xl-inline-flex align-items-center">
                                        <span class="icon-wrapper me-2">
                                          <i class="flaticon-email"></i>
                                      </span>
                                        <p class="mb-0"><a class="text-dark" href="mail:info@rocknrollrentals.com">info@rocknrollrental.com</a></p>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-8 col-6">
                            <div class="rent-info-social text-end d-none d-sm-block">
                                <span class="text-white fw-500">Follow on</span>
                                <a href="#"><i class="fa fa-facebook-f"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="at_header_nav position-relative z-1">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-6 col-lg-3">
                            <div class="logo-wrapper d-flex">
                                <a href="<?=base_url()?>"><img style="width:90px" src="<?=base_url()?>/logo/logo2.png" alt="logo"></a>
                                <div class="d-inline m-1 p-1">
                                    <span class="h5 w-100 mt-1 text-center d-block">ROCK N ROLL</span>
                                    <span style="border-top: 2px dashed black;" class="h5 pt-1 d-block w-100 text-center">RENTALS</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-9">
                            <div class="at_header_right d-flex align-items-center justify-content-end">
                                <nav class="at_nav_menu d-none d-lg-block">
                                    <ul>
                                        <li><a class="text-dark" href="<?=base_url()?>">Home</a></li>
                                        <li><a class="text-dark" href="<?=base_url('About')?>">About Us</a></li>
                                        <li><a class="text-dark" href="<?=base_url('Tariff')?>">Tariff</a></li> 
                                        <li><a class="text-dark" href="<?=base_url('Bookaride')?>">Book a Ride</a></li> 
                                        <li><a class="text-dark" href="<?=base_url('Contact')?>">Contact Us</a></li>  

                                        <?php if( isset($user) && isset($user['Authorization']) && $user['Authorization'] == true ){?>

                                        <li class="has-submenu"><a href="javascript:void(0)" class="p-2 d-lg-inline-block"><img class="me-2" src="<?=base_url()?>assets/images/motorcyclist.png"><span class="text-dark fw-bold"><?=$user['name']?></span></a>
                                            <ul class="submenu-wrapper">
                                                <li><a href="<?=base_url('Cart')?>"><i class="fa fa-shopping-basket me-2"></i>Cart</a></li>
                                                <li><a href="<?=base_url('Account')?>"><i class="fa fa-gear me-2"></i>Account</a></li>
                                                <li><a href="<?=base_url('/Auth/signoff')?>"><i class="fa fa-sign-out-alt me-2"></i>Logout</a></li>
                                            </ul>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </nav>
                                
                                <div class="apt_header_search dropdown ms-4">
                                    <?php if( !isset($user) || !isset($user['Authorization']) || ( isset($user['Authorization']) && $user['Authorization'] == false) ) { ?>
                                        <a href="javascript:void(0)" class="btn header-white-btn d-none d-lg-inline-block me-3" data-bs-toggle="modal" data-bs-target="#login_form">Login/Sign Up</a>       
                                    <?php } ?>             
                                </div>
                                <button class="ofcanvus-toggle header-toggle-btn ms-4 d-none d-lg-block">
                                    <i class="fa fa-bars-staggered"></i>
                                </button>
                                <button class="mobile-menu-toggle header-toggle-btn ms-4 d-lg-none">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--header area end-->

        <!--mobile menu start-->
        <div class="mobile-menu position-fixed bg-white deep-shadow">
            <button class="close-menu position-absolute"><i class="fa fa-xmark"></i></button>
            <a href="<?=base_url()?>" class="logo-wrapper d-block mt-4 p-3 rounded-1 text-center"><img src="<?=base_url()?>logo/logo2.png" alt="logo" class="img-fluid"></a>
            <nav class="mobile-menu-wrapper mt-40">
                <ul>
                    <li><a href="<?=base_url()?>">Home</a></li>
                    <li><a href="<?=base_url('About')?>">About Us</a></li>
                    <li><a href="<?=base_url('Tariff')?>">Tariff</a></li>  
                    <li><a href="<?=base_url('Bookaride')?>">Book a Ride</a></li>
                    <li><a href="<?=base_url('Contact')?>">Contact Us</a></li>  
                    <?php if( isset($user) && isset($user['Authorization']) && $user['Authorization'] == true ){?>
                    <li class="has-submenu"><a href="javascript:void(0)" class="p-2 d-lg-inline-block"><img class="me-2" src="<?=base_url()?>assets/images/motorcyclist.png"><span class="text-dark fw-bold"><?=$user['name']?></span></a>
                        <ul class="submenu-wrapper">
                            <li><a href="<?=base_url('Cart')?>"><i class="fa fa-shopping-basket me-2"></i>Cart</a></li>
                            <li><a href="<?=base_url('Account')?>"><i class="fa fa-gear me-2"></i>Account</a></li>
                            <li><a href="<?=base_url('/Auth/signoff')?>"><i class="fa fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </nav>
            <div class="contact-info mt-60">
                <h4 class="mb-20">Contact Info</h4>
                <p>Chikmagalur, Karnataka 577001</p>
                <p>+91-9980318883</p>
                <p>info@rocknrollrental.com</p>
                <div class="social-contact">
                    <a href="#"><i class="fa fa-facebook-f"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <!--mobile menu end-->

        <!--ofcanvus menu start-->
        <div class="at_offcanvus_menu position-fixed">
            <button class="at-offcanvus-close"><i class="fa fa-xmark"></i></button>
            <a href="#" class="logo-wrapper d-inline-block mb-5"><img style="width:190px;" src="<?=base_url()?>/logo/logo2.png" alt="logo"></a>
            <div class="offcanvus-content">
                <h4 class="mb-4">About Us</h4>
                <p>A hassle-free and simple bike rental company. We remain loyal to our customers by making it easy to rent a bike. We have a wide range of scooters & bikes available to rent and move on.</p>
                <p>Rock N Roll, the first in town and RTO authorized bike rental firm in Chikmagaluru. We offer affordable riding experience for our travelers to discover places in and around the town with ease</p>
                <a href="#" class="btn btn-primary mt-4">About Us</a>
            </div>
            <div class="offcanvus-contact">
                <h4 class="mb-4 mt-5">Contact Info</h4>
                <ul class="at_canvus_address">
                    <li>Chikmagalur, Karnataka 577001</li>
                    <li>+91-9980318883</li>
                    <li>info@rocknrollrental.com</li>
                </ul>
            </div>
            <div class="at_canvus_social mt-4">
                <a href="#" class="social-btn"><i class="fa fa-facebook-f"></i></a>
                <a href="#" class="social-btn"><i class="fa fa-instagram"></i></a>
                <a href="#" class="social-btn"><i class="fa fa-twitter"></i></a>
                <a href="#" class="social-btn"><i class="fa fa-youtube"></i></a>
            </div>
        </div>
        <!--ofcanvus menu end-->