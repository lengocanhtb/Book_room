@extends('layouts.master')

@section('title', 'Quản lý đăng tin')

@section('style-libraries')
@stop

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../homepage/css/homepage.css" />
    <link rel="stylesheet" href="../post/css/comment.css" />
@stop

@section('content')
    <div class="container mt-5">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Danh sách bài đăng</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Danh sách bài đăng bị báo cáo</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <h2 class="mt-5">Danh sách bài đăng</h2>
            <div class="card-body">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Nội dung mô tả</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Diện tích</th>
                            <th scope="col">Loại hình</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Chỉnh sửa</th>
                            <th scope="col">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($my_room as $room)
                        <tr>
                            <td>{{$room->title}}</td>
                            <td>{{$room->detail_address}}</td>
                            <td>{{$room->content}}</td>
                            <td>{{$room->price}}</td>
                            <td>{{$room->area}} m<sup>2</sup></td>
                            @if($room->rent_type_id ==1 )
                            <td>Phòng trọ, nhà trọ</td>
                            @else
                            <td>Nhà thuê nguyên căn</td>
                            @endif
                            @if($room->status == 0)
                                <td> Chờ duyệt </td>
                            @elseif($room->status == 1)
                                <td>Đã duyệt</td>
                            @else($room->status == 2)
                                <td>Đã bị hủy</td>
                            @endif
                            <td>
                                <a href="{{ route('post.edit', ['id' => $room->id]) }}">
                                    <button type="button" class="btn btn-outline-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('post.delete', ['id' => $room->id]) }}">
                                    <button type="button" class="delete btn btn-danger" style="background: #f21e32f5;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <h2 class="mt-5">Danh sách bài đăng bị báo cáo</h2>
            <div class="card-body">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Bài đăng</th>
                            <th scope="col">Vấn đề</th>
                            <th scope="col">Nội dung báo cáo</th>
                            <th scope="col">Thời gian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($my_room as $room)
                            @foreach ($room->reports as $report)
                            <tr>
                                <td>{{ $report->id }}</td>
                                <td>
                                    <a href="{{ route('room', ['id' => $room->id]) }}">{{ $room->id }}</a>
                                </td>
                                <td>{{ $report->title }}</td>
                                <td>{{ $report->description }}</td>
                                <td>{{ $report->created_at }}</td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
