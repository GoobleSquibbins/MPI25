<?php

namespace App\Http\Controllers;

use App\Models\Fine;

class FineController extends Controller
{
    public function index()
    {
        $fine_data = Fine::with('borrow.member')->get();

        return view('fines.fines', ['fine_data' => $fine_data]);
    }
}
