<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('user_id', $user->id)->with('book')->get();

        return view('wishlist', ['wishlist' => $wishlist]);
    }
    public function addToWishlist(Request $request, $id)
    {
        $user = $request->user();

        $book = Book::findOrFail($id);
        if ($book->seller == $user->id) {
            return redirect()->back()->with('message', 'You cannot wishlist your own book.');
        }

        if ($user->wishlist()->where('book_id', $id)->exists()) {
            return redirect()->back()->with('message', 'Book is already in your wishlist.');
        }

        $wishlist = new Wishlist();
        $wishlist->user_id = $user->id;
        $wishlist->book_id = $id;
        $wishlist->save();

        return redirect()->back()->with('message', 'Book added to your wishlist.');
    }

    public function removeFromWishlist(Request $request, $id)
    {
        $user = $request->user();

        $wishlist = $user->wishlist()->where('book_id', $id)->first();
        if ($wishlist) {
            $user->wishlist()->detach($id);
            return redirect()->back()->with('message', 'Book removed from your wishlist.');
        }

        return redirect()->back()->with('message', 'Book is not in your wishlist.');
    }
}

