@extends('layout')
@section('content')
@if(session('message'))
    <div>{{ __(session('message')) }}</div>
@endif
<h1>{{__('messages.login')}}</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="hidden" name="locale" value="{{ app()->getLocale() }}">
    <div>
        <label for="email">{{__('messages.email')}}</label>
        <input type="email" id="email" name="email" required autofocus>
    </div>

    <div>
        <label for="password">{{__('messages.password')}}</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div>
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">{{__('messages.remember')}}</label>
    </div>

    <button type="submit">{{__('messages.login')}}</button>
</form>
@endsection