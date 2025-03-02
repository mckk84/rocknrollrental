<!--breadcrumb section start-->
<section class="breadcrumb-section position-relative overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/texture-bg.png">
    <img src="<?=base_url()?>/assets/img/shapes/tire-print-left.png" alt="tire print" class="position-absolute start-0 z-1 tire-print">
    <img src="<?=base_url()?>/assets/img/shapes/tire-print-right.png" alt="tire print" class="position-absolute end-0 z-1 tire-print">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-content-wrapper text-center position-relative z-3">
                    <h1 class="text-white">Payment</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!--breadcrumb section end-->

<!--shopping cart-->
<section class="shopping-cart ptb-60">
    <div class="container">
        <?php if( !isset($payment_status) || $payment_status == "Failed" ){?>
        <div class="row">
            <h4 class="h4 text-danger">Booking failed. Please try again.</h4>
        </div>   
        <meta http-equiv="refresh" content="3;url=<?=base_url('Bookaride')?>" /> 
        <?php } else {?> 
        <div class="row">
            <h4 class="h4 text-success">Booking successful. Your booking id is <b>#<?=$booking_id?><b>. Redirecting to Your Account.</h4>
        </div>
        <meta http-equiv="refresh" content="3;url=<?=base_url('Account')?>" /> 
        <?php }?>

    </div>
</section>