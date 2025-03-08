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

                <!-- <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div> -->

                <div class="card-body">
                  <h5 class="card-title">Recent Bookings</h5>

                  <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Bikes</th>
                      <th scope="col">Customer</th>
                      <th scope="col">From</th>
                      <th scope="col">To</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Total</th>   
                      <th scope="col">Paid</th>
                      <th scope="col">Payment Mode</th>
                      <th scope="col">Status</th>
                      <th scope="col">Notes</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($records as $index => $row) {

                      $bikes_ordered = "";
                      $bk = explode(",", $row['bikes_types']);
                      $bk_qty = explode(",", $row['bikes_qty']);
                      foreach($bk as $index => $bky)
                      {
                        $ob = $biketypes[$bky]." (".$bk_qty[$index].")";
                        $bikes_ordered = ($bikes_ordered == "") ? $ob : $bikes_ordered."<br/>".$ob ;
                      }
                      if( isset($row['helmet_quantity']) && $row['helmet_quantity'] > 0 )
                      {
                        $bikes_ordered .= "<br/>Helmet(".$row['helmet_quantity'].")";
                      }
                      ?>
                    <tr>
                      <td scope="row"><?=$row['id']?></td>
                      <td><?=$bikes_ordered?></td>
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
                      <td><?=$row['notes']?></td>
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

  