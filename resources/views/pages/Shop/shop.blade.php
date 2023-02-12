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
        <!-- Category item start -->
        <section class="categoryitem">
            <div class="container">
                <div class="justify-content-center">
                    <form action="{{route('Shop')}}" method="get">
                        @if(isset($_GET['special']))
                            <input type="hidden" name="special" value="1">
                        @endif
                            <div class="categoryitem-wrapper" style="width: unset">
                                <div class="categoryitem-wrapper-itembox">
                                    <h6>Title</h6>
                                        <input type="text" class="nice-select" style="cursor: auto" name="title" @if(isset($_GET['title'])) value="{{$_GET['title']}}" @endif placeholder="Product title...">
                                </div>
                                <div class="categoryitem-wrapper-itembox">
                                    <h6>Category</h6>
                                    <select name="category">
                                        <option value="" selected>All</option>
                                        @foreach($categories as $category)
                                            <option @if(isset($_GET['category']) && $_GET['category']==$category->id) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="categoryitem-wrapper-itembox">
                                    <h6>Brand</h6>
                                    <select name="brand">
                                        <option value="" selected>All</option>
                                        @foreach($brands as $brand)
                                            <option @if(isset($_GET['brand']) && $_GET['brand']==$brand->id) selected @endif value="{{$brand->id}}">{{$brand->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="categoryitem-wrapper-itembox">
                                    <h6>Sort By</h6>
                                    <select name="sort">
                                        <option @if(isset($_GET['sort']) && $_GET['sort']=='date') selected @endif value="date">The newest</option>
                                        <option @if(isset($_GET['sort']) && $_GET['sort']=='cheap') selected @endif value="cheap">Cheapest</option>
                                        <option @if(isset($_GET['sort']) && $_GET['sort']=='expensive') selected @endif value="expensive">The most expensive</option>
                                    </select>
                                </div>
                                <div class="categoryitem-wrapper-itembox">
                                    <input type="submit" class="btn btn-primary p-filter-btn" value="Filter">
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </section>
        <!-- Category item End -->

        <!-- Product Start -->
        <section class="populerproduct bg-white p-0 shop-product">
            <div class="container">
                <div class="row">
                    @if ($values->isEmpty())
                        <div class="col-md-12 text-center" >Oops! No matching products found</div>
                    @endif
                    @foreach($values as $product)
                        <div class="col-md-4 col-sm-6">
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
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Product End -->
        {!! $values->appends(Request::except('page'))->links('vendor.pagination.custom') !!}
    </main>
@endsection
