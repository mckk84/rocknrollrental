$(document).ready(function(){

  $(".addtocart").click(function(){

    if( $(this).hasClass('carted') )
    {
      $(this).removeClass('carted');
      $(this).find('i').eq(0).removeClass('fa-check-circle').addClass('fa-circle-plus');
    }
    else
    {
      $(this).addClass('carted');
      $(this).find('i').eq(0).removeClass('fa-circle-plus').addClass('fa-check-circle');
    }

  });

  function setTimeSpecial(ele, hour)
  {
    let start = hour;
    let len = 7 + 14 - hour;
    for (let i = 1; i <= len; i++) 
    {
      if( start == 7 )
      {
        let t = ( start < 10 ) ? "0"+start : start;
        let m = "30";
        let ap = "AM";
        ele.append($('<option>', {
            value: t+":"+m+" "+ap,
            text: t+":"+m+" "+ap
        }));
      }
      else
      {
        console.log("start="+start);
        let t = ( start < 10 ) ? "0"+start : start;
        if( start > 12 )
        {
          t = start - 12;
          t = ( t < 10 ) ? "0"+t : t;
        }
        let m = "00";
        let ap = ( start >= 12 ) ? "PM" : "AM";
        ele.append($('<option>', {
            value: t+":"+m+" "+ap,
            text: t+":"+m+" "+ap
        }));

        if( start != 20 ){
          let mh = "30";
          ele.append($('<option>', {
              value: t+":"+mh+" "+ap,
              text: t+":"+mh+" "+ap
          }));
        }
      }      
      start = start + 1;
    }
  }
    
  function setTimeAll(ele)
  {
    let start = 7;
    for (let i = 1; i <= 14; i++) 
    {
      if( start == 7 )
      {
        let t = ( start < 10 ) ? "0"+start : start;
        let m = "30";
        let ap = "AM";
        ele.append($('<option>', {
            value: t+":"+m+" "+ap,
            text: t+":"+m+" "+ap
        }));
      }
      else
      {
        console.log("start="+start);
        let t = ( start < 10 ) ? "0"+start : start;
        if( start > 12 )
        {
          t = start - 12;
          t = ( t < 10 ) ? "0"+t : t;
        }
        let m = "00";
        let ap = ( start >= 12 ) ? "PM" : "AM";
        ele.append($('<option>', {
            value: t+":"+m+" "+ap,
            text: t+":"+m+" "+ap
        }));

        if( start != 20 ){
          let mh = "30";
          ele.append($('<option>', {
              value: t+":"+mh+" "+ap,
              text: t+":"+mh+" "+ap
          }));
        }
      }      
      start = start + 1;
    }

  }

  function getdateformat(this_date)
  {
    var dt = this_date.getDate();
    var mt = this_date.getMonth();
    mt = mt + 1;
    var yt = this_date.getFullYear();
    if( mt < 10 ){
      mt = "0"+mt;
    }

    if( dt < 10 ){
      dt = "0"+dt;
    }
    return yt+"-"+mt+"-"+dt;
  }

  var today = new Date();
  var today_date = getdateformat(today);
  var hour = today.getHours();
  console.log("="+today_date);
  console.log(hour);
  hour = hour + 1;
  let pickupdate = today_date;

  if( hour >= 20 )
  {
    var date = new Date();
    date.setDate(date.getDate() + 1);
    today_date = getdateformat(date);
    console.log("Nextday="+today_date);
    // Settime
    setTimeAll($("#pickup_time"));
    setTimeAll($("#dropoff_time"));
  }
  else if( hour <= 7 )
  {
    setTimeAll($("#pickup_time"));
    setTimeAll($("#dropoff_time"));
  }
  else
  {
    setTimeSpecial($("#pickup_time"), hour);
    setTimeAll($("#dropoff_time"), hour);
  }

  $("#pickup_time").change(function(){

    console.log($(this).val());
    let val = $(this).val().split(":");
    let hour = parseInt(val[0]);
    let mam = val[1].split(" ");
    let min = mam[0];
    let ampm = mam[1];

    console.log(val);
    if( ampm == "PM" )
    {
      console.log(ampm);
      if( hour >= 1 && hour <= 7 )
      {
        console.log(hour);
        hour = hour + 13;
        console.log(hour);
      }
      else if( hour == 12 )
      {
        console.log(hour);
        hour = 13;
        console.log(hour);
      }
      if( hour == 8 )
      {
        var date = new Date(pickupdate);
        date.setDate(date.getDate() + 1);
        pickupdate = getdateformat(date);
        $("#dropoff_date").datetimepicker('minDate', moment(pickupdate));
        hour = 7;
      }
    }
    else
    {
      hour = hour + 1;
    }
    $("#dropoff_time").empty();
    console.log(hour);
    setTimeSpecial($("#dropoff_time"), hour);

  });

  $("#pickup_date").datetimepicker({
    format: 'DD-MM-Y',
    minDate:moment(today_date),
    icons: {
      time: "fa-solid fa-clock"
    }
  }).on('dp.change', function(e) {
    console.log('Pickup date');
    pickupdate = $(this).val();
    var temp = pickupdate.split('-');
    pickupdate = temp[2]+"-"+temp[1]+"-"+temp[0];
    $("#dropoff_date").datetimepicker('minDate', moment(pickupdate));
  });

  $("#dropoff_date").datetimepicker({
    format: 'DD-MM-Y',
    minDate:moment(today_date),
    icons: {
      time: "fa-solid fa-clock"
    }
  }).on('dp.change', function(e) {
    console.log('Dropoff date');
    console.log($(this).val());
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