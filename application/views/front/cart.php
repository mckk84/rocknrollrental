<!--breadcrumb section start-->
<section class="breadcrumb-section position-relative overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/texture-bg.png">
    <img src="<?=base_url()?>/assets/img/shapes/tire-print-left.png" alt="tire print" class="position-absolute start-0 z-1 tire-print">
    <img src="<?=base_url()?>/assets/img/shapes/tire-print-right.png" alt="tire print" class="position-absolute end-0 z-1 tire-print">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                    <h1 class="text-white">Cart</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!--breadcrumb section end-->

<!--shopping cart-->
<section class="shopping-cart ptb-60">
    <div class="container">
        <?php
         if( !isset($cart) || ( isset($cart) && count($cart) == 0 ) || ( isset($cart['cart_bikes']) && count($cart['cart_bikes']) == 0 ) ){?>
        <div class="row">
            <h4 class="h4 text-danger">Your Cart is empty. <a class="btn btn-primary" href="<?=base_url('Bookaride')?>">Book a Ride</a></h4>
        </div>    
        <?php } else {?> 
        <div class="row">
            <div class="col-xxl-8">
                <div class="shopping-cart-left mb-4">
                    <?php 
                    $bike_quantity = 0;
                    $subtotal = 0;
                    $gst = 0;
                    $total = 0;
                    ?>
                    <div class="table-content table-responsive table-bordered bg-white rounded mb-4">
                        <table class="table cartbikes">
                            <tr class="bg-eq-primary">
                                <th>Fleet</th>
                                <th>Period</th>
                                <th>Rent</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                            <?php 
                            if( isset($cart) && isset($cart['cart_bikes']) )
                            { 
                                foreach($cart['cart_bikes'] as $bike) 
                                {
                                    $rent_price = $bike['rent_price'];
                                    $subtotal += round($rent_price * $bike['quantity'], 2);
                                    $bike_quantity += $bike['quantity'];
                                ?>
                                <tr class="bike-row" data-id="<?=$bike['bike_type_id']?>">
                                    <td>
                                        <span class="d-block mb-2 fw-bold fa-md w-100 text-center"><?=$bike['bike_type_name']?></span>
                                        <img style="max-width:200px;" src="<?=base_url('bikes/'.$bike['image'])?>" alt="<?=$bike['bike_type_name']?>" class="img-fluid">
                                    </td>
                                    <td>
                                        <span class="w-100 m-2 p-2 fa-sm font-bold d-block"><b><?=date("d M Y", strtotime($cart['pickup_date']))?></b></span>
                                        <span class="w-100 m-2 py-2 px-4 fa-sm font-bold d-block"><b><?=$cart['pickup_time']?></b></span>
                                        <span style="width:30px;display:block;margin:10px;margin-left:35px;text-align: center;color: black; background-color: #FFDD06; color: #ffffff; border-radius:20px; font-size:10px; padding:5px 10px;">to</span>
                                        <span class="w-100 m-2 p-2 fa-sm font-bold d-block"><b><?=date("d M Y", strtotime($cart['dropoff_date']))."<b>";?></b></span>
                                        <span class="w-100 m-2 py-2 px-4 fa-sm font-bold d-block"><b><?=$cart['dropoff_time']?></b></span>
                                    </td>
                                    <td><i class="fa fa-indian-rupee-sign me-1"></i><?=$rent_price?></td>
                                    <td>
                                        <?php if( $bike['bikes_available'] > 1 ){?>
                                        <div class="cart-count d-inline-flex align-items-center">
                                            <button class="cart-minus bg-transparent"><i class="fa fa-minus"></i></button>
                                            <input type="text" data-bike="<?=$bike['bike_type_id']?>" data-available="<?=$bike['bikes_available']?>" id="cart-input" class="cart-input" value="<?=$bike['quantity']?>">
                                            <button class="cart-plus bg-transparent"><i class="fa fa-plus"></i></button>
                                        </div>
                                        <?php } else { ?>
                                        <div class="cart-count d-inline-flex align-items-center">
                                            <input type="text" disabled class="cart-input" id="cart-input" value="<?=$bike['quantity']?>">
                                        </div>
                                        <?php } ?>
                                    </td>
                                    <td><i class="fa fa-indian-rupee-sign me-1"></i><span class="subtotal d-inline-block p-1"><?=round($rent_price * $bike['quantity'], 2)?></span></td>
                                    <td><button title="Remove Bike" bike-id="<?=$bike['bike_type_id']?>" class="cart-delete bg-transparent"><i class="fa fa-trash"></i></button></td>
                                </tr>
                                <?php } 
                                $total = $subtotal;
                            }
                        ?>
                        </table>
                        <form id="cartform" method="POST" action="<?=base_url('Cart')?>">
                            <input type="hidden" name="bike_ids" value="<?=$cart['bike_ids']?>">
                            <input type="hidden" name="pickup_date" value="<?=$cart['pickup_date']?>">
                            <input type="hidden" name="pickup_time" value="<?=$cart['pickup_time']?>">
                            <input type="hidden" name="dropoff_date" value="<?=$cart['dropoff_date']?>">
                            <input type="hidden" name="dropoff_time" value="<?=$cart['dropoff_time']?>">
                            <input type="hidden" name="period_days" value="<?=$cart['period_days']?>">
                            <input type="hidden" name="period_hours" value="<?=$cart['period_hours']?>">
                            <input type="hidden" name="public_holiday" value="<?=$cart['public_holiday']?>">
                            <input type="hidden" name="weekend" value="<?=$cart['weekend']?>">
                            <input type="hidden" name="early_pickup" value="<?=$cart['early_pickup']?>">
                            <input type="hidden" name="coupon_code" value="<?=isset($cart['coupon_code'])?$cart['coupon_code']:""?>">
                            <input type="hidden" name="helmets_qty" value="<?=isset($cart['helmets_qty'])?$cart['helmets_qty']:"0"?>">
                            <a id="checkout" style="display: none;float: right;" class="btn btn-sm btn-primary" href="javascript:void(0)">Book Now</a>
                        </form>
                    </div>
                    <div class="table-bottom d-flex flex-wrap align-items-center justify-content-between bg-white mt-2 pt-2 pt-lg-0 mt-lg-0">
                        <div class="helmet-option">
                            <label>One Helemt is free.  <input type="checkbox" style="width:20px;height:20px;margin-left:5px;" id="add_helmet" name="add_helmet" class="me-2" <?=($cart["helmets_qty"] != "" && $cart["helmets_qty"] > 0)?"checked":""?> > Add an extra for ₹50/day. </label>
                        </div>
                    </div>
                    <div style="<?=($cart["helmets_qty"]!="" && $cart["helmets_qty"] > 0)?"":"display:none;"?>" class="helmet_content table-content table-responsive table-bordered bg-white rounded mb-4">
                        <table class="table cartbikes">
                            <tr class="bg-eq-primary">
                                <th>Helmet</th>
                                <th>Period</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                            <tr class="helmet-row">
                                <td>
                                    <img style="max-width:100px;" src="<?=base_url()?>assets/img/icons/helmet_black.svg" alt="Helmet" class="d-block mx-auto img-fluid">
                                </td>
                                <td>
                                    <span class="w-100 m-2 p-2 fa-sm font-bold d-block"><?=date("d M Y", strtotime($cart['pickup_date']))?></b></span>
                                    <span class="w-100 m-2 py-2 px-4 fa-sm font-bold d-block"><b><?=$cart['pickup_time']?></b></span>
                                    <span style="width:30px;display:block;margin:10px;margin-left:35px;text-align: center;color: black; background-color: #FFDD06; color: #ffffff; border-radius:20px; font-size:10px; padding:5px 10px;">to</span>
                                    <span class="w-100 m-2 p-2 fa-sm font-bold d-block"><?=date("d M Y", strtotime($cart['dropoff_date']))."<b>";?></b></span>
                                    <span class="w-100 m-2 py-2 px-4 fa-sm font-bold d-block"><b><?=$cart['dropoff_time']?></b></span>
                                </td>
                                <td><i class="fa fa-indian-rupee-sign me-1"></i><span class="helemt_rent_price d-inline-block p-1">50</span>/<span class="d-inline-block p-1">day</span></td>
                                <td>
                                    <div style="min-width: 150px;" class="cart-count bg-white d-flex justify-content-center">
                                        <span class="btn btn-sm cart-hminus bg-primary text-white rounded-0"><i class="fa fa-minus"></i></span>
                                        <input type="text" name="helmets_qty" class="w-50 cart-helmets text-center border text-black rounded-0" value="<?=isset($cart["helmets_qty"])?$cart["helmets_qty"]:0?>">
                                        <span class="btn btn-sm cart-hplus bg-primary text-white rounded-0"><i class="fa fa-plus"></i></span>
                                    </div>
                                </td>
                                <td><i class="fa fa-indian-rupee-sign me-1"></i><span class="subtotal d-inline-block p-1"><?=isset($cart["helmets_qty"])?$cart["helmets_qty"] * 50:0?></span></td>
                            </tr>
                        </table>
                        <?php if( isset($cart['helmets_qty']) && $cart['helmets_qty'] != 0 && $cart['helmets_qty'] != "" )
                        {
                            $total += intval($cart['helmets_qty']) * 50;
                        }
                        ?>
                    </div>
                    <div class="table-bottom d-flex flex-wrap align-items-center justify-content-between bg-white mt-4 pt-4 pt-lg-0 mt-lg-0">
                        <form method="POST" action="<?=base_url('Cart')?>" class="d-flex align-items-center flex-wrap">
                            <input type="text" name="coupon_code" placeholder="Coupon code" required maxlength="20">
                            <button type="submit" class="btn btn-secondary btn-md">Apply Now</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-lg-6">
                <div class="cart-sidebar bg-white rounded p-0 mt-xxl-0">
                    <div class="table-responisve rounded">
                        <table class="table rounded">
                            <tr class="bg-eq-primary">
                                <th class="text-start" colspan="2">Cart Total</th>
                            </tr>
                            <tr>
                                <th class="text-start">Subtotal</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="order_subtotal d-inline-block"><?=$subtotal - round($subtotal * 0.05, 2)?></span></th>
                            </tr>
                            <?php if($cart['early_pickup'] == 1){
                                $total = $total + round($bike_quantity * 200, 2);?>
                            <tr>
                                <th class="text-start">Early Pickup</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="early_pickup d-inline-block"><?=round($bike_quantity * 200, 2)?></span></th>
                            </tr>
                            <?php } ?>
                            <tr>
                                <th class="text-start">GST</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="order_gst d-inline-block"><?=round($subtotal * 0.05, 2)?></span></th>
                            </tr>
                            <tr>
                                <td class="text-start fw-bold">Total</td>
                                <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="total d-inline-block"><?=$total?></span></td>
                            </tr>
                            <tr>
                                <td class="text-start text-warning fw-bold border-0">Refundable Deposit / Vehicle
                                    <span class="d-block text-gray fw-normal text-sm">To be paid at the time of pickup</span></td>
                                <td class="fw-bold text-end border-0"><i class="fa fa-indian-rupee-sign me-1"></i> 1000
                                    <span class="d-block text-info fw-normal text-sm">(Not paying now)</span>
                                </td>
                            </tr>                                                           
                        </table>
                        <div class="d-flex flex-column pb-4 pt-2">
                            <form method="POST" action="<?=base_url('Checkout')?>">
                                <div class="w-100 mb-4 border rounded bg-light">
                                    <label class="fa-md text-info py-2 px-2"><input type="checkbox" name="early_pickup_charge" value="1" <?=($cart['early_pickup']==1)?"checked":""?> > Pickup early at 6:00 AM for  200 extra / bike.</label>
                                </div>                                
                                <div class="radio w-100 mb-2">
                                    <label class="fa-md"><input type="radio" name="paymentOption" value="PAY_FULL" onclick="__setPayment('PAY_FULL');" checked> Make full payment</label>
                                </div>
                                <div class="radio w-100">
                                    <label class="fa-md"><input type="radio" name="paymentOption" value="PAY_PARTIAL" onclick="__setPayment('PAY_PARTIAL');"> 50% Advance.</label>
                                </div>
                                <?php if( !isset($user) || !isset($user['Authorization']) || ( isset($user['Authorization']) && $user['Authorization'] == false) ) { ?>
                                    <a href="javascript:void(0)" class="btn btn-primary d-none d-lg-inline-block me-3" data-bs-toggle="modal" data-bs-target="#login_form">Login/Sign Up</a>
                                <?php } else { ?>  
                                <button type="submit" class="btn btn-primary btn-md d-block mt-4">Proceed to Checkout</a>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</section>
<!--shopping cart end-->
<script type="text/javascript">

$(document).ready(function(){

    $(".helmet-option label").on("click", function () {
        if ($(this).children("input").is(":checked")) {
          $("#cartform input[name='helmets_qty']").val(1);
          $(".helmet_content").slideDown();
        } else {
          $("#cartform input[name='helmets_qty']").val(0);
          $(".helmet_content").slideUp();
        }
    });

    $("input[name='early_pickup_charge']").on("change", function () {
        var temp = localStorage.getItem("bike_ids");
        var bike_ids = JSON.parse(temp);

        if ($(this).is(":checked")) {
          $("#cartform input[name='early_pickup']").val(1);
        } else {
          $("#cartform input[name='early_pickup']").val(0);         
        }
        var v = $(".cart-helmets").val();
        $("#cartform input[name='helmets_qty']").val(v);
        $("#cartform input[name='bike_ids']").val(JSON.stringify(bike_ids));
        $("#cartform").submit();
    });

    $(".cart-plus").click(function()
    {
        var v = $(this).siblings(".cart-input").val();
        var v = parseInt(v);
        var available = parseInt($(this).siblings(".cart-input").attr('data-available'));
        var bike_id = $(this).siblings(".cart-input").attr('data-bike');
        var temp = localStorage.getItem("bike_ids");
        var bike_ids = JSON.parse(temp);
        console.log("v="+v);
        console.log(available);
        if( v < available ) 
        {
            v = parseInt(v) + 1;
            $(".cart-input").val(v);    
            for (var prop in bike_ids) 
            {
                var p = bike_ids[prop];
                if( p.bike_id == bike_id ){
                    p.qty = v;
                }
                bike_ids[prop] = p;
            }
            localStorage.setItem("bike_ids", JSON.stringify(bike_ids));
            var v = $(".cart-helmets").val();
            $("#cartform input[name='helmets_qty']").val(v);
            $("#cartform input[name='bike_ids']").val(JSON.stringify(bike_ids));
            $("#cartform").submit();
        }
        else
        {
            $(".table-bottom").append("<div class='alert alert-danger mt-1 mb-0'>Available limit crossed.</div>");
            setTimeout(function(){
                $(".table-bottom").find(".alert").each(function(){
                  $(this).remove();
                });
            }, 2000);
        }        
    });

    $(".cart-minus").click(function()
    {
        var bike_id = $(this).siblings(".cart-input").attr('data-bike');
        var temp = localStorage.getItem("bike_ids");
        var bike_ids = JSON.parse(temp);
        var v = $(this).siblings(".cart-input").val();
        if( v == 0 ){
            return false;
        }
        v = parseInt(v) - 1;
        $(this).siblings(".cart-input").val(v);

        for (var prop in bike_ids) 
        {
            var p = bike_ids[prop];
            if( p.bike_id == bike_id ){
                p.qty = v;
            }
            bike_ids[prop] = p;
        }
        localStorage.setItem("bike_ids", JSON.stringify(bike_ids));
        var v = $(".cart-helmets").val();
        $("#cartform input[name='helmets_qty']").val(v);

        $("#cartform input[name='bike_ids']").val(JSON.stringify(bike_ids));
        $("#cartform").submit();    

    });

    $(".cart-delete").click(function(){

        var bikesincart = localStorage.getItem("bikesincart");
        var temp = localStorage.getItem("bike_ids");
        var bike_ids = JSON.parse(temp);

        var bikeId = $(this).attr("bike-id");
        $(".cartbikes").find('[data-id="'+bikeId+'"]').remove();
        if( bikesincart > 0)
        {
            bikesincart = parseInt(bikesincart) - 1;
        }
        bike_ids = bike_ids.filter(item => item.bike_id !== bikeId);
        
        console.log(bikesincart);
        console.log(bike_ids);
        
        localStorage.setItem("bikesincart", bikesincart);
        localStorage.setItem("bike_ids", JSON.stringify(bike_ids));

        var v = $(".cart-helmets").val();
        if( bikesincart < 1 ){
            $("#cartform input[name='helmets_qty']").val(0);
        }
        else
        {
            $("#cartform input[name='helmets_qty']").val(v);
        }
        $("#cartform input[name='bike_ids']").val(JSON.stringify(bike_ids));
        $("#cartform").submit();       
    });

    $(".cart-hminus").click(function()
    {
        var v = $(".cart-helmets").val();
        if( v == 0 ){
            return false;
        }
        v = parseInt(v) - 1;
        $(".cart-helmets").val(v);
        var helemt_rent_price = $(".helmet_content .helemt_rent_price").html();
        var helemt_total = $(".helmet_content .subtotal").html();
        helemt_total = parseInt(helemt_rent_price) * parseInt(v);
        $(".helmet_content .subtotal").html(helemt_total);
        $("#cartform input[name='helmets_qty']").val(v);

        var temp = localStorage.getItem("bike_ids");
        var bike_ids = JSON.parse(temp);
        $("#cartform input[name='bike_ids']").val(JSON.stringify(bike_ids));
            
        $("#cartform").submit();
    });

    $(".cart-hplus").click(function()
    {
        var v = $(".cart-helmets").val();
        v = parseInt(v) + 1;
        $(".cart-helmets").val(v);
        var helemt_rent_price = $(".helmet_content .helemt_rent_price").html();
        var helemt_total = $(".helmet_content .subtotal").html();
        helemt_total = parseInt(helemt_rent_price) * parseInt(v);
        $(".helmet_content .subtotal").html(helemt_total);
        $("#cartform input[name='helmets_qty']").val(v);

        var temp = localStorage.getItem("bike_ids");
        var bike_ids = JSON.parse(temp);
        $("#cartform input[name='bike_ids']").val(JSON.stringify(bike_ids));

        $("#cartform input[name='bike_ids']").val(JSON.stringify(bike_ids));
        $("#cartform").submit();
    });

});

</script>