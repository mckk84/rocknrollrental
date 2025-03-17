//ajax calls

$(document).ready(function(){

    function formatdate(dt)
    {
      var d = dt.split("-");
      return d[2]+"-"+d[1]+"-"+d[0];
    }
    
    // changepassword
    $(".update-password").click(function(e) {

        $("#update-password :input").prop("disabled", true);
        $("#update-password button[type='button']").prop("disabled", true);
        $("#update-password button[type='button']").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> PLease wait..");

        let form = $("#update-password");
        let url = form.attr('action');

        form.find(".alert").each(function(){
          $(this).remove();
        });
        
        var formdata = {
          current_password:$("#update-password input[name='current_password']").val(),
          new_password:$("#update-password input[name='new_password']").val(),
          retype_password:$("#update-password input[name='retype_password']").val(),
        };

        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: formdata,
            success: function (data) {
                console.log(data);
                if( data.error == 1 )
                {
                  // error occured
                  $("#update-password :input").prop("disabled", false);
                  $("#update-password button[type='button']").prop("disabled", false);
                  $("#update-password button[type='button']").html("Update");

                  form.append("<div class='alert alert-danger mt-1 mb-0'>"+data.error_message+"</div>");
                }
                else
                {
                  form.append("<div class='alert alert-success mt-1 mb-0'>"+data.success_message+"</div>");
                  $("#update-password button[type='button']").html("Success. Redirecting..");
                  setTimeout(function(){
                    window.location.href = base_url+"/admin/Logout";
                  }, 2000);
                }
            },
            error: function (data) {
                form.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                // error occured
                $("#update-password :input").prop("disabled", false);
                $("#update-password button[type='submit']").prop("disabled", false);
                $("#update-password button[type='submit']").html("Update");
            }
        });
        return false;
    });

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
     if(dd<10){
            dd='0'+dd
        } 
        if(mm<10){
            mm='0'+mm
        } 

    today = yyyy+'-'+mm+'-'+dd;
    $("input[name='holiday_date']").attr("min", today);
    $("input[name='publicholiday_date']").attr("min", today);

    $("#add_price").click(function(){
        $("#add-price").modal('show');
        $("#add-price").find("input[type=text], select").val("");
    });

    $("#add_user").click(function(){
        $("#add-user").modal('show');
        $("#add-user").find("input[type=text], select").val("");
    });

    $("#submitcoupon").click(function(event){
        event.preventDefault(); // Prevent default form submission
        
        $(this).prop('disabled', true);
        $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");

        let form = $("#addcoupon");
        let mbody = $("#addcoupon .modal-body");
        let url = form.attr('action');

        mbody.find(".alert").each(function(){
            $(this).remove();
        });

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // Serialize form data
            success: function (data) {
                var d = JSON.parse(data);
                if( d.error == 1 )
                {
                    mbody.append("<div class='alert alert-danger mt-1 mb-0'>"+d.error_message+"</div>");
                    $("#submitcoupon").prop('disabled', false);
                    $("#submitcoupon").html("Submit");
                }
                else
                {
                    mbody.append("<div class='alert alert-success mt-1 mb-0'>"+d.success_message+"</div>");
                    $("#submitcoupon").html("Success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                }
            },
            error: function (data) {
                mbody.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                $("#submitcoupon").prop('disabled', false);
                $("#submitcoupon").html("Submit");
            }
        });
    });

    //edit holiday
    $(".edit-coupon-record").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        let id = $(this).attr('record-data');
        let url = window.location.href+"/getRecord?id="+id;
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                var d = JSON.parse(data);
                $('#add-coupon').modal('show');    
                $('#add-coupon input[name="record_id"]').val(d.id);
                $('#add-coupon input[name="title"]').val(d.title);
                $('#add-coupon input[name="code"]').val(d.code);
                $('#add-coupon select[name="type"]').val(d.type);
                $('#add-coupon select[name="status"]').val(d.status);
                $('#add-coupon input[name="discount_amount"]').val(d.discount_amount);
                $('#add-coupon input[name="quantity"]').val(d.quantity);   
                
                $('#add-coupon input[name="start_date"]').val(d.start_date);   
                $('#add-coupon input[name="end_date"]').val(d.end_date);   
            },
            error: function (data) {
                console.log("Error occured");
            }
        });
    });

    //edit order
    $(".edit-booking-record").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        let id = $(this).attr('record-data');
        let url = booking_url+"/getRecord?id="+id;
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) 
            {
                var response = JSON.parse(data);
                $('#edit-booking').modal('show');    

                var order = response.data.order;
                var customer = response.data.customer;
                var biketypes = response.data.biketypes;
                var available_bikes = response.data.available_bikes;
                var order_bike_types = response.data.order_bike_types;
                var order_payment = response.data.order_payment;

                $(".booking_form input[name='booking_id']").val(response.data.order.id);

                var html = "<table class='table datatable table-responsive border rounded mb-0'>";
                html += "<tbody><tr><th class='bg-warning-light'>Pickup Date</th><td>"+formatdate(order.pickup_date)+" "+order.pickup_time+"</td></tr>";
                html += "<tr><th class='bg-warning-light'>Dropoff Date</th><td>"+formatdate(order.dropoff_date)+" "+order.dropoff_time+"</td></tr>";

                html += "<tr><td><b>Duration</b></td><td> "+response.data.period_days+" days, <b>"+response.data.period_hours+"</b> hours</td></tr>";
                html += "<tr><td><b>Weekend </b></td><td>"+((response.data.weekend)?"<span class='badge bg-success'>Yes</span>":"<span class='badge bg-danger'>No</span>")+"</td></tr>";
                html += "<tr><td><b>Public Holiday </b></td><td>"+((response.data.public_holiday)?"<span class='badge bg-success'>Yes</span>":"<span class='badge bg-danger'>No</span>")+"</td>";
                html += "</tr></tbody></table>";

                $(".booking_form #order_details").html(html);

                var html = "<table class='table datatable table-responsive border rounded mb-0'>";
                html += "<tbody><th class='bg-warning-light'>Customer</th><td>"+response.data.customer.name+" ("+response.data.customer.phone+")</td></tr>";
                html += "<tr><th class='bg-warning-light'>Bikes Ordered</th><td>"+response.data.ordered_bikes+"</td></tr>";
                html += "<tr><th class='bg-warning-light'> Helmets </th><td>"+response.data.order.helmet_quantity+"</td></tr>";
                if( response.data.order.notes != "" )
                {
                    html += "<tr><td>Notes:</td><td> <b>"+response.data.order.notes+"</b></td></tr>";
                }
                if( response.data.order.early_pickup != 0 )
                {
                    html += "<tr><td>Early Pickup: </td><td><b>"+((response.data.order.early_pickup)?"<span class='badge bg-success'>Yes</span>":"<span class='badge bg-danger'>No</span>")+"</b></td></tr>";
                }
                html += "</tbody></table>";

                $(".booking_form #order_details1").html(html);

                html = "<table class='table datatable table-responsive rounded border text-center mb-0'>";
                html += "<thead><tr><th class='bg-warning-light text-center'>#</th><th class='bg-warning-light'>Bike Type</th><th class='bg-warning-light'>Image</th>";
                html += "<th class='bg-warning-light'>Assign Vehicle</th><th class='bg-warning-light'>Rent Price</th></tr></thead>";
                html += "<tbody>";
                var bikes = response.data.order_bike_types;
                var order_bike_types = new Array();
                for (var i = 0; i < bikes.length; i++) 
                {
                  var row = bikes[i];
                  var available_bikes = response.data.available_bikes;
                  if( order_bike_types.indexOf(row.id) < 0 )
                  {
                    order_bike_types.push(row.id);
                  }

                  var ab_html = "<select name='assign_bike_row_"+row.id+"' class='form-select'><option value=''>-Select-</option>";
                  for (var j = 0; j < available_bikes.length; j++) 
                  {
                    var ab = available_bikes[j];
                    if( ab.type_id == row.type_id )
                    {
                        row.rent_price = ab.rent_price;
                        row.bike_image = ab.image;
                        ab_html += "<option "+((row.bike_id==ab.bid)?'selected':'')+" data-obt='"+row.id+"' value='"+ab.bid+"'>"+ab.vehicle_number+"</option>";
                    }
                  }
                  ab_html += "</select>";

                  html += "<tr><td>#"+(i+1)+"</td><td><span style='vertical-align:middle;'>"+row.type+"</span></td>";
                  html += "<td><img style='width:50px;margin:auto;display:block;' class='img-fluid' src='"+response.data.bike_url+row.bike_image+"'/></td>";
                  html += "<td>"+ab_html+"</td><td>"+row.rent_price+"</td></tr>";
                }
                html += "</tbody>";
                html += "</table><input type='hidden' name='order_bike_types' value='"+order_bike_types.join(',')+"'>";
                $(".booking_form #bike_select").html(html);

                var total_amount = 0;
                var pending = 0;
                var helmet_total = 0;
                var early_pickup = 0;
                var bike_total = response.data.order.total_amount;
                if( response.data.order.helmet_quantity > 0 )
                {
                    helmet_total = response.data.order.helmet_quantity * 50;
                }

                if( response.data.order.early_pickup > 0 )
                {
                    early_pickup = 200 * order.quantity;
                }

                total_amount = response.data.order.total_amount - helmet_total - early_pickup;

                html = "<div style='width:49%;float:left;' class='table-responisve'>";
                html += "<table class='table'>";
                html += "<tr><th class='text-start bg-warning-light' colspan='2'>Order Updaes</th></tr>";
                html += "<tr><th class='text-start'>Refund Status</th><th class='text-end'>";
                html += "<select name='refund_status' class='form-select'>";
                html += "<option>-Select-</option>";
                html += "<option "+((response.data.order.refund_status==0)?'selected':'')+" value='0'>Pending</option>";
                html += "<option "+((response.data.order.refund_status==1)?'selected':'')+" value='1'>Paid</option>";
                html += "<option "+((response.data.order.refund_status==2)?'selected':'')+" value='2'>Returned</option>";
                html += "</select></th>";
                html += "</tr>";

                html += "<tr><th class='text-start'>Pickup Status</th><th class='text-end'>";
                html += "<select name='pickup_status' class='form-select'>";
                html += "<option>-Select-</option>";
                html += "<option "+((response.data.order.status==0)?'selected':'')+" value='0'>Pre Book</option>";
                html += "<option "+((response.data.order.status==1)?'selected':'')+" value='1'>Rented</option>";
                html += "<option "+((response.data.order.status==2)?'selected':'')+" value='2'>Closed</option>";
                html += "</select>";
                html += "</th>";
                html += "</tr>";

                html += "<tr><th class='text-start'>Payment</th><th class='text-end'>";
                html += "<input name='new_payment' class='form-control' maxlength='6' type='number'>";
                html += "</th>";
                html += "</tr>";

                html += "<tr><th class='text-start'>Delivery Notes</th><th class='text-end'>";
                html += "<textarea name='delivery_notes' class='form-control' rows='3'></textarea>";
                html += "</th>";
                html += "</tr>";

                html += "</table></div>";
                console.log((parseFloat(response.data.order.total_amount) - parseFloat(response.data.order.gst)));
                html += "<div style='float:right;' class='w-50 table-responisve'>";
                html += "<table class='table'>";
                html += "<tr><th class='text-start bg-warning-light' colspan='3'>Order Summary</th></tr>";
                html += "<tr><th class='text-start'>Bike Rental</th><th class='text-end'><i class='fa fa-indian-rupee-sign me-1'></i><span class='d-inline-block text-info p-1'>"+(parseFloat(response.data.order.total_amount) - parseFloat(response.data.order.gst))+"</span></th>";
                html += "</tr>";

                if( response.data.order.helmet_quantity > 0 ){

                    html += "<tr>";
                    html += "<th class='text-start'>Helmet </th><th class='text-end'><i class='fa fa-indian-rupee-sign me-1'></i><span class='text-info d-inline-block p-1'>"+helmet_total+"</span></th>";
                    html += "</tr>";
                }

                if( response.data.order.early_pickup > 0 )
                {
                    html += "<tr>";
                    html += "<th class='text-start'>Early Pickup</th>";
                    html += "<th class='text-end'><i class='fa fa-indian-rupee-sign me-1'></i><span class='text-info d-inline-block p-1'>"+early_pickup+"</span></th></tr>";
                }

                html += "<tr><th class='text-start'>GST</th>";
                html += "<th class='text-end'><i class='fa fa-indian-rupee-sign me-1'></i><span class='text-info d-inline-block p-1'>"+response.data.order.gst+"</span></th></tr>";
                html += "<tr><th class='text-start'>Total</th>";
                html += "<td class='fw-bold text-end'><i class='fa fa-indian-rupee-sign me-1'></i><span class='order_total text-info d-inline-block p-1'>"+total_amount+"</span></td>";
                html += "</tr>";
                html += "<tr><th class='text-start'>Refundable Deposit</th>";
                html += "<td class='fw-bold text-end'><i class='fa fa-indian-rupee-sign me-1'></i> <span class='text-info d-inline-block p-1'>"+response.data.order.refund_amount+"</span></td>";
                html += "</tr>";
                html += "<tr><th class='text-start text-danger'>Paid</th>";
                html += "<td class='fw-bold text-danger text-end'><i class='fa fa-indian-rupee-sign me-1'></i><span class='paid_amount text-info d-inline-block p-1'>"+response.data.order.booking_amount+"</span></td></tr>";
                html += "<tr><th class='text-start text-warning'>Pending</th>";
                html += "<td class='fw-bold text-end'><i class='fa fa-indian-rupee-sign me-1'></i><span class='pending_amount text-danger d-inline-block p-1'>"+pending+"</span></td></tr>";                
                html += "</table></div>";

                $(".booking_form #order_summary").html(html);
                                
            },
            error: function (data) {
                console.log("Error occured");
            }
        });
    });

    // submit booking
    $("#submitbooking").click(function (event) {
        event.preventDefault(); // Prevent default form submission
        
        $(this).prop('disabled', true);
        $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");

        let form = $("#updatebooking");
        let mbody = $("#updatebooking .modal-body");
        let url = form.attr('action');

        mbody.find(".alert").each(function(){
            $(this).remove();
        });

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // Serialize form data
            success: function (data) {
                var d = JSON.parse(data);
                if( d.error == 1 )
                {
                    mbody.append("<div class='alert alert-danger mt-1 mb-0'>"+d.error_message+"</div>");
                    $("#submitbooking").prop('disabled', false);
                    $("#submitbooking").html("Submit");
                }
                else
                {
                    mbody.append("<div class='alert alert-success mt-1 mb-0'>"+d.success_message+"</div>");
                    $("#submitbooking").html("Success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                }
            },
            error: function (data) {
                mbody.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                $("#submitbooking").prop('disabled', false);
                $("#submitbooking").html("Submit");
            }
        });
    });

    // add public holiday
    $("#submitpublicholiday").click(function (event) {
        event.preventDefault(); // Prevent default form submission
        
        $(this).prop('disabled', true);
        $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");

        let form = $("#addpublicholiday");
        let mbody = $("#addpublicholiday .modal-body");
        let url = form.attr('action');

        mbody.find(".alert").each(function(){
            $(this).remove();
        });

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // Serialize form data
            success: function (data) {
                var d = JSON.parse(data);
                if( d.error == 1 )
                {
                    mbody.append("<div class='alert alert-danger mt-1 mb-0'>"+d.error_message+"</div>");
                    $("#submitpublicholiday").prop('disabled', false);
                    $("#submitpublicholiday").html("Submit");
                }
                else
                {
                    mbody.append("<div class='alert alert-success mt-1 mb-0'>"+d.success_message+"</div>");
                    $("#submitpublicholiday").html("Success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                }
            },
            error: function (data) {
                mbody.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                $("#submitpublicholiday").prop('disabled', false);
                $("#submitpublicholiday").html("Submit");
            }
        });
    });

    // add holiday
    $("#submitholiday").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        $(this).prop('disabled', true);
        $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");

        let form = $("#addholiday");
        let mbody = $("#addholiday .modal-body");
        let url = form.attr('action');

        mbody.find(".alert").each(function(){
            $(this).remove();
        });

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // Serialize form data
            success: function (data) {
                var d = JSON.parse(data);
                if( d.error == 1 )
                {
                    mbody.append("<div class='alert alert-danger mt-1 mb-0'>"+d.error_message+"</div>");
                    $("#submitholiday").prop('disabled', false);
                    $("#submitholiday").html("Submit");
                }
                else
                {
                    mbody.append("<div class='alert alert-success mt-1 mb-0'>"+d.success_message+"</div>");
                    $("#submitholiday").html("Success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                }
            },
            error: function (data) {
                mbody.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                $("#submitholiday").prop('disabled', false);
                $("#submitholiday").html("Submit");
            }
        });
    });

    //add user
    $("#submituser").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        $(this).prop('disabled', true);
        $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");

        let form = $("#adduser");
        let mbody = $("#adduser .modal-body");
        let url = form.attr('action');

        mbody.find(".alert").each(function(){
            $(this).remove();
        });

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // Serialize form data
            success: function (data) {
                var d = JSON.parse(data);
                if( d.error == 1 )
                {
                    mbody.append("<div class='alert alert-danger mt-1 mb-0'>"+d.error_message+"</div>");
                    $("#submituser").prop('disabled', false);
                    $("#submituser").html("Submit");
                }
                else
                {
                    mbody.append("<div class='alert alert-success mt-1 mb-0'>"+d.success_message+"</div>");
                    $("#submituser").html("Success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                }
            },
            error: function (data) {
                mbody.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                $("#submituser").prop('disabled', false);
                $("#submituser").html("Submit");
            }
        });
    });

    // add price
    $("#submitprice").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        $(this).prop('disabled', true);
        $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");

        let form = $("#addprice");
        let mbody = $("#addprice .modal-body");
        let url = form.attr('action');

        mbody.find(".alert").each(function(){
            $(this).remove();
        });

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // Serialize form data
            success: function (data) {
                var d = JSON.parse(data);
                if( d.error == 1 )
                {
                    mbody.append("<div class='alert alert-danger mt-1 mb-0'>"+d.error_message+"</div>");
                    $("#submitprice").prop('disabled', false);
                    $("#submitprice").html("Submit");
                }
                else
                {
                    mbody.append("<div class='alert alert-success mt-1 mb-0'>"+d.success_message+"</div>");
                    $("#submitprice").html("Success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                }
            },
            error: function (data) {
                mbody.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                $("#submitprice").prop('disabled', false);
                $("#submitprice").html("Submit");
            }
        });
    });

    // add customer
    $("#submitcustomer").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        $(this).prop('disabled', true);
        $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");

        let form = $("#addcustomer");
        let mbody = $("#addcustomer .modal-body");
        let url = form.attr('action');

        mbody.find(".alert").each(function(){
            $(this).remove();
        });

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // Serialize form data
            success: function (data) {
                var d = JSON.parse(data);
                if( d.error == 1 )
                {
                    mbody.append("<div class='alert alert-danger mt-1 mb-0'>"+d.error_message+"</div>");
                    $("#submitcustomer").prop('disabled', false);
                    $("#submitcustomer").html("Submit");
                }
                else
                {
                    mbody.append("<div class='alert alert-success mt-1 mb-0'>"+d.success_message+"</div>");
                    $("#submitcustomer").html("Success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                }
            },
            error: function (data) {
                mbody.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                $("#submitcustomer").prop('disabled', false);
                    $("#submitcustomer").html("Submit");
            }
        });
    });

    // add bike
    $("#submitbike").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        $(this).prop('disabled', true);
        $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");

        let form = $("#addbike")[0];
        var formData = new FormData(form);
        let mbody = $("#addbike .modal-body");
        let url = $("#addbike").attr('action');

        mbody.find(".alert").each(function(){
            $(this).remove();
        });

        $.ajax({
            type: "POST",
            url: url,
            data: formData, // Serialize form data
            contentType: false,       
            cache: false,             
            processData:false, 
            success: function (data) {
                var d = JSON.parse(data);
                console.log(d);
                if( d.error == 1 )
                {
                    mbody.append("<div class='alert alert-danger mt-1 mb-0'>"+d.error_message+"</div>");
                    $("#submitbike").prop('disabled', false);
                    $("#submitbike").html("Submit");
                }
                else
                {
                    mbody.append("<div class='alert alert-success mt-1 mb-0'>"+d.success_message+"</div>");
                    $("#submitbike").html("Success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                }
            },
            error: function (data) {
                mbody.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                $("#submitbike").prop('disabled', false);
                    $("#submitbike").html("Submit");
            }
        });
    });

	// add manufacturer
	$("#submitmanufacturer").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        $(this).prop('disabled', true);
        $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");

        let form = $("#addmanufacturer");
        let mbody = $("#addmanufacturer .modal-body");
        let url = form.attr('action');

        mbody.find(".alert").each(function(){
        	$(this).remove();
        });

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // Serialize form data
            success: function (data) {
                var d = JSON.parse(data);
                console.log(d);
                if( d.error == 1 )
                {
                	mbody.append("<div class='alert alert-danger mt-1 mb-0'>"+d.error_message+"</div>");
                    $("#submitmanufacturer").prop('disabled', false);
                    $("#submitmanufacturer").html("Submit");
                }
                else
                {
                	mbody.append("<div class='alert alert-success mt-1 mb-0'>"+d.success_message+"</div>");
                    $("#submitmanufacturer").html("Success");
                	setTimeout(function(){
                		window.location.reload();
                	}, 2000);
                }
            },
            error: function (data) {
                mbody.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                $("#submitmanufacturer").prop('disabled', false);
                    $("#submitmanufacturer").html("Submit");
            }
        });
    });

    // add manufacturer
    $("#submitBiketype").click(function (event) {
        event.preventDefault(); // Prevent default form submission
        $(this).prop('disabled', true);
        $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");
        let form = $("#addbiketype");
        let mbody = $("#addbiketype .modal-body");
        let url = form.attr('action');

        mbody.find(".alert").each(function(){
            $(this).remove();
        });

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // Serialize form data
            success: function (data) {
                var d = JSON.parse(data);
                console.log(d);
                if( d.error == 1 )
                {
                    mbody.append("<div class='alert alert-danger mt-1 mb-0'>"+d.error_message+"</div>");
                    $("#submitBiketype").prop('disabled', false);
                    $("#submitBiketype").html("Submit");
                }
                else
                {
                    mbody.append("<div class='alert alert-success mt-1 mb-0'>"+d.success_message+"</div>");
                    $("#submitBiketype").html("Success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                }
            },
            error: function (data) {
                mbody.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                $("#submitBiketype").prop('disabled', false);
                    $("#submitBiketype").html("Submit");
            }
        });
    });

    // add manufacturer
    $("#submitpaymentmode").click(function (event) {
        event.preventDefault(); // Prevent default form submission
        $(this).prop('disabled', true);
        $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");
        let form = $("#addpaymentmode");
        let mbody = $("#addpaymentmode .modal-body");
        let url = form.attr('action');

        mbody.find(".alert").each(function(){
            $(this).remove();
        });

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // Serialize form data
            success: function (data) {
                var d = JSON.parse(data);
                console.log(d);
                if( d.error == 1 )
                {
                    mbody.append("<div class='alert alert-danger mt-1 mb-0'>"+d.error_message+"</div>");
                    $("#submitpaymentmode").prop('disabled', false);
                    $("#submitpaymentmode").html("Submit");
                }
                else
                {
                    mbody.append("<div class='alert alert-success mt-1 mb-0'>"+d.success_message+"</div>");
                    $("#submitpaymentmode").html("Success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                }
            },
            error: function (data) {
                mbody.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                $("#submitpaymentmode").prop('disabled', false);
                    $("#submitpaymentmode").html("Submit");
            }
        });
    });

    //view-contact-record
    $(".view-contact-record").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        let id = $(this).attr('record-data');
        let url = window.location.href+"/getRecord?id="+id;
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                var d = JSON.parse(data);
                $('#view-contact').modal('show');    
                $('#view-contact #name').html(d.name);
                $('#view-contact #email').html(d.email);   
                $('#view-contact #phone').html(d.phone);
                $('#view-contact #subject').html(d.subject);
                $('#view-contact #message').html(d.message);
            },
            error: function (data) {
                console.log("Error occured");
            }
        });
    });

    //edit holiday
    $(".edit-public-holiday-record").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        let id = $(this).attr('record-data');
        let url = window.location.href+"/getRecord?id="+id;
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                var d = JSON.parse(data);
                $('#add-public-holiday').modal('show');    
                $('#add-public-holiday input[name="record_id"]').val(d.id);
                $('#add-public-holiday input[name="holiday_date"]').val(d.holiday_date);   
            },
            error: function (data) {
                console.log("Error occured");
            }
        });
    });

    //edit holiday
    $(".edit-holiday-record").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        let id = $(this).attr('record-data');
        let url = window.location.href+"/getRecord?id="+id;
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                var d = JSON.parse(data);
                $('#add-holiday').modal('show');    
                $('#add-holiday input[name="record_id"]').val(d.id);
                $('#add-holiday input[name="holiday_date"]').val(d.holiday_date);   
            },
            error: function (data) {
                console.log("Error occured");
            }
        });
    });

    //edit user
    $(".edit-user-record").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        let id = $(this).attr('record-data');
        let url = window.location.href+"/getRecord?id="+id;
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                var d = JSON.parse(data);
                $('#add-user').modal('show');    
                $('#add-user input[name="record_id"]').val(d.userId);
                $('#add-user select[name="user_type"]').val(d.user_type);
                $('#add-user input[name="name"]').val(d.name);
                $('#add-user input[name="email"]').val(d.email);

                $('#add-user input[name="phone"]').val(d.phone);
                $('#add-user input[name="username"]').val(d.username);

                $('#add-user input[name="password"]').prop('disabled', true);
                
            },
            error: function (data) {
                console.log("Error occured");
            }
        });
    });

    //edit customer
    $(".edit-price-record").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        let id = $(this).attr('record-data');
        let url = window.location.href+"/getRecord?id="+id;
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                var d = JSON.parse(data);
                $('#add-price').modal('show');    
                $('#add-price input[name="record_id"]').val(d.id);
                $('#add-price select[name="type_id"]').val(d.type_id);
                $('#add-price input[name="week_day_price"]').val(d.week_day_price);
                $('#add-price input[name="week_day_half_price"]').val(d.week_day_half_price);

                $('#add-price input[name="weekend_day_price"]').val(d.weekend_day_price);
                $('#add-price input[name="weekend_day_half_price"]').val(d.weekend_day_half_price);

                $('#add-price input[name="holiday_day_price"]').val(d.holiday_day_price);
                $('#add-price input[name="holiday_day_half_price"]').val(d.holiday_day_half_price);
                
            },
            error: function (data) {
                console.log("Error occured");
            }
        });
    });

    //edit customer
    $(".edit-customer-record").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        let id = $(this).attr('record-data');
        let url = window.location.href+"/getRecord?id="+id;
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                var d = JSON.parse(data);
                $('#add-customer').modal('show');    
                $('#add-customer input[name="record_id"]').val(d.id);
                $('#add-customer input[name="name"]').val(d.name);
                $('#add-customer input[name="email"]').val(d.email);
                $('#add-customer input[name="phone"]').val(d.phone);
                $('#add-customer input[name="password"]').attr("disabled", true);
            },
            error: function (data) {
                console.log("Error occured");
            }
        });
    });

    //edit bike
    $(".edit-bike-record").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        let id = $(this).attr('record-data');
        let url = window.location.href+"/getRecord?id="+id;
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                var d = JSON.parse(data);
                $('#add-bike').modal('show');    
                $('#add-bike input[name="record_id"]').val(d.id);
                $('#add-bike input[name="name"]').val(d.name);
                $('#add-bike select[name="manufacturer_id"]').val(d.manufacturer_id);
                $('#add-bike select[name="type_id"]').val(d.type_id);
                $('#add-bike input[name="number"]').val(d.vehicle_number);
                $('#add-bike input[name="cc"]').val(d.cc);
                $('#add-bike input[name="color"]').val(d.color);
                $('#add-bike input[name="model"]').val(d.model);   

                $('#add-bike input[name="milage"]').val(d.milage);   
                $('#add-bike input[name="weight"]').val(d.weight);   
                $('#add-bike input[name="power"]').val(d.power);   

                $('#add-bike #preview_image').attr('src', '/bikes/'+d.image);  
            },
            error: function (data) {
                console.log("Error occured");
            }
        });
    });

	//edit manaufacturer
    $(".edit-manaufacturer-record").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        let id = $(this).attr('record-data');
        let url = window.location.href+"/getRecord?id="+id;
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                var d = JSON.parse(data);
                $('#add-manufacturer').modal('show');    
                $('#add-manufacturer input[name="record_id"]').val(d.id);
                $('#add-manufacturer input[name="manufacturer_name"]').val(d.name);   
            },
            error: function (data) {
                console.log("Error occured");
            }
        });
    });

    //edit biketype
    $(".edit-biketype-record").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        let id = $(this).attr('record-data');
        let url = window.location.href+"/getRecord?id="+id;
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                var d = JSON.parse(data);
                $('#add-bike-type').modal('show');    
                $('#add-bike-type input[name="record_id"]').val(d.id);
                $('#add-bike-type input[name="type"]').val(d.type);   
            },
            error: function (data) {
                console.log("Error occured");
            }
        });
    });

    //edit paymentmode
    $(".edit-paymentmode-record").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        let id = $(this).attr('record-data');
        let url = window.location.href+"/getRecord?id="+id;
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                var d = JSON.parse(data);
                $('#add-payment-mode').modal('show');    
                $('#add-payment-mode input[name="record_id"]').val(d.id);
                $('#add-payment-mode input[name="payment_mode"]').val(d.payment_mode);   
            },
            error: function (data) {
                console.log("Error occured");
            }
        });
    });

    //delete manaufacturer
    $(".delete-record").click(function (event) {
        event.preventDefault(); // Prevent default form submission

        var result = confirm("Are you sure to delete?");
		if (result==false) {
		   return true;
		} 		

		let id = $(this).attr('record-data');
        let url = window.location.href+"/deleteRecord/"+id;
        
        $.ajax({
		    url: url,
		    method: 'DELETE',
		    contentType: 'application/json',
		    success: function(data) {
		        var d = JSON.parse(data);
                //console.log(d);
                if( d.error == 1 )
                {
                	$(".showalert").append("<div class='alert alert-danger mt-1 mb-0'>"+d.error_message+"</div>");
                }
                else
                {
                	$(".showalert").append("<div class='alert alert-success mt-1 mb-0'>"+d.success_message+"</div>");
                	setTimeout(function(){
                		window.location.reload();
                	}, 2000);
                }
		    },
		    error: function(request,msg,error) {
		       	console.log(error);
		    }
		});
    });

})