<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('clients.car.index', compact('cars'));
    }
    public function detail($id)
    {
        $cars = Car::findOrFail($id);
        return view('clients.car.detail', compact('cars'));
    }
}
