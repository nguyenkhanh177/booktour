<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use Illuminate\Support\Str;

class RestaurantAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('admin.restaurant.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.restaurant.create');
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
            $file->move(public_path('uploads/restaurants'), $filename);
            $data['image'] = $filename;
        }

        // 3. Create Record
        Restaurant::create($data);
        return redirect()->route('admin.restaurant');
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
        $restaurants = Restaurant::findOrFail($id);
        return view('admin.restaurant.edit', compact('restaurants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $restaurants = Restaurant::findOrFail($id);
        $data = $request->except('image');
        $data['alias'] = Str::slug($request->name);

        // Handle Image Update
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/restaurants'), $filename);
            $data['image'] = $filename;

            // Optional: Delete old image if exists
            if ($restaurants->image && file_exists(public_path('uploads/restaurants/' . $restaurants->image))) {
                unlink(public_path('uploads/restaurants/' . $restaurants->image));
            }
        }

        $restaurants->update($data);
        return redirect()->route('admin.restaurant');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $restaurants = Restaurant::findOrFail($id);
        $restaurants->delete();
        return redirect()->route('admin.restaurant');
    }
}
