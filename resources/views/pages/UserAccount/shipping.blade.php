@extends('layouts.master')
@section('title','NikaStore | Shipping')
@section('breadcrumb')
    @parent
@section('breadcrumbAppend')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Cart</li>
            <li class="breadcrumb-item" aria-current="page">Billing information</li>
            <li class="breadcrumb-item active" aria-current="page">Shipping</li>
        </ol>
    </nav>
    <h5>Shipping</h5>
@endsection
@endsection
@section('content')
    <!-- Shipping Area Start -->
    <section class="shipping-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Dashboard-Nav  Start-->
                    <div class="dashboard-nav">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="billing-information.blade.php">Deliver
                                    information</a>
                                <i class="fas fa-angle-right"></i></li>
                            <li class="list-inline-item"><a href="shipping.blade.php" class="active">Shipping</a> <i
                                    class="fas fa-angle-right"></i></li>
                            <li class="list-inline-item"><a href="payment.blade.php" class="mr-0">Payment</a></li>
                        </ul>
                    </div>
                    <!-- Dashboard-Nav  End-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 order-2 order-lg-1">
                    <div class="shipping-info-form">
                        <div class="shipping-info-form-text">
                            <h6>Your information</h6>
                            <div class="shipping-info mod">
                                <div class="shipping-info-text">
                                    <div class="left">
                                        <span>Contact:</span>
                                    </div>
                                    <div class="right mar-5">
                                        <p>mike.hudson@gmail.com</p>
                                        <p>+1202-555-0558</p>
                                    </div>
                                </div>
                                <div class="shipping-info-button">
                                    <form action="#">
                                        <button type="submit">Change</button>
                                    </form>
                                </div>
                            </div>
                            <div class="shipping-info mod">
                                <div class="shipping-info-text">
                                    <div class="left">
                                        <span>Ship to:</span>
                                    </div>
                                    <div class="right mar-5">
                                        <p>Flat No. # 5/D, Apartmen No. #2587/S, Street No. #24/A, </p>
                                        <p>Illinois, Chicago-60626</p>
                                    </div>
                                </div>
                                <div class="shipping-info-button">
                                    <form action="#">
                                        <button type="submit">Change</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="form">
                            <h6>Shipping method</h6>
                            <form action="#">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="select-button">
                                            <div class="button-area">
                                                <div class="radio-button">
                                                    <input type="radio" name="shipping" id="shippingMethod" checked>
                                                </div>
                                                <div class="text-area">
                                                    <p>Fast Shipping (Delivered in 8-12 days, includes 3-4 days for
                                                        processing)</p>
                                                </div>
                                            </div>
                                            <div class="select-button-text">
                                                <span>Free</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="select-button modifier">
                                            <div class="button-area">
                                                <div class="radio-button">
                                                    <input type="radio" name="shipping" id="shippingMethod">
                                                </div>
                                                <div class="text-area">
                                                    <p>
                                                        Faster Shipping (Delivered in 4-6 days, includes 2 days for
                                                        processing)
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="select-button-text">
                                                <span>$19.99</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="select-button">
                                            <div class="button-area">
                                                <div class="radio-button">
                                                    <input type="radio" name="shipping" id="shippingMethod">
                                                </div>
                                                <div class="text-area">
                                                    <p>Fastest Shipping (Delivered in 2-3 days, includes 1 days for
                                                        processing)</p>
                                                </div>
                                            </div>
                                            <div class="select-button-text">
                                                <span>$29.99</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div
                                        class="col-12 d-flex align-items-center justify-content-between bottom flex-wrap">
                                        <a href="billing-information.blade.php">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
                                            Return to Billing information</a>
                                        <button class="btn bg-primary mt-0" type="submit">Continue</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 order-1 order-lg-2">
                    <div class="card-price">
                        <h6>Check Summery</h6>
                        <div class="card-price-list d-flex justify-content-between align-items-center">
                            <div class="item">
                                <p>3 item</p>
                            </div>
                            <div class="price">
                                <p>$125</p>
                            </div>
                        </div>
                        <div class="card-price-list d-flex justify-content-between align-items-center">
                            <div class="item">
                                <p>Shipping Cast</p>
                            </div>
                            <div class="price">
                                <p>$55</p>
                            </div>
                        </div>
                        <div class="card-price-list d-flex justify-content-between align-items-center">
                            <div class="item">
                                <p>Discount</p>
                            </div>
                            <div class="price">
                                <p>8%</p>
                            </div>
                        </div>
                        <div class="card-price-list d-flex justify-content-between align-items-center">
                            <div class="item">
                                <p>Taxes</p>
                            </div>
                            <div class="price">
                                <p>$5.49</p>
                            </div>
                        </div>
                        <div class="card-price-subtotal d-flex justify-content-between align-items-center">
                            <div class="total-text">
                                <p>Total Price</p>
                            </div>
                            <div class="total-price">
                                <p>$174.99</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shipping Area End -->
@endsection
