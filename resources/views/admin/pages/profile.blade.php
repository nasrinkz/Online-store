@extends('admin.layouts.master')
@section('title','Dashboard | Profile')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('AdminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
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
                    <div class="col-md-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Profile setting</h3>
                            </div>
                            <form method="POST" action="{{route('UpdateAdminProfile')}}">
                                @csrf
                                {{method_field("put")}}
                                <div class="card-body">
                                    <div class="input-group mb-0">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">FN</span>
                                        </div>
                                        <input type="text" class="form-control" required name="FullName" value="{{$value->FullName}}" placeholder="FullName">
                                    </div>
                                    @if($errors->has('FullName'))
                                        <span class="error-text text-danger">{{$errors->first('FullName')}}</span>
                                    @endif
                                    <div class="input-group mb-0 mt-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" required name="email" value="{{$value->email}}" placeholder="Email">
                                    </div>
                                    @if($errors->has('email'))
                                        <span class="error-text text-danger">{{$errors->first('email')}}</span>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="user_group_id" value="{{$value->user_group_id}}">
                                    <button type="submit" class="btn btn-info">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Change password</h3>
                            </div>
                            <form method="POST" action="{{route('UpdateAdminPassword')}}">
                                @csrf
                                {{method_field("put")}}
                                <div class="card-body">
                                    <div class="input-group mb-0">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" required minlength="6" name="currentPassword" placeholder="Current Password">
                                    </div>
                                    @if($errors->has('currentPassword'))
                                        <span class="error-text text-danger">{{$errors->first('currentPassword')}}</span>
                                    @endif
                                    <div class="input-group mb-0 mt-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control" required minlength="6" name="newPassword" placeholder="New Password">
                                    </div>
                                    @if($errors->has('newPassword'))
                                        <span class="error-text text-danger">{{$errors->first('newPassword')}}</span>
                                    @endif
                                    <div class="input-group mb-0 mt-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control" required minlength="6" name="password_confirmation" placeholder="Password Confirmation">
                                    </div>
                                    @if($errors->has('password_confirmation'))
                                        <span class="error-text text-danger">{{$errors->first('password_confirmation')}}</span>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
