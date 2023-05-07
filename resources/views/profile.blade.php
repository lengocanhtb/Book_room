@extends('layouts.master')

@section('title', 'Booking room')

@section('style-libraries')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@stop

@section('styles')
<link rel="stylesheet" href="homepage/css/homepage.css" />
@stop

@section('content')
    <form action="{{route('updateProfile')}}" method="post">
        @csrf
        <div class="container justify-content-center">
            <h1 class="h2">Cập nhật thông tin cá nhân</h1>

        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-6">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                    value="{{\Illuminate\Support\Facades\Auth::user()->email}}">
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Tên Người Dùng</label>
                <div class="col-6">
                    <input type="text" name="username" class="form-control" id="inputPassword" value="{{\Illuminate\Support\Facades\Auth::user()->username}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Họ Và Tên</label>
                <div class="col-6">
                    <input type="text" name="fullname" class="form-control" id="inputPassword" value="{{\Illuminate\Support\Facades\Auth::user()->fullname}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Quyền</label>
                <div class="col-6">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{\Illuminate\Support\Facades\Auth::user()->role === '1' ? 'Admin' : 'User'}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Số Điện Thoại</label>
                <div class="col-6">
                    <input type="text" name="telephone" class="form-control" id="inputPassword" value="{{\Illuminate\Support\Facades\Auth::user()->telephone}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Mật Khẩu</label>
                <div class="col-6">
                    <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Đổi Mật Khẩu</a>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </div>
    </form>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Đổi Mật khẩu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('changePassword')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mật Khẩu Cũ</label>
                            <input name="current_password" type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mật Khẩu Mới</label>
                            <input name="new_password" type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nhập Lại Mật Khẩu Mới</label>
                            <input name="new_password_confirmation" type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="btn btn-primary">Xác Nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
