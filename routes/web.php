<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Models\Author;
use App\Models\Book;

Route::get('/', function () {
    $authors = Author::all();
    // return view('authors.index', ['authors' => $authors]);
    return view('welcome');
});

Route::get('authors', function () {
    $authors = Author::all();
    return view('authors.index', ['authors' => $authors]);
});

Route::get('authors/create', function () {
    return view('authors.create');
});

Route::get('books', function () {
    $books = Book::all();
    return view('books.index', ['books' => $books]);
});

Route::get('books/create', function () {
    return view('books.create');
});

Route::get('/token', function () {
    return csrf_token(); 
});
