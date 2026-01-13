@extends('layouts.client')
@section('title', 'Lịch sử đặt tour')

@section('content')
    <div class="header-status-bar"
        style="background: linear-gradient(to bottom, rgba(238, 61, 61, 0.8) 0%, rgba(238, 61, 61, 0.6) 100%); height: 100px;">
    </div>

    <section class="hero-wrap-2" style="background-color: #f8f9fa; padding: 40px 0; border-bottom: 1px solid #eee;">
        <div class="container text-center">
            <p class="breadcrumbs mb-2"
                style="text-transform: uppercase; font-size: 12px; letter-spacing: 2px; color: #999;">
                <a href="/">Trang chủ</a> / <span>Lịch sử giao dịch</span>
            </p>
            <h1 class="mb-0 bread fw-bold" style="text-transform: uppercase; letter-spacing: 5px; color: #222;">Booking
                History</h1>
        </div>
    </section>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr class="text-muted small text-uppercase">
                                        <th>Mã đơn</th>
                                        <th>Thông tin Tour</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th class="text-center">Chi tiết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($paidBookings as $booking)
                                        <tr>
                                            {{-- Cột 1: Mã đơn lấy từ ID của bảng Booking --}}
                                            <td>
                                                <span class="fw-bold text-primary">#{{ $booking->id }}</span>
                                            </td>

                                            {{-- Cột 2: Thông tin dịch vụ (Tên các dịch vụ trong đơn) --}}
                                            <td style="min-width: 300px;">
                                                @foreach($booking->details as $detail)
                                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                                        <div>
                                                            <i class="fas fa-check-circle text-success small me-1"></i>
                                                            <span class="fw-bold" style="font-size: 0.9rem;">
                                                                {{ $detail->service_type }}
                                                            </span>
                                                            <br>
                                                            {{-- Hiện Số lượng / Đơn vị --}}
                                                            <small class="text-muted">
                                                                Số lượng: {{ $detail->quantity }}
                                                                @if(isset($detail->unit)) ({{ $detail->unit }}) @endif
                                                            </small>
                                                        </div>
                                                        {{-- Hiện giá của từng dịch vụ --}}
                                                        <div class="text-end">
                                                            <small class="d-block">{{ number_format($detail->price) }} đ</small>
                                                        </div>
                                                    </div>
                                                    @if(!$loop->last)
                                                    <hr class="my-1 opacity-25"> @endif
                                                @endforeach
                                            </td>

                                            {{-- Cột 3: Ngày đặt --}}
                                            <td>
                                                <div class="small">{{ $booking->created_at->format('d/m/Y') }}</div>
                                                <div class="text-muted small">{{ $booking->created_at->format('H:i') }}</div>
                                            </td>

                                            {{-- Cột 4: Tổng tiền của cả đơn hàng --}}
                                            <td>
                                                <span class="fw-bold text-danger">
                                                    {{ number_format($booking->total_price) }} đ
                                                </span>
                                            </td>

                                            {{-- Cột 5: Trạng thái --}}
                                            <td>
                                                <span class="badge bg-light-success text-success px-3 py-2 rounded-pill"
                                                    style="font-size: 11px;">
                                                    THÀNH CÔNG
                                                </span>
                                            </td>

                                            {{-- Cột 6: Nút chi tiết --}}
                                            <td class="text-center">
                                                <a href="{{ route('booking.invoice', $booking->id) }}"
                                                    class="btn btn-sm btn-outline-secondary rounded-pill shadow-sm">
                                                    <i class="fas fa-file-invoice"></i> Xem vé
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                Bạn chưa có giao dịch nào hoàn tất.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-light-success {
            background-color: rgba(25, 135, 84, 0.1);
        }

        footer,
        .ftco-footer {
            display: none !important;
        }
    </style>
@endsection