@extends('layout')
@section('content')
<div class="book-details">
<img src="{{ asset('storage/images/resized/' . $book->resized_image) }}" alt="Book Image">
        <h1>{{ $book->name }}</h1>
        <p>Author: {{ $book->author }}</p>
        <p>Price: {{ $book->price }}</p>
        <!-- Add more book information here -->


            @csrf
            <!-- Add contact form fields here -->
            <button type="submit">Contact Seller</button>
        </form>
    </div>
@endsection