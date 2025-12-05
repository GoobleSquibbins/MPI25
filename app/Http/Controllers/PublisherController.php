<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::all();

        return view('publishers.publishers', ['publisher_data' => $publishers]);
    }

    public function create()
    {
        return view('publishers.create');
    }

    public function store(Request $request)
    {
        $publisher_data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Publisher::create([
            'name' => $publisher_data['name'],
        ]);

        return redirect(route('publishers.index'))->with('success', 'Publisher Added Succesfully, Glory to mankind');
    }

    public function edit($publisherid)
    {
        $publisher_data = Publisher::FindOrFail($publisherid);

        return view('publishers.edit', ['publisher_data' => $publisher_data]);
    }

    public function update(Request $request, $publisherid)
    {
        $publisher_data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $publisher = Publisher::findOrFail($publisherid);

        $publisher->update([
            'name' => $publisher_data['name'],
        ]);

        return redirect(route('publishers.index'))
            ->with('success', 'Publisher Updated Successfully');
    }

    public function destroy(Request $request)
    {
        $item = Publisher::findOrFail($request->id);

        $item->delete();

        return redirect(route('publishers.index'))->with('success', 'Publisher Deleted');
    }
}
