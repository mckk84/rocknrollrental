<?php
    $social = getSocial(); 
    ?>
<!--hero section start-->
<section class="moto-rent-hero position-relative z-1 bg-texture-gradient" data-background="<?=base_url()?>/assets/img/shapes/texture-bg.png">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-sm-12 px-4 py-4 ">
                <form method="POST" action="<?=base_url('Bookaride')?>" class="row d-flex align-items-center bg-white rounded mx-4 my-4">
                    <div class="col-xl-12 mt-4 px-4 pt-4">
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <label class="text-dark mb-2">Pickup date</label>
                                <input type="text" name="pickup_date" id="pickup_date" class="theme-date-input text-dark border w-100 rounded-2" placeholder="">
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <label class="text-dark mb-2">Time</label>
                                <select id="pickup_time" name="pickup_time" class="form-select">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 mt-4 px-4 pt-4">
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <label class="text-dark mb-2">Dropping off date</label>
                                <input type="text" name="dropoff_date" id="dropoff_date" class="theme-date-input text-dark border w-100 rounded-2" placeholder="">
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <label class="text-dark mb-2">Time</label>
                                <select id="dropoff_time" name="dropoff_time" class="form-select">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 mt-2 px-4 pt-2 mb-4">
                        <div class="text-end">
                            <button class="btn btn-primary" type="submit">Search Now</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="d-none d-xl-block col-xl-6 overflow-hidden">
                <div class="w-100 hero-bike-slider position-relative z-5 swiper">
                    <div class="swiper-wrapper">
                        <div class="hero-bike-single position-relative swiper-slide">
                            <img src="bikes/bg/honda_activa_6g.png" alt="bike" class="img-fluid">
                            <span class="slide-index text-dark position-absolute fw-bold">Honda Activa</span>
                        </div>
                        <div class="hero-bike-single position-relative swiper-slide">
                            <img src="bikes/bg/honda_dio.png" alt="bike" class="img-fluid">
                            <span class="slide-index text-dark position-absolute fw-bold">Honda Dio</span>
                        </div>
                        <div class="hero-bike-single position-relative swiper-slide">
                            <img src="bikes/bg/fascino.png" alt="bike" class="img-fluid">
                            <span class="slide-index text-dark position-absolute fw-bold">Yahama Fascino</span>
                        </div>
                        <div class="hero-bike-single position-relative swiper-slide">
                            <img src="bikes/bg/royal_enfield_classic_350.png" alt="bike" class="img-fluid">
                            <span class="slide-index text-dark position-absolute fw-bold">Royal Enfield Clasic 350</span>
                        </div>
                        <div class="hero-bike-single position-relative swiper-slide">
                            <img src="bikes/bg/bajaj_pulsar_150.png" alt="bike" class="img-fluid">
                            <span class="slide-index text-dark position-absolute fw-bold">Bajaj Pulsar 150</span>
                        </div>
                        <div class="hero-bike-single position-relative swiper-slide">
                            <img src="bikes/bg/1823744792.png" alt="bike" class="img-fluid">
                            <span class="slide-index text-dark position-absolute fw-bold">Bajaj Pulsar 220</span>
                        </div>
                        <div class="hero-bike-single position-relative swiper-slide">
                            <img src="bikes/bg/bajaj_avenger_220.png" alt="bike" class="img-fluid">
                            <span class="slide-index text-dark position-absolute fw-bold">Bajaj Avenger</span>
                        </div>
                    </div>
                    <div class="bike-slider-pagination"></div>
                    <div class="bike-pagination-text">
                        <span>Honda Activa</span>
                        <span>Bajaj Avenger</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="at-header-social md-header-social d-none d-md-flex align-items-center position-absolute">
        <span class="title">Follow on</span>
        <ul class="social-list ms-3">
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
    <img src="<?=base_url()?>/assets/img/shapes/texture-bg-yellow.jpg" alt="texture yellow" class="position-absolute texture-yellow z-1 d-none d-xl-block">
    <img src="<?=base_url()?>/assets/img/shapes/wave-yellow.png" alt="wave" class="position-absolute wave-shape z-2">
</section>

<!--about section start-->
<section class="h3-about-section ptb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="at-section-title text-center">
                    <h2 class="h1 mt-2 mb-4">Why Choose <mark class="p-0 bg-transparent text-md-primary">Rock N Roll Rentals</mark></h2>
                    <p class="fw-500 mb-0">We care about you</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4 g-4">
            <div class="col-xl-4 col-lg-6">
                <div class="h2-about-item-box bg-white rounded position-relative z-1">
                    <span class="icon-bg position-absolute z--1"><img src="<?=base_url()?>/assets/img/icons/pointer-bg.svg" alt="bg-icon"></span>
                    <span class="icon-wrapper d-flex align-items-center justify-content-center rounded-circle bg-green">
                      <img src="<?=base_url()?>/assets/img/icons/pointer.svg" alt="not found" class="img-fluid">
                  </span>
                    <h4 class="mb-4 mt-20">Easy & Fast Booking</h4>
                    <p class="mb-0">Completely online booking process.</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="h2-about-item-box bg-white rounded position-relative z-1">
                    <span class="icon-bg position-absolute z--1"><img src="<?=base_url()?>/assets/img/icons/pin-bg.svg" alt="bg-icon"></span>
                    <span class="icon-wrapper d-flex align-items-center justify-content-center rounded-circle bg-primary">
                      <img src="<?=base_url()?>/assets/img/icons/pin.svg" alt="not found" class="img-fluid">
                  </span>
                    <h4 class="mb-4 mt-20">Instant Pickup</h4>
                    <p class="mb-0">We make sure your ride is available on time.</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="h2-about-item-box bg-white rounded position-relative z-1">
                    <span class="icon-bg position-absolute z--1"><img src="<?=base_url()?>/assets/img/icons/comment-bg.svg" alt="bg-icon"></span>
                    <span class="icon-wrapper d-flex align-items-center justify-content-center rounded-circle bg-blue">
                      <img src="<?=base_url()?>/assets/img/icons/comment.svg" alt="not found" class="img-fluid">
                  </span>
                    <h4 class="mb-4 mt-20">Customer Satisfaction</h4>
                    <p class="mb-0">24/7 customer support.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--about section end-->

<?php if( isset($bikes) && count($bikes) > 0 ) {?>
<!--latest collection start-->
<section class="latest-collection pt-10 pb-60">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6">
                <div class="at-section-title text-center text-lg-start">
                    <span class="at-subtitle position-relative lead text-primary">Our <mark class="p-0 bg-transparent text-dark">Fleet</mark></span>
                    <h2 class="h1 mt-2 mb-0">Find the Best Ride</h2>
                </div>
            </div>
            <div class="col-lg-6 align-self-end">
            </div>
        </div>
        <div class="filter-items-wrapper mt-5">
            <div class="row g-4 justify-content-center filter-grid">
                <?php foreach($bikes as $bike){ ?>
                <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-12 latest">
                    <div class="filter-card-item position-relative overflow-hidden rounded bg-white">
                        <div class="feature-thumb position-relative overflow-hidden">
                            <img src="<?=base_url('bikes/'.$bike['image'])?>" alt="<?=$bike['bike_type_name']?>" class="img-fluid">
                        </div>
                        <div class="filter-card-content">
                            <div class="mt-4 d-block">
                                <h5><?=$bike['bike_type_name']?></h5>
                            </div>
                            <span class="meta-content"><strong class="text-primary">UNLIMITED KILOMETERS</strong></span>
                            <hr class="spacer mt-3 mb-3">
                            <div class="card-feature-box d-flex align-items-center mb-4">
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><svg width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M21.4886 4.85227H19.4091C19.0258 4.85227 18.7159 5.16282 18.7159 5.54545V6.23864H18.0227V5.54545C18.0227 5.16282 17.7129 4.85227 17.3295 4.85227H16.2302L14.3544 2.97652C14.2906 2.91206 14.2137 2.86145 14.1284 2.8261C14.0439 2.79144 13.9537 2.77273 13.8636 2.77273H11.7841V1.38636H13.1705C13.5538 1.38636 13.8636 1.07582 13.8636 0.693182C13.8636 0.310545 13.5538 0 13.1705 0H6.93182C6.54849 0 6.23864 0.310545 6.23864 0.693182C6.23864 1.07582 6.54849 1.38636 6.93182 1.38636H8.31818V2.77273H6.23864C6.21645 2.77273 6.19774 2.78312 6.17625 2.7852C6.12634 2.79006 6.0799 2.79907 6.03276 2.81432C5.99186 2.82749 5.95443 2.84205 5.917 2.86215C5.87818 2.88294 5.84283 2.9072 5.80748 2.93562C5.77074 2.96612 5.73885 2.99801 5.70905 3.03475C5.69449 3.05208 5.67508 3.06248 5.66191 3.08189L4.48142 4.85227H2.77273C2.3894 4.85227 2.07955 5.16282 2.07955 5.54545V7.625H1.38636V5.54545C1.38636 5.16282 1.07651 4.85227 0.693182 4.85227C0.309852 4.85227 0 5.16282 0 5.54545V11.7841C0 12.1667 0.309852 12.4773 0.693182 12.4773C1.07651 12.4773 1.38636 12.1667 1.38636 11.7841V9.01136H2.07955V11.7841C2.07955 12.1667 2.3894 12.4773 2.77273 12.4773H4.42389L5.61893 14.8667C5.65151 14.9318 5.69449 14.9887 5.74301 15.0386C5.75272 15.049 5.76519 15.0559 5.77559 15.0649C5.82481 15.11 5.87957 15.146 5.93918 15.1751C5.95928 15.1848 5.97939 15.1939 6.00087 15.2015C6.07643 15.2299 6.15545 15.2493 6.23725 15.25C6.23794 15.25 6.23794 15.25 6.23864 15.25H14.5568C14.658 15.25 14.753 15.2257 14.8396 15.1869C14.8625 15.1765 14.8798 15.1578 14.9013 15.1453C14.9644 15.1079 15.0226 15.0663 15.0712 15.0115C15.0788 15.0025 15.0906 14.9998 15.0982 14.9901L17.663 11.7841H18.7159V12.4773C18.7159 12.8599 19.0258 13.1705 19.4091 13.1705H21.4886C21.872 13.1705 22.1818 12.8599 22.1818 12.4773V5.54545C22.1818 5.16282 21.872 4.85227 21.4886 4.85227ZM20.7955 11.7841H20.1023V11.0909C20.1023 10.7083 19.7924 10.3977 19.4091 10.3977H17.3295C17.3164 10.3977 17.3053 10.4047 17.2921 10.4054C17.245 10.4081 17.2006 10.4206 17.1549 10.4331C17.1119 10.4449 17.0696 10.4532 17.0301 10.4719C16.994 10.4892 16.9635 10.5156 16.9303 10.5391C16.8901 10.5683 16.8506 10.596 16.8173 10.6334C16.8083 10.6431 16.7965 10.6473 16.7882 10.6577L14.2234 13.8636H6.66702L5.47198 11.4742C5.45673 11.4437 5.43039 11.4236 5.41098 11.3959C5.38186 11.3543 5.35622 11.3127 5.31878 11.2781C5.28551 11.2476 5.24739 11.2275 5.20926 11.2046C5.17183 11.181 5.13717 11.1561 5.09489 11.1401C5.04706 11.1221 4.99645 11.1173 4.94516 11.1096C4.91397 11.1055 4.88555 11.0909 4.85227 11.0909H3.46591V6.23864H4.85227H4.85297C4.93545 6.23864 5.01586 6.21923 5.09281 6.19011C5.10806 6.18457 5.12331 6.17972 5.13856 6.17278C5.20857 6.1409 5.27303 6.09861 5.32987 6.04385C5.34097 6.03345 5.34928 6.02098 5.35968 6.00989C5.38325 5.98424 5.4089 5.95998 5.42831 5.93017L6.60949 4.15909H9.01136C9.39469 4.15909 9.70455 3.84855 9.70455 3.46591V1.38636H10.3977V3.46591C10.3977 3.84855 10.7076 4.15909 11.0909 4.15909H13.5767L15.4524 6.03484C15.5162 6.09931 15.5931 6.14991 15.6784 6.18526C15.763 6.21992 15.8531 6.23864 15.9432 6.23864H16.6364V6.93182C16.6364 7.31445 16.9462 7.625 17.3295 7.625H19.4091C19.7924 7.625 20.1023 7.31445 20.1023 6.93182V6.23864H20.7955V11.7841Z" fill="#99CF8F"></path>
                                                    <path d="M13.5585 6.35746C13.2403 6.14257 12.8105 6.22645 12.5956 6.54323L9.72588 10.7848L8.04768 9.48995C7.74338 9.25565 7.30944 9.3125 7.07584 9.61542C6.84224 9.91834 6.89839 10.3537 7.20131 10.5873L9.46385 12.3327C9.58585 12.4277 9.73489 12.4776 9.88739 12.4776C9.92413 12.4776 9.96017 12.4748 9.9976 12.4686C10.1861 12.4381 10.3546 12.3313 10.4613 12.1726L13.7442 7.32029C13.9591 7.00281 13.8753 6.57235 13.5585 6.35746Z" fill="#99CF8F"></path>
                                                </svg></span>
                                    <?=$bike['cc']?>
                                </div>
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><svg width="21" height="17" viewBox="0 0 21 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.4372 15.1074H8.49606C8.15738 15.1074 7.88281 15.382 7.88281 15.7207C7.88281 16.0593 8.15738 16.3339 8.49606 16.3339H12.4372C12.7758 16.3339 13.0504 16.0593 13.0504 15.7207C13.0504 15.382 12.7758 15.1074 12.4372 15.1074Z" fill="#99CF8F"></path>
                                                    <path d="M12.1901 11.3227C12.3188 11.0643 12.3917 10.7731 12.3917 10.4648C12.3917 9.40095 11.5292 8.53848 10.4653 8.53848C10.1569 8.53848 9.8657 8.61133 9.60728 8.74016L6.71874 5.85149C6.47929 5.612 6.09099 5.612 5.85149 5.85149C5.612 6.09094 5.612 6.47921 5.85149 6.71874L8.74024 9.60761C8.61166 9.86583 8.53897 10.1568 8.53897 10.4648C8.53897 11.5287 9.40144 12.3912 10.4653 12.3912C10.7735 12.3912 11.0645 12.3185 11.3227 12.1899L12.0022 12.8694C12.2417 13.1089 12.63 13.109 12.8695 12.8695C13.109 12.6301 13.109 12.2418 12.8695 12.0023L12.1901 11.3227ZM10.4653 11.1647C10.0794 11.1647 9.76542 10.8508 9.76542 10.4649C9.76542 10.079 10.0794 9.76501 10.4653 9.76501C10.8512 9.76501 11.1652 10.079 11.1652 10.4649C11.1652 10.8508 10.8512 11.1647 10.4653 11.1647Z" fill="#99CF8F"></path>
                                                    <path d="M10.466 0C4.69503 0 0 4.69503 0 10.466C0 12.3053 0.484953 14.1151 1.40249 15.6997C1.57199 15.9924 1.94656 16.0926 2.23952 15.9236C2.23965 15.9235 3.94642 14.9382 3.94642 14.9382C4.23972 14.7689 4.34021 14.3939 4.17087 14.1005C4.00153 13.8073 3.62656 13.7066 3.33318 13.8761L2.17489 14.5448C1.64284 13.4647 1.32784 12.2854 1.24766 11.0793H2.5838C2.92247 11.0793 3.19704 10.8047 3.19704 10.4661C3.19704 10.1274 2.92247 9.85282 2.5838 9.85282H1.24734C1.32878 8.61627 1.65441 7.44551 2.17665 6.38828L3.33322 7.05602C3.6266 7.22548 4.00166 7.12486 4.17091 6.83157C4.34025 6.53824 4.23976 6.16318 3.94647 5.99388L2.79132 5.32692C3.46364 4.32619 4.32623 3.4636 5.32696 2.79128L5.99384 3.9463C6.16318 4.23964 6.53824 4.34021 6.83153 4.17075C7.12482 4.00137 7.22531 3.62635 7.05598 3.33306L6.38828 2.1766C7.44551 1.65441 8.61631 1.32898 9.85278 1.24742V2.58384C9.85278 2.92251 10.1273 3.19708 10.466 3.19708C10.8047 3.19708 11.0793 2.92251 11.0793 2.58384V1.24742C12.3157 1.32898 13.4865 1.65445 14.5438 2.1766L13.8761 3.33306C13.7067 3.62635 13.8072 4.00141 14.1005 4.17075C14.3938 4.34021 14.7689 4.23964 14.9382 3.9463L15.6051 2.79128C16.6058 3.46356 17.4684 4.32615 18.1407 5.32692L16.9856 5.9938C16.6923 6.16314 16.5918 6.53815 16.7612 6.83149C16.9305 7.12478 17.3055 7.2254 17.5989 7.05594L18.7554 6.3882C19.2776 7.44543 19.6033 8.61619 19.6847 9.85273H18.3482C18.0096 9.85273 17.735 10.1273 17.735 10.466C17.735 10.8047 18.0096 11.0792 18.3482 11.0792H19.6844C19.6042 12.2853 19.2892 13.4646 18.7571 14.5447L17.5989 13.876C17.3055 13.7066 16.9305 13.8072 16.7612 14.1005C16.5918 14.3938 16.6923 14.7689 16.9856 14.9382C16.9856 14.9382 18.6924 15.9234 18.6925 15.9235C18.9855 16.0925 19.3601 15.9924 19.5296 15.6996C20.4471 14.1151 20.932 12.3054 20.932 10.466C20.932 4.69503 16.237 0 10.466 0Z" fill="#99CF8F"></path>
                                                </svg></span>
                                    <?=$bike['milage']?>
                                </div>
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1337 0.00012207C17.4399 0.00012207 18.5 1.06021 18.5 2.3664C18.5 3.67259 17.4399 4.73268 16.1337 4.73268C14.8275 4.73268 13.7674 3.67259 13.7674 2.3664C13.7674 1.06021 14.8275 0.00012207 16.1337 0.00012207ZM16.1337 1.29082C15.54 1.29082 15.0581 1.77268 15.0581 2.3664C15.0581 2.96012 15.54 3.44198 16.1337 3.44198C16.7274 3.44198 17.2093 2.96012 17.2093 2.3664C17.2093 1.77268 16.7274 1.29082 16.1337 1.29082Z" fill="#99CF8F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1337 12.047C17.4399 12.047 18.5 13.1071 18.5 14.4133C18.5 15.7195 17.4399 16.7796 16.1337 16.7796C14.8275 16.7796 13.7674 15.7195 13.7674 14.4133C13.7674 13.1071 14.8275 12.047 16.1337 12.047ZM16.1337 13.3377C15.54 13.3377 15.0581 13.8196 15.0581 14.4133C15.0581 15.007 15.54 15.4889 16.1337 15.4889C16.7274 15.4889 17.2093 15.007 17.2093 14.4133C17.2093 13.8196 16.7274 13.3377 16.1337 13.3377Z" fill="#99CF8F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.25091 0.00012207C10.5571 0.00012207 11.6172 1.06021 11.6172 2.3664C11.6172 3.67259 10.5571 4.73268 9.25091 4.73268C7.94472 4.73268 6.88463 3.67259 6.88463 2.3664C6.88463 1.06021 7.94472 0.00012207 9.25091 0.00012207ZM9.25091 1.29082C8.65719 1.29082 8.17533 1.77268 8.17533 2.3664C8.17533 2.96012 8.65719 3.44198 9.25091 3.44198C9.84463 3.44198 10.3265 2.96012 10.3265 2.3664C10.3265 1.77268 9.84463 1.29082 9.25091 1.29082Z" fill="#99CF8F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.25091 12.047C10.5571 12.047 11.6172 13.1071 11.6172 14.4133C11.6172 15.7195 10.5571 16.7796 9.25091 16.7796C7.94472 16.7796 6.88463 15.7195 6.88463 14.4133C6.88463 13.1071 7.94472 12.047 9.25091 12.047ZM9.25091 13.3377C8.65719 13.3377 8.17533 13.8196 8.17533 14.4133C8.17533 15.007 8.65719 15.4889 9.25091 15.4889C9.84463 15.4889 10.3265 15.007 10.3265 14.4133C10.3265 13.8196 9.84463 13.3377 9.25091 13.3377Z" fill="#99CF8F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.36614 0.000244141C3.67233 0.000244141 4.73242 1.06034 4.73242 2.36652C4.73242 3.67271 3.67233 4.7328 2.36614 4.7328C1.05996 4.7328 -0.000135422 3.67271 -0.000135422 2.36652C-0.000135422 1.06034 1.05996 0.000244141 2.36614 0.000244141ZM2.36614 1.29094C1.77242 1.29094 1.29056 1.7728 1.29056 2.36652C1.29056 2.96024 1.77242 3.4421 2.36614 3.4421C2.95986 3.4421 3.44172 2.96024 3.44172 2.36652C3.44172 1.7728 2.95986 1.29094 2.36614 1.29094Z" fill="#99CF8F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.36614 12.047C3.67233 12.047 4.73242 13.1071 4.73242 14.4133C4.73242 15.7195 3.67233 16.7796 2.36614 16.7796C1.05996 16.7796 -0.000135422 15.7195 -0.000135422 14.4133C-0.000135422 13.1071 1.05996 12.047 2.36614 12.047ZM2.36614 13.3377C1.77242 13.3377 1.29056 13.8196 1.29056 14.4133C1.29056 15.007 1.77242 15.4889 2.36614 15.4889C2.95986 15.4889 3.44172 15.007 3.44172 14.4133C3.44172 13.8196 2.95986 13.3377 2.36614 13.3377Z" fill="#99CF8F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.7793 4.08785V12.6925C16.7793 13.0487 16.4902 13.3379 16.1339 13.3379C15.7777 13.3379 15.4886 13.0487 15.4886 12.6925V4.08785C15.4886 3.73162 15.7777 3.4425 16.1339 3.4425C16.4902 3.4425 16.7793 3.73162 16.7793 4.08785Z" fill="#99CF8F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.89453 4.08785V12.6925C9.89453 13.0487 9.60542 13.3379 9.24918 13.3379C8.89295 13.3379 8.60383 13.0487 8.60383 12.6925V4.08785C8.60383 3.73162 8.89295 3.4425 9.24918 3.4425C9.60542 3.4425 9.89453 3.73162 9.89453 4.08785Z" fill="#99CF8F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.01186 4.08785V7.52971C3.01186 7.64846 3.10823 7.74483 3.22697 7.74483H16.1339C16.4902 7.74483 16.7793 8.03395 16.7793 8.39018C16.7793 8.74641 16.4902 9.03553 16.1339 9.03553H3.22697C2.3949 9.03553 1.72116 8.36092 1.72116 7.52971C1.72116 6.2743 1.72116 4.08785 1.72116 4.08785C1.72116 3.73162 2.01028 3.4425 2.36651 3.4425C2.72274 3.4425 3.01186 3.73162 3.01186 4.08785Z" fill="#99CF8F"></path>
                                                </svg></span>
                                    <?=$bike['power']?>
                                </div>
                            </div>
                            <a href="javascript:void(0)" data-bikeimage="<?=base_url('bikes/'.$bike['image'])?>" data-bikeid="<?=$bike['bike_type_id']?>" data-bikeprice="<?=$bike['week_day_half_price']?>" data-bikename="<?=$bike['bike_type_name']?>" class="customize btn outline-btn btn-sm d-block">Customize</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!--latest collection end-->
<?php } ?>

<!--staff area start-->
<section class="staff-area ptb-60 bg-md-primary">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-xl-6 col-lg-7">
                <div class="title-style-2 text-center">
                    <span class="subtitle lead text-secondary">Our Plan Includes</span>
                </div>
            </div>
        </div>
        <div class="staff-list mt-4">
            <div class="ct-row d-flex align-items-center justify-content-center flex-wrap">
                <div class="col-xl-1 col-sm-3 col-md-3  single-icon text-center">
                    <img src="assets/img/icons/helmet.svg" alt="staff" class="img-fluid">
                    <span class="mb-1 mt-2">Helmets</span>
                </div>
            
                <div class="col-xl-1 col-sm-3 col-md-3 single-icon text-center">
                    <img src="assets/img/icons/assistance.svg" alt="staff" class="img-fluid">
                    <span class="mb-1 mt-2">Assistance</span>
                </div>
            
                <div class="col-xl-1 col-sm-3 col-md-3 single-icon text-center">
                    <img src="assets/img/icons/insurance.svg" alt="staff" class="img-fluid">
                    <span class="mb-1 mt-2">Insurance</span>
                </div>
            
                <div class="col-xl-1 col-sm-3 col-md-3 single-icon text-center">
                    <img src="assets/img/icons/cancellation.svg" alt="staff" class="img-fluid">
                    <span class="mb-1 mt-2">Cancellation</span>
                </div>
            
                <div class="col-xl-1 col-sm-3 col-md-3 single-icon text-center">
                    <img src="assets/img/icons/discount.svg" alt="staff" class="img-fluid">
                    <span class="mb-1 mt-2">Discounts</span>
                </div>
            
                <div class="col-xl-1 col-sm-3 col-md-3 single-icon text-center">
                    <img src="assets/img/icons/road-permit.svg" alt="staff" class="img-fluid">
                    <span class="mb-1 mt-2">State Permit</span>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!--staff area end-->

<!--about section start-->
<section class="about-section pt-60 pb-60 bg-primary-light position-relative z-1 overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/about-bg.jpg">
    <img src="<?=base_url()?>/assets/img/shapes/tire-primary-light.png" alt="tire" class="tire-primary-light position-absolute end-0 top-0 z--1">
    <span class="small-circle-shape position-absolute z--1"></span>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6">
                <div class="about-left position-relative z-1">
                    <span class="circle-large position-absolute z--1"></span>
                    <div class="at-section-title mb-20">
                        <span class="subtitle text-primary lead">Best <mark class="bg-transparent p-0">Services</mark></span>
                        <h2 class="h1 mt-2 mb-4"><mark class="p-0 bg-transparent text-md-primary">Rock N Roll</mark> Advantages</h2>
                    </div>
                    <img src="<?=base_url()?>/assets/images/advantages.jpg" alt="Bike" class="img-fluid rounded-5">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="about-right mt-5 mt-lg-0">
                    <div class="about-icon-box bg-white shadow rounded">
                        <div class="ab-icon-box-top d-flex align-items-center mb-3">
                            <span class="icon-wrapper d-flex align-items-center justify-content-center rounded"><i class="fa fa-shield"></i></span>
                            <h5 class="mb-0 ms-3">24/7 Customer Support</h5>
                        </div>
                        <p class="mb-0">Call us from anywhere anytime</p>
                    </div>
                    <div class="about-icon-box bg-white shadow rounded mt-20 ms-md-5">
                        <div class="ab-icon-box-top d-flex align-items-center mb-3">
                            <span class="icon-wrapper d-flex align-items-center justify-content-center rounded"><i class="fa fa-shield"></i></span>
                            <h5 class="mb-0 ms-3">Instant Pickup</h5>
                        </div>
                        <p class="mb-0">24/7 Online Reservation</p>
                    </div>
                    <div class="about-icon-box bg-white shadow rounded mt-20">
                        <div class="ab-icon-box-top d-flex align-items-center mb-3">
                            <span class="icon-wrapper d-flex align-items-center justify-content-center rounded"><i class="fa fa-price-tag"></i></span>
                            <h5 class="mb-0 ms-3">Unlimited Kilometers</h5>
                        </div>
                        <p class="mb-0">Terms & Conditions Apply</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--about section end-->

<!--countdown section start-->
<section class="h3-counter-section pt-60 pb-60 position-relative z-1 overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/texture-shape.png">
    <div class="overlay position-absolute start-0 top-0 bg-secondary-gradient z--1 w-100 h-100"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="title-style-2 text-center mb-5">
                    <span class="subtitle text-white lead">Interesting <mark class="bg-transparent text-primary p-0">Numbers</mark></span>
                    <h2 class="h1 text-white mt-20 mb-0">Fun Facts By The Numbers</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xxl-3 col-lg-4 col-sm-6">
                <div class="h3-counter-box bg-white rounded d-md-flex text-center text-md-start align-items-center position-relative">
                    <span class="icon-wrapper d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle flex-shrink-0">
                       <img src="<?=base_url()?>/assets/images/heart.png">
                  </span>
                    <div class="h3-counter-box-right mt-3 mt-md-0 ms-md-3">
                        <h3 class="mb-1"><span class="counter"><?=(isset($social['customers'])?$social['customers']:"2248")?></span><span>+</span></h3>
                        <span>Happy Customers</span>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-4 col-sm-6">
                <div class="h3-counter-box bg-white rounded d-md-flex text-center text-md-start align-items-center position-relative">
                    <span class="icon-wrapper d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle flex-shrink-0">
                      <img src="<?=base_url()?>/assets/images/motorcyclist.png">
                  </span>
                    <div class="h3-counter-box-right mt-3 mt-md-0 ms-md-3">
                        <h3 class="mb-1"><span class="counter"><?=(isset($social['fleets'])?$social['fleets']:"28")?></span><span>+</span></h3>
                        <span>FLEETS TO CHOOSE</span>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-4 col-sm-6">
                <div class="h3-counter-box bg-white rounded d-md-flex text-center text-md-start align-items-center position-relative">
                    <span class="icon-wrapper d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle flex-shrink-0">
                      <img src="<?=base_url()?>/assets/images/mileage.png">
                  </span>
                    <div class="h3-counter-box-right mt-3 mt-md-0 ms-md-3">
                        <h3 class="mb-1"><span class="counter"><?=(isset($social['total_kilometers'])?$social['total_kilometers']:"142140")?></span><span>+</span></h3>
                        <span>TOTAL KILOMETERS</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--countdown section end-->

<!--feedback section start-->
<section class="h2-feedback-section pb-60 bg-white" style="background-repeat: no-repeat;background-size: cover;" data-background="<?=base_url()?>/assets/images/bg.jpg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7">
                <div class="at-section-title text-center">
                    <span class="subtitle text-primary lead">Customer <mark class="bg-transparent p-0 text-dark">Feedback</mark></span>
                    <h2 class="h1 mt-3 mb-3">Our Happy Customers Saying</h2>
                </div>
            </div>
        </div>
        <div class="swiper h2-feedback-slider mt-5">
            <div class="swiper-wrapper">
                <?php if( is_array($reviews) && count($reviews) > 0) {
                    foreach($reviews as $review) {
                    ?>
                    <div class="h2-feedback-single swiper-slide">                            
                        <div class="h2-feedback-content mt-1 rounded position-relative">
                            <div class="feedback-top mt-1 d-flex align-items-center justify-content-center">
                                <img src="<?=$review->user_image?>" alt="client" class="rounded-circle mt-0 border border-2 border-white">
                            </div>
                            <p class="w-80 mx-auto text-white mt-3 mb-4"><?=$review->text?></p>
                            <div class="client-info text-center g-2">
                                <span class="star-rating rounded-pill"><span class="me-2"><i class="fa-solid fa-star"></i></span><?=$review->rating?></span>
                                <h6 class="mt-2 mb-1 text-white"><?=$review->author_name?></h6>          
                                <p class="text-white"><?=$review->relative_time_description?></p>                          
                            </div>
                        </div>
                    </div>
                <?php }
                } ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
<!--feedback section end-->

<script type="text/javascript">

$(document).ready(function(){

  function setTimeSpecial(ele, hour)
  {
    let start = hour;
    let len = 7 + 14 - hour;
    for (let i = 1; i <= len; i++) 
    {
      if( start == 7 )
      {
        let t = ( start < 10 ) ? "0"+start : start;
        let m = "30";
        let ap = "AM";
        ele.append($('<option>', {
            value: t+":"+m+" "+ap,
            text: t+":"+m+" "+ap
        }));
      }
      else
      {
        //console.log("start="+start);
        let t = ( start < 10 ) ? "0"+start : start;
        if( start > 12 )
        {
          t = start - 12;
          t = ( t < 10 ) ? "0"+t : t;
        }
        let m = "00";
        let ap = ( start >= 12 ) ? "PM" : "AM";
        ele.append($('<option>', {
            value: t+":"+m+" "+ap,
            text: t+":"+m+" "+ap
        }));

        if( start != 20 ){
          let mh = "30";
          ele.append($('<option>', {
              value: t+":"+mh+" "+ap,
              text: t+":"+mh+" "+ap
          }));
        }
      }      
      start = start + 1;
    }
  }
    
  function setTimeAll(ele)
  {
    let start = 7;
    for (let i = 1; i <= 14; i++) 
    {
      if( start == 7 )
      {
        let t = ( start < 10 ) ? "0"+start : start;
        let m = "30";
        let ap = "AM";
        ele.append($('<option>', {
            value: t+":"+m+" "+ap,
            text: t+":"+m+" "+ap
        }));
      }
      else
      {
        //console.log("start="+start);
        let t = ( start < 10 ) ? "0"+start : start;
        if( start > 12 )
        {
          t = start - 12;
          t = ( t < 10 ) ? "0"+t : t;
        }
        let m = "00";
        let ap = ( start >= 12 ) ? "PM" : "AM";
        ele.append($('<option>', {
            value: t+":"+m+" "+ap,
            text: t+":"+m+" "+ap
        }));

        if( start != 20 ){
          let mh = "30";
          ele.append($('<option>', {
              value: t+":"+mh+" "+ap,
              text: t+":"+mh+" "+ap
          }));
        }
      }      
      start = start + 1;
    }

  }

  function dateformatstring(this_date)
  {
    var dt = this_date.split('-');
    return dt[2]+"-"+dt[1]+"-"+dt[0];
  }

  function getdateformat(this_date)
  {
    var dt = this_date.getDate();
    var mt = this_date.getMonth();
    mt = mt + 1;
    var yt = this_date.getFullYear();
    if( mt < 10 ){
      mt = "0"+mt;
    }

    if( dt < 10 ){
      dt = "0"+dt;
    }
    return yt+"-"+mt+"-"+dt;
  }

  var today = new Date();
  var today_date = getdateformat(today);
  var hour = today.getHours();
  console.log("="+today_date);
  console.log(hour);
  hour = hour + 1;
  let pickupdate = today_date;

  if( hour >= 20 )
  {
    var date = new Date();
    date.setDate(date.getDate() + 1);
    today_date = getdateformat(date);
    console.log("Nextday="+today_date);
    // Settime
    setTimeAll($("#pickup_time"));
    $("#pickup_time option:first").attr('selected','selected');

    setTimeAll($("#dropoff_time"));
    $("#dropoff_time option:last").attr('selected','selected');
    $("#early_pickup_div").show();
  }
  else if( hour <= 7 )
  {
    setTimeAll($("#pickup_time"));
    $("#pickup_time option:first").attr('selected','selected');
    setTimeAll($("#dropoff_time"));
    $("#dropoff_time option:last").attr('selected','selected');
    $("#early_pickup_div").show();
  }
  else
  {
    setTimeSpecial($("#pickup_time"), hour);
    $("#pickup_time option:first").attr('selected','selected');
    setTimeSpecial($("#dropoff_time"), hour);
    $("#dropoff_time option:last").attr('selected','selected');
  }

  $("#pickup_time").change(function(){

    console.log($(this).val());
    let val = $(this).val().split(":");
    let hour = parseInt(val[0]);
    let mam = val[1].split(" ");
    let min = mam[0];
    let ampm = mam[1];

    console.log(val);
    if( ampm == "PM" )
    {
      console.log(ampm);
      if( hour >= 1 && hour <= 7 )
      {
        console.log(hour);
        hour = hour + 13;
        console.log(hour);
      }
      else if( hour == 12 )
      {
        console.log(hour);
        hour = 13;
        console.log(hour);
      }
      if( hour == 8 )
      {
        var date = new Date(pickupdate);
        date.setDate(date.getDate() + 1);
        pickupdate = getdateformat(date);
        $("#dropoff_date").datetimepicker('minDate', moment(pickupdate));
        hour = 7;
      }
      $("#early_pickup_div").hide();
    }
    else
    {
      hour = hour + 1;
    }
    $("#dropoff_time").empty();
    console.log(hour);
    setTimeSpecial($("#dropoff_time"), hour);
  });

  $("#pickup_date").datetimepicker({
    format: 'DD-MM-Y',
    minDate:moment(today_date),
    defaultDate:moment(today_date),
    icons: {
      time: "fa-solid fa-clock"
    }
  }).on('dp.change', function(e) {
    console.log('Pickup date');
    pickupdate = $(this).val();
    var temp = pickupdate.split('-');
    pickupdate = temp[2]+"-"+temp[1]+"-"+temp[0];
    $("#dropoff_date").datetimepicker('minDate', moment(pickupdate));
    var pd = $("#pickup_date").val();
    const date1 = moment(today_date);
    const date2 = moment(dateformatstring(pd));
    
    const duration = moment.duration(date2 - date1);
    const res = duration.as('hours');
    console.log('pickupdate-today='+res+"hours");
    if( res >= 24 )
    {
        $("#pickup_time").empty();
        setTimeAll($("#pickup_time"));

        $("#dropoff_time").empty();
        setTimeAll($("#dropoff_time"));
        $("#dropoff_time option:last").attr('selected','selected');
        $("#early_pickup_div").show();
    }
    else
    {
        $("#pickup_time").empty();
        setTimeSpecial($("#pickup_time"), hour);
        $("#dropoff_time").empty();
        setTimeSpecial($("#dropoff_time"), hour);
        $("#dropoff_time option:last").attr('selected','selected');
        $("#early_pickup_div").hide();
    }
  });

  $("#dropoff_date").datetimepicker({
    format: 'DD-MM-Y',
    minDate:moment(today_date),
    defaultDate:moment(today_date),
    icons: {
      time: "fa-solid fa-clock"
    }
  }).on('dp.change', function(e) {
    console.log('Dropoff date');
    console.log();

    var pd = $("#pickup_date").val();
    var dp = $(this).val();

    const date1 = moment(dateformatstring(pd));
    const date2 = moment(dateformatstring(dp));

    const duration = moment.duration(date2 - date1);
    const res = duration.as('hours');
    console.log('pickupdate-drop='+res+"hours");
    if( res >= 24 )
    {
        $("#dropoff_time").empty();
        setTimeAll($("#dropoff_time"));
    }
    else
    {
        $("#dropoff_time").empty();
        setTimeSpecial($("#dropoff_time"), hour);
    }
  });

    $(".cart-plus").click(function()
    {
        var v = $(".cart-input").val();
        v = parseInt(v) + 1;
        $(".cart-input").val(v);            
        checkbikesubmitform();
    });

    $(".cart-hplus").click(function()
    {
        var v = $(".cart-helmets").val();
        v = parseInt(v) + 1;
        $(".cart-helmets").val(v);
        console.log("hplus"+$(".cart-helmets").val());
        checkbikesubmitform();
    });

    $(".cart-minus").click(function()
    {
        var v = $(".cart-input").val();
        if( v == 0 ){
            return false;
        }
        v = parseInt(v) - 1;
        $(".cart-input").val(v);
        checkbikesubmitform();
    });

    $(".cart-hminus").click(function()
    {
        var v = $(".cart-helmets").val();
        if( v == 0 ){
            return false;
        }
        v = parseInt(v) - 1;
        $(".cart-helmets").val(v);
        console.log("hminus"+$(".cart-helmets").val());
        checkbikesubmitform();
    });

    $(".customize").click(function()
    {
        var bikeId = $(this).attr("data-bikeid");
        var bikeName = $(this).attr("data-bikename");
        var bike_image = $(this).attr("data-bikeimage");
        var bike_price = $(this).attr("data-bikeprice");
        var bike_qty = $("#custom_bike .cart-input").val();
        if( bike_qty == 0 )
        {
            bike_qty = 1;
            $("#custom_bike .cart-input").val(bike_qty);
        }
        var h_qty = $("#custom_bike .cart-helmets").val();
        var early_pickup_charge = $("#custom_bike input[name='early_pickup_charge']:checked").val();
        var total = 0;
        
        $("#custom_bike input[name='bike_type_id']").val(bikeId);
        $("#custom_bike input[name='bike_type_name']").val(bikeName);
        $("#bike_customize .card-title").html("<img src='"+bike_image+"' style='max-width:80px;display:inline;' class='img-fluid me-2'/>"+bikeName);
        $("#custom_bike #bike_price").html(bike_price);
        $("#custom_bike #bike_qty").html(bike_qty);
        var bike_price_subtotal = parseInt(bike_qty) * parseInt(bike_price);
        total += bike_price_subtotal;
        $("#custom_bike #bike_price_subtotal").html(bike_price_subtotal);
        if( early_pickup_charge ){
            total += parseInt(bike_qty) * 200;
            $("#custom_bike #early_pickup").html(parseInt(bike_qty) * 200);
        }else{
            $("#custom_bike #early_pickup").html();
        }

        $("#custom_bike #helmets_total").html(h_qty * 50);
        total += parseInt(h_qty * 50);

        $("#custom_bike #cart_total").html(total);

        $("#bike_customize").modal('show');

        var today = new Date();
        var today_date = getdateformat(today);
        var hour = today.getHours();
        console.log("="+today_date);
        console.log(hour);
        hour = hour + 1;
        let pickupdate = today_date;

        if( hour >= 20 )
        {
            var date = new Date();
            date.setDate(date.getDate() + 1);
            today_date = getdateformat(date);
            console.log("Nextday="+today_date);
            $("#pickupdate").val(today_date);
            $("#dropoffdate").val(today_date);
            // Settime
            
            setTimeAll($("#custom_bike #pickuptime"));
            $("#custom_bike #pickuptime option:first").attr('selected','selected');
            $("#early_pickup_div").show();

            setTimeAll($("#custom_bike #dropofftime"));
            $("#custom_bike #dropofftime option:last").attr('selected','selected');
        }
        else if( hour <= 7 )
        {
            setTimeAll($("#custom_bike #pickuptime"));
            $("#custom_bike #pickuptime option:first").attr('selected','selected');
            $("#early_pickup_div").show();
            
            setTimeAll($("#custom_bike #dropofftime"));
            $("#custom_bike #dropofftime option:last").attr('selected','selected');
        }
        else
        {
            setTimeSpecial($("#custom_bike #pickuptime"), hour);
            $("#custom_bike #pickuptime option:first").attr('selected','selected');

            setTimeAll($("#custom_bike #dropofftime"));
            $("#custom_bike #dropofftime option:last").attr('selected','selected');
        }

        $("#custom_bike #pickuptime").change(function(){
            console.log("pickuptime="+$(this).val());
            let val = $(this).val().split(":");
            let hour = parseInt(val[0]);
            let mam = val[1].split(" ");
            let min = mam[0];
            let ampm = mam[1];

            console.log(val);
            if( ampm == "PM" )
            {
              $("#early_pickup_div").hide();
              $("#custom_bike input[name='early_pickup_charge']").prop("checked", false);
              console.log(ampm);
              if( hour >= 1 && hour <= 7 )
              {
                console.log(hour);
                hour = hour + 13;
                console.log(hour);
              }
              else if( hour == 12 )
              {
                console.log(hour);
                hour = 13;
                console.log(hour);
              }
              if( hour == 8 )
              {
                var date = new Date(pickupdate);
                date.setDate(date.getDate() + 1);
                pickupdate = getdateformat(date);
                $("#custom_bike #dropoff_date").datetimepicker('minDate', moment(pickupdate));
                hour = 7;
              }
            }
            else
            {
                console.log("hour="+hour);
              if( hour == 8 || hour == 7 )
              {
                $("#early_pickup_div").show();
                $("#custom_bike input[name='early_pickup_charge']").prop("checked", false);
              }
              else
              {
                $("#early_pickup_div").hide();
                $("#custom_bike input[name='early_pickup_charge']").prop("checked", false);
              }
            }
            $("#custom_bike #dropoff_time").empty();
            setTimeSpecial($("#custom_bike #dropoff_time"), hour);
            checkbikesubmitform();
        });

        $("#custom_bike #pickupdate").change(function(e){
            console.log('Pickup date');
            pickupdate = $(this).val();
            /*var temp = pickupdate.split('-');
            pickupdate = temp[2]+"-"+temp[1]+"-"+temp[0];*/
            $("#custom_bike #dropoffdate").val(pickupdate);
            var pd = $("#custom_bike #pickupdate").val();
            const date1 = moment(today_date);
            const date2 = moment(pd);

            const duration = moment.duration(date2 - date1);
            const res = duration.as('hours');
            console.log('pickupdate-today='+res+"hours");
            if( res >= 24 )
            {
                $("#custom_bike #pickuptime").empty();
                setTimeAll($("#custom_bike #pickuptime"));
                $("#custom_bike #pickuptime option:first").attr('selected','selected');
                $("#early_pickup_div").show();
                $("#custom_bike input[name='early_pickup_charge']").prop("checked", false);

                $("#custom_bike #dropofftime").empty();
                setTimeAll($("#custom_bike #dropofftime"));
                $("#custom_bike #dropofftime option:last").attr('selected','selected');
            }
            else
            {
                $("#custom_bike #pickuptime").empty();
                setTimeSpecial($("#custom_bike #pickuptime"), hour);
                $("#early_pickup_div").hide();
                $("#custom_bike input[name='early_pickup_charge']").prop("checked", false);
            }
            checkbikesubmitform();
        });

        $("#custom_bike #dropoffdate").change(function(e) {
            console.log('Dropoff date');

            var pd = $("#custom_bike #pickupdate").val();
            var dp = $(this).val();
            console.log(pd+":"+dp);
            const date1 = moment(pd);
            const date2 = moment(dp);

            const duration = moment.duration(date2 - date1);
            const res = duration.as('hours');
            console.log('pickupdate-drop='+res+"hours");
            if( res >= 24 )
            {
                $("#custom_bike #dropofftime").empty();
                setTimeAll($("#custom_bike #dropofftime"));
            }
            else
            {
                $("#custom_bike #dropofftime").empty();
                setTimeSpecial($("#custom_bike #dropofftime"), hour);
            }
            checkbikesubmitform();
        });

        $("#custom_bike #dropofftime").change(function(e) {
            console.log('Dropoff time:changed');
            checkbikesubmitform();
        });

        checkbikesubmitform();
    });
    
    $("input[name='early_pickup_charge']").change(function(){
        checkbikesubmitform();
    });

    
    function checkbikesubmitform()
    {
        $("#bike_availability").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Checking..");
        $("#custom_bike :input").prop("disabled", true);
        $("#custom_bike button[type='button']").prop("disabled", true);
        $("#custom_bike button[type='button']").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");

        $("#sumit_row").find(".alert").each(function(){
          $(this).remove();
        });

        var formdata = {
          bikeId:$("#custom_bike input[name='bike_type_id']").val(),
          bikeName:$("#custom_bike input[name='bike_type_name']").val(),
          bikeqty:$("#custom_bike .cart-input").val(),
          pickup_date:$("#custom_bike input[name='pickupdate']").val(),
          pickup_time:$("#custom_bike #pickuptime").val(),
          dropoff_date:$("#custom_bike input[name='dropoffdate']").val(),
          dropoff_time:$("#custom_bike #dropofftime").val(),
        };

        console.log($("#custom_bike input[name='pickupdate']").val()+" "+$("#custom_bike #pickuptime").val());
        const currentDate = new Date();
        // The date you want to check
        const inputDate = new Date($("#custom_bike input[name='pickupdate']").val()+" "+$("#custom_bike #pickuptime").val()); 
        console.log(inputDate);
        console.log(currentDate);
        const inputDate1 = new Date($("#custom_bike input[name='dropoffdate']").val()+" "+$("#custom_bike #dropofftime").val()); 
        if (inputDate < currentDate) 
        {
            $("#sumit_row").append("<div class='alert alert-danger mt-1 mb-0'>Pickup date is in the past.</div>");
            $("#custom_bike :input").prop("disabled", false);
            $("#custom_bike button[type='button']").prop("disabled", false);
            $("#custom_bike button[type='button']").html("Book Now");
            $("#bike_availability").html("Bike Availability : ");
            return false;
        }
        if (inputDate1 < currentDate) 
        {
            $("#sumit_row").append("<div class='alert alert-danger mt-1 mb-0'>Dropoff date is in the past.</div>");
            $("#custom_bike :input").prop("disabled", false);
            $("#custom_bike button[type='button']").prop("disabled", false);
            $("#custom_bike button[type='button']").html("Book Now");
            $("#bike_availability").html("Bike Availability : ");
            return false;
        } 

        var url = $("#custom_bike").attr('action');
        url = url.replace("instant", "bike_availability");

        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: formdata, // Serialize form data
            success: function (response) {
                console.log(response);
                if( response.error == 1 )
                {
                  // error occured
                  $("#custom_bike :input").prop("disabled", false);
                  $("#custom_bike button[type='button']").prop("disabled", false);
                  $("#custom_bike button[type='button']").html("Book Now");

                  $("#sumit_row").append("<div class='alert alert-danger mt-1 mb-0'>"+response.error_message+"</div>");
                  $("#bike_availability").html("Availability : <i class='fa text-danger fa-close'></i>");
                }
                else
                {
                    if( formdata.bikeqty > response.data.bike_availability )
                    {
                        $("#custom_bike .cart-input").val(response.data.bike_availability);    
                    }
                    var total = 0;
                    var bike_price = response.data.rent_price;
                    var bike_qty = $("#custom_bike .cart-input").val();
                    var h_qty = $("#custom_bike .cart-helmets").val();

                    if( h_qty > bike_qty )
                    {
                        h_qty = bike_qty;
                        $("#custom_bike .cart-helmets").val(bike_qty);
                    }

                    var early_pickup_charge = $("#custom_bike input[name='early_pickup_charge']:checked").val();

                    $("#custom_bike #bike_price").html(bike_price);
                    $("#custom_bike #bike_qty").html(bike_qty);
                    bike_price_subtotal = parseInt(bike_qty) * parseInt(bike_price);
                    total = bike_price_subtotal;
                    $("#custom_bike #bike_price_subtotal").html(bike_price_subtotal);
                    $("#custom_bike #helmets_total").html(h_qty * 50);

                    if( early_pickup_charge ){
                        total += parseInt(bike_qty) * 200;
                        $("#custom_bike #early_pickup").html(parseInt(bike_qty) * 200);
                    }else{
                        $("#custom_bike #early_pickup").html();
                    }

                    total += parseInt(h_qty * 50);
                    $("#custom_bike #cart_total").html(total);

                    if( response.data.bike_availability == 0 ){
                        $("#bike_availability").html("Availability : <i class='fa text-danger fa-close'></i>");
                    } else {
                        $("#bike_availability").html("Availability : <i class='fa fa-check'></i>");
                    }
                    $("#custom_bike :input").prop("disabled", false);
                    $("#custom_bike button[type='button']").html("Book Now");                                   
                }
            },
            error: function (data) {
                $("#sumit_row").append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                // error occured
                $("#custom_bike :input").prop("disabled", false);
                $("#custom_bike button[type='button']").prop("disabled", false);
                $("#custom_bike button[type='button']").html("Book Now");
                $("#bike_availability").html("Availability : ");
            }
        });
    }

    $(".custom_bike_submit").click(function(){

        $("#bike_availability").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Checking..");
        $("#custom_bike :input").prop("disabled", true);
        $("#custom_bike button[type='button']").prop("disabled", true);
        $("#custom_bike button[type='button']").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> PLease wait..");

        $("#sumit_row").find(".alert").each(function(){
          $(this).remove();
        });

        var formdata = {
          bikeId:$("#custom_bike input[name='bike_type_id']").val(),
          bikeName:$("#custom_bike input[name='bike_type_name']").val(),
          bikeqty:$("#custom_bike .cart-input").val(),
          pickup_date:$("#custom_bike input[name='pickupdate']").val(),
          pickup_time:$("#custom_bike #pickuptime").val(),
          dropoff_date:$("#custom_bike input[name='dropoffdate']").val(),
          dropoff_time:$("#custom_bike #dropofftime").val(),
        };

        console.log($("#custom_bike input[name='pickupdate']").val()+" "+$("#custom_bike #pickuptime").val());
        const currentDate = new Date();
        // The date you want to check
        const inputDate = new Date($("#custom_bike input[name='pickupdate']").val()+" "+$("#custom_bike #pickuptime").val()); 
        console.log(inputDate);
        console.log(currentDate);
        const inputDate1 = new Date($("#custom_bike input[name='dropoffdate']").val()+" "+$("#custom_bike #dropofftime").val()); 
        if (inputDate < currentDate) 
        {
            $("#sumit_row").append("<div class='alert alert-danger mt-1 mb-0'>Pickup date is in the past.</div>");
            $("#custom_bike :input").prop("disabled", false);
            $("#custom_bike button[type='button']").prop("disabled", false);
            $("#custom_bike button[type='button']").html("Book Now");
            $("#bike_availability").html("Bike Availability : ");
            return false;
        }
        if (inputDate1 < currentDate) 
        {
            $("#sumit_row").append("<div class='alert alert-danger mt-1 mb-0'>Dropoff date is in the past.</div>");
            $("#custom_bike :input").prop("disabled", false);
            $("#custom_bike button[type='button']").prop("disabled", false);
            $("#custom_bike button[type='button']").html("Book Now");
            $("#bike_availability").html("Bike Availability : ");
            return false;
        } 

        var url = $("#custom_bike").attr('action');
        url = url.replace("instant", "bike_availability");

        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: formdata, // Serialize form data
            success: function (response) {
                console.log(response);
                if( response.error == 1 )
                {
                  // error occured
                  $("#custom_bike :input").prop("disabled", false);
                  $("#custom_bike button[type='button']").prop("disabled", false);
                  $("#custom_bike button[type='button']").html("Book Now");

                  $("#sumit_row").append("<div class='alert alert-danger mt-1 mb-0'>"+response.error_message+"</div>");
                  $("#bike_availability").html("Availability : <i class='fa text-danger fa-close'></i>");
                }
                else
                {
                    if( formdata.bikeqty > response.data.bike_availability )
                    {
                        $("#custom_bike .cart-input").val(response.data.bike_availability);    
                    }
                    $("#custom_bike :input").prop("disabled", false);

                    $("#bike_availability").html("Availability : <i class='fa fa-check'></i>");
                    $("#custom_bike button[type='button']").html("Success");
                    $("#custom_bike").submit();                                        
                }
            },
            error: function (data) {
                $("#sumit_row").append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                // error occured
                $("#custom_bike :input").prop("disabled", false);
                $("#custom_bike button[type='button']").prop("disabled", false);
                $("#custom_bike button[type='button']").html("Book Now");
                $("#bike_availability").html("Availability : ");
            }
        });

    });

});

</script>