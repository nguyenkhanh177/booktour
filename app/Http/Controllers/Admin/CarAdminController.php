<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Str;

class CarAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view('admin.car.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.car.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // // 1. Set base data
        $data = $request->except('image');
        $data['alias'] = Str::slug($request->name);

        // 2. Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/cars'), $filename);
            $data['image'] = $filename;
        }

        // 3. Create Record
        Car::create($data);
        return redirect()->route('admin.car');
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
        $cars = Car::findOrFail($id);
        return view('admin.car.edit', compact('cars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cars = Car::findOrFail($id);
        $data = $request->except('image');
        $data['alias'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/cars'), $filename);
            $data['image'] = $filename;
        }

        $cars->update($data);
        return redirect()->route('admin.car');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cars = Car::findOrFail($id);
        $cars->delete();
        return redirect()->route('admin.car');
    }
}
