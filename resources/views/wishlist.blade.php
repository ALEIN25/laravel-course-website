@extends('layout')

@section('content')
@if(session('message'))
<div>{{ session('message') }}</div>
@endif

<h1>My Wishlist</h1>
<div class="book-list">
    @foreach($wishlist as $item)
    <div class="book-details">
        @if($item->book)
        <div class="book-item">
        <a href="{{ route('books.show', ['id' => $item->book->id]) }}">
            <img src="{{ asset('storage/images/resized/' . $item->book->resized_image) }}" alt="Book Image">
            <h2>{{ $item->book->name }}</h2>
            <p>Author: {{ $item->book->author }}</p>
            <p>Price: {{ $item->book->price }}</p>
            <p>ISBN: {{ $item->book->ISBN }}</p>
            <p>Release date: {{ $item->book->release_date }}</p>
            <p>Comment: {{ $item->book->condition }}</p>
            <form action="{{ route('wishlist.remove', $item->book->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Remove from Wishlist</button>
            </form>
        </div>
        @else
        <p>Book not found</p>
        @endif
    </div>
    @endforeach
    <div class="book-list">

        @endsection