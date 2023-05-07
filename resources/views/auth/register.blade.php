<!DOCTYPE html>
<html>

<head>
    @include('admin.partials.head')
</head>

<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="/"><b>APART Xin chào!</b></a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Tạo tài khoản mới</p>
            <form action="{{route('auth.register')}}" method="post">
                @if(Session::has('error'))
                    <div class="text-center">
                        <span style="color:red;">
                            {{Session::get('error')}}
                        </span>
                    </div>
                @endif
                @csrf
                <div class="input-group mb-3" style="margin-bottom: 2rem!important;">
                    <input name="username" type="text" class="form-control" placeholder="Tên người dùng">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3" style="margin-bottom: 2rem!important;">
                    <input name="fullname" type="text" class="form-control" placeholder="Họ và Tên">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                    <div class="input-group mb-3" style="margin-bottom: 2rem!important;">
                        <input name="telephone" type="number" class="form-control" placeholder="Số Điện Thoại">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                <div class="input-group mb-3" style="margin-bottom: 2rem!important;">
                    <input name="email" type="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3" style="margin-bottom: 2rem!important;">
                    <input name="password" type="password" class="form-control" placeholder="Mật khẩu">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3" style="margin-bottom: 2rem!important;">
                    <input name="password_confirmation" type="password" class="form-control" placeholder="Nhập lại mật khẩu">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <div style="margin-top: 5%;">
                <a href="{{route('login')}}" class="text-center">Đăng nhập</a>
            </div>

        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->
@include('admin.partials.footer')
</body>

</html>
