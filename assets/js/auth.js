$(document).ready(function(){

  $(".payment_proceed").click(function()
  {
    $("#payment_form").find(".alert").each(function(){
        $(this).remove();
    });
    var check1 = $("#agree_tc").prop("checked");
    var check2 = $("#agree_id").prop("checked");
    if( check1 && check2 )
    {
      $("#payment_form").submit();
    }
    else
    {
      $("#payment_form").prepend("<div class='alert alert-danger mt-1 mb-0'>Please check the terms and conditions to procced.</div>");
    }
    return false;
  });

  $("#submitContactForm").click(function(e){

    e.preventDefault();
    var form = $("#contactform");
    var url = $("#contactform").attr('action');
    var formdata = {
        name:$("#contactform input[name='name']").val(),
        email:$("#contactform input[name='email']").val(),
        phone:$("#contactform input[name='phone']").val(),
        subject:$("#contactform input[name='subject']").val(),
        message:$("#contactform textarea[name='message']").val(),
      };

      form.find(".alert").each(function(){
          $(this).remove();
      });

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
                $("#contactform :input").prop("disabled", false);
                $("#contactform button[type='submit']").prop("disabled", false);
                $("#contactform button[type='submit']").html("Get in Touch");

                form.prepend("<div class='alert alert-danger mt-1 mb-0'>"+data.error_message+"</div>");
              }
              else
              {
                form.prepend("<div class='alert alert-success mt-1 mb-0'>"+data.success_message+"</div>");
                $("#contactform button[type='submit']").html("Success.");
                setTimeout(function(){
                  window.location.reload();
                }, 2000);
              }
          },
          error: function (data) {
              form.prepend("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
              // error occured
              $("#contactform :input").prop("disabled", false);
              $("#contactform button[type='submit']").prop("disabled", false);
              $("#contactform button[type='submit']").html("Get in Touch");
          }
      });
      return false;
  });

  // changepassword
  $(".update-password").click(function(e) {

        $("#update-password :input").prop("disabled", true);
        $("#update-password button[type='submit']").prop("disabled", true);
        $("#update-password button[type='submit']").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> PLease wait..");

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
                  $("#update-password button[type='submit']").prop("disabled", false);
                  $("#update-password button[type='submit']").html("Update");

                  form.append("<div class='alert alert-danger mt-1 mb-0'>"+data.error_message+"</div>");
                }
                else
                {
                  form.append("<div class='alert alert-success mt-1 mb-0'>"+data.success_message+"</div>");
                  $("#update-password button[type='submit']").html("Success. Redirecting..");
                  setTimeout(function(){
                    window.location.reload();
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

  // login
  $(".signin").click(function () {

        $("#signin :input").prop("disabled", true);
        $("#signin button[type='button']").prop("disabled", true);
        $("#signin button[type='button']").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> PLease wait..");

        let form = $("#signin");
        let url = form.attr('action');

        form.find(".alert").each(function(){
          $(this).remove();
        });
        
        var formdata = {
          phone:$("#signin input[name='phone']").val(),
          password:$("#signin input[name='password']").val(),
        };

        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: formdata, // Serialize form data
            success: function (data) {
                console.log(data);
                if( data.error == 1 )
                {
                  // error occured
                  $("#signin :input").prop("disabled", false);
                  $("#signin button[type='button']").prop("disabled", false);
                  $("#signin button[type='button']").html("Sign in");

                  form.append("<div class='alert alert-danger mt-1 mb-0'>"+data.error_message+"</div>");
                }
                else
                {
                  form.append("<div class='alert alert-success mt-1 mb-0'>"+data.success_message+"</div>");
                  $("#signin button[type='button']").html("Success. Redirecting..");
                  setTimeout(function(){
                    window.location.reload();
                  }, 2000);
                }
            },
            error: function (data) {
                form.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                // error occured
                $("#signin :input").prop("disabled", false);
                $("#signin button[type='button']").prop("disabled", false);
                $("#signin button[type='button']").html("Sign in");
            }
        });
    });

  // signup
  $(".signup").click(function () {

        $("#signup :input").prop("disabled", true);
        $("#signup button[type='button']").prop("disabled", true);
        $("#signup button[type='button']").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> PLease wait..");

        let form = $("#signup");
        let url = form.attr('action');

        form.find(".alert").each(function(){
          $(this).remove();
        });
        
        var formdata = {
          name:$("#signup input[name='name']").val(),
          email:$("#signup input[name='email']").val(),
          phone:$("#signup input[name='phone']").val(),
          password:$("#signup input[name='password']").val(),
        };

        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: formdata, // Serialize form data
            success: function (data) {
                console.log(data);
                if( data.error == 1 )
                {
                  // error occured
                  $("#signup :input").prop("disabled", false);
                  $("#signup button[type='button']").prop("disabled", false);
                  $("#signup button[type='button']").html("Sign Up");

                  form.append("<div class='alert alert-danger mt-1 mb-0'>"+data.error_message+"</div>");
                }
                else
                {
                  form.append("<div class='alert alert-success mt-1 mb-0'>"+data.success_message+"</div>");
                  $("#signup button[type='button']").html("Success. Redirecting..");
                  setTimeout(function(){
                    window.location.reload();
                  }, 2000);
                }
            },
            error: function (data) {
                form.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                // error occured
                $("#signup :input").prop("disabled", false);
                $("#signup button[type='button']").prop("disabled", false);
                $("#signup button[type='button']").html("Sign Up");
            }
        });
    });

});