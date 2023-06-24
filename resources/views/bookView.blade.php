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