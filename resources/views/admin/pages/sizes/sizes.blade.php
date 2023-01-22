@extends('admin.layouts.master')
@section('title','Dashboard | Sizes List')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sizes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('AdminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Sizes</li>
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
                                    <li class="nav-item"><a class="nav-link @if((!$errors->any()) and (Session::missing('success'))) active @endif" href="#list" data-toggle="tab">Sizes list</a></li>
                                    <li class="nav-item"><a class="nav-link @if(($errors->any()) or (Session::has('success'))) active @endif" href="#add" data-toggle="tab">Add new size</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="@if((!$errors->any()) and (Session::missing('success'))) active @endif tab-pane" id="list">
                                        <div id="pagination_data">
                                            @include("admin.pages.sizes.getSizesData",["values"=>$values])
                                        </div>
                                    </div>
                                    <div class="@if(($errors->any()) or (Session::has('success'))) active @endif tab-pane" id="add">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Add size</h3>
                                            </div>
                                            <form method="POST" action="{{route('AddSize')}}">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="input-group mb-0">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">T</span>
                                                        </div>
                                                        <input type="text" class="form-control" required name="title" placeholder="Title like: Large">
                                                    </div>
                                                    @if($errors->has('title'))
                                                        <span class="error-text text-danger">{{$errors->first('title')}}</span>
                                                    @endif
                                                    <div class="input-group mb-0 mt-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">S</span>
                                                        </div>
                                                        <input type="text" class="form-control" required name="symbol" placeholder="Symbol like: L">
                                                    </div>
                                                    @if($errors->has('symbol'))
                                                        <span class="error-text text-danger">{{$errors->first('symbol')}}</span>
                                                    @endif
                                                    <div class="input-group mb-0 mt-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">S</span>
                                                        </div>
                                                        <select class="form-control" required name="status">
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
                                                    <button type="submit" class="btn btn-info">Save new size</button>
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
