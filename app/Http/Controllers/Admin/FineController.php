<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fine;

class FineController extends Controller
{
    public function index(Request $request)
    {
        $query = Fine::with(['borrow.member', 'borrow.book'])
            ->orderBy('fine_date', 'desc');

        if ($request->status === 'unpaid') {
            $query->where('is_paid', false);
        } elseif ($request->status === 'paid') {
            $query->where('is_paid', true);
        }

        $fines = $query->paginate(10);

        return view('admin.fines.index', compact('fines'));
    }

    public function show(Fine $fine)
    {
        return view('admin.fines.show', compact('fine'));
    }

    public function markAsPaid(Fine $fine)
    {
        if ($fine->is_paid) {
            return back()->with('info', 'Fine already paid.');
        }

        $fine->update(['is_paid' => true]);

        return back()->with('success', 'Fine marked as paid.');
    }

    public function destroy(Fine $fine)
    {
        $fine->delete();

        return back()->with('success', 'Fine deleted successfully.');
    }
}