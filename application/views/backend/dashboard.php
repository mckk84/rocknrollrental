  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12 p-0">
          <div class="row">

            <!-- Recent Sales -->
            <div class="col-6">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title px-2 mb-0">Recent Bookings</h5>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Bikes</th>
                        <th scope="col">Customer</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Total</th>   
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($records as $index => $row) {

                        $early_pickup = $row['early_pickup'];
                        $bikes_ordered = "";
                        $bk = explode(",", $row['bikes_types']);
                        $bk_qty = explode(",", $row['bikes_qty']);
                        $bikes_ordered = array();
                        $bikes_order = "";

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
                          $bikes_order .= ( $bikes_order == "" ) ? $name."(<b>".$qty."</b>)" : "<br/>".$name."(<b>".$qty."</b>)";
                        }

                        if( isset($row['helmet_quantity']) && $row['helmet_quantity'] > 0 )
                        {
                          $bikes_order .= "<br/>Helmet(<b>".$row['helmet_quantity']."</b>)";
                        }
                        ?>
                      <tr>
                        <td><a title="View Record" href="<?=base_url('admin/Bookings/view?bid='.$row['id'])?>" ><?=$row['id']?></a></td>
                        <td><?=$bikes_order?></td>
                        <td><?=$row['name']?><br/><?=$row['phone']?></td>
                        <td><?=date("d-m-Y", strtotime($row['pickup_date']))?><br/><?=$row['pickup_time']?></td>
                        <td><?=date("d-m-Y", strtotime($row['dropoff_date']))?><br/><?=$row['dropoff_time']?></td>
                        <td><?=$row['total_amount']?><br/><?=$row['paymentmode']?></td>
                        <td><?php if( $row['status'] == 0) { ?>
                          <span class="d-block mx-auto mb-1 py-2 badge bg-warning">Pre Booked</span>
                        <?php } else if($row['status'] == 1) { ?>
                          <span class="d-block mx-auto mb-1 py-2 badge bg-success">Rented</span>
                        <?php } else { ?>
                          <span class="d-block mx-auto mb-1 py-2 badge bg-info">Closed</span>
                        <?php } ?>
                        <a title="Edit" href="javascript:void(0)" record-data="<?=$row['id']?>" class="edit-booking-record btn btn-outline-primary btn-sm small py-1 px-2">EDIT</a>
                        </td>
                      </tr>
                       <?php } ?>
                    </tbody>
                  </table>  
                </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- Recent Sales -->
            <div class="col-6">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title px-2 mb-0">Returns Today</h5>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Bikes</th>
                        <th scope="col">Customer</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Total</th>   
                        <th scope="col">Action</th>   
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($returns as $index => $row) {

                        $early_pickup = $row['early_pickup'];
                        $bikes_ordered = "";
                        $bk = explode(",", $row['bikes_types']);
                        $bk_qty = explode(",", $row['bikes_qty']);
                        $bikes_ordered = array();
                        $bikes_order = "";

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
                          $bikes_order .= ( $bikes_order == "" ) ? $name."(<b>".$qty."</b>)" : "<br/>".$name."(<b>".$qty."</b>)";
                        }

                        if( isset($row['helmet_quantity']) && $row['helmet_quantity'] > 0 )
                        {
                          $bikes_order .= "<br/>Helmet(<b>".$row['helmet_quantity']."</b>)";
                        }
                        ?>
                      <tr>
                        <td><a title="View Record" href="<?=base_url('admin/Bookings/view?bid='.$row['id'])?>" class="mx-2"><?=$row['id']?></a></td>
                        <td><?=$bikes_order?></td>
                        <td><?=$row['name']?><br/><?=$row['phone']?></td>
                        <td><?=date("d-m-Y", strtotime($row['pickup_date']))?><br/><?=$row['pickup_time']?></td>
                        <td><?=date("d-m-Y", strtotime($row['dropoff_date']))?><br/><?=$row['dropoff_time']?></td>
                        <td><?=$row['total_amount']?><br/><?=$row['paymentmode']?></td>
                        <td>
                          <a title="Send Reminder in Whatsapp" class="btn btn-sm text-success" target="_blank" href="<?=base_url('admin/Bookings/whatsapp_reminder?bid='.$row['id'])?>"><i class="bi bi-whatsapp"></i></a>
                          <a title="Edit" href="javascript:void(0)" record-data="<?=$row['id']?>" class="edit-booking-record btn btn-sm text-warning"><i class="bi bi-pencil-fill"></i></a>
                        </td>
                      </tr>
                       <?php } ?>
                    </tbody>
                  </table>  
                </div>

              </div>
            </div><!-- End Recent Sales -->

          </div>
        </div><!-- End Left side columns -->
      

      </div>
    </section>

  </main><!-- End #main -->
  <script type="text/javascript">

    $(document).ready(function(){




    });

  </script>

  