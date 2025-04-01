<!--breadcrumb section start-->
        <section class="breadcrumb-section position-relative overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/texture-bg.png">
            <img src="<?=base_url()?>/assets/img/shapes/tire-print-left.png" alt="tire print" class="position-absolute start-0 z-1 tire-print">
            <img src="<?=base_url()?>/assets/img/shapes/tire-print-right.png" alt="tire print" class="position-absolute end-0 z-1 tire-print">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 mx-auto">
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
        <section class="product-details-tab-section pb-60 pt-60">
            <div class="container">
                <div class="row">
                    <div class="d-none d-md-block col-xl-3 col-md-4 col-sm-12 mb-2">
                        <div class="bg-white border">
                            <ul class="account_tabs nav nav-tabs py-3 px-4 border-0 mt-0">
                                <li class="d-inline-block px-1 m-1">
                                    <a href="#basicinfo" id="tab_basicinfo" data-bs-toggle="tab" class="active"><i class="fa fa-user me-2"></i>Basic Info</a></li>
                                <li class="d-inline-block px-1 m-1"><a href="#changepassword" id="tab_changepassword" data-bs-toggle="tab"><i class="fa fa-gear me-2"></i>Change Password</a></li>
                                <li class="d-inline-block px-1 m-1"><a href="#rentals" data-bs-toggle="tab" id="tab_rentals"><i class="fa fa-book me-2"></i>Rentals</a></li>
                                <li class="d-inline-block px-1 m-1"><a href="<?=base_url('/Auth/signoff')?>"><i class="fa fa-sign-out-alt me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-none dsm-block col-sm-12 dropdown">
                        <div class="w-100 d-flex justify-content-between align-items-center d-md-none px-4 py-4">
                            <span class="d-inline-block fs-4 mb-0">My Account </span>
                            <button type="button" class="dropdown-menu-toggle text-muted d-md-none btn-icon btn-sm ms-3 btn btn-outline-gray-400"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="1em" height="1em" fill="currentColor" class="bi bi-text-indent-left fs-3"><path d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708M7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"></path></svg>
                            </button>
                        </div>
                        <ul class="account_tabs nav nav-tabs dropdown-menu" role="menu" aria-labelledby="menu1">
                            <li class="d-inline-block px-1 m-1">
                                <a href="#basicinfo" id="tab_basicinfo" data-bs-toggle="tab" class="active"><i class="fa fa-user me-2"></i>Basic Info</a></li>
                            <li class="d-inline-block px-1 m-1"><a href="#changepassword" id="tab_changepassword" data-bs-toggle="tab"><i class="fa fa-gear me-2"></i>Change Password</a></li>
                            <li class="d-inline-block px-1 m-1"><a href="#rentals" data-bs-toggle="tab" id="tab_rentals"><i class="fa fa-book me-2"></i>Rentals</a></li>
                            <li class="d-inline-block px-1 m-1"><a href="<?=base_url('/Auth/signoff')?>"><i class="fa fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-9 col-md-8 col-sm-12 mb-2 ">
                        <?php $error = $this->session->flashdata('error');
                        if($error) { ?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                        <?php } ?>
                        <?php $success = $this->session->flashdata('success');
                            if($success) {
                        ?>
                        <div class="alert alert-success alert-dismissable">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                        <?php } ?>
                        <div class="product-details-tab-content border">
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
                                            <div class="col-xl-8 col-md-12 col-sm-12">
                                                <form class="form-control" id="update-password" method="POST" action="<?=base_url('Auth/changepassword')?>">
                                                    <div class="col-xl-12 col-md-12 col-sm-12">
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
                                        <?php } else { 

                                        $mobile = checkMobile();
                                        if( $mobile == false ) {
                                        ?>
                                        <div class="row g-4">
                                            <div class="col-12 overflow-auto">
                                                <?php $subtotal = 0;$gst = 0;$total = 0;?>
                                                <div style="min-width: 800px;" class="table table-responsive bg-white rounded">
                                                    <table class="table table-bordered small">
                                                        <thead>
                                                            <tr class="bg-primary">
                                                                <th style="width:5%;">#</th>
                                                                <th>Quantity</th>
                                                                <th>From</th>
                                                                <th>To</th>
                                                                <th>Total</th>
                                                                <th>Refund Amount</th>
                                                                <th>Paid</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($rentals as $row) { 

                                                              $bikes_ordered = array();
                                                              $bikes_order = "";
                                                              $bk = explode(",", $row['bikes_types']);
                                                              $bk_qty = explode(",", $row['bikes_qty']);
                                                              foreach($bk as $index => $bky)
                                                              {
                                                                if( isset( $bikes_ordered[ $biketypes[$bky] ] ) )
                                                                {
                                                                  $bikes_ordered[ $biketypes[$bky] ] = $bikes_ordered[ $biketypes[$bky] ] + $bk_qty[$index];
                                                                }
                                                                else
                                                                {
                                                                  $bikes_ordered[ $biketypes[$bky] ] = $bk_qty[$index];
                                                                }
                                                              }

                                                              foreach($bikes_ordered as $name => $qty)
                                                              {
                                                                $bikes_order .= ( $bikes_order == "" ) ? "<p class='d-inline-block m-1  fa-sm fw-bold'>".$name."(".$qty.")</p>" : ",<p class='d-inline-block m-1 fa-sm fw-bold'>".$name."(".$qty.")</span>";
                                                              }
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?=$row['id']?>
                                                            </td>
                                                            <td class="text-nowrap">
                                                                <?=$bikes_order?>
                                                                <?php if( $row['helmet_quantity'] != 0) {?>
                                                                <p class="d-block mt-2 fa-sm fw-bold">Helmets(<?=$row['helmet_quantity']?>)</p>
                                                                <?php } ?>
                                                            </td>
                                                            <td class="text-nowrap">
                                                                <span class="m-2 p-2 fa-sm d-block"><b><?=date("d M Y", strtotime($row['pickup_date']))?></b></span>
                                                                <span class="m-2 p-2 fa-sm d-block"><b><?=$row['pickup_time']?></b></span>
                                                            </td>
                                                            <td class="text-nowrap">
                                                                <span class=" m-2 p-2 fa-sm d-block"><b><?=date("d M Y", strtotime($row['dropoff_date']))?></b></span>
                                                                <span class=" m-2 p-2 fa-sm d-block"><b><?=$row['dropoff_time']?></b></span>
                                                            </td>
                                                            <td class="text-nowrap"><i class="fa fa-indian-rupee-sign me-1"></i><?=$row['total_amount']?></td>
                                                            <td class="text-nowrap"><i class="fa fa-indian-rupee-sign me-1"></i><?=$row['refund_amount']?></td>
                                                            <td class="text-nowrap"><i class="fa fa-indian-rupee-sign me-1"></i><?=$row['booking_amount']?></td>
                                                            <td>
                                                                <?php if( $row['status'] == 0 ){ ?>
                                                                    <span class="text-white p-1 px-2 border rounded-5 bg-warning font-sm text-nowrap">Pre Booked</span>
                                                                <?php } elseif( $row['status'] == 1 ){ ?>
                                                                    <span class="text-white p-1 px-2 border rounded-5 bg-success font-sm">Rented</span>
                                                                <?php } elseif( $row['status'] == 2 ){ ?>
                                                                    <span class="text-white p-1 px-2 border rounded-5 bg-success font-sm">Closed</span>
                                                                <?php } else { ?>
                                                                    <span class="text-white p-1 px-2 border rounded-5 bg-danger font-sm">Cancelled</span>
                                                                <?php } ?>                                                                           
                                                            </td>
                                                            <td class="text-nowrap">
                                                                <?php if( $row['status'] == 0 && checkOrderEdit($row['pickup_date'], $row['pickup_time']) ){ ?>
                                                                    <a title="Edit Booking" class="p-1 px-2 text-xl text-info editbooking" href="<?=base_url('Account/edit?id='.$row['id'])?>"><i class="fa fa-edit"></i></a>
                                                                    <a title="Cancel Booking" data-id="<?=$row['id']?>" class="p-1 px-2 text-xl text-danger cancellation" href="javascript:void(0)"><i class="fa fa-xmark-circle"></i></a>
                                                                <?php } else{ ?>
                                                                    <span class="d-inline-block p-1">N/A<span>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>                                                                            
                                        </div>
                                        <?php } else { ?>
                                        <!-- Mobile View -->
                                       <div class="row g-4">
                                            <div class="col-12 overflow-auto">
                                                <?php $subtotal = 0;$gst = 0;$total = 0;?>
                                                <div style="min-width: 800px;" class="table table-responsive bg-white rounded">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr class="bg-primary">
                                                                <th style="width:5%;">#</th>
                                                                <th>Quantity</th>
                                                                <th>From</th>
                                                                <th>To</th>
                                                                <th>Total</th>
                                                                <th>Refund Amount</th>
                                                                <th>Paid</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($rentals as $row) { 

                                                              $bikes_ordered = array();
                                                              $bikes_order = "";
                                                              $bk = explode(",", $row['bikes_types']);
                                                              $bk_qty = explode(",", $row['bikes_qty']);
                                                              foreach($bk as $index => $bky)
                                                              {
                                                                if( isset( $bikes_ordered[ $biketypes[$bky] ] ) )
                                                                {
                                                                  $bikes_ordered[ $biketypes[$bky] ] = $bikes_ordered[ $biketypes[$bky] ] + $bk_qty[$index];
                                                                }
                                                                else
                                                                {
                                                                  $bikes_ordered[ $biketypes[$bky] ] = $bk_qty[$index];
                                                                }
                                                              }

                                                              foreach($bikes_ordered as $name => $qty)
                                                              {
                                                                $bikes_order .= ( $bikes_order == "" ) ? "<p class='d-inline-block m-1  fa-sm fw-bold'>".$name."(".$qty.")</p>" : ",<p class='d-inline-block m-1 fa-sm fw-bold'>".$name."(".$qty.")</span>";
                                                              }
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?=$row['id']?>
                                                            </td>
                                                            <td class="text-nowrap">
                                                                <?=$bikes_order?>
                                                                <?php if( $row['helmet_quantity'] != 0) {?>
                                                                <p class="d-block mt-2 fa-sm fw-bold">Helmets(<?=$row['helmet_quantity']?>)</p>
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <span class="m-2 p-2 fa-sm d-inline"><b><?=date("d M Y", strtotime($row['pickup_date']))?>&nbsp;<?=$row['pickup_time']?></b></span>
                                                            </td>
                                                            <td>
                                                                <span class=" m-2 p-2 fa-sm d-inline"><b><?=date("d M Y", strtotime($row['dropoff_date']))?>&nbsp;<?=$row['dropoff_time']?></b></span>
                                                            </td>
                                                            <td class="text-nowrap"><i class="fa fa-indian-rupee-sign me-1"></i><?=$row['total_amount']?></td>
                                                            <td class="text-nowrap"><i class="fa fa-indian-rupee-sign me-1"></i><?=$row['refund_amount']?></td>
                                                            <td class="text-nowrap"><i class="fa fa-indian-rupee-sign me-1"></i><?=$row['booking_amount']?></td>
                                                            <td>
                                                                <?php if( $row['status'] == 0 ){ ?>
                                                                    <span class="text-white p-1 px-2 border rounded-5 bg-warning font-sm text-nowrap">Pre Booked</span>
                                                                <?php } elseif( $row['status'] == 1 ){ ?>
                                                                    <span class="text-white p-1 px-2 border rounded-5 bg-success font-sm">Rented</span>
                                                                <?php } elseif( $row['status'] == 2 ){ ?>
                                                                    <span class="text-white p-1 px-2 border rounded-5 bg-success font-sm">Closed</span>
                                                                <?php } else { ?>
                                                                    <span class="text-white p-1 px-2 border rounded-5 bg-danger font-sm">Cancelled</span>
                                                                <?php } ?>                                                                        
                                                            </td>
                                                            <td class="text-nowrap">
                                                                <?php if( $row['status'] == 0 ){ ?>
                                                                    <a data-id="<?=$row['id']?>" class="btn btn-sm p-1 btn-outline-info editbooking" href="javascript:void(0)">Edit</a>
                                                                    <a data-id="<?=$row['id']?>" class="btn btn-sm p-1 btn-outline-danger cancellation" href="javascript:void(0)">Cancel</a>
                                                                <?php } else { ?>
                                                                    <span class="d-inline-block p-1">N/A<span>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>                                                                            
                                        </div>
                                        <?php }

                                        } ?>
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

                $(".dropdown .dropdown-menu-toggle").click(function(){

                    $(".dropdown .dropdown-menu").slideToggle("fast");

                });

                $(".dropdown-menu a").click(function(){
                    $(".dropdown .dropdown-menu").slideToggle("fast");
                });

                $(".cancellation").click(function(){

                    var booking_id = $(this).attr('data-id');
                    $("#cancellation_form input[name='booking_id']").val(booking_id);
                    $("#cancellation_terms_view").modal("show");

                });

            });

        </script>