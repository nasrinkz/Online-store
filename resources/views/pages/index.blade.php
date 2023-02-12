@extends('layouts.master')
@section('title','NikaStore | Home')
@section('breadcrumb','')
@section('content')
    <main>
            <!--Banner Area Start -->
            <section class="banner-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 order-2 order-lg-1">
                            <div class="banner-area__content">
                                <h2>{{$headerProduct->title}}</h2>
                                <p>{!! $headerProduct->description !!}</p>
                                <a class="btn bg-primary" href="{{route('ProductDetails',$headerProduct->id)}}">Shop Now</a>
                            </div>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2">
                            <div class="banner-area__img">
                                <img src="{{asset($headerProduct->cover)}}" alt="banner-img" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="brand-area">
                                @foreach($brands as $brand)
                                <div class="brand-area-image">
                                    <a href="{{route('Shop','brand='.$brand->id)}}"><img src="{{asset($brand->image)}}" title="{{$brand->title}}" alt="Brand" class="img-fluid"></a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--Banner Area End -->

            <!-- Features Section Start -->
            <section class="features">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section-title">
                                <h2>Featured Products</h2>
                            </div>
                        </div>
                    </div>
                    <div class="features-wrapper">
                        <div class="features-active">
                            @foreach($specialProducts as $product)
                            <div class="product-item">
                                <div class="product-item-image">
                                    <a href="{{route('ProductDetails',$product->id)}}"><img src="{{asset($product->cover)}}" alt="{{$product->title}}"
                                                                                  class="img-fluid"></a>
                                    <div class="cart-icon">
                                        @if(Auth::check())
                                        @php($wishExist = 0)
                                        @foreach($product->wishes as $wish)
                                            @if($wish->user_id == auth()->user()->id)
                                                @php($wishExist = 1)
                                            @endif
                                        @endforeach
                                            <a href="javascript:" @if($wishExist == 0) onClick="addWish(this,{{$product->id}});" rel="{{url('UserDashboard/addWish')}}/" @else onclick="removeWish(this,{{$product->id}})" rel="{{url('UserDashboard/removeWish')}}/" @endif><i id="{{'F'.$product->id}}" @if($wishExist == 1) class="fa fa-heart text-danger" @else class="far fa-heart" @endif></i></a>@endif
                                    </div>
                                </div>
                                <div class="product-item-info">
                                    <a href="{{route('ProductDetails',$product->id)}}">{{$product->title}}</a>
                                    @if($product->sellingPrice == $product->originalPrice)
                                        <span>{{'$'.$product->sellingPrice}}</span>
                                    @else
                                        <span>{{'$'.$product->sellingPrice}}</span> <del>{{'$'.$product->originalPrice}}</del>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="slider-arrows">
                            <div class="prev-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="9.414" height="16.828"
                                     viewBox="0 0 9.414 16.828">
                                    <path id="Icon_feather-chevron-left" data-name="Icon feather-chevron-left"
                                          d="M20.5,23l-7-7,7-7" transform="translate(-12.5 -7.586)" fill="none"
                                          stroke="#1a2224" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                </svg>
                            </div>
                            <div class="next-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="9.414" height="16.828"
                                     viewBox="0 0 9.414 16.828">
                                    <path id="Icon_feather-chevron-right" data-name="Icon feather-chevron-right"
                                          d="M13.5,23l5.25-5.25.438-.437L20.5,16l-7-7" transform="translate(-12.086 -7.586)"
                                          fill="none" stroke="#1a2224" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="features-morebutton text-center">
                                <a class="btn bt-glass" href="{{route('Shop','special=1')}}">View All Products</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Features Section End -->

            <!-- About Area Start -->
            <section class="about-area">
                <div class="container">
                    <div class="about-area-content">
                        <div class="row align-items-center">
                            <div class="col-lg-6 ">
                                <div class="about-area-content-img">
                                    <img src="{{asset($middleBanner->image)}}" alt="img" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="about-area-content-text">
                                    <h3>Why Shop with Olog</h3>
                                    <p>Fortify your hair follicles, give thinning areas some volume, and treat your
                                        body’s
                                        skin like driving your dream car off the lot.</p>
                                    <div class="icon-area-content">
                                        <div class="icon-area">
                                            <i class="far fa-check-circle"></i>
                                            <span>Secure Payment Method.</span>
                                        </div>
                                        <div class="icon-area">
                                            <i class="far fa-check-circle"></i>
                                            <span>24/7 Customers Services.</span>
                                        </div>
                                        <div class="icon-area">
                                            <i class="far fa-check-circle"></i>
                                            <span>Shop in 2 languages</span>
                                        </div>
                                        <div class="icon-area">
                                            <i class="far fa-check-circle"></i>
                                            <span>Mauris congue eros in iaculis.</span>
                                        </div>
                                    </div>

                                    <a class="btn bg-primary" href="{{route('Shop')}}">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- About Area End -->

            <!-- Populer Product Strat -->
            <section class="populerproduct">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section-title">
                                <h2>Best-selling Products</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($topSales as $topSale)
                        <div class="col-md-4 col-sm-6">
                            <div class="product-item">
                                <div class="product-item-image">
                                    <a href="{{route('ProductDetails',$topSale->id)}}"><img src="{{asset($topSale->cover)}}" alt="{{$topSale->title}}"
                                                                                  class="img-fluid"></a>
                                    <div class="cart-icon">
                                        @if(Auth::check())
                                        @php($wishExist = 0)
                                        @foreach($topSale->wishes as $wish)
                                            @if($wish->user_id == auth()->user()->id)
                                                @php($wishExist = 1)
                                            @endif
                                        @endforeach
                                        <a href="javascript:" @if($wishExist == 0) onClick="addWish2(this,{{$topSale->id}});" rel="{{url('UserDashboard/addWish')}}/" @else onclick="removeWish2(this,{{$topSale->id}})" rel="{{url('UserDashboard/removeWish')}}/" @endif><i id="{{'T'.$topSale->id}}" @if($wishExist == 1) class="fa fa-heart text-danger" @else class="far fa-heart" @endif></i></a>@endif
                                    </div>
                                </div>
                                <div class="product-item-info">
                                    <a href="{{route('ProductDetails',$topSale->id)}}">{{$topSale->title}}</a>
                                    @if($topSale->sellingPrice == $topSale->originalPrice)
                                        <span>{{'$'.$topSale->sellingPrice}}</span>
                                    @else
                                        <span>{{'$'.$topSale->sellingPrice}}</span> <del>{{'$'.$topSale->originalPrice}}</del>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{\Request::getClientIp(true)}}
                </div>
            </section>
            <!-- Populer Product End -->

            <!-- Categorys Section Start -->
            <section class="categorys">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section-title">
                                <h2>Shop with top categories</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($categories as $category)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="productcategory text-center">
                                <div class="productcategory-img">
                                    <a href="{{route('Shop','category='.$category->id)}}"><img src="{{asset($category->image)}}" alt="images"></a>
                                </div>
                                <div class="productcategory-text">
                                    <a href="{{route('Shop','category='.$category->id)}}">
                                        <h6>{{$category->title}}</h6>
                                        <span>{{$productCount[$category->id] .' products'}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="features-morebutton text-center">
                                <a class="btn bt-glass" href="{{route('Categories')}}">View All Categorys</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Categorys Section End -->

        </main>
@endsection

