<!--hero section start-->
<section class="moto-rent-hero position-relative overflow-hidden z-1 bg-texture-gradient" data-background="<?=base_url()?>/assets/img/shapes/texture-bg.png">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-sm-12">
                <div class="moto-rent-hero-content">
                    <h1 class="display-4 md-heading-bold text-white mb-4">Welcome to <mark class="p-0 bg-transparent text-md-primary">Rock N Roll </mark> Rentals</h1>
                    <h4 class="text-white fw-normal mb-5">A RTO authorized bike rental firm in Chikmagaluru. We offer affordable riding experience for our travelers to discover places in and around the town with ease.</h4>
                    
                </div>
            </div>
            <div class="d-none d-xl-block col-xl-6">
                <div class="hero-bike-slider position-relative z-5 swiper">
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
                            <img src="bikes/bg/royal_enfield_classic_350.png" alt="bike" class="img-fluid">
                            <span class="slide-index text-dark position-absolute fw-bold">Royal Enfield Clasic 350</span>
                        </div>
                        <div class="hero-bike-single position-relative swiper-slide">
                            <img src="bikes/bg/bajaj_pulsar_150.png" alt="bike" class="img-fluid">
                            <span class="slide-index text-dark position-absolute fw-bold">Bajaj Pulsar 150</span>
                        </div>
                        <div class="hero-bike-single position-relative swiper-slide">
                            <img src="bikes/bg/bajaj_avenger_220.png" alt="bike" class="img-fluid">
                            <span class="slide-index text-dark position-absolute fw-bold">Bajaj Avenger 220</span>
                        </div>
                    </div>
                    <div class="bike-slider-pagination"></div>
                    <div class="bike-pagination-text">
                        <span>Harley-Davidson</span>
                        <span>Roadster Bike</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="at-header-social md-header-social d-none d-md-flex align-items-center position-absolute">
        <span class="title">Follow on</span>
        <ul class="social-list ms-3">
            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
        </ul>
    </div>
    <img src="<?=base_url()?>/assets/img/shapes/texture-bg-yellow.jpg" alt="texture yellow" class="position-absolute texture-yellow z-1 d-none d-xl-block">
    <img src="<?=base_url()?>/assets/img/shapes/wave-yellow.png" alt="wave" class="position-absolute wave-shape z-2">
</section>

<!--search box -->
<div class="at-search-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="at-search-box-filter bg-white">
                    <ul class="nav nav-tabs border-0 justify-content-center justify-content-sm-start">
                        <li><a href="javascript:void(0)" class="text-dark active">Search Your Next Ride</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="all_status">
                            <form method="POST" action="<?=base_url('Bookaride')?>" class="at-search-filter d-flex align-items-center">
                                <div class="input-field">
                                    <label>Pickup Date</label>
                                    <div class="form-input">                            
                                        <input type="text" name="pickup_date" id="pickup_date" class="theme-date-input border w-100 rounded-2" placeholder="">
                                    </div>
                                </div>
                                <div class="input-field">
                                    <label>Time</label>
                                    <select id="pickup_time" name="pickup_time" class="form-select">
                                    	<option value="">Select</option>
                                    </select>
                                </div>
                                <div class="input-field">
                                    <label>Dropping off date</label>
                                    <div class="form-input">                            
                                        <input type="text" name="dropoff_date" id="dropoff_date" class="theme-date-input border w-100 rounded-2" placeholder="">
                                    </div>
                                </div>
                                <div class="input-field">
                                    <label>Time</label>
                                    <select id="dropoff_time" name="dropoff_time" class="form-select">
                                    	<option value="">Select</option>
                                    </select>
                                </div>
                                <div class="submit-btn align-self-end">
                                    <button class="btn btn-secondary btn-md" type="submit">Search Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--search box end-->

<!--about section start-->
<section class="h3-about-section ptb-80">
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

<!--latest collection start-->
<section class="latest-collection pt-10 pb-80">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6">
                <div class="at-section-title text-center text-lg-start">
                    <span class="at-subtitle position-relative lead text-primary">Our <mark class="p-0 bg-transparent text-dark">Fleet</mark></span>
                    <h2 class="h1 mt-2 mb-0">Find the Best Ride</h2>
                </div>
            </div>
            <div class="col-lg-6 align-self-end">
                <div class="collection-filter-controls d-flex align-items-center justify-content-center justify-content-lg-end flex-wrap mt-5 mt-lg-0">
                    <button class="at-filter-btn active" data-filter="*">All</button>
                    <button class="at-filter-btn" data-filter=".bikes">Bikes</button>
                    <button class="at-filter-btn" data-filter=".scooty">Scooty</button>
                </div>
            </div>
        </div>
        <div class="filter-items-wrapper mt-5">
            <div class="row g-4 justify-content-center filter-grid">
                <div class="col-xxl-4 col-lg-4 col-md-6 col-sm-12 latest scooty">
                    <div class="filter-card-item position-relative overflow-hidden rounded bg-white">
                        <a href="#" class="icon-btn compare-btn position-absolute"><i class="fa-solid fa-compress"></i></a>
                        <a href="#" class="icon-btn wish-btn position-absolute"><i class="fa-solid fa-heart"></i></a>
                        <span class="date position-absolute">2017</span>
                        <div class="feature-thumb position-relative overflow-hidden">
                            <a href="inventory-details.html"><img src="bikes/honda_dio.jpg" alt="car" class="img-fluid"></a>
                        </div>
                        <div class="filter-card-content">
                            <div class="price-btn text-end position-relative">
                                <span class="small-btn-meta">*</span>
                            </div>
                            <a href="inventory-details.html" class="mt-4 d-block">
                                <h5>Honda Dio</h5>
                            </a>
                            <span class="meta-content"><strong>Listed by:</strong> <a href="#">Car House</a></span>
                            <hr class="spacer mt-3 mb-3">
                            <div class="card-feature-box d-flex align-items-center mb-4">
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-speedometer"></i></span>
                                    120cc
                                </div>
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-steering-wheel"></i></span>
                                    Manual
                                </div>
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-petrol"></i></span>
                                    Petrol
                                </div>
                            </div>
                            <a href="inventory-details.html" class="btn outline-btn btn-sm d-block">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-4 col-md-6 col-sm-12 scooty latest">
                    <div class="filter-card-item position-relative overflow-hidden rounded bg-white">
                        <a href="#" class="icon-btn compare-btn position-absolute"><i class="fa-solid fa-compress"></i></a>
                        <a href="#" class="icon-btn wish-btn position-absolute"><i class="fa-solid fa-heart"></i></a>
                        <span class="date position-absolute">2016</span>
                        <div class="feature-thumb position-relative overflow-hidden">
                            <a href="inventory-details.html"><img src="bikes/honda_activa_6g.jpg" alt="car" class="img-fluid"></a>
                        </div>
                        <div class="filter-card-content">
                            <div class="price-btn text-end position-relative">
                                <span class="small-btn-meta">*</span>
                            </div>
                            <a href="inventory-details.html" class="mt-4 d-block">
                                <h5>Honda Activa 6G</h5>
                            </a>
                            <span class="meta-content"><strong>Listed by:</strong> <a href="#">Car House</a></span>
                            <hr class="spacer mt-3 mb-3">
                            <div class="card-feature-box d-flex align-items-center mb-4">
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-speedometer"></i></span>
                                    120cc
                                </div>
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-steering-wheel"></i></span>
                                    Manual
                                </div>
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-petrol"></i></span>
                                    Petrol
                                </div>
                            </div>
                            <a href="inventory-details.html" class="btn outline-btn btn-sm d-block">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-4 col-md-6 col-sm-12 latest scooty">
                    <div class="filter-card-item position-relative overflow-hidden rounded bg-white">
                        <a href="#" class="icon-btn compare-btn position-absolute"><i class="fa-solid fa-compress"></i></a>
                        <a href="#" class="icon-btn wish-btn position-absolute"><i class="fa-solid fa-heart"></i></a>
                        <span class="date position-absolute">2018</span>
                        <div class="feature-thumb position-relative overflow-hidden">
                            <a href="inventory-details.html"><img src="bikes/fascino.png" alt="car" class="img-fluid"></a>
                        </div>
                        <div class="filter-card-content">
                            <div class="price-btn text-end position-relative">
                                <span class="small-btn-meta">*</span>
                            </div>
                            <a href="inventory-details.html" class="mt-4 d-block">
                                <h5>Fascino</h5>
                            </a>
                            <span class="meta-content"><strong>Listed by:</strong> <a href="#">Car House</a></span>
                            <hr class="spacer mt-3 mb-3">
                            <div class="card-feature-box d-flex align-items-center mb-4">
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-speedometer"></i></span>
                                    120cc
                                </div>
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-steering-wheel"></i></span>
                                    Manual
                                </div>
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-petrol"></i></span>
                                    Petrol
                                </div>
                            </div>
                            <a href="inventory-details.html" class="btn outline-btn btn-sm d-block">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-4 col-md-6 col-sm-12 latest bikes">
                    <div class="filter-card-item position-relative overflow-hidden rounded bg-white">
                        <a href="#" class="icon-btn compare-btn position-absolute"><i class="fa-solid fa-compress"></i></a>
                        <a href="#" class="icon-btn wish-btn position-absolute"><i class="fa-solid fa-heart"></i></a>
                        <span class="date position-absolute">2012</span>
                        <div class="feature-thumb position-relative overflow-hidden">
                            <a href="inventory-details.html"><img src="bikes/bajaj_pulsar_150.jpg" alt="car" class="img-fluid"></a>
                        </div>
                        <div class="filter-card-content">
                            <div class="price-btn text-end position-relative">
                                <span class="small-btn-meta">*</span>
                            </div>
                            <a href="inventory-details.html" class="mt-4 d-block">
                                <h5>Bajaj Pulsar 150</h5>
                            </a>
                            <span class="meta-content"><strong>Listed by:</strong> <a href="#">Car House</a></span>
                            <hr class="spacer mt-3 mb-3">
                            <div class="card-feature-box d-flex align-items-center mb-4">
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-speedometer"></i></span>
                                    120cc
                                </div>
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-steering-wheel"></i></span>
                                    Manual
                                </div>
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-petrol"></i></span>
                                    Petrol
                                </div>
                            </div>
                            <a href="inventory-details.html" class="btn outline-btn btn-sm d-block">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-4 col-md-6 col-sm-12 bikes">
                    <div class="filter-card-item position-relative overflow-hidden rounded bg-white">
                        <a href="#" class="icon-btn compare-btn position-absolute"><i class="fa-solid fa-compress"></i></a>
                        <a href="#" class="icon-btn wish-btn position-absolute"><i class="fa-solid fa-heart"></i></a>
                        <span class="date position-absolute">2013</span>
                        <div class="feature-thumb position-relative overflow-hidden">
                            <a href="inventory-details.html"><img src="bikes/bajaj_avenger_220.jpg" alt="car" class="img-fluid"></a>
                        </div>
                        <div class="filter-card-content">
                            <div class="price-btn text-end position-relative">
                                <span class="small-btn-meta">*</span>
                            </div>
                            <a href="inventory-details.html" class="mt-4 d-block">
                                <h5>Bajaj Avenger 220</h5>
                            </a>
                            <span class="meta-content"><strong>Listed by:</strong> <a href="#">Car House</a></span>
                            <hr class="spacer mt-3 mb-3">
                            <div class="card-feature-box d-flex align-items-center mb-4">
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-speedometer"></i></span>
                                    120cc
                                </div>
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-steering-wheel"></i></span>
                                    Manual
                                </div>
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-petrol"></i></span>
                                    Petrol
                                </div>
                            </div>
                            <a href="inventory-details.html" class="btn outline-btn btn-sm d-block">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-4 col-md-6 col-sm-12 bikes latest">
                    <div class="filter-card-item position-relative overflow-hidden rounded bg-white">
                        <a href="#" class="icon-btn compare-btn position-absolute"><i class="fa-solid fa-compress"></i></a>
                        <a href="#" class="icon-btn wish-btn position-absolute"><i class="fa-solid fa-heart"></i></a>
                        <span class="date position-absolute">2016</span>
                        <div class="feature-thumb position-relative overflow-hidden">
                            <a href="inventory-details.html"><img src="bikes/royal_enfield_classic_350.jpg" alt="car" class="img-fluid"></a>
                        </div>
                        <div class="filter-card-content">
                            <div class="price-btn text-end position-relative">
                                <span class="small-btn-meta">*</span>
                            </div>
                            <a href="inventory-details.html" class="mt-4 d-block">
                                <h5>Royal Enfield Classic 350</h5>
                            </a>
                            <span class="meta-content"><strong>Listed by:</strong> <a href="#">Car House</a></span>
                            <hr class="spacer mt-3 mb-3">
                            <div class="card-feature-box d-flex align-items-center mb-4">
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-speedometer"></i></span>
                                    120cc
                                </div>
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-steering-wheel"></i></span>
                                    Manual
                                </div>
                                <div class="icon-box d-flex align-items-center">
                                    <span class="me-2"><i class="flaticon-petrol"></i></span>
                                    Petrol
                                </div>
                            </div>
                            <a href="inventory-details.html" class="btn outline-btn btn-sm d-block">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--latest collection end-->

<!--about section start-->
<section class="about-section pt-80 pb-80 bg-primary-light position-relative z-1 overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/about-bg.jpg">
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
                            <span class="icon-wrapper d-flex align-items-center justify-content-center rounded"><i class="flaticon-shield"></i></span>
                            <h5 class="mb-0 ms-3">24/7 Customer Support</h5>
                        </div>
                        <p class="mb-0">Call us from anywhere anytime</p>
                    </div>
                    <div class="about-icon-box bg-white shadow rounded mt-20 ms-md-5">
                        <div class="ab-icon-box-top d-flex align-items-center mb-3">
                            <span class="icon-wrapper d-flex align-items-center justify-content-center rounded"><i class="flaticon-shield"></i></span>
                            <h5 class="mb-0 ms-3">Instant Pickup</h5>
                        </div>
                        <p class="mb-0">24/7 Online Reservation</p>
                    </div>
                    <div class="about-icon-box bg-white shadow rounded mt-20">
                        <div class="ab-icon-box-top d-flex align-items-center mb-3">
                            <span class="icon-wrapper d-flex align-items-center justify-content-center rounded"><i class="flaticon-price-tag"></i></span>
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
<section class="h3-counter-section pt-120 pb-80 position-relative z-1 overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/texture-shape.png">
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
                        <h3 class="mb-1"><span class="counter">2248</span><span>+</span></h3>
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
                        <h3 class="mb-1"><span class="counter">28</span><span>+</span></h3>
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
                        <h3 class="mb-1"><span class="counter">142140</span><span>+</span></h3>
                        <span>TOTAL KILOMETERS</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--countdown section end-->

<!--feedback section start-->
<section class="h2-feedback-section pb-80 bg-white" style="background-repeat: no-repeat;background-size: cover;" data-background="<?=base_url()?>/assets/images/bg.jpg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7">
                <div class="at-section-title text-center">
                    <span class="subtitle text-primary lead">Customer <mark class="bg-transparent p-0 text-dark">Feedback</mark></span>
                    <h2 class="h1 mt-3 mb-3">Our Happy Customer Saying</h2>
                </div>
            </div>
        </div>
        <div class="swiper h2-feedback-slider mt-5">
            <div class="swiper-wrapper">
                <div class="h2-feedback-single swiper-slide">                            
                    <div class="h2-feedback-content mt-1 bg-white rounded position-relative">
                        <div class="feedback-top mt-1 d-flex align-items-center justify-content-between">
                            <img src="<?=base_url()?>/assets/images/user.png" alt="client" class="rounded-circle mt-0 border border-2 border-white">
                            <span class="star-rating rounded-pill"><span class="me-2"><i class="fa-solid fa-star"></i></span>4.5</span>
                        </div>
                        <p class="mt-3 mb-4">Assertive disseminate integrated human capital through dynamic bandwidth. independent partnerships. Energy statically extend B2C potentialities without backend synergy.</p>
                        <div class="client-info">
                            <h6 class="mb-0">Adam Smith</h6>                                    
                        </div>
                    </div>
                </div>
                <div class="h2-feedback-single swiper-slide">
                    <div class="h2-feedback-content mt-1 bg-white rounded position-relative">
                        <div class="feedback-top mt-1 d-flex align-items-center justify-content-between">
                            <img src="<?=base_url()?>/assets/images/user.png" alt="client" class="rounded-circle mt-0 border border-2 border-white">
                            <span class="star-rating rounded-pill"><span class="me-2"><i class="fa-solid fa-star"></i></span>4.5</span>
                        </div>
                        <p class="mt-3 mb-4">Assertive disseminate integrated human capital through dynamic bandwidth. independent partnerships. Energy statically extend B2C potentialities without backend synergy.</p>
                        <div class="client-info">
                            <h6 class="mb-0">Adam Smith</h6>                                    
                        </div>
                    </div>
                </div>
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
    setTimeAll($("#dropoff_time"));
  }
  else if( hour <= 7 )
  {
    setTimeAll($("#pickup_time"));
    setTimeAll($("#dropoff_time"));
  }
  else
  {
    setTimeSpecial($("#pickup_time"), hour);
    setTimeAll($("#dropoff_time"));
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
    }
    else
    {
        $("#pickup_time").empty();
        setTimeSpecial($("#pickup_time"), hour);
    }

  });

  $("#dropoff_date").datetimepicker({
    format: 'DD-MM-Y',
    minDate:moment(today_date),
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

});

</script>