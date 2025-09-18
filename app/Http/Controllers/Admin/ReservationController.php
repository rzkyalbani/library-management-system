<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Member;
use App\Models\Book;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with(['member', 'book'])
            ->orderBy('reservation_date', 'desc')
            ->get();

        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Member::all();
        $books = Book::where('available_copies', '=', 0)->get();

        return view('admin.reservations.create', compact('members', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'reservation_date' => 'required|date',
            'status' => 'required|in:pending,picked_up,canceled',
        ]);

        Reservation::create([
            'member_id' => $request->member_id,
            'book_id' => $request->book_id,
            'reservation_date' => $request->reservation_date,
            'exp_date' => null, // selalu null dulu
            'status' => $request->status,
        ]);

        return redirect()->route('admin.reservations.index')
                        ->with('success', 'Reservation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return view('admin.reservations.show', compact('reservation'));
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
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservation deleted successfully.');
    }

    public function markAsPickedUp(Reservation $reservation)
    {
        if ($reservation->status !== 'pending') {
            return back()->withErrors('Only pending reservations can be marked as picked up.');
        }

        $reservation->status = 'picked_up';
        $reservation->save();

        $borrow = Borrow::create([
            'member_id' => $reservation->member_id,
            'book_id' => $reservation->book_id,
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
        ]);

        // Kurangi stok buku
        $reservation->book->decrement('available_copies');

        return back()->with('success', "Reservation marked as picked up and borrow #{$borrow->id} created.");
    }
}
