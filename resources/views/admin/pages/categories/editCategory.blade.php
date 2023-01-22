@extends('admin.layouts.master')
@section('title','Dashboard | Category Edit')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Category edit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('AdminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Category edit</li>
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
                                <h3 class="card-title">Edit category</h3>
                            </div>
                            <form method="POST" action="{{route('UpdateCategory',['id'=>$value->id])}}"  enctype="multipart/form-data">
                                @csrf
                                {{method_field("put")}}
                                <div class="card-body">
                                    <div class="input-group mb-0">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">T</span>
                                        </div>
                                        <input type="text" class="form-control" required name="title" value="{{$value->title}}" placeholder="Title">
                                    </div>
                                    @if($errors->has('title'))
                                        <span class="error-text text-danger">{{$errors->first('title')}}</span>
                                    @endif
                                    <div class="input-group mb-0 mt-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">D</span>
                                        </div>
                                        <textarea class="form-control" name="description" placeholder="Description">{{$value->description}}</textarea>
                                    </div>
                                    <div class="input-group mb-0 mt-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">S</span>
                                        </div>
                                        <select class="form-control" required name="status">
                                            <option @if($value->status==1) selected @endif value="1">Enable</option>
                                            <option @if($value->status==0) selected @endif value="0">Disable</option>
                                        </select>
                                    </div>
                                    @if($errors->has('status'))
                                        <span class="error-text text-danger">{{$errors->first('status')}}</span>
                                    @endif
                                    <div class="input-group mb-0 mt-4">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" value="{{$value->image}}" id="customFile" onchange="loadPreview(this);">
                                            <label class="custom-file-label" for="customFile">Choose image</label>
                                        </div>
                                    </div>
                                    <img id="preview_img" src="{{asset($value->image)}}" class="mt-4" width="150" height="150">
                                    @if($errors->has('image'))
                                        <span class="error-text text-danger">{{$errors->first('image')}}</span>
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
