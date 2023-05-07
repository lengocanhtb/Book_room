<section class="navbar">
  <ul class="container navbar__list" style="margin-bottom: 0">
    <li><a href="/" @if (strstr( $_SERVER['REQUEST_URI'], 'nha_tro' ) == true || strstr( $_SERVER['REQUEST_URI'], 'nha_nguyen_can' ) == true) class="btn navbar__item" @else class = "btn navbar__item active" @endif >Trang chủ</a></li>
    <li><a href="/nha_tro" @if (strstr( $_SERVER['REQUEST_URI'], '/nha_tro' ) == true)  class="btn navbar__item active" @else class = "btn navbar__item" @endif >Phòng trọ</a></li>
    <li><a href="/nha_nguyen_can" @if (strstr( $_SERVER['REQUEST_URI'], '/nha_nguyen_can' ) == true)  class="btn navbar__item active" @else class = "btn navbar__item" @endif >Nhà Nguyên Căn</a></li>
  </ul>
</section>
