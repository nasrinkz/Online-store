@extends('admin.layouts.master')
@section('title','Dashboard | Coupon Edit')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Coupon edit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('AdminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Coupon edit</li>
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
                        @if(Session::has('alert'))
                            <div class="alert alert-danger">
                                {{Session::get('alert')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Edit coupon</h3>
                            </div>
                            <form method="POST" action="{{route('UpdateCoupon',['id'=>$value->id])}}" onsubmit="return coupon_validation()">
                                @csrf
                                {{method_field("put")}}
                                <div class="card-body">
                                    <div class="input-group mb-0">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Title</span>
                                        </div>
                                        <input type="text" class="form-control" required id="title" name="title" value="{{$value->title}}" placeholder="Title">
                                    </div>
                                    @if($errors->has('title'))
                                        <span class="error-text text-danger">{{$errors->first('title')}}</span>
                                    @endif
                                    <div class="input-group mb-0 mt-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Code</span>
                                        </div>
                                        <input type="text" class="form-control" required id="code" name="code" value="{{$value->code}}" placeholder="Code">
                                    </div>
                                    @if($errors->has('code'))
                                        <span class="error-text text-danger">{{$errors->first('code')}}</span>
                                    @endif
                                    <div class="input-group mb-0 mt-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Start date</span>
                                        </div>
                                        <input type="datetime-local" class="form-control" id="startDate" required name="startDate" value="{{$value->startDate}}">
                                    </div>
                                    <div class="input-group mb-0 mt-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Expire date</span>
                                        </div>
                                        <input type="datetime-local" class="form-control" id="expireDate" name="expireDate" value="{{$value->expireDate}}">
                                    </div>
                                    <div class="input-group mb-0 mt-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Status</span>
                                        </div>
                                        <select class="form-control" name="status">
                                            <option value="1" @if($value->status==1) selected @endif>Enable</option>
                                            <option value="0" @if($value->status==0) selected @endif>Disable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer" style="background: none">
                                    <button type="submit" class="btn btn-info">Save changes</button>
                                </div>
                                <div class="ml-4 mt-1 mb-3">
                                    <span class="error-text text-danger" id="form_alert">{{$errors->first('status')}}</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
