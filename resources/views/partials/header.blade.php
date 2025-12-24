<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
    <a class="navbar-brand" href="index.html">dirEngine.</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>

    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
        @foreach ($public_menus as $menu)
          <li class="nav-item {{ $menu->alias == $active ? 'active' : '' }}"><a href="{{ $menu->alias }}"
              class="nav-link">{{ $menu->name }}</a></li>
        @endforeach
        @guest
          <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Đăng nhập</a></li>
          <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Đăng ký</a></li>
        @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-user mr-2"></i>
              <span>Chào, {{ Auth::user()->name }}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="#">
                <i class="icon-vcard mr-2"></i> Thông tin người dùng
              </a>

              <a class="dropdown-item" href="#">
                <i class="icon-lock mr-2"></i> Đổi mật khẩu
              </a>

              <div class="dropdown-divider"></div>

              <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="submit" class="dropdown-item text-danger"
                  style="cursor: pointer; width: 100%; border: none; background: none; text-align: left;">
                  <i class="icon-sign-out mr-2"></i> Đăng xuất
                </button>
              </form>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>