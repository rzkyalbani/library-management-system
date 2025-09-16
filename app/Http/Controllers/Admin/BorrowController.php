<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Member;
use App\Models\Book;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Borrow::with(['member', 'book'])->orderBy('borrow_date', 'desc');

        if ($request->filled('member_id')) {
            $query->where('member_id', $request->member_id);
        }

        if ($request->filled('status')) {
            if ($request->status == 'active') {
                $query->whereNull('return_date');
            } elseif ($request->status == 'returned') {
                $query->whereNotNull('return_date');
            }
        }

        $borrows = $query->paginate(10);

        $members = Member::where('is_active', true)->get();
        $books = Book::where('available_copies', '>', 0)->get();

        return view('admin.borrows.index', compact('borrows', 'members', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Member::where('is_active', true)->get();
        $books = Book::where('available_copies', '>', 0)->get();

        return view('admin.borrows.create', compact('members', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($validated['book_id']);

        if ($book->available_copies < 1) {
            return back()->withErrors('Book is not available')->withInput();
        }

        Borrow::create([
            'member_id' => $validated['member_id'],
            'book_id' => $validated['book_id'],
            'borrow_date' => now(),
            'due_date' => now()->addDays(7), 
        ]);

        $book->decrement('available_copies');

        return redirect()->route('admin.borrows.index')->with('success', 'Book borrowed successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function returnBook(Borrow $borrow)
    {
        if ($borrow->return_date) {
            return back()->withErrors('Book already returned.');
        }

        $borrow->return_date = now();
        $borrow->save();

        $borrow->book->increment('available_copies');

        // Hitung denda
        // if ($borrow->return_date->gt($borrow->due_date)) {
        //     $daysLate = $borrow->return_date->diffInDays($borrow->due_date);
        //     FINE::create([
        //         'borrow_id' => $borrow->id,
        //         'amount' => $daysLate * 10000,
        //         'fine_date' => now(),
        //         'is_paid' => false,
        //     ]);
        // }

        return back()->with('success', 'Book returned successfully.');
    }
}
