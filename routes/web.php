<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return view('welcome');})->name('welcome');
Route::get('/about', function () {return view('about');})->name('about');


Route::get('/register', 'UserController@showRegistrationForm')->name('register');

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);



// Route for displaying the login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route for handling the login form submission
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Route for logging out the user
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




