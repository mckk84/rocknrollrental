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
                <h5 class="card-title">Bike Services <button type="button" data-bs-toggle="modal" data-bs-target="#add-bike-service" class="btn btn-primary float-right">Add <i class="bi bi-plus-circle ms-1"></i></button></h5>
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
                      <th scope="col">Service Type</th>
                      <th scope="col">Start Date</th>
                      <th scope="col">End Date</th>
                      <th scope="col">Service Provder</th>
                      <th scope="col">Service Status</th>
                      <th scope="col">Service Cost</th>
                      <th scope="col">Note</th>
                      <th scope="col">Added By</th>
                      <th scope="col">Added On</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($records as $index => $row) {
                      $bikes = "";
                      $n = explode(",", $row['names']);
                      $vns = explode(",", $row['vehicle_numbers']);
                      for($i=0; $i < count($n); $i++)
                      {
                        $bikes .= ($bikes == "") ? "" : ", ";
                        $bikes .= $n[$i]."(".$vns[$i].")";
                      }
                      ?>
                    <tr>
                      <th scope="row"><?=$row['id']?></th>
                      <td><?=$bikes?></td>
                      <td><?=$row['service_type']?></td>
                      <td><?=($row['service_start_date'] == "0000-00-00") ? "":date("d-m-Y", strtotime($row['service_start_date']));?></td>
                      <td><?=($row['service_date'] == "0000-00-00") ? "":date("d-m-Y", strtotime($row['service_date']));?></td>
                      <td><?=$row['service_proivder_name']?> (<?=$row['service_proivder_phone']?>)</td>
                      <td><?=$row['status']?></td>
                      <td><?=$row['service_cost']?></td>
                      <td><?=$row['request_note']?></td>
                      <td><?=$row['created_by']?></td>
                      <td><?=date("d-m-Y h:m A", strtotime($row['created_date']))?></td>
                      <td><div class="d-flex justify-content-start">
                        <a title="Edit Record" href="javascript:void(0)" record-data="<?=$row['id']?>" class="edit-bike-record text-warning float-right mx-2"><i class="bi bi-pencil-fill"></i></a>
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

  <div class="modal fade" id="add-bike-service" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <form id="addbikeservice" action="<?=base_url('admin/Bikeservice/save_record')?>" method="POST">
            <input type="hidden" name="record_id" value="">
            <div class="modal-header">
              <h5 class="modal-title">Bike for Service</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                  <div class="col-md-12">
                    <div class="row g-1 mb-4">
                      <div class="col-md-6">
                        <div class="row g-1">
                          <div class="col-md-12">
                            <label for="biketype" class="form-label">Bike Type</label>
                            <select id="biketype" name="type_id" class="form-select">
                              <option selected>-Select-</option>
                              <?php foreach($biketypes as $index => $row) {?>
                              <option value="<?=$row['id']?>"><?=$row['type']?></option>
                              <?php } ?>
                            </select>
                          </div>                          
                          <div class="col-md-12">
                            <label for="biketype" class="form-label">Select Bikes</label>
                            <div class="service_bikes table-responisve" style="height: 130px;overflow: auto;">
                              <table class="table table-bordered table-sm">
                                <thead><tr><th>Bike</th><th>Number</th><th>Status</th><th>Select</th></tr></thead>
                                <tbody>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="selection col-md-6 p-2">
                          
                      </div>
                    </div>

                    <div class="row g-1 mb-2">
                      <div class="col-md-12">
                        <label class="form-label border-bottom font-bold">Service Provider</label>
                        <div class="row g-1">
                          <div class="col-md-4 px-2">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="" class="form-control"  maxlength="200" required>
                          </div>                          
                          <div class="col-md-4 px-2">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="phone" value="" class="form-control" maxlength="10" required>
                          </div>
                          <div class="col-md-4 px-2">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" value="" class="form-control" maxlength="255" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 p-2 mb-2">
                        <label class="form-label border-bottom font-bold">Service Details</label>
                        <div class="row g-1">
                          <div class="col-md-4 px-2">
                            <label class="form-label">Service Type</label>
                            <input type="text" name="service_type" value="" class="form-control" maxlength="200" required>
                          </div>                          
                          <div class="col-md-4 px-2">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" value="" class="form-control" required>
                          </div>
                          <div class="col-md-4 px-2">
                            <label class="form-label">Close Date</label>
                            <input type="date" name="end_date" value="" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 p-2 mb-2">
                        <label class="form-label border-bottom font-bold">Service Details</label>
                        <div class="row g-1">
                          <div class="col-md-4 px-2">
                            <label class="form-label">Service Cost</label>
                            <input type="int" name="service_cost" value="" class="form-control" maxlength="10" required>
                          </div>
                          <div class="col-md-4 px-2">
                            <label class="form-label">Service Notes</label>
                            <input type="int" name="request_note" value="" class="form-control" maxlength="200">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="submitbikeservice" type="button">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div><!-- End Disabled Backdrop Modal-->


<script>

  const bs_url = '<?=base_url('admin/Bikeservice')?>';
  let selection_bikes = [];

  var loadFile = function(event) {
    var output = document.getElementById('preview_image');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

  function remove_selection(bike_id)
  {
    console.log(bike_id);
    var check = selection_bikes.filter(item => item.bike_id == bike_id);
    if( check.length > 0 ){
      var temp = selection_bikes.filter(item => item.bike_id !== bike_id);
      selection_bikes = temp;
      $("#bike_span_"+bike_id).remove();
    }
    console.log(selection_bikes);
  }

  function selection(bike_id, bike_name, vehicle_number)
  {
    if( $("#bike_"+bike_id).is(':checked') )
    {
      var check = selection_bikes.filter(item => item.bike_id == bike_id);
      if( check.length == 0 )
      {
        $(".selection").append('<span id="bike_span_'+bike_id+'" class="alert-success border rounded bg-success-light font-bold m-1 p-2 float-left" role="alert"><i class="bi bi-check-circle me-1"></i>'+bike_name+' ('+vehicle_number+') <button type="button" class="btn-sm p-1 text-danger border-0 bg-success-light" onclick="remove_selection('+bike_id+')">X</button></span>');
        selection_bikes.push({
          bike_id:bike_id, bike_name:bike_name,vehicle_number:vehicle_number
        });
      }
    }
    else
    {
      remove_selection(bike_id)
    }
  }

  $(document).ready(function(){

    $("#submitbikeservice").click(function(){
      event.preventDefault();
      $(this).prop('disabled', true);
      $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");

      let form = $("#addbikeservice");
      let mbody = $("#addbikeservice .modal-body");
      let url = $("#addbikeservice").attr('action');

      mbody.find(".alert").each(function(){
          $(this).remove();
      });
      console.log(selection_bikes);
      var bike_ids = selection_bikes.map(function(obj){
          return obj.bike_id;
      }).join(",");
      console.log(bike_ids);
      formData = form.serialize();
      formData += "&bike_ids="+bike_ids;

      $.ajax({
          type: "POST",
          url: url,
          data: formData,       
          success: function (data) {
              var d = JSON.parse(data);
              console.log(d);
              if( d.error == 1 )
              {
                  mbody.append("<div class='alert alert-danger mt-1 mb-0'>"+d.error_message+"</div>");
                  $("#submitbikeservice").prop('disabled', false);
                  $("#submitbikeservice").html("Submit");
              }
              else
              {
                  mbody.append("<div class='alert alert-success mt-1 mb-0'>"+d.success_message+"</div>");
                  $("#submitbikeservice").html("Success");
                  setTimeout(function(){
                      window.location.reload();
                  }, 2000);
              }
          },
          error: function (data) {
              mbody.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
              $("#submitbikeservice").prop('disabled', false);
              $("#submitbikeservice").html("Submit");
          }
      });

    });

    $("#biketype").change(function(){

      var type_id = $(this).val();
      var postdata = {
        type_id:type_id
      }

      let id = $(this).attr('record-data');
      let url = bs_url +"/getBikes";
      $.ajax({
          type: "POST",
          url: url,
          data: postdata,
          success: function (data) {
              console.log(data);
              var d = JSON.parse(data);
              $(".service_bikes tbody").html("");
              var html = "";
              if( d.data.length > 0 )
              {
                for(var i=0; i < d.data.length; i++)
                {
                  var obj = d.data[i];
                  html += "<tr><td>"+obj.name+"</td><td>"+obj.vehicle_number+"</td><td>";
                  html += (obj.available==1)?"<span class='badge bg-success'>Available</span>":"<span class='badge bg-danger'>No</span>";
                  html += "</td><td><input type='checkbox' id='bike_"+obj.id+"' onchange='selection("+obj.id+",\""+obj.name+"\",\""+obj.vehicle_number+"\")' "+((obj.available==1)?"":"disabled")+" style='width:20px;height:20px;' class='form-check' class='bike_row'></td></tr>";
                }
                $(".service_bikes tbody").append(html);
              } 

          },
          error: function (data) {
              console.log("Error occured");
          }
      });

    });

  });
</script>
  