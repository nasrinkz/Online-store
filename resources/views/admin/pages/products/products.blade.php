@extends('admin.layouts.master')
@section('title','Dashboard | Products List')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('AdminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
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
                                    <li class="nav-item"><a class="nav-link @if((!$errors->any()) and (Session::missing('success'))) active @endif" href="#list" data-toggle="tab">Products list</a></li>
                                    <li class="nav-item"><a class="nav-link @if(($errors->any()) or (Session::has('success'))) active @endif" href="#add" data-toggle="tab">Add new product</a></li>
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
                                                        <input type="text" required name="title" class="search-input form-control" value="{{request()->get('title','')}}" placeholder="Search by product title" />
                                                        <input type="number" required name="sellingPrice" class="search-input form-control" value="{{request()->get('email','')}}" placeholder="Search by selling price" style="margin-left: 5px"/>
                                                        <select class="search-input form-control select2" name="category_id" required>
                                                            <option selected value="">All category</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @csrf
                                                </div>
                                                <a class='btn btn-success search-btn' href='{{route("ProductsList")}}' id='search_btn'>Search</a>
                                            </form>
                                        </div>
                                        <div id="pagination_data">
                                            @include("admin.pages.products.getProductsData",["values"=>$values])
                                        </div>
                                    </div>
                                    <div class="@if(($errors->any()) or (Session::has('success'))) active @endif tab-pane" id="add">
                                        <div class="card-header p-2">
                                            <ul class="nav nav-pills">
                                                <li class="nav-item sub-nav-item"><a class="nav-link active" href="#basicInfo" data-toggle="tab">Product info</a></li>
                                                <li class="nav-item sub-nav-item"><a class="nav-link" href="#details" data-toggle="tab">More details</a></li>
                                                <li class="nav-item sub-nav-item"><a class="nav-link" href="#gallery" data-toggle="tab">Gallery</a></li>
                                            </ul>
                                        </div><!-- /.card-header -->
                                        <form method="POST" action="{{route('AddProduct')}} "enctype="multipart/form-data">
                                            @csrf
                                                <div class="card-body">
                                                    <div class="tab-content">
                                                        <div class="active tab-pane" id="basicInfo">
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
                                                                    <textarea class="form-control" required name="description" placeholder="Description"></textarea>
                                                                </div>
                                                                @if($errors->has('description'))
                                                                    <span class="error-text text-danger">{{$errors->first('description')}}</span>
                                                                @endif
                                                                <div class="input-group mb-0 mt-4">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">ShD</span>
                                                                    </div>
                                                                    <textarea class="form-control" required name="shortDescription" placeholder="Short description"></textarea>
                                                                </div>
                                                                @if($errors->has('shortDescription'))
                                                                    <span class="error-text text-danger">{{$errors->first('shortDescription')}}</span>
                                                                @endif
                                                                <div class="input-group mb-0 mt-4">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">P</span>
                                                                    </div>
                                                                    <input type="number" class="form-control" required name="originalPrice" placeholder="Original price without discount">
                                                                </div>
                                                                @if($errors->has('originalPrice'))
                                                                    <span class="error-text text-danger">{{$errors->first('originalPrice')}}</span>
                                                                @endif
                                                                <div class="input-group mb-0 mt-4">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">S</span>
                                                                    </div>
                                                                    <input type="number" class="form-control" required name="sellingPrice" placeholder="Selling price">
                                                                </div>
                                                                @if($errors->has('sellingPrice'))
                                                                    <span class="error-text text-danger">{{$errors->first('sellingPrice')}}</span>
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
                                                                <div class="input-group mb-0 mt-4">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">C</span>
                                                                    </div>
                                                                    <select class="form-control select2" name="category_id" required>
                                                                        <option selected value="" disabled>Choose category</option>
                                                                        @foreach($categories as $category)
                                                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @if($errors->has('category_id'))
                                                                    <span class="error-text text-danger">{{$errors->first('category_id')}}</span>
                                                                @endif
                                                                <div class="input-group mb-0 mt-4">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">B</span>
                                                                    </div>
                                                                    <select class="form-control select2" name="brand_id" required>
                                                                        <option selected value="" disabled>Choose brand</option>
                                                                        @foreach($brands as $brand)
                                                                            <option value="{{$brand->id}}">{{$brand->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @if($errors->has('brand_id'))
                                                                    <span class="error-text text-danger">{{$errors->first('brand_id')}}</span>
                                                                @endif
                                                                <div class="input-group mb-0 mt-4">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">C</span>
                                                                    </div>
                                                                    <select class="form-control select2" name="color_id[]" id="colors" required multiple="multiple" data-placeholder="Select color">
                                                                        @foreach($colors as $color)
                                                                            <option value="{{$color->id}}">{{$color->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @if($errors->has('color_id'))
                                                                    <span class="error-text text-danger">{{$errors->first('color_id')}}</span>
                                                                @endif
                                                                <div class="input-group mb-0 mt-4">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">S</span>
                                                                    </div>
                                                                    <select class="form-control select2" name="size_id[]" id="sizes" required multiple="multiple" data-placeholder="Select size">
                                                                        @foreach($sizes as $size)
                                                                            <option value="{{$size->id}}">{{$size->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @if($errors->has('size_id'))
                                                                    <span class="error-text text-danger">{{$errors->first('size_id')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- /.tab-pane -->
                                                        <div class="tab-pane" id="details">
                                                            <div class="card-body">
                                                                <div id="colorsQuantity">
                                                                </div>
                                                                <div id="sizesQuantity">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="gallery">
                                                            <div class="card-body">
                                                                <div class="input-group mb-0 mt-4">
                                                                    <div class="custom-file">
                                                                        <input type="file" required class="custom-file-input" accept="image/png, image/jpg, image/jpeg, image/svg" name="cover" id="customFile" onchange="loadPreview(this);">
                                                                        <label class="custom-file-label" for="customFile">Choose cover image</label>
                                                                    </div>
                                                                </div>
                                                                <img id="preview_img" class="mt-4">
                                                                @if($errors->has('cover'))
                                                                    <span class="error-text text-danger">{{$errors->first('cover')}}</span>
                                                                @endif
                                                                <div class="input-group mb-0 mt-4">
                                                                    <div class="custom-file">
                                                                        <input type="file" required class="custom-file-input" accept="image/png, image/jpg, image/jpeg, image/svg" name="image[]" id="customFile" multiple>
                                                                        <label class="custom-file-label" for="customFile">Choose images</label>
                                                                    </div>
                                                                </div>
                                                                @if($errors->has('image'))
                                                                    <span class="error-text text-danger">{{$errors->first('image')}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="card-footer" style="background: none">
                                                                <button type="submit" title="please fill all fields: product info, details, images" class="btn btn-info">Save new product</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.tab-pane -->
                                                    </div>
                                                    <!-- /.tab-content -->
                                                </div><!-- /.card-body -->
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
