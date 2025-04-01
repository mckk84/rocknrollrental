<!--breadcrumb section start-->
<section class="breadcrumb-section position-relative overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/texture-bg.png">
    <img src="<?=base_url()?>/assets/img/shapes/tire-print-left.png" alt="tire print" class="position-absolute start-0 z-1 tire-print">
    <img src="<?=base_url()?>/assets/img/shapes/tire-print-right.png" alt="tire print" class="position-absolute end-0 z-1 tire-print">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 mx-auto">
                <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                    <h1 class="text-white">Edit Booking</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!--breadcrumb section end-->

<!--shopping cart-->
<section class="shopping-cart ptb-60">
    <div class="container">
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
                            <a href="javascript:void(0)" class="addmorebikes btn btn-secondary">Add More Bikes</a>
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
                                        <label class="w-100"><input type="checkbox" style="width:20px;height:20px;margin-left:5px;vertical-align: middle;" id="free_helmet" name="free_helmet" class="me-2" <?=($cart["free_helmet"] > 0)?"checked":""?> > 1 Helmet is free.  </label>
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
                        <form method="POST" id="coupon_form" action="<?=base_url('Account/coupon')?>" class="d-flex align-items-center flex-wrap">
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
                                <div class="row mb-4 justify-content-center">
                                    <table class="table rounded">
                                        <tr><th class="text-start">Payment Mode</th><td class="text-end">
                                        <?php if( $cart['payment_mode'] == 3 ){?>
                                        <label class="w-100 p-0 fa-md mb-1">FULL PAYMENT</label>
                                        <?php } ?>
                                        <?php if( $cart['payment_mode'] == 2 ){?>
                                        <label class="w-100 p-0 fa-md mt-1">50% ADVANCE</label>
                                        <?php } ?>
                                        </td></tr>
                                        <tr><th class="text-start">Paid</th><td class="text-success fw-bold text-end">
                                        <?php echo $cart['booking_amount'] ?>
                                        </td></tr>
                                    </table>
                                </div>
                                <div class="row px-2 mb-4 justify-content-center">
                                    <button type="submit" class="w-50 btn btn-primary btn-md d-block mt-4">Update</button>
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
                            { 
                                foreach($cart['cart_bikes'] as $index => $bike) 
                                {
                                    $rent_price = $bike['rent_price'];
                                    $subtotal += round($rent_price * $bike['quantity'], 2);
                                    $bike_quantity += $bike['quantity'];
                                    $sl = $index + 1;
                                ?>
                                <table class="mt-1 table cartbikes">
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
                                        <i class="fa fa-indian-rupee-sign me-1"></i><span class="d-inline-block bike_rent"><?=$rent_price?></span>
                                        &nbsp;
                                        <label class="fw-semibold" style="width:auto; padding:5px 5px;display: inline-block;">=</label>
                                        &nbsp;
                                        <i class="fa fa-indian-rupee-sign me-1"></i><span class="bike_subtotal fw-semibold fa-md d-inline-block p-1"><b><?=round($rent_price * $bike['quantity'], 2)?></b></span>
                                    </td>
                                </tr>
                                </table>
                                <?php } 
                                $total = $subtotal;
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
                            <a href="javascript:void(0)" class="addmorebikes btn btn-secondary">Add More Bikes</a>
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
                                        <label class="w-100"><input type="checkbox" style="width:20px;height:20px;margin-left:5px;vertical-align: middle;" id="free_helmet" name="free_helmet" class="me-2" <?=($cart["free_helmet"] > 0)?"checked":""?> > 1 Helmet is free.  </label>
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
                        <div class="d-flex flex-column px-4 pb-4 pt-2">
                            <form method="POST" action="<?=base_url('Checkout')?>">
                                <?php if( $cart['early_pickup'] == 1 || $cart['pickup_time'] == '07:30 AM' ){?>
                                <div class="w-100 mb-4 border rounded bg-light">
                                    <label class="fa-md text-info py-2 px-2"><input type="checkbox" name="early_pickup_charge" value="1" <?=($cart['early_pickup']==1)?"checked":""?> > Pickup early at 6:00 AM for  200 extra / bike.</label>
                                </div>                                
                                <?php } ?>
                                <div class="row mb-4 justify-content-center">
                                    <table class="table rounded">
                                        <tr><th class="text-start">Payment Mode</th><td class="text-end">
                                        <?php if( $cart['payment_mode'] == 3 ){?>
                                        <label class="w-100 p-0 fa-md mb-1">FULL PAYMENT</label>
                                        <?php } ?>
                                        <?php if( $cart['payment_mode'] == 2 ){?>
                                        <label class="w-100 p-0 fa-md mt-1">50% ADVANCE</label>
                                        <?php } ?>
                                        </td></tr>
                                        <tr><th class="text-start">Paid</th><td class="text-success fw-bold text-end">
                                        <?php echo $cart['booking_amount'] ?>
                                        </td></tr>
                                    </table>
                                </div>
                                <div class="row px-2 mb-4 justify-content-center">
                                    <button type="submit" class="w-50 btn btn-primary btn-md d-block mt-4">Update</button>
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


<div class="modal fade" id="add-more-bikes">
    <div class="modal-dialog modal-xl">
        <div class="modal-content product_modal px-2 py-2">
            <div class="at_product_view">
                <div class="card w-100 bg-white border-0">
                    <div class="card-body p-1">
                        <div class="text-center border-bottom-primary">
                            <span class="d-block card-title fw-bold mb-1 fs-5">Search Bikes</span>
                        </div>
                        <div id="search_bikes" class="mt-1 mb-2 text-center">
                            <div class="col-xl-12 border-bottom-primary">
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 justify-content-center">
                                        <label class="d-inline-block p-2 fw-bold align-middle">PICKUP DATE</label>
                                        <input type="date" name="pickup_date" value="" id="pickup_date" class="text-dark border mt-1 rounded mb-2" placeholder="">
                                        <select id="pickup_time" name="pick_uptime" class="w-25 py-2 px-2 mt-1 border rounded">
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-sm-12  justify-content-center">
                                        <label class="d-inline-block p-2 fw-bold align-middle">DROPOFF DATE</label>
                                        <input type="date" name="dropoff_date" id="dropoff_date" value="" class="text-dark border mt-1 rounded mb-2" placeholder="">
                                        <select id="dropoff_time" name="dropoff_time" class="w-25 py-2 px-2 mt-1 border rounded">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="bike-inventory col-xl-12">
                                <div id="available_bikes" class="row g-2" style="max-height: 480px; overflow: auto;">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--shopping cart end-->
<script type="text/javascript">

$(document).ready(function(){

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
        //console.log("start="+start);
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
            //console.log("start="+start);
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


    function addtoCart(bike_id, qty)
    {
        var url = '<?=base_url('Account/addtoCart')?>';
        var formdata = {
            bike_ids:bike_id,
            qty:qty
        };
        $("#available_bikes a[bike-id='"+bike_id+"']").html("<span class='spinner-border spinner-border-sm text-info' role='status' aria-hidden='true'></span>");
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: formdata, // Serialize form data
            success: function (response) {
                console.log(response);
                if( response.error == 1 )
                {
                    $("#available_bikes a[bike-id='"+bike_id+"']").html("Error Occured");
                }
                else
                {
                    $("#available_bikes a[bike-id='"+bike_id+"']").html("Success");
                    $("#add-more-bikes").modal('hide');
                    window.location.reload();
                }
            },
            error:function(response){
                $("#available_bikes a[bike-id='"+bike_id+"']").html("Error Occured");
            }
        });
    }

    function updateHelmets(helmet_qty) 
    {
        var url = '<?=base_url('Account/updateCart')?>';
        var formdata = {
            helmet_qty:helmet_qty
        };
        $(".cart_error").html("<span class='spinner-border spinner-border-sm text-info' role='status' aria-hidden='true'></span>");
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: formdata, // Serialize form data
            success: function (response) {
                console.log(response);
                if( response.error == 1 )
                {
                    $(".cart_error").html("Error Occured");
                }
                else
                {
                    $(".cart_error").html("Success");
                    window.location.reload();
                }
            },
            error:function(response){
                $(".cart_error").html("Error Occured");
            }
        });    
    }

    function removefromCart(bike_id, qty)
    {
        var url = '<?=base_url('Account/deletefromCart')?>';
        var formdata = {
            bike_ids:bike_id,
            qty:qty
        };
        $(".cart_error").html("<span class='spinner-border spinner-border-sm text-info' role='status' aria-hidden='true'></span>");
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: formdata, // Serialize form data
            success: function (response) {
                console.log(response);
                if( response.error == 1 )
                {
                    $(".cart_error").html("Error Occured");
                }
                else
                {
                    $(".cart_error").html("Success");
                    $("#add-more-bikes").modal('hide');
                    window.location.reload();
                }
            },
            error:function(response){
                $(".cart_error").html("Error Occured");
            }
        });
    }

    var bike_ids = '<?=isset($cart['bike_ids'])?$cart['bike_ids']:""?>';
    localStorage.setItem("bike_ids", bike_ids);
    var bike_ids = JSON.parse(bike_ids);
    localStorage.setItem("bikesincart", bike_ids.length);
    let bike_url = '<?php echo base_url('/bikes/')?>';

    function checkbikesubmitform()
    {

        var formdata = {
          pickup_date:$("#search_bikes input[name='pickup_date']").val(),
          pickup_time:$("#search_bikes #pickup_time").val(),
          dropoff_date:$("#search_bikes input[name='dropoff_date']").val(),
          dropoff_time:$("#search_bikes #dropoff_time").val(),
        };

        $("#available_bikes").html("<span class='d-inline-block p-2 px-4 text-info'>Searching...</span>");

        $.ajax({
            type: "POST",
            url: '<?=base_url('/Cart/search')?>',
            dataType: "json",
            data: formdata, // Serialize form data
            success: function (response) {
                console.log(response);
                if( response.error == 1 )
                {
                    $("#available_bikes").html("<div class='alert alert-danger mt-1 mb-0'>"+response.error_message+"</div>");
                }
                else
                {
                    var len = response.data.available_bikes.length;
                    var bikes = response.data.available_bikes;
                    if( len > 0 )
                    {
                        var html = "";
                        for (var i = 0; i < bikes.length; i++) 
                        {
                            var row = bikes[i];
                            html += "<div class='col-xl-4 col-lg-4 col-md-4'>";
                            html += "<div class='md-listing-single shadow bg-white position-relative'>";
                            html += "<figure style='border-bottom: 1px solid #FFDD06;' class='overflow-hidden rounded-top mb-0'>";
                            html += "<img src='"+bike_url+row.image+"' alt='"+row.bike_type_name+"' style='width:100%;height:100%;max-height:167px;' class='img-fluid m-2'>";
                            html += "</figure>";
                            html += "<div class='md-listing-single-content'><a href='javascript:void(0)'><h6 class='mb-1'>"+row.bike_type_name+"</h6></a>";    
                            html += "<ul class='meta-list d-flex justify-content-between mt-2 pt-2'><li class='m-0'><svg width='23' height='16' viewBox='0 0 23 16' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M21.4886 4.85227H19.4091C19.0258 4.85227 18.7159 5.16282 18.7159 5.54545V6.23864H18.0227V5.54545C18.0227 5.16282 17.7129 4.85227 17.3295 4.85227H16.2302L14.3544 2.97652C14.2906 2.91206 14.2137 2.86145 14.1284 2.8261C14.0439 2.79144 13.9537 2.77273 13.8636 2.77273H11.7841V1.38636H13.1705C13.5538 1.38636 13.8636 1.07582 13.8636 0.693182C13.8636 0.310545 13.5538 0 13.1705 0H6.93182C6.54849 0 6.23864 0.310545 6.23864 0.693182C6.23864 1.07582 6.54849 1.38636 6.93182 1.38636H8.31818V2.77273H6.23864C6.21645 2.77273 6.19774 2.78312 6.17625 2.7852C6.12634 2.79006 6.0799 2.79907 6.03276 2.81432C5.99186 2.82749 5.95443 2.84205 5.917 2.86215C5.87818 2.88294 5.84283 2.9072 5.80748 2.93562C5.77074 2.96612 5.73885 2.99801 5.70905 3.03475C5.69449 3.05208 5.67508 3.06248 5.66191 3.08189L4.48142 4.85227H2.77273C2.3894 4.85227 2.07955 5.16282 2.07955 5.54545V7.625H1.38636V5.54545C1.38636 5.16282 1.07651 4.85227 0.693182 4.85227C0.309852 4.85227 0 5.16282 0 5.54545V11.7841C0 12.1667 0.309852 12.4773 0.693182 12.4773C1.07651 12.4773 1.38636 12.1667 1.38636 11.7841V9.01136H2.07955V11.7841C2.07955 12.1667 2.3894 12.4773 2.77273 12.4773H4.42389L5.61893 14.8667C5.65151 14.9318 5.69449 14.9887 5.74301 15.0386C5.75272 15.049 5.76519 15.0559 5.77559 15.0649C5.82481 15.11 5.87957 15.146 5.93918 15.1751C5.95928 15.1848 5.97939 15.1939 6.00087 15.2015C6.07643 15.2299 6.15545 15.2493 6.23725 15.25C6.23794 15.25 6.23794 15.25 6.23864 15.25H14.5568C14.658 15.25 14.753 15.2257 14.8396 15.1869C14.8625 15.1765 14.8798 15.1578 14.9013 15.1453C14.9644 15.1079 15.0226 15.0663 15.0712 15.0115C15.0788 15.0025 15.0906 14.9998 15.0982 14.9901L17.663 11.7841H18.7159V12.4773C18.7159 12.8599 19.0258 13.1705 19.4091 13.1705H21.4886C21.872 13.1705 22.1818 12.8599 22.1818 12.4773V5.54545C22.1818 5.16282 21.872 4.85227 21.4886 4.85227ZM20.7955 11.7841H20.1023V11.0909C20.1023 10.7083 19.7924 10.3977 19.4091 10.3977H17.3295C17.3164 10.3977 17.3053 10.4047 17.2921 10.4054C17.245 10.4081 17.2006 10.4206 17.1549 10.4331C17.1119 10.4449 17.0696 10.4532 17.0301 10.4719C16.994 10.4892 16.9635 10.5156 16.9303 10.5391C16.8901 10.5683 16.8506 10.596 16.8173 10.6334C16.8083 10.6431 16.7965 10.6473 16.7882 10.6577L14.2234 13.8636H6.66702L5.47198 11.4742C5.45673 11.4437 5.43039 11.4236 5.41098 11.3959C5.38186 11.3543 5.35622 11.3127 5.31878 11.2781C5.28551 11.2476 5.24739 11.2275 5.20926 11.2046C5.17183 11.181 5.13717 11.1561 5.09489 11.1401C5.04706 11.1221 4.99645 11.1173 4.94516 11.1096C4.91397 11.1055 4.88555 11.0909 4.85227 11.0909H3.46591V6.23864H4.85227H4.85297C4.93545 6.23864 5.01586 6.21923 5.09281 6.19011C5.10806 6.18457 5.12331 6.17972 5.13856 6.17278C5.20857 6.1409 5.27303 6.09861 5.32987 6.04385C5.34097 6.03345 5.34928 6.02098 5.35968 6.00989C5.38325 5.98424 5.4089 5.95998 5.42831 5.93017L6.60949 4.15909H9.01136C9.39469 4.15909 9.70455 3.84855 9.70455 3.46591V1.38636H10.3977V3.46591C10.3977 3.84855 10.7076 4.15909 11.0909 4.15909H13.5767L15.4524 6.03484C15.5162 6.09931 15.5931 6.14991 15.6784 6.18526C15.763 6.21992 15.8531 6.23864 15.9432 6.23864H16.6364V6.93182C16.6364 7.31445 16.9462 7.625 17.3295 7.625H19.4091C19.7924 7.625 20.1023 7.31445 20.1023 6.93182V6.23864H20.7955V11.7841Z' fill='#99CF8F'></path><path d='M13.5585 6.35746C13.2403 6.14257 12.8105 6.22645 12.5956 6.54323L9.72588 10.7848L8.04768 9.48995C7.74338 9.25565 7.30944 9.3125 7.07584 9.61542C6.84224 9.91834 6.89839 10.3537 7.20131 10.5873L9.46385 12.3327C9.58585 12.4277 9.73489 12.4776 9.88739 12.4776C9.92413 12.4776 9.96017 12.4748 9.9976 12.4686C10.1861 12.4381 10.3546 12.3313 10.4613 12.1726L13.7442 7.32029C13.9591 7.00281 13.8753 6.57235 13.5585 6.35746Z' fill='#99CF8F'></path></svg>";
                            html += "<span class='d-inline-block fa-sm font-bold text-black m-1'>"+row.cc+"</span></li>";

                            html += "<li class='m-0'><svg width='21' height='17' viewBox='0 0 21 17' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M12.4372 15.1074H8.49606C8.15738 15.1074 7.88281 15.382 7.88281 15.7207C7.88281 16.0593 8.15738 16.3339 8.49606 16.3339H12.4372C12.7758 16.3339 13.0504 16.0593 13.0504 15.7207C13.0504 15.382 12.7758 15.1074 12.4372 15.1074Z' fill='#99CF8F'></path><path d='M12.1901 11.3227C12.3188 11.0643 12.3917 10.7731 12.3917 10.4648C12.3917 9.40095 11.5292 8.53848 10.4653 8.53848C10.1569 8.53848 9.8657 8.61133 9.60728 8.74016L6.71874 5.85149C6.47929 5.612 6.09099 5.612 5.85149 5.85149C5.612 6.09094 5.612 6.47921 5.85149 6.71874L8.74024 9.60761C8.61166 9.86583 8.53897 10.1568 8.53897 10.4648C8.53897 11.5287 9.40144 12.3912 10.4653 12.3912C10.7735 12.3912 11.0645 12.3185 11.3227 12.1899L12.0022 12.8694C12.2417 13.1089 12.63 13.109 12.8695 12.8695C13.109 12.6301 13.109 12.2418 12.8695 12.0023L12.1901 11.3227ZM10.4653 11.1647C10.0794 11.1647 9.76542 10.8508 9.76542 10.4649C9.76542 10.079 10.0794 9.76501 10.4653 9.76501C10.8512 9.76501 11.1652 10.079 11.1652 10.4649C11.1652 10.8508 10.8512 11.1647 10.4653 11.1647Z' fill='#99CF8F'></path><path d='M10.466 0C4.69503 0 0 4.69503 0 10.466C0 12.3053 0.484953 14.1151 1.40249 15.6997C1.57199 15.9924 1.94656 16.0926 2.23952 15.9236C2.23965 15.9235 3.94642 14.9382 3.94642 14.9382C4.23972 14.7689 4.34021 14.3939 4.17087 14.1005C4.00153 13.8073 3.62656 13.7066 3.33318 13.8761L2.17489 14.5448C1.64284 13.4647 1.32784 12.2854 1.24766 11.0793H2.5838C2.92247 11.0793 3.19704 10.8047 3.19704 10.4661C3.19704 10.1274 2.92247 9.85282 2.5838 9.85282H1.24734C1.32878 8.61627 1.65441 7.44551 2.17665 6.38828L3.33322 7.05602C3.6266 7.22548 4.00166 7.12486 4.17091 6.83157C4.34025 6.53824 4.23976 6.16318 3.94647 5.99388L2.79132 5.32692C3.46364 4.32619 4.32623 3.4636 5.32696 2.79128L5.99384 3.9463C6.16318 4.23964 6.53824 4.34021 6.83153 4.17075C7.12482 4.00137 7.22531 3.62635 7.05598 3.33306L6.38828 2.1766C7.44551 1.65441 8.61631 1.32898 9.85278 1.24742V2.58384C9.85278 2.92251 10.1273 3.19708 10.466 3.19708C10.8047 3.19708 11.0793 2.92251 11.0793 2.58384V1.24742C12.3157 1.32898 13.4865 1.65445 14.5438 2.1766L13.8761 3.33306C13.7067 3.62635 13.8072 4.00141 14.1005 4.17075C14.3938 4.34021 14.7689 4.23964 14.9382 3.9463L15.6051 2.79128C16.6058 3.46356 17.4684 4.32615 18.1407 5.32692L16.9856 5.9938C16.6923 6.16314 16.5918 6.53815 16.7612 6.83149C16.9305 7.12478 17.3055 7.2254 17.5989 7.05594L18.7554 6.3882C19.2776 7.44543 19.6033 8.61619 19.6847 9.85273H18.3482C18.0096 9.85273 17.735 10.1273 17.735 10.466C17.735 10.8047 18.0096 11.0792 18.3482 11.0792H19.6844C19.6042 12.2853 19.2892 13.4646 18.7571 14.5447L17.5989 13.876C17.3055 13.7066 16.9305 13.8072 16.7612 14.1005C16.5918 14.3938 16.6923 14.7689 16.9856 14.9382C16.9856 14.9382 18.6924 15.9234 18.6925 15.9235C18.9855 16.0925 19.3601 15.9924 19.5296 15.6996C20.4471 14.1151 20.932 12.3054 20.932 10.466C20.932 4.69503 16.237 0 10.466 0Z' fill='#99CF8F'></path></svg>";
                            html += "<span class='d-inline-block fa-sm font-bold text-black m-1'>"+row.milage+"</span></li>";
                            html += "<li class='m-0'><svg width='19' height='17' viewBox='0 0 19 17' fill='none' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' clip-rule='evenodd' d='M16.1337 0.00012207C17.4399 0.00012207 18.5 1.06021 18.5 2.3664C18.5 3.67259 17.4399 4.73268 16.1337 4.73268C14.8275 4.73268 13.7674 3.67259 13.7674 2.3664C13.7674 1.06021 14.8275 0.00012207 16.1337 0.00012207ZM16.1337 1.29082C15.54 1.29082 15.0581 1.77268 15.0581 2.3664C15.0581 2.96012 15.54 3.44198 16.1337 3.44198C16.7274 3.44198 17.2093 2.96012 17.2093 2.3664C17.2093 1.77268 16.7274 1.29082 16.1337 1.29082Z' fill='#99CF8F'></path><path fill-rule='evenodd' clip-rule='evenodd' d='M16.1337 12.047C17.4399 12.047 18.5 13.1071 18.5 14.4133C18.5 15.7195 17.4399 16.7796 16.1337 16.7796C14.8275 16.7796 13.7674 15.7195 13.7674 14.4133C13.7674 13.1071 14.8275 12.047 16.1337 12.047ZM16.1337 13.3377C15.54 13.3377 15.0581 13.8196 15.0581 14.4133C15.0581 15.007 15.54 15.4889 16.1337 15.4889C16.7274 15.4889 17.2093 15.007 17.2093 14.4133C17.2093 13.8196 16.7274 13.3377 16.1337 13.3377Z' fill='#99CF8F'></path><path fill-rule='evenodd' clip-rule='evenodd' d='M9.25091 0.00012207C10.5571 0.00012207 11.6172 1.06021 11.6172 2.3664C11.6172 3.67259 10.5571 4.73268 9.25091 4.73268C7.94472 4.73268 6.88463 3.67259 6.88463 2.3664C6.88463 1.06021 7.94472 0.00012207 9.25091 0.00012207ZM9.25091 1.29082C8.65719 1.29082 8.17533 1.77268 8.17533 2.3664C8.17533 2.96012 8.65719 3.44198 9.25091 3.44198C9.84463 3.44198 10.3265 2.96012 10.3265 2.3664C10.3265 1.77268 9.84463 1.29082 9.25091 1.29082Z' fill='#99CF8F'></path><path fill-rule='evenodd' clip-rule='evenodd' d='M9.25091 12.047C10.5571 12.047 11.6172 13.1071 11.6172 14.4133C11.6172 15.7195 10.5571 16.7796 9.25091 16.7796C7.94472 16.7796 6.88463 15.7195 6.88463 14.4133C6.88463 13.1071 7.94472 12.047 9.25091 12.047ZM9.25091 13.3377C8.65719 13.3377 8.17533 13.8196 8.17533 14.4133C8.17533 15.007 8.65719 15.4889 9.25091 15.4889C9.84463 15.4889 10.3265 15.007 10.3265 14.4133C10.3265 13.8196 9.84463 13.3377 9.25091 13.3377Z' fill='#99CF8F'></path><path fill-rule='evenodd' clip-rule='evenodd' d='M2.36614 0.000244141C3.67233 0.000244141 4.73242 1.06034 4.73242 2.36652C4.73242 3.67271 3.67233 4.7328 2.36614 4.7328C1.05996 4.7328 -0.000135422 3.67271 -0.000135422 2.36652C-0.000135422 1.06034 1.05996 0.000244141 2.36614 0.000244141ZM2.36614 1.29094C1.77242 1.29094 1.29056 1.7728 1.29056 2.36652C1.29056 2.96024 1.77242 3.4421 2.36614 3.4421C2.95986 3.4421 3.44172 2.96024 3.44172 2.36652C3.44172 1.7728 2.95986 1.29094 2.36614 1.29094Z' fill='#99CF8F'></path><path fill-rule='evenodd' clip-rule='evenodd' d='M2.36614 12.047C3.67233 12.047 4.73242 13.1071 4.73242 14.4133C4.73242 15.7195 3.67233 16.7796 2.36614 16.7796C1.05996 16.7796 -0.000135422 15.7195 -0.000135422 14.4133C-0.000135422 13.1071 1.05996 12.047 2.36614 12.047ZM2.36614 13.3377C1.77242 13.3377 1.29056 13.8196 1.29056 14.4133C1.29056 15.007 1.77242 15.4889 2.36614 15.4889C2.95986 15.4889 3.44172 15.007 3.44172 14.4133C3.44172 13.8196 2.95986 13.3377 2.36614 13.3377Z' fill='#99CF8F'></path><path fill-rule='evenodd' clip-rule='evenodd' d='M16.7793 4.08785V12.6925C16.7793 13.0487 16.4902 13.3379 16.1339 13.3379C15.7777 13.3379 15.4886 13.0487 15.4886 12.6925V4.08785C15.4886 3.73162 15.7777 3.4425 16.1339 3.4425C16.4902 3.4425 16.7793 3.73162 16.7793 4.08785Z' fill='#99CF8F'></path><path fill-rule='evenodd' clip-rule='evenodd' d='M9.89453 4.08785V12.6925C9.89453 13.0487 9.60542 13.3379 9.24918 13.3379C8.89295 13.3379 8.60383 13.0487 8.60383 12.6925V4.08785C8.60383 3.73162 8.89295 3.4425 9.24918 3.4425C9.60542 3.4425 9.89453 3.73162 9.89453 4.08785Z' fill='#99CF8F'></path><path fill-rule='evenodd' clip-rule='evenodd' d='M3.01186 4.08785V7.52971C3.01186 7.64846 3.10823 7.74483 3.22697 7.74483H16.1339C16.4902 7.74483 16.7793 8.03395 16.7793 8.39018C16.7793 8.74641 16.4902 9.03553 16.1339 9.03553H3.22697C2.3949 9.03553 1.72116 8.36092 1.72116 7.52971C1.72116 6.2743 1.72116 4.08785 1.72116 4.08785C1.72116 3.73162 2.01028 3.4425 2.36651 3.4425C2.72274 3.4425 3.01186 3.73162 3.01186 4.08785Z' fill='#99CF8F'></path></svg>";

                            html += "<span class='d-inline-block fa-sm font-bold text-black m-1'>"+row.power+"</span></li>";

                            html += "</ul><div class='pricing-bottom d-flex align-items-center justify-content-between mt-4'><h5 class='mb-0'><i class='fa fa-indian-rupee-sign me-1'></i>"+row.rent_price+"</h5>";
                            if( row.hasOwnProperty('not_available') && row.not_available == row.bikes_available) { 
                                html += "<a href='javascript:void(0)' title='"+row.bike_type_name+"'>Sold Out</a>";
                            }else{
                                html += "<a href='javascript:void(0)' class='booknow btn md-primary-btn p-1 px-2' bike-name='"+row.bike_type_name+"' bike-id='"+row.bike_type_id+"' title='Book Now'>BOOK NOW</a>";
                            }
                            html += "</div></div></div></div>";
                            $("#available_bikes").html(html);
                        }

                        $(".booknow").click(function(){
                            addtoCart( $(this).attr('bike-id') );
                        });
                    }                    
                }
            },
            error: function (data) {
                $("#available_bikes").html("<div class='alert alert-danger mt-1 mb-0'>"+response.error_message+"</div>");
            }
        });
    }

    $(".addmorebikes").click(function(){

        $("#add-more-bikes").modal('show');

        function dateformatstring(this_date)
        {
            var dt = this_date.split('-');
            return dt[2]+"-"+dt[1]+"-"+dt[0];
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

        var pickup_date =  $("#cartform input[name='pickup_date']").val();
        var pickup_time =  $("#cartform input[name='pickup_time']").val();
        var dropoff_date =  $("#cartform input[name='dropoff_date']").val();
        var dropoff_time =  $("#cartform input[name='dropoff_time']").val();

        var today = new Date();
        var today_date = getdateformat(today);
        var hour = today.getHours();
        console.log("="+today_date);
        console.log("="+pickup_date);
        console.log("pickup_date="+pickup_date);
        console.log("dropoff_date="+dropoff_date);
        console.log(hour);
        hour = hour + 1;

        var now = moment(today_date); //todays date
        var end = moment(pickup_date); // another date
        var duration = moment.duration(now.diff(end));
        var days = duration.asDays();
        var hours = duration.asHours();

        console.log(days, hours);

        $("#search_bikes #pickup_time").empty();
        $("#search_bikes #dropoff_time").empty();
        if( days == 0 )
        {
            //cureent days
            if( hour >= 20 )
            {
                var date = new Date();
                date.setDate(date.getDate() + 1);
                today_date = getdateformat(date);
                console.log("Nextday="+today_date);
                // Settime
                setTimeAll($("#search_bikes #pickup_time"));
                $("#search_bikes #pickup_time option:first").attr('selected','selected');
                
                setTimeAll($("#search_bikes #dropoff_time"));
                $("#search_bikes #dropoff_time option:last").attr('selected','selected');
            }
            else if( hour <= 7 )
            {
                setTimeAll($("#search_bikes #pickup_time"));
                $("#search_bikes #pickup_time option:first").attr('selected','selected');

                setTimeAll($("#search_bikes #dropoff_time"));
                $("#search_bikes #dropoff_time option:last").attr('selected','selected');
            }
            else
            {
                setTimeAll($("#search_bikes #pickup_time"));
                $("#search_bikes #pickup_time option:first").attr('selected','selected');
                
                setTimeAll($("#search_bikes #dropoff_time"));
                $("#search_bikes #dropoff_time option:last").attr('selected','selected');
            }
        }
        else
        {
            setTimeAll($("#search_bikes #pickup_time"));
            $("#search_bikes #pickup_time option:first").attr('selected','selected');

            setTimeAll($("#search_bikes #dropoff_time"));
            $("#search_bikes #dropoff_time option:last").attr('selected','selected');
        }

        var pdefault = pickup_time;
        if( pdefault != "" ){
            $("#search_bikes #pickup_time").val(pdefault);
        }

        var ddefault = dropoff_time;
        if( ddefault != "" ){
            $("#search_bikes #dropoff_time").val(ddefault);
        }

        console.log(pickup_date);
        console.log(dropoff_date);
        $("#search_bikes #pickup_date").val(pickup_date);
        $("#search_bikes #dropoff_date").val(dropoff_date);
        
        $("#search_bikes #pickup_time").change(function(){
            console.log("pickup_time="+$(this).val());
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
                $("#search_bikes #dropoff_date").datetimepicker('minDate', moment(pickupdate));
                hour = 7;
              }
            }
            else
            {
                //
            }
            $("#search_bikes #dropoff_time").empty();
            setTimeSpecial($("#search_bikes #dropoff_time"), hour);
            checkbikesubmitform();
        });

        $("#search_bikes #pickup_date").change(function(e){
            console.log('Pickup date');
            pickupdate = $(this).val();
            /*var temp = pickupdate.split('-');
            pickupdate = temp[2]+"-"+temp[1]+"-"+temp[0];*/
            $("#search_bikes #dropoff_date").val(pickupdate);
            var pd = $("#search_bikes #pickup_date").val();
            const date1 = moment(today_date);
            const date2 = moment(pd);

            const duration = moment.duration(date2 - date1);
            const res = duration.as('hours');
            console.log('pickupdate-today='+res+"hours");
            if( res >= 24 )
            {
                $("#search_bikes #pickup_time").empty();
                setTimeAll($("#search_bikes #pickup_time"));
                $("#search_bikes #pickup_time option:first").attr('selected','selected');
                

                $("#search_bikes #dropoff_time").empty();
                setTimeAll($("#search_bikes #dropoff_time"));
                $("#search_bikes #dropoff_time option:last").attr('selected','selected');
            }
            else
            {
                $("#search_bikes #pickup_time").empty();
                setTimeSpecial($("#search_bikes #pickup_time"), hour);
            }
            checkbikesubmitform();
        });

        $("#search_bikes #dropoff_date").change(function(e) {
            console.log('Dropoff date');

            var pd = $("#search_bikes #pickup_date").val();
            var dp = $(this).val();
            console.log(pd+":"+dp);
            const date1 = moment(pd);
            const date2 = moment(dp);

            const duration = moment.duration(date2 - date1);
            const res = duration.as('hours');
            console.log('pickupdate-drop='+res+"hours");
            if( res >= 24 )
            {
                $("#search_bikes #dropoff_time").empty();
                setTimeAll($("#search_bikes #dropoff_time"));
            }
            else
            {
                $("#search_bikes #dropoff_time").empty();
                setTimeSpecial($("#search_bikes #dropoff_time"), hour);
            }
            checkbikesubmitform();
        });

        $("#search_bikes #dropoff_time").change(function(e) {
            console.log('Dropoff time:changed');
            checkbikesubmitform();
        });


        checkbikesubmitform();
    });

   /* function cartdelete(bikeId) 
    {
        $(".cartbikes").find('[data-id="'+bikeId+'"]').remove();
        var qty = $(".cartbikes .cart-input").val();
        removefromCart(bikeId, qty);
    }*/

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
            addtoCart(bike_id, 1);
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
        var bike_id = $(this).siblings(".cart-input").attr('data-bike');
        removefromCart(bike_id, 1);
    });

    $(".cart-delete").click(function()
    {
        var bikeId = $(this).attr("bike-id");
        var eletr = $(".cartbikes").find('[data-id="'+bikeId+'"]').eq(0);
        var qty = eletr.find('.cart-input').val();
        removefromCart(bikeId, qty);   
        $(".cartbikes").find('[data-id="'+bikeId+'"]').remove();
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
        updateHelmets(v);
    });

    $(".cart-hplus").click(function()
    {
        var temp = localStorage.getItem("bike_ids");
        var bike_ids = JSON.parse(temp);
        var v = $(".cart-helmets").val();
        var bike_qty = 0;
        for (var prop in bike_ids) 
        {
            var p = bike_ids[prop];
            bike_qty += parseInt(p.qty);
        }
        if( bike_qty == 1 && v >= bike_qty )
        {
            $(".addons_table").append("<div class='alert alert-danger mt-1 mb-0'>Extra helmet is limited to 1/bike.</div>");
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
        updateHelmets(v);
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