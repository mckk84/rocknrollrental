  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Bike Services</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Bike Services <button type="button" data-bs-toggle="modal" data-bs-target="#add-bike" class="btn btn-primary float-right">Add <i class="bi bi-plus-circle ms-1"></i></button></h5>
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
                      <th scope="col">Manufacturer</th>
                      <th scope="col">Bike Type</th>
                      <th scope="col">Number</th>
                      <th scope="col">Image</th>
                      <th scope="col">CC</th>
                      <th scope="col">Model</th>
                      <th scope="col">Color</th>
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
                      <td><?=$row['manufacturer']?></td>
                      <td><?=$row['bike_type']?></td>
                      <td><?=$row['vehicle_number']?></td>
                      <td><img src="<?=base_url('bikes/'.$row['image'])?>" style="width: 100px;"/></td>
                      <td><?=$row['cc']?></td>
                      <td><?=$row['model']?></td>
                      <td><?=$row['color']?></td>
                      <td><?=$row['created_by']?></td>
                      <td><?=date("d-m-Y h:m A", strtotime($row['created_date']))?></td>
                      <td><div class="d-flex justify-content-start">
                        <a title="Edit Record" href="javascript:void(0)" record-data="<?=$row['id']?>" class="edit-bike-record text-warning float-right mx-2"><i class="bi bi-pencil-fill"></i></a>
                        <a title="Delete Record" href="javascript:void(0)" record-data="<?=$row['id']?>" class="delete-record text-danger float-right mx-2"><i class="bi bi-trash-fill"></i></a>
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
    <div class="modal-dialog modal-xl">
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
                          <div class="col-md-12">
                            <label for="bikename" class="form-label">Bike Name</label>
                            <input type="text" class="form-control" name="name" id="bikename" placeholder="Bike Name" required>
                          </div>
                          
                          <div class="col-md-12">
                            <label for="bikenumber" class="form-label">Bike Number</label>
                            <input type="text" class="form-control" name="number" id="bikenumber" placeholder="Bike Number" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 p-2">
                        <img style="max-width:200px;border:1px solid grey;border-radius:2px;margin: auto;display: block;" id="preview_image" src="#" title="Preview Image" />
                      </div>
                    </div>

                  </div>

                  <div class="col-md-6">
                    <label for="manufacturer" class="form-label">Manufacturer</label>
                    <select id="manufacturer" name="manufacturer_id" class="form-select">
                      <option selected>-Select-</option>
                      <?php foreach($manufacturers as $index => $row) {?>
                      <option value="<?=$row['id']?>"><?=$row['name']?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="biketype" class="form-label">Bike Type</label>
                    <select id="biketype" name="type_id" class="form-select">
                      <option selected>-Select-</option>
                      <?php foreach($biketypes as $index => $row) {?>
                      <option value="<?=$row['id']?>"><?=$row['type']?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="cc" class="form-label">CC</label>
                    <input type="text" class="form-control" id="cc" name="cc" placeholder="CC" required>
                  </div>
                  <div class="col-md-4">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" id="color" class="form-control" name="color" placeholder="Color" required>
                  </div>
                  <div class="col-4">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" class="form-control" id="model" name="model" placeholder="Model" required>
                  </div>
                  <div class="col-md-4">
                    <label for="milage" class="form-label">Milage</label>
                    <input type="text" id="milage" class="form-control" name="milage" placeholder="Milage" required>
                  </div>
                  <div class="col-md-4">
                    <label for="weight" class="form-label">Weight</label>
                    <input type="text" id="weight" class="form-control" name="weight" placeholder="Weight" required>
                  </div>
                  <div class="col-4">
                    <label for="power" class="form-label">Power</label>
                    <input type="text" id="power" class="form-control" name="power" placeholder="Power" required>
                  </div>

                  <div class="col-md-12">
                    <label for="bikeimage" class="form-label">Bike Image</label>
                    <input type="file" class="form-control" onchange="loadFile(event)" id="bikeimage" name="image" placeholder="Bike Image">
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


<script>
  var loadFile = function(event) {
    var output = document.getElementById('preview_image');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
  