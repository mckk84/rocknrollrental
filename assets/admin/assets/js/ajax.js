//ajax calls

$(document).ready(function(){

	// add manufacturer
	$("#submitButton").click(function (event) {
        event.preventDefault(); // Prevent default form submission

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
                }
                else
                {
                	mbody.append("<div class='alert alert-success mt-1 mb-0'>"+d.success_message+"</div>");
                	setTimeout(function(){
                		window.location.reload();
                	}, 3000);
                }
            },
            error: function (data) {
                mbody.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
            }
        });
    });

	//delete manaufacturer
    $(".edit-record").click(function (event) {
        event.preventDefault(); // Prevent default form submission

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
                }
                else
                {
                	mbody.append("<div class='alert alert-success mt-1 mb-0'>"+d.success_message+"</div>");
                	setTimeout(function(){
                		window.location.reload();
                	}, 3000);
                }
            },
            error: function (data) {
                mbody.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
            }
        });
    });

    //delete manaufacturer
    $(".delete-record").click(function (event) {
        event.preventDefault(); // Prevent default form submission

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
                }
                else
                {
                	mbody.append("<div class='alert alert-success mt-1 mb-0'>"+d.success_message+"</div>");
                	setTimeout(function(){
                		window.location.reload();
                	}, 3000);
                }
            },
            error: function (data) {
                mbody.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
            }
        });
    });

})