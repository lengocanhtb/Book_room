<div class="homepage">
  <header class="header">
      <div class="header__body container">
          <div class="header__logo">
              <a href="/">
                  <img src="{{ asset('homepage/img/logo.png') }}" alt="logo homepage" />
              </a>
          </div>
          <div class="header__groupBtn">
              @if (Route::has('login'))
                  <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                      @auth
                          <span class="header__account-email">{{ \Illuminate\Support\Facades\Auth::user()->username }}</span>
                          @if(\Illuminate\Support\Facades\Auth::user()->role === '1')
                              <a href="{{ route('admin.users.index') }}" class="btn">Trang Quản Lý</a>
                          @endif
                          <a href="{{ route('post.create') }}" class="btn --bg-red">Đăng tin mới</a>
                          <a href="{{ route('room.index') }}" class="btn">Quản lý tin đăng</a>
                          <a href="{{route('profileUser')}}" class="btn">Tài khoản</a>
                          <a href="{{route('auth.logout')}}" class="btn">Đăng xuất</a>
                      @else
                          <a href="{{ route('login') }}" class="btn">Đăng nhập</a>

                          @if (Route::has('register'))
                              <a href="{{ route('register') }}" class="btn">Đăng ký</a>
                          @endif
                      @endauth
                  </div>
              @endif
          </div>
      </div>
  </header>
</div>
