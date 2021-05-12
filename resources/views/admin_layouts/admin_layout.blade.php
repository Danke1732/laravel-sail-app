<!DOCTYPE html>
<html lang="ja">
  <head>
    @include('admin_layouts.head')
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ route('admin.ads_list') }}" class="site_title"><span>不動産投資計算App</span></a>
            </div>

            <div class="clearfix"></div>

            <br />

            <!-- sidebar menu -->
            @include('admin_layouts.sidebar')
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        @include('admin_layouts.header')
        <!-- /top navigation -->

        <!-- page content -->
        @yield('content')
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <!-- @include('admin_layouts.footer') -->
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    @include('admin_layouts.foot')
  </body>
</html>