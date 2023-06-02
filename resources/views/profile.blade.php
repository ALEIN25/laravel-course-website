@extends('layout')
@section('content')
<h1>Profile</h1>
<p>Name: {{ $user->name }}</p>
<p>Email: {{ $user->email }}</p>
<p>Phone number: {{ $user->phonenr }}</p>

<p>If you wish to sell please add your shipping information:</p>
<form method="POST" action="{{ route('profile.shipping') }}">
        @csrf
        <div>
            <label for="options">Shipping Options</label>
            <input type="text" id="options" name="options" value="{{ $shippingInformation->options ?? '' }}">
        </div>

        <div>
            <label for="price">Shipping Price</label>
            <input type="text" id="price" name="price" value="{{ $shippingInformation->price ?? '' }}">
        </div>

        <button type="submit">Save Shipping Information</button>
    </form>
@endsection