@extends('layouts.client')
@section('title', 'Restaurant')
@section('content')
    <div class="hero-wrap js-fullheight"
        style="background-image: url('{{ asset('/uploads/restaurants/' . $restaurants->image) }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
                data-scrollax-parent="true">
                <div class="col-md-9 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">

                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                        <span class="mr-2">
                            <a href="{{ url('/') }}">Home</a>
                        </span>
                        <span>Restaurant</span>
                    </p>

                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                        Chi tiết restaurant
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
                        {{ $restaurants->name }}
                    </h2>

                    <p class="text-muted">
                        <i class="icon-map-marker"></i> {{ $restaurants->address }}
                        &nbsp; | &nbsp;
                        <i class="icon-calendar"></i> {{ $restaurants->time }}
                    </p>

                    <img src="{{ asset('uploads/restaurants/' . $restaurants->image) }}" alt="Restaurant image"
                        class="img-fluid mb-4 rounded">

                    <h4>🧭 Giới thiệu restaurant</h4>
                    <p>
                        {{ $restaurants->description }}
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

                            {{-- Thông tin dịch vụ --}}
                            <input type="hidden" name="id" value="{{ $restaurants->id }}">
                            <input type="hidden" name="type" value="restaurant">
                            <input type="hidden" name="name" value="{{ $restaurants->name }}">
                            <input type="hidden" name="price" value="{{ $restaurants->price }}">

                            {{-- Số khách --}}
                            <div class="form-group">
                                <label>Số lượng khách</label>
                                <input
                                    type="number"
                                    name="quantity"
                                    class="form-control"
                                    min="1"
                                    max="{{ $restaurants->capacity ?? 50 }}"
                                    value="2"
                                    required>
                            </div>

                        {{-- Ngày ăn --}}
                        <div class="form-group">
                            <label>Ngày dùng bữa</label>
                            <input
                                type="date"
                                name="service_date"
                                class="form-control"
                                min="{{ now()->toDateString() }}"
                                required>
                        </div>

                        {{-- Giờ ăn --}}
                        <div class="form-group">
                            <label>Giờ dùng bữa</label>
                            <input
                                type="time"
                                name="service_time"
                                class="form-control"
                                required>
                        </div>

                        {{-- Ghi chú --}}
                        <div class="form-group">
                            <label>Ghi chú (tuỳ chọn)</label>
                            <textarea
                                name="note"
                                class="form-control"
                                rows="2"
                                placeholder="VD: sinh nhật, ăn chay, phòng riêng..."></textarea>
                        </div>

                        {{-- Giá --}}
                        <div class="form-group text-center mt-3">
                            <strong class="text-danger" style="font-size: 20px">
                                {{ number_format($restaurants->price) }}đ / người
                            </strong>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fa fa-shopping-cart"></i> Đặt bàn
                        </button>
                    </form>
                </div>

                </div>
            </div>
        </div>
    </section>
@endsection