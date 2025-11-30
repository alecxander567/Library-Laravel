<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return view('home', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'available' => 'required|integer|min:0',
        ]);

        Book::create([
            'name' => $request->name,
            'author' => $request->author,
            'available' => $request->available,
        ]);

        return redirect()->route('home')->with('success', 'Book added successfully!');
    }
}
