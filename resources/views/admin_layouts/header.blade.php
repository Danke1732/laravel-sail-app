<div class="top_nav">
  <div class="nav_menu">
      <div class="nav toggle mt-2">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
      <nav class="nav navbar-nav">
      <ul class=" navbar-right">
        <li class="nav-item dropdown open" style="padding-left: 15px;">
        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <input type="submit" value=" ログアウト" class="dropdown-item logout rounded">
        </form>
        </li>
      </ul>
    </nav>
  </div>
</div>