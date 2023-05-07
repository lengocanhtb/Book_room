@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách người dùng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Người dùng</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div>
        <button type="button" class="btn btn-primary" style="margin: 10px;">
            <a href="{{route('admin.users.create')}}" style="color: white;"><i class="fa fa-plus" aria-hidden="true"></i>Tạo
                mới</a>
        </button>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách người dùng</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="myTable" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Tên </th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->fullname}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->telephone}}</td>
                            <td>{{$user->role == 1 ? "Quản trị viên" : "Người dùng"}}</td>
                            @if($user->role != 1)
                                @if($user->status == 1 )
                                    <td>
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#modal_confirm_browse_package"
                                                onclick="showBrowseModal({{$user->id}})">
                                            Hoạt động
                                        </button>
                                    </td>
                                @else
                                    <td>
                                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                data-target="#modal_confirm_browse_package"
                                                onclick="showBrowseModal({{$user->id}})">
                                            Ngừng hoạt động
                                        </button>
                                    </td>
                                @endif
                            @else
                                <td>Admin</td>
                            @endif
{{--                            <td>--}}
{{--                                <a class="edit btn btn-warning" href="{{ route('admin.rooms.edit', ['id' => $user->id]) }}">--}}
{{--                                    <i class="fas fa-pencil-alt"></i>--}}
{{--                                </a>--}}
{{--                            </td>--}}
                            <td>
                                @if($user->role != 1)
                                    <button type="button" class="delete btn btn-danger" data-toggle="modal"
                                            data-target="#modal_confirm_delete_package" onclick="showDeleteModal({{$user->id}})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            </td>
{{--                            @if($user->status == 0)--}}
{{--                                <td>--}}
{{--                                    <button type="button" class="delete btn btn-info" data-toggle="modal"--}}
{{--                                            data-target="#modal_confirm_browse_package" onclick="showBrowseModal({{$room->id}})">--}}
{{--                                        <i class="fa-solid fa-check"></i>--}}
{{--                                    </button>--}}
{{--                                </td>--}}
{{--                            @else--}}
{{--                                <td>Đã duyệt</td>--}}
{{--                            @endif--}}
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
        <form action="{{url('admin/user/delete')}}" method="get">
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
                        <p>Bạn có xác nhận muốn xóa người dùng này?</p>
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
        <form action="{{url('admin/user/change-status')}}" method="get">
            <input type="hidden" name="id" id="browse_id" value="">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thay đổi trạng thái người dùng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="change-status-msg">Bạn có xác nhận thay đổi trạng thái người dùng này?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    </div>
                </div>
            </div>
        </form>
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
        }
        $(document).ready(function() {
            $('#myTable').DataTable();

            $('#status').on('change', function() {
                alert(this.value);
            })
        });
    </script>
@stop
