@extends('layouts.master')
@section('title','NikaStore | Cart')
@section('breadcrumb')
    @parent
@section('breadcrumbAppend')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
        </ol>
    </nav>
    <h5>Cart</h5>
@endsection
@endsection
@section('content')
    <!-- Cart Area Start -->
    <section class="cart-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Dashboard-Nav  Start-->
                    <div class="dashboard-nav">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="user-dashboard.blade.php">Account
                                    settings</a></li>
                            <li class="list-inline-item"><a href="deliver-info.blade.php">Deliver information</a></li>
                            <li class="list-inline-item"><a href="wishlist.blade.php">My wishlist</a></li>
                            <li class="list-inline-item"><a href="cart.blade.php" class="active">My cart</a></li>
                            <li class="list-inline-item"><a href="order.blade.php">Order</a></li>
                            <li class="list-inline-item"><a href="account.html" class="mr-0">Log-out</a></li>
                        </ul>
                    </div>
                    <!-- Dashboard-Nav  End-->
                </div>
            </div>
            <div class="rows">
                <div class="cart-items">
                    <div class="header">
                        <div class="image">
                            Image
                        </div>
                        <div class="name">
                            Name
                        </div>
                        <div class="price">
                            Prices
                        </div>
                        <div class="rating">
                            Rating
                        </div>
                        <div class="info">
                            Info
                        </div>
                    </div>
                    <div class="body">
                        <div class="item">
                            <div class="image">
                                <img src="dist/images/nike-shoe.jpg">
                            </div>
                            <div class="name">
                                <div class="name-text">
                                    <p> Skechers Men's Classic Fit-Delson-Camden Sneaker</p>
                                </div>
                                <div class="button">
                                    <a class="btn bg-primary" href="billing-information.blade.php">Checkout now</a>
                                    <a class="cart-btn" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18"
                                             viewBox="0 0 20 18">
                                            <g id="Heart" transform="translate(1 1)">
                                                <path id="Heart-2" data-name="Heart"
                                                      d="M18.161,4.413a4.674,4.674,0,0,0-6.7,0l-.913.93-.913-.93a4.675,4.675,0,0,0-6.7,0,4.893,4.893,0,0,0,0,6.828l.913.93L10.548,19l6.7-6.828.913-.93a4.892,4.892,0,0,0,0-6.828Z"
                                                      transform="translate(-1.549 -2.998)" fill="#fff" stroke="#1a2224"
                                                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                            </g>
                                        </svg>
                                    </a>
                                    <a class="del" href="#">Delete</a>
                                </div>
                            </div>
                            <div class="price">
                                <span>$254.99</span> <del>$499.99</del>
                            </div>
                            <div class="rating">
                                <i class="fas fa-star"></i> 5.0
                            </div>
                            <div class="info">
                                <div class="size">
                                    <div class="product-pricelist-selector-size">
                                        <h6>Sizes</h6>
                                        <div class="sizes" id="sizes">
                                            <li class="sizes-all active">M</li>
                                        </div>
                                    </div>
                                    <div class="product-pricelist-selector-color">
                                        <h6>Colors</h6>
                                        <div class="colors" id="colors">
                                            <li class="colorall color-1 active"></li>
                                        </div>
                                    </div>
                                </div>
                                <div class="quantity">
                                    <div class="product-pricelist-selector-quantity">
                                        <h6>quantity</h6>
                                        <div class="wan-spinner wan-spinner-4">
                                            <a href="javascript:void(0)" class="minus">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="11.98" height="6.69"
                                                     viewBox="0 0 11.98 6.69">
                                                    <path id="Arrow" d="M1474.286,26.4l5,5,5-5"
                                                          transform="translate(-1473.296 -25.41)" fill="none"
                                                          stroke="#989ba7" stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="1.4" />
                                                </svg>
                                            </a>
                                            <input type="text" value="1" min="1">
                                            <a href="javascript:void(0)" class="plus"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="11.98" height="6.69"
                                                    viewBox="0 0 11.98 6.69">
                                                    <g id="Arrow" transform="translate(10.99 5.7) rotate(180)">
                                                        <path id="Arrow-2" data-name="Arrow" d="M1474.286,26.4l5,5,5-5"
                                                              transform="translate(-1474.286 -26.4)" fill="none"
                                                              stroke="#1a2224" stroke-linecap="round"
                                                              stroke-linejoin="round" stroke-width="1.4" />
                                                    </g>
                                                </svg></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="image">
                                <img src="dist/images/nike-shoe.jpg">
                            </div>
                            <div class="name">
                                <div class="name-text">
                                    <p> Skechers Men's Classic Fit-Delson-Camden Sneaker</p>
                                </div>
                                <div class="button">
                                    <a class="btn bg-primary" href="billing-information.blade.php">Checkout now</a>
                                    <a class="cart-btn" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18"
                                             viewBox="0 0 20 18">
                                            <g id="Heart" transform="translate(1 1)">
                                                <path id="Heart-2" data-name="Heart"
                                                      d="M18.161,4.413a4.674,4.674,0,0,0-6.7,0l-.913.93-.913-.93a4.675,4.675,0,0,0-6.7,0,4.893,4.893,0,0,0,0,6.828l.913.93L10.548,19l6.7-6.828.913-.93a4.892,4.892,0,0,0,0-6.828Z"
                                                      transform="translate(-1.549 -2.998)" fill="#fff" stroke="#1a2224"
                                                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                            </g>
                                        </svg>
                                    </a>
                                    <a class="del" href="#">Delete</a>
                                </div>
                            </div>
                            <div class="price">
                                <span>$254.99</span> <del>$499.99</del>
                            </div>
                            <div class="rating">
                                <i class="fas fa-star"></i> 5.0
                            </div>
                            <div class="info">
                                <div class="size">
                                    <div class="product-pricelist-selector-size">
                                        <h6>Sizes</h6>
                                        <div class="sizes" id="sizes">
                                            <li class="sizes-all active">M</li>
                                        </div>
                                    </div>
                                    <div class="product-pricelist-selector-color">
                                        <h6>Colors</h6>
                                        <div class="colors" id="colors">
                                            <li class="colorall color-1 active"></li>
                                        </div>
                                    </div>
                                </div>
                                <div class="quantity">
                                    <div class="product-pricelist-selector-quantity">
                                        <h6>quantity</h6>
                                        <div class="wan-spinner wan-spinner-4">
                                            <a href="javascript:void(0)" class="minus">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="11.98" height="6.69"
                                                     viewBox="0 0 11.98 6.69">
                                                    <path id="Arrow" d="M1474.286,26.4l5,5,5-5"
                                                          transform="translate(-1473.296 -25.41)" fill="none"
                                                          stroke="#989ba7" stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="1.4" />
                                                </svg>
                                            </a>
                                            <input type="text" value="1" min="1">
                                            <a href="javascript:void(0)" class="plus"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="11.98" height="6.69"
                                                    viewBox="0 0 11.98 6.69">
                                                    <g id="Arrow" transform="translate(10.99 5.7) rotate(180)">
                                                        <path id="Arrow-2" data-name="Arrow" d="M1474.286,26.4l5,5,5-5"
                                                              transform="translate(-1474.286 -26.4)" fill="none"
                                                              stroke="#1a2224" stroke-linecap="round"
                                                              stroke-linejoin="round" stroke-width="1.4" />
                                                    </g>
                                                </svg></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="image">
                                <img src="dist/images/nike-shoe.jpg">
                            </div>
                            <div class="name">
                                <div class="name-text">
                                    <p> Skechers Men's Classic Fit-Delson-Camden Sneaker</p>
                                </div>
                                <div class="button">
                                    <a class="btn bg-primary" href="billing-information.blade.php">Checkout now</a>
                                    <a class="cart-btn" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18"
                                             viewBox="0 0 20 18">
                                            <g id="Heart" transform="translate(1 1)">
                                                <path id="Heart-2" data-name="Heart"
                                                      d="M18.161,4.413a4.674,4.674,0,0,0-6.7,0l-.913.93-.913-.93a4.675,4.675,0,0,0-6.7,0,4.893,4.893,0,0,0,0,6.828l.913.93L10.548,19l6.7-6.828.913-.93a4.892,4.892,0,0,0,0-6.828Z"
                                                      transform="translate(-1.549 -2.998)" fill="#fff" stroke="#1a2224"
                                                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                            </g>
                                        </svg>
                                    </a>
                                    <a class="del" href="#">Delete</a>
                                </div>
                            </div>
                            <div class="price">
                                <span>$254.99</span> <del>$499.99</del>
                            </div>
                            <div class="rating">
                                <i class="fas fa-star"></i> 5.0
                            </div>
                            <div class="info">
                                <div class="size">
                                    <div class="product-pricelist-selector-size">
                                        <h6>Sizes</h6>
                                        <div class="sizes" id="sizes">
                                            <li class="sizes-all active">M</li>
                                        </div>
                                    </div>
                                    <div class="product-pricelist-selector-color">
                                        <h6>Colors</h6>
                                        <div class="colors" id="colors">
                                            <li class="colorall color-1 active"></li>
                                        </div>
                                    </div>
                                </div>
                                <div class="quantity">
                                    <div class="product-pricelist-selector-quantity">
                                        <h6>quantity</h6>
                                        <div class="wan-spinner wan-spinner-4">
                                            <a href="javascript:void(0)" class="minus">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="11.98" height="6.69"
                                                     viewBox="0 0 11.98 6.69">
                                                    <path id="Arrow" d="M1474.286,26.4l5,5,5-5"
                                                          transform="translate(-1473.296 -25.41)" fill="none"
                                                          stroke="#989ba7" stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="1.4" />
                                                </svg>
                                            </a>
                                            <input type="text" value="1" min="1">
                                            <a href="javascript:void(0)" class="plus"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="11.98" height="6.69"
                                                    viewBox="0 0 11.98 6.69">
                                                    <g id="Arrow" transform="translate(10.99 5.7) rotate(180)">
                                                        <path id="Arrow-2" data-name="Arrow" d="M1474.286,26.4l5,5,5-5"
                                                              transform="translate(-1474.286 -26.4)" fill="none"
                                                              stroke="#1a2224" stroke-linecap="round"
                                                              stroke-linejoin="round" stroke-width="1.4" />
                                                    </g>
                                                </svg></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="apply-coupon">
                        <h6>Apply Coupon</h6>
                        <form action="#">
                            <div class="form__div">
                                <input type="text" class="form__input" placeholder=" ">
                                <label for="" class="form__label">Coupon Code</label>
                            </div>
                            <button class="btn bg-primary" type="submit">apply COUPON</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
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
                        <form action="#">
                            <a href="billing-information.blade.php" class="btn bg-primary" type="submit" style="width: 100%;">Checkout Now</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Area End -->
@endsection
