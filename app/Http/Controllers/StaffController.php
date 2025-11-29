<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::with('role')
            ->where('name', '!=', 'admin')
            ->get();

        return view('staff.staff', ['staff_data' => $staffs]);
    }
}
