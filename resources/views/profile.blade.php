@extends('layout')

@section('content')
    <div class="profile-container">
        <h1>Profile</h1>
        <p>Name: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Phone number: {{ $user->phonenr }}</p>
        <a href="{{ route('my-books') }}">My Books</a>
    </div>
@endsection
