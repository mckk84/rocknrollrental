<!--breadcrumb section start-->
<section class="breadcrumb-section position-relative overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/texture-bg.png">
    <img src="<?=base_url()?>/assets/img/shapes/tire-print-left.png" alt="tire print" class="position-absolute start-0 z-1 tire-print">
    <img src="<?=base_url()?>/assets/img/shapes/tire-print-right.png" alt="tire print" class="position-absolute end-0 z-1 tire-print">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 mx-auto">
                <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                    <h1 class="text-white">Checkout</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!--breadcrumb section end-->

<!--shopping cart-->
<section class="shopping-cart ptb-60">
    <div class="container">
        <?php if( isset($order) && is_array($order) && count($order) > 0 ){?>
        <div class="row">
            <div class="col-xl-6">
                <p class="m-1 mb-2 font-bold fs-7"><b><?=$order['order']['customer']['name']?></b>, You are editing Booking Order: <b>#<?=$order['order']['booking_id']?></b><a class="d-inline-block btn btn-sm btn-danger py-1 px-2 text-white mx-3" title="Cancel Editing Order" href="<?=base_url('/Cart/cancel')?>">Cancel</a></p>
            </div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-xxl-8">
                <?php if( !isset($user) || !isset($user['Authorization']) || ( isset($user['Authorization']) && $user['Authorization'] == false) ) { ?>
                    
                <?php } else { ?> 
                <div class="checkout-badge bg-light px-0 d-flex align-items-center justify-content-between">
                    <h4 class="h5 px-4 mb-0">
                        Personal Details
                    </h4>
                </div>
                <?php
                $isMobile = checkMobile();
                if( $isMobile == false ){?>
                <div class="shopping-cart-left">
                    <div class="table-content table-responsive table-bordered bg-white rounded">
                        <table class="table cartbikes">
                            <tr class="bg-eq-primary">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                            <tr>
                                <td><?=$user['name']?></td>
                                <td>
                                    <?=$user['email']?>
                                </td>
                                <td><?=$user['phone']?></td>
                            </tr>
                        </table>
                    </div>
                </div> 
                <?php } else { ?>
                <div class="shopping-cart-left">
                    <div class="table-content table-responsive table-bordered bg-white rounded">
                        <table class="table cartbikes">
                            <tr><th class="bg-warning-light">Name</th><td><?=$user['name']?></td></tr>
                            <tr><th class="bg-warning-light" >Email</th><td><?=$user['email']?></td></tr>
                            <tr><th class="bg-warning-light">Phone</th><td><?=$user['phone']?></td></tr>
                        </table>
                    </div>
                </div>    
                <?php } ?>
                <?php } ?>
                <div class="checkout-badge bg-light px-0 d-flex align-items-center justify-content-between">
                    <h4 class="h5 px-4 mb-0">
                        Your Order
                    </h4>
                </div>
                <?php
                $isMobile = checkMobile();
                if( $isMobile == false ){?>
                <div class="shopping-cart-left mb-4">
                    <?php 
                    $bike_quantity = 0;
                    $subtotal = 0;
                    $gst = 0;
                    $total = 0;
                    $helmets_total = 0;
                    ?>
                    <div class="table-content table-responsive table-bordered bg-white rounded">
                        <table class="table cartbikes mb-2">
                            <tr class="bg-eq-primary">
                                <th>Fleet</th>
                                <th>Period</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                            <?php 
                            if( isset($cart) && isset($cart['cart_bikes']) )
                            { 
                                foreach($cart['cart_bikes'] as $bike) 
                                {
                                    $rent_price = $bike['rent_price'];
                                    $rent_total = round($bike['quantity'] * $rent_price, 2);
                                    $bike_quantity += $bike['quantity'];

                                    $subtotal += $rent_total;
                                ?>
                                <tr class="bike-row" data-id="<?=$bike['bike_type_id']?>">
                                    <td>
                                        <span class="d-block mb-2 fw-bold fa-md w-100 text-center"><?=$bike['bike_type_name']?></span>
                                        <img style="max-width:200px;" src="<?=base_url('bikes/'.$bike['image'])?>" alt="<?=$bike['bike_type_name']?>" class="d-block mx-auto img-fluid">
                                    </td>
                                    <td><span class="w-100 m-2 p-2 fa-sm font-bold d-block"><b><?=date("d M Y", strtotime($cart['pickup_date']))?></b></span>
                                        <span class="w-100 m-2 py-2 px-4 fa-sm font-bold d-block"><b><?=$cart['pickup_time']?></b></span>
                                        <span style="width:30px;display:block;margin:10px;margin-left:35px;text-align: center;color: black; background-color: #FFDD06; color: #ffffff; border-radius:20px; font-size:10px; padding:5px 10px;">to</span>
                                        <span class="w-100 m-2 p-2 fa-sm font-bold d-block"><b><?=date("d M Y", strtotime($cart['dropoff_date']))."<b>";?></b></span>
                                        <span class="w-100 m-2 py-2 px-4 fa-sm font-bold d-block"><b><?=$cart['dropoff_time']?></b></span>

                                    </td>
                                    <td><i class="fa fa-indian-rupee-sign me-1"></i><?=$rent_price?></td>
                                    <td>
                                        <div class="d-flex text-center">
                                            <span class="d-block m-auto text-center font-normal"><?=$bike['quantity']?></span>
                                        </div>
                                    </td>
                                    <td><i class="fa fa-indian-rupee-sign me-1"></i><?=$rent_total?></td>
                                </tr>
                                <?php } 
                                $total += $subtotal;
                            } ?>
                            </table>

                            <?php 
                            if( (isset($cart['helmets_qty']) && $cart['helmets_qty'] > 0) || (isset($cart['free_helmet']) && $cart['free_helmet'] > 0) ){

                                $helmets_price = 50;
                                $helmets_total = $cart['helmets_qty'] * $helmets_price;
                            ?>
                                <table class="table">
                                    <tr class="bg-eq-primary">
                                        <th colspan="2">Addons</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="helmet-option">
                                                <label class="w-100">1 Helmet free per Vehicle </label>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="fa fa-indian-rupee-sign me-1"></i><span class="subtotal d-inline-block p-1">0</span>
                                        </td>
                                    </tr>
                                    <?php if( (isset($cart['helmets_qty']) && $cart['helmets_qty'] > 0) ){?>
                                    <tr>
                                       <td>
                                            <label class="w-100">Extra Hemelts (<?=$cart["helmets_qty"]?>)</label>
                                            
                                        </td>
                                        <td>
                                            <i class="fa fa-indian-rupee-sign me-1"></i><span class="subtotal d-inline-block p-1"><?=isset($cart["helmets_qty"])?$cart["helmets_qty"] * 50:0?></span>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                                <?php }
                        ?>
                        </table>
                    </div>
                </div>
                <?php } else { ?>
                <div class="shopping-cart-left mb-4">
                    <?php 
                    $bike_quantity = 0;
                    $subtotal = 0;
                    $gst = 0;
                    $total = 0;
                    $helmets_total = 0;
                    ?>
                    <div class="table-content table-responsive table-bordered bg-white rounded">
                            <?php 
                            if( isset($cart) && isset($cart['cart_bikes']) )
                            { 
                                foreach($cart['cart_bikes'] as $index => $bike) 
                                {
                                    $rent_price = $bike['rent_price'];
                                    $rent_total = round($bike['quantity'] * $rent_price, 2);
                                    $bike_quantity += $bike['quantity'];
                                    $sl = $index + 1;
                                    $subtotal += $rent_total;
                                ?>
                                <table class="table cartbikes mb-1">
                                    <tr class="border bike-row" data-id="<?=$bike['bike_type_id']?>">
                                        <td class="position-relative" colspan="2">
                                            <span style="position: absolute;top: 1px;left: 1px;padding: 5px;border-right: 1px solid rgba(11, 22, 63, 0.07);border-bottom: 1px solid rgba(11, 22, 63, 0.07);z-index: 9;display: block;width: 50px;background-color: rgb(255, 220, 0);" class="fw-bold fa-md text-center"><?=$sl?></span>
                                            <span class="d-block fw-bold fa-xl w-100 text-center p-3"><?=$bike['bike_type_name']?></span>
                                            <img style="max-width:250px;display: block; margin:auto;" src="<?=base_url('bikes/'.$bike['image'])?>" alt="<?=$bike['bike_type_name']?>" class="img-fluid">
                                            <button title="Remove Bike" bike-id="<?=$bike['bike_type_id']?>" style="right:5px;bottom:5px" class="position-absolute cart-delete text-danger bg-transparent"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr class="border">
                                        <td colspan="2" class="text-center position-relative p-1">
                                            <span class="d-block w-45 float-left">
                                                <span class="w-100 m-1 p-1 fa-md d-block"><b><?=date("d M Y", strtotime($cart['pickup_date']))?></b></span>
                                                <span class="w-100 m-1 py-1 px-4 fa-md d-block"><b><?=$cart['pickup_time']?></b></span>
                                            </span>
                                            <span style="width: 30px;float: left;display: block;text-align: center;color: orange;padding: 5px 10px;font-size:30px;margin-top:10px;">></span>
                                            <span class="d-block w-45 float-left">
                                                <span class="w-100 m-1 p-1 fa-md d-block"><b><?=date("d M Y", strtotime($cart['dropoff_date']))."<b>";?></b></span>
                                                <span class="w-100 m-1 py-1 px-4 fa-md d-block"><b><?=$cart['dropoff_time']?></b></span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="border">
                                        <td colspan="2" class="border-0 text-center p-1">
                                            <label class="fw-semibold" style="width:auto; padding:5px 5px;display: inline-block;">Qty</label>
                                            <?php if( $bike['bikes_available'] > 1 ){?>
                                            <div class="cart-count border p-0 d-inline-flex align-items-center">
                                                <button class="cart-minus p-2 btn btn-sm bg-secondary text-white rounded-0"><i class="fa fa-minus"></i></button>
                                                <input type="text" style="padding:8px" data-bike="<?=$bike['bike_type_id']?>" data-available="<?=$bike['bikes_available']?>" class="bg-white cart-input" value="<?=$bike['quantity']?>">
                                                <button class="cart-plus p-2 btn btn-sm bg-secondary text-white rounded-0"><i class="fa fa-plus"></i></button>
                                            </div>
                                            <?php } else { ?>
                                            <div class="cart-count border d-inline-flex align-items-center">
                                                <input type="text" disabled class="cart-input" value="<?=$bike['quantity']?>">
                                            </div>
                                            <?php } ?>
                                            &nbsp;
                                            <label class="fw-semibold" style="width:auto; padding:5px 5px;display: inline-block;">X</label>
                                            &nbsp;
                                            <i class="fa fa-indian-rupee-sign me-1"></i><?=$rent_price?>
                                            &nbsp;
                                            <label class="fw-semibold" style="width:auto; padding:5px 5px;display: inline-block;">=</label>
                                            &nbsp;
                                            <i class="fa fa-indian-rupee-sign me-1"></i><span class="subtotal fw-semibold fa-md d-inline-block p-1"><b><?=round($rent_price * $bike['quantity'], 2)?></b></span>
                                        </td>
                                    </tr>
                                </table>
                                <?php } 
                                $total += $subtotal;
                            }
                            if( isset($cart['helmets_qty']) && $cart['helmets_qty'] > 0 ){

                                $helmets_price = 50;
                                $helmets_total = $cart['helmets_qty'] * $helmets_price;
                            ?>
                                <table class="table">
                                    <tr class="bg-eq-primary">
                                        <th colspan="2">Addons</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="helmet-option">
                                                <label class="w-100">1 Helmet free per Vehicle </label>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="fa fa-indian-rupee-sign me-1"></i><span class="subtotal d-inline-block p-1">0</span>
                                        </td>
                                    </tr>
                                    <tr>
                                       <td>
                                            <label class="w-100">Extra Hemelts (<?=$cart["helmets_qty"]?>)</label>
                                            
                                        </td>
                                        <td>
                                            <i class="fa fa-indian-rupee-sign me-1"></i><span class="subtotal d-inline-block p-1"><?=isset($cart["helmets_qty"])?$cart["helmets_qty"] * 50:0?></span>
                                        </td>
                                    </tr>
                                </table>
                                <?php }
                        ?>
                        </table>
                    </div>
                </div>   
                <?php } 
                ?>
            </div>
            <div class="col-xxl-4 col-lg-6">
                <div class="cart-sidebar bg-white rounded p-0 mt-xxl-0">
                    <div class="table-responisve rounded">
                        <table class="table rounded">
                            <tr class="bg-eq-primary">
                                <th class="text-start" colspan="2">Order Summary</th>
                            </tr>
                            <tr>
                                <th class="text-start">Subtotal</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i> <?=$subtotal - round($subtotal * 0.05, 2)?></th>
                            </tr>
                            <?php if($cart['helmets_qty'] > 0){
                                $total = $total + round($cart['helmets_qty'] * 50, 2);
                            ?>
                            <tr>
                                <th class="text-start">Helmet Charges</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="helmet_order_subtotal d-inline-block"><?=round($cart['helmets_qty'] * 50, 2)?></span></th>
                            </tr>
                            <?php } ?>
                            <?php if($cart['early_pickup'] == 1){
                                $total = $total + round($bike_quantity * 200, 2);
                            ?>
                            <tr>
                                <th class="text-start">Early Pickup</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="early_pickup d-inline-block"><?=round($bike_quantity * 200, 2)?></span></th>
                            </tr>
                            <?php } ?>
                            <tr>
                                <th class="text-start">GST</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i> <?=round($subtotal * 0.05, 2)?></th>
                            </tr>
                            <?php if( isset($cart['coupon_code']) && $cart['coupon_code'] != ""){
                                if( $cart['coupon_type'] == 'percent' )
                                {
                                    $discount = round($subtotal * ($cart['coupon_discount'] / 100));
                                }else{
                                    $discount = $cart['coupon_discount'];
                                }
                                $total = $total - $discount;
                            ?>
                            <tr>
                                <th class="text-start text-warning">Coupon(<?=$cart['coupon_code']?>) Discount</th>
                                <th class="text-end text-warning"><i class="fa fa-indian-rupee-sign me-1"></i><span class="d-inline-block"><?=$discount?></span></th>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td class="text-start fw-bold">Total</td>
                                <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i> <?=$total;?></td>
                            </tr>
                            <?php $paying = $total; ?>
                            <tr>
                                <td class="text-start fw-bold">
                                    Paying Now
                                    <?php if( $cart['paymentOption'] != "PAY_FULL" ){?>
                                        <span class="d-block text-gray fw-normal text-sm">(Remaining to be paid at the time of pickup)</span>
                                    <?php } ?>
                                </td>
                                <?php if($cart['paymentOption'] == "PAY_FULL"){?>
                                <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i> <?=$total?></td>
                                <?php } else { 
                                    $paying = round( $total /2 , 2);
                                    ?>
                                <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i> <?=round( $total /2 , 2);?></td>
                                <?php } ?>
                            </tr>                                                           
                        </table>
                        <?php if( isset($order) && is_array($order) && count($order) > 0 ){?>
                        <table class="table rounded">
                            <tr class="bg-eq-primary">
                                <th colspan="2" class="text-center fw-bold p-1">Order Changes</th>
                            </tr>
                            <tr>
                                <td class="text-start text-success fw-bold">Paid</td>
                                <td class="fw-bold text-success text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="total d-inline-block"><?=$order['order']['booking_amount']?></span></td>
                            </tr>
                            <?php if( $total > $order['order']['booking_amount'] ){ ?>
                            <tr>
                                <td class="text-start text-success fw-bold">Balance</td>
                                <td class="fw-bold text-success text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="total d-inline-block"><?=$paying - $order['order']['booking_amount']?></span>
                                </td>
                            </tr>
                            <?php } else {?>
                            <tr>
                                <td class="text-start text-success fw-bold">Balance</td>
                                <td class="fw-bold text-success text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="total d-inline-block"><?=$paying - $order['order']['booking_amount']?></span>
                                    <span class="d-block text-info fw-normal text-sm">Negative amount will be settled at the time of pickup.</span>
                                </td>
                            </tr>    
                            <?php } ?>
                        </table>
                        <?php } ?>
                        <div class="d-flex flex-column p-4">
                            <?php if( isset($user) && ( isset($user['Authorization']) && $user['Authorization'] == true) ) { ?>
                            <form class="pay_payment_form" method="POST" action="<?=base_url('Payment')?>">
                                <div class="w-100 px-4 py-4">
                                    <label class="fa-md">Delivery Notes:</label>
                                    <textarea rows="2" class="form-control" name="notes" value=""></textarea>
                                </div>
                                <button type="button" id="proceed_payment" class="btn btn-primary btn-md d-block mt-4 mx-auto">Proceed to Pay</a>
                            </form>
                            <?php } else { ?>
                            <a href="javascript:void(0)" class="btn btn-primary d-none d-lg-inline-block me-3" data-bs-toggle="modal" data-bs-target="#at_product_view">Login/Sign Up</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--shopping cart end-->
<script type="text/javascript">

$(document).ready(function(){

    $("#proceed_payment").click(function(){

        var url = $(".pay_payment_form").attr("action");
        $("#terms_view #payment_form").attr("action", url);
        $("#terms_view").modal("show");

    });

    $('textarea').keypress(function(e) {
        var tval = $('textarea').val(),
            tlength = tval.length,
            set = 250,
            remain = parseInt(set - tlength);
        if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
            $('textarea').val((tval).substring(0, tlength - 1));
            return false;
        }
    });

    $(".cart-plus").click(function(){

        var v = $(".cart-input").val();
        v = parseInt(v) + 1;
        $(".cart-input").val(v);
    });

    $(".cart-minus").click(function(){
        var v = $(".cart-input").val();
        if( v == 0 ){
            return false;
        }
        v = parseInt(v) - 1;
        $(".cart-input").val(v);
    });

    $(".cart-delete").click(function(){

        var bikesincart = localStorage.getItem("bikesincart");
        var bike_ids = localStorage.getItem("bike_ids");

        var bikeId = $(this).attr("bike-id");
        $(".cartbikes").find('[data-id="'+bikeId+'"]').remove()
        bikesincart = parseInt(bikesincart) - 1;
        var temp = bike_ids.split(",");
        temp = temp.filter(item => item !== bikeId);
        bike_ids = temp.join(",");
        
        console.log(bikesincart);
        
        localStorage.setItem("bikesincart", bikesincart);
        localStorage.setItem("bike_ids", bike_ids);

        $("#cartform input[name='bike_ids']").val(bike_ids);
        $("#cartform").submit();       

    });

});

</script>