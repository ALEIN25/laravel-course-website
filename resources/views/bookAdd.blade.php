@extends('layout')
@section('content')
    <h1>Create Book</h1>
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

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>
        </div>

        <div>
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn" required>
        </div>

        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>

        <div>
            <label for="release_date">Release Date:</label>
            <input type="date" id="release_date" name="release_date" required>
        </div>

        <div>
            <label for="condition">Condition:</label>
            <textarea id="condition" name="condition"></textarea>
        </div>

        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" required>
        </div>

        <button type="submit">Create Book</button>
    </form>
@endsection
