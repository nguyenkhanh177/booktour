<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\BookingDetail;

class BookingController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $cart[] = [
            'service_id'   => $request->id,
            'service_type' => $request->type, // 'tour', 'hotel',...
            'name'         => $request->name,
            'price'        => $request->price,
            'quantity'     => $request->quantity ?? 1,
        ];

        session()->put('cart', $cart);

        return redirect()->route('booking.choices')->with('last_item', $request->name);
    }

    public function showChoices()
    {
        $cart = session()->get('cart', []);

        $hasTour = collect($cart)->contains('service_type', 'tour');
        $hasHotel = collect($cart)->contains('service_type', 'hotel');

        return view('clients.booking.choices', compact('hasTour', 'hasHotel'));
    }

    public function checkout()
    {
        $cart = session()->get('cart');

        if (!$cart) return redirect()->route('client.home');

        // Tính tổng giá từ session trước khi tạo Booking
        $totalPrice = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        DB::beginTransaction();
        try {
            // Tạo bảng cha (bookings)
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'total_price' => $totalPrice,
                'status' => 0, // Chờ duyệt
            ]);

            // Tạo các bảng con (booking_details)
            foreach ($cart as $item) {
                BookingDetail::create([
                    'booking_id'   => $booking->id,
                    'service_type' => $item['service_type'],
                    'service_id'   => $item['service_id'],
                    'price'        => $item['price'],
                    'quantity'     => $item['quantity'],
                ]);
            }
            DB::commit();
            session()->forget('cart'); // Xóa giỏ hàng sau khi xong
            return redirect()->route('client.home')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }
    public function showCheckout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('client.home')->with('error', 'Giỏ hàng trống');

        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('clients.booking.checkout', compact('cart', 'totalPrice'));
    }

    public function removeFromCart($index)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$index])) {
            unset($cart[$index]);
            // Sắp xếp lại chỉ số mảng để tránh lỗi
            session()->put('cart', array_values($cart));
        }
        return redirect()->back()->with('success', 'Đã xóa dịch vụ.');
    }

    public function confirmBooking(Request $request)
    {
        // 1. Validate thông tin người đặt
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email'
        ]);

        $cart = session()->get('cart');
        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        DB::beginTransaction();
        try {
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'total_price' => $totalPrice,
                'status' => 0,
                // Nếu bạn muốn lưu tên/email khách vào bảng bookings, hãy thêm cột vào migration
                'note' => "Khách: $request->customer_name - Email: $request->customer_email"
            ]);

            foreach ($cart as $item) {
                BookingDetail::create([
                    'booking_id'   => $booking->id,
                    'service_type' => $item['service_type'],
                    'service_id'   => $item['service_id'],
                    'price'        => $item['price'],
                    'quantity'     => $item['quantity'],
                ]);
            }
            DB::commit();
            session()->forget('cart');
            return redirect()->route('client.home')->with('success', 'Đã xác nhận đơn hàng thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}
