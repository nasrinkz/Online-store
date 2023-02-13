@extends('layouts.master')
@section('title','NikaStore | Cart')
@section('breadcrumb')
    @parent
@section('breadcrumbAppend')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
                            <li class="list-inline-item"><a href="{{route('UserDashboard')}}">Account
                                    settings</a></li>
                            <li class="list-inline-item"><a href="deliver-info.blade.php">Deliver information</a></li>
                            <li class="list-inline-item"><a href="{{route('wishList')}}">My wishlist</a></li>
                            <li class="list-inline-item"><a href="{{route('cartList')}}" class="active">My cart</a></li>
                            <li class="list-inline-item"><a href="order.blade.php">Order</a></li>
                            <li class="list-inline-item"><a href="{{route('logout')}}" class="mr-0">Log-out</a></li>
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
                        <div class="info">
                            Name
                        </div>
                        <div class="price">
                            Prices
                        </div>
                        <div class="price">
                            Size
                        </div>
                        <div class="price">
                            Color
                        </div>
                        <div class="info">
                            Operation
                        </div>
                    </div>
                    <div class="body">
                        @foreach($values as $value)
                        <div class="item">
                            <div class="image">
                                <a href="{{route('ProductDetails',$value->product_id)}}"><img src="{{asset($value->product->cover)}}"></a>
                            </div>
                            <div class="info">
                                <div class="name-text">
                                    <p> {{$value->product->title}}</p>
                                </div>
                                <div class="button">
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
                                                @if($value->product->status==0)
                                                    <input type="hidden" value="disable">
                                                    <input type="number" value="0" max="0" min="0">
                                                @else
                                                    <input type="hidden" value="enable">
                                                    <input type="number" value="{{$value->number}}" min="1">
                                                @endif
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
                            <div class="price">
                                @if($value->product->sellingPrice == $value->product->originalPrice)
                                    <span>{{'$'.$value->product->sellingPrice}}</span>
                                @else
                                    <span>{{'$'.$value->product->sellingPrice}}</span> <del>{{'$'.$value->product->originalPrice}}</del>
                                @endif
                            </div>
                            <div class="price">
                                <div class="size">
                                    <div class="product-pricelist-selector-size">
                                        <div class="sizes" id="sizes">
                                            @foreach($value->product->sizesTable as $s)
                                                @if($s->number>0)
                                                    <li class="sizes-all @if($s->size->id==$value->size_id) active @endif" id="size" value="{{$s->size->id}}" title="{{$s->size->title}}">{{$s->size->symbol}}</li>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="price">
                                <div class="size">
                                    <div class="product-pricelist-selector-color">
                                        <div class="colors" id="colors">
                                            @foreach($value->product->colorsTable as $c)
                                                @if($c->number>0)
                                                    <li class="colorall @if($c->color->id==$value->color_id) active @endif" id="color" value="{{$c->color->id}}" style="background-color: {{$c->color->code}}" title="{{$c->color->title}}"></li>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="info">
                                <div class="button">
                                    <a class="del text-danger" href="{{route('removeFromCart',$value->id)}}">Delete</a>
                                </div>
                                @if($value->product->status==0)
                                <div class="button">
                                    <span class="del text-danger">!! Unavailable !!</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="apply-coupon">
                        <h6>Apply Coupon</h6>
                        <form action="#">
                            <div class="form__div">
                                <input type="text" name="coupon" class="form__input" placeholder=" ">
                                <label for="" class="form__label">Coupon Code</label>
                            </div>
                            <button class="btn bg-primary" type="submit" id="checkCoupon">apply COUPON</button>
                            <div class="col-lg-12">
                                <div class="text-danger" id="error-msg">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-price">
                        <h6>Check Summery</h6>
                        <div class="card-price-list d-flex justify-content-between align-items-center">
                            <div class="item">
                                @php($count = 0)
                                @foreach($values as $value)
                                    @if($value->product->status==1)
                                        @php($count++)
                                    @endif
                                @endforeach
                                <p>{{$count}} item</p>
                            </div>
                            <div class="price">
                                <p>$0</p>
                            </div>
                        </div>
                        <div class="card-price-list d-flex justify-content-between align-items-center">
                            <div class="item">
                                <p>Shipping Cast</p>
                            </div>
                            <div class="price">
                                <p>$0</p>
                            </div>
                        </div>
                        <div class="card-price-list d-flex justify-content-between align-items-center">
                            <div class="item">
                                <p>Discount</p>
                            </div>
                            <div class="price">
                                <p>$0</p>
                            </div>
                        </div>
                        <div class="card-price-list d-flex justify-content-between align-items-center">
                            <div class="item">
                                <p>Coupon</p>
                            </div>
                            <div class="price">
                                <p id="couponDiscount">0</p>
                            </div>
                        </div>
                        <div class="card-price-subtotal d-flex justify-content-between align-items-center">
                            <div class="total-text">
                                <p>Total Price</p>
                            </div>
                            <div class="total-price">
                                <p>$0</p>
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
