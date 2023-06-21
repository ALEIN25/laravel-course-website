@extends('layout')

@section('content')
    <h1>Search Results</h1>

    <p>Search query: {{ $query }}</p>

    @if ($books->count() > 0)
        <ul>
            @foreach ($books as $book)
                <li>{{ $book->name }} by {{ $book->author }}</li>
            @endforeach
        </ul>
    @else
        <p>No books found.</p>
    @endif
@endsection
