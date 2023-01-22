@extends('admin.layouts.master')
@section('title','Dashboard | Coupons List')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Coupons</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('AdminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Coupons</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- IMain content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif
                        @if(Session::has('delete'))
                            <div class="alert alert-success">
                                {{Session::get('delete')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link @if((!$errors->any()) and (Session::missing('success'))) active @endif" href="#list" data-toggle="tab">Coupons list</a></li>
                                    <li class="nav-item"><a class="nav-link @if(($errors->any()) or (Session::has('success'))) active @endif" href="#add" data-toggle="tab">Add new coupon</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="@if((!$errors->any()) and (Session::missing('success'))) active @endif tab-pane" id="list">
                                        <div id="search">
                                            <form id="searchform" name="searchform">
                                                <div class="form-group search-form-group">
                                                    <div class="input-group mb-0">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text search-table-span">Search: </span>
                                                        </div>
                                                        <input type="text" required name="title" class="search-input form-control" value="{{request()->get('title','')}}" placeholder="Search by title" />
                                                        <input type="text" required name="code" class="search-input form-control" value="{{request()->get('email','')}}" placeholder="Search by code" style="margin-left: 5px"/>
                                                    </div>
                                                    @csrf
                                                </div>
                                                <a class='btn btn-success search-btn' href='{{route("CouponsList")}}' id='search_btn'>Search</a>
                                            </form>
                                        </div>
                                        <div id="pagination_data">
                                            @include("admin.pages.coupons.getCouponsData",["values"=>$values])
                                        </div>
                                    </div>
                                    <div class="@if(($errors->any()) or (Session::has('success'))) active @endif tab-pane" id="add">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Add coupon</h3>
                                            </div>
                                            <form method="POST" action="{{route('AddCoupon')}}" onsubmit="return coupon_validation()">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group mb-0">
                                                        <label>Coupon title</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">T</span>
                                                            </div>
                                                            <input type="text" class="form-control" id="title" required name="title" placeholder="Title">
                                                        </div>
                                                        @if($errors->has('title'))
                                                            <span class="error-text text-danger">{{$errors->first('title')}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group mb-0 mt-4">
                                                        <label>Coupon code</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">C</span>
                                                            </div>
                                                            <input type="text" class="form-control" id="code" required name="code" placeholder="Code">
                                                        </div>
                                                        @if($errors->has('code'))
                                                            <span class="error-text text-danger">{{$errors->first('code')}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group mb-0 mt-4">
                                                        <label>Start date</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                            </div>
                                                            <input type="datetime-local" class="form-control" id="startDate" required name="startDate" value="{{date('Y-m-d H:i:s')}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-0 mt-4">
                                                        <label>Expire date</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                            </div>
                                                            <input type="datetime-local" class="form-control" id="expireDate" name="expireDate" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-0 mt-4">
                                                        <label>Status</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">S</span>
                                                            </div>
                                                            <select class="form-control" required id="status" name="status">
                                                                <option selected value="" disabled>Choose status</option>
                                                                <option value="1">Enable</option>
                                                                <option value="0">Disable</option>
                                                            </select>
                                                        </div>
                                                        @if($errors->has('status'))
                                                            <span class="error-text text-danger">{{$errors->first('status')}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="card-footer" style="background: none">
                                                    <button type="submit" class="btn btn-info">Save new coupon</button>
                                                </div>
                                                <div class="ml-4 mt-1 mb-3">
                                                    <span class="error-text text-danger" id="form_alert">{{$errors->first('status')}}</span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
