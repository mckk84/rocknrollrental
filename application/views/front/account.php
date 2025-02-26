<!--breadcrumb section start-->
        <section class="breadcrumb-section position-relative z-2 overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/texture-bg.png">
            <img src="<?=base_url()?>/assets/img/shapes/tire-print-left.png" alt="tire print" class="position-absolute start-0 z-1 tire-print">
            <img src="<?=base_url()?>/assets/img/shapes/tire-print-right.png" alt="tire print" class="position-absolute end-0 z-1 tire-print">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                            <h1 class="text-white">Account</h1>
                            <p class="text-white text-2xl">We care about you</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--breadcrumb section end-->
  
        <!--car listing section start-->
        <section class="car-listing-section ptb-120">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="car_listing_sidebar">
                            <h4 class="mb-2">Your Information</h4>
                            <div class="car_listing_nav mt-4">
                                <ul>
                                    <li><a href="#basic" class="active">Your Info</a></li>
                                    <li><a href="#price">Change Password</a></li>
                                    <li><a href="#info">Rental History</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <div class="car_listing_form w-75">
                            
                                <div class="listing_info_box border bg-white rounded" id="basic">
                                    <h5 class="mb-4">Welcome Back!</h5>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="d-flex justify-content-between">
                                                <label>Name</label>
                                                <span class="text-dark fw-bold"><?=$record['name']?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="d-flex justify-content-between mt-2">
                                                <label>Email</label>
                                                <span class="text-dark fw-bold"><?=$record['email']?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="d-flex justify-content-between mt-2">
                                                <label>Phone</label>
                                                <span class="text-dark fw-bold">+91 <?=$record['phone']?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="d-flex justify-content-between mt-2">
                                                <label>Registered since</label>
                                                <span class="text-dark fw-bold"><?=date("d-m-Y", strtotime($record['created_date']))?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="listing_info_box border bg-white rounded mt-40" id="price">
                                    <h4 class="mb-4">Change Password</h4>
                                    <div class="row">
                                        <form class="form-control" id="update-password" method="POST" action="<?=base_url('Auth/changepassword')?>">
                                            <div class="col-6 col-sm-5">
                                                <div class="input-field">
                                                    <label for="cp">Current Password</label>
                                                    <input type="password" autocomplete="off" id="cp" name="current_password" value="" required>
                                                </div>
                                                <div class="input-field">
                                                    <label>New Password</label>
                                                    <div class="meta-checkbox mt-1">
                                                        <input type="password" autocomplete="off" name="new_password" value="" required>
                                                    </div>
                                                </div>
                                                <div class="input-field">
                                                    <label>Retype Password</label>
                                                    <div class="meta-checkbox mt-1">
                                                        <input type="password" autocomplete="off" name="retype_password" value="" required>
                                                    </div>
                                                </div>
                                                <div class="input-field mt-4">
                                                    <button type="button" class="update-password btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="listing_info_box border bg-white rounded mt-40" id="info">
                                    <h5 class="mb-4">Rental History</h5>
                                    <div class="row g-4">
                                        <span class="text-dark m-2 p-2">No records found.</span>                                    
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--car listing section end-->