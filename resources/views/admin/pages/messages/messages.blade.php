@extends('admin.layouts.master')
@section('title','Dashboard | Contact us messages List')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contact us messages</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('AdminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Messages</li>
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
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div id="search">
                                        <form id="searchform" name="searchform">
                                            <div class="form-group search-form-group">
                                                <div class="input-group mb-0">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text search-table-span">Search by message: </span>
                                                    </div>
                                                    <input type="text" required name="message" class="search-input form-control" value="{{request()->get('message','')}}" placeholder="Message" />
                                                </div>
                                                @csrf
                                            </div>
                                            <a class='btn btn-success search-btn' href='{{route("MessagesList")}}' id='search_btn'>Search</a>
                                        </form>
                                    </div>
                                    <div id="pagination_data">
                                        @include("admin.pages.messages.getMessagesData",["values"=>$values])
                                    </div>
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
