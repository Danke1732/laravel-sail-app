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
          <li class="nav-item">
            <button id="withdraw" class="btn logout d-block px-0 px-lg-2 w-100 text-left" data-bs-toggle="modal" data-bs-target="#exampleModal">退会</button>
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

@if (Auth::check())
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">退会処理</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        記録されている過去の計算データも削除されます。<br />
        <br />
        退会してもよろしいですか？
      </div>
      <form action="/user/withdraw/{{ Auth::id() }}" method="POST" class="modal-footer">
        @csrf
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">戻る</button>
        <button type="submit" class="btn btn-danger">退会する</button>
      </form>
    </div>
  </div>
</div>
@endif