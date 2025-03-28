<!--breadcrumb section start-->
        <section class="breadcrumb-section position-relative overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/texture-bg.png">
            <img src="<?=base_url()?>/assets/img/shapes/tire-print-left.png" alt="tire print" class="position-absolute start-0 z-1 tire-print">
            <img src="<?=base_url()?>/assets/img/shapes/tire-print-right.png" alt="tire print" class="position-absolute end-0 z-1 tire-print">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                            <h1 class="text-white">Tariff</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--breadcrumb section end-->

        <!--about section start-->
        <section class="h3-about-section ptb-60">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="at-section-title text-center">
                            <h2 class="h1 mt-2 mb-4"><mark class="p-0 bg-transparent text-md-primary">Rock N Roll Rentals</mark></h2>
                            <p class="fw-500 mb-0">RENT, RIDE, REPEAT!</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-4 g-4">
                    <div class="col-xl-6 col-lg-6" style="border-right: 5px solid #ffc107;">
                        <div class="h2-about-item-box rounded position-relative z-1">
                            <p class="mb-0">A <mark class="p-0 bg-transparent text-primary">hassle-free</mark> and simple bike rental company. We remain loyal to our customers by making it easy to <mark class="p-0 bg-transparent text-primary">rent</mark> a bike. We have a <mark class="p-0 bg-transparent text-primary">wide range</mark> of scooters & bikes available to rent and move on. </p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="h2-about-item-box rounded position-relative z-1">
                            <p class="mb-0">Rock N Roll, the first in town and <mark class="p-0 bg-transparent text-primary">RTO</mark> authorized bike rental firm in <mark class="p-0 bg-transparent text-primary">Chikmagaluru</mark>. We offer affordable riding experience for our travelers to <mark class="p-0 bg-transparent text-primary">discover</mark> places in and around the town with ease.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--about section end-->
  
        <!--feature section start-->
        <section class="sr-feature-section ptb-60 position-relative overflow-hidden z-1 bg-white">
            <span class="primary-blur rounded-circle position-absolute start-0 top-0 z--1"></span>
            <span class="yellow-blur rounded-circle position-absolute end-0 bottom-0 z--1"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="section-title text-center">
                            <h2 class="h3">We are Ensuring the Best Customer Experience</h2>
                        </div>
                    </div>
                </div>
                <div class="mt-5 px-2">
                    <div class="row justify-content-center align-items-center">
                        <table class="table table-hover table-bordered">
                        <tbody><tr>
                            <td style="font-weight: bolder;" rowspan="2" align="center" valign="middle">Bike Name</td>
                            <td align="center" colspan="2" style="font-weight: bolder;">Weekdays <br> Mon-Thu</td>
                            <td align="center" colspan="2" style="font-weight: bolder;">Weekends  <br>Fri-Sun</td>                      
                        </tr>
                        <tr>
                            <td align="center" style="font-weight: bolder;">8:00 AM - 12:00 PM</td>
                            <td align="center" style="font-weight: bolder;">8:00 AM - 8:00 PM</td>
                            <td align="center" style="font-weight: bolder;">8:00 AM - 8:00 PM</td>              
                        </tr>
                        <?php foreach($bikes as $bike) { ?>
                            <tr>
                                 <td><?=$bike['bike_type_name']?></td>
                                 <td align="center"><i class="fa fa-rupee"></i> <?=$bike['week_day_half_price']?></td>
                                 <td align="center"><i class="fa fa-rupee"></i> <?=$bike['week_day_price']?></td>
                                 <td align="center"><i class="fa fa-rupee"></i> <?=$bike['weekend_day_price']?></td>
                            </tr>
                        <?php } ?>
                        </tbody></table>
                    </div>
                </div>
            </div>
        </section>

        <!--feature section end-->
        <?php
        $social = getSocial(); 
        ?>
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
                            <h2 class="h1 mt-3 mb-3">Our Customers Say</h2>
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
                                    <p class="w-75 mx-auto text-white mt-3 mb-4"><?=$review->text?></p>
                                    <div class="client-info text-center g-2">
                                        <span class="star-rating rounded-pill"><span class="me-2"><i class="fa-solid fa-star"></i></span><?=$review->rating?></span>
                                        <h6 class="mt-2 fs-5 mb-1 text-white"><?=$review->author_name?></h6>          
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