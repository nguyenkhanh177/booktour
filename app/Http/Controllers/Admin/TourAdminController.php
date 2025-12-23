<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Str;

class TourAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::all();
        return view('admin.tour.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tour.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Set base data
        $data = $request->except('image');
        $data['alias'] = Str::slug($request->name);

        // 2. Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/tours'), $filename);
            $data['image'] = $filename;
        }

        // 3. Create Record
        Tour::create($data);
        return redirect()->route('admin.tour');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tours = Tour::findOrFail($id);
        return view('admin.tour.edit', compact('tours'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tour = Tour::findOrFail($id);

        $data = $request->except('image');
        $data['alias'] = Str::slug($request->name);

        // Handle Image Update
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/tours'), $filename);
            $data['image'] = $filename;

            // Optional: Delete old image if exists
            if ($tour->image && file_exists(public_path('uploads/tours/' . $tour->image))) {
                unlink(public_path('uploads/tours/' . $tour->image));
            }
        }

        $tour->update($data);
        return redirect()->route('admin.tour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tours = Tour::findOrFail($id);
        $tours->delete();
        return redirect()->route('admin.tour');
    }
}
