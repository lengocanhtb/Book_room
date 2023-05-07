@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Đăng tin mới</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.rooms.index')}}">Bài đăng</a></li>
                        <li class="breadcrumb-item active">Đăng tin mới</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <form method="post" id="form-submit" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body" >
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="font-weight-bold">Địa chỉ cho thuê</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Tỉnh/Thành phố</label>
                                <select required id="province-data" name='province_id' class="form-control" >
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
                                <input required id="title" name="title" class="form-control" >
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
                                <input required id="area" name="area" class="form-control" type="number" data-msg-required="Bạn chưa nhập giá phòng" data-msg-min="Giá phòng chưa đúng">
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
                                <input readonly="readonly" class="form-control" type="text" value="{{!empty(\Illuminate\Support\Facades\Auth::user()->fullname) ? \Illuminate\Support\Facades\Auth::user()->fullname : \Illuminate\Support\Facades\Auth::user()->username}}">
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Điện thoại</label>
                            <div class="input-group">
                                <input readonly="readonly" class="form-control" type="text" value="{{\Illuminate\Support\Facades\Auth::user()->telephone}}">
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
                        <button type="submit" id="upload" class="btn btn-success mb-5 btn-lg btn-block">Đăng bài</button>
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
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {

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
        $('#district-data').on('change', function () {
            var idDistrict = this.value;
            $("#ward-data").html('');
            $.ajax({
                url: "{{url('api/fetch-wards')}}",
                type: "POST",
                data: {
                    district_id: idDistrict,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#ward-data').html('<option value="">-- Chọn Phường Xã --</option>');
                    $.each(res.wards, function (key, value) {
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
        $('#upload').click(function () {
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
