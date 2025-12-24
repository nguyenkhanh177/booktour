@extends('admin.layouts.client')
@section('title', 'Chi tiết đơn hàng #' . $booking->id)
@section('content')
    <div class="container-fluid">
        <a href="{{ route('admin.booking.index') }}" class="btn btn-secondary mb-3"> Quay lại</a>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white">Thông tin khách hàng</div>
                    <div class="card-body">
                        <p><strong>Họ tên:</strong> {{ $booking->user->name }}</p>
                        <p><strong>Email:</strong> {{ $booking->user->email }}</p>
                        <p><strong>Ngày đặt:</strong> {{ $booking->created_at }}</p>
                        <p><strong>Tổng hóa đơn:</strong> <span
                                class="text-danger">{{ number_format($booking->total_price) }} VNĐ</span></p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">Dịch vụ đã đặt</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Loại</th>
                                    <th>Tên dịch vụ</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking->details as $item)
                                    <tr>
                                        <td><span class="badge badge-secondary">{{ strtoupper($item->service_type) }}</span>
                                        </td>
                                        <td>
                                            {{-- Sử dụng hàm service() bạn đã viết trong Model BookingDetail --}}
                                            @if($item->service)
                                                {{ $item->service->name ?? $item->service->tour_name ?? 'N/A' }}
                                            @else
                                                <span class="text-muted">Dịch vụ không tồn tại</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price) }} VNĐ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection