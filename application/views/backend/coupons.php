  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url('admin/Rentals#')?>">Rentals</a></li>
          <li class="breadcrumb-item active">Coupons</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Coupons <button type="button" data-bs-toggle="modal" data-bs-target="#add-coupon" class="btn btn-primary float-right">Add <i class="bi bi-plus-circle ms-1"></i></button></h5>
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
                      <th scope="col">Title</th>
                      <th scope="col">Code </th>
                      <th scope="col">Discount Amount</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Used</th>
                      <th scope="col">Type</th>
                      <th scope="col">Status</th>
                      <th scope="col">Start Date</th>
                      <th scope="col">End Date</th>
                      <th scope="col">Added By</th>
                      <th scope="col">Added On</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($records as $index => $row) {?>
                    <tr>
                      <th scope="row"><?=$row['id']?></th>
                      <td><?=$row['title']?></td>
                      <td><?=$row['code']?></td>
                      <td><?=$row['discount_amount']?></td>
                      <td><?=$row['quantity']?></td>
                      <td><?=$row['used']?></td>
                      <td><?=$row['type']?></td>
                      <td><?=$row['status']?></td>
                      <td><?=date("d-m-Y", strtotime($row['start_date']))?></td>
                      <td><?=date("d-m-Y", strtotime($row['end_date']))?></td>
                      <td><?=($row['created_by'] == "") ? "ONLINE":$row['created_by']?></td>
                      <td><?=date("d-m-Y h:m A", strtotime($row['created_date']))?></td>
                      <td><div class="d-flex justify-content-start">
                        <a title="Edit Record" href="javascript:void(0)" record-data="<?=$row['id']?>" class="edit-coupon-record text-warning float-right mx-2"><i class="bi bi-pencil-fill"></i></a>
                        <?php if( isset($user['user_type']) && $user['user_type'] == 'Admin' ){?>
                        <a title="Delete Record" href="javascript:void(0)" record-data="<?=$row['id']?>" class="delete-record text-danger float-right mx-2"><i class="bi bi-trash-fill"></i></a>
                        <?php } ?>
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

  <div class="modal fade" id="add-coupon" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="addcoupon" action="<?=base_url('admin/Coupons/save_record')?>" method="POST">
            <input type="hidden" name="record_id" value="">
            <div class="modal-header">
              <h5 class="modal-title">Add Coupon</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row mb-2">                
                <div class="col-md-6">
                  <label class="form-label">Title</label>
                  <input type="text" autocomplete="off" class="form-control" name="title" value="" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Code</label>
                  <input type="text" autocomplete="off" class="form-control" name="code" value="" required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-6">
                  <label class="form-label">Discount Amount</label>
                  <input type="number" autocomplete="off" class="form-control" name="discount_amount" value="" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Quantity</label>
                  <input type="number" maxlength="10" autocomplete="off" class="form-control" name="quantity" value="" required>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-6">
                  <label class="form-label">Type</label>
                  <select name="type" class="form-select">
                    <option value="percent">Percent</option>
                    <option value="fixed">Fixed</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Status</label>
                  <select name="status" class="form-select">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
              </div> 
              <div class="row mb-2">
                <div class="col-md-6">
                  <label class="form-label">Start Date</label>
                  <input type="date" autocomplete="off" class="form-control" name="start_date" value="" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">End Date</label>
                  <input type="date" maxlength="10" autocomplete="off" class="form-control" name="end_date" value="" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="submitcoupon" type="button">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div><!-- End Disabled Backdrop Modal-->

  