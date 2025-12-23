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
        <li class="nav-item cta"><a href="{{ route('admin') }}" class="nav-link"><span>Admin</span></a></li>
      </ul>
      @if(Auth::check())
        <form method="post" action="logout">
          @csrf
          <button type="submit">logout</button>
        </form>
      @endif
    </div>
  </div>
</nav>