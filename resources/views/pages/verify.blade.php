@extends('layouts.master')
@section('title','NikaStore | Verify')
@section('breadcrumb','')
@section('content')
    <main>
        <!-- Verify Email Section Start -->
        <section class="verify-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="verify-area-email">
                            <div class="text">
                                <h5>Verify email</h5>
                                <p>
                                    We send a verification code on you email inbox. To activated your account verify
                                    your email.
                                    <a href="#">Resend verification code</a>
                                </p>
                            </div>
                            <div class="verify">
                                <form action="#">
                                    <div
                                        class="verify-input d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="box-input">
                                            <input type="text" name="box-input" id="input" maxlength="1">
                                        </div>
                                        <div class="box-input">
                                            <input type="text" name="box-input" id="input" maxlength="1">
                                        </div>
                                        <div class="box-input">
                                            <input type="text" name="box-input" id="input" maxlength="1">
                                        </div>
                                        <div class="box-input">
                                            <input type="text" name="box-input" id="input" maxlength="1">
                                        </div>
                                        <div class="box-input">
                                            <input type="text" name="box-input" id="input" maxlength="1">
                                        </div>
                                        <div class="box-input">
                                            <input type="text" name="box-input" id="input" maxlength="1">
                                        </div>
                                    </div>
                                    <button>Verify email</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Verify Email Section End -->
    </main>
@endsection
