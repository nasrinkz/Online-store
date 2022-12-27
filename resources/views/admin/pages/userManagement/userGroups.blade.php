@extends('admin.layouts.master')
@section('title','Dashboard | User Groups List')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User groups</h1>
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
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Role</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($num=1)
                                        @foreach($values as $value)
                                            <tr>
                                                <td scope="row">{{$num}}</td>
                                                <td>{{$value->role}}</td>
                                                <td>{{$value->description}}</td>
                                                <td>@if($value->status== 1)<i id="{{$value->id}}" class='fa fa-check text-success'> Enable</i> @else <i id="{{$value->id}}" class='fa fa-ban text-danger'> Disable</i>@endif</td>
                                            </tr>
                                            @php($num++)
                                        @endforeach
                                        </tbody>
                                    </table>
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
