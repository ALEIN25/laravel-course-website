@extends('layout')
@section('content')
@if(session('message'))
<div>{{ session('message') }}</div>
@endif
<h1>User Books - {{ $user->name }}</h1>

@if ($user->books->count() > 0)
    <ul>
        @foreach ($user->books as $book)
            <li> <img src="{{ asset('storage/images/resized/' . $book->resized_image) }}" alt="Book Image" width="10%"> 
            Title: {{ $book->name }} Author: {{ $book->author}} ISBN: {{ $book->ISBN }} Comment: {{ $book->condition }}     
            <form method="POST" action="{{ route('books.destroy', ['id' => $book->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Remove</button>
                </form>
            </li>
        @endforeach
    </ul>
@else
    <p>No books found for this user.</p>
@endif

@endsection
