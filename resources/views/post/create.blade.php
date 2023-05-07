@extends('layouts.master')

@section('title', 'Đăng tin mới')

@section('style-libraries')
@stop

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../homepage/css/homepage.css" />
    <link rel="stylesheet" href="../post/css/comment.css" />
    <link rel="stylesheet" href="../post/css/new-post.css" />
@stop

@section('content')
    <nav class="col-lg-2 d-none d-lg-block bg-light sidebar menu-sidebar">
        <div class="user_info">
            <div class="user_avatar"><img src="https://phongtro123.com/images/default-user.png"></div>
            <div class="user_name">{{ \Illuminate\Support\Facades\Auth::user()->fullname }}</div>
            <div class="user_verify" style="color: #555; font-size: 0.9rem;">
                {{ \Illuminate\Support\Facades\Auth::user()->telephone }}</div>
        </div>
        <ul class="nav nav-sidebar">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('room.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-file-text">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Quản lý tin đăng
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('profileUser') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-edit">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    Sửa thông tin cá nhân
                </a>
            </li>
        </ul>
    </nav>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Đăng tin mới</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Đăng tin mới</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <form method="post" id="form-submit" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="font-weight-bold">Địa chỉ cho thuê</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Tỉnh/Thành phố</label>
                                <select required id="province-data" name='province_id' class="form-control">
                                    <option value="1">Thành phố Hà Nội</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Quận/Huyện</label>
                                <select required id="district-data" name="district_id" class="form-control">
                                    <option value="">-- Chọn Quận Huyện --</option>
                                    @foreach($districts as $district)
                                        <option value="{{$district->id}}">
                                            {{$district->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Phường/Xã</label>
                                <select required id="ward-data" name="ward_id" class="form-control">
                                    <option value="">-- Chọn Phường Xã --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Số nhà/Đường</label>
                                <input required id="street-data" name="street" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="font-weight-bold">Thông tin mô tả</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input required id="title" name="title" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label>Nội dung mô tả</label>
                                <textarea required id="content" name="content" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Giá cho thuê</label>
                            <div class="input-group">
                                <input required id="price" name="price" class="form-control" type="number">
                                <div class="input-group-append">
                                    <span class="input-group-text">đồng</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Diện tích</label>
                            <div class="input-group">
                                <input required id="area" name="area" class="form-control" type="number"
                                    data-msg-required="Bạn chưa nhập giá phòng" data-msg-min="Giá phòng chưa đúng">
                                <div class="input-group-append">
                                    <span class="input-group-text">m<sup>2</sup></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Loại hình</label>
                            <select required id="rent-type-data" name="rent_type_id" class="form-control">
                                <option value="">-- Chọn Loại Hình --</option>
                                <option value="1">Phòng trọ, nhà trọ</option>
                                <option value="2">Nhà thuê nguyên căn</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Thông tin liên hệ</label>
                            <div class="input-group">
                                <input readonly="readonly" class="form-control" type="text"
                                    value="{{ !empty(\Illuminate\Support\Facades\Auth::user()->fullname) ? \Illuminate\Support\Facades\Auth::user()->fullname : \Illuminate\Support\Facades\Auth::user()->username }}">
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Điện thoại</label>
                            <div class="input-group">
                                <input readonly="readonly" class="form-control" type="text"
                                    value="{{ \Illuminate\Support\Facades\Auth::user()->telephone }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Video</label>
                        <div class="video-upload"></div>
                        <input type="file">
                    </div>
                    <div class="input-group hdtuto control-group lst increment" >
                        <div class="list-input-hidden-upload">
                            <input type="file" name="filenames[]" id="file_upload" class="myfrm form-control hidden" accept="image/png, image/jpeg, image/jpg" hidden>
                        </div>
                        <div class="input-group-btn">
                            <button class="btn btn-success btn-add-image" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>+Add image</button>
                        </div>
                    </div>
                    <div class="list-images">
                    </div>
                    <div class="col-md-12">
                        <button style="padding-top: 3px;" type="submit"
                            class="btn btn-success mb-5 btn-lg btn-block" id="upload">Đăng bài</button>
                    </div>
                </div>
            </form>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@stop
<style>
    .list-images {
        width: 50%;
        margin-top: 20px;
        display: inline-block;
    }
    .hidden { display: none; }
    .box-image {
        width: 100px;
        height: 108px;
        position: relative;
        float: left;
        margin-left: 5px;
    }
    .box-image img {
        width: 100px;
        height: 100px;
    }
    .wrap-btn-delete {
        position: absolute;
        top: -8px;
        right: 0;
        height: 2px;
        font-size: 20px;
        font-weight: bold;
        color: red;
    }
    .btn-delete-image {
        cursor: pointer;
    }
</style>
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    {{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $(document).ready(function() {
                $(".btn-add-image").click(function(){
                    $('#file_upload').trigger('click');
                });

                $('.list-input-hidden-upload').on('change', '#file_upload', function(event){
                    let today = new Date();
                    let time = today.getTime();
                    let image = event.target.files[0];
                    let file_name = event.target.files[0].name;
                    let box_image = $('<div class="box-image"></div>');
                    box_image.append('<img src="' + URL.createObjectURL(image) + '" class="picture-box">');
                    box_image.append('<div class="wrap-btn-delete"><span data-id='+time+' class="btn-delete-image">x</span></div>');
                    $(".list-images").append(box_image);

                    $(this).removeAttr('id');
                    $(this).attr( 'id', time);
                    let input_type_file = '<input type="file" name="filenames[]" id="file_upload" class="myfrm form-control hidden" accept="image/png, image/jpeg, image/jpg" hidden>';
                    $('.list-input-hidden-upload').append(input_type_file);
                });

                $(".list-images").on('click', '.btn-delete-image', function(){
                    let id = $(this).data('id');
                    $('#'+id).remove();
                    $(this).parents('.box-image').remove();
                });
            });
            /*------------------------------------------
            --------------------------------------------
            District Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#district-data').on('change', function() {
                var idDistrict = this.value;
                $("#ward-data").html('');
                $.ajax({
                    url: "{{ url('api/fetch-wards') }}",
                    type: "POST",
                    data: {
                        district_id: idDistrict,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#ward-data').html('<option value="">-- Chọn Phường Xã --</option>');
                        $.each(res.wards, function(key, value) {
                            $("#ward-data").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#upload').on('click',function (event) {
                var data = new FormData();
                var file = $('form input[type=file]')[0].files[0];
                data.append('file',file);
                let input_type_file = '<input type="text" name="file" value="' + file.name + '" hidden>';
                $('.video-upload').append(input_type_file);
                $.ajax({
                    url: "https://itss-final-project.2soft.top/public-files/upload",
                    type: "POST",
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    headers: { 'Authorization': 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MiwiZW1haWwiOiJhbmgudG5kZXY0MEBnbWFpbC5jb20iLCJpYXQiOjE2NzUyNDAzMDksImV4cCI6MTY3NzgzMjMwOX0.dyoNOTOmX27An8XIqOZYaP2xnIxWfJtlyVr3w0Cmtac' },
                    data: data,
                    error: function(err) {
                        console.log(err)
                    },
                    success: function() {
                        console.log("Success!");
                    }
                });
            });
        });
    </script>
@stop
