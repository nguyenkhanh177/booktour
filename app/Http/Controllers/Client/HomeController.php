<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Hotel;
use App\Models\Car;
use App\Models\Restaurant;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $tours = Tour::all();
        $hotels = Hotel::all();
        $cars = Car::all();
        $restaurants = Restaurant::all();
        return view('clients.trangchu.home', compact('tours', 'hotels', 'cars', 'restaurants'));
    }
}
