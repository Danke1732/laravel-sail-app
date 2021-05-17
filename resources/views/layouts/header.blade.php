<header class="header shadow-sm header-bg" id="header">
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand site-logo m-0" href="/">不動産投資利回りシミュレーションツール</a>
      <button class="navbar-toggler color-white p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fas fa-bars"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          @if (Auth::check())
          <li class="nav-item">
            <a class="nav-link" href="#">過去の計算結果</a>
          </li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="btn logout d-block px-0 px-lg-2 w-100 text-left">ログアウト</button>
             </form>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">ログイン</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">新規登録</a>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
</header>