@extends('layout')
@section('content')
<h1>{{__('messages.edit')}}</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<form method="POST" action="{{ route('books.update', ['id' => $book->id]) }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="locale" value="{{ app()->getLocale() }}">
    <div>
        <label for="name">{{__('messages.name')}}</label>
        <input type="text" id="name" name="name" value="{{ $book->name }}">
    </div>

    <div>
        <label for="author">{{__('messages.author')}}</label>
        <input type="text" id="author" name="author" value="{{ $book->author }}">
    </div>

    <div>
        <label for="isbn">{{__('messages.isbn')}}</label>
        <input type="text" id="isbn" name="ISBN" value="{{ $book->ISBN }}">
    </div>

    <div>
        <label for="price">{{__('messages.price')}}</label>
        <input type="number" id="price" name="price" step="0.01" value="{{ $book->price }}">
    </div>

    <div>
        <label for="release_date">{{__('messages.release')}}</label>
        <input type="date" id="release_date" name="release_date" value="{{ $book->release_date }}">
    </div>

    <div>
        <label for="condition">{{__('messages.condition')}}</label>
        <input type="text" id="condition" name="condition" value="{{ $book->condition }}">
    </div>

    <button type="submit">{{__('messages.update')}}</button>
</form>
@endsection