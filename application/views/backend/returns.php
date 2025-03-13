  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Returns</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Returns</h5>
                <div class="d-inline showalert">
                  <?php if( count($records) == 0 ) { ?>
                  <div class="alert alert-danger m-2">No Returns today.</div>
                  <?php } else { 
                   $error = $this->session->flashdata('error');
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
                </div>
                <table class="table datatable table-hover table-sm">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Bikes</th>
                      <th scope="col">Customer</th>
                      <th scope="col">From</th>
                      <th scope="col">To</th>
                      <th scope="col">Total</th>   
                      <th scope="col">Paid</th>
                      <th scope="col">Pending</th>
                      <th scope="col">Status</th>
                      <th scope="col">Del. Notes</th>
                      <th scope="col">Action</th>
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
                      <td><?=$row['total_amount']?></td>
                      <td><?=$row['booking_amount']?></td>
                      <td><?=($row['booking_amount'] > $row['total_amount'] ) ? 0: $row['total_amount'] - $row['booking_amount']?></td>
                      <td><?php if( $row['status'] == 0) { ?>
                        <span class="badge bg-warning">Pre Booked</span>
                      <?php } else if($row['status'] == 1) { ?>
                        <span class="badge bg-success">Rented</span>
                      <?php } else { ?>
                        <span class="badge bg-info">Closed</span>
                      <?php } ?>
                      </td>
                      <td><?=$row['delivery_notes']?></td>
                      <td>
                        <div class="d-flex justify-content-start">
                          <a title="Edit Record" href="javascript:void(0)" record-data="<?=$row['id']?>" class="edit-booking-record text-warning float-right mx-2"><i class="bi bi-pencil"></i></a>
                      </div></td>
                    </tr>
                     <?php } ?>
                  </tbody>
                </table>                
                <?php } ?>
              </div>
            </div>
          
        </div>

      </div>
    </section>

  </main><!-- End #main -->
  