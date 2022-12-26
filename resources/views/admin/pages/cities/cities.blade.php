@extends('admin.layouts.master')
@section('title','Dashboard | Cities List')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Cities</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('AdminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Cities</li>
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
                                    <li class="nav-item"><a class="nav-link @if((!$errors->any()) and (Session::missing('success'))) active @endif" href="#list" data-toggle="tab">Cities list</a></li>
                                    <li class="nav-item"><a class="nav-link @if(($errors->any()) or (Session::has('success'))) active @endif" href="#add" data-toggle="tab">Add new city</a></li>
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
                                                            <span class="input-group-text search-table-span">Search by city title: </span>
                                                        </div>
                                                        <input type="text" name="title" required class="search-input form-control" value="{{request()->get('title','')}}" placeholder="Search by city Title" />
                                                    </div>
                                                    @csrf
                                                </div>
                                                <a class='btn btn-success search-btn' href='{{route("CitiesList")}}' id='search_btn'>Search</a>
                                            </form>
                                        </div>
                                        <div id="pagination_data">
                                            @include("admin.pages.cities.getCitiesData",["values"=>$values])
                                        </div>
                                    </div>
                                    <div class="@if(($errors->any()) or (Session::has('success'))) active @endif tab-pane" id="add">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Add city</h3>
                                            </div>
                                            <form method="POST" action="{{route('AddCity')}}">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="input-group mb-0">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">T</span>
                                                        </div>
                                                        <input type="text" class="form-control" name="title" required placeholder="City title">
                                                    </div>
                                                    @if($errors->has('title'))
                                                        <span class="error-text text-danger">{{$errors->first('title')}}</span>
                                                    @endif
                                                    <div class="input-group mb-0 mt-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">P</span>
                                                        </div>
                                                        <select class="form-control select2" name="province_id" required>
                                                            <option selected value="" disabled>Choose province</option>
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
                                                            <span class="input-group-text">S</span>
                                                        </div>
                                                        <select class="form-control city-status" required name="status">
                                                            <option selected value="" disabled>Choose status</option>
                                                            <option value="1">Enable</option>
                                                            <option value="0">Disable</option>
                                                        </select>
                                                    </div>
                                                    @if($errors->has('status'))
                                                        <span class="error-text text-danger">{{$errors->first('status')}}</span>
                                                    @endif
                                                </div>
                                                <div class="card-footer" style="background: none">
                                                    <button type="submit" class="btn btn-info">Save new city</button>
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
