@extends('layouts.client')
@section('title', 'Xác nhận thông tin đặt tour')
@section('content')
    <div class="hero-wrap hero-booking-success"
        style="background-image: url({{ asset('assets/images/bg_dulich.jpg') }}); height: 400px">
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
                data-scrollax-parent="true">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span
                            class="mr-2"></span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <h2 class="mb-4">Xác nhận thông tin đặt tour</h2>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">Dịch vụ đã chọn</div>
                    <div class="card-body">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Dịch vụ</th>
                                    <th>Thời gian</th>
                                    <th>Số lượng</th>
                                    <th>Giá đơn vị</th>
                                    <th>Tổng</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $grandTotal = 0; @endphp
                                @foreach ($cart as $index => $item)
                                    @php
                                        $itemTotal = $item['total'] ?? ($item['price'] * $item['quantity']);
                                        $grandTotal += $itemTotal;
                                    @endphp
                                    <tr>
                                        {{-- DỊCH VỤ --}}
                                        <td>
                                            <strong>{{ $item['name'] }}</strong><br>
                                            <small class="text-muted text-uppercase">
                                                {{ $item['service_type'] }}
                                            </small>

                                            @if(!empty($item['note']))
                                                <div class="text-muted small">
                                                    {{ $item['note'] }}
                                                </div>
                                            @endif
                                        </td>

                                        {{-- THỜI GIAN --}}
                                        <td>
                                            @if($item['start_date'])
                                                {{ \Carbon\Carbon::parse($item['start_date'])->format('d/m/Y') }}
                                                @if($item['end_date'] && $item['end_date'] !== $item['start_date'])
                                                    <br>→ {{ \Carbon\Carbon::parse($item['end_date'])->format('d/m/Y') }}
                                                @endif
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>

                                        {{-- SỐ LƯỢNG --}}
                                        <td class="text-center">
                                            {{ $item['quantity'] }}
                                        </td>

                                        {{-- GIÁ --}}
                                        <td>
                                            {{ number_format($item['price']) }} đ
                                        </td>

                                        {{-- TỔNG --}}
                                        <td class="fw-bold text-danger">
                                            {{ number_format($itemTotal) }} đ
                                        </td>

                                        {{-- HÀNH ĐỘNG --}}
                                        <td class="text-center">
                                            <form action="{{ route('cart.remove', $index) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- TỔNG ĐƠN --}}
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Tổng cộng:</th>
                                    <th class="text-danger fw-bold">
                                        {{ number_format($grandTotal) }} đ
                                    </th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="d-flex align-items-center justify-content-between mt-4">
                            <div class="dropdown">
                                <button class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-plus"></i> Đặt thêm dịch vụ khác
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('client.tour') }}">Đặt thêm Tour</a>
                                    <a class="dropdown-item" href="{{ route('client.hotel') }}">Đặt thêm Khách sạn</a>
                                    <a class="dropdown-item" href="{{ route('client.car') }}">Thuê xe đưa đón</a>
                                    <a class="dropdown-item" href="{{ route('client.restaurant') }}">Đặt nhà hàng</a>
                                </div>
                            </div>
                            <h4 class="mb-0">
                                Tổng tiền:
                                <span class="text-danger">{{ number_format($totalPrice) }}đ</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">Thông tin khách hàng</div>
                    <div class="card-body">
                        <form action="{{ route('createPayment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
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