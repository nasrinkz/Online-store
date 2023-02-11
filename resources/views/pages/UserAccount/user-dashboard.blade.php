@extends('layouts.master')
@section('title','NikaStore | Account')
@section('breadcrumb')
    @parent
@section('breadcrumbAppend')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Account</li>
        </ol>
    </nav>
    <h5>Account</h5>
@endsection
@endsection
@section('content')
    <main>
        <!--Acount Area Start -->
        <section class="account">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Dashboard-Nav  Start-->
                        <div class="dashboard-nav">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="{{route('UserDashboard')}}" class="active">Account
                                        settings</a></li>
                                <li class="list-inline-item"><a href="deliver-info.blade.php">Deliver information</a></li>
                                <li class="list-inline-item"><a href="{{route('wishList')}}">My wishlist</a></li>
                                <li class="list-inline-item"><a href="cart.blade.php">My cart</a></li>
                                <li class="list-inline-item"><a href="order.blade.php">Order</a></li>
                                <li class="list-inline-item"><a href="{{route('logout')}}" class="mr-0">Log-out</a></li>
                            </ul>
                        </div>
                        <!-- Dashboard-Nav  End-->
                    </div>
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
                    <div class="col-lg-6 col-md-12">
                        <div class="account-setting">
                            <h6>Account setting</h6>
                            <form action="{{route('UpdateProfile')}}" method="POST">
                                @csrf
                                {{method_field("put")}}
                                <div class="form__div mb-0">
                                    <input type="text" class="form__input" required name="FullName" value="{{$value->FullName}}" placeholder="">
                                    <label for="" class="form__label">Full Name</label>
                                </div>
                                @if($errors->has('FullName'))
                                    <span class="error-text text-danger">{{$errors->first('FullName')}}</span>
                                @endif
                                <div class="form__div mt-15 mb-0">
                                    <input type="email" class="form__input" required name="email" value="{{$value->email}}" placeholder="
                                    ">
                                    <label for="" class="form__label">Email</label>
                                </div>
                                @if($errors->has('email'))
                                    <span class="error-text text-danger">{{$errors->first('email')}}</span>
                                @endif
                                <input type="hidden" name="user_group_id" value="{{$value->user_group_id}}">
                                <div class="form__div mt-15 mb-0">
                                    <button type="submit" class="btn bg-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="change-password">
                            <h6>Change password</h6>
                            <form action="{{route('UpdatePassword')}}" method="POST">
                                @csrf
                                {{method_field("put")}}
                                <div class="form__div mb-0">
                                    <input type="password" class="form__input" required name="currentPassword" placeholder=" ">
                                    <label for="" class="form__label">Current password</label>
                                </div>
                                @if($errors->has('currentPassword'))
                                    <span class="error-text text-danger">{{$errors->first('currentPassword')}}</span>
                                @endif
                                <div class="form__div mt-15 mb-0">
                                    <input type="password" class="form__input" required minlength="6" name="newPassword" placeholder=" ">
                                    <label for="" class="form__label">New passwords</label>
                                </div>
                                @if($errors->has('newPassword'))
                                    <span class="error-text text-danger">{{$errors->first('newPassword')}}</span>
                                @endif
                                <div class="form__div mt-15 mb-0">
                                    <input type="password" class="form__input" required minlength="6" name="password_confirmation" placeholder=" ">
                                    <label for="" class="form__label">Confirm passwords</label>
                                </div>
                                @if($errors->has('password_confirmation'))
                                    <span class="error-text text-danger">{{$errors->first('password_confirmation')}}</span>
                                @endif
                                <div class="form__div mt-15 mb-0">
                                    <button type="submit" class="btn bg-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Acount Area End -->

    </main>
@endsection

