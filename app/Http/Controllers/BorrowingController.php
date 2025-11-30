<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Member;
use App\Models\Staff;
use App\Models\Book;
use App\Models\BorrowingDetail;
use Illuminate\Http\Request;

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
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'staff_id' => 'required|exists:staff,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after:borrow_date',
            'books' => 'required|array|min:1',
            'books.*' => 'exists:books,id',
        ]);

        // Check if all selected books have available copies
        $books = Book::whereIn('id', $request->books)->get();
        foreach ($books as $book) {
            if ($book->available_copies < 1) {
                return back()->withErrors(['books' => "Book '{$book->name}' has no available copies."]);
            }
        }

        // Create borrowing
        $borrowing = Borrowing::create([
            'member_id' => $request->member_id,
            'staff_id' => $request->staff_id,
            'borrow_date' => $request->borrow_date,
            'due_date' => $request->due_date,
            'status' => 'borrowed',
        ]);

        // Create borrowing details
        foreach ($request->books as $bookId) {
            BorrowingDetail::create([
                'borrow_id' => $borrowing->id,
                'book_id' => $bookId,
                'qty' => 1,
            ]);

            // Decrease available copies
            $book = Book::find($bookId);
            $book->decrement('available_copies');
        }

        return redirect()->route('borrowings.index')->with('success', 'Borrowing created successfully!');
    }
    
    public function edit($id)
    {
        $borrowing = Borrowing::findOrFail($id);

        $members = Member::all();
        $staffs = Staff::all();

        return view('borrowings.edit', compact('borrowing', 'members', 'staffs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'staff_id' => 'required|exists:staff,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrow_date',
            'status' => 'required|in:borrowed,returned,overdue',
        ]);

        $borrowing = Borrowing::findOrFail($id);

        $borrowing->update([
            'member_id' => $request->member_id,
            'staff_id' => $request->staff_id,
            'borrow_date' => $request->borrow_date,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()->route('borrowings.index')->with('success', 'Borrowing updated successfully!');
    }

    public function destroy($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->delete();

        return redirect()->route('borrowings.index')->with('success', 'Borrowing record deleted successfully!');
    }

}
