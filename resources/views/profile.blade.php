@extends('layout')

@section('content')
    <div class="profile-container">
        <h1>{{__('messages.profile')}}</h1>
        <p>{{__('messages.name')}} {{ $user->name }}</p>
        <p>{{__('messages.email')}} {{ $user->email }}</p>
        <p>{{__('messages.phonenum')}} {{ $user->phonenr }}</p>
        <a href="{{ route('my-books', ['locale' => app()->getLocale()])}}">My Books</a>
    </div>
@endsection
