@extends('layouts.client')
@section('title', 'Booking Success')
@section('content')
    <div class="hero-wrap hero-booking-success"
     style="background-image: url({{ asset('assets/images/bg-dulich_2.jpg') }});">

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
    <div class="container py-5 text-center">
        <h2>Đã thêm "{{ session('last_item') }}" vào danh sách đặt!</h2>
        <p>Bạn muốn thực hiện bước tiếp theo là gì?</p>
        <div class="mt-4">
            <a href="{{ route('booking.checkout') }}" class="btn btn-success btn-lg mx-2">
                <i class="fa fa-check"></i> Hoàn tất và Gửi đơn hàng
            </a>

            <div class="dropdown d-inline-block">
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
        </div>
    </div>
@endsection