@extends('layout')
@section('content')

<p class="welcome-message">Welcome to InkVendor, a online platform that let's you sell and buy books directly.</p>
<p class="welcome-message">We believe that books are a way to a better life. Join us! </p>

<div class="book-list">
        @foreach ($books as $book)
            <div class="book-item">
            <a href="{{ route('books.show', ['id' => $book->id]) }}">
            <img src="{{ asset('storage/images/resized/' . $book->resized_image) }}" alt="Book Image">
                <h3>{{ $book->name }}</h3>
                <p>Author: {{ $book->author }}</p>
                <p>Price: {{ $book->price }}</p>
            </div>
        @endforeach
    </div>

@endsection