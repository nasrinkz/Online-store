@extends('admin.layouts.master')
@section('title','Dashboard | Create address')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create address</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('AdminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Create address</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Create address</h3>
                            </div>
                            <form method="POST" action="{{route('UpdateUserAddress',['id'=>$id])}}">
                                @csrf
                                {{method_field("put")}}
                                <div class="card-body">
                                    <div class="input-group mb-0 mt-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Province</span>
                                        </div>
                                        <select class="form-control select2" name="province_id">
                                            <option value="" disabled selected>Select province</option>
                                            @foreach($provinces as $province)
                                                <option value="{{$province->id}}">{{$province->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if($errors->has('province_id'))
                                        <span class="error-text text-danger">{{$errors->first('province_id')}}</span>
                                    @endif
                                    <div class="input-group mb-0 mt-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">City</span>
                                        </div>
                                        <select class="form-control select2" name="city_id">
                                            <option value="" disabled selected>Select city</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{$city->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if($errors->has('city_id'))
                                        <span class="error-text text-danger">{{$errors->first('city_id')}}</span>
                                    @endif
                                    <div class="input-group mb-0 mt-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Address</span>
                                        </div>
                                        <textarea class="form-control" required name="address"></textarea>
                                    </div>
                                    @if($errors->has('address'))
                                        <span class="error-text text-danger">{{$errors->first('address')}}</span>
                                    @endif
                                    <div class="input-group mb-0 mt-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Zip code</span>
                                        </div>
                                        <input type="tel" class="form-control" required name="zipCode" placeholder="zip code">
                                    </div>
                                    @if($errors->has('zipCode'))
                                        <span class="error-text text-danger">{{$errors->first('zipCode')}}</span>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Save address</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
