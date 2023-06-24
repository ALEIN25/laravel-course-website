<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\WishlistController;

Route::get('/', function () {return view('welcome');})->name('welcome');
Route::get('/about', function () {return view('about');})->name('about');

Route::middleware(['auth'])->group(function () {
    Route::post('/wishlist/add/{id}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
});
Route::get('/wishlist', [WishlistController::class, 'show'])->name('wishlist');


Route::get('/register', 'UserController@showRegistrationForm')->name('register');

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

Route::get('/books/search', [BookController::class, 'search'])->name('books.search');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');

Route::post('/profile/shipping', [ProfileController::class, 'updateShipping'])->middleware('auth')->name('profile.shipping');

Route::get('/books/create', [BookController::class, 'create'])->name('books.create');

Route::post('/books', [BookController::class, 'store'])->name('books.store');

Route::get('/', [BookController::class, 'index'])->name('welcome');

Route::get('/books/view', [BookController::class, 'view'])->name('books.view');

Route::get('/books', [BookController::class, 'indexBook'])->name('books.index');

Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

Route::get('/my-books', [BookController::class, 'myBooks'])->name('my-books')->middleware('auth');

Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');


