<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('clients.restaurant.index', compact('restaurants'));
    }

    public function detail($id)
    {
        $restaurants = Restaurant::find($id);
        return view('clients.restaurant.detail', compact('restaurants'));
    }
}
