<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Tour;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $item = [
            'service_id'   => $request->id,
            'service_type' => $request->type,
            'name'         => $request->name,
            'price'        => $request->price, // giá đơn vị
            'quantity'     => $request->quantity ?? 1,
            'start_date'   => null,
            'end_date'     => null,
            'note'         => null,
            'total'        => null,
        ];

        // ===== TOUR =====
        if ($request->type === 'tour') {
            $tour = Tour::findOrFail($request->id);

            $item['start_date'] = $request->start_date;
            $item['end_date'] = Carbon::parse($request->start_date)
                ->addDays($tour->duration_days - 1)
                ->toDateString();

            $item['quantity'] = (int) ($request->quantity ?? 1);
            $item['total']    = $item['price'] * $item['quantity'];

            $item['note'] = "Tour {$tour->duration_days} ngày";
        }


        // ===== HOTEL =====
        if ($request->type === 'hotel') {
            $item['start_date'] = $request->check_in;
            $item['end_date']   = $request->check_out;

            $days = Carbon::parse($item['start_date'])
                ->diffInDays(Carbon::parse($item['end_date']));

            $item['quantity'] = max(1, $days);
            $item['total']    = $item['price'] * $item['quantity'];

            $item['note'] = "Khách sạn {$days} đêm";
        }

        // ===== RESTAURANT =====
        if ($request->type === 'restaurant') {
            $item['start_date'] = $request->service_date;
            $item['end_date']   = $request->service_date; // 1 ngày
            $item['quantity']   = (int) $request->quantity;

            // ⭐⭐ TÍNH TIỀN
            $item['total'] = $item['price'] * $item['quantity'];

            $item['note'] = 'Ăn lúc ' . $request->service_time
                . ($request->note ? ' - ' . $request->note : '');
        }

        // ===== CAR =====
        if ($request->type === 'car') {

            $item['start_date'] = $request->rent_start;
            $item['end_date']   = $request->rent_end;
            $item['quantity']   = (int) ($request->quantity ?? 1);

            $days = Carbon::parse($item['start_date'])
                ->diffInDays(Carbon::parse($item['end_date']));

            if ($days < 1) $days = 1;

            $item['total'] = $item['price'] * $days * $item['quantity'];

            $item['note'] = "Thuê xe {$days} ngày";
        }

        $cart[] = $item;
        session()->put('cart', $cart);

        return redirect()->route('booking.choices')
            ->with('last_item', $request->name);
    }


    public function showChoices()
    {
        $cart = session()->get('cart', []);

        $hasTour = collect($cart)->contains('service_type', 'tour');
        $hasHotel = collect($cart)->contains('service_type', 'hotel');
        $hasRestaurant = collect($cart)->contains('service_type', 'restaurant');
        $hasCar = collect($cart)->contains('service_type', 'car');

        return view('clients.booking.choices', compact('hasTour', 'hasHotel', 'hasRestaurant', 'hasCar'));
    }

    // public function checkout()
    // {
    //     $cart = session()->get('cart');

    //     if (!$cart) return redirect()->route('client.home');

    //     // Tính tổng giá từ session trước khi tạo Booking
    //     $totalPrice = collect($cart)->sum(function ($item) {
    //         return $item['price'] * $item['quantity'];
    //     });

    //     DB::beginTransaction();
    //     try {
    //         // Tạo bảng cha (bookings)
    //         $booking = Booking::create([
    //             'user_id' => Auth::id(),
    //             'total_price' => $totalPrice,
    //             'status' => 0, // Chờ duyệt
    //         ]);
    //         // Tạo các bảng con (booking_details)
    //         foreach ($cart as $item) {
    //             BookingDetail::create([
    //                 'booking_id'   => $booking->id,
    //                 'service_type' => $item['service_type'],
    //                 'service_id'   => $item['service_id'],
    //                 'price'        => $item['price'],
    //                 'quantity'     => $item['quantity'],
    //                 'start_date'   => $item['start_date'] ?? null,
    //                 'end_date'     => $item['end_date'] ?? null,
    //             ]);
    //         }
    //         DB::commit();
    //         session()->forget('cart'); // Xóa giỏ hàng sau khi xong
    //         return redirect()->route('client.home')->with('success', 'Đặt hàng thành công!');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
    //     }
    // }
    public function showCheckout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('client.home')
                ->with('error', 'Giỏ hàng trống');
        }

        $totalPrice = collect($cart)->sum(function ($item) {

            // Hotel tính theo ngày
            if ($item['service_type'] === 'hotel') {
                $days = Carbon::parse($item['start_date'])
                    ->diffInDays(Carbon::parse($item['end_date']));

                return $item['price'] * $days * $item['quantity'];
            }

            // Tour / Car / Restaurant
            return $item['price'] * $item['quantity'];
        });

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
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email',
        ]);

        $cart = session()->get('cart');
        if (!$cart) {
            return redirect()->route('client.home');
        }

        DB::beginTransaction();
        try {
            $totalPrice = 0;

            $booking = Booking::create([
                'user_id' => Auth::id(),
                'total_price' => 0, // cập nhật sau
                'status' => 0, // chờ duyệt
                'note' => "Khách: {$request->customer_name} - Email: {$request->customer_email}",
            ]);

            foreach ($cart as $item) {

                // ===== TÍNH GIÁ =====
                if ($item['service_type'] === 'hotel') {
                    $days = Carbon::parse($item['start_date'])
                        ->diffInDays(Carbon::parse($item['end_date']));

                    $itemTotal = $item['price'] * $days * $item['quantity'];
                    $note = "Khách sạn {$days} đêm";
                } else {
                    $itemTotal = $item['price'] * $item['quantity'];
                    $note = $item['note'] ?? null;
                }

                $totalPrice += $itemTotal;

                BookingDetail::create([
                    'booking_id'   => $booking->id,
                    'service_type' => $item['service_type'],
                    'service_id'   => $item['service_id'],
                    'price'        => $itemTotal,
                    'quantity'     => $item['quantity'],
                    'start_date'   => $item['start_date'] ?? null,
                    'end_date'     => $item['end_date'] ?? null,
                    'note'         => $note,
                ]);
            }

            $booking->update(['total_price' => $totalPrice]);

            DB::commit();
            session()->forget('cart');

            return redirect()->route('client.home')
                ->with('success', 'Đặt dịch vụ thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }
}
