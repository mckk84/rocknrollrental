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

        <!--product details tab-section-->
        <section class="product-details-tab-section pb-120 pt-60">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="product-details-tab-content bg-white border">
                            <ul class="account_tabs nav nav-tabs py-3 px-4 border-0 mt-0">
                                <li class="d-inline-block px-1 m-1 w-100"><a href="#basicinfo" id="tab_basicinfo" data-bs-toggle="tab" class="active"><i class="fa fa-user me-2"></i>Basic Info</a></li>
                                <li class="d-inline-block px-1 m-1 w-100"><a href="#changepassword" id="tab_changepassword" data-bs-toggle="tab"><i class="fa fa-gear me-2"></i>Change Password</a></li>
                                <li class="d-inline-block px-1 m-1 w-100"><a href="#rentals" data-bs-toggle="tab" id="tab_rentals"><i class="fa fa-book me-2"></i>Rentals</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-9 border">
                            <div class="product-details-tab-content">
                                <div class="tab-content mt-0">
                                    <div class="tab-pane fade show active" id="basicinfo">
                                        <div class="description-tab-box bg-white pt-20 pb-20 px-4 rounded" id="specification">
                                            <h6 class="py-3 px-4 rounded bg-color">Basic Information</h6>
                                            <table class="mb-4">
                                                <tr>
                                                    <td>Name:</td>
                                                    <td><?=$record['name']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Email:</td>
                                                    <td><?=$record['email']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Phone:</td>
                                                    <td>+91 <?=$record['phone']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Registered Since:</td>
                                                    <td><?=date("d M Y", strtotime($record['created_date']))?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="changepassword">
                                        <div class="description-tab-box bg-white pt-20 pb-20 px-4 rounded" id="specification">
                                            <h6 class="py-3 px-4 rounded bg-color">Change Password</h6>
                                            <div class="row">
                                                <div class="col-8">
                                                    <form class="form-control" id="update-password" method="POST" action="<?=base_url('Auth/changepassword')?>">
                                                        <div class="col-12 col-sm-6">
                                                            <div class="input-field">
                                                                <label for="cp">Current Password</label>
                                                                <input type="password" class="form-control" autocomplete="off" id="cp" name="current_password" value="" required>
                                                            </div>
                                                            <div class="input-field">
                                                                <label>New Password</label>
                                                                <div class="meta-checkbox mt-1">
                                                                    <input type="password" class="form-control" autocomplete="off" name="new_password" value="" required>
                                                                </div>
                                                            </div>
                                                            <div class="input-field">
                                                                <label>Retype Password</label>
                                                                <div class="meta-checkbox mt-1">
                                                                    <input type="password" class="form-control" autocomplete="off" name="retype_password" value="" required>
                                                                </div>
                                                            </div>
                                                            <div class="input-field mt-4">
                                                                <button type="button" class="update-password btn btn-primary">Update</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="rentals">
                                        <div class="rentals bg-white rounded pt-20 pb-20 px-4">
                                            <h6 class="py-3 px-4 rounded bg-color">Rentals</h6>
                                            <?php if( isset($rentals) && count($rentals) == 0 ){ ?>
                                            <div class="row g-4">
                                                <span class="text-dark m-2 p-2">No records found.</span>                                    
                                            </div>
                                            <?php } else { ?>
                                            <div class="row g-4">
                                                <div class="col-12">
                                                    <?php $subtotal = 0;$gst = 0;$total = 0;?>
                                                    <div class="table border table-responsive bg-white rounded">
                                                        <table class="table">
                                                            <thead>
                                                                <tr class="bg-color">
                                                                    <th>Booking Id</th>
                                                                    <th>Quantity</th>
                                                                    <th>Period</th>
                                                                    <th>Total</th>
                                                                    <th>Paid</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach($rentals as $row) { ?>
                                                            <tr>
                                                                <td>
                                                                    <?=$row['id']?>
                                                                </td>
                                                                <td>
                                                                    <span class="w-100 m-2 p-2 fa-sm font-bold d-block">Bikes: <b><?=$row['quantity']?></b></span>
                                                                    <?php if( $row['helmet_quantity'] != 0) {?>
                                                                    <span class="w-100 m-2 p-2 fa-sm font-bold d-block">Helmets: <b><?=$row['helmet_quantity']?></b></span>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <span class="w-100 m-2 p-2 fa-sm font-bold d-block"><?=date("d M Y", strtotime($row['pickup_date']))." <b>".$row['pickup_time']?></b></span>
                                                                    <span style="width:30px;display:block;margin:auto;text-align: center;color: black; background-color: #FFDD06; color: #ffffff; border-radius:20px; font-size:10px; padding:5px 10px;">to</span>
                                                                    <span class="w-100 m-2 p-2 fa-sm font-bold d-block"><?=date("d M Y", strtotime($row['dropoff_date']))." <b>".$row['dropoff_time']?></b></span>
                                                                </td>
                                                                <td><i class="fa fa-indian-rupee-sign me-1"></i><?=$row['total_amount']?></td>
                                                                <td><i class="fa fa-indian-rupee-sign me-1"></i><?=$row['booking_amount']?></td>
                                                                <td>
                                                                    <?php if( $row['status'] == 0 ){ ?>
                                                                        <button class="btn btn-sm btn-warning">Pre Booked</button>
                                                                    <?php } elseif( $row['status'] == 1 ){ ?>
                                                                        <button class="btn btn-sm btn-success">Rented</button>
                                                                    <?php }
                                                                    else { ?>
                                                                        <button class="btn btn-sm btn-info">Closed</button>
                                                                    <?php } ?>                                                                        
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>                                                                            
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </section>
        <!--product details tab section end-->


        <script type="text/javascript">

            $(document).ready(function(){

                /*$(".account_tabs").find("a.btn_link").each(function(){
                    $(this).removeClass('active');
                });

                $(".account_tabs").find("a.btn_link").eq(0).addClass('active');*/

                /*$(".account_tabs a.btn_link").click(function(){

                    $(".account_tabs").find("a.btn_link.active").eq(0).removeClass('active');

                    $(this).addClass('active');
                    return true;
                });*/

            });

        </script>