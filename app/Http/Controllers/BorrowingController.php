<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['member', 'staff'])->get();

        return view('borrowings.borrowings', ['borrowing_data' => $borrowings]);
    }
}
