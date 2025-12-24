<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::paginate(6);
        return view('clients.tour.index', compact('tours'));
    }
    public function detail($id)
    {
        $tours = Tour::findOrFail($id);
        return view('clients.tour.detail', compact('tours'));
    }
    public function search(Request $request)
    {
        // 1. Khởi tạo query từ model Tour
        $query = Tour::query();

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
        $tours = $query->paginate(6)->appends($request->all());

        return view('clients.tour.index', compact('tours'));
    }
}
