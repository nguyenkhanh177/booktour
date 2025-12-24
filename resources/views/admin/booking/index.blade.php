@extends('admin.layouts.client')
@section('title', 'Quản lý Đơn hàng')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Danh sách Đơn đặt hàng (Booking)</h3>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#ID</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Ngày đặt</th>
                            <th>Trạng thái</th>
                            <th width="180">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>#{{ $booking->id }}</td>
                                <td>
                                    <strong>{{ $booking->user->name ?? 'Khách vãng lai' }}</strong><br>
                                    <small>{{ $booking->user->email ?? '' }}</small>
                                </td>
                                <td class="text-danger font-weight-bold">
                                    {{ number_format($booking->total_price) }} VNĐ
                                </td>
                                <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('admin.booking.updateStatus', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                            class="form-control form-control-sm 
                                    {{ $booking->status == 0 ? 'text-warning' : ($booking->status == 1 ? 'text-success' : 'text-danger') }}">
                                            <option value="0" {{ $booking->status == 0 ? 'selected' : '' }}>Chờ xác nhận</option>
                                            <option value="1" {{ $booking->status == 1 ? 'selected' : '' }}>Đã xác nhận</option>
                                            <option value="2" {{ $booking->status == 2 ? 'selected' : '' }}>Đã hủy</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('admin.booking.show', $booking->id) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye"></i> Chi tiết
                                    </a>

                                    {{-- <form action="{{ route('admin.booking.destroy', $booking->id) }}" method="POST"
                                        style="display:inline-block"
                                        onsubmit="return confirm('Bạn có chắc muốn xóa đơn hàng này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Xóa</button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection