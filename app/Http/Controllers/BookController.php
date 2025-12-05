<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Enums\Genre;
use Illuminate\Support\Facades\DB;

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
            'genre' => 'required|string|in:' . implode(',', array_column(Genre::cases(), 'value')), // validate enum
        ]);

        Book::create([
            'name' => $request->name,
            'author' => $request->author,
            'available' => $request->available,
            'genre' => $request->genre,
        ]);

        return redirect()->route('home')->with('success', 'Book added successfully!');
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'available' => 'required|integer|min:0',
            'genre' => 'required|string|in:' . implode(',', array_column(Genre::cases(), 'value')), // validate enum
        ]);

        $book->update([
            'name' => $request->name,
            'author' => $request->author,
            'available' => $request->available,
            'genre' => $request->genre,
        ]);

        return redirect()->route('home')->with('success', 'Book updated successfully!');
    }

    public function topBooks()
    {
        $topBooks = Book::select('books.*', DB::raw('COUNT(borrowers.id) as borrow_count'))
            ->leftJoin('borrowers', 'books.id', '=', 'borrowers.book_id')
            ->groupBy('books.id')
            ->orderByDesc('borrow_count')
            ->take(5)
            ->get();

        return response()->json($topBooks);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('home')->with('success', 'Book deleted successfully!');
    }
}
