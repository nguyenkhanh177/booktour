<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;

class HomeController extends Controller
{
    public function adminIndex()
    {
        // 1. Tổng số người dùng
        $totalUsers = User::count();

        // 2. Tổng số đơn đặt (Booking)
        $totalBookings = Booking::count();

        // 3. Đơn hàng mới (Chờ xử lý - Status = 0)
        $pendingBookings = Booking::where('status', 0)->count();

        // 4. Tổng doanh thu (Chỉ tính các đơn đã xác nhận status = 1)
        $totalRevenue = Booking::where('status', 1)->sum('total_price');

        // Lấy dữ liệu 7 ngày gần nhất cho biểu đồ
        $days = collect(range(6, 0))->map(function ($i) {
            return now()->subDays($i)->format('d/m');
        });

        $bookingCounts = collect(range(6, 0))->map(function ($i) {
            return Booking::whereDate('created_at', now()->subDays($i))->count();
        });

        return view('admin.home', compact(
            'totalUsers',
            'totalBookings',
            'pendingBookings',
            'totalRevenue',
            'days',
            'bookingCounts'
        ));
    }
}
