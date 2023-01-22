@extends('admin.layouts.master')
@section('title','Dashboard | Product Edit')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product edit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('AdminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Product edit</li>
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
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <ul class="nav nav-pills">
                                    <li class="nav-item edit-sub-nav-item"><a class="nav-link active" href="#basicInfo" data-toggle="tab">Product info</a></li>
                                    <li class="nav-item edit-sub-nav-item"><a class="nav-link" href="#details" data-toggle="tab">More details</a></li>
                                    <li class="nav-item edit-sub-nav-item"><a class="nav-link" href="#gallery" data-toggle="tab">Gallery</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="tab-content">
                                        <div class="active tab-pane" id="basicInfo">
                                            <div class="card-body">
                                                <form method="POST" action="{{route('UpdateProduct',['id'=>$value->id])}}"  enctype="multipart/form-data">
                                                    @csrf
                                                    {{method_field("put")}}
                                                <div class="input-group mb-0">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Title</span>
                                                    </div>
                                                    <input type="text" class="form-control" required name="title" value="{{$value->title}}" placeholder="Title">
                                                </div>
                                                @if($errors->has('title'))
                                                    <span class="error-text text-danger">{{$errors->first('title')}}</span>
                                                @endif
                                                <div class="input-group mb-0 mt-4">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Description</span>
                                                    </div>
                                                    <textarea class="form-control" name="description" placeholder="Description">{{$value->description}}</textarea>
                                                </div>
                                                <div class="input-group mb-0 mt-4">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Short description</span>
                                                    </div>
                                                    <textarea class="form-control" required name="shortDescription" placeholder="Short description">{{$value->shortDescription}}</textarea>
                                                </div>
                                                @if($errors->has('shortDescription'))
                                                    <span class="error-text text-danger">{{$errors->first('shortDescription')}}</span>
                                                @endif
                                                <div class="input-group mb-0 mt-4">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Original price</span>
                                                    </div>
                                                    <input type="number" class="form-control" required name="originalPrice" value="{{$value->originalPrice}}" placeholder="Original price without discount">
                                                </div>
                                                @if($errors->has('originalPrice'))
                                                    <span class="error-text text-danger">{{$errors->first('originalPrice')}}</span>
                                                @endif
                                                <div class="input-group mb-0 mt-4">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Selling price</span>
                                                    </div>
                                                    <input type="number" class="form-control" required name="sellingPrice" value="{{$value->sellingPrice}}" placeholder="Selling price">
                                                </div>
                                                @if($errors->has('sellingPrice'))
                                                    <span class="error-text text-danger">{{$errors->first('sellingPrice')}}</span>
                                                @endif
                                                <div class="input-group mb-0 mt-4">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Status</span>
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
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Special</span>
                                                        </div>
                                                        <select class="form-control" required name="special">
                                                            <option @if($value->special==1) selected @endif value="1">Yes</option>
                                                            <option @if($value->special==0) selected @endif value="0">No</option>
                                                        </select>
                                                    </div>
                                                    @if($errors->has('special'))
                                                        <span class="error-text text-danger">{{$errors->first('special')}}</span>
                                                    @endif
                                                <div class="input-group mb-0 mt-4">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Category</span>
                                                    </div>
                                                    <select class="form-control select2" name="category_id" required>
                                                        @foreach($categories as $category)
                                                            <option @if($category->id==$value->category_id) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if($errors->has('category_id'))
                                                    <span class="error-text text-danger">{{$errors->first('category_id')}}</span>
                                                @endif
                                                <div class="input-group mb-0 mt-4">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Brand</span>
                                                    </div>
                                                    <select class="form-control select2" name="brand_id" required>
                                                        @foreach($brands as $brand)
                                                            <option @if($brand->id==$value->brand_id) selected @endif value="{{$brand->id}}">{{$brand->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if($errors->has('brand_id'))
                                                    <span class="error-text text-danger">{{$errors->first('brand_id')}}</span>
                                                @endif
                                                <div class="input-group mb-0 mt-4">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Color</span>
                                                    </div>
                                                    <select class="form-control select2" name="color_id[]" id="editColors" required multiple="multiple" data-placeholder="Select color">
                                                        @foreach($colors as $color)
                                                            <option <?php if (in_array($color->id,$colorsID)) { echo "selected"; } ?> value="{{$color->id}}">{{$color->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if($errors->has('color_id'))
                                                    <span class="error-text text-danger">{{$errors->first('color_id')}}</span>
                                                @endif
                                                <div class="input-group mb-0 mt-4">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Size</span>
                                                    </div>
                                                    <select class="form-control select2" name="size_id[]" id="editSizes" required multiple="multiple" data-placeholder="Select size">
                                                        @foreach($sizes as $size)
                                                            <option <?php if (in_array($size->id,$sizesID)) { echo "selected"; } ?> value="{{$size->id}}">{{$size->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if($errors->has('color_id'))
                                                    <span class="error-text text-danger">{{$errors->first('color_id')}}</span>
                                                @endif
                                            </div>
                                            <div class="card-footer" style="background: none">
                                                <button type="submit" class="btn btn-info">Save changes</button>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="details">
                                            <div class="card-body">
                                                <div id="colorsQuantity">
                                                    <span> Colors quantity: </span>
                                                    @foreach($value->colorsTable as $color)
                                                        <div class='input-group mb-0 mt-4'>
                                                            <div class='input-group-prepend'>
                                                        <span class='input-group-text'>{{'Quantity available for '.$color->color->title.' color: '}}
                                                        </span>
                                                            </div>
                                                            <input class='form-control' type='number' value="{{$color->number}}" required placeholder='Quantity' id="{{'colorNumber'.$color->color_id}}" name="{{'colorNumber'.$color->color_id}}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <hr>
                                                <div id="sizesQuantity">
                                                    <span> Sizes quantity: </span>
                                                    @foreach($value->sizesTable as $size)
                                                        <div class='input-group mb-0 mt-4'>
                                                            <div class='input-group-prepend'>
                                                        <span class='input-group-text'>{{'Quantity available for '.$size->size->title.' size: '}}
                                                        </span>
                                                            </div>
                                                            <input class='form-control' type='number' value="{{$size->number}}" required placeholder='Quantity' id="{{'sizeNumber'.$size->size_id}}" name="{{'sizeNumber'.$size->size_id}}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    <div class="tab-pane" id="gallery">
                                        <div class="card-body">
                                            @foreach ($value->images as $img)
                                                <div style="padding: 10px;">
                                                    <img src="{{asset($img->image)}}" class="img-responsive" style="max-height: 120px; max-width: 120px; display: inline-block" alt="" srcset="">
                                                    <form action="{{route('DeleteProductImage',['id'=>$img->id])}}" method="post" style="display: inline-block">
                                                        @csrf
                                                        <button class="btn text-danger" title="Delete this image" >Delete this image</button>
                                                    </form>
                                                </div>
                                            @endforeach
                                            <form method="POST" action="{{route('UpdateProductGallery',['id'=>$value->id])}}"  enctype="multipart/form-data">
                                                @csrf
                                                {{method_field("put")}}
                                                <div class="input-group mb-0 mt-4">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" accept="image/png, image/jpg, image/jpeg, image/svg" value="{{$value->images}}" name="image[]" id="customFile" multiple>
                                                        <label class="custom-file-label" for="customFile">Choose more images</label>
                                                    </div>
                                                </div>
                                                @if($errors->has('image'))
                                                    <span class="error-text text-danger">{{$errors->first('image')}}</span>
                                                @endif
                                                <div class="input-group mb-0 mt-4">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="cover" value="{{$value->cover}}" id="customFile" onchange="loadPreview(this);">
                                                        <label class="custom-file-label" for="customFile">Choose cover image</label>
                                                    </div>
                                                </div>
                                                <img id="preview_img" src="{{asset($value->cover)}}" class="mt-4" width="150" height="150">
                                                @if($errors->has('cover'))
                                                    <span class="error-text text-danger">{{$errors->first('cover')}}</span>
                                                @endif
                                                <div style="background: none;margin-top: 20px">
                                                    <button type="submit" class="btn btn-info">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
