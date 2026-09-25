<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books = Book::all();
        // return response()->json([
        //     'success' => true,
        //     'data' => $books,
        // ]);
        return $books;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("books.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'title' => ['required','max:255'],
            'author_id' => ['required', 'exists:authors,id'],
            'published_date' => ['required', 'date']
        ]);

        //
        $book = new Book;
        $book->title = $request->input('title');
        $book->author_id = $request->input('author_id');
        $book->published_date = $request->input('published_date');
        $book->save();

        // return redirect()->route('books.index')
        // ->with('success', 'books created successfully!');
        return $book;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $book = Book::findOrFail($id);
        // return response()->json([
        //     'success' => true,
        //     'data' => $book,
        // ]);
        return $book;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $book = Book::findOrFail($id);
        return view("books.edit", ["book" => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $book = Book::findOrFail($id);
        $book->title = $request->input('title');
        $book->author_id = $request->input('author_id');
        $book->published_date = $request->input('published_date');
        $book->save();

        return response()->json([
            'success' => true,
            'data' => $book
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json([
            'success' => true,
            'data' => $book,
        ]);
    }
}
