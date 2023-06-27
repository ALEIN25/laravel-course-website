@extends('layout')

@section('content')
    <h1>{{__('messages.browse')}}</h1>

    <div class="book-list">
        @foreach ($books as $book)
            <div class="book-item">
            <a href="{{ route('books.show', ['id' => $book->id, 'locale' => app()->getLocale()]) }}">
                <img src="{{ asset('storage/images/resized/' . $book->resized_image) }}" alt="Book Image">
                <h3>{{ $book->name }}</h3>
                <p>{{__('messages.author')}} {{ $book->author }}</p>
                <p>{{__('messages.price')}} {{ $book->price }}</p>
            </a>
            </div>
        @endforeach
    </div>
@endsection
