$(document).ready(function(){

  var show_coupon = localStorage.getItem("show_coupon");
  if( show_coupon == null )
  {
    show_coupon = 0;
    localStorage.setItem("show_coupon", 0);
  }

  function addEvent(obj, evt, fn) {
      if (obj.addEventListener) {
          obj.addEventListener(evt, fn, false);
      } else if (obj.attachEvent) {
          obj.attachEvent("on" + evt, fn);
      }
  }

  addEvent(document, 'mouseout', function(evt) {
      if (evt.toElement == null && evt.relatedTarget == null) 
      {
          var show_coupon = localStorage.getItem("show_coupon");
          if( show_coupon == 0 ){
            $('.lightbox').slideDown();
            show_coupon = 1;
            localStorage.setItem("show_coupon", show_coupon);
          }
      };
  });

  $('a.close').click(function() {
      $('.lightbox').slideUp();
  });

  function OTPInput() {
    const inputs = document.querySelectorAll('#otp > *[id]');
    for (let i = 0; i < inputs.length; i++) 
    { 
      inputs[i].addEventListener('keydown', function(event) { 
      if (event.key==="Backspace" ) { 
          inputs[i].value=''; 
          if (i !==0) inputs[i - 1].focus(); 
      } 
      else { 
        if (i===inputs.length - 1 && inputs[i].value !=='' ) { 
          return true; } 
        else if (event.keyCode> 47 && event.keyCode < 58) { 
          inputs[i].value=event.key; 
          if (i !==inputs.length - 1) inputs[i + 1].focus(); 
          event.preventDefault(); 
        } 
        else if (event.keyCode> 64 && event.keyCode < 91) { 
          inputs[i].value=String.fromCharCode(event.keyCode); 
          if (i !==inputs.length - 1) inputs[i + 1].focus(); 
          event.preventDefault(); 
        } 
      } 
      }); 
    }  
  }

  function OTPInput1() {
    const inputs = document.querySelectorAll('#otp1 > *[id]');
    for (let i = 0; i < inputs.length; i++) 
    { 
      inputs[i].addEventListener('keydown', function(event) { 
      if (event.key==="Backspace" ) { 
          inputs[i].value=''; 
          if (i !==0) inputs[i - 1].focus(); 
      } 
      else { 
        if (i===inputs.length - 1 && inputs[i].value !=='' ) { 
          return true; } 
        else if (event.keyCode> 47 && event.keyCode < 58) { 
          inputs[i].value=event.key; 
          if (i !==inputs.length - 1) inputs[i + 1].focus(); 
          event.preventDefault(); 
        } 
        else if (event.keyCode> 64 && event.keyCode < 91) { 
          inputs[i].value=String.fromCharCode(event.keyCode); 
          if (i !==inputs.length - 1) inputs[i + 1].focus(); 
          event.preventDefault(); 
        } 
      } 
      }); 
    }  
  }

  function startTimer()
  {
    let counter = 60;
    let myVar = setInterval(myTimer ,1000);
    function myTimer() {
      document.getElementById("otp_counter").innerHTML = counter;
      counter--;
      if( counter < 0 )
      {
        clearInterval(myVar);
        $("#resendOtp").show();
      }
    }
  }

  function startTimer1()
  {
    let counter = 60;
    let myVar = setInterval(myTimer ,1000);
    function myTimer() {
      document.getElementById("otp_counter1").innerHTML = counter;
      counter--;
      if( counter < 0 )
      {
        clearInterval(myVar);
        $("#resendOtp1").show();
      }
    }
  }

  OTPInput();
  OTPInput1();

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
      $("#payment_form").prepend("<div class='alert alert-danger mt-1 mb-0'>Please check the terms and conditions to proceed.</div>");
    }
    return false;
  });

  $(".cancel_proceed").click(function()
  {
    $("#cancellation_form").find(".alert").each(function(){
        $(this).remove();
    });
    var check1 = $("#cancellation_form #agree_cc").prop("checked");
    if( check1 )
    {
      $("#cancellation_form").submit();
    }
    else
    {
      $("#cancellation_form").prepend("<div class='alert alert-danger mt-1 mb-0'>Please check the terms and conditions to proceed.</div>");
    }
    return false;
  });

  $("#subscribe").click(function(e){

    e.preventDefault();
    var form = $("#subscribe-form");
    var url = $("#subscribe-form").attr('action');
    $("#subscribe").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");
    var formdata = {
        email:$("#subscribe-form input[name='email']").val()
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
                $("#subscribe-form :input").prop("disabled", false);
                $("#subscribe").prop("disabled", false);
                $("#subscribe").text("Subscribe");

                form.append("<div class='alert alert-danger mt-1 mb-0'>"+data.error_message+"</div>");
              }
              else
              {
                form.append("<div class='alert alert-success mt-1 mb-0'>"+data.success_message+"</div>");
                $("#subscribe").text("Success");
              }
              setTimeout(function(){
                form.find(".alert").each(function(){
                    $(this).remove();
                });
              }, 5000);
          },
          error: function (data) {
              form.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
              // error occured
              $("#subscribe-form :input").prop("disabled", false);
              $("#subscribe").prop("disabled", false);
              $("#subscribe").text("Subscribe");
              setTimeout(function(){
                form.find(".alert").each(function(){
                    $(this).remove();
                });
              }, 5000);
          }
      });
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
        $("#update-password button[type='submit']").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");

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

        let form = $("#signin");
        let url = form.attr('action');

        form.find(".alert").each(function(){
          $(this).remove();
        });

        if( $("#signin input[name='phone']").val().trim() == "" )
        {
          $("#signin input[name='phone']").focus();
          return false;
        }

        if( $("#signin input[name='password']").val().trim() == "" )
        {
          $("#signin input[name='password']").focus();
          return false;
        }
        
        var formdata = {
          phone:$("#signin input[name='phone']").val(),
          password:$("#signin input[name='password']").val(),
        };

        $("#signin button[type='button']").prop("disabled", true);
        $("#signin button[type='button']").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");

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

                setTimeout(function(){

                  form.find(".alert").each(function(){
                    $(this).remove();
                  });

                }, 3000);
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

  $("#validateBtn").click(function(){

    let form = $("#signin");
    let url = form.attr('action');
    form.find(".alert").each(function(){
      $(this).remove();
    });

    var otp_div = $("#otp_div");
    otp_div.find(".alert").each(function(){
        $(this).remove();
      });
    var elem = $(this);
    elem.prop("disabled", true);

    var phone = $("#signin input[name='phone']").val();
    var otp = '';
    document.querySelectorAll('#otp > input').forEach(input => otp += input.value);

    var formdata = {
      phone:$("#signin input[name='phone']").val(),
      opt_login:1,
      otp:otp,
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
              elem.prop("disabled", false);
              otp_div.append("<div class='alert alert-danger mt-1 mb-0'>"+data.error_message+"</div>");
            }
            else
            {
              otp_div.append("<div class='alert alert-success mt-1 mb-0'>"+data.success_message+"</div>");
              elem.text("Validate");
              setTimeout(function()
              {
                $("#otp_form").modal('hide');
                window.location.reload();
              }, 2000);
              
            }
        },
        error: function (data) {
            otp_div.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
            elem.prop("disabled", false);
        }
    });

  });

  $("#validateSignupBtn").click(function(){

    let form = $("#signup");
    let url = form.attr('action');
    form.find(".alert").each(function(){
      $(this).remove();
    });

    var otp_div = $("#otp_div1");
    otp_div.find(".alert").each(function(){
        $(this).remove();
      });
    var elem = $(this);
    elem.prop("disabled", true);

    var phone = $("#signup input[name='phone']").val();
    var otp = '';
    document.querySelectorAll('#otp1 > input').forEach(input => otp += input.value);

    var formdata = {
      phone:$("#signup input[name='phone']").val(),
      opt_login:1,
      otp:otp,
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
              elem.prop("disabled", false);
              otp_div.append("<div class='alert alert-danger mt-1 mb-0'>"+data.error_message+"</div>");
            }
            else
            {
              otp_div.append("<div class='alert alert-success mt-1 mb-0'>"+data.success_message+"</div>");
              elem.text("Validate");
              $("#signup_otp").hide();  
              $("#signup_otp").attr("otp-validated", 1);
              $(".signup").trigger('click');
            }
        },
        error: function (data) {
            otp_div.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
            elem.prop("disabled", false);
        }
    });

  });

  // login
  $("#otplogin").click(function () {

      let form = $("#signin");
      let url = form.attr('action');
      form.find(".alert").each(function(){
        $(this).remove();
      });

      $("#signin :input").prop("disabled", true);
      $("#signin button[type='button']").prop("disabled", true);
      
      var phone = $("#signin input[name='phone']").val();
      var phno = /^\d{10}$/;
      if( phone == "")
      {
        // error occured
        $("#signin :input").prop("disabled", false);
        $("#signin button[type='button']").prop("disabled", false);
        form.append("<div class='alert alert-danger mt-1 mb-0'>Please enter mobile no.</div>");         
        return false;
      }
      else if(!phone.match(phno))
      {
        $("#signin :input").prop("disabled", false);
        $("#signin button[type='button']").prop("disabled", false);
        form.append("<div class='alert alert-danger mt-1 mb-0'>Mobile no must be ten digit</div>");         
        return false;
      }
      else
      {
        //valid
      }

      var formdata = {
        phone:$("#signin input[name='phone']").val(),
        opt_login:1,
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
                
                form.append("<div class='alert alert-danger mt-1 mb-0'>"+data.error_message+"</div>");
              }
              else
              {
                form.append("<div class='alert alert-success mt-1 mb-0'>"+data.success_message+"</div>");
                $("#login_form").modal('hide');
                $("#otp_form").modal('show');
                var last_digits = phone.substring(6 ,10);
                $("#otp_form #maskedNumber").html("*******"+last_digits);
                document.getElementById("otp_counter").innerHTML = 60;
                startTimer();
              }
          },
          error: function (data) {
              form.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
              // error occured
              $("#signin :input").prop("disabled", false);
              $("#signin button[type='button']").prop("disabled", false);
          }
      });
    });

  // login
  $("#resendOtp").click(function () {

      $("#resendOtp").hide();
      let form = $("#signin");
      let url = form.attr('action');
      var otp_div = $("#otp_div");
      otp_div.find(".alert").each(function(){
        $(this).remove();
      });
      $("#validateBtn").prop("disabled", true);
      var phone = $("#signin input[name='phone']").val();
      var formdata = {
        phone:$("#signin input[name='phone']").val(),
        opt_login:1,
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
                $("#validateBtn").prop("disabled", false);
                otp_div.append("<div class='alert alert-danger mt-1 mb-0'>"+data.error_message+"</div>");
              }
              else
              {
                $("#validateBtn").prop("disabled", false);
                otp_div.append("<div class='alert alert-success mt-1 mb-0'>"+data.success_message+"</div>");
                document.getElementById("otp_counter").innerHTML = 60;
                startTimer();
                otp_div.find(".alert").each(function(){
                  $(this).remove();
                });
              }
          },
          error: function (data) {
              otp_div.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
              $("#validateBtn").prop("disabled", false);
          }
      });
    });

  // login
  $("#resendOtp1").click(function () {

      $("#resendOtp1").hide();
      let form = $("#signup");
      let url = form.attr('action');
      var otp_div = $("#otp_div1");
      otp_div.find(".alert").each(function(){
        $(this).remove();
      });
      $("#validateSignupBtn").prop("disabled", true);
      var phone = $("#signup input[name='phone']").val();
      var formdata = {
        phone:$("#signup input[name='phone']").val(),
        opt_login:1,
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
                $("#validateSignupBtn").prop("disabled", false);
                otp_div.append("<div class='alert alert-danger mt-1 mb-0'>"+data.error_message+"</div>");
              }
              else
              {
                $("#validateSignupBtn").prop("disabled", false);
                otp_div.append("<div class='alert alert-success mt-1 mb-0'>"+data.success_message+"</div>");
                document.getElementById("otp_counter1").innerHTML = 60;
                startTimer1();
                otp_div.find(".alert").each(function(){
                  $(this).remove();
                });
              }
          },
          error: function (data) {
              otp_div.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
              $("#validateSignupBtn").prop("disabled", false);
          }
      });
    });

  $(".signup_button").click(function(){

    $("#login_form").modal('hide');
    $("#at_signup").modal('show');

  });

  $(".signin_button").click(function(){
    $("#login_form").modal('show');
    $("#at_signup").modal('hide');
  });

  // signup
  $(".signup").click(function () {

        let form = $("#signup");
        let url = form.attr('action');

        form.find(".alert").each(function(){
          $(this).remove();
        });

        if( $("#signup input[name='name']").val().trim() == "" )
        {
          $("#signup input[name='name']").focus();
          return false;
        }

        if( $("#signup input[name='email']").val().trim() == "" )
        {
          $("#signup input[name='email']").focus();
          return false;
        }

        if( $("#signup input[name='phone']").val().trim() == "" )
        {
          $("#signup input[name='phone']").focus();
          return false;
        }

        if( $("#signup input[name='password']").val().trim() == "" )
        {
          $("#signup input[name='password']").focus();
          return false;
        }

        var phone = $("#signup input[name='phone']").val().trim();
        var phno = /^\d{10}$/;
        if( phone == "")
        {
          // error occured
          form.append("<div class='alert alert-danger mt-1 mb-0'>Please enter valid phone no.</div>");         
          return false;
        }
        else if(!phone.match(phno))
        {
          form.append("<div class='alert alert-danger mt-1 mb-0'>Please enter valid phone no.</div>");         
          return false;
        }
        else
        {
          //valid
        }

        var otp_validated = $("#signup_otp").attr("otp-validated");
        if( otp_validated == 0 )
        {
          $("#signup_otp").show();
          $("#signup .signup").prop("disabled", true);
          // ask for otp
          var formdata = {
            phone:phone,
            opt_login:1,
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
                    $("#signup button[type='button']").prop("disabled", false);
                    form.append("<div class='alert alert-danger mt-1 mb-0'>"+data.error_message+"</div>");
                  }
                  else
                  {
                    form.append("<div class='alert alert-success mt-1 mb-0'>"+data.success_message+"</div>");
                    var last_digits = phone.substring(6 ,10);
                    $("#signup_otp #maskedNumber").html("*******"+last_digits);
                    document.getElementById("otp_counter1").innerHTML = 60;
                    startTimer1();
                  }
              },
              error: function (data) {
                  form.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                  // error occured
                  $("#signup button[type='button']").prop("disabled", false);
              }
          });

          return false;
        }

        $("#signup .signup").prop("disabled", true);
        $("#signup .signup").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait..");
        
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
                  $("#signup .signup").prop("disabled", false);
                  $("#signup .signup").html("Sign Up");

                  form.append("<div class='alert alert-danger mt-1 mb-0'>"+data.error_message+"</div>");
                }
                else
                {
                  form.append("<div class='alert alert-success mt-1 mb-0'>"+data.success_message+"</div>");
                  $("#signup .signup").html("Success. Redirecting..");
                  setTimeout(function(){
                    window.location.reload();
                  }, 2000);
                }

                setTimeout(function(){

                  form.find(".alert").each(function(){
                    $(this).remove();
                  });

                }, 3000);
            },
            error: function (data) {
                form.append("<div class='alert alert-danger mt-1 mb-0'>Error Occured. Try again later.</div>");
                // error occured
                $("#signup .signup").prop("disabled", false);
                $("#signup .signup").html("Sign Up");
            }
        });
    });

});