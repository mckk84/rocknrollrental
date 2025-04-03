<main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url('admin/Bookings#')?>">Bookings</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <?php 
        $timings = array("07:30 AM","08:00 AM","08:30 AM","09:00 AM","09:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM","12:00 AM","12:30 AM","01:00 PM","01:30 PM","02:00 AM","02:30 PM","03:00 PM","04:00 PM","04:30 PM","05:00 PM","05:30 PM","06:00 PM","06:30 PM","07:00 PM","07:30 PM","08:00 PM");
        ?>
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
                <form id="mybooking_form" class="booking_form" method="POST" action="<?=base_url('admin/Bookings/save')?>">
                  <div class="row g-3">
                    <div class="col-md-4">
                      <div class="row mb-2">
                        <div class="col-md-6">
                              <label class="text-dark mb-1">Pickup date</label>
                              <input type="date" name="pickup_date" id="pickup_date" value="<?=date("Y-m-d", time())?>" class="form-control text-dark border w-100 rounded-2" placeholder="">
                        </div>
                        <div class="col-md-6">
                              <label class="text-dark mb-1">Time</label>
                              <select id="pickup_time" name="pickup_time" class="form-select">
                                <?php for ($i=0; $i < count($timings); $i++){?> 
                                  <option <?=($i==0)?"selected":""?> value="<?=$timings[$i]?>"><?=$timings[$i]?></option>  
                                <?php } ?>
                              </select>
                        </div>
                      </div>
                      <div class="row mb-2">
                        <div class="col-md-6">
                            <label class="text-dark mb-1">Dropoff date</label>
                            <input type="date" name="dropoff_date" id="dropoff_date" value="<?=date("Y-m-d", time())?>" class="form-control text-dark border w-100 rounded-2" placeholder="">
                        </div>
                        <div class="col-md-6">
                            <label class="text-dark mb-1">Time</label>
                            <select id="dropoff_time" name="dropoff_time" class="form-select">
                              <?php for ($i=0; $i < count($timings); $i++){?> 
                                  <option <?=($i == (count($timings) - 1) )?"selected":""?> value="<?=$timings[$i]?>"><?=$timings[$i]?></option>  
                                <?php } ?>
                            </select>
                        </div>
                      </div>
                      <div class="row mb-2">
                          <div class="col-md-6">
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
                            <button id="search_bike" class="w-50 btn btn-sm btn-warning" type="button">Search</button>
                          </div>
                      </div>                      
                      <div id="payment_form" class="row">
                        <div id="sumit_form" class="col-md-12 p-2">
                          <div class="row border-bottom p-2">
                            <div class="col-md-4">
                              <label class="d-block text-dark mt-2">Customer</label>
                            </div>
                            <div class="col-md-8">
                              <select id="customer_id" name="customer_id" class="form-select">
                                  <option value="">-Select-</option>
                                  <?php foreach($customers as $index => $row){?>
                                    <option value="<?=$row['id']?>"><?=$row['name']?> (<?=$row['phone']?>)</option>
                                  <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="row border-bottom p-2">
                            <div class="col-md-4">
                                <label class="text-dark align-middle">Free Helmet</label>
                            </div>
                            <div class="col-md-6">
                                <input type="checkbox" name="free_helmet" style="display:inline;width: 20px;height: 20px;vertical-align: bottom;" value="1">
                            </div>
                          </div>
                          <div class="row border-bottom p-2">
                            <div class="col-md-4">
                                <label class="text-dark align-middle">Extra Helmets</label>
                            </div>
                            <div class="col-md-8">
                                <input type="checkbox" name="helmets" style="display:inline;width: 20px;height: 20px;vertical-align: bottom;" value="1">
                                <span id="extra_helemt_block" style="display:none;margin-left:5px;" class="float-right w-60">
                                  <label class="w-20 float-left d-block p-1 text-dark align-middle">Qty:</label>
                                  <input type="number" style="line-height: 1rem;" class="w-30 form-control float-left text-dark p-1 px-2" name="helmets_qty" value="1">
                                </span>
                            </div>
                          </div>  
                          <div class="row border-bottom p-2">
                            <div class="col-md-4">
                                <label class="text-dark align-middle">Early Pickup</label>
                            </div>
                            <div class="col-md-6">
                                <input type="checkbox" name="early_pickup" style="display:inline;width: 20px;height: 20px;vertical-align: bottom;" value="1">
                            </div>
                          </div>                       
                        </div>
                      </div>
                      <div class="row mb-2">
                        <div id="sumit_row" class="col-md-12">
                        </div>
                      </div>
                    </div>
                    <div id="search_bikes_row" class="col-md-4">

                    </div>
                  </div>
                  <div class="row g-3">                    
                    <div id="cart_sidebar" class="col-md-8">
                      <div class="row">
                        <div id="bikes_row" class="col-md-8">
                        </div>
                      </div>
                      <div class="row">
                          <input type="hidden" name="vehicle_count" value="0">
                          <input type="hidden" name="vehicle_numbers" value="">
                          <div class="col-md-8 table-responisve">
                              <table class="table">
                                  <tr>
                                      <th class="text-start bg-warning" colspan="2">Order Summary</th>
                                  </tr>
                                  <tr>
                                      <th class="text-start">Bike Rental</th>
                                      <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="bike_total d-inline-block p-1"></span></th>
                                  </tr>
                                  <tr>
                                      <th class="text-start">GST</th>
                                      <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="order_gst d-inline-block p-1"></span></th>
                                  </tr>
                                  <tr>
                                      <th colspan="2" class="bg-warning-light text-center p-1">Addons</th>
                                  </tr>
                                  <tr style="display:none" id="helmets_row">
                                      <th class="text-start">Helmet</th>
                                      <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="helmet_total d-inline-block p-1">50</span></th>
                                  </tr>
                                  <tr style="display:none" id="earlypickup_row">
                                      <th class="text-start">Early Pickup</th>
                                      <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="earlypickup_charge d-inline-block p-1">200</span></th>
                                  </tr>
                                  <tr style="border-top:2px solid black;">
                                      <th class="text-start">Total</th>
                                      <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="total d-inline-block p-1"></span></td>
                                  </tr>
                                  <tr>
                                      <th class="text-start">Refundable Deposit</th>
                                      <td class="fw-bold text-end border-0"><i class="fa fa-indian-rupee-sign me-1"></i> <span class="refund_deposit d-inline-block p-1"></span></td>
                                  </tr>
                                  <tr>
                                      <th class="text-start">Final</th>
                                      <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="final_total d-inline-block p-1"></span></td>
                                  </tr>
                                  <tr>
                                      <th class="text-start">Payment Mode</th>
                                      <td class="fw-bold text-end">
                                        <div class="d-inline radio w-50 mb-2">
                                            <label class="fa-md"><input type="radio" name="paymentOption" value="PAY_FULL" onchange="updateCart()" checked> Full Payment</label>
                                        </div>
                                        <div class="d-inline radio w-50">
                                            <label class="fa-md"><input type="radio" name="paymentOption" value="PAY_PARTIAL" onchange="updateCart()"> Partial</label>
                                        </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <th class="text-start text-warning">Paid</th>
                                      <td class="fw-bold text-end"><input type="number" class="form-control w-50 float-right" name="paid" class="text-end" value="" /></td>
                                  </tr>                

                              </table>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row g-3">
                    <div class="col-md-8">
                      <div class="row g-3">
                        <div class="col-md-2 mb-2">
                          <label class="d-block text-dark mt-1">Pickup Status</label>
                        </div>
                        <div class="col-md-4 mb-2">
                          <select name="pickup_status" class="form-select">
                            <option>-Select-</option>
                            <option value="0">Pre Book</option>
                            <option value="1">Rented</option>
                          </select>
                        </div>
                      </div>
                      <div class="row g-3">
                        <div class="col-md-2 mb-2">
                          <label class="d-block text-dark mt-1">Refund Status</label>
                        </div>
                        <div class="col-md-4 mb-2">
                          <select name="refund_status" class="form-select">
                            <option>-Select-</option>
                            <option value="0">Pending</option>
                            <option value="1">Paid</option>
                          </select>
                        </div>
                      </div>
                      <div class="row g-3">
                        <div class="col-md-2 mb-2">
                          <label class="d-block text-dark mt-3">Delivery Notes</label>
                        </div>
                        <div class="col-md-6 mb-2">
                          <textarea name="delivery_notes" rows="2" class="form-control"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="save_row" class="row g-3">
                    <div class="col-md-4 text-end" >
                      <button type="button" id="new_booking_save" class="btn btn-primary">Submit</button>
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

    var vehicle_numbers = [];
    var vehicle_count = 0;

    function formatdate(dt)
    {
      var d = dt.split("-");
      return d[2]+"-"+d[1]+"-"+d[0];
    }

    let bike_url = '<?=base_url('bikes/')?>';

    function bike_added(id, rent_price)
    {
      var temp = (vehicle_numbers.length == 0) ? [] : JSON.parse(vehicle_numbers);
      if( $("#bike_"+id).is(":checked") )
      {
        vehicle_count = parseInt(vehicle_count) + 1;
        temp.push({"bike_id":id,"rent_price":rent_price});
      }
      else
      {
        vehicle_count = parseInt(vehicle_count) - 1;
        temp = temp.filter(item => item.bike_id !== id);
      }
      vehicle_numbers = JSON.stringify(temp);
      updateCart();
    }

    function updateCart()
    { 
      var total = 0;
      var bikes_total = 0;
      if( vehicle_count == 0 )
      {
        bikes_total = 0;
      }
      else
      {
        bikes_total = 0;
        var bikes = JSON.parse(vehicle_numbers);
        var bikes_qty = bikes.length;
        bikes_total = bikes.reduce(function (result, item) {
          return result + item.rent_price;
        }, 0);
      }

      var helmet_qty = 0;
      var helmet_total = 0;
      var early_pickup = 0;
      console.log("bikes_qty"+bikes_qty);
      if( $("input[name='helmets']").is(":checked") )
      {
        $("#helmets_row").show();
        var helmet_qty = $("input[name='helmets_qty']").val();
        helmet_total = helmet_qty * 50; 
      }
      if( $("input[name='early_pickup']").is(":checked") )
      {
        $("#earlypickup_row").show();
        early_pickup = 200 * bikes_qty; 
      }

      total = bikes_total + helmet_total + early_pickup;
      var order_gst = (bikes_total * 0.05).toFixed(2);
      var refund_deposit = 1000 * vehicle_count;

      $(".bike_total").html(bikes_total - order_gst);
      $(".helmet_total").html(helmet_total);
      $(".earlypickup_charge").html(early_pickup);
      $(".refund_deposit").html(refund_deposit);
      $(".order_gst").html(order_gst);
      $(".total").html(total);

      var final_amount = total;
      $(".final_total").html(final_amount);

      var pay_mode = $("input[name='paymentOption']:checked").val();
      if( pay_mode == 'PAY_FULL' )
      {
        $("input[name='paid']").val(final_amount);
      } 
      else
      {
        final_amount = parseFloat((bikes_total / 2).toFixed(2)) + parseFloat(helmet_total) + parseFloat(early_pickup);
        $("input[name='paid']").val(final_amount);
      }

      $("input[name='vehicle_count']").val(vehicle_count);
      $("input[name='vehicle_numbers']").val(JSON.stringify(vehicle_numbers));

    }

    $(document).ready(function()
    {

      $("input[name='vehicle_count']").val(vehicle_count);
      $("input[name='vehicle_numbers']").val(JSON.stringify(vehicle_numbers));

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

      $('#customer_id').select2({
        ajax: {
          url: '<?=base_url('admin/Customers/search')?>',
          data: function (params) {
            var query = {
              search: params.term,
            }
            return query;
          },
          processResults: function (data) {
            var response = JSON.parse(data);
            return {
              results: response.items
            };
          }
        }
      });

      $("#customer_id").change(function(){

        if( $(this).val() == "" ){
          $("#select2-customer_id-container").html("-Select-");
        }

      });

      $("input[name='helmets']").change(function(){
        if ($(this).is(":checked")) {
          $("input[name='helmets_qty']").val(1);
          $("#extra_helemt_block").slideDown();
          $("#helmets_row").show();
        } else {
          $("input[name='helmets_qty']").val(0);
          $("#extra_helemt_block").slideUp();
          $("#helmets_row").hide();
        }
        updateCart();
      });

      $("input[name='early_pickup']").change(function(){
        if ($(this).is(":checked")) {
          $("#earlypickup_row .earlypickup_charge").html("200");
          $("#earlypickup_row").slideDown();
        } else {
          $("#earlypickup_row .earlypickup_charge").html("");
          $("#earlypickup_row").slideUp();
        }
        updateCart();
      });

      $("input[name='helmets_qty']").change(function(){

        var val = $(this).val();
        if( val < 0 )
        {
          $(this).val(0);
        }
        else
        {
          updateCart();
        }
      });

      $("#search_bike").click(function(){

        vehicle_count = 0;
        vehicle_numbers = [];
        updateCart();

        $("#customer_id").val("");
        $("#select2-customer_id-container").html("-Select-");

        $(".booking_form #search_bike").prop("disabled", true);
        $(".booking_form #bikes_row").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Searching..");
        $(".booking_form #search_bikes_row").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Searching..");

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
                  $(".booking_form #search_bikes_row").html("");
                  return false;
                }
                else
                {
                  $(".booking_form #search_bike").prop("disabled", false);
                  
                  var html = "<table class='table datatable table-responsive rounded border'>";
                  html += "<tbody><tr><td class='bg-warning-light font-bold w-30'>Pickup</td><td><span class='d-block p-1 fs-8 font-bold'>"+formatdate(response.data.pickup_date)+" &nbsp;&nbsp;&nbsp; "+response.data.pickup_time+"</span></td></tr><tr><td class='bg-warning-light font-bold w-30'>Dropoff</td><td><span class='d-block p-1 fs-8 font-bold'>"+formatdate(response.data.dropoff_date)+" &nbsp;&nbsp;&nbsp; "+response.data.dropoff_time+"</span></td></tr><tr><td class='bg-warning-light font-bold w-30'>Duration</td><td><b>"+response.data.period_days+"</b> days, <b>"+response.data.period_hours+"</b> hours </td></tr><tr><td class='bg-warning-light font-bold w-30'>Holiday</td><td>"+((response.data.holiday)?"<span class='badge bg-success'>Yes</span>":"<span class='badge bg-danger'>No</span>")+"</td></tr><tr><td class='bg-warning-light font-bold w-30'>Public Holiday</td><td>"+((response.data.public_holiday)?"<span class='badge bg-success'>Yes</span>":"<span class='badge bg-danger'>No</span>")+"</td></tr><tr><td class='bg-warning-light font-bold w-30'>Weekend</td><td>"+((response.data.weekend)?"<span class='badge bg-success'>Yes</span>":"<span class='badge bg-danger'>No</span>")+"</td></tr></tbody></table>";

                  $(".booking_form #search_bikes_row").html(html);

                  html = "<table class='table datatable table-responsive rounded border text-center'>";
                  html += "<thead><tr><th class='bg-warning'>Id</th><th class='bg-warning'>Bike</th><th class='bg-warning'>Image</th><th class='bg-warning'>Vehicle Number</th><th class='bg-warning'>Rent Price</th></tr></thead>";
                  html += "<tbody>";
                  var bikes = response.data.cart_bikes;
                  for (var i = 0; i < bikes.length; i++) 
                  {
                    var row = bikes[i];
                    html += "<tr><td><div class='form-check'><input class='form-check-input' id='bike_"+row.bid+"' type='checkbox' style='height:20px;width:20px;' onchange='bike_added("+row.bid+", "+row.rent_price+")' class='bike_check' value='1'></div></td><td><span style='vertical-align:middle;'>"+row.bike_type_name+"</span></td><td><img style='max-width:50px;float:left;' class='img-fluid' src='"+bike_url+row.image+"'></td><td>"+row.vehicle_number+"</td><td>"+row.rent_price+"</td></tr>";
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

      // Ajax to save orderdata
      $("#new_booking_save").click(function(){

        updateCart();
        
        $("#new_booking_save").prop("disabled", true);
        $("#new_booking_save").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Saving..");
        
        var form = document.getElementById('mybooking_form');
        var formdata = new FormData(form);

        $("#save_row").find(".alert").each(function(){
          $(this).remove();
        });
        var url = $("#mybooking_form").attr('action');
        console.log(formdata);
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            processData: false,
            contentType: false,
            data: formdata, // Serialize form data
            success: function (response) 
            {
                console.log(response);
                if( response.error )
                {
                  $("#save_row").append("<div class='alert alert-danger mt-1 mb-0'>"+response.error_message+"</div>");
                  $("#new_booking_save").prop("disabled", false);
                  $("#new_booking_save").html("Submit");
                }
                else
                {
                  $("#save_row").append("<div class='alert alert-success mt-1 mb-0'>"+response.success_message+". Booking Id:<b>"+response.booking_id+"</b></div>");
                  //$("#new_booking_save").prop("disabled", false);
                  $("#new_booking_save").html("Success. Redirecting");
                  
                  setTimeout(function(){
                    window.location.href = '<?=base_url('admin/Bookings')?>';
                  }, 2000);
                }
            },
            error: function (data) {
                $("#save_row").append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                $("#new_booking_save").prop("disabled", false);
                $("#new_booking_save").html("Submit");
            }
        });

      });

    });

  </script>