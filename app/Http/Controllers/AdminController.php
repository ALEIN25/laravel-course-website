<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function users()
    {

        $users = User::all();

        return view('users', ['users' => $users]);
    }
    public function userBooks($id)
    {
        $user = User::with('books')->findOrFail($id);
        return view('user_books', ['user' => $user]);
    }

    public function deleteUser($id)
    {

        $user = User::findOrFail($id);

        if ($user->isAdmin()) {

            return redirect()->back()->with('message', 'You do not have permission to delete an admin.');
        }
        $user->books()->delete();


        $user->delete();

        return redirect()->route('admin.users')->with('message', 'User profile and associated books deleted successfully.');
    }
}
