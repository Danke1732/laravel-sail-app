<!DOCTYPE html>
<html lang="ja">
  <head>
    @include('layouts.head')
  </head>
  <body>
    @include('layouts.header')

    @yield('content')

    @include('layouts.foot')
  </body>
</html>
