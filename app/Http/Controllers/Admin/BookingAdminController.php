<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingAdminController extends Controller
{
    public function index()
    {
        // Sửa lỗi thứ tự gọi hàm: with -> orderBy -> paginate
        $bookings = Booking::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Tăng lên 10 để admin dễ quan sát hơn

        return view('admin.booking.index', compact('bookings'));
    }

    public function show($id)
    {
        // Eager load 'details' để tránh lỗi N+1 query trong view
        $booking = Booking::with(['user', 'details'])->findOrFail($id);
        return view('admin.booking.show', compact('booking'));
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'status' => 'required|in:0,1,2'
        ], [
            'status.in' => 'Trạng thái không hợp lệ.'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
