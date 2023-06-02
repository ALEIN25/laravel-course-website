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
  <a href="{{route('welcome')}}" class="logo">InkVendor</a>
  <div class="navigation">
    <a href="#">Start Selling!</a>
    <a href="#">Start Buying!</a>
  </div>
  <div class="search-bar">
    <input type="text" placeholder="Search">
    <button type="submit">Search</button>
  </div>
  @auth
  <div class="user-actions">
    <a href="{{ route('profile') }}">Profile</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

  </div>
  @else
  <div class="user-actions">
    <a href="{{ route('login') }}">Login</a>
    <a href="{{route('register')}}">Register</a>
  </div>
  @endauth
</div>
</header>
<main>
    @yield('content')
</main>

<footer>
<div class="bottom-bar">
  <a href="{{ route('about') }}" class="centered-text">Find out more about us</a>
  <a href="#" class="right-aligned-text">Contact us</a>
</div>
</footer>
</body>
</html>