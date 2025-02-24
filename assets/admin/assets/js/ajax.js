//ajax calls

$(document).ready(function(){

    // add manufacturer
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