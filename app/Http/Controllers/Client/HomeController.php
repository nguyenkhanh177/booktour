<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Hotel;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $tours = Tour::all();
        $hotels = Hotel::all();
        return view('clients.trangchu.home', compact('tours', 'hotels'));
    }
}
