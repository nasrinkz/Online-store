@extends('layouts.master')
@section('title','NikaStore | Categories List')
@section('breadcrumb')
    @parent
@section('breadcrumbAppend')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
    </nav>
    <h5>Categories List</h5>
@endsection
@endsection
@section('content')
    <main>
        <section class="populerproduct bg-white shop-product">
            <div class="container">
                <div class="row">
                    @if ($values->isEmpty())
                        <div class="col-md-12 text-center" >Oops! No matching products found</div>
                    @endif
                    @foreach($values as $category)
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
            </div>
        </section>
        {!! $values->appends(Request::except('page'))->links('vendor.pagination.custom') !!}
    </main>
@endsection
