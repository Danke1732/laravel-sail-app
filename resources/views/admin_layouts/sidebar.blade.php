<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <ul class="nav side-menu">
      <li><a><i class="fa fa-newspaper-o"></i> 広告 <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('admin.ads_list') }}">広告一覧</a></li>
          <li><a href="{{ route('admin.ads_new') }}">広告追加</a></li>
          <!-- <li><a href="index3.html">Dashboard3</a></li> -->
        </ul>
      </li>
      <li><a><i class="fa fa-group"></i> ユーザー管理 <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('admin.user_list') }}">ユーザー一覧</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>