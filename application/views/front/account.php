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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-md-4 col-sm-12 mb-2">
                        <div class="product-details-tab-content bg-white border">
                            <ul class="account_tabs nav nav-tabs py-3 px-4 border-0 mt-0">
                                <li class="d-inline-block px-1 m-1"><a href="#basicinfo" id="tab_basicinfo" data-bs-toggle="tab" class="active"><i class="fa fa-user me-2"></i>Basic Info</a></li>
                                <li class="d-inline-block px-1 m-1"><a href="#changepassword" id="tab_changepassword" data-bs-toggle="tab"><i class="fa fa-gear me-2"></i>Change Password</a></li>
                                <li class="d-inline-block px-1 m-1"><a href="#rentals" data-bs-toggle="tab" id="tab_rentals"><i class="fa fa-book me-2"></i>Rentals</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-9 col-md-8 col-sm-12 mb-2 ">
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
                                                    <div class="col-xl-12 col-md-12 col-sm-6">
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
                                            <div class="col-12 overflow-auto">
                                                <?php $subtotal = 0;$gst = 0;$total = 0;?>
                                                <div style="min-width: 800px;" class="table table-responsive bg-white rounded">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr class="bg-primary">
                                                                <th>#</th>
                                                                <th>Quantity</th>
                                                                <th>From</th>
                                                                <th>To</th>
                                                                <th>Total</th>
                                                                <th>Refund Amount</th>
                                                                <th>Paid</th>
                                                                <th>Status</th>
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
                                                                $bikes_order = ( $bikes_order == "" ) ? "<span class='w-100 m-2 p-2 fa-sm fw-bold d-inline'>".$name."(".$qty.")</span>" : "<span class='w-100 m-2 p-2 fa-sm fw-bold d-inline'>".$name."(".$qty.")</span>";
                                                              }
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?=$row['id']?>
                                                            </td>
                                                            <td>
                                                                <?=$bikes_order?>
                                                                <?php if( $row['helmet_quantity'] != 0) {?>
                                                                <span class="w-100 m-2 p-2 fa-sm fw-bold d-inline">Helmets: <?=$row['helmet_quantity']?></span>
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <span class="w-100 m-2 p-2 fa-sm d-inline"><?=date("d M Y", strtotime($row['pickup_date']))?></b></span>
                                                                <span class="w-100 m-2 p-2 fa-sm d-inline"><b><?=$row['pickup_time']?></b></span>
                                                            </td>
                                                            <td>
                                                                <span class="w-100 m-2 p-2 fa-sm d-inline"><?=date("d M Y", strtotime($row['dropoff_date']))?></b></span>
                                                                <span class="w-100 m-2 p-2 fa-sm d-inline"><b><?=$row['dropoff_time']?></b></span>
                                                            </td>
                                                            <td class="text-nowrap"><i class="fa fa-indian-rupee-sign me-1"></i><?=$row['total_amount']?></td>
                                                            <td class="text-nowrap"><i class="fa fa-indian-rupee-sign me-1"></i><?=$row['refund_amount']?></td>
                                                            <td class="text-nowrap"><i class="fa fa-indian-rupee-sign me-1"></i><?=$row['booking_amount']?></td>
                                                            <td>
                                                                <?php if( $row['status'] == 0 ){ ?>
                                                                    <span class="text-white p-1 px-2 border rounded-5 bg-warning font-sm text-nowrap">Pre Booked</span>
                                                                <?php } elseif( $row['status'] == 1 ){ ?>
                                                                    <span class="text-white p-1 px-2 border rounded-5 bg-success font-sm">Rented</span>
                                                                <?php }
                                                                else { ?>
                                                                    <span class="text-white p-1 px-2 border rounded-5 bg-info font-sm">Closed</span>
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