<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

public function index(Request $request)
{
    $search = $request->query('search');
    $books = Book::when($search, function ($query, $search) {
        return $query->where('title', 'like', "%{$search}%");
    })->paginate(10);
    
    return view('books.index', compact('books', 'search'));
}

public function create()
{
    return view('books.create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
    ]);

    Book::create($request->all());

    return redirect()->route('books.index')->with('success', 'Book added successfully!');
}

public function edit(Book $book)
{
    return view('books.edit', compact('book'));
}

public function update(Request $request, Book $book)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
    ]);

    $book->update($request->all());

    return redirect()->route('books.index')->with('success', 'Book updated successfully!');
}

public function destroy(Book $book)
{
    $book->delete();
    return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
}

}
