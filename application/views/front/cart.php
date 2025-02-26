<!--breadcrumb section start-->
        <section class="breadcrumb-section position-relative z-2 overflow-hidden" data-background="<?=base_url()?>/assets/img/shapes/texture-bg.png">
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
        <section class="shopping-cart ptb-120">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-9">
                        <div class="shopping-cart-left">
                            <div class="checkout-badge bg-eq-primary d-flex align-items-center justify-content-between">
                                <label>
                                    Selected Bikes
                                </label>
                            </div>
                            <div class="table-content table-responsive bg-white rounded mt-4">
                                <table class="table">
                                    <tr>
                                        <th>#</th>
                                        <th>Fleet</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/img/products/tire.png" alt="tire" class="img-fluid">
                                        </td>
                                        <td>
                                            <h6 class="mb-0">Honda Active 6g</h6>
                                        </td>
                                        <td>500</td>
                                        <td>
                                            <div class="cart-count d-inline-flex align-items-center">
                                                <button class="cart-minus bg-transparent"><i class="fa-solid fa-minus"></i></button>
                                                <input type="text" class="cart-input" value="1">
                                                <button class="cart-plus bg-transparent"><i class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td>Rs 500</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-bottom d-flex flex-wrap align-items-center justify-content-between bg-white mt-4 pt-4 pt-lg-0 mt-lg-0">
                                <form class="d-flex align-items-center flex-wrap">
                                    <input type="text" placeholder="Coupon code">
                                    <button type="submit" class="btn btn-secondary btn-md">Apply Now</button>
                                </form>
                                <button type="button" class="btn btn-primary btn-md mt-3 mt-md-0">Update cart</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-6">
                        <div class="cart-sidebar bg-white rounded mt-5 mt-xxl-0">
                            <h4 class="mb-3">Cart totals</h4>
                            <span class="spacer"></span>
                            <div class="table-responisve">
                                <table class="table">
                                    <tr>
                                        <th>Subtotal</th>
                                        <th class="text-end">Rs 500</th>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold border-0">Total</td>
                                        <td class="fw-bold text-end border-0">Rs 500</td>
                                    </tr>
                                </table>
                                <a href="#" class="btn btn-primary btn-md d-block mt-4">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--shopping cart end-->