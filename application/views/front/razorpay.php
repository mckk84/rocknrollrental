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
        <div class="row">
            <div class="col-xxl-8">
                <button id="rzp-button1" class="btn btn-outline-dark btn-lg"><i class="fas fa-money-bill"></i> Own Checkout</button>
                <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                <script>
                  var options = {
                    callback_url: '<?=base_url('Razorpay/callback')?>',
                    redirect: true,
                    "key": "<?=$key?>", // Enter the Key ID generated from the Dashboard
                    "amount": "100",
                    "currency": "INR",
                    "description": "Rocknroll Rentals",
                    "image": "example.com/image/rzp.jpg",
                    "prefill":
                    {
                      "name":"Charan Kumar",  
                      "email": "mckk84@gmail.com",
                      "contact": +919980019504,
                    },
                    "handler": function (response) {
                      alert(response.razorpay_payment_id);
                    },
                    "modal": {
                      "ondismiss": function () {
                        if (confirm("Are you sure, you want to close the form?")) {
                          txt = "You pressed OK!";
                          console.log("Checkout form closed by the user");
                        } else {
                          txt = "You pressed Cancel!";
                          console.log("Complete the Payment")
                        }
                      }
                    }
                  };
                  var rzp1 = new Razorpay(options);
                  document.getElementById('rzp-button1').onclick = function (e) {
                    rzp1.open();
                    e.preventDefault();
                  }
                </script>
            </div>
        </div>
    </div>
</section>
