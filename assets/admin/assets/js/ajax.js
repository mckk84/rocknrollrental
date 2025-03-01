//ajax calls

$(document).ready(function(){

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