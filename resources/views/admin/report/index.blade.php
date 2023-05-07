@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách báo cáo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Report</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách báo cáo</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vấn đề</th>
                        <th>Mô tả chi tiết</th>
                        <th>Bài đăng</th>
                        <th>Người báo cáo</th>
                        <th>Số điện thoại</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $report)
                    <tr>
                        <td>{{$report->id}}</td>
                        <td>{{$report->title}}</td>
                        <td>{{$report->description}}</td>
                        <td><a href="{{route('room',['id' => $report->room_id])}}">{{$report->room_id}}</a></td>
                        <td>{{$report->fullname}}</td>
                        <td>{{$report->phone}}</td>
                    </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@stop
