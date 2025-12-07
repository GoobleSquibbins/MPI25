<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Fine;
use App\Models\Member;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['member', 'staff'])->get();

        return view('borrowings.borrowings', ['borrowing_data' => $borrowings]);
    }

    public function create()
    {
        $members = Member::all();
        $staff = Staff::all();
        $books = Book::where('available_copies', '>', 0)->get();

        return view('borrowings.create', compact('members', 'staff', 'books'));
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $request->validate([
            'member_id' => 'required|exists:members,id',
            'books' => 'required|array|min:1',
        ]);

        // Check all selected books
        $books = Book::whereIn('id', $request->books)->get();
        foreach ($books as $book) {
            if ($book->available_copies < 1) {
                return back()->withErrors([
                    'books' => "Book '{$book->name}' has no available copies.",
                ]);
            }
        }

        // Force WIB dates
        $borrow_date = Carbon::now('Asia/Jakarta');
        $due_date = Carbon::now('Asia/Jakarta')->addDays(7);

        // Create borrowing
        $borrowing = Borrowing::create([
            'member_id' => $request->member_id,
            'staff_id' => Auth::id(),
            'borrow_date' => $borrow_date,
            'due_date' => $due_date,
            'status' => 'borrowed',
        ]);

        // Borrowing details
        foreach ($request->books as $bookId) {
            BorrowingDetail::create([
                'borrow_id' => $borrowing->id,
                'book_id' => $bookId,
                'qty' => 1,
            ]);

            Book::find($bookId)->decrement('available_copies');
        }

        return redirect()->route('borrowings.index')
            ->with('success', 'Borrowing created successfully!');
    }

    public function edit($id)
    {
        $borrowing = Borrowing::find($id);

        return view('borrowings.edit', ['borrowing' => $borrowing]);
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date',
            'return_date' => 'nullable|date',
            'status' => 'required',
        ]);

        $borrowing->update($validated);

        BorrowingDetail::query()->where('borrow_id', $request->id)->delete();

        foreach ($request->books as $bookId) {
            BorrowingDetail::create([
                'borrow_id' => $request->id,
                'book_id' => $bookId,
                'qty' => 1,
            ]);
        }

        return redirect()->route('borrowings.index')
            ->with('success', 'Borrowing updated successfully.');
    }

    public function BookBack($id)
    {
        // Find borrowing
        $borrowing = Borrowing::findOrFail($id);

        // Return all books
        $borrowingDetails = BorrowingDetail::where('borrow_id', $id)->get();

        foreach ($borrowingDetails as $detail) {
            $book = Book::find($detail->book_id);

            if ($book) {
                // Add back available copies
                $book->available_copies += $detail->quantity;
                $book->save();
            }
        }

        // Update borrowing to returned
        $borrowing->update([
            'return_date' => now(),
            'status' => 'returned',
        ]);

        // Check if late
        $due = \Carbon\Carbon::parse($borrowing->due_date)->endOfDay();

        if (now()->gt($due)) {
            Fine::create([
                'borrow_id' => $borrowing->id,
                'amount' => 10000,
                'status' => 'pending',
            ]);
        }

        return redirect(route('borrowings.index'))
            ->with('success', 'Book(s) Returned');
    }

    public function destroy(Request $request)
    {
        $item = Borrowing::findOrFail($request->id);

        $item->delete();

        return redirect(route('borrowings.index'))->with('success', 'Borrowing Data Deleted');
    }
}
