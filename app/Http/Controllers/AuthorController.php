<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $authors = Author::all();

        return $authors;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("authors.create");
    }   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','max:255'],
            'birth_date' => ['required', 'date'],
        ]);
        //
        $author = new Author;
        $author->name = $request->input('name');
        $author->birth_date = $request->input('birth_date');
        $author->save();

        return $author;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $author = Author::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $author,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $author = Author::findOrFail($id);
        return view("authors.edit", ["author" => $author]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required','max:255'],
            'birth_date' => ['required', 'date'],
        ]);
        
        //
        $author = Author::findOrFail($id);
        $author->name = $request->input('name');
        $author->birth_date = $request->input('birth_date');
        $author->save();

        return $author;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $author = Author::findOrFail($id);
        $author->delete();
        return response()->json([
            'success' => true,
            'data' => $author,
        ]);
    }
}
