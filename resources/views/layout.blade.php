<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
  <title>InkVendor</title>
</head>

<body>
  <header>
    <div class="website-bar">
      <a href="{{ route('welcome', ['locale' => app()->getLocale()]) }}" class="logo">InkVendor</a>
      <div class="navigation">
        <a href="{{ route('books.create', ['locale' => app()->getLocale()]) }}">{{__('messages.sell')}}</a>
        <a href="{{ route('books.view', ['locale' => app()->getLocale()]) }}">{{__('messages.buy')}}</a>
      </div>
      <div class="search-bar">
        <form action="{{ route('books.search', ['locale' => app()->getLocale()]) }}" method="GET">
          <input type="search" name="query">
          <button type="submit">{{__('messages.search')}}</button>
        </form>
      </div>
      <ul>
        <li><a href="{{ route('locale.set', ['locale' => 'en']) }}">English</a></li>
        <li><a href="{{ route('locale.set', ['locale' => 'lv']) }}">Latviski</a></li>
      </ul>

      @auth
      @if (Auth::user()->isAdmin())
      <a href="{{ route('admin.users', ['locale' => app()->getLocale()]) }}">{{__('messages.viewusers')}}</a>


      @endif

      <div class="user-actions">
        <a href="{{ route('wishlist', ['locale' => app()->getLocale()]) }}">{{__('messages.wishlist')}}</a>
        <a href="{{ route('profile', ['locale' => app()->getLocale()]) }}">{{__('messages.profile')}}</a>
        <a href="{{ route('logout', ['locale' => app()->getLocale()]) }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          {{__('messages.logout')}}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>

      </div>
      @else
      <div class="user-actions">
        <a href="{{ route('login', ['locale' => app()->getLocale()]) }}">{{__('messages.login')}}</a>
        <a href="{{route('register', ['locale' => app()->getLocale()])}}">{{__('messages.register')}}</a>
      </div>
      @endauth
    </div>


  </header>

  <main>
    @yield('content')
  </main>

  <footer>
    <div class="bottom-bar">
      <a href="{{ route('about', ['locale' => app()->getLocale()]) }}" class="centered-text">{{__('messages.aboutus')}}</a>
    </div>
  </footer>
</body>

</html>