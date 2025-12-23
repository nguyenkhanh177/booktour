<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hotel;
use Illuminate\Support\Str;

class HotelAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::all();
        return view('admin.hotel.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hotel.create');
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
            $file->move(public_path('uploads/hotels'), $filename);
            $data['image'] = $filename;
        }

        // 3. Create Record
        Hotel::create($data);
        return redirect()->route('admin.hotel');
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
        $hotels = Hotel::findOrFail($id);
        return view('admin.hotel.edit', compact('hotels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hotels = Hotel::findOrFail($id);
        $data = $request->except('image');
        $data['alias'] = Str::slug($request->name);

        // Handle Image Update
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/hotels'), $filename);
            $data['image'] = $filename;

            // Optional: Delete old image if exists
            if ($hotels->image && file_exists(public_path('uploads/hotel/' . $hotels->image))) {
                unlink(public_path('uploads/hotels/' . $hotels->image));
            }
        }

        $hotels->update($data);
        return redirect()->route('admin.hotel');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hotels = Hotel::findOrFail($id);
        $hotels->delete();
        return redirect()->route('admin.hotel');
    }
}
