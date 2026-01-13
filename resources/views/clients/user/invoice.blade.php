@extends('layouts.client')
@section('title', 'Hóa đơn #' . $booking->id)

@section('content')
    <div
        style="background: linear-gradient(to bottom, rgba(238, 61, 61, 0.8) 0%, rgba(238, 61, 61, 0.6) 100%); height: 100px;">
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="d-flex justify-content-between mb-4 no-print">
                    <a href="{{ route('bookingHistory') }}" class="btn btn-outline-secondary rounded-pill">
                        <i class="fas fa-arrow-left"></i> Quay lại lịch sử
                    </a>
                    <button onclick="window.print()" class="btn btn-primary rounded-pill">
                        <i class="fas fa-print"></i> In hóa đơn
                    </button>
                </div>
                <div class="card shadow border-0 p-5 rounded-4 invoice-box">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h2 class="fw-bold text-primary mb-0">HÓA ĐƠN</h2>
                            <p class="text-muted">Mã đơn hàng: #{{ $booking->id }}</p>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <h4 class="fw-bold">Hệ thống Đặt Tour</h4>
                            <p class="small text-muted mb-0">Địa chỉ: 123 Đường Du Lịch, TP. Đà Nẵng</p>
                            <p class="small text-muted">Email: support@travel.com</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row mb-5">
                        <div class="col-sm-6">
                            <h6 class="text-muted text-uppercase small fw-bold">Khách hàng:</h6>
                            <p class="fw-bold mb-1">{{ auth()->user()->name }}</p>
                            <p class="text-muted small">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <h6 class="text-muted text-uppercase small fw-bold">Ngày thanh toán:</h6>
                            <p class="fw-bold mb-0">{{ $booking->created_at->format('d/m/Y H:i') }}</p>
                            <p class="small text-success fw-bold">Trạng thái: Đã thanh toán</p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3">Mô tả dịch vụ</th>
                                    <th class="py-3 text-center">Số lượng</th>
                                    <th class="py-3 text-end">Đơn giá</th>
                                    <th class="py-3 text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking->details as $detail)
                                    <tr class="border-bottom">
                                        <td class="py-3">
                                            <span
                                                class="fw-bold text-dark">{{ $detail->service_type ?? 'Dịch vụ du lịch' }}</span>
                                        </td>
                                        <td class="py-3 text-center">{{ $detail->quantity }}</td>
                                        <td class="py-3 text-end">{{ number_format($detail->price) }} đ</td>
                                        <td class="py-3 text-end fw-bold">
                                            {{ number_format($detail->price * $detail->quantity) }} đ
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td class="text-end py-4">
                                        <h5 class="fw-bold">TỔNG CỘNG:</h5>
                                    </td>
                                    <td class="text-end py-4">
                                        <h5 class="fw-bold text-danger">{{ number_format($booking->total_price) }} đ</h5>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="mt-5 p-4 bg-light rounded-3 text-center">
                        <p class="mb-0 small text-muted">Cảm ơn bạn đã tin tưởng và sử dụng dịch vụ của chúng tôi!</p>
                        <p class="small text-muted">Đây là hóa đơn điện tử được tạo tự động.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .invoice-box {
            background: #fff;
            position: relative;
        }

        /* CSS dành riêng cho khi bấm In (Ctrl + P) */
        @media print {

            .no-print,
            .header-status-bar,
            footer,
            .ftco-footer {
                display: none !important;
            }

            body {
                background: #fff;
            }

            .invoice-box {
                box-shadow: none !important;
                padding: 0 !important;
            }

            .container {
                max-width: 100% !important;
                width: 100% !important;
            }
        }
    </style>
@endsection