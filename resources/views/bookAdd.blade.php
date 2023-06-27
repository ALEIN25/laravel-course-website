@extends('layout')
@section('content')
@auth
    <h1>{{__('messages.create')}}</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="locale" value="{{ app()->getLocale() }}">
        <div>
            <label for="name">{{__('messages.name')}}</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="author">{{__('messages.author')}}</label>
            <input type="text" id="author" name="author" required>
        </div>

        <div>
            <label for="isbn">{{__('messages.isbn')}}</label>
            <input type="text" id="isbn" name="isbn" required>
        </div>

        <div>
            <label for="price">{{__('messages.price')}}</label>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>

        <div>
            <label for="release_date">{{__('messages.release')}}</label>
            <input type="date" id="release_date" name="release_date" required>
        </div>

        <div>
            <label for="condition">{{__('messages.condition')}}</label>
            <textarea id="condition" name="condition"></textarea>
        </div>

        <div>
            <label for="image">{{__('messages.image')}}</label>
            <input type="file" id="image" name="image" required>
        </div>

        <button type="submit">{{__('messages.add')}}</button>
    </form>
    @else
    <p>{{__('messages.addlogin')}}</p>
@endauth
@endsection
