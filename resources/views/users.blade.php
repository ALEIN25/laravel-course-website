@extends('layout')
@section('content')
@if(session('message'))
    <div>{{ __(session('message')) }}</div>
@endif
<h1>{{__('messages.users')}}</h1>

<table>
    <thead>
        <tr>
            <th>{{__('messages.name')}}</th>
            <th>{{__('messages.email')}}</th>
            <th>{{__('messages.phonenum')}}</th>
            <th>{{__('messages.role')}}</th>
            <th>{{__('messages.actions')}}</th>
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
                <a href="{{ route('admin.user.books', ['id' => $user->id, 'locale' => app()->getLocale()]) }}">{{__('messages.viewbooks')}}</a>
                <form action="{{ route('admin.user.delete', ['locale' => app()->getLocale(), 'id' => $user->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <button type="submit">{{__('messages.deleteprofile')}}</button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection