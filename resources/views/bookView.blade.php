@extends('layout')
@section('content')
@if(session('message'))
<div>{{ session('message') }}</div>
@endif
<div class="book-details">
    <img src="{{ asset('storage/images/resized/' . $book->resized_image) }}" alt="Book Image">
    <h1>{{ $book->name }}</h1>
    <p>Author: {{ $book->author }}</p>
    <p>Price: {{ $book->price }}</p>
    <p>ISBN: {{ $book->ISBN }}</p>
    <p>Release date: {{ $book->release_date }}</p>
    <p>Comment: {{ $book->condition}}</p>
    @csrf
</div>
<button id="reveal-info">Show seller information</button>
<div id="seller-info" style="display: none;">
    <h2>Seller Information</h2>
    @php
    $sellerInfo = $book->getSellerInfo();
    @endphp
    @if ($sellerInfo)
    <p>Email: {{ $sellerInfo['email'] }}</p>
    <p>Phone Number: {{ $sellerInfo['phonenr'] }}</p>
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
<form method="POST" action="{{ route('books.destroy', ['id' => $book->id]) }}">
    @csrf
    @method('DELETE')
    <button type="submit">Remove</button>
</form>
@endif
@endauth
@if(auth()->check() && auth()->user()->isInWishlist($book))
<form action="{{ route('wishlist.remove', $book->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Remove from Wishlist</button>
</form>
@else

<form action="{{ route('wishlist.add', ['id' => $book->id]) }}" method="POST">
    @csrf
    <button type="submit">Add to Wishlist</button>
</form>
@endif
</div>
@endsection