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
                        <h1>Provinces</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('AdminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Provinces</li>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link @if(!$errors->any()) active @endif" href="#list" data-toggle="tab">Provinces list</a></li>
                                    <li class="nav-item"><a class="nav-link @if($errors->any()) active @endif" href="#add" data-toggle="tab">Add new province</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="@if(!$errors->any()) active @endif tab-pane" id="list">
                                        <div id="search">
                                            <form id="searchform" name="searchform">
                                                <div class="form-group" style="display: inline-block">
                                                    <div class="input-group mb-0">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" style="background: none; border: none;">Search by title: </span>
                                                        </div>
                                                        <input type="text" name="title" style="border-radius:5px" class="form-control" value="{{request()->get('title','')}}" placeholder="Search by Title" />
                                                    </div>
                                                    @csrf
                                                </div>
                                                <a class='btn btn-success' style="display: inline-block;margin-bottom: 3px;" href='{{route("CitiesList")}}' id='search_btn'>Search</a>
                                            </form>
                                        </div>
                                        <div id="pagination_data">
                                            @include("admin.pages.cities.getCitiesData",["values"=>$values])
                                        </div>
                                    </div>
                                    <div class="@if($errors->any()) active @endif tab-pane" id="add">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Add province</h3>
                                            </div>
                                            <form method="POST" action="{{route('AddProvince')}}">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="input-group mb-0">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">T</span>
                                                        </div>
                                                        <input type="text" class="form-control" name="title" placeholder="Title">
                                                    </div>
                                                    @if($errors->has('title'))
                                                        <span class="error-text text-danger">{{$errors->first('title')}}</span>
                                                    @endif
                                                    <div class="input-group mb-0 mt-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">S</span>
                                                        </div>
                                                        <select class="form-control" name="status">
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
                                                    <button type="submit" class="btn btn-info">Save new province</button>
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
