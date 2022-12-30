@extends('layouts.master')
@section('title','NikaStore | Login/Register')
@section('breadcrumb','')
@section('content')
    <main>
    <!-- Account-Login -->
        <section class="account-sign">
        <div class="container">
            @if(Session::has('success'))
                    <div class="alert alert-danger">
                        {{Session::get('success')}}
                    </div>
            @endif
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="account-sign-in">
                        <h5 class="text-center">Sign in</h5>
                        <form action="{{route('login')}}" method="POST">
                            @csrf
                            <div class="form__div mb-0 mt-15">
                                <input type="email" class="form__input" required name="loginEmail" placeholder=" ">
                                <label for="" class="form__label">Email</label>
                            </div>
                            @if($errors->has('loginEmail'))
                                <span class="error-text text-danger">{{$errors->first('loginEmail')}}</span>
                            @endif
                            <div class="form__div mb-0 mt-15">
                                <input type="password" class="form__input" required name="loginPassword" placeholder=" ">
                                <label for="" class="form__label">Password</label>
                            </div>
                            @if($errors->has('loginPassword'))
                                <span class="error-text text-danger">{{$errors->first('loginPassword')}}</span>
                            @endif
                            <div class="password-info d-flex align-items-center justify-content-between flex-wrap">
                                <div class="password-info-show">
                                    <input type="checkbox" value="1" id="showpassagain" name="remember" class="mb-0">
                                    <label for="showpassagain" class="mb-0">Remember me</label>
                                </div>
                            </div>
                            <button type="submit" class="btn bg-primary">Sign in</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="account-sign-up">
                        <h5 class="text-center">Sign up</h5>
                        <form action="{{route('UserAccount')}}" method="POST">
                            @csrf
                            <div class="form__div mb-0">
                                <input type="text" class="form__input" required name="FullName" placeholder=" ">
                                <label for="" class="form__label">Full Name</label>
                            </div>
                            @if($errors->has('FullName'))
                                <span class="error-text text-danger">{{$errors->first('FullName')}}</span>
                            @endif
                            <div class="form__div mb-0 mt-15">
                                <input type="email" class="form__input" required name="email" placeholder=" ">
                                <label for="" class="form__label">Email</label>
                            </div>
                            @if($errors->has('email'))
                                <span class="error-text text-danger">{{$errors->first('email')}}</span>
                            @endif
                            <div class="form__div mb-0 mt-15">
                                <input type="password" class="form__input" required minlength="6" name="password" autocomplete="new-password" />
                                <label for="" class="form__label">Password</label>
                            </div>
                            @if($errors->has('password'))
                                <span class="error-text text-danger">{{$errors->first('password')}}</span>
                            @endif
                            <div class="form__div mb-0 mt-15">
                                <input type="password" class="form__input" required minlength="6" name="password_confirmation">
                                <label for="" class="form__label">Password Confirmation</label>
                            </div>
                            @if($errors->has('password_confirmation'))
                                <span class="error-text text-danger">{{$errors->first('password_confirmation')}}</span>
                            @endif
                            <input type="hidden" name="user_group_id" value="2">
                            <input type="hidden" name="status" value="1">
                            <div class="form__div mb-0  mt-15">
                                <button type="submit" class="btn bg-primary">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </main>
@endsection
