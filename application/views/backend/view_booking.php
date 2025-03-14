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
                <h5 class="card-title">Booking #<?=$booking_id?></h5>

                <table class="table table-responsive border rounded mb-2">
                  <tbody>
                    <tr>
                      <th class="bg-warning">Pickup Date</th>
                      <td><?=$order['pickup_date']." ".$order['pickup_time']?></td></tr>
                      <tr><th class="bg-warning">Dropoff Date</th><td><?=$order['dropoff_date']." ".$order['dropoff_time']?></td></tr>
                      <tr><td><b>Duration</b></td><td> <?=$period_days?> days, <b><?=$period_hours?></b> hours</td></tr>
                      <tr><td><b>Weekend </b></td><td>
                      <?php if($weekend){
                          echo "<span class='badge bg-success'>Yes</span>";
                        }else{
                          echo "<span class='badge bg-danger'>No</span>";
                        }
                      ?></td></tr>
                      <tr><td><b>Public Holiday </b></td>
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

                <table class="table table-responsive border rounded mb-2">
                <tbody>
                <tr><th class="bg-warning">Customer</th><td><?=$customer['name']?> ( <?=$customer['phone']?>)</td></tr>
                <tr><th class="bg-warning">Bikes Ordered</th><td><?=$ordered_bikes?></td></tr>
                <tr><th class="bg-warning"> Helmets </th><td><?=$order['helmet_quantity']?></td></tr>
                <?php 
                if( $order['notes'] != "" ) {?>
                    <tr><td>Notes:</td><td> <b><?=$order['notes']?></b></td></tr>
                <?php } if( $order['early_pickup'] != 0 ) {?>
                    <tr><td>Early Pickup: </td><td><span class="badge bg-success">Yes</span></td></tr>
                <?php } ?>
                </tbody></table>

                <table class="table table-responsive rounded border text-center mb-2">
                <thead>
                  <tr><th class="bg-warning text-center">#</th><th class="bg-warning">Bike Type</th><th class="bg-warning">Image</th>
                <th class="bg-warning">Assign Vehicle</th><th class="bg-warning">Rent Price</th></tr></thead>
                <tbody>
                  <?php foreach($order_bike_types as $index => $row) { ?>
                    <tr>
                      <td><?=$index?></td>
                      <td><?=$row['type']?></td>
                      <td><img style="width:50px;margin:auto;display:block;" class="img-fluid" src="<?=base_url("bikes/".$row['image'])?>" ></td>
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

                $total_amount = $order['total_amount'] - $helmet_total - $early_pickup;
                ?>

                <div style='width:49%;float:left;' class="table-responisve">
                  <table class="table">
                  <tr>
                    <th class="text-start bg-warning" colspan="2">Order Updaes</th></tr>
                  <tr>
                    <th class="text-start">Refund Status</th>
                    <th class="text-end">
                      <?php if( $order['refund_status'] == 0) { ?>
                        <span class="badge bg-warning">Pending</span>
                      <?php } else if($order['refund_status'] == 1) { ?>
                        <span class="badge bg-success">Paid</span>
                      <?php } else { ?>
                        <span class="badge bg-info">Returned</span>
                      <?php } ?>
                    </th>
                  </tr>

                  <tr>
                    <th class="text-start">Pickup Status</th><th class="text-end">
                    <?php if( $order['status'] == 0) { ?>
                        <span class="badge bg-warning">Pre Booked</span>
                      <?php } else if($order['status'] == 1) { ?>
                        <span class="badge bg-success">Rented</span>
                      <?php } else { ?>
                        <span class="badge bg-info">Closed</span>
                      <?php } ?>
                      
                    </th>
                  </tr>

                  <tr><th class="text-start">Delivery Notes</th><th class="text-end"><?=$order['delivery_notes']?></th>
                  </tr>

                  </table>
                </div>

                <div style='float:right;' class="w-50 table-responisve">
                  <table class="table">
                    <tr><th class="text-start bg-warning" colspan="3">Order Summary</th></tr>
                    <tr><th class="text-start">Bike Rental</th><th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="d-inline-block text-info p-1"><?=$order['total_amount'] - $order['gst']?></span></th>
                    </tr>

                    <?php if( $order['helmet_quantity'] > 0 ){?>
                        <tr><th class="text-start">Helmet </th><th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="text-info d-inline-block p-1"><?=$helmet_total?></span></th></tr>
                    <?php } ?>

                    <?php if( $order['early_pickup'] > 0 ){ ?>
                        <tr><th class="text-start">Early Pickup</th>
                        <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="text-info d-inline-block p-1"><?=$early_pickup?></span></th></tr>
                    <?php } ?>

                    <tr><th class="text-start">GST</th>
                    <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="text-info d-inline-block p-1"><?=$order['gst']?></span></th></tr>
                    <tr><th class="text-start">Total</th>
                    <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="order_total text-info d-inline-block p-1"><?=$order['total_amount']?></span></td>
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
  