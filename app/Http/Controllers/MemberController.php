<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();

        return view('members.members', ['member_data' => $members]);
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $member_data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        Member::create([
            'name' => $member_data['name'],
            'address' => $member_data['address'],
            'phone' => $member_data['phone'],
            'email' => $member_data['email'],
        ]);

        return redirect(route('members.index'))
            ->with('success', 'Member Added Successfully, Glory to mankind');
    }

    public function edit($memberid)
    {
        $member_data = Member::FindOrFail($memberid);

        return view('members.edit', ['member_data' => $member_data]);
    }

    public function update(Request $request, $memberid)
    {
        $member_data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $member = Member::findOrFail($memberid);

        $member->update([
            'name' => $member_data['name'],
        ]);

        return redirect(route('members.index'))
            ->with('success', 'Member Updated Successfully');
    }

    public function destroy(Request $request)
    {
        $item = Member::findOrFail($request->id);

        $item->delete();

        return redirect(route('members.index'))->with('success', 'Member Deleted');
    }
}
