@extends('layouts.master')

@section('title', 'Booking room')

@section('style-libraries')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('styles')
    <link rel="stylesheet" href="homepage/css/homepage.css" />
    <link rel="stylesheet" href="homepage/css/modal.css" />
@stop

@section('content')

    <div class="homepage">
        <section class="filter container">
            <form action="{{ route('home.search') }}" class="modal-form">
                <div class="filter__body">
                    <div class="filter__item filter__type">
                        <span id="type_name" class="filter__item__name">
                            @switch(old('rent_type_id'))
                                @case(1)
                                    Phòng trọ
                                @break

                                @case(2)
                                    Nhà nguyên căn
                                @break

                                @default
                                    Thể loại
                            @endswitch
                        </span>
                        <div class="modal">
                            <div class="modal-content">
                                <div class="modal-title">
                                    <p>Chọn loại bất động sản</p>
                                    <span class="close">&times;</span>
                                </div>
                                <div class="modal-content__text">
                                    <div class="modal-form">
                                        <div class="modal-content__input-group">
                                            <label for="type_1" class="modal-form__item">
                                                <input type="radio" name="rent_type_id" value="" id="type_1"
                                                    @checked(!old('rent_type_id'))>
                                                Tất cả
                                            </label>
                                            <label for="type_2" class="modal-form__item">
                                                <input type="radio" name="rent_type_id" value="1" id="type_2"
                                                    @checked(old('rent_type_id') == '1')>
                                                Phòng trọ
                                            </label>
                                            <label for="type_3" class="modal-form__item">
                                                <input type="radio" name="rent_type_id" value="2" id="type_3"
                                                    @checked(old('rent_type_id') == '2')>
                                                Nhà nguyên căn
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-opacity"></div>
                        </div>
                    </div>
                    <div class="filter__item filter__location">
                        <span id="district_name" class="filter__item__name">
                            @if (!old('district_id'))
                                Địa chỉ
                            @else
                                {{ $districts[old('district_id') - 1]->name }}
                            @endif
                        </span>
                        <div class="modal">
                            <div class="modal-content">
                                <div class="modal-title">
                                    <p>Chọn địa chỉ</p>
                                    <span class="close">&times;</span>
                                </div>
                                <div class="modal-content__text">
                                    <div class="modal-form">
                                        <div class="modal-content__input-group">
                                            <label for="location_0" class="modal-form__item">
                                                <input type="radio" name="district_id" value="" id="location_0"
                                                    @checked(!old('district_id'))>
                                                Tất cả
                                            </label>
                                            @foreach ($districts as $d)
                                                <label for="location_{{ $d->id }}" class="modal-form__item">
                                                    <input type="radio" name="district_id" value="{{ $d->id }}"
                                                        id="location_{{ $d->id }}" @checked(old('district_id') == $d->id)>
                                                    {{ $d->name }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-opacity"></div>
                        </div>
                    </div>
                    <div class="filter__item filter__type">
                        <span id="school_name" class="filter__item__name">
                            @if (!old('school_id'))
                                Trường đại học
                            @else
                                {{ $schools[old('school_id') - 1]->school }}
                            @endif
                        </span>
                        <div class="modal">
                            <div class="modal-content">
                                <div class="modal-title">
                                    <p>Chọn trường đại học</p>
                                    <span class="close">&times;</span>
                                </div>
                                <div class="modal-content__text">
                                    <div class="modal-form">
                                        <div class="modal-content__input-group">
                                            <label for="location_0" class="modal-form__item">
                                                <input type="radio" name="school_id" value="" id="location_0"
                                                    @checked(!old('school_id'))>
                                                Tất cả
                                            </label>
                                            @foreach ($schools as $d)
                                                <label for="school_{{ $d->id }}" class="modal-form__item">
                                                    <input type="radio" name="school_id" value="{{ $d->id }}"
                                                        id="school_{{ $d->id }}" @checked(old('school_id') == $d->id)>
                                                    {{ $d->school }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-opacity"></div>
                        </div>
                    </div>
                    <div class="filter__item filter__price">
                        <span class="filter__item__name" id="price_name">
                            @if (!old('min_price'))
                                @if (!old('max_price'))
                                    Giá
                                @else
                                    0 - {{ old('max_price') }} VNĐ
                                @endif
                            @elseif(!old('max_price'))
                                >= {{ old('min_price') }} VNĐ
                            @else
                                {{ old('min_price') }} - {{ old('max_price') }} VNĐ
                            @endif
                        </span>
                        <div class="modal">
                            <div class="modal-content">
                                <div class="modal-title">
                                    <p>Chọn khoảng giá trị</p>
                                    <span class="close">&times;</span>
                                </div>
                                <div class="modal-content__text">
                                    <div class="modal-form">
                                        <div class="modal-content__input-group">
                                            <label for="" class="modal-form__item">
                                                Giá trị thấp nhất
                                                <input type="number" name="min_price" value="{{ old('min_price') }}"
                                                    id="">
                                                VND
                                            </label>
                                            <label for="" class="modal-form__item">
                                                Giá trị cao nhất
                                                <input type="number" name="max_price" value="{{ old('max_price') }}"
                                                    id="">
                                                VND
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-opacity"></div>
                        </div>
                    </div>
                    <div class="filter__item filter__acreage">
                        <span id="area_name" class="filter__item__name">
                            @if (!old('min_area'))
                                @if (!old('max_area'))
                                    Diện tích
                                @else
                                    0 - {{ old('max_area') }} m²
                                @endif
                            @elseif(!old('max_area'))
                                >= {{ old('min_area') }} m²
                            @else
                                {{ old('min_area') }} - {{ old('max_area') }} m²
                            @endif
                        </span>
                        <div class="modal">
                            <div class="modal-content">
                                <div class="modal-title">
                                    <p>Chọn khoảng diện tích</p>
                                    <span class="close">&times;</span>
                                </div>
                                <div class="modal-content__text">
                                    <div class="modal-form">
                                        <div class="modal-content__input-group">
                                            <label for="" class="modal-form__item">
                                                Diện tích bé nhất
                                                <input type="number" name="min_area" value="{{ old('min_area') }}"
                                                    id="">
                                                m²
                                            </label>
                                            <label for="" class="modal-form__item">
                                                Diện tích lớn nhất
                                                <input type="number" name="max_area" value="{{ old('max_area') }}"
                                                    id="">
                                                m²
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-opacity"></div>
                        </div>
                    </div>
                    <button id="search_btn" class="btn filter__item">Tìm kiếm</button>
                </div>
            </form>
        </section>

        <section class="post-listing container">
            <div class="post-listing__heading">
                <h1>Danh sách bài đăng</h1>
            </div>
            <div class="post-listing__sorting">
                <span class="post-listing__sorting__item">Lựa chọn</span>
                <a class="btn post-listing__sorting__item active" id="a_search_default">Mặc định</a>
                <a class="btn post-listing__sorting__item" id="a_search_latest">Mới nhất</a>
            </div>
            <div class="post-listing__content" id="search_default">
                @foreach ($rooms as $key => $room)
                    <div class="post-listing__content__item row {{ count($room->reports) > 0 ? 'border_warning' : '' }}">
                        <div style="display: flex; position: relative; gap: 20px">
                            <span class="post-listing__item__number">{{ $room->rent_type_id == 1 ? 'Phòng Trọ' : 'Nhà nguyên căn' }}</span>
                            <div class="post-listing__item__image">
                                <img
                                    src="{{ count($room->roomImages) ? asset($room->roomImages[0]->image) : asset('homepage/img/p1.jpg') }}" />
                                <span class="images-number">{{ count($room->roomImages) }} ảnh</span>
                            </div>
                            <div class="post-listing__item__text">
                                <div style="overflow: hidden;text-overflow: ellipsis;-webkit-line-clamp: 1;display: -webkit-box;-webkit-box-orient: vertical;">
                                    <span class="post-star">
                                        @if($ratings[$key])
                                            @if($ratings[$key] == 1)
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                            @elseif($ratings[$key] == 2)
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                            @elseif($ratings[$key] == 3)
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                            @elseif($ratings[$key] == 4)
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                            @elseif($ratings[$key] == 5)
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            @endif
                                        @endif
                                    </span>
                                    <span class="post-listing__item__title">{{ $room->title }}</span>
                                </div>
                                <div class="post-info">
                                    <div class="post-info__short-info">
                                        <span class="post-info__price">{{ $room->price }}VNĐ/tháng</span>
                                        <span class="post-info__acreage">{{ $room->area }}m²</span>

                                    </div>
                                    <span class="post-info__location"><i
                                            class="fas fa-map-marker-alt"></i>{{ $room->detail_address }}</span>
                                    <span
                                        class="post-info__time">{{ $room->updated_at->diffForHumans(\Illuminate\Support\Carbon::now()) }}</span>
                                </div>
                                <div class="post-description">
                                    <p>
                                        {{ $room->content }}
                                    </p>
                                </div>
                                <div class="post-contact">
                                    <div class="post-contact__author">
                                        <img class="post-contact__author__avatar" src="homepage/img/profile.png"
                                            alt="" />
                                        <span class="post-contact__author__name">{{ $room->user->fullname }}</span>
                                        @if ($room->findUserReport())
                                            <p class="poster_warning">Người đăng có bài viết bị báo cáo vi phạm</p>
                                        @endif
                                    </div>
                                    <div class="post-contact__groupBtn">
                                        <a class="btn btn-detail" href="{{ route('room', $room->id) }}">Chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (count($room->reports) > 3)
                            <div class="show_warning">
                                <p>Bài viết đang bị báo cáo vi phạm </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="post-listing__content d-none" id="search_latest">
                @foreach ($search_latests as $key => $room)
                    <div class="post-listing__content__item row {{ count($room->reports) > 0 ? 'border_warning' : '' }}">
                        <div style="display: flex; position: relative; gap: 20px">
                            <span class="post-listing__item__number">{{ $room->rent_type_id == 1 ? 'Phòng Trọ' : 'Nhà nguyên căn' }}</span>
                            <div class="post-listing__item__image">
                                <img
                                    src="{{ count($room->roomImages) ? asset($room->roomImages[0]->image) : asset('homepage/img/p1.jpg') }}" />
                                <span class="images-number">{{ count($room->roomImages) }} ảnh</span>
                            </div>
                            <div class="post-listing__item__text">
                                <div style="overflow: hidden;text-overflow: ellipsis;-webkit-line-clamp: 1;display: -webkit-box;-webkit-box-orient: vertical;">
                                    <span class="post-star">
                                        @if($ratings_latest[$key])
                                            @if($ratings_latest[$key] == 1)
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                            @elseif($ratings_latest[$key] == 2)
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                            @elseif($ratings_latest[$key] == 3)
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                            @elseif($ratings_latest[$key] == 4)
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star" style="color: #dee2e6"></i>
                                            @elseif($ratings_latest[$key] == 5)
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            @endif
                                        @endif
                                    </span>
                                    <span class="post-listing__item__title">{{ $room->title }}</span>
                                </div>
                                <div class="post-info">
                                    <div class="post-info__short-info">
                                        <span class="post-info__price">{{ $room->price }}VNĐ/tháng</span>
                                        <span class="post-info__acreage">{{ $room->area }}m²</span>

                                    </div>
                                    <span class="post-info__location"><i
                                            class="fas fa-map-marker-alt"></i>{{ $room->detail_address }}</span>
                                    <span
                                        class="post-info__time">{{ $room->updated_at->diffForHumans(\Illuminate\Support\Carbon::now()) }}</span>
                                </div>
                                <div class="post-description">
                                    <p>
                                        {{ $room->content }}
                                    </p>
                                </div>
                                <div class="post-contact">
                                    <div class="post-contact__author">
                                        <img class="post-contact__author__avatar" src="homepage/img/profile.png"
                                            alt="" />
                                        <span class="post-contact__author__name">{{ $room->user->fullname }}</span>
                                        @if ($room->findUserReport())
                                            <p class="poster_warning">Người đăng có bài viết bị báo cáo vi phạm</p>
                                        @endif
                                    </div>
                                    <div class="post-contact__groupBtn">
                                        <a class="btn btn-detail" href="{{ route('room', $room->id) }}">Chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (count($room->reports) > 3)
                            <div class="show_warning">
                                <p>Bài viết đang bị báo cáo vi phạm </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            {{ $rooms->render('vendor.pagination.bootstrap-4') }}
        </section>
    </div>
@stop

@section('scripts')
    <script src="homepage/js/modal.js"></script>

    <script>
        $(document).ready(function() {
            $('input[type=radio][name=rent_type_id]').change(function() {
                switch ($(this).val()) {
                    case '1':
                        $("#type_name").text("Phòng trọ");
                        break;
                    case '2':
                        $("#type_name").text("Nhà nguyên căn");
                        break;
                    default:
                        $("#type_name").text("Tất cả");
                        break;
                }
            });

            $('input[type=number]').change(function() {
                if ($('input[type=number][name=max_price]').val() != '' && $(
                        'input[type=number][name=min_price]').val() != '') {
                    $("#price_name").text($('input[type=number][name=min_price]').val() + ' VNĐ' + ' - ' +
                        $('input[type=number][name=max_price]').val() + ' VNĐ');
                } else if ($('input[type=number][name=min_price]').val() != '') {
                    $("#price_name").text(">= " + $('input[type=number][name=min_price]').val() + ' VNĐ');
                } else if ($('input[type=number][name=max_price]').val() != '') {
                    $("#price_name").text("0 - " + $('input[type=number][name=max_price]').val() + ' VNĐ');
                } else {
                    $("#price_name").text('Giá');
                }

                if ($('input[type=number][name=max_area]').val() != '' && $(
                        'input[type=number][name=min_area]').val() != '') {
                    $("#area_name").text($('input[type=number][name=min_area]').val() + ' m²' + ' - ' + $(
                        'input[type=number][name=max_area]').val() + ' m²');
                } else if ($('input[type=number][name=min_area]').val() != '') {
                    $("#area_name").text(">= " + $('input[type=number][name=min_area]').val() + ' m²');
                } else if ($('input[type=number][name=max_area]').val() != '') {
                    $("#area_name").text("0 - " + $('input[type=number][name=max_area]').val() + ' m²');
                } else {
                    $("#area_name").text('Diện tích');
                }
            });

            $('input[type=radio][name=district_id]').change(function() {
                if ($(this).val() == '') {
                    $("#district_name").text("Tất cả");
                } else {
                    $("#district_name").text($('input[name=district_id]:checked').parent('label').text());
                }
            });
            $('input[type=radio][name=school_id]').change(function() {
                if ($(this).val() == '') {
                    $("#school_name").text("Tất cả");
                } else {
                    $("#school_name").text($('input[name=school_id]:checked').parent('label').text());
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('a.post-listing__sorting__item').click(function() {
                const index = $('a.post-listing__sorting__item').index(this);
                $('.post-listing__sorting__item').removeClass('active');
                $(this).addClass('active');
                if (index) {
                    $('#search_latest').removeClass('d-none');
                    $('#search_default').addClass('d-none');
                } else {
                    $('#search_default').removeClass('d-none');
                    $('#search_latest').addClass('d-none');
                }
            })
        });
    </script>
@stop
