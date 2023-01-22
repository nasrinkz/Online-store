@extends('admin.layouts.master')
@section('title','Dashboard | Brands List')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Brands</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('AdminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Brands</li>
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
                                    <li class="nav-item"><a class="nav-link @if((!$errors->any()) and (Session::missing('success'))) active @endif" href="#list" data-toggle="tab">Brands list</a></li>
                                    <li class="nav-item"><a class="nav-link @if(($errors->any()) or (Session::has('success'))) active @endif" href="#add" data-toggle="tab">Add new brand</a></li>
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
                                                            <span class="input-group-text search-table-span">Search by title: </span>
                                                        </div>
                                                        <input type="text" required name="title" class="search-input form-control" value="{{request()->get('title','')}}" placeholder="Search ..." />
                                                    </div>
                                                    @csrf
                                                </div>
                                                <a class='btn btn-success search-btn' href='{{route("BrandsList")}}' id='search_btn'>Search</a>
                                            </form>
                                        </div>
                                        <div id="pagination_data">
                                            @include("admin.pages.brands.getBrandsData",["values"=>$values])
                                        </div>
                                    </div>
                                    <div class="@if(($errors->any()) or (Session::has('success'))) active @endif tab-pane" id="add">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Add brand</h3>
                                            </div>
                                            <form method="POST" action="{{route('AddBrand')}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="input-group mb-0">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">T</span>
                                                        </div>
                                                        <input type="text" class="form-control" required name="title" placeholder="Title">
                                                    </div>
                                                    @if($errors->has('title'))
                                                        <span class="error-text text-danger">{{$errors->first('title')}}</span>
                                                    @endif
                                                    <div class="input-group mb-0 mt-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">D</span>
                                                        </div>
                                                        <textarea class="form-control" name="description" placeholder="Description"></textarea>
                                                    </div>
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
                                                    <div class="input-group mb-0 mt-4">
                                                        <div class="custom-file">
                                                            <input type="file" required class="custom-file-input" accept="image/png, image/jpg, image/jpeg, image/svg" name="image" id="customFile" onchange="loadPreview(this);">
                                                            <label class="custom-file-label" for="customFile">Choose image</label>
                                                        </div>
                                                    </div>
                                                    <img id="preview_img" class="mt-4">
                                                    @if($errors->has('image'))
                                                        <span class="error-text text-danger">{{$errors->first('image')}}</span>
                                                    @endif
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-info">Save new brand</button>
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
