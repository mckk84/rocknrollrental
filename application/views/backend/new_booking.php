<main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url('admin/Booings#')?>">Booings</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title mb-1">New Booking</h5>
                <div class="d-inline showalert">
                    <?php
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

                <!-- Multi Columns Form -->
                <form class="booking_form row g-3" method="POST" action="<?=base_url('admin/Booings/save_record')?>">
                  <div class="col-md-8">
                      <div class="row mb-2">
                          <div class="col-md-2">
                              <label class="text-dark mb-1">Pickup date</label>
                              <input type="date" name="pickup_date" id="pickup_date" value="<?=date("Y-m-d", time())?>" class="form-control text-dark border w-100 rounded-2" placeholder="">
                          </div>
                          <div class="col-md-2">
                              <label class="text-dark mb-1">Time</label>
                              <select id="pickup_time" name="pickup_time" class="form-select">
                                <option selected value="07:30 AM">07:30 AM</option>
                                <option value="08:00 AM">08:00 AM</option>
                                <option value="08:30 AM">08:30 AM</option>

                                <option value="09:00 AM">09:00 AM</option>
                                <option value="09:30 AM">09:30 AM</option>
                                <option value="10:00 AM">10:00 AM</option>
                                <option value="10:30 AM">10:30 AM</option>
                                <option value="11:00 AM">11:00 AM</option>
                                <option value="11:30 AM">11:30 AM</option>
                                
                                <option value="12:00 AM">12:00 PM</option>
                                <option value="12:30 AM">12:30 PM</option>
                                <option value="01:00 PM">01:00 PM</option>
                                <option value="01:30 PM">01:30 PM</option>
                                <option value="02:00 AM">02:00 PM</option>
                                <option value="02:30 PM">02:30 PM</option>
                                <option value="03:00 PM">03:00 PM</option>
                                <option value="04:00 PM">04:00 PM</option>
                                <option value="04:30 PM">04:30 PM</option>
                                <option value="05:00 PM">05:00 PM</option>
                                <option value="05:30 PM">05:30 PM</option>
                                <option value="06:00 PM">06:00 PM</option>
                                <option value="06:30 PM">06:30 PM</option>
                                <option value="07:00 PM">07:00 PM</option>
                                <option value="07:30 PM">07:30 PM</option>
                                <option value="08:00 PM">08:00 PM</option>
                              </select>
                          </div>
                        <div class="col-md-2">
                            <label class="text-dark mb-1">Dropoff date</label>
                            <input type="date" name="dropoff_date" id="dropoff_date" value="<?=date("Y-m-d", time())?>" class="form-control text-dark border w-100 rounded-2" placeholder="">
                        </div>
                        <div class="col-md-2">
                            <label class="text-dark mb-1">Time</label>
                            <select id="dropoff_time" name="dropoff_time" class="form-select">
                              <option value="07:30 AM">07:30 AM</option>
                                <option value="08:00 AM">08:00 AM</option>
                                <option value="08:30 AM">08:30 AM</option>

                                <option value="09:00 AM">09:00 AM</option>
                                <option value="09:30 AM">09:30 AM</option>
                                <option value="10:00 AM">10:00 AM</option>
                                <option value="10:30 AM">10:30 AM</option>
                                <option value="11:00 AM">11:00 AM</option>
                                <option value="11:30 AM">11:30 AM</option>
                                
                                <option value="12:00 AM">12:00 PM</option>
                                <option value="12:30 AM">12:30 PM</option>
                                <option value="01:00 PM">01:00 PM</option>
                                <option value="01:30 PM">01:30 PM</option>
                                <option value="02:00 AM">02:00 PM</option>
                                <option value="02:30 PM">02:30 PM</option>
                                <option value="03:00 PM">03:00 PM</option>
                                <option value="04:00 PM">04:00 PM</option>
                                <option value="04:30 PM">04:30 PM</option>
                                <option value="05:00 PM">05:00 PM</option>
                                <option value="05:30 PM">05:30 PM</option>
                                <option value="06:00 PM">06:00 PM</option>
                                <option value="06:30 PM">06:30 PM</option>
                                <option value="07:00 PM">07:00 PM</option>
                                <option value="07:30 PM">07:30 PM</option>
                                <option selected value="08:00 PM">08:00 PM</option>
                            </select>
                        </div>
                      </div>
                      <div class="row mb-2">
                          <div class="col-md-3">
                              <input type="hidden" id="bike_type_id" name="biketype" value="">
                              <div class="bikes_drop dropdown"> 
                                <button class="btn w-100 border dropdown-toggle"
                                    type="button"
                                    id="multiSelectDropdown"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"> 
                                  Select Bike
                                </button> 
                                <ul class="dropdown-menu"
                                  aria-labelledby="multiSelectDropdown"> 
                                  <?php foreach($biketypes as $index => $row) {?>
                                  <li> 
                                    <label> 
                                      <input type="checkbox" data-name="<?=$row?>" class="dropdown_check"
                                        value="<?=$index?>"> 
                                      <?=$row?> 
                                    </label> 
                                  </li> 
                                <?php } ?> 
                                </ul> 
                              </div> 

                          </div>
                          <div class="col-md-6">
                            <button id="search_bike" class="btn btn-warning" type="button">Search</button>
                          </div>
                      </div>
                      
                      <div class="row">
                        <div id="bikes_row" class="col-md-12">
                        </div>

                      </div>

                      <div class="row">
                        <div id="sumit_row" class="col-md-12">
                        </div>
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                      </div>
                  </div>
                </form><!-- End Multi Columns Form -->

                
              </div>
            </div>
          
        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <script type="text/javascript">

    function formatdate(dt)
    {
      var d = dt.split("-");
      return d[2]+"-"+d[1]+"-"+d[0];
    }

    let bike_url = '<?=base_url('bikes/')?>';

    $(document).ready(function()
    {
      var checkboxes = document.querySelectorAll("input[type=checkbox][class='dropdown_check']");
      let bike_ids = [];
      let bike_names = [];
      checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
          bike_ids = 
            Array.from(checkboxes) // Convert checkboxes to an array to use filter and map.
            .filter(i => i.checked) // Use Array.filter to remove unchecked checkboxes.
            .map(i => i.value) // Use Array.map to extract only the checkbox values from the array of objects.

          bike_names = 
            Array.from(checkboxes) // Convert checkboxes to an array to use filter and map.
            .filter(i => i.checked) // Use Array.filter to remove unchecked checkboxes.
            .map(i => i.getAttribute('data-name')) // Use Array.map to extract only the checkbox values from the array of objects.
            
          $("#bike_type_id").val(bike_ids.join(","));
          $("#multiSelectDropdown").text( (bike_names.length) ? "Selected ("+bike_names.length+")" : "Select Bike" );
        });
      });



      $("#search_bike").click(function(){

        $(".booking_form #search_bike").prop("disabled", true);
        $(".booking_form #bikes_row").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Searching..");

        var formdata = {
          bikeId:$(".booking_form input[name='biketype']").val(),
          pickup_date:$(".booking_form input[name='pickup_date']").val(),
          pickup_time:$(".booking_form #pickup_time").val(),
          dropoff_date:$(".booking_form input[name='dropoff_date']").val(),
          dropoff_time:$(".booking_form #dropoff_time").val(),
        };
        $("#sumit_row").find(".alert").each(function(){
          $(this).remove();
        });
        var url = '<?=base_url('admin/Bookings/search')?>';
        console.log(formdata);
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: formdata, // Serialize form data
            success: function (response) {
                console.log(response);
                if( response.error == 1 )
                {
                  $(".booking_form #search_bike").prop("disabled", false);
                  $(".booking_form #search_bike").html("Search");
                  $("#sumit_row").append("<div class='alert alert-danger mt-1 mb-0'>"+response.error_message+"</div>");
                  $(".booking_form #bikes_row").html("");
                  return false;
                }
                else
                {
                  $(".booking_form #search_bike").prop("disabled", false);
                  
                  var html = "<table class='table datatable table-responsive border mb-1'>";
                  html += "<thead><tr><th class='bg-success text-white'>Available</th><th class='bg-success  text-white'>Pickup</th><th class='bg-success  text-white'>Dropoff</th><th class='bg-success  text-white'>Duration</th><th class='bg-success  text-white'>Holiday</th><th class='bg-success  text-white'>Public Holiday</th><th class='bg-success  text-white'>Weekend</th></thead>";

                  html += "<tbody><tr><td><span class='d-block p-1 font-bold'>"+response.data.bike_availability+"</span></td><td><span class='d-block p-1 font-bold'>"+formatdate(response.data.pickup_date)+" <b>"+response.data.pickup_time+"</b></span></td><td><span class='d-block p-1 font-bold'>"+formatdate(response.data.dropoff_date)+" <b>"+response.data.dropoff_time+"</b></span></td><td><b>"+response.data.period_days+"</b> days,<b>"+response.data.period_hours+"</b> hours </td><td>Holiday</td><td><span class='d-block p-1 font-bold'>"+((response.data.public_holiday)?"Yes":"No")+"</span></td><td><span class='d-block p-1 font-bold'>"+((response.data.weekend)?"Yes":"No")+"</span></td></tbody></table>";

                  html += "<table class='table datatable table-responsive border'>";
                  html += "<thead><tr><th class='bg-warning'>Id</th><th class='bg-warning'>Bike</th><th class='bg-warning'>Image</th><th class='bg-warning'>CC</th><th class='bg-warning'>Model</th><th class='bg-warning'>Vehicle Number</th><th class='bg-warning'>Rent Price</th><th class='bg-warning'>Available</th><th class='bg-warning'>Action</th></tr></thead>";
                  html += "<tbody>";
                  var bikes = response.data.cart_bikes;
                  for (var i = 0; i < bikes.length; i++) 
                  {
                    var row = bikes[i];
                    html += "<tr><td>"+row.bid+"</td><td><span style='vertical-align:middle;'>"+row.bike_type_name+"</span></td><td><img style='max-width:50px;float:left;' class='img-fluid' src='"+bike_url+row.image+"'></td><td>"+row.cc+"</td><td>"+row.model+"</td><td>"+row.vehicle_number+"</td><td>"+row.weekend_day_price+"</td><td>"+((row.available)?"<span class='badge bg-success'>Yes</span>":"<span class='badge bg-danger'>No</span>")+"</td><td><div class='form-check'><input class='form-check-input' type='checkbox' style='height:20px;width:20px;' class='bike_check' value='1'></div></td></tr>";
                  }
                  html += "</tbody>";
                  html += "</table>";
                  $(".booking_form #bikes_row").html(html);

                }
            },
            error: function (data) {
                $("#sumit_row").append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                $(".booking_form #search_bike").prop("disabled", false);
                $(".booking_form #search_bike").html("Search");
            }
        });

      });

    });

  </script>