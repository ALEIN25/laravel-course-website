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
        // Fetch three random books from the database
        $books = Book::inRandomOrder()->limit(3)->get();
    
        foreach ($books as $book) {
            $book->image = asset('storage/images/resized/' . $book->image);
        }
    
        return view('welcome', ['books' => $books]);
    }
    
    public function view()
    {
        // Fetch the books from the database
        $books = Book::all();
        foreach ($books as $book) {
            $book->image = asset('storage/images/resized/' . $book->image);
        }
        return view('books', ['books' => $books]);
    }
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('bookView', ['book' => $book]);
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
    
            // Generate a unique filename for the resized image
            $resizedImageFilename = 'resized_' . uniqid() . '.jpg';
    
            // Store the resized image in the storage directory
            $resizedImagePath = 'public/images/resized/' . $resizedImageFilename;
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
            $book->resized_image = $resizedImageFilename;
            $book->save();
    
            return redirect()->back()->with('success', 'Book added successfully.');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $errors = collect([$errorMessage]);
    
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }
    
}


