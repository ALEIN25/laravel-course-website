<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageManager;

class BookController extends Controller
{
    public function create()
    {
        return view('bookAdd');
    }
    public function index()
    {
        // Fetch the books from the database
        $books = Book::all();

        // Pass the books to the view
        return view('welcome', ['books' => $books]);
    }
    public function store(Request $request)
    {
        // Validate the form data
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
            // Save the uploaded image to the storage directory
            $image = $request->file('image');
            $imagePath = $image->store('public/images');
            $imagePath = str_replace('public/', '', $imagePath);
    
            // Resize and encode the image
            $image = ImageManager::make($image)->encode('jpg');
    
            // Store the resized image in the storage directory
            $resizedImagePath = 'public/images/resized/' . $image->basename;
            Storage::put($resizedImagePath, $image);
    
            // Store the book information including the image paths in the database
            $book = new Book(['seller' => auth()->id()]);
            $book->name = $request->input('name');
            $book->author = $request->input('author');
            $book->isbn = $request->input('isbn');
            $book->price = $request->input('price');
            $book->release_date = $request->input('release_date');
            $book->condition = $request->input('condition');
            $book->image = $imagePath;
            $book->resized_image = $resizedImagePath;
            $book->save();
    
            return redirect()->back()->with('success', 'Book added successfully.');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $errors = collect([$errorMessage]);
    
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }
    
}


