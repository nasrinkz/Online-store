@extends('layouts.master')
@section('title','NikaStore | Wishlist')
@section('breadcrumb')
    @parent
@section('breadcrumbAppend')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
        </ol>
    </nav>
    <h5>Wishlist</h5>
@endsection
@endsection
@section('content')
    <!-- Wishlist Area Start -->
    <section class="wishlist-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Dashboard-Nav  Start-->
                    <div class="dashboard-nav">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="user-dashboard.blade.php">Account
                                    settings</a></li>
                            <li class="list-inline-item"><a href="deliver-info.blade.php">Billing information</a></li>
                            <li class="list-inline-item"><a href="wishlist.blade.php" class="active">My wishlist</a></li>
                            <li class="list-inline-item"><a href="cart.blade.php">My cart</a></li>
                            <li class="list-inline-item"><a href="order.blade.php">Order</a></li>
                            <li class="list-inline-item"><a href="account.html" class="mr-0">Log-out</a></li>
                        </ul>
                    </div>
                    <!-- Dashboard-Nav  End-->
                </div>
            </div>
            <div class="rows">
                <!-- Wishlist Item Start -->
                <div class="cart-items wishList">
                    <div class="header">
                        <div class="image">
                            Image
                        </div>
                        <div class="info">
                            Name
                        </div>
                        <div class="name">
                            Description
                        </div>
                        <div class="price">
                            Prices
                        </div>
                        <div class="name">
                            Actions
                        </div>
                    </div>
                    <div class="body">
                        @foreach($values as $value)
                            @if($value->product->status == 1)
                            <div class="item">
                            <div class="image">
                                <img src="{{asset($value->product->cover)}}">
                            </div>
                            <div class="info">
                                <div class="name-text">
                                    <p> {{$value->product->title}}</p>
                                </div>
                            </div>
                                <div class="name">
                                    <p>{!! \Illuminate\Support\Str::limit($value->product->shortDescription, 400), '...' !!}</p>
                                </div>
                            <div class="price">
                                <span>{{'$'.$value->product->sellingPrice}}</span> <del>{{'$'.$value->product->originalPrice}}</del>
                            </div>
                                <div class="name">
                                    <div class="button">
                                        <div class="product-pricelist-selector-button">
                                            <a class="btn cart-bg " href="#">Add to cart
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                     viewBox="0 0 17 17">
                                                    <g id="Your_Bag" data-name="Your Bag" transform="translate(1)">
                                                        <g id="Icon" transform="translate(0 1)">
                                                            <ellipse id="Ellipse_2" data-name="Ellipse 2" cx="0.682"
                                                                     cy="0.714" rx="0.682" ry="0.714"
                                                                     transform="translate(4.773 13.571)" fill="none"
                                                                     stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                                                                     stroke-width="2" />
                                                            <ellipse id="Ellipse_3" data-name="Ellipse 3" cx="0.682"
                                                                     cy="0.714" rx="0.682" ry="0.714"
                                                                     transform="translate(12.273 13.571)" fill="none"
                                                                     stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                                                                     stroke-width="2" />
                                                            <path id="Path_3" data-name="Path 3"
                                                                  d="M1,1H3.727l1.827,9.564a1.38,1.38,0,0,0,1.364,1.15h6.627a1.38,1.38,0,0,0,1.364-1.15L16,4.571H4.409"
                                                                  transform="translate(-1 -1)" fill="none" stroke="#fff"
                                                                  stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2" />
                                                        </g>
                                                    </g>
                                                </svg>
                                            </a>
                                        </div>
                                        <a class="del text-danger" href="{{route('removeWishFromList',$value->product_id)}}">Remove</a>
                                    </div>
                                </div>
                        </div>
                            @endif
                        @endforeach
                    </div>
                    {{$values->links('vendor.pagination.custom')}}
                </div>
                <!-- Wishlist Item End -->
            </div>
        </div>
    </section>
    <!-- Wishlist Area End -->
@endsection


