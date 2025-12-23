<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::all();
        return view('clients.tour.index', compact('tours'));
    }
    public function detail($id)
    {
        $tours = Tour::findOrFail($id);
        return view('clients.tour.detail', compact('tours'));
    }
}
