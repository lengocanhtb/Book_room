@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Danh sách nhà trọ</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Nhà trọ</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div>
    <button type="button" class="btn btn-primary" style="margin: 10px;">
        <a href="{{route('admin.rooms.create')}}" style="color: white;"><i class="fa fa-plus" aria-hidden="true"></i>Tạo
            mới</a>
    </button>
</div>
<div class="btn-group" style="margin: 10px;">
    <a href="/admin/room" class="btn btn-success" style="color: white">Tất cả</a>
    <a href="/admin/room/list?status=0" class="btn btn-success" style="color: white">Chờ phê duyệt</a>
    <a href="/admin/room/list?status=1" class="btn btn-success" style="color: white">Xác Nhận</a>
</div>
<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Danh sách nhà trọ</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="myTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Tiêu đề</th>
                        <th>Địa chỉ</th>
                        <th>Giá</th>
                        <th>Diện tích</th>
                        <th>Loại hình</th>
                        <th>Người đăng</th>
                        <th>Chỉnh sửa</th>
                        <th style="width: 20px">Xóa</th>
                        <th style="width: 10px">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                    <tr>
                        <td>{{$room->title}}</td>
                        <td>{{$room->detail_address}}</td>
                        <td>{{$room->price}}</td>
                        <td>{{$room->area}} m<sup>2</sup></td>
                        @if($room->rent_type_id ==1 )
                        <td>Phòng trọ, nhà trọ</td>
                        @else
                        <td>Nhà thuê nguyên căn</td>
                        @endif
                        <td>{{$room->user->username}}</td>
                        <td>
                            <a class="edit btn btn-warning" href="{{ route('admin.rooms.edit', ['id' => $room->id]) }}">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </td>
                        <td>
                            <button type="button" class="delete btn btn-danger" data-toggle="modal"
                                data-target="#modal_confirm_delete_package" onclick="showDeleteModal({{$room->id}})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                        @if($room->status == 0)
                        <td>
                            <button type="button" class="delete btn btn-info" data-toggle="modal"
                                data-target="#modal_confirm_browse_package" onclick="showBrowseModal({{$room->id}})">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </td>
                        @elseif($room->status == 1)
                        <td>Đã duyệt</td>
                        @else($room->status == 2)
                        <td>Đã hủy</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@stop
@section('modal')
<!-- /.Delete Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal_confirm_delete_package"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{url('admin/room/delete')}}" method="get">
        <input type="hidden" name="id" id="delete_id" value="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xóa bài đăng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có xác nhận muốn xóa bài đăng?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Xóa</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- /.Confirm Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal_confirm_browse_package"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bạn có thể duyệt hoặc hủy bài đăng?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="display: flex; justify-content: space-between">
                        <form action="{{url('admin/room/confirm')}}" method="get">
                            <input type="hidden" name="id" id="browse_id" value="">
                            <button type="submit" class="btn btn-success">Duyệt</button>
                        </form>
                        <form action="{{url('admin/room/cancel')}}">
                            <input type="hidden" name="id" id="cancel_id" value="">
                            <button type="submit" class="btn btn-danger" >Hủy</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
</div>
@stop
@section('js')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
function showDeleteModal(id) {
    $('#delete_id').val(id);
}

function showBrowseModal(id) {
    $('#browse_id').val(id);
    $('#cancel_id').val(id);
}
$(document).ready(function() {
    $('#myTable').DataTable();

    $('#status').on('change', function() {
        alert(this.value);
    })
});
</script>
@stop
