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
                <form class="booking_form" method="POST" action="<?=base_url('admin/Bookings/save')?>">
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
                      </div>
                      <div class="row mb-2">
                        <div class="col-md-6">
                            <label class="text-dark mb-1">Dropoff date</label>
                            <input type="date" name="dropoff_date" id="dropoff_date" value="<?=date("Y-m-d", time())?>" class="form-control text-dark border w-100 rounded-2" placeholder="">
                        </div>
                        <div class="col-md-6">
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
                            <button id="search_bike" class="btn btn-warning" type="button">Search</button>
                          </div>
                      </div>                      
                      <div id="payment_form" class="row p-2">
                        <div id="sumit_form" class="col-md-12 p-2">
                          <div class="row mb-2">
                            <div class="col-md-4">
                              <label class="text-dark mb-2">Customer</label>
                            </div>
                            <div class="col-md-6">
                              <select id="customer_id" name="customer_id" class="form-select">
                                  <?php foreach($customers as $index => $row){?>
                                    <option value="<?=$row['id']?>"><?=$row['name']?>(<?=$row['phone']?>)</option>
                                  <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="row mb-2">
                            <div class="col-md-4">
                                <label class="text-dark mb-2">Add Helmet</label>
                            </div>
                            <div class="col-md-6">
                                <input type="checkbox" name="helmets" style="display:inline;width: 20px;height: 20px;vertical-align: bottom;" value="1">
                                <input type="hidden" name="helmets_qty" value="0"> 
                            </div>
                          </div>  
                          <div class="row mb-2">
                            <div class="col-md-4">
                                <label class="text-dark mb-2">Early Pickup</label>
                            </div>
                            <div class="col-md-6">
                                <input type="checkbox" name="early_pickup" style="display:inline;width: 20px;height: 20px;vertical-align: bottom;" value="1">
                                <input type="hidden" name="early_pickup" value="0"> 
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
                        <div id="bikes_row" class="col-md-12">
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12 table-responisve">
                              <table class="table">
                                  <tr>
                                      <th class="text-start bg-warning" colspan="2">Cart Total</th>
                                  </tr>
                                  <tr>
                                      <th class="text-start">Bike Total</th>
                                      <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="bike_total d-inline-block p-1"></span></th>
                                  </tr>
                                  <tr style="display:none" id="helmets_row">
                                      <th class="text-start">Helmet <input type="number" name="helmets_qty" style="max-width: 100px;display: inline;margin-left: 25px;" class="cart-helmets form-control" value="0"></th>
                                      <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="helemt_total d-inline-block p-1">50</span></th>
                                  </tr>
                                  <tr style="display:none" id="earlypickup_row">
                                      <th class="text-start">Early Pickup</th>
                                      <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="earlypickup_charge d-inline-block p-1">200</span></th>
                                  </tr>
                                  <tr>
                                      <th class="text-start">GST</th>
                                      <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="order_gst d-inline-block p-1"></span></th>
                                  </tr>
                                  <tr>
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
                                      <td class="fw-bold text-end"><input type="number" name="paid" class="text-end" value="" /></td>
                                  </tr>                

                              </table>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row g-3">
                    <div class="col-md-4" >
                      <button type="submit" class="btn btn-primary">Submit</button>
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
      if( vehicle_count == 0 )
      {
        total = 0;
      }
      else
      {
        total = 0;
        var bikes = JSON.parse(vehicle_numbers);
        total = bikes.reduce(function (result, item) {
          return result + item.rent_price;
        }, 0);
      }

      var bikes_total = total - Math.round(total * 0.05, 2);
      var order_gst = Math.round(bikes_total * 0.05, 2);
      var refund_deposit = 1000 * vehicle_count;
      $(".bike_total").html(bikes_total);
      $(".refund_deposit").html(refund_deposit);
      $(".order_gst").html(order_gst);
      $(".total").html(total);

      var final_amount = total + refund_deposit;
      $(".final_total").html(final_amount);

      var pay_mode = $("input[name='paymentOption']:checked").val();
      if( pay_mode == 'PAY_FULL' )
      {
        $("input[name='paid']").val(final_amount);
      } 
      else
      {
        $("input[name='paid']").val(Math.round(final_amount/2, 2));
      }

    }

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

      $("#customer_id").select2();

      $("input[name='helmets']").change(function(){
        if ($(this).is(":checked")) {
          $("#helmets_row input[name='helmets_qty']").val(1);
          $("#helmets_row").slideDown();
        } else {
          $("#helmets_row input[name='helmets_qty']").val(0);
          $("#helmets_row").slideUp();
        }
      });

      $("input[name='early_pickup']").change(function(){
        if ($(this).is(":checked")) {
          $("#earlypickup_row .earlypickup_charge").html("200");
          $("#earlypickup_row").slideDown();
        } else {
          $("#earlypickup_row .earlypickup_charge").html("");
          $("#earlypickup_row").slideUp();
        }
      });

      $("#search_bike").click(function(){

        vehicle_count = 0;
        vehicle_numbers = [];
        updateCart();
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
                  
                  var html = "<table class='table datatable table-responsive border rounded mb-1'>";
                  html += "<tbody><tr><td class='font-bold w-50'>Pickup</td><td><span class='d-block p-1 font-bold'>"+formatdate(response.data.pickup_date)+" "+response.data.pickup_time+"</span></td></tr><tr><td class='font-bold w-50'>Dropoff</td><td><span class='d-block p-1 font-bold'>"+formatdate(response.data.dropoff_date)+" "+response.data.dropoff_time+"</span></td></tr><tr><td class='font-bold w-50'>Duration</td><td><b>"+response.data.period_days+"</b> days, <b>"+response.data.period_hours+"</b> hours </td></tr><tr><td class='font-bold w-50'>Holiday</td><td>"+((response.data.holiday)?"<span class='badge bg-success'>Yes</span>":"<span class='badge bg-danger'>No</span>")+"</td></tr><tr><td class='font-bold w-50'>Public Holiday</td><td>"+((response.data.public_holiday)?"<span class='badge bg-success'>Yes</span>":"<span class='badge bg-danger'>No</span>")+"</td></tr><tr><td class='font-bold w-50'>Weekend</td><td>"+((response.data.weekend)?"<span class='badge bg-success'>Yes</span>":"<span class='badge bg-danger'>No</span>")+"</td></tr></tbody></table>";

                  $(".booking_form #search_bikes_row").html(html);

                  html = "<table class='table datatable table-responsive rounded border'>";
                  html += "<thead><tr><th class='bg-warning'>Id</th><th class='bg-warning'>Bike</th><th class='bg-warning'>Image</th><th class='bg-warning'>CC</th><th class='bg-warning'>Model</th><th class='bg-warning'>Vehicle Number</th><th class='bg-warning'>Rent Price</th><th class='bg-warning'>Available</th></tr></thead>";
                  html += "<tbody>";
                  var bikes = response.data.cart_bikes;
                  for (var i = 0; i < bikes.length; i++) 
                  {
                    var row = bikes[i];
                    html += "<tr><td><div class='form-check'><input class='form-check-input' id='bike_"+row.bid+"' type='checkbox' style='height:20px;width:20px;' onchange='bike_added("+row.bid+", "+row.rent_price+")' class='bike_check' value='1'></div></td><td><span style='vertical-align:middle;'>"+row.bike_type_name+"</span></td><td><img style='max-width:50px;float:left;' class='img-fluid' src='"+bike_url+row.image+"'></td><td>"+row.cc+"</td><td>"+row.model+"</td><td>"+row.vehicle_number+"</td><td>"+row.rent_price+"</td><td>"+((row.available)?"<span class='badge bg-success'>Yes</span>":"<span class='badge bg-danger'>No</span>")+"</td></tr>";
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