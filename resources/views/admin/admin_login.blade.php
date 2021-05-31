<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>管理者ログイン | 不動産投資利回りシュミレーションツール｜ローンや経費を一括自動計算</title>
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
  <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
  <!-- Styles -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/signin.css') }}">
  <!-- Scripts -->
  <script src="https://kit.fontawesome.com/5f12186527.js" crossorigin="anonymous"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div class="form-wrapper shadow-sm">
  @if ($errors->any())
    <div>
      <ul class="list-group list-group-flush">
        @foreach ($errors->all() as $error)
          <li class="list-group-item list-group-item-danger py-3 text-center">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <x-alert type="danger" :session="session('danger')"/>
  <h1>Admin Sign In</h1>
  <form action="{{ route('admin.login') }}" method="POST" autocomplete="off">
    @csrf
    <div class="form-item">
      <label for="admin_id"></label>
      <input type="text" name="admin_id" placeholder="Admin ID" required autofocus>
    </div>
    <div class="form-item">
      <label for="password"></label>
      <input type="password" name="password" placeholder="Password" required>
    </div>
    <div class="button-panel">
      <input type="submit" class="button" title="Sign In" value="Sign In"></input>
    </div>
</form>
</div>
</body>
</html>