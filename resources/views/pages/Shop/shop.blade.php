@extends('layouts.master')
@section('title','NikaStore | Shop')
@section('breadcrumb')
    @parent
@section('breadcrumbAppend')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shop</li>
        </ol>
    </nav>
    <h5>Shop</h5>
@endsection
@endsection
@section('content')
    <main>
        <!-- Category Search Start -->
        <section class="search">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="search-wrapper">
                        <form class="search-wrapper-box">
                            <input type="text" placeholder="Search Here.">
                            <button class="btn bg-primary" type="submit">SEARCH</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category Search End -->

        <!-- Category item start -->
        <section class="categoryitem">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="categoryitem-wrapper">
                        <div class="categoryitem-wrapper-itembox">
                            <h6>Category</h6>
                            <select>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="categoryitem-wrapper-itembox">
                            <h6>Brand</h6>
                            <select>
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="categoryitem-wrapper-price">
                            <h6>Price</h6>
                            <form class="price-item">
                                <input type="number" name="minPrice" placeholder="Min">
                                <span>|</span>
                                <input type="number" name="maxPrice" placeholder="Max">
                            </form>
                        </div>
                        <div class="categoryitem-wrapper-itembox">
                            <h6>Sort By</h6>
                            <select>
                                <option value="date">The newest</option>
                                <option value="cheap">Cheapest</option>
                                <option value="expensive">The most expensive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category item End -->

        <!-- Product Start -->
        <section class="populerproduct bg-white p-0 shop-product">
            <div class="container">
                <div class="row">
                    @foreach($values as $product)
                        <div class="col-md-4 col-sm-6">
                            <div class="product-item">
                                <div class="product-item-image">
                                    <a href="../product-details.blade.php"><img src="{{$product->cover}}" alt="{{$product->title}}"
                                                                                class="img-fluid"></a>
                                    <div class="cart-icon">
                                        <a href="#"><i class="far fa-heart"></i></a>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16.75" height="16.75"
                                                 viewBox="0 0 16.75 16.75">
                                                <g id="Your_Bag" data-name="Your Bag" transform="translate(0.75)">
                                                    <g id="Icon" transform="translate(0 1)">
                                                        <ellipse id="Ellipse_2" data-name="Ellipse 2" cx="0.682" cy="0.714"
                                                                 rx="0.682" ry="0.714" transform="translate(4.773 13.571)"
                                                                 fill="none" stroke="#1a2224" stroke-linecap="round"
                                                                 stroke-linejoin="round" stroke-width="1.5" />
                                                        <ellipse id="Ellipse_3" data-name="Ellipse 3" cx="0.682" cy="0.714"
                                                                 rx="0.682" ry="0.714" transform="translate(12.273 13.571)"
                                                                 fill="none" stroke="#1a2224" stroke-linecap="round"
                                                                 stroke-linejoin="round" stroke-width="1.5" />
                                                        <path id="Path_3" data-name="Path 3"
                                                              d="M1,1H3.727l1.827,9.564a1.38,1.38,0,0,0,1.364,1.15h6.627a1.38,1.38,0,0,0,1.364-1.15L16,4.571H4.409"
                                                              transform="translate(-1 -1)" fill="none" stroke="#1a2224"
                                                              stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="1.5" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-item-info">
                                    <a href="../product-details.blade.php">{{$product->title}}</a>
                                    <span>{{'$'.$product->sellingPrice}}</span> <del>{{'$'.$product->originalPrice}}</del>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Product End -->
        {{ $values->links('vendor.pagination.custom')}}
    </main>
@endsection
