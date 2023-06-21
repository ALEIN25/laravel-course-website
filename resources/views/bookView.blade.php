@extends('layout')
@section('content')
<div class="book-details">
<img src="{{ asset('storage/images/resized/' . $book->resized_image) }}" alt="Book Image">
        <h1>{{ $book->name }}</h1>
        <p>Author: {{ $book->author }}</p>
        <p>Price: {{ $book->price }}</p>
        <p>ISBN: {{ $book->ISBN }}</p>
        <p>Release date: {{ $book->release_date }}</p>
        <p>Comment: {{ $book->condition}}</p>
            @csrf

            <button type="submit">Contact Seller</button>
        </form>
    </div>
@endsection