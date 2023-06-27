@extends('layout')
@section('content')
<a href="{{ route('admin.users', ['locale' => app()->getLocale()]) }}">Back</a>

@if(session('message'))
    <div>{{ __(session('message')) }}</div>
@endif
<h1>{{__('messages.userbooks')}} - {{ $user->name }}</h1>

@if ($user->books->count() > 0)
    <ul>
        @foreach ($user->books as $book)
            <li> <img src="{{ asset('storage/images/resized/' . $book->resized_image) }}" alt="Book Image" width="10%"> 
            {{__('messages.name')}} {{ $book->name }} {{__('messages.author')}} {{ $book->author}} {{__('messages.isbn')}} {{ $book->ISBN }} {{__('messages.condition')}} {{ $book->condition }}     
            <form method="POST" action="{{ route('books.destroy', ['id' => $book->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">{{__('messages.remove')}}</button>
                </form>
            </li>
        @endforeach
    </ul>
@else
    <p>{{__('messages.nonfound')}}</p>
@endif

@endsection
