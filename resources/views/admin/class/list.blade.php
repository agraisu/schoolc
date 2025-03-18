@extends('layouts.header')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ !empty($header_title) ? $header_title : '' }} - School</title>
        @include('allcss')
        @include('alljs')
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Class List</h1>
                            </div>
                            <div class="col-sm-6" style="text-align: right">
                                <a href="{{ url('admin/class/add') }}" class="btn btn-primary">Add New Class</a>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                {{-- @include('_message') --}}
                                <!-- general form elements -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Search Class</h3>
                                    </div>
                                    <form method="get" action="">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ Request::get('name') }}" placeholder="Name">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Date</label>
                                                    <input type="date" class="form-control" name="date"
                                                        value="{{ Request::get('date') }}" placeholder="Email">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <button class="btn btn-primary" type="submit"
                                                        style="margin-top: 30px">Search</button>
                                                    <a href="{{ url('admin/class/list') }}" class="btn btn-success"
                                                        style="margin-top: 30px">Reset</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </form>
                                </div>
                                <!-- /.card -->
                                @include('_message')
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Class List</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th>Created By</th>
                                                    <th>Created Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($getRecord as $value)
                                                    <tr>
                                                        <td>{{ $value->id }}</td>
                                                        <td>{{ $value->name }}</td>
                                                        <td>
                                                            @if($value->status == 0)
                                                                <span class="badge badge-success" style="font-size: 14px;height: 20px;width: 62px">Active</span>
                                                            @else
                                                                <span class="badge badge-secondary" style="font-size: 14px;height: 20px;width: 60px">InActive</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $value->created_by_name }}</td>
                                                        <td>{{ date('d-m-y H:i A', strtotime($value->created_at)) }}</td>
                                                        <td>
                                                            <a href="{{ url('admin/class/edit' . $value->id) }}"
                                                                class="btn btn-warning">Edit</a>
                                                            <a href="{{ url('admin/class/delete' . $value->id) }}"
                                                                class="btn btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div style="padding: 10px; float: right;">
                                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
    </body>

    </html>
@endsection
