<main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url('admin/Bookings#')?>">Bookings</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <?php
        $timings = array("07:30 AM","08:00 AM","08:30 AM","09:00 AM","09:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM","12:00 AM","12:30 AM","01:00 PM","01:30 PM","02:00 AM","02:30 PM","03:00 PM","04:00 PM","04:30 PM","05:00 PM","05:30 PM","06:00 PM","06:30 PM","07:00 PM","07:30 PM","08:00 PM");
        $bike_type_ids = "";
        $bike_type_names = "";
        $bike_type_array = [];
        $bike_type_qty = [];
        foreach($order_bike_types as $i => $row)
        {
          if( !in_array($row['type_id'], $bike_type_array) )
          {
            array_push($bike_type_array, $row['type_id']); 
            $bike_type_names .= ( $bike_type_names == "" ) ? $row['type'] : ",".$row['type'];
            $bike_type_qty[ $row['type'] ] = 1;
          }
          else
          {
            $bike_type_qty[ $row['type'] ] = $bike_type_qty[ $row['type'] ] + 1;
          }
        }
        $bike_type_ids = implode(",", $bike_type_array);
        $ordered_bike_qty = "";
        foreach($bike_type_qty as $btype => $bq)
        {
          $ordered_bike_qty .= "<span class='w-100 text-danger font-bold d-block'>".$btype." ( ".$bq." Nos. )</span>";
        }

        ?>
        <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title mb-1">Edit Booking</h5>
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
                <form id="mybooking_form" class="booking_form" method="POST" action="<?=base_url('admin/Bookings/update')?>">
                  <div class="row g-3">
                    <div class="col-md-4">
                      <div class="row mb-2">
                        <div class="col-md-6">
                              <label class="text-dark mb-1">Pickup date</label>
                              <input type="date" disabled name="pickup_date" id="pickup_date" value="<?=date("Y-m-d", strtotime($order['pickup_date']))?>" class="form-control text-dark border w-100 rounded-2" placeholder="">
                        </div>
                        <div class="col-md-6">
                              <label class="text-dark mb-1">Time</label>
                              <select id="pickup_time" disabled name="pickup_time" class="form-select">
                                <?php for ($i=0; $i < count($timings); $i++){?> 
                                  <option <?=($order['pickup_time']==$timings[$i])?"selected":""?> value="<?=$timings[$i]?>"><?=$timings[$i]?></option>  
                                <?php } ?>
                              </select>
                        </div>
                      </div>
                      <div class="row mb-2">
                        <div class="col-md-6">
                            <label class="text-dark mb-1">Dropoff date</label>
                            <input type="date" name="dropoff_date" disabled id="dropoff_date" value="<?=date("Y-m-d", strtotime($order['dropoff_date']))?>" class="form-control text-dark border w-100 rounded-2" placeholder="">
                        </div>
                        <div class="col-md-6">
                            <label class="text-dark mb-1">Time</label>
                            <select id="dropoff_time" disabled name="dropoff_time" class="form-select">
                                <?php for ($i=0; $i < count($timings); $i++){?> 
                                  <option <?=($order['dropoff_time']==$timings[$i])?"selected":""?> value="<?=$timings[$i]?>"><?=$timings[$i]?></option>  
                                <?php } ?>
                            </select>
                        </div>
                      </div>
                                           
                      <div id="payment_form" class="row p-2">
                        <div id="sumit_form" class="col-md-12 p-2">
                          <div class="row mb-2">
                            <div class="col-md-4">
                              <label class="text-dark font-bold">Bike Type</label>
                            </div>
                            <div class="col-md-8">
                              <input type="hidden" id="bike_type_id" name="biketype" value="<?=$bike_type_ids?>">
                              <span class="text-danger font-bold"><?=$bike_type_names?></span>
                              <!-- <div class="bikes_drop dropdown"> 
                                  <button class="btn w-100 border dropdown-toggle"
                                      type="button"
                                      id="multiSelectDropdown"
                                      data-bs-toggle="dropdown"
                                      aria-expanded="false"> 
                                    <?=$bike_type_names?>
                                  </button> 
                                  <ul class="dropdown-menu"
                                    aria-labelledby="multiSelectDropdown"> 
                                    <?php foreach($biketypes as $index => $row) {?>
                                    <li> 
                                      <label> 
                                        <input type="checkbox" data-name="<?=$row?>" class="dropdown_check"
                                          value="<?=$index?>" > 
                                        <?=$row?> 
                                      </label> 
                                    </li> 
                                  <?php } ?> 
                                  </ul> 
                                </div> --> 
                            </div>
                          </div> 
                          <div class="row mb-2">
                            <div class="col-md-4">
                              <label class="text-dark font-bold mb-1">Customer</label>
                            </div>
                            <div class="col-md-6 font-bold text-danger">
                              <?=$customer['name']?> (<?=$customer['phone']?>)
                            </div>
                          </div>
                          <div class="row mb-2">
                            <div class="col-md-4">
                                <label class="text-dark font-bold mb-2">Ordered Quantity</label>
                            </div>
                            <div class="col-md-6">
                                <?=$ordered_bike_qty?>
                            </div>
                          </div>   
                          <div class="row mb-2">
                            <div class="col-md-4">
                                <label class="text-dark font-bold mb-2">Payment Mode</label>
                            </div>
                            <div class="col-md-6 text-danger font-bold">
                                <?=$order['paymentOption']['payment_mode']?>
                            </div>
                          </div>
                          <?php if( $order['notes'] != "" ){?>
                          <div class="row mb-2">
                            <div class="col-md-4">
                              <label class="text-dark font-bold mb-2">Order Notes</label>
                            </div>
                            <div class="col-md-6 text-danger font-bold"><?=$order['notes']?></div>
                          </div>
                          <?php } ?>
                          <?php if( $order['helmet_quantity'] > 0 ) { ?>
                          <div class="row mb-2">
                            <div class="col-md-4">
                                <label class="text-dark font-bold mb-2">Helmets</label>
                            </div>
                            <div class="col-md-6 text-danger font-bold">
                                <!-- <input type="checkbox" name="helmets" <?=($order['helmet_quantity'] > 0)? "checked":"";?> style="display:inline;width: 20px;height: 20px;vertical-align: bottom;" value="<?=($order['helmet_quantity'] > 0)? "1":"0";?>"> -->
                                <?=($order['helmet_quantity'] > 0)? $order['helmet_quantity']:"0";?>
                            </div>
                          </div>  
                          <?php } ?>
                          <?php if( $order['early_pickup'] > 0 ) { ?>
                          <div class="row mb-2">
                            <div class="col-md-4">
                                <label class="text-dark font-bold mb-2">Early Pickup</label>
                            </div>
                            <div class="col-md-6 text-danger font-bold">
                                <!-- <input type="checkbox" name="early_pickup" <?=($order['early_pickup'] > 0)? "checked":"";?> style="display:inline;width: 20px;height: 20px;vertical-align: bottom;" value="<?=($order['early_pickup'] > 0)? "1":"0";?>"> -->
                                <?=($order['early_pickup'] > 0)? "YES":"NO";?>
                            </div>
                          </div>
                          <?php } ?>                    
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
                          <input type="hidden" name="booking_id" value="<?=$order['id']?>">
                          <input type="hidden" name="vehicle_count" value="0">
                          <input type="hidden" name="vehicle_numbers" value="">
                          <div class="col-md-12 table-responisve">
                              <table class="table">
                                  <?php
                                  $bike_total = $order['total_amount'];
                                  if( $order['helmet_quantity'] > 0 )
                                  {
                                    $bike_total = $bike_total - ($order['helmet_quantity'] * 50);
                                  }
                                  if( $order['early_pickup'] > 0 )
                                  {
                                    $bike_total = $bike_total - 200;
                                  }
                                  $final_amount = $order['total_amount'] + $order['refund_amount'];
                                  $pending = ($order['paymentOption']['payment_mode'] == "PAY_FULL") ? 0 : $order['total_amount'] - $order['booking_amount'];
                                  ?>
                                  <tr>
                                      <th class="text-start bg-warning" colspan="3">Order Summary</th>
                                      <!-- <th class="text-start bg-warning">Changes</th> -->
                                  </tr>
                                  <tr>
                                      <th class="text-start">Bike Rental</th>
                                      <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="d-inline-block text-info p-1"><?=$bike_total?></span></th>
                                      <!-- <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="bike_total d-inline-block p-1"></span></th> -->
                                  </tr>
                                  <tr style="<?=($order['helmet_quantity'] > 0)?"":"display: none"?>" id="helmets_row">
                                      <th class="text-start">Helmet <input type="number" name="helmets_qty" style="max-width: 100px;display: inline;margin-left: 25px;" class="cart-helmets form-control" value="<?=$order['helmet_quantity']?>"></th>
                                      <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="text-info d-inline-block p-1"><?=($order['helmet_quantity']*50)?></span></th>
                                      <!-- <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="helmet_total d-inline-block p-1"></span></th> -->
                                  </tr>
                                  <tr style="<?=($order['early_pickup']==1)?"":"display: none"?>" id="earlypickup_row">
                                      <th class="text-start">Early Pickup</th>
                                      <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="text-info d-inline-block p-1">200</span></th>
                                      <!-- <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="earlypickup_charge d-inline-block p-1"></span></th> -->
                                  </tr>
                                  <tr>
                                      <th class="text-start">Sub Total</th>
                                      <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="text-info d-inline-block p-1"><?=$order['total_amount']-$order['gst']?></span></td>
                                      <!-- <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="sub_total d-inline-block p-1"></span></td> -->
                                  </tr>
                                  <tr>
                                      <th class="text-start">GST</th>
                                      <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="text-info d-inline-block p-1"><?=$order['gst']?></span></th>
                                      <!-- <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="order_gst d-inline-block p-1"></span></th> -->
                                  </tr>
                                  <tr>
                                      <th class="text-start">Total</th>
                                      <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="order_total text-info d-inline-block p-1"><?=$order['total_amount']?></span></td>
                                      <!-- <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="total d-inline-block p-1"></span></td> -->
                                  </tr>
                                  <tr>
                                      <th class="text-start">Refundable Deposit</th>
                                      <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i> <span class="text-info d-inline-block p-1"><?=$order['refund_amount']?></span></td>
                                      <!-- <td class="fw-bold text-end border-0"><i class="fa fa-indian-rupee-sign me-1"></i> <span class="refund_deposit d-inline-block p-1"></span></td> -->
                                  </tr>
                                  <tr>
                                      <th class="text-start">Final</th>
                                      <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="text-info d-inline-block p-1"><?=$final_amount?></span></td>
                                      <!-- <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="final_total d-inline-block p-1"></span></td> -->
                                  </tr>
                                  <tr>
                                      <th class="text-start text-danger">Paid</th>
                                      <td class="fw-bold text-danger text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="paid_amount text-info d-inline-block p-1"><?=$order['booking_amount']?></span></td>
                                      <!-- <td class="fw-bold text-danger text-end"><input type="number" name="new_paid" class="text-end p-2" value="0" /></td> -->
                                  </tr>
                                  <tr>
                                      <th class="text-start text-warning">Pending</th>
                                      <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="pending_amount text-danger d-inline-block p-1"><?=$pending?></span></td>
                                  </tr>                

                              </table>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row g-3">
                    <div class="col-md-2 mb-2">
                      <label class="d-block text-dark mt-1">Refund Status</label>
                    </div>
                    <div class="col-md-2 mb-2">
                      <select name="refund_status" class="form-select">
                        <option <?=($order['refund_status'] == 0)?"selected":""?> value="0">Pending</option>
                        <option <?=($order['refund_status'] == 1)?"selected":""?> value="1">Paid</option>
                        <option <?=($order['refund_status'] == 2)?"selected":""?> value="2">Returned</option>
                      </select>
                    </div>
                  </div>
                  <div class="row g-3">
                    <div class="col-md-2 mb-2">
                      <label class="d-block text-dark mt-1">Pickup Status</label>
                    </div>
                    <div class="col-md-2 mb-2">
                      <select name="pickup_status" class="form-select">
                        <option>-Select-</option>
                        <option <?=($order['status'] == 0)?"selected":""?> value="0">Pre Book</option>
                        <option <?=($order['status'] == 1)?"selected":""?> value="1">Rented</option>
                        <option <?=($order['status'] == 2)?"selected":""?> value="2">Closed</option>
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
                  <div id="save_row" class="row g-3">
                    <div class="col-md-4 text-end" >
                      <button type="button" id="new_booking_save" class="btn btn-primary">Update</button>
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
        bikes_total = bikes.reduce(function (result, item) {
          return result + item.rent_price;
        }, 0);
      }

      var helmet_qty = 0;
      var helmet_total = 0;
      var early_pickup = 0;

      if( $("input[name='helmets']").is(":checked") )
      {
        var helmet_qty = $("input[name='helmets_qty']").val();
        helmet_total = helmet_qty * 50; 
      }
      if( $("input[name='early_pickup']").is(":checked") )
      {
        early_pickup = 200; 
      }

      total = bikes_total + helmet_total + early_pickup;

      var sub_total = total - (total * 0.05).toFixed(2);
      var order_gst = (total * 0.05).toFixed(2);
      var refund_deposit = 1000 * vehicle_count;

      $(".bike_total").html(bikes_total);
      $(".helmet_total").html(helmet_total);
      $(".sub_total").html(sub_total);
      $(".refund_deposit").html(refund_deposit);
      $(".order_gst").html(order_gst);
      $(".total").html(total);

      var final_amount = total + refund_deposit;
      $(".final_total").html(final_amount);

      var order_total= $(".order_total").html();
      var paid = $(".paid_amount").html();
      console.log("total"+total);
      console.log("paid"+paid);
      console.log("order_total"+order_total);
      
      var new_paid = $("input[name='new_paid']").val();
      if( new_paid == "" )
      {
        new_paid = 0;
        $("input[name='new_paid']").val(0);
      }
      var total_paid = parseFloat(new_paid) + parseFloat(paid);
      console.log("total_paid"+total_paid);
      if( total > 0 ){
        $(".pending_amount").html(total - total_paid);  
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
          search_bikes();
        });
      });

      $("#customer_id").select2();

      $("#customer_id").change(function(){

        if( $(this).val() == "" ){
          $("#select2-customer_id-container").html("-Select-");
        }

      });

      $("input[name='helmets']").change(function(){
        if ($(this).is(":checked")) {
          $("#helmets_row input[name='helmets_qty']").val(1);
          $("#helmets_row").slideDown();
        } else {
          $("#helmets_row input[name='helmets_qty']").val(0);
          $("#helmets_row").slideUp();
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

        var biketype_ids = '<?=$bike_type_ids?>';
        var biketype_ids_array = biketype_ids.split(',');
        for(var i=0; i < biketype_ids_array.length;i++)
        {
          $(".bikes_drop input[type='checkbox']").each(function(){
            if( $(this).val() == biketype_ids_array[i])
            {
              $(this).prop("checked", true);
            }
          });
        }

        function search_bikes()
        {
          updateCart();
          vehicle_count = 0;
          vehicle_numbers = [];
          
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
                    /*
                    <tr><td class='font-bold w-50'>Pickup</td><td><span class='d-block p-1 font-bold'>"+formatdate(response.data.pickup_date)+" "+response.data.pickup_time+"</span></td></tr><tr><td class='font-bold w-50'>Dropoff</td><td><span class='d-block p-1 font-bold'>"+formatdate(response.data.dropoff_date)+" "+response.data.dropoff_time+"</span></td></tr>*/

                    var html = "<table class='table datatable table-responsive border rounded mb-1'>";
                    html += "<tbody><tr><td class='font-bold w-50'>Duration</td><td><b>"+response.data.period_days+"</b> days, <b>"+response.data.period_hours+"</b> hours </td></tr><tr><td class='font-bold w-50'>Holiday</td><td>"+((response.data.holiday)?"<span class='badge bg-success'>Yes</span>":"<span class='badge bg-danger'>No</span>")+"</td></tr><tr><td class='font-bold w-50'>Public Holiday</td><td>"+((response.data.public_holiday)?"<span class='badge bg-success'>Yes</span>":"<span class='badge bg-danger'>No</span>")+"</td></tr><tr><td class='font-bold w-50'>Weekend</td><td>"+((response.data.weekend)?"<span class='badge bg-success'>Yes</span>":"<span class='badge bg-danger'>No</span>")+"</td></tr></tbody></table>";

                    $(".booking_form #search_bikes_row").html(html);

                    html = "<table class='table datatable table-responsive rounded border'>";
                    html += "<thead><tr><th class='bg-warning text-center'>Select</th><th class='bg-warning'>Bike</th><th class='bg-warning'>Image</th><th class='bg-warning'>CC</th><th class='bg-warning'>Model</th><th class='bg-warning'>Vehicle Number</th><th class='bg-warning'>Rent Price</th><th class='bg-warning'>Available</th></tr></thead>";
                    html += "<tbody>";
                    var bikes = response.data.cart_bikes;
                    for (var i = 0; i < bikes.length; i++) 
                    {
                      var row = bikes[i];
                      html += "<tr><td><div class='text-center'><input class='form-check-input' id='bike_"+row.bid+"' type='checkbox' style='height:20px;width:20px;margin: auto;vertical-align: bottom;' onchange='bike_added("+row.bid+", "+row.rent_price+")' class='bike_check' value='1'></div></td><td><span style='vertical-align:middle;'>"+row.bike_type_name+"</span></td><td><img style='max-width:50px;float:left;' class='img-fluid' src='"+bike_url+row.image+"'></td><td>"+row.cc+"</td><td>"+row.model+"</td><td>"+row.vehicle_number+"</td><td>"+row.rent_price+"</td><td>"+((row.available)?"<span class='badge bg-success'>Yes</span>":"<span class='badge bg-danger'>No</span>")+"</td></tr>";
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
        }

        search_bikes();

    });

  </script>