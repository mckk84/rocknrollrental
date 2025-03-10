  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Bookings</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Bookings <a href="<?=base_url('admin/Bookings/new')?>" class="btn btn-primary float-right">New <i class="bi bi-plus-circle ms-1"></i></a></h5>
                <div class="d-inline showalert">
                  <?php if( count($records) == 0 ) { ?>
                  <div class="alert alert-danger m-2">No Records found.</div>
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
                      <th scope="col">Quantity</th>
                      <th scope="col">Total</th>
                      <th scope="col">Refund</th>   
                      <th scope="col">Paid</th>
                      <th scope="col">Pending</th>
                      <th scope="col">Payment Mode</th>
                      <th scope="col">Status</th>
                      <th scope="col">Notes</th>
                      <th scope="col">Added By</th>
                      <th scope="col">Added On</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($records as $index => $row) {

                      $helmet_total = 0;
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
                      <td>
                       <span class="w-100 p-1 fa-sm d-block"><?=date("d-m-Y", strtotime($row['pickup_date']))?></span>
                       <span class="w-100 p-1 fa-sm d-block"><?=$row['pickup_time']?></span>
                      </td>
                      <td><span class="w-100 p-1 fa-sm d-block"><?=date("d-m-Y", strtotime($row['dropoff_date']))?></span>
                        <span class="w-100 p-1 fa-sm d-block"><?=$row['dropoff_time']?></span></td>
                      <td><?=$row['quantity']?></td>
                      <td><?=$row['total_amount']?></td>
                      <td><?=$row['refund_amount']?></td>
                      <td><?=$row['booking_amount']?></td>
                      <td><?=$row['total_amount'] + $row['refund_amount'] - $row['booking_amount']?></td>
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
                      <td><?=($row['created_by'] == "") ? "ONLINE":$row['created_by']?></td>
                      <td><?=date("d-m-Y", strtotime($row['created_date']))?></td>
                      <td><div class="d-flex justify-content-start">
                        <a title="Edit Record" href="javascript:void(0)" record-data="<?=$row['id']?>" class="edit-booking-record text-warning float-right mx-2"><i class="bi bi-pencil"></i></a>
                        <a title="Delete Record" href="javascript:void(0)" record-data="<?=$row['id']?>" class="delete-record text-danger float-right mx-2"><i class="bi bi-trash"></i></a>
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

  <div class="modal fade" id="add-customer" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="addcustomer" action="<?=base_url('admin/Customers/save_record')?>" method="POST">
            <input type="hidden" name="record_id" value="">
            <div class="modal-header">
              <h5 class="modal-title">Add Customer</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-6">
                  <label for="validationDefault01" class="form-label">Name</label>
                  <input type="text" autocomplete="off" class="form-control" name="name" id="validationDefault01" value="" required>
                </div>
                <div class="col-md-6">
                  <label for="validationDefault02" class="form-label">Email</label>
                  <input type="text" autocomplete="off" class="form-control" name="email" id="validationDefault02" value="" required>
                </div>
                <div class="col-md-6">
                  <label for="validationDefault03" class="form-label">Phone</label>
                  <input type="tel" maxlength="10" autocomplete="off" class="form-control" name="phone" id="validationDefault03" value="" required>
                </div>
                <div class="col-md-6">
                  <label for="validationDefault04" class="form-label">Password</label>
                  <input type="password" autocomplete="off" class="form-control" name="password" id="validationDefault04" value="" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="submitcustomer" type="button">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div><!-- End Disabled Backdrop Modal-->

  