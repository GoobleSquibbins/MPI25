<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::with('role')
            ->where('name', '!=', 'admin')
            ->get();

        return view('staff.staff', ['staff_data' => $staffs]);
    }

    public function create()
    {
        $roles = Role::all();

        return view('staff.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $staff_data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required',
            'password' => 'required',
            'password_conf' => 'required|same:password',
        ]);

        Staff::create([
            'name' => $staff_data['name'],
            'role_id' => $staff_data['role'],
            'password' => Hash::make($staff_data['password']),
        ]);

        return redirect(route('staffs.index'))
            ->with('success', 'Staff Added Successfully, Glory to mankind');
    }

    public function edit($id)
    {
        $staff_data = Staff::FindOrFail($id);

        return view('staff.edit', ['staff_data' => $staff_data]);
    }

    public function update(Request $request, $staffId)
    {
        $staff_data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $staff = Staff::findOrFail($staffId);

        $staff->update([
            'name' => $staff_data['name'],
        ]);

        return redirect(route('staffs.index'))
            ->with('success', 'Staff Updated Successfully');
    }

    public function destroy(Request $request)
    {
        $item = Staff::findOrFail($request->id);

        $item->delete();

        return redirect(route('staffs.index'))->with('success', 'Staff Data Deleted');
    }
}