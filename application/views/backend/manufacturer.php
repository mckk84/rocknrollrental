  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url('admin/Bikes')?>">Bikes</a></li>
          <li class="breadcrumb-item active">Manufacturer</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Manufacturer <button type="button" data-bs-toggle="modal" data-bs-target="#add-manufacturer" class="btn btn-sm btn-primary float-right">Add <i class="bi bi-plus-circle ms-1"></i></button></h5>
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
                      <th scope="col">Name</th>
                      <th scope="col">Added By</th>
                      <th scope="col">Added On</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($records as $index => $row) {?>
                    <tr>
                      <th scope="row"><?=$row['id']?></th>
                      <td><?=$row['name']?></td>
                      <td><?=$row['created_by']?></td>
                      <td><?=date("d-m-Y h:m A", strtotime($row['created_date']))?></td>
                      <td><div class="d-flex justify-content-center">
                        <?php if( isset($user['user_type']) && $user['user_type'] == 'Admin' ){?>
                        <a title="Edit Record" href="javascript:void(0)" record-data="<?=$row['id']?>" class="edit-manaufacturer-record text-warning float-right mx-2"><i class="bi bi-pencil-fill"></i></a>
                        <a title="Delete Record" href="javascript:void(0)" record-data="<?=$row['id']?>" class="delete-record text-danger float-right mx-2"><i class="bi bi-trash-fill"></i></a>
                      <?php } else { ?>
                        <span class="d-inline fs-6 p-2">N/A</span>
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

  <div class="modal fade" id="add-manufacturer" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="addmanufacturer" action="<?=base_url('admin/Manufacturer/save_record')?>" method="POST">
            <input type="hidden" name="record_id" value="">
            <div class="modal-header">
              <h5 class="modal-title">Add Manufacturer</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-6">
                  <label for="validationDefault01" class="form-label">Name</label>
                  <input type="text" class="form-control" name="manufacturer_name" id="validationDefault01" value="" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="submitmanufacturer" type="button">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div><!-- End Disabled Backdrop Modal-->

  