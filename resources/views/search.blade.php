@extends('layout')

@section('content')
    <h1>{{__('messages.searchres')}}</h1>

    <p>{{__('messages.searchquery')}} {{ $query }}</p>

    @if ($books->count() > 0)
    <div class="book-list">
        @foreach ($books as $book)
            <div class="book-item">
            <a href="{{ route('books.show', ['id' => $book->id, 'locale' => app()->getLocale()]) }}">
                <img src="{{ asset('storage/images/resized/' . $book->resized_image) }}" alt="Book Image">
                <h3>{{ $book->name }}</h3>
                <p>{{__('messages.author')}} {{ $book->author }}</p>
                <p>{{__('messages.price')}} {{ $book->price }}</p>
            </div>
        @endforeach
    </div>
    @else
        <p>{{__('messages.nonfound')}}</p>
    @endif
@endsection
