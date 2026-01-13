<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayMentController extends Controller
{
    public function createPayment(Request $request)
    {
        $vnp_Url = env('VNP_URL'); // Hoặc lấy trực tiếp từ env
        $vnp_Returnurl = env('VNP_RETURNURL');
        $vnp_TmnCode = env('VNP_TMN_CODE');
        $vnp_HashSecret = env('VNP_HASH_SECRET');

        $vnp_TxnRef =  $request->customer_name . '_' . $request->customer_email . '_' . time(); // Mã đơn hàng (nên là ID duy nhất trong DB)
        $vnp_OrderInfo = "Thanh toán đơn hàng #" . $vnp_TxnRef;
        $vnp_Amount = $request->total_price * 100; // Số tiền (VNPAY tính đơn vị đồng, nhân 100)

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $request->ip(),
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url = $vnp_Url . "?" . $query;
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        return redirect($vnp_Url);
    }
    public function vnpayReturn(Request $request)
    {
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = $request->all();
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);

        // Tạo lại mã băm để so sánh (Security Check)
        $hashdata = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $secureHash = hash_hmac('sha512', $hashdata, env('VNP_HASH_SECRET'));
        if ($secureHash == $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00') {
                $cart = session()->get('cart');

                $booking = Booking::create(
                    [
                        'user_id' => Auth::id(),
                        'booking_code' => 'BK' . now()->format('YmdHis') . rand(100, 999),
                        'total_price'   => $request->vnp_Amount / 100,
                        'status'        => 1,
                        'payment_method' => 'vnpay',
                        'payment_status' => 'paid',
                    ]
                );

                foreach ($cart as $item) {
                    BookingDetail::create([
                        'booking_id'   => $booking->id,
                        'service_type' => $item['service_type'],
                        'service_id'   => $item['service_id'],
                        'price'        => $item['price'],
                        'quantity'     => $item['quantity'],
                        'start_date'   => $item['start_date'],
                        'end_date'     => $item['end_date'],
                        'note'         => $item['note'],
                    ]);
                }
                session()->forget('cart');
                DB::commit();
                return view('clients.payment.success');
            }
        }

        $tach = explode("_", $request->get('vnp_TxnRef'));
        $customer_name = $tach[0];
        $customer_email = $tach[1];

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('client.home')
                ->with('error', 'Giỏ hàng trống');
        }

        $total_price = collect($cart)->sum(function ($item) {

            // Hotel tính theo ngày
            if ($item['service_type'] === 'hotel') {
                $days = Carbon::parse($item['start_date'])
                    ->diffInDays(Carbon::parse($item['end_date']));

                return $item['price'] * $days * $item['quantity'];
            }

            // Tour / Car / Restaurant
            return $item['price'] * $item['quantity'];
        });

        return view('clients.payment.error', compact('customer_name', 'customer_email', 'total_price'));
    }
}
