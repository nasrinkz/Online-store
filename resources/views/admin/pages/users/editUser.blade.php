@extends('admin.layouts.master')
@section('title','Dashboard | User Edit')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User edit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('AdminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">User edit</li>
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
                                <h3 class="card-title">Edit User</h3>
                            </div>
                            <form method="POST" action="{{route('UpdateUser',['id'=>$value->id])}}">
                                @csrf
                                {{method_field("put")}}
                                <div class="card-body">
                                    <div class="input-group mb-0">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Full name</span>
                                        </div>
                                        <input type="text" class="form-control" required name="FullName" value="{{$value->FullName}}" placeholder="FullName">
                                    </div>
                                    @if($errors->has('FullName'))
                                        <span class="error-text text-danger">{{$errors->first('FullName')}}</span>
                                    @endif
                                    <div class="input-group mb-0 mt-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Email</span>
                                        </div>
                                        <input type="email" class="form-control" required name="email" value="{{$value->email}}" placeholder="email">
                                    </div>
                                    @if($errors->has('email'))
                                        <span class="error-text text-danger">{{$errors->first('email')}}</span>
                                    @endif
                                    <div class="input-group mb-0 mt-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Role</span>
                                        </div>
                                        <select class="form-control" name="user_group_id" >
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}" @if($role->id==$value->user_group_id) selected @endif>{{$role->role}}</option>
                                            @endforeach
                                        </select>
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
