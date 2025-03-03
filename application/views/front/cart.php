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
        <?php if( !isset($cart) || count($cart['cart_bikes']) == 0 ){?>
        <div class="row">
            <h4 class="h4 text-danger">Your Cart is empty. <a class="btn btn-primary" href="<?=base_url('Bookaride')?>">Book a Ride</a></h4>
        </div>    
        <?php } else {?> 
        <div class="row">
            <div class="col-xxl-8">
                <div class="shopping-cart-left">
                    <?php 
                    $subtotal = 0;
                    $gst = 0;
                    $total = 0;
                    ?>
                    <div class="table-content table-responsive table-bordered bg-white rounded">
                        <table class="table cartbikes">
                            <tr class="bg-eq-primary">
                                <th>Fleet</th>
                                <th>Period</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                            <?php 
                            if( isset($cart) && isset($cart['cart_bikes']) )
                            { 
                                $duration = "";
                                foreach($cart['cart_bikes'] as $bike) 
                                {
                                    $rent_price = 0;
                                    if( $cart['period_days'] > 0 || $cart['period_hours'] > 4  ){
                                        $duration = "day";
                                        if( $cart['public_holiday'] == 1 ){
                                            $rent_price = $bike['holiday_day_price'];
                                        }
                                        elseif( $cart['weekend'] == 1 ){
                                            $rent_price = $bike['weekend_day_price'];
                                        } else {
                                            $rent_price = $bike['week_day_price'];
                                        }
                                    } else {
                                        $duration = "halfday";
                                        if( $cart['public_holiday'] == 1 ){
                                            $rent_price = $bike['holiday_day_half_price'];
                                        } elseif( $cart['weekend'] == 1 ){
                                            $rent_price = $bike['weekend_day_half_price'];
                                        } else {
                                            $rent_price = $bike['week_day_half_price'];
                                        } 
                                    }

                                    $total += $rent_price;
                                ?>
                                <tr class="bike-row" data-id="<?=$bike['bike_type_id']?>">
                                    <td>
                                        <span class="d-block mb-2 fw-bold fa-md w-100 text-center"><?=$bike['bike_type_name']?></span>
                                        <img src="<?=base_url('bikes/'.$bike['image'])?>" alt="<?=$bike['bike_type_name']?>" class="img-fluid">
                                    </td>
                                    <td>
                                        <span class="w-100 m-2 p-2 fa-sm font-bold d-block"><?=date("d M Y", strtotime($cart['pickup_date']))?></b></span>
                                        <span class="w-100 m-2 py-2 px-4 fa-sm font-bold d-block"><b><?=$cart['pickup_time']?></b></span>
                                        <span style="width:30px;display:block;margin:10px;margin-left:35px;text-align: center;color: black; background-color: #FFDD06; color: #ffffff; border-radius:20px; font-size:10px; padding:5px 10px;">to</span>
                                        <span class="w-100 m-2 p-2 fa-sm font-bold d-block"><?=date("d M Y", strtotime($cart['dropoff_date']))."<b>";?></b></span>
                                        <span class="w-100 m-2 py-2 px-4 fa-sm font-bold d-block"><b><?=$cart['dropoff_time']?></b></span>
                                    </td>
                                    <td><i class="fa fa-indian-rupee-sign me-1"></i><span class="rent_price d-inline-block p-1"><?=$rent_price?></span> / <span class="d-inline-block p-1"><?=$duration?></span></td>
                                    <td>
                                        <?php if( $bike['bikes_available'] > 1 ){?>
                                        <div class="cart-count d-inline-flex align-items-center">
                                            <button class="cart-minus bg-transparent"><i class="fa-solid fa-minus"></i></button>
                                            <input type="text" data-bike="<?=$bike['bike_type_id']?>" data-available="<?=$bike['bikes_available']?>" class="cart-input" value="<?=$bike['quantity']?>">
                                            <button class="cart-plus bg-transparent"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                        <?php } else { ?>
                                        <div class="cart-count d-inline-flex align-items-center">
                                            <input type="text" disabled class="cart-input" value="<?=$bike['quantity']?>">
                                        </div>
                                        <?php } ?>
                                    </td>
                                    <td><i class="fa fa-indian-rupee-sign me-1"></i><span class="subtotal d-inline-block p-1"><?=$rent_price?></span></td>
                                    <td><button title="Remove Bike" bike-id="<?=$bike['bike_type_id']?>" class="cart-delete bg-transparent"><i class="fa-solid fa-trash"></i></button></td>
                                </tr>
                                <?php } 
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
                            <a id="checkout" style="display: none;float: right;" class="btn btn-sm btn-primary" href="javascript:void(0)">Book Now</a>
                        </form>
                    </div>
                    <div class="table-bottom d-flex flex-wrap align-items-center justify-content-between bg-white mt-4 pt-4 pt-lg-0 mt-lg-0">
                        <form class="d-flex align-items-center flex-wrap">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit" class="btn btn-secondary btn-md">Apply Now</button>
                        </form>
                        <!-- <button type="button" class="btn btn-primary btn-md mt-3 mt-md-0">Update cart</button> -->
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
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="order_subtotal d-inline-block p-1"><?=$total - round($total * 0.05, 2)?></span></th>
                            </tr>
                            <tr>
                                <th class="text-start">GST</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="order_gst d-inline-block p-1"><?=round($total * 0.05, 2)?></span></th>
                            </tr>
                            <tr>
                                <td class="text-start fw-bold">Total</td>
                                <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="total d-inline-block p-1"><?=$total?></span></td>
                            </tr>
                            <tr>
                                <td class="text-start text-warning fw-bold border-0">Refundable Deposit / Vehicle
                                    <span class="d-block text-gray fw-normal text-sm">To be paid at the time of pickup</span></td>
                                <td class="fw-bold text-end border-0"><i class="fa fa-indian-rupee-sign me-1"></i> 1000</td>
                            </tr>                                                           
                        </table>
                        <div class="d-flex flex-column p-4">
                            <form method="POST" action="<?=base_url('Checkout')?>">
                                <div class="radio w-100 mb-2">
                                    <label class="fa-md"><input type="radio" name="paymentOption" value="PAY_FULL" onclick="__setPayment('PAY_FULL');" checked> Make full payment</label>
                                </div>
                                <div class="radio w-100">
                                    <label class="fa-md"><input type="radio" name="paymentOption" value="PAY_PARTIAL" onclick="__setPayment('PAY_PARTIAL');">  Pay cash on pickup (<span style="padding-left:3px;font-size:12px;">50% to be paid online</span>)</label>
                                </div>
                                 <?php if( !isset($user) || !isset($user['Authorization']) || ( isset($user['Authorization']) && $user['Authorization'] == false) ) { ?>
                                    <a href="javascript:void(0)" class="btn btn-primary d-none d-lg-inline-block me-3" data-bs-toggle="modal" data-bs-target="#at_product_view">Login/Sign Up</a>
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

    $(".cart-plus").click(function()
    {
        var v = $(".cart-input").val();
        var available = $(".cart-input").attr('data-available');
        var bike_id = $(".cart-input").attr('data-bike');
        var temp = localStorage.getItem("bike_ids");
        var bike_ids = JSON.parse(temp);
        if( available > v ) 
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
        var bike_id = $(".cart-input").attr('data-bike');
        var temp = localStorage.getItem("bike_ids");
        var bike_ids = JSON.parse(temp);
        var v = $(".cart-input").val();
        if( v == 0 ){
            return false;
        }
        v = parseInt(v) - 1;
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

    });

    $(".cart-delete").click(function(){

        var bikesincart = localStorage.getItem("bikesincart");
        var temp = localStorage.getItem("bike_ids");
        var bike_ids = JSON.parse(temp);

        var bikeId = $(this).attr("bike-id");
        $(".cartbikes").find('[data-id="'+bikeId+'"]').remove()
        bikesincart = parseInt(bikesincart) - 1;
        bike_ids = bike_ids.filter(item => item.bike_id !== bikeId);
        
        console.log(bikesincart);
        console.log(bike_ids);
        
        localStorage.setItem("bikesincart", bikesincart);
        localStorage.setItem("bike_ids", JSON.stringify(bike_ids));

        $("#cartform input[name='bike_ids']").val(JSON.stringify(bike_ids));
        $("#cartform").submit();       

    });

});

</script>