

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  @yield('css')
</head>
<body>
  @if($show_header)
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        FashionablyLate
      </a>


      <nav>
        <ul class="header-nav">
          @if($header_button === "login")
          <li class="header-nav__item">
            <form class="header-nav-form" action="/login" method="get">
              @csrf
              <button class="header-nav__button">login</button>
            </form>
          </li>
          @elseif($header_button === "register")
          <li class="header-nav__item">
            <form class="header-nav-form" action="/register" method="get">
              @csrf
              <button class="header-nav__button">register</button>
            </form>
          </li>
          @endif
          @if (Auth::check())
          <li class="header-nav__item">
            <form class="header-nav-form" action="/logout" method="post">
              @csrf
              <button class="header-nav__button">logout</button>
            </form>
          </li>
          @endif

        </ul>
      <nav>
    </div>

  </header>
  @endif
  <main>
    @yield('content')
  </main>
</body>

</html>
