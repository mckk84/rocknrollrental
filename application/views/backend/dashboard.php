  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Bookings</h5>

                  <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Bikes</th>
                      <th scope="col">Customer</th>
                      <th scope="col">From</th>
                      <th scope="col">To</th>
                      <th scope="col">Total</th>   
                      <th scope="col">Paid</th>
                      <th scope="col">Payment Mode</th>
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
                        $bikes_order = ( $bikes_order == "" ) ? $name."(".$qty.")" : "<br/>".$name."(".$qty.")";
                      }

                      if( isset($row['helmet_quantity']) && $row['helmet_quantity'] > 0 )
                      {
                        $bikes_order .= "<br/>Helmet(".$row['helmet_quantity'].")";
                      }
                      ?>
                    <tr>
                      <td scope="row"><?=$row['id']?></td>
                      <td><?=$bikes_order?></td>
                      <td><?=$row['name']?><br/><?=$row['email']?><br/><?=$row['phone']?></td>
                      <td><?=date("d-m-Y", strtotime($row['pickup_date']))?><br/><?=$row['pickup_time']?></td>
                      <td><?=date("d-m-Y", strtotime($row['dropoff_date']))?><br/><?=$row['dropoff_time']?></td>
                      <td><?=$row['quantity']?></td>
                      <td><?=$row['total_amount']?></td>
                      <td><?=$row['booking_amount']?></td>
                      <td><?=$row['paymentmode']?></td>
                      <td><?php if( $row['status'] == 0) { ?>
                        <span class="badge bg-warning">Pre Booked</span>
                      <?php } else if($row['status'] == 1) { ?>
                        <span class="badge bg-success">Rented</span>
                      <?php } else { ?>
                        <span class="badge bg-info">Closed</span>
                      <?php } ?>
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

  