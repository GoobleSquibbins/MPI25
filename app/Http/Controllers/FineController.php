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

    public function pay($id){
        $data = Fine::findOrFail($id);
        $data->update([
            'status' => 'paid',
        ]);

        return redirect((route('fines.index')))->with('success', 'Fine Paid');
    }

    public function waive($id){
        $data = Fine::findOrFail($id);
        $data->update([
            'status' => 'waived',
        ]);

        return redirect((route('fines.index')))->with('success', 'Fine Waived');
    }
}
