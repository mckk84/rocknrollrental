<!--breadcrumb section start-->
        <section class="breadcrumb-section position-relative overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/texture-bg.png">
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
                        <div class="car_listing_form w-100">
                            
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
                                    <?php if( isset($rentals) && count($rentals) == 0 ){ ?>
                                    <div class="row g-4">
                                        <span class="text-dark m-2 p-2">No records found.</span>                                    
                                    </div>
                                    <?php } else { ?>
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="shopping-cart-left">
                                                <?php 
                                                $subtotal = 0;
                                                $gst = 0;
                                                $total = 0;
                                                ?>
                                                <div class="table-content table-responsive table-bordered bg-white rounded">
                                                    <table class="table cartbikes">
                                                        <tr class="bg-eq-primary">
                                                            <th>Booking Id</th>
                                                            <th>Quantity</th>
                                                            <th>Period</th>
                                                            <th>Total</th>
                                                            <th>Paid</th>
                                                            <th>Status</th>
                                                        </tr>
                                                        <?php foreach($rentals as $row) { ?>
                                                            <tr>
                                                                <td>
                                                                    <h6 class="mb-0">#<?=$row['id']?></h6>
                                                                </td>
                                                                <td>
                                                                    <h6 class="mb-0"><?=$row['quantity']?></h6>
                                                                </td>
                                                                <td>
                                                                    <span class="w-100 m-2 p-2 fa-sm font-bold d-block"><?=date("d M Y", strtotime($row['pickup_date']))." <b>".$row['pickup_time']?></b></span>
                                                                    <span style="width:30px;display:block;margin:10px;text-align: center;color: black; background-color: #FFDD06; color: #ffffff; border-radius:20px; font-size:10px; padding:5px 10px;">to</span>
                                                                    <span class="w-100 m-2 p-2 fa-sm font-bold d-block"><?=date("d M Y", strtotime($row['dropoff_date']))." <b>".$row['dropoff_time']?></b></span>
                                                                </td>
                                                                <td><i class="fa fa-indian-rupee-sign me-1"></i><?=$row['total_amount']?></td>
                                                                <td><i class="fa fa-indian-rupee-sign me-1"></i><?=$row['booking_amount']?></td>
                                                                <td>
                                                                    <?php if( $row['status'] == 1 ){ ?>
                                                                        <button class="btn btn-sm btn-success">Complete</button>
                                                                    <?php } else { ?>
                                                                        <button class="btn btn-sm btn-warning">Pending</button>
                                                                    <?php } ?>                                                                        
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>                                                                            
                                    </div>
                                    <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--car listing section end-->