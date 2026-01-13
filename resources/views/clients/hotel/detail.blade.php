@extends('layouts.client')
@section('title', 'Hotel')
@section('content')
    <div class="hero-wrap js-fullheight" style="background-image: url('{{ asset('/uploads/hotels/' . $hotels->image) }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
                data-scrollax-parent="true">
                <div class="col-md-9 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">

                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                        <span class="mr-2">
                            <a href="{{ url('/') }}">Home</a>
                        </span>
                        <span>Hotel</span>
                    </p>

                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                        Chi tiết hotel
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ftco-animate">

                    <h2 class="mb-3">
                        {{ $hotels->name }}
                    </h2>

                    <p class="text-muted">
                        <i class="icon-map-marker"></i> {{ $hotels->address }}
                        &nbsp; | &nbsp;
                        <i class="icon-calendar"></i> {{ $hotels->time }}
                    </p>

                    <img src="{{ asset('uploads/hotels/' . $hotels->image) }}" alt="Hotel image"
                        class="img-fluid mb-4 rounded">

                    <h4>🧭 Giới thiệu hotel</h4>
                    <p>
                        {{ $hotels->description }}
                    </p>

                    <h4>📅 Lịch trình</h4>
                    <ul>
                        <li><strong>Ngày 1:</strong> Đà Nẵng – Ngũ Hành Sơn – Hội An</li>
                        <li><strong>Ngày 2:</strong> Bà Nà Hills – Cầu Vàng</li>
                        <li><strong>Ngày 3:</strong> Biển Mỹ Khê – mua sắm – kết thúc</li>
                    </ul>

                    <h4>🎁 Dịch vụ bao gồm</h4>
                    <ul>
                        <li>Xe du lịch đời mới</li>
                        <li>Khách sạn 3–4 sao</li>
                        <li>Hướng dẫn viên chuyên nghiệp</li>
                        <li>Vé tham quan theo chương trình</li>
                    </ul>

                </div>

                <!-- RIGHT SIDEBAR -->
                <div class="col-md-4 sidebar ftco-animate">

                    <div class="sidebar-box bg-light p-4 rounded">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" value="{{ $hotels->id }}">
                        <input type="hidden" name="type" value="hotel">
                        <input type="hidden" name="name" value="{{ $hotels->name }}">
                        <input type="hidden" name="price" value="{{ $hotels->price }}">

                        <!-- CHECK IN -->
                        <div class="form-group mb-3">
                            <label>Ngày nhận phòng</label>
                            <input type="date"
                                name="check_in"
                                class="form-control"
                                min="{{ now()->toDateString() }}"
                                required>
                        </div>

                        <!-- CHECK OUT -->
                        <div class="form-group mb-3">
                            <label>Ngày trả phòng</label>
                            <input type="date"
                                name="check_out"
                                class="form-control"
                                min="{{ now()->addDay()->toDateString() }}"
                                required>
                        </div>

                        <!-- SỐ PHÒNG -->
                        <div class="form-group mb-3">
                            <label>Số phòng</label>
                            <input type="number"
                                name="quantity"
                                value="1"
                                min="1"
                                class="form-control"
                                required>
                        </div>
                        {{-- Giá --}}
                        <div class="form-group text-center mt-3">
                            <strong class="text-danger" style="font-size: 20px">
                                {{ number_format($hotels->price) }}đ / đêm / phòng
                            </strong>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block w-100">
                            <i class="fa fa-bed"></i> Đặt phòng
                        </button>
                    </form>
                </div>

                </div>
            </div>
        </div>
    </section>
@endsection