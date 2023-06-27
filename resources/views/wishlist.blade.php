@extends('layout')

@section('content')
@if(session('message'))
    <div>{{ __(session('message')) }}</div>
@endif

<h1>{{__('messages.mywishlist')}}</h1>
<div class="book-list">
    @foreach($wishlist as $item)
    <div class="book-details">
        @if($item->book)
        <div class="book-item">
        <a href="{{ route('books.show', ['id' => $item->book->id, 'locale' => app()->getLocale()]) }}">
                <img src="{{ asset('storage/images/resized/' . $item->book->resized_image) }}" alt="Book Image">
                <h2>{{ $item->book->name }}</h2>
                <p>{{__('messages.author')}} {{ $item->book->author }}</p>
                <p>{{__('messages.price')}} {{ $item->book->price }}</p>
                <p>{{__('messages.isbn')}} {{ $item->book->ISBN }}</p>
                <p>{{__('messages.release')}} {{ $item->book->release_date }}</p>
                <p>{{__('messages.condition')}} {{ $item->book->condition }}</p>
                <form action="{{ route('wishlist.remove', $item->book->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">{{__('messages.remove')}}</button>
                </form>
        </div>
        @else
        <p>{{__('messages.nonfound')}}</p>
        @endif
    </div>
    @endforeach
    <div class="book-list">

        @endsection