<!--breadcrumb section start-->
<section class="breadcrumb-section position-relative overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/texture-bg.png">
    <img src="<?=base_url()?>/assets/img/shapes/tire-print-left.png" alt="tire print" class="position-absolute start-0 z-1 tire-print">
    <img src="<?=base_url()?>/assets/img/shapes/tire-print-right.png" alt="tire print" class="position-absolute end-0 z-1 tire-print">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 mx-auto">
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
        <?php if( isset($order) && is_array($order) && count($order) > 0 ){?>
        <div class="row">
            <div class="col-xl-6 col-sm-12">
                <p class="m-1 mb-2 font-bold fs-7"><b><?=$order['order']['customer']['name']?></b>, You are editing Booking Order: <b>#<?=$order['order']['booking_id']?></b><a class="d-inline-block btn btn-sm btn-danger py-1 px-2 text-white mx-3" title="Cancel Editing Order" href="<?=base_url('/Cart/cancel')?>">Cancel</a></p>
            </div>
        </div>
        <?php } ?>
 
        <?php if( isset($cart) && isset($cart['cart_bikes']) ) {

        $isMobile = checkMobile();
        if( $isMobile == false ){
        ?> 
        <div class="row">
            <div class="col-xxl-8">
                <div class="shopping-cart-left mb-4">
                    <?php 
                    $bike_quantity = 0;
                    $subtotal = 0;
                    $gst = 0;
                    $total = 0;
                    $discount = 0;
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
                                    <td><i class="fa fa-indian-rupee-sign me-1"></i><span class="d-inline-block bike_rent"><?=$rent_price?></span></td>
                                    <td>
                                        <?php if( $bike['bikes_available'] > 1 ){?>
                                        <div class="cart-count d-inline-flex align-items-center">
                                            <button class="cart-minus bg-transparent"><i class="fa fa-minus"></i></button>
                                            <input type="text" data-bike="<?=$bike['bike_type_id']?>" data-available="<?=$bike['bikes_available']?>" class="cart-input" value="<?=$bike['quantity']?>">
                                            <button class="cart-plus bg-transparent"><i class="fa fa-plus"></i></button>
                                        </div>
                                        <?php } else { ?>
                                        <div class="cart-count d-inline-flex align-items-center">
                                            <input type="text" disabled class="cart-input" value="<?=$bike['quantity']?>">
                                        </div>
                                        <?php } ?>
                                    </td>
                                    <td><i class="fa fa-indian-rupee-sign me-1"></i><span class="bike_subtotal d-inline-block p-1"><?=round($rent_price * $bike['quantity'], 2)?></span></td>
                                    <td><button title="Remove Bike" bike-id="<?=$bike['bike_type_id']?>" class="cart-delete bg-transparent"><i class="fa fa-trash"></i></button></td>
                                </tr>
                                <?php } 
                                $total = $subtotal;
                            }
                        ?>
                        </table>
                        <form id="cartform" method="POST" action="<?=base_url('Cart/addtoCart')?>">
                            <input type="hidden" name="cartform" value="1">
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
                            <input type="hidden" name="free_helmet" value="<?=isset($cart['free_helmet'])?$cart['free_helmet']:"0"?>">
                            <input type="hidden" name="helmets_qty" value="<?=isset($cart['helmets_qty'])?$cart['helmets_qty']:"0"?>">
                            <a id="checkout" style="display: none;float: right;" class="btn btn-sm btn-primary" href="javascript:void(0)">Book Now</a>
                        </form>
                    </div>
                    <div class="table-bottom d-flex flex-wrap align-items-center justify-content-between bg-white mt-2 pt-2 pt-lg-0 mt-lg-0">
                        <div class="bikes-option">
                            <a href="<?=base_url('Bookaride')?>" class="btn btn-secondary">Add More Bikes</a>
                        </div>
                        <div class="cart_error fs-6">
                        </div>
                    </div>
                    <div class="table-content table-responsive table-bordered bg-white rounded mb-4">
                        <table class="table">
                            <tr class="bg-eq-primary">
                                <th colspan="2">Addons</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="helmet-option">
                                        <label class="w-100"><input type="checkbox" style="width:20px;height:20px;margin-left:5px;vertical-align: middle;" id="free_helmet" name="free_helmet" class="me-2" <?=($cart["free_helmet"] > 0)?"checked":""?> > 1 Helmet is free per vehicle.  </label>
                                    </div>
                                </td>
                                <td>
                                    <i class="fa fa-indian-rupee-sign me-1"></i><span class="d-inline-block p-1">0</span>
                                </td>
                            </tr>
                            <tr>
                               <td>
                                    <label class="w-50 float-left mt-2">
                                        <input type="checkbox" style="width:20px;height:20px;margin-left:5px;vertical-align: middle;" id="add_helmet" name="add_helmet" class="me-2" <?=($cart["helmets_qty"] > 0)?"checked":""?> > Add extra for ₹50/day. </label>

                                    <div style="display:<?=($cart["helmets_qty"] > 0)?"inline-flex":"none"?>;" class="helmet-row cart-count bg-white justify-content-center">
                                        <span class="btn btn-sm p-2 cart-hminus bg-primary text-white rounded-0"><i class="fa fa-minus"></i></span>
                                        <input type="text" name="helmets_qty" class="cart-helmets text-center border text-black rounded-0" value="<?=isset($cart["helmets_qty"])?$cart["helmets_qty"]:0?>">
                                        <span class="btn btn-sm p-2 cart-hplus bg-primary text-white rounded-0"><i class="fa fa-plus"></i></span>
                                    </div>
                                </td>
                                <td>
                                    <i class="fa fa-indian-rupee-sign me-1"></i><span class="helmet_subtotal d-inline-block p-1"><?=isset($cart["helmets_qty"])?$cart["helmets_qty"] * 50:0?></span>
                                </td>
                            </tr>
                        </table>                        
                    </div>
                    <div class="addons_table table-bottom d-flex flex-wrap align-items-center justify-content-between bg-white mt-4 pt-4 pt-lg-0 mt-lg-0">
                        <form method="POST" id="coupon_form" action="<?=base_url('Checkout/coupon')?>" class="d-flex align-items-center flex-wrap">
                            <input type="text" class="text-dark" name="coupon_code" placeholder="Coupon code" required value="<?=isset($cart['coupon_code'])?$cart['coupon_code']:""?>" maxlength="20">
                            <?php if( !isset($cart['coupon_code']) || $cart['coupon_code'] == "" ) {?>
                            <button type="button" class="coupon_apply btn btn-secondary btn-md">Apply Now</button>
                            <?php } else { ?>
                            <button type="button" title="Cancel Coupon" class="coupon_remove btn btn-warning btn-md">X</button>
                            <?php } ?>
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
                            <tr>
                                <th class="text-start">GST</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="order_gst d-inline-block"><?=round($subtotal * 0.05, 2)?></span></th>
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
                            <tr class="order_discount">
                                <th class="text-start text-warning">Coupon(<?=$cart['coupon_code']?>) Discount</th>
                                <th class="text-end text-warning"><i class="fa fa-indian-rupee-sign me-1"></i><span class="d-inline-block"><?=$discount?></span></th>
                            </tr>
                            <?php }  else { ?>
                            <tr style="display:none;" class="order_discount">
                                <th class="text-start">Discount</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="order_discount d-inline-block">0</span></th>
                            </tr>    
                            <?php } ?>
                            <?php if( isset($cart['helmets_qty']) && $cart['helmets_qty'] != 0 && $cart['helmets_qty'] != "" ){
                                $total = $total + round($cart['helmets_qty'] * 50, 2);?>
                            <tr class="order_helemt">
                                <th class="text-start">Helmet Charges</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="helmet_order_subtotal d-inline-block"><?=round($cart['helmets_qty'] * 50, 2)?></span></th>
                            </tr>
                            <?php } else { ?>
                            <tr style="display:none;" class="order_helemt">
                                <th class="text-start">Helmet Charges</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="helmet_order_subtotal d-inline-block">0</span></th>
                            </tr>    
                            <?php } ?>
                            <?php if($cart['early_pickup'] == 1){
                                $total = $total + round($bike_quantity * 200, 2);?>
                            <tr class="order_early_pickup">
                                <th class="text-start">Early Pickup</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="early_pickup d-inline-block"><?=round($bike_quantity * 200, 2)?></span></th>
                            </tr>
                            <?php } else { ?>
                            <tr style="display:none;" class="order_early_pickup">
                                <th class="text-start">Early Pickup</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="early_pickup d-inline-block"><?=round($bike_quantity * 200, 2)?></span></th>
                            </tr>    
                            <?php } ?>   
                            <tr>
                                <td class="text-start fw-bold">Total</td>
                                <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="total d-inline-block"><?=$total?></span></td>
                            </tr>
                            <tr>
                                <td class="text-start text-warning fw-bold border-0">Refundable Deposit / Vehicle
                                    <span class="d-block text-gray fw-normal text-sm">To be paid at the time of pickup</span></td>
                                <td class="fw-bold text-end border-0"><i class="fa fa-indian-rupee-sign me-1"></i> <span class="refundable_deposit d-inline-block"><?=round($bike_quantity * 1000, 2)?></span>
                                    <span class="d-block text-info fw-normal text-sm">(Not paying now)</span>
                                </td>
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
                                <td class="fw-bold text-success text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="total d-inline-block"><?=$total - $order['order']['booking_amount']?></span>
                                </td>
                            </tr>
                            <?php } else {?>
                            <tr>
                                <td class="text-start text-success fw-bold">Balance</td>
                                <td class="fw-bold text-success text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="total d-inline-block"><?=$total - $order['order']['booking_amount']?></span>
                                    <span class="d-block text-info fw-normal text-sm">Negative amount will be settled at the time of pickup.</span>
                                </td>
                            </tr>    
                            <?php } ?>
                        </table>
                        <?php } ?>
                        <div class="d-flex flex-column px-4 pb-4 pt-2">
                            <form method="POST" action="<?=base_url('Checkout')?>">
                                <?php if( $cart['early_pickup'] == 1 || $cart['pickup_time'] == '07:30 AM' || $cart['pickup_time'] == '08:00 AM'){?>
                                <div class="w-100 mb-4 border rounded bg-light">
                                    <label class="fa-md text-info py-2 px-2"><input type="checkbox" name="early_pickup_charge" value="1" <?=($cart['early_pickup']==1)?"checked":""?> > Pickup early at 6:00 AM for  200 extra / bike.</label>
                                </div>                                
                                <?php } elseif( $cart['pickup_time'] == '07:30 AM' || $cart['pickup_time'] == '08:00 AM' ){ ?>
                                <div class="w-100 mb-4 border rounded bg-light">
                                    <label class="fa-md text-info py-2 px-2"><input type="checkbox" name="early_pickup_charge" value="0"> Pickup early at 6:00 AM for  200 extra / bike.</label>
                                </div>
                                <?php } ?>
                                <div class="row px-2 mb-4 justify-content-center">
                                    <label class="w-100 p-0 fa-md mb-1 fw-semibold text-center"><input style="width:20px;height:20px;vertical-align:middle;" type="radio" name="paymentOption" value="PAY_FULL" checked> FULL PAYMENT</label>
                                    <span class="w-100 p-0 d-inline-block text-center fw-bold text-warning">OR</span>
                                    <label class="w-100 p-0 fa-md mt-1 fw-semibold text-center"><input style="width:20px;height:20px;vertical-align:middle;" type="radio" name="paymentOption" value="PAY_PARTIAL" > 50% ADVANCE</label>
                                </div>
                                <div class="row px-2 mb-4 justify-content-center">
                                    <?php if( !isset($user) || !isset($user['Authorization']) || ( isset($user['Authorization']) && $user['Authorization'] == false) ) { ?>
                                        <a href="javascript:void(0)" class="w-50 btn btn-primary d-none d-lg-inline-block me-3" data-bs-toggle="modal" data-bs-target="#login_form">Login/Sign Up</a>
                                    <?php } else { ?>  
                                    <button type="submit" class="w-50 btn btn-primary btn-md d-block mt-4">Proceed to Checkout</button>
                                    <?php } ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else {?>
        <!-- Mobile View-->
        <div class="row">
            <div class="col-sm-12">
                <div class="shopping-cart-left mb-4">
                    <h4>Booking Details</h4>
                    <?php 
                    $bike_quantity = 0;
                    $subtotal = 0;
                    $gst = 0;
                    $total = 0;
                    $discount = 0;
                    ?>
                    <div class="table-content table-responsive bg-white rounded mb-4">
                            <?php 
                            if( isset($cart) && isset($cart['cart_bikes']) )
                            {   ?>
                                <table class="mt-1 table cartbikes">
                                <?php
                                foreach($cart['cart_bikes'] as $index => $bike) 
                                {
                                    $rent_price = $bike['rent_price'];
                                    $subtotal += round($rent_price * $bike['quantity'], 2);
                                    $bike_quantity += $bike['quantity'];
                                    $sl = $index + 1;
                                ?>                                
                                    <tr class="border bike-row" data-id="<?=$bike['bike_type_id']?>">
                                        <td class="position-relative" colspan="2">
                                            <table class="table">
                                                <tr class="border">
                                                    <td class="position-relative" colspan="2">
                                                        <!-- <span style="position: absolute;top: 1px;left: 1px;padding: 5px;border-right: 1px solid rgba(11, 22, 63, 0.07);border-bottom: 1px solid rgba(11, 22, 63, 0.07);z-index: 9;display: block;width: 50px;background-color: rgb(255, 220, 0);" class="fw-bold fa-md text-center"><?=$sl?></span> -->
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
                                                        <i class="fa fa-indian-rupee-sign me-1"></i><span class="d-inline-block bike_rent"><?=$rent_price?></span>
                                                        &nbsp;
                                                        <label class="fw-semibold" style="width:auto; padding:5px 5px;display: inline-block;">=</label>
                                                        &nbsp;
                                                        <i class="fa fa-indian-rupee-sign me-1"></i><span class="bike_subtotal fw-semibold fa-md d-inline-block p-1"><b><?=round($rent_price * $bike['quantity'], 2)?></b></span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                
                                <?php } 
                                $total = $subtotal;?>
                                </table>
                                <?php 
                            }
                        ?>
                        <form id="cartform" method="POST" action="<?=base_url('Cart/addtoCart')?>">
                            <input type="hidden" name="cartform" value="1">
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
                            <input type="hidden" name="free_helmet" value="<?=isset($cart['free_helmet'])?$cart['free_helmet']:"0"?>">
                            <input type="hidden" name="helmets_qty" value="<?=isset($cart['helmets_qty'])?$cart['helmets_qty']:"0"?>">
                            <a id="checkout" style="display: none;float: right;" class="btn btn-sm btn-primary" href="javascript:void(0)">Book Now</a>
                        </form>
                    </div>
                    <div class="table-bottom d-flex flex-wrap align-items-center justify-content-between bg-white mt-2 pt-2 pt-lg-0 mt-lg-0">
                        <div class="bikes-option">
                            <a href="<?=base_url('Bookaride')?>" class="btn btn-secondary">Add More Bikes</a>
                        </div>
                        <div class="cart_error fs-6">
                        </div>
                    </div>
                    <div class="table-content table-responsive table-bordered bg-white rounded mb-4">
                        <table class="table">
                            <tr class="bg-eq-primary">
                                <th colspan="2">Addons</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="helmet-option">
                                        <label class="w-100"><input type="checkbox" style="width:20px;height:20px;margin-left:5px;vertical-align: middle;" id="free_helmet" name="free_helmet" class="me-2" <?=($cart["free_helmet"] > 0)?"checked":""?> > 1 Helmet is free per vehicle. </label>
                                    </div>
                                </td>
                                <td>
                                    <i class="fa fa-indian-rupee-sign me-1"></i><span class="d-inline-block p-1">0</span>
                                </td>
                            </tr>
                            <tr>
                               <td>
                                    <label class="w-50 text-wrap float-left"><input type="checkbox" style="width:20px;height:20px;margin-left:5px;vertical-align: middle;" id="add_helmet" name="add_helmet" class="me-2" <?=($cart["helmets_qty"] > 0)?"checked":""?> > Add extra for ₹50/day. </label>
                                    <div style="display: <?=($cart["helmets_qty"] > 0)?"inline-flex":"none"?>;float: left;" class="helmet-row cart-count bg-white justify-content-center">
                                        <span class="btn btn-sm p-2 cart-hminus bg-primary text-white rounded-0"><i class="fa fa-minus"></i></span>
                                        <input type="text" name="helmets_qty" class="cart-helmets text-center border text-black rounded-0" value="<?=isset($cart["helmets_qty"])?$cart["helmets_qty"]:0?>">
                                        <span class="btn btn-sm p-2 cart-hplus bg-primary text-white rounded-0"><i class="fa fa-plus"></i></span>
                                    </div>
                                </td>
                                <td>
                                    <i class="fa fa-indian-rupee-sign me-1"></i><span class="helmet_subtotal d-inline-block p-1"><?=isset($cart["helmets_qty"])?$cart["helmets_qty"] * 50:0?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="addons_table table-bottom d-flex flex-wrap align-items-center justify-content-between bg-white mt-4 pt-4 pt-lg-0 mt-lg-0">
                        <form method="POST" id="coupon_form" action="<?=base_url('Checkout/coupon')?>" class="d-flex align-items-center flex-wrap">
                            <input type="text" class="text-dark" name="coupon_code" placeholder="Coupon code" required value="<?=isset($cart['coupon_code'])?$cart['coupon_code']:""?>" maxlength="20">
                            <?php if( !isset($cart['coupon_code']) || $cart['coupon_code'] == "" ) {?>
                            <button type="button" class="coupon_apply btn btn-secondary btn-md">Apply Now</button>
                            <?php } else { ?>
                            <button type="button" title="Cancel Coupon" class="coupon_remove btn btn-warning btn-md">X</button>
                            <?php } ?>
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
                            <tr>
                                <th class="text-start">GST</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="order_gst d-inline-block"><?=round($subtotal * 0.05, 2)?></span></th>
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
                            <?php if( isset($cart['helmets_qty']) && $cart['helmets_qty'] != 0 && $cart['helmets_qty'] != "" ){
                                $total = $total + round($cart['helmets_qty'] * 50, 2);?>
                            <tr class="order_helemt">
                                <th class="text-start">Helmet Charges</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="helmet_order_subtotal d-inline-block"><?=round($cart['helmets_qty'] * 50, 2)?></span></th>
                            </tr>
                            <?php } else { ?>
                            <tr style="display:none;" class="order_helemt">
                                <th class="text-start">Helmet Charges</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="helmet_order_subtotal d-inline-block">0</span></th>
                            </tr>    
                            <?php } ?>
                            <?php if($cart['early_pickup'] == 1){
                                $total = $total + round($bike_quantity * 200, 2);?>
                            <tr class="order_early_pickup">
                                <th class="text-start">Early Pickup</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="early_pickup d-inline-block"><?=round($bike_quantity * 200, 2)?></span></th>
                            </tr>
                            <?php } else { ?>
                            <tr style="display:none;" class="order_early_pickup">
                                <th class="text-start">Early Pickup</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="early_pickup d-inline-block">0</span></th>
                            </tr>    
                            <?php } ?> 
                            <tr>
                                <td class="text-start fw-bold">Total</td>
                                <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="total d-inline-block"><?=$total?></span></td>
                            </tr>
                            <tr>
                                <td class="w-50 text-start text-warning fw-bold border-0">Refundable Deposit / Vehicle
                                    <span class="d-block text-gray fw-normal text-sm">To be paid at the time of pickup</span></td>
                                <td class="fw-bold text-end border-0"><i class="fa fa-indian-rupee-sign me-1"></i> <span class="refundable_deposit d-inline-block"><?=round($bike_quantity * 1000, 2)?></span>
                                    <span class="d-block text-info fw-normal text-sm">(Not paying now)</span>
                                </td>
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
                                <td class="fw-bold text-success text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="total d-inline-block"><?=$total - $order['order']['booking_amount']?></span>
                                </td>
                            </tr>
                            <?php } else {?>
                            <tr>
                                <td class="text-start text-success fw-bold">Balance</td>
                                <td class="fw-bold text-success text-end"><i class="fa fa-indian-rupee-sign me-1"></i><span class="total d-inline-block"><?=$total - $order['order']['booking_amount']?></span>
                                    <span class="d-block text-info fw-normal text-sm">Negative amount will be settled at the time of pickup.</span>
                                </td>
                            </tr>    
                            <?php } ?>
                        </table>
                        <?php } ?>
                        <div class="d-flex flex-column px-4 pb-4 pt-2">
                            <form method="POST" action="<?=base_url('Checkout')?>">
                                <?php if( $cart['early_pickup'] == 1 || $cart['pickup_time'] == '07:30 AM' ){?>
                                <div class="w-100 mb-4 border rounded bg-light">
                                    <label class="fa-md text-info py-2 px-2"><input type="checkbox" name="early_pickup_charge" value="1" <?=($cart['early_pickup']==1)?"checked":""?> > Pickup early at 6:00 AM for  200 extra / bike.</label>
                                </div>                                
                                <?php } ?>
                                <div class="row px-2 mb-4 justify-content-center">
                                    <label class="w-100 p-1 text-center fw-semibold fa-md mb-1"><input style="width:20px;height:20px;vertical-align: middle;" type="radio" name="paymentOption" value="PAY_FULL" checked> FULL PAYMENT</label>
                                    <span class="w-100 p-0 d-inline-block text-center fw-bold text-warning">OR</span>
                                    <label class="w-100 p-1 text-center fw-semibold fa-md mt-1"><input style="width:20px;height:20px;vertical-align: middle;" type="radio" name="paymentOption" value="PAY_PARTIAL" > 50% ADVANCE</label>
                                </div>
                                <div class="row px-2 mb-4 justify-content-center">
                                <?php if( !isset($user) || !isset($user['Authorization']) || ( isset($user['Authorization']) && $user['Authorization'] == false) ) { ?>
                                    <a href="javascript:void(0)" class="btn btn-primary mx-auto d-inline-block me-3" data-bs-toggle="modal" data-bs-target="#login_form">Login/Sign Up</a>
                                <?php } else { ?>  
                                <button type="submit" class="btn btn-primary btn-md d-block mt-4">Proceed to Checkout</button>
                                <?php } ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>
        <?php }else { ?>
            <div class="row">
                <div class="col-6 mx-auto text-center">
                    <img src="<?=base_url('assets/images/empty-cart.png')?>" class="w-50 img-fluid d-block mx-auto">
                    <h4 class="h4 text-center text-danger">Your Cart is empty.</h4>
                    <a class="btn btn-primary" href="<?=base_url('Bookaride')?>">Book a Ride</a>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<!--shopping cart end-->
<script type="text/javascript">

$(document).ready(function(){

    var bike_ids = '<?=isset($cart['bike_ids'])?$cart['bike_ids']:""?>';
    localStorage.setItem("bike_ids", bike_ids);
    var bike_ids = JSON.parse(bike_ids);
    localStorage.setItem("bikesincart", bike_ids.length);

    function cartdelete(bikeId) 
    {
        $(".cartbikes").find('[data-id="'+bikeId+'"]').remove();
        $("#cartform").submit();    
    }

    $("input[name='add_helmet']").on("change", function () {
        if ($(this).is(":checked")) {
          $(".cart-helmets").val(1);  
          $("#cartform input[name='helmets_qty']").val(1);
        } else {
          $(".cart-helmets").val(0);
          $("#cartform input[name='helmets_qty']").val(0);
        }
        var temp = localStorage.getItem("bike_ids");
        var bike_ids = JSON.parse(temp);
        var v = $(".cart-helmets").val();
        $("#cartform input[name='helmets_qty']").val(v);
        $("#cartform input[name='bike_ids']").val(JSON.stringify(bike_ids));
        $("#cartform").submit();
    });

    $("input[name='free_helmet']").on("change", function () {
        if ($(this).is(":checked")) {
          $("#cartform input[name='free_helmet']").val(1);
        } else {
          $("#cartform input[name='free_helmet']").val(0);
        }
        $("#cartform").submit();
    });

    $("input[name='early_pickup_charge']").on("change", function () {
        if ($(this).is(":checked")) {
          $("#cartform input[name='early_pickup']").val(1);
        } else {
          $("#cartform input[name='early_pickup']").val(0);         
        }
        $("#cartform").submit();
    });

    $(".cart-plus").click(function()
    {
        var v = $(this).siblings(".cart-input").val();
        var v = parseInt(v);
        console.log(v);
        var available = parseInt($(this).siblings(".cart-input").attr('data-available'));
        var bike_id = $(this).siblings(".cart-input").attr('data-bike');
        var bikesincart = localStorage.getItem("bikesincart");
        var temp = localStorage.getItem("bike_ids");
        var bike_ids = JSON.parse(temp);
        console.log("v="+v);
        console.log(available);
        if( v < available ) 
        {
            v = parseInt(v) + 1;
            $(this).siblings(".cart-input").val(v);    
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
        var v = $(this).siblings(".cart-input").val();
        v = parseInt(v) - 1;
        if( v == 0 ){
            return false;
        }
        $(this).siblings(".cart-input").val(v);
        $("#cartform").submit();

    });

    $(".cart-delete").click(function(){
        var bikeId = $(this).attr("bike-id");
        cartdelete(bikeId);   
    });

    $(".cart-hminus").click(function()
    {
        var v = $(".cart-helmets").val();
        if( v == 0 ){
            return false;
        }
        v = parseInt(v) - 1;
        $(".cart-helmets").val(v);
        $("#cartform input[name='helmets_qty']").val(v);
    
        $("#cartform").submit();
    });

    $(".cart-hplus").click(function()
    {
        var temp = localStorage.getItem("bike_ids");
        var bike_ids = JSON.parse(temp);
        var v = parseInt($(".cart-helmets").val());
        var bike_qty = 0;
        for (var prop in bike_ids) 
        {
            var p = bike_ids[prop];
            bike_qty += parseInt(p.qty);
        }
        console.log("helmets_qty"+(v + 1));
        console.log("bike_qty"+bike_qty);
        if( (v + 1) > bike_qty )
        {
            $(".addons_table").append("<div class='alert alert-danger mt-1 mb-0'>Extra helmets is limited to 1 per Vehicle.</div>");
            setTimeout(function(){
                $(".addons_table").find(".alert").each(function(){
                  $(this).remove();
                });
            }, 2000);
            return false;
        }

        v = parseInt(v) + 1;
        console.log(v);
        $(".cart-helmets").val(v);
        $("#cartform input[name='helmets_qty']").val(v);
        $("#cartform").submit();
    });

    $(".coupon_apply").click(function()
    {
        $(".coupon_apply").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Checking..");
        $(".coupon_form :input").prop("disabled", true);
        $(".coupon_apply").prop("disabled", true);
        
        $("#coupon_form").find(".alert").each(function(){
          $(this).remove();
        });

        var formdata = {
          coupon_code:$("#coupon_form input[name='coupon_code']").val()
        };

        var url = $("#coupon_form").attr('action');
        
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: formdata, // Serialize form data
            success: function (response) {
                console.log(response);
                if( response.error == 1 )
                {
                  // error occured
                  $(".coupon_form :input").prop("disabled", false);
                  $(".coupon_apply").prop("disabled", false);
                  $(".coupon_apply").html("Apply Now");
                  $("#coupon_form").append("<div class='alert alert-danger mt-1 mb-0'>"+response.error_message+"</div>");
                }
                else
                {
                    var temp = localStorage.getItem("bike_ids");
                    var bike_ids = JSON.parse(temp);
                    var coupon_code = $("#coupon_form input[name='coupon_code']").val();
                    $("coupon_apply :input").prop("disabled", false);
                    $(".coupon_apply").html("Coupon Applied");
                    $("#cartform input[name='bike_ids']").val(JSON.stringify(bike_ids));
                    $("#cartform input[name='coupon_code']").val(coupon_code.trim());
                    $("#cartform").submit();
                }
            },
            error: function (data) 
            {
                // error occured
              $(".coupon_form :input").prop("disabled", false);
              $(".coupon_apply").prop("disabled", false);
              $(".coupon_apply").html("Apply Now");
              $("#coupon_form").append("<div class='alert alert-danger mt-1 mb-0'>Error Occured.</div>");
            }
        });

    });

    $(".coupon_remove").click(function()
    {
        $(".coupon_apply").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Checking..");
        $(".coupon_form :input").prop("disabled", true);
        $(".coupon_apply").prop("disabled", true);
        
        $("#coupon_form").find(".alert").each(function(){
          $(this).remove();
        });
        $("#coupon_form input[name='coupon_code']").val("");
        var formdata = {
          coupon_code:"",
          cancel:1
        };

        var url = $("#coupon_form").attr('action');
        
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: formdata, // Serialize form data
            success: function (response) {
                console.log(response);
                if( response.error == 1 )
                {
                  // error occured
                  $(".coupon_form :input").prop("disabled", false);
                  $(".coupon_apply").prop("disabled", false);
                  $(".coupon_apply").html("Apply Now");
                  $("#coupon_form").append("<div class='alert alert-danger mt-1 mb-0'>"+response.error_message+"</div>");
                }
                else
                {
                    var temp = localStorage.getItem("bike_ids");
                    var bike_ids = JSON.parse(temp);
                    var coupon_code = $("#coupon_form input[name='coupon_code']").val();
                    $("coupon_apply :input").prop("disabled", false);
                    if( coupon_code !== "" )
                    {
                        $(".coupon_apply").html("Coupon Applied");
                        $("#cartform input[name='bike_ids']").val(JSON.stringify(bike_ids));
                        $("#cartform input[name='coupon_code']").val(coupon_code.trim());
                        $("#cartform").submit();
                    } else {
                        $(".coupon_apply").html("Coupon Removed");
                        $("#cartform input[name='bike_ids']").val(JSON.stringify(bike_ids));
                        $("#cartform input[name='coupon_code']").val(coupon_code.trim());
                        $("#cartform").submit();
                    }
                }
            },
            error: function (data) 
            {
                // error occured
              $(".coupon_form :input").prop("disabled", false);
              $(".coupon_apply").prop("disabled", false);
              $(".coupon_apply").html("Apply Now");
              $("#coupon_form").append("<div class='alert alert-danger mt-1 mb-0'>Error Occured.</div>");
            }
        });

    });

    $("#cartform").submit(function(e){
        e.preventDefault();

        //changed helmets qty
        if ($("input[name='add_helmet']").is(":checked")) 
        {
            var v = $("#cartform input[name='helmets_qty']").val();
            $(".cart-helmets").val(v);  
            $(".helmet-row").css("display", "inline-flex");
        } 
        else 
        {
            $(".cart-helmets").val(0);
            $("#cartform input[name='helmets_qty']").val(0);
            $(".helmet-row").css("display", "none");
        }
        var v = $(".cart-helmets").val();
        $("#cartform input[name='helmets_qty']").val(v);        
        $(".helmet_subtotal").html( v * 50 );
        // end

        var early_pickup_check = $(".order_early_pickup").css("display");
        var early_pickup_charge = (early_pickup_check == "none") ? 0 : 1;
        var total_bike_qty = 0;
        var subtotal = 0;
        var gst = 0;
        var total = 0;
        var helmet_total =  v * 50;
        var early_pickup_total = early_pickup_charge * 200;
        if( helmet_total != 0 )
        {
            $(".cart-sidebar .order_helemt").show()
        }
        // changed bike qty
        var bike_ids = [];
        $("tr.bike-row").each(function(e)
        {
            var bike_type_id = $(this).attr('data-id'); 
            var bike_qty = $(this).find('.cart-input').val();
            var bike_rent = $(this).find('.bike_rent').html();
            console.log(bike_type_id, bike_qty, bike_rent);
            $(this).find('.bike_subtotal').html( parseInt(bike_qty) * parseInt(bike_rent));
            total_bike_qty += parseInt(bike_qty);
            subtotal += parseInt(bike_qty) * parseInt(bike_rent);
            bike_ids.push({"bike_id":bike_type_id,"qty":bike_qty});
        });

        $("#cartform input[name='bike_ids']").val(JSON.stringify(bike_ids));
        localStorage.setItem("bike_ids", JSON.stringify(bike_ids));
        bikesincart = bike_ids.length;
        localStorage.setItem("bikesincart", bikesincart);

        var gst = (subtotal * 0.05).toFixed(2);
        subtotal = subtotal - gst;
        total = parseFloat(subtotal) + parseFloat(gst) + parseFloat(early_pickup_total) + parseFloat(helmet_total);
        $(".helmet_order_subtotal").html(v * 50); 
        $(".cart-sidebar .order_subtotal").html(subtotal);
        $(".cart-sidebar .order_gst").html(gst);
        $(".cart-sidebar .early_pickup").html(early_pickup_total);
        $(".cart-sidebar .refundable_deposit").html( total_bike_qty * 1000);
        $(".cart-sidebar .helmet_order_subtotal").html(helmet_total);
        $(".cart-sidebar .total").html(total);

        // update cart
        var url = $("#cartform").attr('action');
        var form = $("#cartform");
        $(".cart_error").html("<span class='spinner-border spinner-border-sm text-info' role='status' aria-hidden='true'></span>");
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: form.serialize(), // Serialize form data
            success: function (response) {
                console.log(response);
                if( response.error == 1 )
                {
                    $(".cart_error").html(response.error_message);
                }
                else
                {
                    $(".cart_error").html("<span class='d-inline-block text-success'><i class='fa fa-check-circle'></i></span>");

                    if(bike_ids.length == 0)
                    {
                        window.location.reload();
                    }

                }
                setTimeout(function(){

                    $(".cart_error").html("");

                }, 3000);
            },
            error:function(response){
                $(".cart_error").html("Error Occured");
            }
        });

        return false;
    });

});

</script>