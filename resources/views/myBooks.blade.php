@extends('layout')
@section('content')
<a href="{{ route('profile', ['locale' => app()->getLocale()]) }}">{{__('messages.back')}}</a>
@if(session('message'))
    <div>{{ __(session('message')) }}</div>
@endif
<h1>{{__('messages.mybooks')}}</h1>

<div class="book-list">
    @foreach ($books as $book)
        <div class="book-item">
        <a href="{{ route('books.show', ['id' => $book->id, 'locale' => app()->getLocale()]) }}">
            <img src="{{ asset('storage/images/resized/' . $book->resized_image) }}" alt="Book Image">
            <h3>{{ $book->name }}</h3>
            <p>{{__('messages.author')}} {{ $book->author }}</p>
            <p>{{__('messages.price')}} {{ $book->price }}</p>

            <div class="book-actions">
                <form method="POST" action="{{ route('books.destroy', ['id' => $book->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">{{__('messages.remove')}}</button>
                </form>

                <a href="{{ route('books.edit', [ 'locale' => app()->getLocale(), 'id' => $book->id]) }}">{{__('messages.edit')}}</a>
            </div>
        </a>
        </div>
    @endforeach
</div>
@endsection