<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Booking;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('clients.user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Cập nhật thông tin cơ bản
        $user->name = $request->name;
        $user->email = $request->email;

        // Xử lý ảnh đại diện
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete('public/' . $user->image);
            }
            $user->image = $request->file('image')->store('users', 'public');
        }

        // Xử lý đổi mật khẩu (nếu có nhập)
        if ($request->new_password) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();
        return back()->with('success', 'Cập nhật thông tin thành công!');
    }
    public function bookingHistory()
    {
        $paidBookings = Booking::where('user_id', Auth::id())
            ->with('details') // Lấy các dịch vụ đi kèm của mỗi ID booking
            ->orderBy('id', 'asc')
            ->get();

        return view('clients.user.bookingHistory', compact('paidBookings'));
    }
    public function showInvoice($id)
    {
        $booking = Booking::with('details')->findOrFail($id);
        return view('clients.user.invoice', compact('booking'));
    }
}
