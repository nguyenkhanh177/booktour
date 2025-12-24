<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingAdminController extends Controller
{
    public function index()
    {
        // Lấy danh sách booking mới nhất
        $bookings = Booking::paginate(5)->with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.booking.index', compact('bookings'));

    }

    public function show($id)
    {
        // Xem chi tiết các dịch vụ trong booking đó
        $booking = Booking::with(['user', 'details'])->findOrFail($id);
        return view('admin.booking.show', compact('booking'));
    }
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // Validate trạng thái gửi lên
        $request->validate([
            'status' => 'required|in:0,1,2' // 0: Chờ, 1: Xác nhận, 2: Hủy
        ]);

        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
