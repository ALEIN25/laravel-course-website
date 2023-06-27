<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function users()
    {

        $users = User::all();

        return view('users', ['users' => $users]);
    }
    public function userBooks($locale, $id)
    {
        $user = User::with('books')->findOrFail($id);
        return view('user_books', ['user' => $user]);
    }

    public function deleteUser(Request $request)
    {
        $id = $request->input('id');
        $user = User::findOrFail($id);
    
        $books = $user->books;
        foreach ($books as $book) {
            Storage::disk('public')->delete([
                $book->image,
                'images/resized/' . $book->resized_image,
            ]);
    
            $book->delete();
        }
    
        $user->delete();
    
        return redirect()->back()->with('message', 'messages.userremoved');
    }
}
