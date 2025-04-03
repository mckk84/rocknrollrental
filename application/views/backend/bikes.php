  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Home</a></li>
          <li class="breadcrumb-item active">Bikes</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Bikes <button type="button" class="new-bike btn btn-sm btn-primary float-right">Add <i class="bi bi-plus-circle ms-1"></i></button></h5>
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
                      <th scope="col">Bike Type</th>
                      <th scope="col">Vehicle Number</th>
                      <th scope="col">Image</th>
                      <th scope="col">Available</th>
                      <th scope="col">Added By</th>
                      <th scope="col">Added On</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($records as $index => $row) {?>
                    <tr>
                      <th scope="row"><?=$row['id']?></th>
                      <td><?=$row['bike_type']?></td>
                      <td><span class="vh"><?=$row['vehicle_number']?></span></td>
                      <td><img src="<?=base_url('bikes/'.$row['image'])?>" style="width: 100px;"/></td>
                      <td><?=($row['available'] == 1 ? "<span class='badge bg-success'>Yes</span>":"<span class='badge bg-danger'>No</span>") ?></td>
                      <td><?=$row['created_by']?></td>
                      <td><?=date("d-m-Y h:m A", strtotime($row['created_date']))?></td>
                      <td><div class="d-flex justify-content-center">
                        <?php if( isset($user['user_type']) && $user['user_type'] == 'Admin' ){?>
                        <a title="Delete Record" href="javascript:void(0)" record-data="<?=$row['id']?>" class="delete-record fs-6 text-danger float-right mx-2"><i class="bi bi-trash-fill"></i></a>
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

  <div class="modal fade" id="add-bike" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <form id="addbike" action="<?=base_url('admin/Bikes/save_record')?>" method="POST" encypt="multipart/data">
            <input type="hidden" name="record_id" value="">
            <div class="modal-header">
              <h5 class="modal-title">Add Bike</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                  <div class="col-md-12">
                    <div class="row g-1">
                      <div class="col-md-6">
                        <div class="row g-1">
                          <div class="col-md-12 mb-4">
                            <label for="bike_type" class="form-label">Bike type</label>
                            <select id="bike_type" name="type_id" class="form-select">
                              <option selected value="0">-Select-</option>
                              <?php foreach($biketypes as $index => $row) {?>
                              <option value="<?=$row['id']?>"><?=$row['type']?></option>
                              <?php } ?>
                            </select>  
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 p-2">
                        <img class="shadow" style="max-width:150px;border:1px solid lightgrey;border-radius:2px;margin: auto;display: block;" id="preview_image" src="<?=base_url('assets/images/motorcyclist.png')?>" title="Preview Image" />
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-12">
                    <table class="tablebikes table table-bordered">
                      <thead><tr><th>#Sl</th><th>Vehicle Number</th><th>Action</th></tr></thead>
                      <tbody>
                        <tr><td>#1</td><td><input type="text" class="vehicle_number form-control" id="vehicle_number1" name="vehicle_number1" placeholder="Vehicle Number" required></td><td><a class="addrow fs-6 text-info" title="Add"><i class="bi bi-plus-circle"></a></td></tr>
                      </tbody>
                    </table>
                  </div>

              </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="submitbike" type="submit">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div><!-- End Disabled Backdrop Modal-->


<script type="text/javascript">
  var loadFile = function(event) {
    var output = document.getElementById('preview_image');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

  function removerow(id)
  {
    document.getElementById('brow'+id).remove();
  }
</script>
  