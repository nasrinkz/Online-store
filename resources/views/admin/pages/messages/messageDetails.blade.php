@extends('admin.layouts.master')
@section('title','Dashboard | Contact us messages Details')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Message details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('AdminDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Message details</li>
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
                                    <div class="row">
                                        <!-- ./col -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Full name</dt>
                                                        <dd class="col-sm-8">{{$value->fullName}}</dd>
                                                        <dt class="col-sm-4">Mobile number</dt>
                                                        <dd class="col-sm-8">{{$value->number}}</dd>
                                                        <dt class="col-sm-4">Email</dt>
                                                        <dd class="col-sm-8">{{$value->email}}</dd>
                                                        <dt class="col-sm-4">Message</dt>
                                                        <dd class="col-sm-8">{{$value->message}}
                                                        </dd>
                                                    </dl>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- ./col -->
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
