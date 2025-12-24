<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::paginate(6);
        return view('clients.hotel.index', compact('hotels'));
    }

    public function detail($id)
    {
        $hotels = Hotel::findOrFail($id);
        return view('clients.hotel.detail', compact('hotels'));
    }

    public function search(Request $request)
    {
        $query = Hotel::query();

        // 2. Lọc theo địa chỉ (Address)
        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->address . '%');
        }

        // 3. Lọc theo khoảng ngày (Tạm uẩn vì chưa có cột start_date/end_date)
        // if ($request->filled('start_date')) {
        //     $query->where('start_date', '>=', $request->start_date);
        // }

        // if ($request->filled('end_date')) {
        //     $query->where('start_date', '<=', $request->end_date);
        // }

        // 4. Lọc theo giá (Price)
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // 5. Lấy kết quả (có phân trang để trang web nhẹ hơn)
        $hotels = $query->paginate(6)->appends($request->all());

        return view('clients.hotel.index', compact('hotels'));
    }
}
