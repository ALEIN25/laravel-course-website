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
  <div class="user-actions">
    <a href="#">Login</a>
    <a href="#">Register</a>
  </div>
</div>
<p class="welcome-message">Welcome to InkVendor, a online platform that let's you sell and buy books directly.</p>
<p class="welcome-message">We believe that books are a way to a better life. Join us! </p>




<div class="bottom-bar">
  <a href="{{ route('about') }}" class="centered-text">Find out more about us</a>
  <a href="#" class="right-aligned-text">Contact us</a>
</div>
</body>
</html>