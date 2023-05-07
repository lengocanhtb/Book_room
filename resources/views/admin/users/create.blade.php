@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tạo Người Dùng Mới</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.users.create')}}">Người Dùng</a></li>
                        <li class="breadcrumb-item active">Tạo Người Dùng</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <form method="post" id="form-submit" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body" >
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-6">
                            <input type="text" name="email" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Tên Người Dùng</label>
                        <div class="col-6">
                            <input type="text" name="username" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Họ Và Tên</label>
                        <div class="col-6">
                            <input type="text" name="fullname" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Số Điện Thoại</label>
                        <div class="col-6">
                            <input type="text" name="telephone" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <div class="mb-3 col-2 row">
                        <button type="submit" class="btn btn-success mb-5 btn-lg btn-block">Tạo Mới</button>
                    </div>
                </div>
            </form>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@stop
