<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return view('clients.hotel.index', compact('hotels'));
    }

    public function detail($id)
    {
        $hotels = Hotel::findOrFail($id);
        return view('clients.hotel.detail', compact('hotels'));
    }
}
