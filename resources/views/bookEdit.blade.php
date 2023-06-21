@extends('layout')
@section('content')
<h1>Edit Book</h1>

<form method="POST" action="{{ route('books.update', ['id' => $book->id]) }}">
    @csrf
    @method('PUT')

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $book->name }}">
    </div>

    <div>
        <label for="author">Author</label>
        <input type="text" id="author" name="author" value="{{ $book->author }}">
    </div>

    <div>
        <label for="isbn">ISBN</label>
        <input type="text" id="isbn" name="ISBN" value="{{ $book->ISBN }}">
    </div>

    <div>
        <label for="price">Price</label>
        <input type="number" id="price" name="price" step="0.01" value="{{ $book->price }}">
    </div>

    <div>
        <label for="release_date">Release Date</label>
        <input type="date" id="release_date" name="release_date" value="{{ $book->release_date }}">
    </div>

    <div>
        <label for="condition">Condition</label>
        <input type="text" id="condition" name="condition" value="{{ $book->condition }}">
    </div>

    <button type="submit">Update Book</button>
</form>
@endsection