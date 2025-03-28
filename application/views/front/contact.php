<?php
    $social = getSocial(); 
    ?>
<!--breadcrumb section start-->
        <section class="breadcrumb-section position-relative overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/texture-bg.png">
            <img src="<?=base_url()?>/assets/img/shapes/tire-print-left.png" alt="tire print" class="position-absolute start-0 z-1 tire-print">
            <img src="<?=base_url()?>/assets/img/shapes/tire-print-right.png" alt="tire print" class="position-absolute end-0 z-1 tire-print">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                            <h1 class="text-white">Contact</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--breadcrumb section end-->

        <!--contact section start-->
        <section class="contact-section ptb-60">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="contact-form-area bg-white rounded">
                            <h4 class="mb-3">Send your query</h4>
                            <form id="contactform" method="POST" action="<?=base_url('Contact/savequery')?>" class="ct-form-wrapper">
                                <div class="row g-4">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="input-field">
                                            <label class="fw-semibold text-secondary mb-1">Name</label>
                                            <input type="text" name="name" maxlength="100" required placeholder="Full Name" class="border w-100 rounded">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="input-field">
                                            <label class="fw-semibold text-secondary mb-1">Email</label>
                                            <input type="email" name="email" maxlength="100" required placeholder="Email" class="border w-100 rounded">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="input-field">
                                            <label class="fw-semibold text-secondary mb-1">Phone</label>
                                            <input type="tel" name="phone" maxlength="10" required placeholder="Phone" class="border w-100 rounded">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="input-field">
                                            <label class="fw-semibold text-secondary mb-1">Subject</label>
                                            <input type="text" name="subject" maxlength="100" required placeholder="Subject" class="border w-100 rounded">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="input-field">
                                            <label class="fw-semibold text-secondary mb-1">Message</label>
                                            <textarea placeholder="Message" name="message" class="border w-100 rounded" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-md mt-4" id="submitContactForm" type="button">Get in Touch</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="contact-sidebar-widget py-5 px-4 bg-white rounded mt-5 mt-xl-0">
                            <h4 class="mb-4">Contact Details</h4>
                            <ul class="fs-md">
                                <li class="fw-500"><strong class="fw-bold text-secondary">Address: </strong>Chokanna Street, near Mayura Hotel Opp:,Sai Angels School, Chikmagaluru,Karnataka - 577101</li>
                            </ul>
                            <hr class="mt-4 mb-4">
                            <ul class="contact-info">
                                <li class="d-flex align-items-center">
                                    <span class="icon-wrapper d-flex align-items-center justify-content-center rounded bg-light-primary rounded-circle flex-shrink-0"><i class="fa fa-phone"></i></span>
                                    <div class="ms-3 info-content">
                                        <span class="d-block">Call:</span>
                                        <a href="tel:905431478798">+91 9980318883</a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <span class="icon-wrapper d-flex align-items-center justify-content-center rounded bg-light-primary rounded-circle flex-shrink-0"><i class="fa fa-envelope"></i></span>
                                    <div class="ms-3 info-content">
                                        <span class="d-block">Email</span>
                                        <a href="maito:info@rocknrollrental.com">info@rocknrollrental.com</a>
                                    </div>
                                </li>
                            </ul>
                            <hr class="mt-30 mb-40">
                            <h6 class="mb-3">Social Share</h6>
                            <div class="contact-social">
                                <?php if( is_array($social) && $social['facebook'] != "" ){ ?>
                                <a href="<?=$social['facebook']?>"><i class="fa fa-facebook-f"></i></a>
                                <?php } ?>
                                <?php if( is_array($social) && $social['twitter'] != "" ){ ?>
                                <a href="<?=$social['twitter']?>"><i class="fa fa-twitter"></i></a>
                                <?php } ?>
                                <?php if( is_array($social) && $social['instagram'] != "" ){ ?>
                                <a href="<?=$social['instagram']?>"><i class="fa fa-instagram"></i></a>
                                <?php } ?>
                                <?php if( is_array($social) && $social['youtube'] != "" ){ ?>
                                <a href="<?=$social['youtube']?>"><i class="fa fa-youtube"></i></a>
                                <?php } ?> 
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--contact section end-->

        <!--map area started-->
        <div class="map-area">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3882.4359797284947!2d75.76999691443766!3d13.323134090625947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbad9d801aee199%3A0x1e2ca0a8c0d38e3e!2sRock%20n%20Roll%20BIKES%20ON%20RENT!5e0!3m2!1sen!2sin!4v1575463006504!5m2!1sen!2sin" width="100%" height="480" frameborder="0" style="border:0;" loading="lazy" allowfullscreen=""></iframe>
        </div>
        <!--map area end-->