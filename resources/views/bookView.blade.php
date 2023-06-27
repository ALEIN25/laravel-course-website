@extends('layout')
@section('content')
@if(session('message'))
    <div>{{ __(session('message')) }}</div>
@endif
<div class="book-details">
    <img src="{{ asset('storage/images/resized/' . $book->resized_image) }}" alt="Book Image">
    <h1>{{ $book->name }}</h1>
    <p>{{__('messages.author')}} {{ $book->author }}</p>
    <p>{{__('messages.price')}} {{ $book->price }}</p>
    <p>{{__('messages.isbn')}} {{ $book->ISBN }}</p>
    <p>{{__('messages.release')}} {{ $book->release_date }}</p>
    <p>{{__('messages.condition')}} {{ $book->condition}}</p>
    @csrf
</div>
<button id="reveal-info">{{__('messages.show')}}</button>
<div id="seller-info" style="display: none;">
    <h2>{{__('messages.sellerinfo')}}</h2>
    @php
    $sellerInfo = $book->getSellerInfo();
    @endphp
    @if ($sellerInfo)
    <p>{{__('messages.email')}} {{ $sellerInfo['email'] }}</p>
    <p>{{__('messages.phonenum')}} {{ $sellerInfo['phonenr'] }}</p>
    @else
    <p>No user info.</p>
    @endif
</div>

<script>
    document.getElementById('reveal-info').addEventListener('click', function() {
        var sellerInfo = document.getElementById('seller-info');
        sellerInfo.style.display = sellerInfo.style.display === 'none' ? 'block' : 'none';
    });
</script>


@auth
@if(Auth::user()->isAdmin())
<form method="POST" action="{{ route('books.admindestroy', ['id' => $book->id]) }}">
    @csrf
    @method('DELETE')
    <button type="submit">{{__('messages.remove')}}</button>
</form>
@endif
@endauth
@if(auth()->check() && auth()->user()->isInWishlist($book))
<form action="{{ route('wishlist.remove', $book->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">{{__('messages.removewishlist')}}</button>
</form>
@else

<form action="{{ route('wishlist.add', ['id' => $book->id]) }}" method="POST">
    @csrf
    <button type="submit">{{__('messages.addwishlist')}}</button>
</form>
@endif
</div>
@endsection