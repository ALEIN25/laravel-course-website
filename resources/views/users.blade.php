@extends('layout')
@section('content')
@if(session('message'))
<div>{{ session('message') }}</div>
@endif
<h1>Users</h1>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>PhoneNr</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phonenr }}</td>
            <td>{{ $user->role }}</td>
            <td>
                <a href="{{ route('admin.user.books', ['id' => $user->id]) }}">View Books</a>
                <form action="{{ route('admin.user.delete', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete Profile</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
