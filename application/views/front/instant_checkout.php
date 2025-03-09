<!--breadcrumb section start-->
<section class="breadcrumb-section position-relative overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/texture-bg.png">
    <img src="<?=base_url()?>/assets/img/shapes/tire-print-left.png" alt="tire print" class="position-absolute start-0 z-1 tire-print">
    <img src="<?=base_url()?>/assets/img/shapes/tire-print-right.png" alt="tire print" class="position-absolute end-0 z-1 tire-print">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
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
        <div class="row">
            <div class="col-xxl-8">
                <?php if( !isset($user) || !isset($user['Authorization']) || ( isset($user['Authorization']) && $user['Authorization'] == false) ) { ?>
                    
                <?php } else { ?> 
                <div class="checkout-badge bg-light px-0 d-flex align-items-center justify-content-between">
                    <h4 class="h5 px-4 mb-0">
                        Personal Details
                    </h4>
                </div>
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
                <?php } ?>

                <div class="checkout-badge bg-light px-0 d-flex align-items-center justify-content-between">
                    <h4 class="h5 px-4 mb-0">
                        Your Order
                    </h4>
                </div>
                <div class="shopping-cart-left">
                    <?php 
                    $subtotal = 0;
                    $gst = 0;
                    $total = 0;
                    $helmets_total = 0;
                    ?>
                    <div class="table-content table-responsive table-bordered bg-white rounded">
                        <table class="table cartbikes">
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
                                    $rent_price = 0;
                                    if( $cart['period_days'] > 0 || $cart['period_hours'] > 4  ){
                                        if( $cart['public_holiday'] == 1 ){
                                            $rent_price = $bike['holiday_day_price'];
                                        }
                                        elseif( $cart['weekend'] == 1 ){
                                            $rent_price = $bike['weekend_day_price'];
                                        } else {
                                            $rent_price = $bike['week_day_price'];
                                        }
                                    } else {
                                        if( $cart['public_holiday'] == 1 ){
                                            $rent_price = $bike['holiday_day_half_price'];
                                        } elseif( $cart['weekend'] == 1 ){
                                            $rent_price = $bike['weekend_day_half_price'];
                                        } else {
                                            $rent_price = $bike['week_day_half_price'];
                                        } 
                                    }

                                    $rent_total = round($bike['quantity'] * $rent_price, 2);

                                    $total += $rent_total;
                                ?>
                                <tr class="bike-row" data-id="<?=$bike['bike_type_id']?>">
                                    <td>
                                        <span class="d-block mb-2 fw-bold fa-md w-100 text-center"><?=$bike['bike_type_name']?></span>
                                        <img style="max-width:200px;" src="<?=base_url('bikes/'.$bike['image'])?>" alt="<?=$bike['bike_type_name']?>" class="d-block mx-auto img-fluid">
                                    </td>
                                    <td><span class="w-100 m-2 p-2 fa-sm font-bold d-block"><?=date("d M Y", strtotime($cart['pickup_date']))?></b></span>
                                        <span class="w-100 m-2 py-2 px-4 fa-sm font-bold d-block"><b><?=$cart['pickup_time']?></b></span>
                                        <span style="width:30px;display:block;margin:10px;margin-left:35px;text-align: center;color: black; background-color: #FFDD06; color: #ffffff; border-radius:20px; font-size:10px; padding:5px 10px;">to</span>
                                        <span class="w-100 m-2 p-2 fa-sm font-bold d-block"><?=date("d M Y", strtotime($cart['dropoff_date']))."<b>";?></b></span>
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
                            }
                            if( isset($cart['helmets_qty']) && $cart['helmets_qty'] > 0 ){

                                $helmets_price = 50;
                                $helmets_total = $cart['helmets_qty'] * $helmets_price;
                                $total += $helmets_total;
                            ?>
                                <tr class="helmets-row">
                                    <td>
                                        <img style="max-width:100px;" src="<?=base_url()?>assets/img/icons/helmet_black.svg" alt="Helmet" class="d-block mx-auto img-fluid">
                                    </td>
                                    <td>
                                        <span class="w-100 m-2 p-2 fa-sm font-bold d-block"><?=date("d M Y", strtotime($cart['pickup_date']))." <b>".$cart['pickup_time']?></b></span>
                                        <span style="width:30px;display:block;margin:10px 20%;text-align: center;color: black; background-color: #FFDD06; color: #ffffff; border-radius:20px; font-size:10px; padding:5px 10px;">to</span>
                                        <span class="w-100 m-2 p-2 fa-sm font-bold d-block"><?=date("d M Y", strtotime($cart['dropoff_date']))." <b>".$cart['dropoff_time']?></b></span>
                                    </td>
                                    <td><i class="fa fa-indian-rupee-sign me-1"></i><?=$helmets_price?></td>
                                    <td>
                                        <div class="d-flex text-center">
                                            <span class="d-block m-auto text-center font-normal"><?=$cart['helmets_qty']?></span>
                                        </div>
                                    </td>
                                    <td><i class="fa fa-indian-rupee-sign me-1"></i><?=$helmets_total?></td>
                                </tr>
                                <?php }
                        ?>
                        </table>
                    </div>
                </div>
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
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i> <?=$total - round($total * 0.05, 2)?></th>
                            </tr>
                            <tr>
                                <th class="text-start">GST</th>
                                <th class="text-end"><i class="fa fa-indian-rupee-sign me-1"></i> <?=round($total * 0.05, 2)?></th>
                            </tr>
                            <tr>
                                <td class="text-start fw-bold">Total</td>
                                <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i> <?=$total;?></td>
                            </tr>
                            <tr>
                                <td class="text-start fw-bold">
                                    Paying Now
                                    <?php if( $cart['paymentOption'] != "PAY_FULL" ){?>
                                        <span class="d-block text-gray fw-normal text-sm">(Remaining to be paid at the time of pickup)</span>
                                    <?php } ?>
                                </td>
                                <?php if($cart['paymentOption'] == "PAY_FULL"){?>
                                <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i> <?=$total?></td>
                                <?php } else { ?>
                                <td class="fw-bold text-end"><i class="fa fa-indian-rupee-sign me-1"></i> <?=round( $total /2 , 2);?></td>
                                <?php } ?>
                            </tr>                                                           
                        </table>
                        <div class="d-flex flex-column p-4">
                            <?php if( isset($user) && ( isset($user['Authorization']) && $user['Authorization'] == true) ) { ?>
                            <form class="pay_instant_form" method="POST" action="<?=base_url('Payment/instant')?>">
                                <div class="w-100 px-4 py-4">
                                    <label class="fa-md">Delivery Notes:</label>
                                    <textarea rows="2" class="form-control" name="notes" value=""></textarea>
                                </div>
                                <button type="button" id="proceed_payment" class="btn btn-primary btn-md d-block mt-4">Proceed to Pay</a>
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

        var url = $(".pay_instant_form").attr("action");
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