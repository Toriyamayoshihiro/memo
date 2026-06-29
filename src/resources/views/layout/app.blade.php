<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application</title>
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
  <link rel="stylesheet" href="{{ asset('css/common.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  @yield('css')
</head>

<body>
  <header class="site-header">
  <div class="header">
      <h1 class="header__heading">
        <a href="/">APP</a>
      </h1>
      @auth
      <form class="header__search" action="/" method="get">
          <input class="search" type="text" name="keyword" placeholder="何をお探しですか" value="{{request('keyword')}}">
          <button type="submit" class="search_button"></button>
      </form>
        <div class="header__actions">
          <form action="/logout" method="post">
              @csrf
                <button class="header__link">ログアウト</button>
          </form>
          <a href="/memo/create" class="header__button">新規メモ作成</a>
      @endauth
 </div>
</div>
</header>
 @yield('content')
</body>
</html>