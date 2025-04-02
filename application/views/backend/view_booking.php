  <main id="main" class="main">
    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url('admin/Bookings')?>">Bookings</a></li>
          <li class="breadcrumb-item active">View Booking</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body w-75">
                <h5 class="card-title">Booking Id: #<?=$booking_id?>

                <?php if( isset($user['user_type']) && $user['user_type'] == 'Admin' ){?>
                  <a title="Edit Record" href="javascript:void(0)" record-data="<?=$booking_id?>" class="superedit-booking-record float-right btn btn-danger btn-sm mx-2">Edit</a>
                  <?php } else { ?>
                    <a title="Edit Record" href="javascript:void(0)" record-data="<?=$booking_id?>" class="edit-booking-record float-right btn btn-warning btn-sm mx-2">Edit</a>
                  <?php } ?>
              </h5>

                <table style="width:49%;float:left;" class="table table-responsive border rounded mb-2">
                  <tbody>
                    <tr>
                      <th class="bg-success-light w-30">Pickup Date</th><th><?=$order['pickup_date']." ".$order['pickup_time']?></th></tr>
                  </tbody>
                </table>
                <table style="width:51%;float:left;" class="table table-responsive border rounded mb-2">
                  <tbody>
                    <tr><th class="bg-success-light w-30">Dropoff Date</th><th><?=$order['dropoff_date']." ".$order['dropoff_time']?></th></tr>
                  </tbody>
                </table>
                <table style="width:49%;float:left;" class="table table-responsive border rounded mb-2">
                  <tbody>
                  <tr><th class="bg-success-light w-30">Customer</th><td class="fw-bold"><?=$customer['name']?> ( <?=$customer['phone']?>)</td></tr>
                  <tr><th class="bg-success-light">Bikes Ordered</th><td><?=$ordered_bikes?></td></tr>
                  <tr><th class="bg-success-light">Helmets </th><td class="fw-bold">Free Helmets: <?=$order['free_helmet']?>,&nbsp;&nbsp; Extra Helmet : <?=$order['helmet_quantity']?></td></tr>
                  <?php 
                  if( $order['notes'] != "" ) {?>
                      <tr><th class="bg-success-light">Notes:</th><td> <b><?=$order['notes']?></b></td></tr>
                  <?php } if( $order['early_pickup'] != 0 ) {?>
                      <tr><th class="bg-success-light">Early Pickup: </th><td><span class="badge bg-success">Yes</span></td></tr>
                  <?php } ?>
                  </tbody>
                </table>
                <table style="width:51%;float:right;" class="table table-responsive border rounded mb-2">
                  <tbody>      
                    <tr><th class="bg-success-light w-30">Duration</td><th> <?=$period_days?> days, <b><?=$period_hours?></b> hours</th></tr>
                    <tr><th class="bg-success-light">Weekend</th><td>
                      <?php if($weekend){
                          echo "<span class='badge bg-success'>Yes</span>";
                        }else{
                          echo "<span class='badge bg-danger'>No</span>";
                        }
                      ?></td></tr>
                      <tr><th class="bg-success-light">Public Holiday</th>
                        <td>
                          <?php 
                        if($public_holiday){
                          echo "<span class='badge bg-success'>Yes</span>";
                        }else{
                          echo "<span class='badge bg-danger'>No</span>";
                        }
                        ?>
                        </td>
                      </tr></tbody></table>

                

                <table class="table table-responsive rounded border text-center mb-2">
                <thead>
                  <tr><th class="bg-success-light text-center">#</th><th class="bg-success-light">Bike Type</th><th class="bg-success-light">Image</th>
                <th class="bg-success-light">Assigned Vehicle</th><th class="bg-success-light">Rent Price</th></tr></thead>
                <tbody>
                  <?php foreach($order_bike_types as $index => $row) { ?>
                    <tr>
                      <td><?=($index+1)?></td>
                      <td><?=$row['type']?></td>
                      <?php if(isset($row['image']) && $row['image'] !== ""){?>
                      <td><img style="width:50px;margin:auto;display:block;" class="img-fluid" src="<?=base_url("bikes/".$row['image'])?>" ></td>
                      <?php } else { ?>
                      <td><img style="width:24px;margin:auto;display:block;" class="img-fluid" src="<?=base_url("assets/admin/assets/img/bike.png")?>" ></td>
                      <?php } ?>  
                      <td><?php if($row['vehicle_number'] != "") {?><span class="vh"><?=$row['vehicle_number']?><?php } else { ?>N/A<?php } ?></span></td>
                      <td><?=$row['rent_price']?></td>
                    </tr>   
                  <?php } ?>
                </tbody>
              </table >

                  <?php
                $total_amount = 0;
                $pending = 0;
                $helmet_total = 0;
                $early_pickup = 0;
                $bike_total = $order['total_amount'];
                if( $order['helmet_quantity'] > 0 )
                {
                    $helmet_total = $order['helmet_quantity'] * 50;
                }

                if( $order['early_pickup'] > 0 )
                {
                    $early_pickup = 200 * $order['quantity'];
                }

                $total_amount = $order['total_amount'] + $helmet_total + $early_pickup;
                $pending = $total_amount - $order['booking_amount'];
                ?>

                <div style='width:49%;float:left;' class="table-responisve">
                  <table class="table">
                  <tr>
                    <th class="text-start bg-success-light" colspan="2">Order Updaes</th></tr>
                  <tr>
                    <th class="w-30 text-start">Refund Status</th>
                    <td>
                      <?php if( $order['refund_status'] == 0) { ?>
                        <span class="badge bg-warning">Pending</span>
                      <?php } else if($order['refund_status'] == 1) { ?>
                        <span class="badge bg-success">Paid</span>
                      <?php } else { ?>
                        <span class="badge bg-info">Returned</span>
                      <?php } ?>
                    </td>
                  </tr>

                  <tr>
                    <th class="text-start">Pickup Status</th><td>
                    <?php if( $order['status'] == 0) { ?>
                        <span class="badge bg-success">Pre Booked</span>
                      <?php } else if($order['status'] == 1) { ?>
                        <span class="badge bg-success">Rented</span>
                      <?php } else { ?>
                        <span class="badge bg-info">Closed</span>
                      <?php } ?>
                      
                    </td>
                  </tr>

                  <tr><th class="text-start">Delivery Notes</th><td><?=$order['delivery_notes']?></td>
                  </tr>

                  </table>

                  <?php if( $user['user_type'] == "Admin" ) {?>
                  <table class="table">
                  <tr>
                    <th class="text-start bg-warning-light" colspan="2">Send Whatsapp Messages</th></tr>
                  <tr>
                  <tr>
                    <th class="w-30 text-start">First Reminder</th><td><a title="Send First Reminder message to Customer" class="fs-6" target="_blank" href="<?=base_url('admin/Bookings/whatsapp_pickup?bid='.$booking_id)?>"><i class="bi bi-whatsapp"></i></a></td></tr>
                  <tr>
                  <tr>
                    <th class="w-30 text-start">Second Reminder</th><td><a title="Send Second Reminder message to Customer" class="fs-6" target="_blank" href="<?=base_url('admin/Bookings/whatsapp_pickup_second?bid='.$booking_id)?>"><i class="bi bi-whatsapp"></i></a></td></tr>
                  <tr>
                  <tr>
                    <th class="w-30 text-start">Cancel Reminder</th><td><a title="Send Cancel Reminder message to Customer" class="fs-6" target="_blank" href="<?=base_url('admin/Bookings/whatsapp_cancel?bid='.$booking_id)?>"><i class="bi bi-whatsapp"></i></a></td></tr>
                  <tr>
                  </table>
                  <?php } ?>

                </div>

                <div style='float:right;' class="w-50 table-responisve">
                  <table class="table">
                    <tr><th class="text-start bg-success-light" colspan="3">Order Summary</th></tr>
                    <tr><th class="text-start">Bike Rental</th><th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="d-inline-block text-info p-1"><?=$order['total_amount'] - $order['gst']?></span></th>
                    </tr>
                    <tr><th class="text-start">GST</th>
                    <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="text-info d-inline-block p-1"><?=$order['gst']?></span></th></tr>

                    <?php if( $order['helmet_quantity'] > 0 || $order['early_pickup'] > 0  ){?>
                        <tr><th colspan="2" class="bg-success-light text-center">Addons </th></tr>
                    <?php } ?>

                    <?php if( $order['helmet_quantity'] > 0 ){?>
                        <tr><th class="text-start">Helmet </th><th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="text-info d-inline-block p-1"><?=$helmet_total?></span></th></tr>
                    <?php } ?>

                    <?php if( $order['early_pickup'] > 0 ){ ?>
                        <tr><th class="text-start">Early Pickup</th>
                        <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="text-info d-inline-block p-1"><?=$early_pickup?></span></th></tr>
                    <?php } ?>

                    
                    <tr><th class="bg-success-light text-start">Total</th>
                    <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="order_total text-info d-inline-block p-1"><?=$total_amount?></span></td>
                    </tr>
                    <tr>
                    <th class="text-start">Refundable Deposit</th>
                    <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i> <span class="text-info d-inline-block p-1"><?=$order['refund_amount']?></span></td>
                    </tr>
                    <tr><th class="text-start text-danger">Paid</th>
                    <td class="fw-bold text-danger text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="paid_amount text-info d-inline-block p-1"><?=$order['booking_amount']?></span></td></tr>
                    <tr><th class="text-start text-warning">Pending</th>
                    <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="pending_amount text-danger d-inline-block p-1"><?=$pending?></span></td></tr>                
                    </table>
                  </div>
              </div>
            </div>
          
        </div>

      </div>
    </section>
  </main>
  