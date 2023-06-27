@extends('layout')
@section('content')
    <h1>{{__('messages.register')}}</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="hidden" name="locale" value="{{ app()->getLocale() }}">
        <div>
            <label for="name">{{__('messages.name')}}</label>
            <input type="text" id="name" name="name" required autofocus>
        </div>

        <div>
            <label for="email">{{__('messages.email')}}</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="phonenr">{{__('messages.phonenum')}}</label>
            <input type="tel" id="phonenr" name="phonenr" required>
        </div>

        <div>
            <label for="password">{{__('messages.password')}}</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="password_confirmation">{{__('messages.confirmpassword')}}</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit">{{__('messages.register')}}</button>
    </form>
@endsection