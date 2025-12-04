<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\Book;
use App\Models\Payment;
use App\Enums\PaymentEnum;
use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'address'        => 'required|string|max:255',
            'phone_number'   => 'required|string|max:20',
            'book_id'        => 'required|exists:books,id',
            'payment_type'   => 'required|string|in:' . implode(',', array_map(fn($p) => $p->name, \App\Enums\PaymentEnum::cases())),
            'payment_method' => 'required|in:cash,gcash',
        ]);

        $borrower = Borrower::create([
            'name'           => $validated['name'],
            'address'        => $validated['address'],
            'phone_number'   => $validated['phone_number'],
            'payment_method' => $validated['payment_method'],
            'book_id'        => $validated['book_id'],
        ]);

        $book = Book::find($validated['book_id']);
        if ($book && $book->available > 0) {
            $book->update([
                'borrower_id' => $borrower->id,
                'available'   => $book->available - 1,
            ]);
        } else {
            return back()->with('error', 'Selected book is not available.');
        }

        $paymentEnum = \App\Enums\PaymentEnum::fromName($validated['payment_type']);
        \App\Models\Payment::create([
            'borrower_id'  => $borrower->id,
            'payment_type' => $paymentEnum->name,
            'amount'       => $paymentEnum->value,
        ]);

        return back()->with('success', 'Borrower and payment added successfully!');
    }

    public function index()
    {
        $borrowers = Borrower::with('book', 'payment')->get();

        return view('borrowers', compact('borrowers'));
    }
}
