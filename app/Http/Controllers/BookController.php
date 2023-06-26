<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageManager;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function create()
    {
        return view('bookAdd');
    }
    public function index()
    {
        $books = Book::inRandomOrder()->limit(3)->get();

        foreach ($books as $book) {
            $book->image = asset('storage/images/resized/' . $book->image);
        }

        return view('welcome', ['books' => $books]);
    }

    public function view()
    {
        $books = Book::all();
        foreach ($books as $book) {
            $book->image = asset('storage/images/resized/' . $book->image);
        }
        return view('books', ['books' => $books]);
    }
    public function show($id)
    {
        $book = Book::with('seller')->findOrFail($id);
        return view('bookView', ['book' => $book]);
    }
    
    public function myBooks()
    {
        $user = Auth::user();
        $books = Book::where('seller', $user->id)->get();

        return view('myBooks', ['books' => $books]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'price' => 'required|numeric',
            'release_date' => 'required|date',
            'condition' => 'nullable',
            'image' => 'required|image',
        ]);

        try {
            $image = $request->file('image');
            $imagePath = $image->store('public/images');
            $imagePath = str_replace('public/', '', $imagePath);
            $resizedImage = ImageManager::make($image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resizedImageFilename = 'resized_' . uniqid() . '.jpg';
            $resizedImagePath = 'public/images/resized/' . $resizedImageFilename;
            Storage::put($resizedImagePath, $resizedImage->encode('jpg'));
            $book = new Book(['seller' => auth()->id()]);
            $book->name = $request->input('name');
            $book->author = $request->input('author');
            $book->isbn = $request->input('isbn');
            $book->price = $request->input('price');
            $book->release_date = $request->input('release_date');
            $book->condition = $request->input('condition');
            $book->image = $imagePath;
            $book->resized_image = $resizedImageFilename;
            $book->save();

            return redirect()->route('books.show', ['id' => $book->id])->with('message', 'Book added successfully.');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $errors = collect([$errorMessage]);

            return redirect()->back()->withErrors($errors)->withInput();
        }
    }
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        Storage::delete([
            'public/' . $book->image,
            'public/images/resized/' . $book->resized_image,
        ]);
        $book->delete();

        return redirect()->back()->with('message', 'Book removed successfully.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);

        return view('bookEdit', ['book' => $book]);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'ISBN' => 'required',
            'price' => 'required|numeric',
            'release_date' => 'required|date',
            'condition' => 'nullable',
        ]);

        try {
            $book->name = $request->input('name');
            $book->author = $request->input('author');
            $book->isbn = $request->input('ISBN');
            $book->price = $request->input('price');
            $book->release_date = $request->input('release_date');
            $book->condition = $request->input('condition');
            $book->save();

            return redirect()->route('books.show', ['id' => $book->id])->with('message', 'Book updated successfully.');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $errors = collect([$errorMessage]);

            return redirect()->back()->withErrors($errors)->withInput();
        }
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $books = Book::where('name', 'like', '%' . $query . '%')
            ->orWhere('author', 'like', '%' . $query . '%')
            ->orWhere('ISBN', 'like', '%' . $query . '%')
            ->get();

        return view('search', [
            'books' => $books,
            'query' => $query
        ]);
    }
}


