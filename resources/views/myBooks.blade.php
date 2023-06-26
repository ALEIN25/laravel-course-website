@extends('layout')
@section('content')
<a href="{{ route('profile') }}">Back</a>
<h1>My Books</h1>

<div class="book-list">
    @foreach ($books as $book)
        <div class="book-item">
        <a href="{{ route('books.show', ['id' => $book->id]) }}">
            <img src="{{ asset('storage/images/resized/' . $book->resized_image) }}" alt="Book Image">
            <h3>{{ $book->name }}</h3>
            <p>Author: {{ $book->author }}</p>
            <p>Price: {{ $book->price }}</p>

            <div class="book-actions">
                <form method="POST" action="{{ route('books.destroy', ['id' => $book->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Remove</button>
                </form>

                <a href="{{ route('books.edit', ['id' => $book->id]) }}">Edit</a>
            </div>
        </a>
        </div>
    @endforeach
</div>
@endsection