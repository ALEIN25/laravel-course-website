@extends('layout')

@section('content')
    <h1>Browse for the perfect book</h1>

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
