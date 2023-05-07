<!DOCTYPE html>
<html>

<head>
    @include('admin.partials.head')
</head>

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>APART Xin chào!</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Đăng nhập</p>

            <form action="{{route('auth.login')}}" method="post">
                @if(Session::has('error'))
                    <div class="text-center">
                        <span style="color:red;">
                            {{Session::get('error')}}
                        </span>
                    </div>
                @endif
                    @if(Session::has('success'))
                        <div class="text-center">
                        <span style="color:#7fa93e;">
                            {{Session::get('success')}}
                        </span>
                        </div>
                    @endif
                @csrf
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
                <div class="row justify-content-center">
                    <!-- /.col -->
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!-- /.social-auth-links -->

            <p class="mb-0 mt-4">
                <a href="{{route('register')}}" class="text-center">Đăng ký</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
@include('admin.partials.footer')

</body>

</html>
