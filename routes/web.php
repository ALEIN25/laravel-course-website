<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LocalizationController;

Route::get('/lang/{locale}', [LocalizationController::class, 'setLocale'])
    ->name('locale.set')
    ->middleware('locale');

Route::get('/{locale?}', [BookController::class, 'index'])
    ->name('welcome')
    ->middleware('locale');

Route::get('/{locale?}/about', function () {
    return view('about');
})
    ->name('about')
    ->middleware('locale');

Route::middleware(['auth'])->group(function () {
    Route::post('/wishlist/add/{id}', [WishlistController::class, 'addToWishlist'])
        ->name('wishlist.add')
        ->middleware('locale');

    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'removeFromWishlist'])
        ->name('wishlist.remove');
});

Route::get('/{locale?}/wishlist', [WishlistController::class, 'show'])
    ->name('wishlist')
    ->middleware('locale');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/{locale?}/admin', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard')
        ->middleware('locale');

    Route::get('/{locale?}/admin/users', [AdminController::class, 'users'])
        ->name('admin.users')
        ->middleware('locale');

    Route::get('/{locale?}/admin/users/{id}/books', [AdminController::class, 'userBooks'])
        ->name('admin.user.books')
        ->middleware('locale');

    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])
        ->name('admin.user.delete');
});

Route::get('/{locale?}/register', [UserController::class, 'showRegistrationForm'])
    ->name('register')
    ->middleware('locale');

Route::post('/register', [UserController::class, 'register']);

Route::get('/{locale?}/books/search', [BookController::class, 'search'])
    ->name('books.search')
    ->middleware('locale');

Route::get('/{locale?}/login', [LoginController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('locale');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::get('/{locale?}/profile', [ProfileController::class, 'show'])
    ->name('profile')
    ->middleware('auth')
    ->middleware('locale');

Route::post('/profile/shipping', [ProfileController::class, 'updateShipping'])
    ->name('profile.shipping')
    ->middleware('auth');

Route::get('/{locale?}/books/create', [BookController::class, 'create'])
    ->name('books.create')
    ->middleware('locale');

Route::post('/books', [BookController::class, 'store'])
    ->name('books.store');

Route::get('/{locale?}/books/view', [BookController::class, 'view'])
    ->name('books.view')
    ->middleware('locale');
    
Route::get('/{locale?}/books/{id}', [BookController::class, 'show'])
    ->name('books.show')
    ->middleware('locale');
Route::get('/{locale?}/books/{id}/edit', [BookController::class, 'edit'])
    ->name('books.edit')
    ->middleware('locale');

Route::put('/books/update/{id}', [BookController::class, 'update'])
    ->name('books.update');

Route::get('/{locale?}/my-books', [BookController::class, 'myBooks'])
    ->name('my-books')
    ->middleware('auth')
    ->middleware('locale');

Route::delete('/books/delete/{id}', [BookController::class, 'destroy'])
    ->name('books.destroy');
Route::delete('/books/admindelete/{id}', [BookController::class, 'admindestroy'])
    ->name('books.admindestroy');