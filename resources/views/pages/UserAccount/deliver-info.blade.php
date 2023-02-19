@extends('layouts.master')
@section('title','NikaStore | Deliver info')
@section('breadcrumb')
    @parent
@section('breadcrumbAppend')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Deliver information</li>
        </ol>
    </nav>
    <h5>Deliver information</h5>
@endsection
@endsection
@section('content')
    <!--Deliver Info Start-->
    <section class="deliver-info">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Dashboard-Nav  Start-->
                    <div class="dashboard-nav">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="{{route('UserDashboard')}}">Account
                                    settings</a></li>
                            <li class="list-inline-item"><a href="{{route('EditMyAddress')}}" class="active">Deliver information</a></li>
                            <li class="list-inline-item"><a href="{{route('wishList')}}">My wishlist</a></li>
                            <li class="list-inline-item"><a href="{{route('cartList')}}">My cart</a></li>
                            <li class="list-inline-item"><a href="order.blade.php">Order</a></li>
                            <li class="list-inline-item"><a href="{{route('logout')}}" class="mr-0">Log-out</a></li>
                        </ul>
                    </div>
                    <!-- Dashboard-Nav  End-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="deliver-info-form">
                        <h6>Deliver information</h6>
                        <div class="col-lg-12">
                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{Session::get('success')}}
                                </div>
                            @endif
                            @if(Session::has('alert'))
                                <div class="alert alert-danger">
                                    {{Session::get('alert')}}
                                </div>
                            @endif
                        </div>
                        <form method="POST" action="{{route('UpdateMyAddress',['id'=>$value->id])}}">
                            @csrf
                            {{method_field("put")}}
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12 mt-30">
                                    <select name="province_id" id="province">
                                        <option value="" disabled selected>Select province</option>
                                        @foreach($provinces as $province)
                                            <option @if($province->id==$value->province_id) selected @endif value="{{$province->id}}">{{$province->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12 mt-30">
                                    <select name="city_id" id="city">
                                        <option value="" disabled selected>Select city</option>
                                        @if($value->city_id)
                                            <option selected value="{{$value->city_id}}">{{$value->city->title}}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12 mt-30">
                                    <div class="form__div">
                                        <input type="text" name="zipCode" class="form__input" value="{{$value->zipCode}}" placeholder="
                                        ">
                                        <label for="" class="form__label">Zip Code</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form__div">
                                        <input type="text" name="address" class="form__input" value="{{$value->address}}" placeholder="
                                        ">
                                        <label for="" class="form__label">Address</label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn bg-primary" type="submit">Save Changes</button>
                            <div>
                                @if($errors->has('province_id'))
                                    <br><span class="error-text text-danger">{{$errors->first('province_id')}}</span>
                                @endif
                                @if($errors->has('city_id'))
                                    <br><span class="error-text text-danger">{{$errors->first('city_id')}}</span>
                                @endif
                                @if($errors->has('zipCode'))
                                    <br><span class="error-text text-danger">{{$errors->first('zipCode')}}</span>
                                @endif
                                @if($errors->has('address'))
                                    <br><span class="error-text text-danger">{{$errors->first('address')}}</span>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Deliver Info End-->


@endsection

