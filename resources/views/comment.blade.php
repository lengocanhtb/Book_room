@extends('layouts.master')

@section('title', 'Chi tiết bài viết')

@section('style-libraries')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('styles')
<link rel="stylesheet" href="../homepage/css/homepage.css" />
<link rel="stylesheet" href="../homepage/css/owl.theme.default.min.css" />
<link rel="stylesheet" href="../homepage/css/owl.carousel.min.css" />
<link rel="stylesheet" href="../post/css/comment.css" />
<link rel="stylesheet" href="../post/css/rating.css" />
@stop

@section('content')
<div class="comment-page container">
  <h1 class="comment-page__title">Chi tiết bài đăng</h1>
  <div class="comment-page__content">
    <section class="post-detail page-left">
      @if(count($room->reports) > 3)
        <div class="show_warning">
            <p>Bài viết đang bị báo cáo vi phạm </p>
        </div>
      @endif
      <div>
        <div class="post-detail__description-image">
            @if(count($room->roomImages))
                <div class="owl-carousel owl-theme">
                    @foreach ($room->roomImages as $image )
                        <div class="post-detail__image">
                          <img src="{{ asset($image->image) }}" />
                        </div>
                    @endforeach
                </div>
            @else
                <img src="{{ asset('homepage/img/p1.jpg') }}" alt="" />
            @endif
        </div>
        <p class="post-detail__title">
          <span class="post-star">
              @if($rating)
                  @if($rating == 1)
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star" style="color: white"></i>
                      <i class="fa-solid fa-star" style="color: white"></i>
                      <i class="fa-solid fa-star" style="color: white"></i>
                      <i class="fa-solid fa-star" style="color: white"></i>
                  @elseif($rating == 2)
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star" style="color: white"></i>
                      <i class="fa-solid fa-star" style="color: white"></i>
                      <i class="fa-solid fa-star" style="color: white"></i>
                  @elseif($rating == 3)
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star" style="color: white"></i>
                      <i class="fa-solid fa-star" style="color: white"></i>
                  @elseif($rating == 4)
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star" style="color: white"></i>
                  @elseif($rating == 5)
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                  @endif
              @else
                  <i class="fa-solid fa-star" style="color: white"></i>
                  <i class="fa-solid fa-star" style="color: white"></i>
                  <i class="fa-solid fa-star" style="color: white"></i>
                  <i class="fa-solid fa-star" style="color: white"></i>
                  <i class="fa-solid fa-star" style="color: white"></i>
              @endif
          </span>
          <span class="post-detail__title__text">
            {{ $room->title }}
          </span>
        </p>
        <p class="post-detail__type"><span>Loại hình: </span>{{ $room->rent_type_id == 1 ? "Phòng trọ, nhà trọ" : "Nhà thuê nguyên căn"  }}</p>        <p class="post-detail__location"><span>Địa chỉ: </span>{{ $room->detail_address }}</p>
        <div class="post-detail__group">
          <p class="post-detail__price">
            <i class="fa-solid fa-tag"></i>
            {{ $room->price }} VNĐ
          </p>
          <p class="post-detail__acreage">
            <i class="fa-sharp fa-solid fa-house-chimney"></i>
            {{ $room->area }}m²
          </p>
          <p class="post-detail__number-people">
            <i class="fa-solid fa-user-group"></i>
            1-3 người
          </p>
          <p class="post-detail__time">
            <i class="fas fa-history"></i>
            {{ $room->updated_at->diffForHumans(\Illuminate\Support\Carbon::now()) }}
          </p>
        </div>
        <div class="post-detail__text">
          <h3 class="post-detail__text__title">Mô tả chi tiết</h3>
          <p>
              {{ $room->content }}
          </p>
        </div>
          @if($room->videoUrl != '')
              <h3 class="post-detail__text__title">Video</h3>
              <video width="400" height="400" controls>
                  <source src="{{ 'https://minio.hisoft.com.vn/anhtn-ltct/'.$room->videoUrl}}" type="video/mp4">
              </video>
          @endif
        <div class="post-detail__map-location">
          <h3>Vị trí trên bản đồ</h3>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.7242323314795!2d105.84667945036404!3d21.003688585943383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac71294bf0ab%3A0xc7e2d20e5e04a9da!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBCw6FjaCBLaG9hIEjDoCBO4buZaQ!5e0!3m2!1sen!2s!4v1670070060826!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div>
          <button class="btn btn-danger btn-report" type="button" data-toggle="modal" data-target="{{ (!$reported && $user['username'] !== '') ? '#reportModal' : ''}}" id="reportFormDisplayBtn">
            <i class="fa-sharp fa-solid fa-flag"></i>
            Báo cáo
          </button>
        </div>
      </div>
    </section>
    <section class="page-right">
      <div class="post-owner">
        <div>
          <img src="../homepage/img/profile.png">
          <p class="post-owner__name">{{ $room->user->fullname }}</p>
          @if($room->findUserReport())
              <p class="poster_warning" style="font-size: large; margin-bottom: 10px;">Người đăng có bài viết bị báo cáo vi phạm</p>
          @endif
          <div class="post-owner__info">
            <a class="btn" href="tel:{{$room->user->telephone}}}"><i class="fas fa-phone-square-alt"></i>{{ $room->user->telephone }}</a>
            <a class="btn" href="https://zalo.me/{{$room->user->telephone}}"><i class="fas fa-comment"></i>nhắn Zalo</a>
          </div>
        </div>
      </div>
      <div class="post-comment">
        <h2>Bình luận</h2>
          <div style="height: 300px;overflow-y:auto;">
              @foreach($comments as $c)
                  @if($c->comment != '')
                  <div class="post-comment__item">
                          <img src="../homepage/img/profile.png">
                          <div class="post-comment__detail">
                          <div class="post-comment__short-info">
                              <p class="post-comment__commentator">{{ $c->user->username }}</p>
                              <p class="post-comment__time"> {{ $c->created_at ? $c->created_at->diffForHumans(\Illuminate\Support\Carbon::now()) : '' }}</p>
                          </div>
                          <span class="post-star">
                            @if($c->rate_star)
                              @if($c->rate_star == 1)
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star" style="color: white"></i>
                                  <i class="fa-solid fa-star" style="color: white"></i>
                                  <i class="fa-solid fa-star" style="color: white"></i>
                                  <i class="fa-solid fa-star" style="color: white"></i>
                              @elseif($c->rate_star == 2)
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star" style="color: white"></i>
                                  <i class="fa-solid fa-star" style="color: white"></i>
                                  <i class="fa-solid fa-star" style="color: white"></i>
                              @elseif($c->rate_star == 3)
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star" style="color: white"></i>
                                  <i class="fa-solid fa-star" style="color: white"></i>
                              @elseif($c->rate_star == 4)
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star" style="color: white"></i>
                              @elseif($c->rate_star == 5)
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                              @endif
                            @endif
                          </span>
                          <p>{{ $c->comment }}</p>
                      </div>
                  </div>
                  @endif
              @endforeach
          </div>
        @if(Auth::user())
            <div class="post-comment__item post-comment__writer">
                <div style="display: flex">
                  <img src="../homepage/img/man.png">
                  <p class="post-comment__commentator" style="padding: 10px">{{Auth::user()->username}}</p>
                </div>
                <div class="post-comment__detail">
                  <form method="post" action="{{route('comment')}}" class="mb-3 mt-2">
                  @csrf
                  <input type="hidden" name="room_id" value="{{ $room->id }}">
                  <!-- RATE -->
                  <div class="rating-group mt-3" style=" {{ $user_rating ? 'pointer-events: none;' : '' }} ">
                    @for($i=1; $i<=5; $i++)
                      <label aria-label="{{ $i }} star" class="rating__label" for="rating-{{ $i }}"><i class="rating__icon rating__icon--star fa fa-star" style="{{ $user_rating && $user_rating->rate_star < $i ? 'color: white;' : '' }}"></i></label>
                      <input class="rating__input" name="rating" id="rating-{{ $i }}" value="{{ $i }}" type="radio">
                    @endfor
                  </div>
                  <div>
                    <textarea resize=false name="comment" id="" rows="5"></textarea>
                  </div>
                  <button type="submit" class="btn">Gửi đánh giá</button>
                  </form>
                </div>
            </div>
        @endif
      </div>
    </section>
  </div>
</div>

 <!-- Modal send report -->
 <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="reportModalLabel">Liên hệ với chúng tôi</h5>
          <button type="button" class="close btn btn-report" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="post" action="{{route('room.report')}}">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">
          <div class="form-group">
            <label for="fullname">Họ và tên</label>
            <input type="text" name="fullname" class="form-control" id="fullname" readonly="readonly" value="{{$user['username']}}">
          </div>
          <div class="form-group">
            <label for="phoneNumber">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" id="phone" readonly="readonly" value="{{$user['telephone']}}">
          </div>
          <div class="form-group">
            <label>Vấn đề  <span style="color: red;">(*)</span></label>
            <select class="form-control" name="title" id="report-title">
              <option value="Mô tả thực tế không đúng" selected>Mô tả thực tế không đúng</option>
              <option value="Đã cho thuê">Đã cho thuê</option>
              <option value="Giá cả cao bất thường">Giá cả cao bất thường</option>
            </select>
            <small id="report-title-error" class="text-danger report-error">Hãy điền Vấn đề</small>
          </div>
          <div class="form-group">
            <label for="contentReport">Mô tả chi tiết <span style="color: red;">(*)</span></label>
            <textarea name="description" class="form-control" id="contentReport" rows="3"></textarea>
            <small id="report-description-error" class="text-danger report-error">Hãy điền Mô tả</small>
          </div>
          <div class="modal-footer" style="text-align:center; display:block">
             <button type="submit" class="btn btn-primary" id="report-submit-btn">Gửi</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<script src="../homepage/js/jquery.min.js"></script>
<script src="../homepage/js/owl.carousel.min.js"></script>
<script>
    $(document).ready(function(){
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items: 1,
            loop:true,
            margin:10,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true
        });
    });
</script>

<script>
  const titleInputElement = document.getElementById("report-title");
  const titleErrorElement = document.getElementById("report-title-error");

  const contentInputElement = document.getElementById("contentReport");
  const contentErrorElement = document.getElementById("report-description-error");

  document.getElementById("report-submit-btn").addEventListener("click", (e)=>{
    let valid = true;
    if(titleInputElement.value.trim() == ""){
      titleErrorElement.style.display="block";
      valid = false;
    }else{
      titleErrorElement.style.display="none";
    }

    if(contentInputElement.value.trim() == ""){
      contentErrorElement.style.display="block";
      valid = false;
    }else{
      contentErrorElement.style.display="none";
    }

    if(!valid){
      e.preventDefault();
    }
  }, false);

  const reportFormDisplayBtn = document.getElementById("reportFormDisplayBtn");
  reportFormDisplayBtn.addEventListener('click', (e)=>{
    const fullname = document.getElementById("fullname").value;
    if(reportFormDisplayBtn.dataset.target == "" && fullname !== ""){
      alert("Bạn đã báo cáo bài viết trước đây");
      window.location = "";
    }else if(reportFormDisplayBtn.dataset.target == "" && fullname === ""){
      alert("Hãy đăng nhập");
    }
  }, false)
</script>
@endsection
