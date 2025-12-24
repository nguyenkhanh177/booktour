@extends('layouts.client')
@section('title', 'Xác nhận thông tin đặt tour')
@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Xác nhận thông tin đặt tour</h2>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">Dịch vụ đã chọn</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Dịch vụ</th>
                                    <th>Giá</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $index => $item)
                                    <tr>
                                        <td>
                                            <strong>{{ $item['name'] }}</strong><br>
                                            <small class="text-muted text-uppercase">{{ $item['service_type'] }}</small>
                                        </td>
                                        <td>{{ number_format($item['price']) }}đ</td>
                                        <td>
                                            {{-- Form xóa dịch vụ --}}
                                            <form action="{{ route('cart.remove', $index) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fa fa-trash"></i> Xóa
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h4 class="text-right">Tổng tiền: <span class="text-danger">{{ number_format($totalPrice) }}đ</span>
                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">Thông tin khách hàng</div>
                    <div class="card-body">
                        <form action="{{ route('booking.confirm') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Họ và tên</label>
                                <input type="text" name="customer_name" class="form-control"
                                    value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" name="customer_email" class="form-control"
                                    value="{{ Auth::user()->email }}" required>
                            </div>

                            <hr>
                            <button type="submit" class="btn btn-primary btn-block btn-lg w-100">
                                XÁC NHẬN ĐẶT HÀNG
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection