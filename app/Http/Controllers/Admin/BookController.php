<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%");
        }

        $books = $query->paginate(10);

        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'isbn' => 'required|string|unique:books,isbn',
            'publication_year' => 'nullable|digits:4|integer',
            'category' => 'nullable|string|max:255',
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0',
            'is_digital' => 'boolean',
            'digital_url' => 'required_if:is_digital,true|nullable|url',
        ]);

        Book::create($request->all());

        return redirect()->route('admin.books.index')
                        ->with('success', 'Book added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id,
            'publication_year' => 'nullable|digits:4|integer',
            'category' => 'nullable|string|max:255',
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0',
            'is_digital' => 'boolean',
            'digital_url' => 'required_if:is_digital,true|nullable|url',
        ]);

        $book->update($request->all());

        return redirect()->route('admin.books.index')
                        ->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
   {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('admin.books.index')
                        ->with('success', 'Book deleted successfully.');
    }

    public function digitalIndex(Request $request)
    {
        $query = Book::where('is_digital', true);
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%");
        }
        
        $books = $query->paginate(10);
        return view('admin.books.digital', compact('books'));
    }
}
