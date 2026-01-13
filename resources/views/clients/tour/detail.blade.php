@extends('layouts.client')
@section('title', 'Tour')
@section('content')
    <div class="hero-wrap js-fullheight" style="background-image: url('{{ asset('uploads/tours/' . $tours->image) }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
                data-scrollax-parent="true">
                <div class="col-md-9 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">

                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                        <span class="mr-2">
                            <a href="{{ url('/') }}">Home</a>
                        </span>
                        <span>Tour</span>
                    </p>

                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                        Chi tiết tour
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
                        {{ $tours->name }}
                    </h2>

                    <p class="text-muted">
                        <i class="icon-map-marker"></i> {{ $tours->address }}
                        &nbsp; | &nbsp;
                        <i class="icon-calendar"></i> {{ $tours->time }}
                    </p>

                    <img src="{{ asset('uploads/tours/' . $tours->image) }}" alt="Tour image"
                        class="img-fluid mb-4 rounded">

                    <h4>🧭 Giới thiệu tour</h4>
                    <p>
                        {{ $tours->description }}
                    </p>

                    <h4>📅 Lịch trình</h4>
                    <ul>
                        <li><strong>Ngày 1:</strong> {{ $tours->schedule }}</li>
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

                            {{-- Thông tin tour --}}
                            <input type="hidden" name="id" value="{{ $tours->id }}">
                            <input type="hidden" name="type" value="tour">
                            <input type="hidden" name="name" value="{{ $tours->name }}">
                            <input type="hidden" name="price" value="{{ $tours->price }}">
                            <input type="hidden" name="duration_days" value="{{ $tours->duration_days }}">
                            <input type="hidden" name="duration_nights" value="{{ $tours->duration_nights }}">

                            {{-- Ngày khởi hành --}}
                            <div class="form-group">
                                <label>Ngày khởi hành</label>
                                <input type="date" name="start_date" class="form-control" min="{{ now()->toDateString() }}"
                                    required>
                            </div>

                            {{-- Số người --}}
                            <div class="form-group">
                                <label>Số người</label>
                                <input type="number" name="quantity" value="1" min="1" class="form-control" required>
                            </div>

                            {{-- Hiển thị thời gian tour (readonly) --}}
                            <div class="form-group">
                                <label>Thời gian tour</label>
                                <input type="text" class="form-control"
                                    value="{{ $tours->duration_days }} ngày {{ $tours->duration_nights }} đêm" readonly>
                            </div>

                            {{-- Giá --}}
                            <div class="form-group text-center mt-3">
                                <strong class="text-danger" style="font-size: 20px">
                                    {{ number_format($tours->price) }}đ / người
                                </strong>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block btn-lg mt-3">
                                <i class="fa fa-shopping-cart"></i> Đặt tour
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection